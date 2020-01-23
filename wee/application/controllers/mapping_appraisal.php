<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapping_appraisal extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Mapping_appraisal_model');
		$this->load->model('V_mapping_model');
	}

	function index() {
			$this->load->library('grid');
			$grid = $this->grid->set_properties(array('model' => 'V_mapping_model', 'controller' => 'mapping_appraisal', 'options' => array('id' => 'mapping_appraisal', 'pagination', 'rownumber')))->load_model()->set_grid();
			$view = $this->load->view('mapping_appraisal/index', array('grid' => $grid), true);
			echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
	}

	function datagrid() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
					$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
					$page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
					$offset = $row * ($page - 1);

					// if (isset($_POST['tahun_mobil']) && !empty($_POST['tahun_mobil'])) {
					// 		$where['tahun_mobil LIKE'] = '%' . $this->input->post('tahun_mobil') . '%';
					// }

					$data = array();
					$params = array('_return' => 'data');
					if (isset($where))
							$params['_where'] = $where;
					$data['total'] = isset($where) ? $this->V_mapping_model->count_by($where) : $this->V_mapping_model->count_all();
					$this->V_mapping_model->limit($row, $offset);
					$order = $this->V_mapping_model->get_params('_order');
					$rows = isset($where) ? $this->V_mapping_model->order_by($order)->get_many_by($where) : $this->V_mapping_model->order_by($order)->get_all();
					$data['rows'] = $this->V_mapping_model->get_selected()->data_formatter($rows);
					echo json_encode($data);
			}
			else
			{
					block_access_method();
			}
	}

	function add() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$data = $this->Mapping_appraisal_model->set_validation()->validate();
					if ($data !== false) {
							if ($this->Mapping_appraisal_model->check_unique($data)) {
									if ($this->Mapping_appraisal_model->insert($data) !== false) {
											echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
									} else {
											echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
									}
							} else {
									echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Mapping_appraisal_model->get_validation())));
							}
					} else {
							echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
					}
			} else {
				$this->load->library('combogrid');
				$karyawan_grid 	= $this->combogrid->set_properties(array('model'=>'Pegawai_model', 'controller'=>'Pegawai', 'fields'=>array('nik', 'nama'), 'options'=>array('id'=>'id_karyawan', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama', 'panelWidth'=>400)))->load_model()->set_grid();
				$member_grid 		= $this->combogrid->set_properties(array('model'=>'v_detail_kendaraan_model', 'controller'=>'Detail_kendaraan_member', 'fields'=>array('nama_member','tahun_mobil','merek_mobil','model_mobil','transmisi_mobil'), 'options'=>array('id'=>'id_detail_kendaraan', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_member', 'panelWidth'=>700)))->load_model()->set_grid();

				echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('mapping_appraisal/add',array('karyawan_grid'=>$karyawan_grid,'member_grid'=>$member_grid), TRUE)));
			}
	}

	function edit($id = false) {
			if (!$id) {
					data_not_found();
					exit;
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$data = $this->Mapping_appraisal_model->set_validation()->validate();
					if ($data !== false) {
							if ($this->Mapping_appraisal_model->check_unique($data, intval($id))) {
									if ($this->Mapping_appraisal_model->update(intval($id), $data) !== false) {
											echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
									} else {
											echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
									}
							} else {
									echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Mapping_appraisal_model->get_validation())));
							}
					} else {
							echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
					}
			} else {
					$value = $this->Mapping_appraisal_model->get(intval($id));
					$datamapping=$this->Mapping_appraisal_model->get_single($value);

					if (sizeof($value) == 1) {

							$this->load->library('combogrid');
							$karyawan_grid 	= $this->combogrid->set_properties(array('model'=>'Pegawai_model', 'controller'=>'Pegawai', 'fields'=>array('nama', 'telepon'), 'options'=>array('id'=>'id_karyawan', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama', 'panelWidth'=>400)))->load_model()->set_grid();
							$member_grid 		= $this->combogrid->set_properties(array('model'=>'v_detail_kendaraan_model', 'controller'=>'Detail_kendaraan_member', 'fields'=>array('nama_member','tahun_mobil','merek_mobil','model_mobil','transmisi_mobil'), 'options'=>array('id'=>'id_detail_kendaraan', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_member', 'panelWidth'=>700)))->load_model()->set_grid();

							$view = $this->load->view('mapping_appraisal/edit', array('karyawan_grid'=>$karyawan_grid,'member_grid'=>$member_grid,'data' => $datamapping), TRUE);
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
					$roles = $this->Mapping_appraisal_model->get(intval($id));
					if (sizeof($roles) == 1) {
							if ($this->Mapping_appraisal_model->delete(intval($id))) {
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
					echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('mapping_appraisal/search', '', TRUE)));
			} else {
					block_access_method();
			}
	}

	function view(){
		$template_header = 'templates/responsive/header';
		$template_body = 'templates/responsive/appraisal/penugasan';
		$template_bottom = 'templates/responsive/footer';

		$pegawai_id = $this->auth->get_user_data()->pegawai_id;
		$data_mapping = $this->Mapping_appraisal_model->data_mapping($pegawai_id);
		// var_dump($pegawai_id); die();

		$this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
		$this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'data_mapping' => $data_mapping));
		$this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
	}

	function detail($id){
		$template_header = 'templates/responsive/header';
		$template_body = 'templates/responsive/appraisal/detail';
		$template_bottom = 'templates/responsive/footer';

		$member = $this->Mapping_appraisal_model->get_member($id);

		$laporan = $this->Mapping_appraisal_model->detail_kendaraan($id);
		$file = $this->Mapping_appraisal_model->komponen_member($id);

		// var_dump($file); die();

		$this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
		$this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'member' => $member, 'file' => $file, 'laporan' => $laporan));
		$this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
	}

	function dokumen($id){
		$template_header = 'templates/responsive/header';
		$template_body = 'templates/responsive/appraisal/dokumen';
		$template_bottom = 'templates/responsive/footer';

		$jenis_komponen = $this->Mapping_appraisal_model->jenis_komponen_mapping($id);
		$file_komponen = $this->Mapping_appraisal_model->file_komponen($id);
		// var_dump($file_komponen); die();

		$this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));

		$this->load->view($template_body, array(
			'aplikasi' => $this->aplikasi,
			'unread_message' => $this->unread_message,
			'menus' => $this->menus,
			'rolename' => $this->auth->get_rolename(),
			'nama_user' => $this->auth->get_user_data()->nama,
			'jenis_komponen' => $jenis_komponen,
			'file_komponen' => $file_komponen,
			'id_member' => $id
		));

		$this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
	}

	function tambah_dokumen($id){
		$template_header = 'templates/responsive/header';
		$template_body = 'templates/responsive/appraisal/tambah_dokumen';
		$template_bottom = 'templates/responsive/footer';

		$jenis_komponen = $this->Mapping_appraisal_model->jenis_komponen();

		$this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));

		$this->load->view($template_body, array(
			'aplikasi' => $this->aplikasi,
			'unread_message' => $this->unread_message,
			'menus' => $this->menus,
			'rolename' => $this->auth->get_rolename(),
			'nama_user' => $this->auth->get_user_data()->nama,
			'jenis_komponen' => $jenis_komponen,
			'status_tkm' => '1',
			'id_member' => $id
		));

		$this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
	}

	function save(){
		if (isset($_FILES['file_komponen']['tmp_name']) && !empty($_FILES['file_komponen']['tmp_name'])) {
            $data['file_komponen'] = time() . str_replace(' ', '_', $_FILES['file_komponen']['name']);

            $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/member/';

            $config['allowed_types'] = '*';
            $config['max_size'] = 1100000;
            $config['file_name'] = $data['file_komponen'];

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file_komponen')) {
                echo"gagal update";
            } else {
                $id_member=$this->input->post('id_detail_kendaraan');

								$array=array(
				          'file_komponen'=>$config['file_name'],
				          'id_jenis'=>$this->input->post('id_jenis'),
				          'nama_komponen'=>$this->input->post('nama_komponen'),
				          'keterangan_komponen'=>$this->input->post('keterangan_komponen'),
									'kondisi_komponen'=>$this->input->post('kondisi_komponen'),
				          'id_detail_kendaraan'=>$this->input->post('id_detail_kendaraan'),
									'created_by'=>$this->auth->get_user_data()->id
				        );

								$simpan=$this->db->insert('tbl3133_komponen_member',$array);

								if($simpan){
				          $this->session->set_flashdata('pesan','File berhasil diupload');
				          $this->session->set_flashdata('class', 'success');

				          redirect("data-member/tambah-dokumen/$id_member");
				        }else{
				          $this->session->set_flashdata('pesan','Terjadi Kesalahan');
				          $this->session->set_flashdata('class', 'danger');

				          redirect("data-member/tambah-dokumen/$id_member");
				        }
            }
        }
			}

			function laporan($id){
				$template_header = 'templates/responsive/header';
				$template_body = 'templates/responsive/appraisal/laporan';
				$template_bottom = 'templates/responsive/footer';

				$detail_kendaraan = $this->Mapping_appraisal_model->detail_kendaraan($id);
				// var_dump($detail_kendaraan); die();

				$this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));

				$this->load->view($template_body, array(
					'aplikasi' => $this->aplikasi,
					'unread_message' => $this->unread_message,
					'menus' => $this->menus,
					'rolename' => $this->auth->get_rolename(),
					'nama_user' => $this->auth->get_user_data()->nama,
					'detail_kendaraan' => $detail_kendaraan,
					'id_member' => $id
				));

				$this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
			}

			function simpan(){

				$id_member=$this->input->post('id_member');
				$harga=$this->input->post('harga_awal');
				$harga_awal=str_replace(".", "", $harga);

				if (isset($id_member)) {

					$array=array(
						'nopol_kendaraan'=>$this->input->post('nopol_kendaraan'),
						'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
						'jumlah_bangku'=>$this->input->post('jumlah_bangku'),
						'spidometer_kendaraan'=>$this->input->post('spidometer_kendaraan'),
						'bbm_kendaraan'=>$this->input->post('bbm_kendaraan'),
						'jumlah_kepemilikan_kendaraan'=>$this->input->post('jumlah_kepemilikan_kendaraan'),
						'status_pajak_kendaraan'=>$this->input->post('status_pajak_kendaraan'),
						'pajak_ditanggung_kendaraan'=>$this->input->post('pajak_ditanggung_kendaraan'),
						'asuransi_kendaraan'=>$this->input->post('asuransi_kendaraan'),
						'catatan_kendaraan'=>$this->input->post('catatan_kendaraan'),
						'harga_awal'=>$harga_awal,
						// 'id_member'=>$id_member,
						'created_by'=>$this->auth->get_user_data()->id
					);

					$this->db->where('id',$id_member);
					$simpan=$this->db->update(kode_tbl().'detail_kendaraan',$array);

					if($simpan){
						$this->session->set_flashdata('pesan','Laporan berhasil disimpan');
						$this->session->set_flashdata('class', 'success');

						redirect("data-member/detail/$id_member");
					}else{
						$this->session->set_flashdata('pesan','Terjadi Kesalahan');
						$this->session->set_flashdata('class', 'danger');

						redirect("data-member/detail/$id_member");
					}

		    }
			}

}
