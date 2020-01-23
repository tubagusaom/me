<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Detail_kendaraan_member extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Detail_kendaraan_member_model');
    }

    // function index() {
    //     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //         $this->load->library('grid');
    //         $grid = $this->grid->set_properties(array('model' => 'Detail_kendaraan_Detail_kendaraan_member_model', 'controller' => 'detail_kendaraan_member', 'options' => array('id' => 'detail_kendaraan_member', 'pagination', 'rows_number')))->load_model()->set_grid();
    //         $view = $this->load->view('detail_kendaraan_member/index', array('grid' => $grid), true);
    //         echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    //     } else {
    //         block_access_method();
    //     }
    // }
		//
		// function datagrid() {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST')
    //     {
    //         $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
    //         $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
    //         $offset = $row * ($page - 1);
		//
		// 				if (isset($_POST['nama_member']) && !empty($_POST['nama_member'])) {
    //             $where['nama_member LIKE'] = '%' . $this->input->post('nama_member') . '%';
    //         }
		//
    //         $data = array();
    //         // $where['status_member'] = '2';
    //         $params = array('_return' => 'data');
    //         if (isset($where))
    //             $params['_where'] = $where;
    //         $data['total'] = isset($where) ? $this->Detail_kendaraan_Detail_kendaraan_member_model->count_by($where) : $this->Detail_kendaraan_Detail_kendaraan_member_model->count_all();
    //         $this->Detail_kendaraan_Detail_kendaraan_member_model->limit($row, $offset);
    //         $order = $this->Detail_kendaraan_Detail_kendaraan_member_model->get_params('_order');
		//
		// 				$rows = $this->Detail_kendaraan_Detail_kendaraan_member_model->set_params($params)->with(array('nama_member','nama'));
		// 				$data['rows'] = $this->Detail_kendaraan_Detail_kendaraan_member_model->get_selected()->data_formatter($rows);
		// 				echo json_encode($data);
    //     }
    //     else
    //     {
    //         block_access_method();
    //     }
    // }

		function combogrid() {
			$this->load->model('v_detail_kendaraan_model');
			$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
			$page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
			$offset = $row * ($page - 1);
			$data = array();
			$params = array('_return' => 'data');

			if (isset($_POST['q'])) {
					$where['nama_member LIKE'] = "%" . $this->input->post('q') . "%";
			}

			$where['status_member'] = "2";

			if (isset($where))
					$params['_where'] = $where;
			$data['total'] = isset($where) ? $this->v_detail_kendaraan_model->count_by($where) : $this->v_detail_kendaraan_model->count_all();
			$this->v_detail_kendaraan_model->limit($row, $offset);
			$order_criteria = "ASC";
			$_order_escape = TRUE;
			if ($id) {
					$order = "FIELD(id, " . intval($id) . ")";
					$order_criteria = "DESC";
					$_order_escape = FALSE;
			} else {
					$order = $this->v_detail_kendaraan_model->get_params('_order');
			}
			$rows = isset($where) ? $this->v_detail_kendaraan_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->v_detail_kendaraan_model->order_by($order, $order_criteria, $_order_escape)->get_all();
			$data['rows'] = $this->v_detail_kendaraan_model->get_selected()->data_formatter($rows);
			echo json_encode($data);
		}


}
