<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends MY_Controller {

	function __construct()
	{
		parent::__construct();

        $this->load->model('Pegawai_model');
	}

    function index() {
        $this->load->library('grid');

        $grid = $this->grid->set_properties(array('model' => 'Pegawai_model', 'controller' => 'pegawai', 'options' => array('id' => 'pegawai', 'pagination', 'rownumber')))->load_model()->set_grid();
        $view = $this->load->view('pegawai/index', array('grid' => $grid), true);
        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);

						if (isset($_POST['nama']) && !empty($_POST['nama'])) {
                $where['nama LIKE'] = '%' . $this->input->post('nama') . '%';
            }

            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Pegawai_model->count_by($where) : $this->Pegawai_model->count_all();
            $this->Pegawai_model->limit($row, $offset);
            $order = $this->Pegawai_model->get_params('_order');
            $rows = isset($where) ? $this->Pegawai_model->order_by($order)->get_many_by($where) : $this->Pegawai_model->order_by($order)->get_all();
            $data['rows'] = $this->Pegawai_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

		function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Pegawai_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Pegawai_model->check_unique($data)) {
									$insertpegawai = $this->Pegawai_model->insert($data);
                    if ($insertpegawai !== false) {

											if ($this->input->post('penanggungjawab') != 0) {
												$data_detail = array(
													'id_karyawan' => $insertpegawai,
													'id_penanggung_jawab' => $this->input->post('penanggungjawab'),
												);

												$this->load->model('Detail_pegawai_model');
												$this->Detail_pegawai_model->insert($data_detail);
											}

                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Pegawai_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
					$role_grid = array(0=>'', 4=>'Administrator', 17=>'Appraisal', 18=>'Marketing', 19=>'Operator', 20=>'Super visior');
					echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('pegawai/add',array('role_grid'=>$role_grid), TRUE)));
        }
    }

		function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Pegawai_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Pegawai_model->check_unique($data, intval($id))) {
									$akun_karyawan = $this->input->post('akun_karyawan');
									$nama = $this->input->post('nama');
									$username = str_replace(' ','',strtolower($nama) . rand(1, 9999));
									// $replace =   str_replace('-','',$nama);
									// $username = strtolower($replace) . rand(1, 9999);

                    if ($this->Pegawai_model->update(intval($id), $data) !== false) {

												if($akun_karyawan == '1'){
												 $data_user = array(
															 'akun' => $username,
															 'email' => $this->input->post('email'),
															 'hp' => $this->input->post('telepon'),
															 'nama_user' => $this->input->post('nama'),
                               'jenis_user' => $this->input->post('jabatan_id'),
															 'sandi' => '123456',
															 'sandi_asli' => '123456',
															 'aktif' => '1' ,
															 'pegawai_id' => $id,
														);

														$this->load->model('User_Model');
														$this->User_Model->insert($data_user);
														$user_id= $this->db->insert_id();

														$datay['user_id'] = $user_id;
														$datay['role_id'] = $this->input->post('jabatan_id');
														$this->load->model('User_Role_Model');
														$this->User_Role_Model->insert($datay);
												}

                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }

                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Pegawai_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $value = $this->Pegawai_model->get(intval($id));
            if (sizeof($value) == 1) {
                $view = $this->load->view('pegawai/edit', array('data' => $this->Pegawai_model->get_single($value)), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->Pegawai_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Pegawai_model->delete(intval($id))) {
                    echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil dihapus'));
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak berhasil dihapus !'));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        } else {
            block_access_method();
        }
    }

		function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('tahun_mobil/search', '', TRUE)));
        } else {
            block_access_method();
        }
    }

		function combogrid($id = false) {
        $this->load->model('Pegawai_model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
        $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return' => 'data');
				if (isset($_POST['q'])) {
						$where['nama LIKE'] = "%" . $this->input->post('q') . "%";
				}
				$where['jabatan_id'] = $id;
        if (isset($where))
            $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->Pegawai_model->count_by($where) : $this->Pegawai_model->count_all();
        $this->Pegawai_model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if ($id) {
            $order = "FIELD(id, " . intval($id) . ")";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        } else {
            $order = $this->Pegawai_model->get_params('_order');
        }
        $rows = isset($where) ? $this->Pegawai_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->Pegawai_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->Pegawai_model->get_selected()->data_formatter($rows);
        echo json_encode($data);
    }

}
