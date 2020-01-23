<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class laporan_pelelangan extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Laporan_pelelangan_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model'=>'Laporan_pelelangan_model', 'controller'=>'laporan_pelelangan', 'options'=>array('id'=>'laporan_pelelangan', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('laporan_pelelangan/index', array('grid' => $grid), true);
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
            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Laporan_pelelangan_model->count_by($where) : $this->Laporan_pelelangan_model->count_all();
            $this->Laporan_pelelangan_model->limit($row, $offset);
            $order = $this->Laporan_pelelangan_model->get_params('_order');
            $rows = isset($where) ? $this->Laporan_pelelangan_model->order_by($order)->get_many_by($where) : $this->Laporan_pelelangan_model->order_by($order)->get_all();
            $data['rows'] = $this->Laporan_pelelangan_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

	function cetak($id, $type = "pdf") {

      //   error_reporting(E_ALL);
      // ini_set('display_errors', TRUE);
      // ini_set('display_startup_errors', TRUE);
        
        $data['konfigurasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->load->model('Laporan_pelelangan_model');
        $data['laporan'] = $this->db->get('v_laporan')->result();

        $view = $this->load->view('laporan_pelelangan/cetak', $data, true);
        if ($type == "pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "Laporan_pelelangan" . date('YmdHis') . ".pdf", false, true, 'L');
        }
    }


}
