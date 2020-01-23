<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transmisi_mobil extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('Transmisi_mobil_model');
				$this->load->model('v_transmisi_mobil');
	}

    function index() {
        $this->load->library('grid');

        $grid = $this->grid->set_properties(array('model' => 'v_transmisi_mobil', 'controller' => 'transmisi_mobil', 'options' => array('id' => 'transmisi_mobil', 'pagination', 'rownumber')))->load_model()->set_grid();

        $view = $this->load->view('transmisi_mobil/index', array('grid' => $grid), true);

        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);

						if (isset($_POST['transmisi_mobil']) && !empty($_POST['transmisi_mobil'])) {
                $where['transmisi_mobil LIKE'] = '%' . $this->input->post('transmisi_mobil') . '%';
            }

            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->v_transmisi_mobil->count_by($where) : $this->v_transmisi_mobil->count_all();
            $this->v_transmisi_mobil->limit($row, $offset);
            $order = $this->v_transmisi_mobil->get_params('_order');

						$rows = isset($where) ? $this->v_transmisi_mobil->order_by($order)->get_many_by($where) : $this->v_transmisi_mobil->order_by($order)->get_all();
            $data['rows'] = $this->v_transmisi_mobil->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Transmisi_mobil_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Transmisi_mobil_model->check_unique($data)) {
                    if ($this->Transmisi_mobil_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Transmisi_mobil_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {

						$this->load->library('combogrid');
						$model_grid = $this->combogrid->set_properties(array('model'=>'V_model_mobil', 'controller'=>'Model_mobil', 'fields'=>array('merek_mobil_model', 'model_mobil_model', 'tahun_mobil_model'), 'options'=>array('id'=>'id_model', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'mmt', 'panelWidth'=>600)))->load_model()->set_grid();

						echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('transmisi_mobil/add',array('model_grid'=>$model_grid), TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Transmisi_mobil_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Transmisi_mobil_model->check_unique($data, intval($id))) {
                    if ($this->Transmisi_mobil_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Transmisi_mobil_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $value = $this->Transmisi_mobil_model->get(intval($id));
            if (sizeof($value) == 1) {

								$this->load->library('combogrid');
								$model_grid = $this->combogrid->set_properties(array('model'=>'V_model_mobil', 'controller'=>'Model_mobil', 'fields'=>array('merek_mobil_model', 'model_mobil_model', 'tahun_mobil_model'), 'options'=>array('id'=>'id_model', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'mmt', 'panelWidth'=>600)))->load_model()->set_grid();

								$view = $this->load->view('transmisi_mobil/edit', array('data' => $this->Transmisi_mobil_model->get_single($value), 'model_grid' => $model_grid), TRUE);
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
            $roles = $this->Transmisi_mobil_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Transmisi_mobil_model->delete(intval($id))) {
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
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('transmisi_mobil/search', '', TRUE)));
        } else {
            block_access_method();
        }
    }

		function combogrid($id = false) {
        $this->load->model('Transmisi_mobil_model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
        $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return' => 'data');
        if (isset($_POST['q'])) {
            $where['transmisi_mobil LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if (isset($where))
            $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->Transmisi_mobil_model->count_by($where) : $this->Transmisi_mobil_model->count_all();
        $this->Transmisi_mobil_model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if ($id) {
            $order = "FIELD(id, " . intval($id) . ")";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        } else {
            $order = $this->Transmisi_mobil_model->get_params('_order');
        }
        $rows = isset($where) ? $this->Transmisi_mobil_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->Transmisi_mobil_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->Transmisi_mobil_model->get_selected()->data_formatter($rows);
        echo json_encode($data);
    }

}
