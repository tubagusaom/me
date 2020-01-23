<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dokumen_tambahan extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dokumen_tambahan_model');
    }
    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'dokumen_tambahan_model', 'controller' => 'dokumen_tambahan', 'options' => array('id' => 'dokumen_tambahan', 'pagination', 'rows_number')))->load_model()->set_grid();
            $view = $this->load->view('dokumen_tambahan/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            $data = array();
            $params = array('_return' => 'data');
            
            $where['id_asesi ='] = $this->id_asesi;
            
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->dokumen_tambahan_model->count_by($where) : $this->dokumen_tambahan_model->count_all();
            $this->dokumen_tambahan_model->limit($row, $offset);
            $order = $this->dokumen_tambahan_model->get_params('_order');
            //$rows = isset($where) ? $this->dokumen_tambahan_model->order_by($order)->get_many_by($where) : $this->dokumen_tambahan_model->order_by($order)->get_all();
            $rows = $this->dokumen_tambahan_model->set_params($params)->with(array('asesi'));
            $data['rows'] = $this->dokumen_tambahan_model->get_selected()->data_formatter($rows);

            echo json_encode($data);
        } else {
            block_access_method();
        }
    }
    
    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->dokumen_tambahan_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->dokumen_tambahan_model->check_unique($data)) {
                    if ($this->dokumen_tambahan_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->dokumen_tambahan_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('asesi_model');
            $this->load->model('skema_model');            
            //$asesi = $this->asesi_model->dropdown('id', 'nama_lengkap');  
			$jenis_dok = array(
                                '0' => 'Foto'
                                ,'1' => 'Kartu Pelajar'
                                ,'2' => 'Raport'
                                ,'3' => 'Sertifikat Pelatihan'
                                ,'4' => 'Penghargaan'
                                ,'5' => 'Tugas / Pra Karya'
                                ,'6' => 'Lain-lain'        
			);
            $view = $this->load->view('dokumen_tambahan/add', array('asesi' => $asesi, 'jenis_dok' => $jenis_dok,'url' => base_url() . 'dokumen_tambahan/upload'), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }    
    
    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->dokumen_tambahan_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->dokumen_tambahan_model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['file'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/dokumen_tambahan/';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = '512000000';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    } else {
						$data['file'] = "";
					}
					
					if(isset($data['file'])){
					
		                if ($this->db->insert('t_dokumen_tambahan',$data) !== false) {
		                    echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data Berhasil Disimpan !'));
		                } else {
		                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
		                }					
					
					}else{
						echo json_encode(array('msgType' => 'error', 'msgValue' => 'File Gagal di Upload!'));					
					}
                    
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->dokumen_tambahan_model->get_validation()))));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }    
}
