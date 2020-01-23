<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $jenis_user = $this->auth->get_user_data()->jenis_user;
        $pegawai_id = $this->auth->get_user_data()->pegawai_id;
        //var_dump($this->auth->is_logged_in());die();s
        // var_dump($pegawai_id); die();

        if ($jenis_user == 17) { //Appraisal

            $this->db->where('id_karyawan', $pegawai_id);
            $query = $this->db->get(kode_tbl() . 'mapping_appraisal')->result();
            $jumlah_penugasan = count($query);

            $template_header  = 'templates/responsive/header';
            $template_body    = 'templates/responsive/appraisal/body';
            $template_bottom  = 'templates/responsive/footer';
        } else if ($jenis_user == 16) { //Showroom

          // $lelang = kode_tbl().'lelang';
    			// $dealer = kode_tbl().'dealer';
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


          // $this->db->select('a.id');
    			// $this->db->where('a.id_dealer', $pegawai_id);
    			// $this->db->where('b.status_lelang', '1');
    			// $this->db->join("$detail_kendaraan b",'a.id_kendaraan=b.id');
    			// $mf = $this->db->get("$detail_dealer a")->result();
          $this->load->model('Welcome_model');
          $mf = $this->Welcome_model->count_bidding_favorit($pegawai_id);
          $bidding_favorit=count($mf);

            // var_dump($bidding_favorit); die();

            $template_header  = 'templates/responsive/showroom/header';
            $template_body    = 'templates/responsive/showroom/mobil_tersedia';
            $template_bottom  = 'templates/responsive/showroom/footer';

        } else if ($jenis_user == 5) { //Pemilik Kendaraan

            $template_header  = 'templates/responsive/header';
            $template_body    = 'templates/responsive/member/body';
            $template_bottom  = 'templates/responsive/footer';

        }else {
            $template_header  = 'templates/jeasyui/header';
            $template_body    = 'templates/jeasyui/body';
            $template_bottom  = 'templates/jeasyui/footer';
            $jumlah_sertifikat = '';
            $jumlah_uji_kompetensi = '';
            $jumlah_repositori = "";
            $query_pesan = "";
            $data_aktivitas = "";
            $perangkat = "";
        }
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
          _Asset_JS_ . 'cleditor/jquery.cleditor.min')));
    }

    function about() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo json_encode(array('msgType' => 'success', 'width' => 600, 'height' => 420, 'title' => 'Tentang Aplikasi', 'msgValue' => $this->load->view('home/about', '', TRUE)));
        }
    }

    function sukses() {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/sukses';
        $template_bottom = 'templates/responsive/footer';
        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }
}
