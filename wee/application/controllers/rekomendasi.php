<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Rekomendasi extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Rekomendasi_model');
        $this->load->model('V_detail_kendaraan_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model'=>'V_detail_kendaraan_model', 'controller'=>'rekomendasi', 'options'=>array('id'=>'rekomendasi', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('rekomendasi/index', array('grid' => $grid), true);
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

						// if (isset($_POST['nama_member']) && !empty($_POST['nama_member'])) {
            //     $where['nama_member LIKE'] = '%' . $this->input->post('nama_member') . '%';
            // }

            $data = array();
            $where['status_member'] = '2';

            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->V_detail_kendaraan_model->count_by($where) : $this->V_detail_kendaraan_model->count_all();
            $this->V_detail_kendaraan_model->limit($row, $offset);
            $order = $this->V_detail_kendaraan_model->get_params('_order');

						$rows = $this->V_detail_kendaraan_model->set_params($params)->with(array('nama_member','nama'));
						$data['rows'] = $this->V_detail_kendaraan_model->get_selected()->data_formatter($rows);
						echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Rekomendasi_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Rekomendasi_model->check_unique($data, intval($id))) {
                    if ($this->Rekomendasi_model->update(intval($id), $data) !== false) {

                      $this->db->where('id_detail_kendaraan',$id);
                      $komponen= $this->db->get(kode_tbl().'komponen_member')->result_array();
                      $st = $this->input->post('st');

                      if ($st != "" ) {
                        foreach($komponen as $key=>$value){
                          if(isset($st[$value['id']])){
                            if ($value['id_jenis'] == "6") {
                              $status_tampil = '2';
                            }else {
                              $status_tampil = '1';
                            }
                          }else{
                              $status_tampil = '0';
                          }

                          $data_update = array(
                            'status_tampil' => $status_tampil,
                          );

                          $this->db->where('id', $value['id']);
                          $this->db->update(kode_tbl().'komponen_member', $data_update);
                        }
                      }


                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Rekomendasi_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $kendaraan = $this->Rekomendasi_model->get(intval($id));

            if (sizeof($kendaraan) == 1) {

                $data = $this->Rekomendasi_model->get_single($kendaraan);

                $detail_kendaraan = $this->Rekomendasi_model->detail_kendaraan($id);
                $data_kendaraan = $this->Rekomendasi_model->dokumen_member($id);
                $jenis_komponen = $this->Rekomendasi_model->jenis_komponen($id);

                // var_dump($data); die();

                $view = $this->load->view('rekomendasi/edit',
                    array(
                        'data' => $data,
                        'data_kendaraan' => $data_kendaraan,
                        'detail_kendaraan' => $detail_kendaraan,
                        'jenis_komponen' => $jenis_komponen,
                    ),
                    TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !' ));
            }
        }
    }

    function show_file() {
        $nmfile = $this->input->get('nmfile');
        $data['extension'] = strtolower(substr($nmfile, -3));
        $data['nmfile'] = $nmfile;
        $this->load->view('rekomendasi/view_image', $data);
    }

  //   function show_file() {
  //   $nmfile = $this->input->get('nmfile');
  //   $extension = strtolower(substr($nmfile, -3));
  //   switch ($extension) {
  //       case "pdf":
  //       echo '<object type="application/pdf" data="' . base_url('assets/files/member/' . $nmfile) . '" width="100%" height="600" style="height: 85vh;">No Support</object>';
  //       break;
  //       default:
  //       echo "<img src='" . base_url('assets/files/member/' . $nmfile) . "' />";
  //       break;
  //   }
  // }


}
