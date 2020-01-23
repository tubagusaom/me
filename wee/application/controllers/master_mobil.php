<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_mobil extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Master_mobil_model');
	}

	function index() {
			$this->load->library('grid');

			$grid = $this->grid->set_properties(array('model' => 'Master_mobil_model', 'controller' => 'master_mobil', 'options' => array('id' => 'master_mobil', 'pagination', 'rownumber')))->load_model()->set_grid();

			$view = $this->load->view('master_mobil/index', array('grid' => $grid), true);

			echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
	}

	function datagrid() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
					$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
					$page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
					$offset = $row * ($page - 1);

					// if (isset($_POST['master_mobil']) && !empty($_POST['master_mobil'])) {
					// 		$where['master_mobil LIKE'] = '%' . $this->input->post('master_mobil') . '%';
					// }

					$data = array();
					$params = array('_return' => 'data');
					if (isset($where))
							$params['_where'] = $where;
					$data['total'] = isset($where) ? $this->Master_mobil_model->count_by($where) : $this->Master_mobil_model->count_all();
					$this->Master_mobil_model->limit($row, $offset);
					$order = $this->Master_mobil_model->get_params('_order');

					$rows = $this->Master_mobil_model->set_params($params)->with(array('tahun_mobil','merek_mobil','model_mobil','transmisi_mobil'));
					$data['rows'] = $this->Master_mobil_model->get_selected()->data_formatter($rows);
					echo json_encode($data);
			}
			else
			{
					block_access_method();
			}
	}

	function add() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$data = $this->Master_mobil_model->set_validation()->validate();
					if ($data !== false) {
							if ($this->Master_mobil_model->check_unique($data)) {
									if ($this->Master_mobil_model->insert($data) !== false) {
											echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
									} else {
											echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
									}
							} else {
									echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Master_mobil_model->get_validation())));
							}
					} else {
							echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
					}
			} else {
				$this->load->library('combogrid');
				$tahun_grid 		= $this->combogrid->set_properties(array('model'=>'Tahun_mobil_model', 'controller'=>'Tahun_mobil', 'fields'=>array('tahun_mobil'), 'options'=>array('id'=>'id_tahun', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'tahun_mobil', 'panelWidth'=>400)))->load_model()->set_grid();
				$merek_grid 		= $this->combogrid->set_properties(array('model'=>'Merek_mobil_model', 'controller'=>'Merek_mobil', 'fields'=>array('merek_mobil'), 'options'=>array('id'=>'id_merek', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'merek_mobil', 'panelWidth'=>400)))->load_model()->set_grid();
				$model_grid 		= $this->combogrid->set_properties(array('model'=>'Model_mobil_model', 'controller'=>'Model_mobil', 'fields'=>array('model_mobil'), 'options'=>array('id'=>'id_model', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'model_mobil', 'panelWidth'=>400)))->load_model()->set_grid();
				$transmisi_grid = $this->combogrid->set_properties(array('model'=>'Transmisi_mobil_model', 'controller'=>'Transmisi_mobil', 'fields'=>array('transmisi_mobil'), 'options'=>array('id'=>'id_transmisi', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'transmisi_mobil', 'panelWidth'=>400)))->load_model()->set_grid();

				echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('master_mobil/add',array('tahun_grid'=>$tahun_grid,'merek_grid'=>$merek_grid,'model_grid'=>$model_grid,'transmisi_grid'=>$transmisi_grid), TRUE)));
			}
	}

	function edit($id = false) {
			if (!$id) {
					data_not_found();
					exit;
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$data = $this->Master_mobil_model->set_validation()->validate();
					if ($data !== false) {
							if ($this->Master_mobil_model->check_unique($data, intval($id))) {
									if ($this->Master_mobil_model->update(intval($id), $data) !== false) {
											echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
									} else {
											echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
									}
							} else {
									echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Master_mobil_model->get_validation())));
							}
					} else {
							echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
					}
			} else {
					$value = $this->Master_mobil_model->get(intval($id));
					if (sizeof($value) == 1) {

							$this->load->library('combogrid');
							$merek_grid = $this->combogrid->set_properties(array('model'=>'Merek_mobil_model', 'controller'=>'Merek_mobil', 'fields'=>array('merek_mobil'), 'options'=>array('id'=>'id_merek', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'merek_mobil', 'panelWidth'=>400)))->load_model()->set_grid();

							$view = $this->load->view('master_mobil/edit', array('merek_grid'=>$merek_grid,'data' => $this->Master_mobil_model->get_single($value)), TRUE);
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
					$roles = $this->Master_mobil_model->get(intval($id));
					if (sizeof($roles) == 1) {
							if ($this->Master_mobil_model->delete(intval($id))) {
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
					echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('master_mobil/search', '', TRUE)));
			} else {
					block_access_method();
			}
	}

}
