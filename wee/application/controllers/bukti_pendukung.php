<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bukti_pendukung extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function upload() {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/bukti_pendukung/upload';
        $template_bottom = 'templates/responsive/footer';

        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function add() {
        if (isset($_FILES['nama_file']['tmp_name']) && !empty($_FILES['nama_file']['tmp_name'])) {
            $data['nama_file'] = time() . str_replace(' ', '_', $_FILES['nama_file']['name']);

            $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/asesi/';

            $config['allowed_types'] = '*';
            $config['max_size'] = 21480 ;
            $config['file_name'] = $data['nama_file'];

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('nama_file')) {
                echo"gagal update";
            } else {
                $data_upload = $this->upload->data();
                $data['file_size'] = round(($data_upload['file_size'] / 1024), 2) . ' MB';
                $data['extension'] = str_replace('.', '', $data_upload['file_ext']);
                $data['id_asesi'] = $this->id;
                $data['nama_file'] = $config['file_name'];
                $data['jenis_portofolio'] = $this->input->post('jenis_portofolio');
                $data['nama_dokumen'] = $this->input->post('nama_dokumen');
                $data['description'] = $this->input->post('description');
                $data['bukti_tambahan'] = '1';


                if($this->db->insert('t_repositori', $data)){
                    $this->db->where('id_users', $this->id);
                    $query_asesi = $this->db->get(kode_tbl().'asesi')->row();
                    //var_dump($query_asesi);die();
                    $edcba = $query_asesi->status_permohonan;  
                    $subject = 'Perbaikan data asesi';
                    $pesan = 'Asesi atas nama '.$query_asesi->nama_lengkap.' telah melakukan perbaikan';
                    $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
                    //$mail = $admin->email;
                    //var_dump($edcba);die();
                    //if($edcba == '2'){
                    $array_status = array('status_permohonan' => '4');
                    $this->db->where('id', $query_asesi->id);
                    $this->db->update(kode_tbl().'asesi', $array_status); 
                    $post = '{"personalizations": [{"to": [{"email": "sertifikasi@jmkp.co.id"}],"subject": "Perbaikan Dokumen"}],"from": {"email": "info@jlspp2kptk2-barat.org"},"content": [{"type": "text/plain","value": "'.$pesan.'"}]}';
                        //sendgrid_api_text('https://api.sendgrid.com/v3/mail/send',$post);
        
//                        if()){
//                            kirim_email_gmail($pesan, $mail, $mail, $subject);
//                        }
                        
                    //}
                    redirect('bukti_pendukung/index');
                }
                //redirect('bukti_pendukung/index');
            }
        }
    }

    function index() {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/bukti_pendukung/index';
        $template_bottom = 'templates/responsive/footer';
        $this->load->model('bukti_pendukung_model');

        $bukti_pendukung = $this->bukti_pendukung_model->bukti_pendukung($this->id);
        //var_dump($bukti_pendukung);die();
        $id_asesi = $this->auth->get_user_data()->pegawai_id ;
        $this->db->where('id',$id_asesi);
        $row_asesi = $this->db->get(kode_tbl().'asesi')->row();
        $bukti_dasar =json_decode(str_replace('|','"', $row_asesi->bukti_pendukung));
        //var_dump($row_asesi->bukti_pendukung);die();
        //die();


        $dtjenis['0'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 0));
        $dtjenis['1'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 1));
        $dtjenis['2'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 2));
        $dtjenis['3'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 3));
        $dtjenis['4'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 4));
        $dtjenis['5'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 5));
        $dtjenis['6'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 6));
        $dtjenis['7'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 7));
        $dtjenis['8'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 8));
        $dtjenis['9'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 9));
        $dtjenis['10'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 10));
        $dtjenis['11'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 11));
        $dtjenis['12'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 12));
       // var_dump($dtjenis['11'] );die();
        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'bukti_pendukung' => $bukti_pendukung, 'jns_portofolio' => $dtjenis,'bukti_dasar'=>$bukti_dasar));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function jenis() {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/bukti_pendukung/jenis';
        $template_bottom = 'templates/responsive/footer';

        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function hapus($id = false) {
        if (!$id) {
            redirect(base_url() . 'bukti_pendukung/index');
        } else {
            $this->db->where('id_asesi', $this->id);
            $this->db->where('id', $id);
            $this->db->delete('t_repositori');
            redirect(base_url() . 'bukti_pendukung/index');
        }
    }

    function edit()
    {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $jenis = $this->input->post('jenis_portofolio');
          $nama = $this->input->post('nama_dokumen');
          $file = $this->input->post('nama_file');
          $id_users = $this->input->post('id_users');
          $size = $this->input->post('size');

          $insert  = array(
                      'jenis_portofolio' => $jenis,
                      'nama_dokumen' => $nama,
                      'nama_file' => $file,
                      'id_asesi' => $id_users,
                      'file_size' => $size
                    );
          if ($this->db->insert('t_repositori', $insert)) {
              redirect('home');
          }else {
            redirect('profil');
          }
      }
    }

}
