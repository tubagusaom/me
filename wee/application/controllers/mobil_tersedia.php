<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mobil_tersedia extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {

			$detail_kendaraan = kode_tbl().'detail_kendaraan';
			$komponen_member = kode_tbl().'komponen_member';
			$tahun_mobil = kode_tbl().'tahun_mobil';
			$merek_mobil = kode_tbl().'merek_mobil';
			$model_mobil = kode_tbl().'model_mobil';
			$transmisi_mobil = kode_tbl().'transmisi_mobil';
			$user_id = $this->auth->get_user_data()->pegawai_id;

			$this->db->select('
				a.id,
				a.harga_kendaraan,
        a.status_lelang,
				b.nama_komponen,
				b.file_komponen,
				c.tahun_mobil,
				d.merek_mobil,
				e.model_mobil,
				f.transmisi_mobil
			');

			$this->db->where('a.status_rekomendasi', '2');
			$this->db->where('b.status_gambar', '1');
			$this->db->join("$komponen_member b",'a.id=b.id_detail_kendaraan');
			$this->db->join("$tahun_mobil c", "a.id_tahun = c.id");
			$this->db->join("$merek_mobil d","a.id_merek = d.id");
			$this->db->join("$model_mobil e","a.id_model = e.id");
			$this->db->join("$transmisi_mobil f","a.id_transmisi = f.id");
			$mobil_tersedia = $this->db->get("$detail_kendaraan a")->result();

			// var_dump($mobil_tersedia); die();
      $this->load->model('Welcome_model');
      $mf = $this->Welcome_model->count_bidding_favorit($user_id);
      $bidding_favorit=count($mf);

				$template_header  = 'templates/responsive/showroom/header';
				$template_body    = 'templates/responsive/showroom/mobil_tersedia';
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
          'mobil_tersedia' => $mobil_tersedia,
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

		function add_favorit(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$id_dealer = $this->auth->get_user_data()->pegawai_id;
				$id_kendaraan = $this->input->post('id_detail');
        date_default_timezone_set('Asia/Jakarta');

				$data['id_kendaraan'] = $id_kendaraan;
				$data['id_dealer'] = $id_dealer;
				$data['status_detail'] = '1';
				$data['created_by'] = $id_dealer;
				$data['updated_by'] = $id_dealer;
				$data['created_when'] = date("Y-m-d H:i:s");
				$data['updated_when'] = date("Y-m-d H:i:s");

				$jejaring = $this->db->insert(kode_tbl().'detail_dealer',$data);

				$this->session->set_flashdata('result', 'Mobil telah ditambahkan kedaftar favorit.');
				$this->session->set_flashdata('mode_alert', 'success');
				redirect(base_url() . 'mobil_tersedia');
			}
		}

		function delete_favorit(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$id = $this->input->post('id_detail');

				if (!$id) {
						redirect(base_url() . 'mobil_tersedia');
				} else {
						$this->db->where('id', $id);
						$this->db->delete(kode_tbl().'detail_dealer');

						$this->session->set_flashdata('result', 'Mobil telah dihapus dari daftar favorit.');
						$this->session->set_flashdata('mode_alert', 'success');
						redirect(base_url() . 'mobil_tersedia');
				}
			}
		}



}
