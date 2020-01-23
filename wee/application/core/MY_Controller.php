<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $controller;
    protected $method;
    protected $isLogin;
    protected $totalPengunjung;

    //public $kode_tbl = 'tbl3133_';
    function __construct() {
        parent::__construct();

        $this->load->library('acl');
        $this->load->model('user_model');

        $data = array();

        /* tangkap nama controller class yang sedang diakses */
        $this->controller = $this->router->fetch_class();

        /* jika method kosong isi dengan index */
        $this->method = empty($this->router->fetch_method()) ? 'index' : $this->router->fetch_method();

        $role = intval($this->auth->get_role_id());

        $data['controller_name'] = $this->controller;
        $data['method_name'] = $this->method;
        $data['role_id'] = $role;

        if (is_ajax_request()) {
            $data['request_method'] = 1;
        } else {
            $data['request_method'] = 2;
        }
        if (!$this->acl->check_permission($data)) {
            if ($this->controller == 'users' && $this->method == 'login' && $this->auth->get_role_id() > 1) {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Anda sudah login menggunakan username ' . $this->auth->get_username()));
                exit;
            } else {
                block_access_method();
            }
        }
        if ($this->auth->is_logged_in()) {
            $this->aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();
            $this->id = $this->auth->get_user_data()->id;
            $this->id_asesi = $this->auth->get_user_data()->pegawai_id;
            $this->asesi = $this->user_model->get_idasesi($this->id);
            $this->jenis_user = $this->auth->get_user_data()->jenis_user;

            $this->db->where('reciepent_id', $this->id);
            $this->db->where('status_read_recepient', '0');
            $this->db->where('parent_id', '0');
            $pesan = $this->db->get('t_pesan')->result();
            $this->unread_message = count($pesan);
            $this->load->library('menus');
            $this->menus = $this->menus->display_menu();

            $this->db->where('reciepent_id', $this->id);
            $this->db->where('status_read_recepient', '0');
            $this->query_pesan_unread = $this->db->get('t_pesan')->result();

            $this->db->where('reciepent_id', $this->id);
            $this->query_pesan = $this->db->get('t_pesan')->result();
        } else {
            $this->aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();
            $this->load->helper('cookie');
             $check_visitor = get_cookie("docars");
             $ip = $this->input->ip_address();
             if ($check_visitor == false) {
                $db = array(
                    "ip"  => $ip,
                    "waktu" => date('h:i:s'),
                    "tanggal" => date('Y-m-d'),
                );
                setcookie('docars',$ip,time()+86500,'/');
                $this->db->insert('t_counter',$db);
             }
             $pengunjungHariIni = count($this->db->where('tanggal',date('Y-m-d'))->get('t_counter')->result());
             //$pengunjungHariIni = $this->db->count('t_counter');
             $global_data = array('totalPengunjung'=>$this->db->count_all('t_counter'),'pengunjungHariIni'=>$pengunjungHariIni);

         //Send the data into the current view
         //http://ellislab.com/codeigniter/user-guide/libraries/loader.html
         $this->load->vars($global_data);
            // $this->totalPengunjung = $this->db->count_all('t_counter');
        }
    }

    public function upload_image($param = "", $filename = "") {
        $config['upload_path'] = './assets/files/asesi/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size'] = 10048;
        $config['max_width'] = 8288;
        $config['max_height'] = 5068;
        $config['file_name'] = $filename;
        $config['remove_spaces'] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($param)) {
            $error = array('error' => $this->upload->display_errors());

            $result = json_encode($error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $result = json_encode($data);
        }

        return $result;
    }

    public function upload_file($param = "", $filename = "") {
        $configFile['upload_path'] = './assets/files/asesi/';
        $configFile['allowed_types'] = 'rtf|doc|docx|xls|xlsx|pdf|gif|jpg|png|jpeg|bmp';
        $configFile['max_size'] = 50000 * 1024;
        $configFile['file_name'] = $filename;
        $configFile['remove_spaces'] = FALSE;

        $this->upload->initialize($configFile);

        if (!$this->upload->do_upload($param)) {
            $error = array('error' => $this->upload->display_errors());

            $result = json_encode($error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $result = json_encode($data);
        }

        return $result;
    }

    public function upload_allfile($param = "", $filename = "") {
        $configFile['upload_path'] = './assets/files/asesi/';
        $configFile['allowed_types'] = 'rtf|doc|docx|xls|xlsx|ppt|pptx|pdf|gif|jpg|png|jpeg|bmp|avi|flv|wmv|mp3|mp4';
        //rtf|doc|docx|xls|xlsx|ppt|pptx|pdf|gif|jpg|png|jpeg|bmp|avi|flv|wmv|mp3|mp4
        $configFile['max_size'] = 10 * 1024;
        $configFile['file_name'] = $filename;
        $configFile['remove_spaces'] = TRUE;

        $this->upload->initialize($configFile);

        if (!$this->upload->do_upload($param)) {
            $error = array('error' => $this->upload->display_errors());

            $result = json_encode($error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $result = json_encode($data);
        }
        //var_dump($result);
        return $result;
    }


}
