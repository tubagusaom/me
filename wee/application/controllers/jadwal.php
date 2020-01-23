<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('jadwal_model');
    }

    function index() {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/jadwal/index';
        $template_bottom = 'templates/responsive/footer';
        $list_jadwal = $this->jadwal_model->list_jadwal();
        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'list_jadwal' => $list_jadwal));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function registrasi($id = "") {
        $this->load->model('profil_model');
        $biodata = $this->profil_model->biodata($this->id);
        if($biodata->no_identitas==""){
            //alert('test');
            $this->session->set_flashdata('result', 'Pendaftaran Gagal, Lengkapi Biodata, Pekerjaan dan Upload Bukti Pendukung terlebih dahulu');
                $this->session->set_flashdata('mode_alert', 'warning');
            redirect('profil/index');
        }else{
            $list_pekerjaan = $this->jadwal_model->list_pekerjaan();
            $data['data_pekerjaan'] = $list_pekerjaan;
            if(count($list_pekerjaan) > 0){
        //var_dump($biodata);

        $template_header = 'templates/responsive/header';
        if ($id == "") {
            $template_body = 'templates/responsive/jadwal/registrasi_baru';
        } else {
            $template_body = 'templates/responsive/jadwal/registrasi';
            $data['id'] = $id;
        }

        $template_bottom = 'templates/responsive/footer';
        $row_jadwal = $this->jadwal_model->row_jadwal($id);
        $row_skema = $this->jadwal_model->row_skema();

        $row_jadwal_combo = $this->jadwal_model->row_jadwal_combo();
        $data['row_jadwal_combo'] = $row_jadwal_combo;
        $data['row_skema'] = $row_skema;

        
        $data['biodata'] = $biodata;
        $data['row_jadwal'] = $row_jadwal;
        $data['aplikasi'] = $this->aplikasi;
        
        


        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, $data);
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }else{
        $this->session->set_flashdata('result', 'Pendaftaran Gagal, Lengkapi Data Pekerjaan terlebih dahulu');
                $this->session->set_flashdata('mode_alert', 'warning');
        redirect('profil/pekerjaan');
    }
    }
    }

    function add() {
        //$skema = $this->input->post('skema_sertifikasi');
        $jadwal = $this->input->post('id_jadwal');
        $metode_bayar = $this->input->post('metode_bayar');
        $tujuan_asesmen = $this->input->post('tujuan_asesmen');

        $id = $this->id;
        $asesi = kode_tbl() . 'asesi';
        $this->db->where('id_users', $id);
        $this->db->where('jadwal_id', $jadwal);
        $query_jadwal = $this->db->get(kode_tbl() . 'asesi')->result();
        if (count($query_jadwal) > 0) {
            $this->session->set_flashdata('result', 'Pendaftaran Gagal, anda sudah terdaftar di jadwal ini');
            $this->session->set_flashdata('mode_alert', 'warning');
            redirect('home/sukses');
        } else {
            $this->db->select('id_skema');
            $this->db->where('id',$jadwal);
            $get_skema = $this->db->get(kode_tbl().'jadual_asesmen')->row();
            $skema = $get_skema->id_skema;
            $query = $this->db->query("INSERT INTO $asesi(skema_sertifikasi,jadwal_id,nama_lengkap,created_when,id_users,metode_bayar,tujuan_asesmen) SELECT $skema,$jadwal,nama_user,NOW(),$id,$metode_bayar,$tujuan_asesmen FROM t_users WHERE id=$id");
            if ($query) {
                $id = $this->db->insert_id();
                $array_update_users = array('id_asesi'=>$id);
                $this->db->where('id',$this->id);
                $this->db->update('t_users',$array_update_users);
                redirect('sertifikasi/detail/' . $id);
            } else {
                $this->session->set_flashdata('result', 'Pendaftaran Gagal, anda sudah terdaftar di jadwal ini');
                $this->session->set_flashdata('mode_alert', 'warning');
                redirect('home/sukses');
            }
        }
    }

    function riwayat_sertifikasi() {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/jadwal/index';
        $template_bottom = 'templates/responsive/footer';
        $list_jadwal = $this->jadwal_model->list_jadwal();
        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'list_jadwal' => $list_jadwal));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

}
