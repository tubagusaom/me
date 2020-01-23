<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persiapan extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('vsurat_tugas');
		$this->load->model('vst_askom');
	}

	function index(){
		$st_asesor = $this->vst_askom->st_asesor();

		$template_header = 'templates/responsive/header';
		$template_body = 'templates/responsive/asesor/st_asesor';
		$template_bottom = 'templates/responsive/footer_home';

		$this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
		$this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'st_asesor' => $st_asesor));
		$this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
	}

	function surat_tugas(){

		$id = $this->auth->get_user_data()->pegawai_id;
		$surat_tugas_asesor = $this->vsurat_tugas->surat_tugas($id);

		// var_dump($surat_tugas_asesor);die();

		$template_header = 'templates/responsive/header';
		$template_body = 'templates/responsive/asesor/surat_tugas';
		$template_bottom = 'templates/responsive/footer_home';

		$this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
		$this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'surat_tugas_asesor' => $surat_tugas_asesor));
		$this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));

	}

}
