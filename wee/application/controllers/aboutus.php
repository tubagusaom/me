<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Aboutus extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('artikel_model');
    }
	function index($id) {
		$this->load->model('welcome_model');

		$data['data'] = $this->artikel_model->detail($id);
		$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();

		$data['pengunjung'] = $this->welcome_model->dataPengunjung();
		$data['total'] = $this->welcome_model->totalPengunjung();

		$data['marquee'] = $this->artikel_model->marquee();
		$data['menu_profil'] = $this->artikel_model->menu();
		//var_dump($data['berita_lainnya']);
		//die();
		$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
	    $this->load->view('templates/bootstraps/header',$data);
	    $this->load->view('profile/index',$data);
	    $this->load->view('templates/bootstraps/bottom');
	}
}
