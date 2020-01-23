<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pelelangan extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Pelelangan_model');
        // $this->load->model('V_detail_kendaraan_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'Pelelangan_model', 'controller' => 'pelelangan', 'options' => array('id' => 'pelelangan', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('pelelangan/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

		function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);

						// if (isset($_POST['nama_member']) && !empty($_POST['nama_member'])) {
            //     $where['nama_member LIKE'] = '%' . $this->input->post('nama_member') . '%';
            // }

            $data = array();
            $where['status_rekomendasi'] = '2';
            $where['status_lelang != '] = '2';

            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Pelelangan_model->count_by($where) : $this->Pelelangan_model->count_all();
            $this->Pelelangan_model->limit($row, $offset);
            $order = $this->Pelelangan_model->get_params('_order');

						$rows = $this->Pelelangan_model->set_params($params)->with(array('nama_member','tahun_mobil','merek_mobil','model_mobil','transmisi_mobil'));
						$data['rows'] = $this->Pelelangan_model->get_selected()->data_formatter($rows);
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
            $data = $this->Pelelangan_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Pelelangan_model->check_unique($data, intval($id))) {
                  $harga=$this->input->post('harga_kendaraan');
                  $data['harga_kendaraan']=str_replace(".", "", $harga);
                    if ($this->Pelelangan_model->update(intval($id), $data) !== false) {

                      $sg = $this->input->post('sg');
                      $this->db->where('id_detail_kendaraan',$id);
                      // $komponen= $this->db->get(kode_tbl().'komponen_member')->result_array();
                      $update = array(
                        'status_gambar' => '0',
                      );
                      $update=$this->db->update(kode_tbl().'komponen_member', $update);

                      if ($update) {
                        $data_update = array(
                          'status_gambar' => '1',
                        );

                        $this->db->where('id', $sg);
                        $this->db->update(kode_tbl().'komponen_member', $data_update);
                      }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Pelelangan_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $kendaraan = $this->Pelelangan_model->get(intval($id));

            if (sizeof($kendaraan) == 1) {

                $data = $this->Pelelangan_model->get_single($kendaraan);

                $data_kendaraan = $this->Pelelangan_model->dokumen_member($id);
                $detail_kendaraan = $this->Pelelangan_model->detail_kendaraan($id);
                $jenis_komponen = $this->Pelelangan_model->jenis_komponen($id);

                $status_lelang = array(0=>'', 1=>'Lelang', 3=>'Lelang Ulang', 2=>'Selesai');

                $view = $this->load->view('pelelangan/edit',
                    array(
                        'data' => $data,
                        'data_kendaraan' => $data_kendaraan,
                        'detail_kendaraan' => $detail_kendaraan,
                        'jenis_komponen' => $jenis_komponen,
                        'status_lelang' => $status_lelang,
                    ),
                    TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !' ));
            }
        }
    }

    function show_file() {
        $nmfile = $this->input->get('nmfile');
        $data['extension'] = strtolower(substr($nmfile, -3));
        $data['nmfile'] = $nmfile;
        $this->load->view('pelelangan/view_image', $data);
    }

    function bidding() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_detail_dealer = $this->input->post('id_detail_dealer');
        $id_detail_kendaraan = $this->input->post('id_detail_kendaraan');
        $id_dealer = $this->input->post('id_dealer');
        $jam_bidding = $this->input->post('jam_bidding');
        $bidding_kendaraan = $this->input->post('bidding_kendaraan');

        $data_lelang = array(
          'id_detail_kendaraan' => $id_detail_kendaraan,
          'id_dealer' => $id_dealer,
          'jam_bidding' => $jam_bidding,
          'bid_ke' => $bidding_kendaraan,
          'created_by' => $id_dealer,
          'created_when' => $jam_bidding,
          'updated_by' => $id_dealer,
          'updated_when' => $jam_bidding,
        );

        $tambah_lelang = $this->db->insert(kode_tbl().'lelang',$data_lelang);

        if ($tambah_lelang) {
          $update = array(
            'id_dealer' => $id_dealer,
            'bidding_kendaraan' => $bidding_kendaraan,
          );

          $this->db->where('id', $id_detail_kendaraan);
          $update_kendaraan=$this->db->update(kode_tbl().'detail_kendaraan', $update);

          $this->session->set_flashdata('result', 'Bidding berhasil.');
          $this->session->set_flashdata('mode_alert', 'success');
          redirect(base_url()."favorit/detail/$id_detail_dealer");
        }
      }
    }

    function view(){
      $detail_dealer = kode_tbl().'detail_dealer';
			$detail_kendaraan = kode_tbl().'detail_kendaraan';
			$komponen_member = kode_tbl().'komponen_member';
			$tahun_mobil = kode_tbl().'tahun_mobil';
			$merek_mobil = kode_tbl().'merek_mobil';
			$model_mobil = kode_tbl().'model_mobil';
			$transmisi_mobil = kode_tbl().'transmisi_mobil';
			$user_id = $this->auth->get_user_data()->pegawai_id;

			$this->db->select('
				a.id,
				b.jam_awal,
				b.jam_akhir,
				b.harga_kendaraan,
				c.nama_komponen,
				c.file_komponen,
				d.tahun_mobil,
				e.merek_mobil,
				f.model_mobil,
				g.transmisi_mobil
			');

      $this->db->where('a.id_dealer', $user_id);
			$this->db->where('b.status_lelang', '1');
			$this->db->where('c.status_gambar', '1');
			$this->db->join("$detail_kendaraan b",'a.id_kendaraan=b.id');
			$this->db->join("$komponen_member c",'b.id=c.id_detail_kendaraan');
			$this->db->join("$tahun_mobil d", "b.id_tahun = d.id");
			$this->db->join("$merek_mobil e","b.id_merek = e.id");
			$this->db->join("$model_mobil f","b.id_model = f.id");
			$this->db->join("$transmisi_mobil g","b.id_transmisi = g.id");
			$mobil_favorit = $this->db->get("$detail_dealer a")->result();

      $this->load->model('Welcome_model');
      $mf = $this->Welcome_model->count_bidding_favorit($user_id);
      $bidding_favorit=count($mf);

			// var_dump($bidding_favorit); die();

				$template_header  = 'templates/responsive/showroom/header';
				$template_body    = 'templates/responsive/showroom/lelang';
				$template_bottom  = 'templates/responsive/showroom/footer';

        //var_dump($data_aktivitas); die();
        $this->load->view($template_header, array(
          'aplikasi' => $this->aplikasi,
          '_css_tag' => array(_Asset_JS_ . 'cleditor/jquery.cleditor', _Asset_CSS_ . 'default', _Asset_CSS_ . 'themes/default/easyui', _Asset_CSS_ . 'themes/icon', _Asset_CSS_ . 'bootstraps/font-awesome.min'),
          'query_pesan' => $this->query_pesan,
          'bidding_favorit' => $bidding_favorit,
          'query_pesan_unread' => $this->query_pesan_unread,
          '_script_tag' => array(_Asset_JS_ . 'jquery.min', _Asset_JS_ . 'jquery-ui/jquery-ui.min', _Asset_JS_ . 'elfinder/elfinder.min', _Asset_JS_ . 'jquery.easyui.min')));

        $this->load->view($template_body, array(
          'perangkat' => $perangkat,
          'aplikasi' => $this->aplikasi,
          'unread_message' => $this->unread_message,
          'menus' => $this->menus,
          'rolename' => $this->auth->get_rolename(),
          'nama_user' => $this->auth->get_user_data()->nama,
          'jumlah_sertifikat' => $jumlah_sertifikat,
          'jumlah_uji_kompetensi' => $jumlah_uji_kompetensi,
          'jumlah_repositori' => $jumlah_repositori,
          'data_aktivitas' => $data_aktivitas,
          'jumlah_penugasan' => $jumlah_penugasan,
          'mobil_favorit' => $mobil_favorit,
					'user_id' => $user_id
        ));

        $this->load->view($template_bottom, array(
          'aplikasi' => $this->aplikasi,
          '_bottom_JS_' => array(_Asset_JS_ .
          'member/jscript', _Asset_JS_ . 'member/default',
          _Asset_JS_ . 'easyui.form.extend',
          _Asset_JS_ . 'jquery.extend',
          _Asset_JS_ . 'member/serializeObject',
          _Asset_JS_ . 'jquery.easyui.lang.id',
          _Asset_JS_ . 'member/ajaxfileupload',
          _Asset_JS_ . 'cleditor/jquery.cleditor.min'))
				);
    }

    function view_bidding($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        $con_method = $this->Pelelangan_model->get(intval($id));
        if (sizeof($con_method) == 1) {

            // $data_kendaraan = $this->Pelelangan_model->dokumen_member($id);
            $detail_kendaraan = $this->Pelelangan_model->detail_kendaraan($id);
            $data_bidding = $this->Pelelangan_model->detail_lelang($id);

            $total_bidding= count($data_bidding);
            $terbilang = $this->Pelelangan_model->penyebut($total_bidding);

            $data = $this->Pelelangan_model->get_single($con_method);
            $view = $this->load->view('pelelangan/view', array(
              'data' => $data,
              'terbilang' => $terbilang,
              'detail_kendaraan' => $detail_kendaraan,
              'total_bidding' => $total_bidding,
              'detail_lelang' => $data_bidding,
            ), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
        }
    }


}
