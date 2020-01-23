<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

	function __construct()
	{
		parent::__construct();

        $this->load->model('Member_model');
	}

    function index() {
        $this->load->library('grid');

        $grid = $this->grid->set_properties(array('model' => 'Member_model', 'controller' => 'member', 'options' => array('id' => 'member', 'pagination', 'rownumber')))->load_model()->set_grid();

        $view = $this->load->view('member/index', array('grid' => $grid), true);

        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);

						if (isset($_POST['nama_member']) && !empty($_POST['nama_member'])) {
                $where['nama_member LIKE'] = '%' . $this->input->post('nama_member') . '%';
            }

            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Member_model->count_by($where) : $this->Member_model->count_all();
            $this->Member_model->limit($row, $offset);
            $order = $this->Member_model->get_params('_order');

						$rows = $this->Member_model->set_params($params)->with(array('tahun_mobil','merek_mobil','model_mobil','transmisi_mobil'));
						$data['rows'] = $this->Member_model->get_selected()->data_formatter($rows);
						echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

		function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Member_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->Member_model->check_unique($data, intval($id))) {
										$akun_member = $this->input->post('akun_member');

										if (empty($akun_member)) {
											$data['akun_member'] = '0';
										}else {
											$data['akun_member'] = '1';
										}

                    if ($this->Member_model->update(intval($id), $data) !== false) {
                        if($akun_member=='1'){
													$data_user = array(
 															 'akun' => $this->input->post('no_hp_member'),
 															 'email' => $this->input->post('email_member'),
 															 'hp' => $this->input->post('no_hp_member'),
 															 'nama_user' => $this->input->post('nama_member'),
                               'jenis_user' => '3',
 															 'sandi' => '123456',
 															 'sandi_asli' => '123456',
 															 'aktif' => '1' ,
 															 'pegawai_id' => $id,
 														);

														$this->load->model('User_Model');
														$this->User_Model->insert($data_user);
														$user_id= $this->db->insert_id();

														$datay['user_id'] = $user_id;
														$datay['role_id'] = 5;
														$this->load->model('User_Role_Model');
														$this->User_Role_Model->insert($datay);
                        }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Member_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->Member_model->get(intval($id));
            if (sizeof($con_method) == 1) {

								$detail_kendaraan = $this->Member_model->detail_kendaraan($id);
								// var_dump($detail_kendaraan->id_tahun); die();

                $data = $this->Member_model->get_single($con_method);
                $view = $this->load->view('member/edit', array( 'data' => $data, 'detail_kendaraan' => $detail_kendaraan ,'status_member' => array('0' => '-Pilih-', '1' => 'Ditolak', '2' => 'Diterima')), TRUE);
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
            $roles = $this->Member_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Member_model->delete(intval($id))) {
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
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('member/search', '', TRUE)));
        } else {
            block_access_method();
        }
    }

		function combogrid() {
			$this->load->model('Member_model');
			$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
			$page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
			$offset = $row * ($page - 1);
			$data = array();
			$params = array('_return' => 'data');
			if (isset($_POST['q'])) {
					$where['nama_member LIKE'] = "%" . $this->input->post('q') . "%";
			}
			$where['status_member'] = "2";
			if (isset($where))
					$params['_where'] = $where;
			$data['total'] = isset($where) ? $this->Member_model->count_by($where) : $this->Member_model->count_all();
			$this->Member_model->limit($row, $offset);
			$order_criteria = "ASC";
			$_order_escape = TRUE;
			if ($id) {
					$order = "FIELD(id, " . intval($id) . ")";
					$order_criteria = "DESC";
					$_order_escape = FALSE;
			} else {
					$order = $this->Member_model->get_params('_order');
			}
			$rows = isset($where) ? $this->Member_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->Member_model->order_by($order, $order_criteria, $_order_escape)->get_all();
			$data['rows'] = $this->Member_model->get_selected()->data_formatter($rows);
			echo json_encode($data);
		}

}
