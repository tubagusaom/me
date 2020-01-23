<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Kontak extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('artikel_model');
				$this->load->model('welcome_model');
    }
	function index() {
			$data_header['marquee'] = $this->artikel_model->marquee();
			$data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
			$data_header['berita_lainnya'] = $this->artikel_model->berita_lainnya();
			$data_header['menu_profil'] = $this->artikel_model->menu();
			
			$data['pengunjung'] = $this->welcome_model->dataPengunjung();
			$data['total'] = $this->welcome_model->totalPengunjung();
			$data['rst'] = array();

	    $this->load->view('templates/bootstraps/header',$data_header);
	    $this->load->view('kontak/index',$data_header);
	    $this->load->view('templates/bootstraps/bottom',$data);
	}
}
