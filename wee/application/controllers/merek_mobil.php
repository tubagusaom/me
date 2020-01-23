<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merek_mobil extends MY_Controller {

	function __construct()
	{
		parent::__construct();

        $this->load->model('Merek_mobil_model');
				$this->load->model('V_merek_tahun_model');
	}

    function index() {
        $this->load->library('grid');

        $grid = $this->grid->set_properties(array('model' => 'V_merek_tahun_model', 'controller' => 'merek_mobil', 'options' => array('id' => 'merek_mobil', 'pagination', 'rownumber')))->load_model()->set_grid();

        $view = $this->load->view('merek_mobil/index', array('grid' => $grid), true);

        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);

						if (isset($_POST['mt']) && !empty($_POST['mt'])) {
                $where['mt LIKE'] = '%' . $this->input->post('mt') . '%';
            }

            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->V_merek_tahun_model->count_by($where) : $this->V_merek_tahun_model->count_all();
            $this->V_merek_tahun_model->limit($row, $offset);
            $order = $this->V_merek_tahun_model->get_params('_order');

						$rows = $this->V_merek_tahun_model->set_params($params)->with(array('tahun_mobil'));
						$data['rows'] = $this->V_merek_tahun_model->get_selected()->data_formatter($rows);
						echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Merek_mobil_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Merek_mobil_model->check_unique($data)) {
                    if ($this->Merek_mobil_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Merek_mobil_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
						$this->load->library('combogrid');
						$tahun_grid = $this->combogrid->set_properties(array('model'=>'Tahun_mobil_model', 'controller'=>'Tahun_mobil', 'fields'=>array('tahun_mobil'), 'options'=>array('id'=>'id_tahun', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'tahun_mobil', 'panelWidth'=>400)))->load_model()->set_grid();

						echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('merek_mobil/add',array('tahun_grid'=>$tahun_grid), TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Merek_mobil_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Merek_mobil_model->check_unique($data, intval($id))) {
                    if ($this->Merek_mobil_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Merek_mobil_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $value = $this->Merek_mobil_model->get(intval($id));
            if (sizeof($value) == 1) {

								$this->load->library('combogrid');
								$tahun_grid = $this->combogrid->set_properties(array('model'=>'Tahun_mobil_model', 'controller'=>'Tahun_mobil', 'fields'=>array('tahun_mobil'), 'options'=>array('id'=>'id_tahun', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'tahun_mobil', 'panelWidth'=>400)))->load_model()->set_grid();

                $view = $this->load->view('merek_mobil/edit', array('data' => $this->Merek_mobil_model->get_single($value), 'tahun_grid' => $tahun_grid), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->Merek_mobil_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Merek_mobil_model->delete(intval($id))) {
                    echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil dihapus'));
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak berhasil dihapus !'));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        } else {
            block_access_method();
        }
    }

		function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('merek_mobil/search', '', TRUE)));
        } else {
            block_access_method();
        }
    }

		function combogrid($id = false) {
        $this->load->model('V_merek_tahun_model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
        $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return' => 'data');
        if (isset($_POST['q'])) {
            $where['mt LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if (isset($where))
            $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->V_merek_tahun_model->count_by($where) : $this->V_merek_tahun_model->count_all();
        $this->V_merek_tahun_model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if ($id) {
            $order = "FIELD(id, " . intval($id) . " )";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        } else {
            $order = $this->V_merek_tahun_model->get_params('_order');
        }
        $rows = isset($where) ? $this->V_merek_tahun_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->V_merek_tahun_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->V_merek_tahun_model->get_selected()->data_formatter($rows);
        echo json_encode($data);
    }

}
