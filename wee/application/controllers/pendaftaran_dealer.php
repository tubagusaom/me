<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftaran_dealer extends MY_Controller {

	function __construct()
	{
		parent::__construct();

        $this->load->model('Pendaftaran_dealer_model');
	}

    function index() {
        $this->load->library('grid');

        $grid = $this->grid->set_properties(array('model' => 'Pendaftaran_dealer_model', 'controller' => 'pendaftaran_dealer', 'options' => array('id' => 'pendaftaran_dealer', 'pagination', 'rownumber')))->load_model()->set_grid();

        $view = $this->load->view('pendaftaran_dealer/index', array('grid' => $grid), true);

        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);

						if (isset($_POST['pendaftaran_dealer']) && !empty($_POST['pendaftaran_dealer'])) {
                $where['pendaftaran_dealer LIKE'] = '%' . $this->input->post('pendaftaran_dealer') . '%';
            }

            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Pendaftaran_dealer_model->count_by($where) : $this->Pendaftaran_dealer_model->count_all();
            $this->Pendaftaran_dealer_model->limit($row, $offset);
            $order = $this->Pendaftaran_dealer_model->get_params('_order');
            $rows = isset($where) ? $this->Pendaftaran_dealer_model->order_by($order)->get_many_by($where) : $this->Pendaftaran_dealer_model->order_by($order)->get_all();
            $data['rows'] = $this->Pendaftaran_dealer_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Pendaftaran_dealer_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Pendaftaran_dealer_model->check_unique($data)) {
                    if ($this->Pendaftaran_dealer_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Pendaftaran_dealer_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('pendaftaran_dealer/add', '', TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Pendaftaran_dealer_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Pendaftaran_dealer_model->check_unique($data, intval($id))) {
									$akun_dealer = $this->input->post('akun_dealer');

                    if ($this->Pendaftaran_dealer_model->update(intval($id), $data) !== false) {
												if($akun_dealer == '1'){
												 $data_user = array(
															 'akun' => $this->input->post('no_hp_dealer'),
															 'email' => $this->input->post('email_dealer'),
															 'hp' => $this->input->post('no_hp_dealer'),
															 'nama_user' => $this->input->post('pemilik_dealer'),
                               'jenis_user' => '1',
															 'sandi' => '123456',
															 'sandi_asli' => '123456',
															 'aktif' => '1' ,
															 'pegawai_id' => $id,
														);

														$this->load->model('User_Model');
														$this->User_Model->insert($data_user);
														$user_id= $this->db->insert_id();

														$datay['user_id'] = $user_id;
														$datay['role_id'] = 16;
														$this->load->model('User_Role_Model');
														$this->User_Role_Model->insert($datay);
												}

                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }

                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Pendaftaran_dealer_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $value = $this->Pendaftaran_dealer_model->get(intval($id));
            if (sizeof($value) == 1) {
                $view = $this->load->view('pendaftaran_dealer/edit', array('data' => $this->Pendaftaran_dealer_model->get_single($value)), TRUE);
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
            $roles = $this->Pendaftaran_dealer_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Pendaftaran_dealer_model->delete(intval($id))) {
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
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('pendaftaran_dealer/search', '', TRUE)));
        } else {
            block_access_method();
        }
    }

		function daftar() {
			$this->load->model('artikel_model');
			$this->load->model('welcome_model');

			$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
			$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
			$data['menu_profil'] = $this->artikel_model->menu();

			$data['pengunjung'] = $this->welcome_model->dataPengunjung();
			$data['total'] = $this->welcome_model->totalPengunjung();

			$this->load->view('templates/bootstraps/header',$data);
			$this->load->view('pendaftaran_dealer/daftar',$data);
			$this->load->view('templates/bootstraps/bottom');
		}

		public function save(){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$no_hp_dealer=$this->input->post('no_hp_dealer');

				$this->db->where('no_hp_dealer' , $no_hp_dealer);
			  $query = $this->db->get(kode_tbl()."dealer");

			  if($query->num_rows()>0){
					$this->session->set_flashdata('result', 'NO HP SUDAH TERDAFTAR !.');
  				$this->session->set_flashdata('mode_alert', 'warning');

  				redirect(base_url() . 'pendaftaran_dealer/daftar');
			  }
			  else {
					$data['pemilik_dealer'] = $this->input->post('pemilik_dealer');
  				$data['no_hp_dealer'] = $this->input->post('no_hp_dealer');
  				$data['email_dealer'] = $this->input->post('email_dealer');
  				$data['nama_dealer'] = $this->input->post('nama_dealer');
  				$data['alamat_dealer'] = $this->input->post('alamat_dealer');

  				$dealer = $this->db->insert(kode_tbl()."dealer",$data);

  				$this->session->set_flashdata('result', 'TERIMAKASIH <br> PENDAFTARAN AKAN SEGERA KAMI PROSES.');
  				$this->session->set_flashdata('mode_alert', 'success');

  				redirect(base_url() . 'pendaftaran_dealer/daftar');
			  }

			}else {
				$this->session->set_flashdata('result', 'PENDAFTARAN MEMBER GAGAL !.');
				$this->session->set_flashdata('mode_alert', 'warning');

				redirect(base_url() . 'pendaftaran_dealer/daftar');
			}
		}

		function combogrid() {
			$this->load->model('Pendaftaran_dealer_model');
			$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
			$page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
			$offset = $row * ($page - 1);
			$data = array();
			$params = array('_return' => 'data');
			if (isset($_POST['q'])) {
					$where['nama_dealer LIKE'] = "%" . $this->input->post('q') . "%";
			}
			if (isset($where))
					$params['_where'] = $where;
			$data['total'] = isset($where) ? $this->Pendaftaran_dealer_model->count_by($where) : $this->Pendaftaran_dealer_model->count_all();
			$this->Pendaftaran_dealer_model->limit($row, $offset);
			$order_criteria = "ASC";
			$_order_escape = TRUE;
			if ($id) {
					$order = "FIELD(id, " . intval($id) . ")";
					$order_criteria = "DESC";
					$_order_escape = FALSE;
			} else {
					$order = $this->Pendaftaran_dealer_model->get_params('_order');
			}
			$rows = isset($where) ? $this->Pendaftaran_dealer_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->Pendaftaran_dealer_model->order_by($order, $order_criteria, $_order_escape)->get_all();
			$data['rows'] = $this->Pendaftaran_dealer_model->get_selected()->data_formatter($rows);
			echo json_encode($data);
		}

}
