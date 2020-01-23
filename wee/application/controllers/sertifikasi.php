<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sertifikasi extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('artikel_model');
        $this->load->model('Sertifikasi_Model');
				$this->load->model('welcome_model');
        $this->load->library('pagination');
    }
	function index($id) {
		$data['data'] = $this->artikel_model->detail($id);
		$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
		//var_dump($data['berita_lainnya']);
		//die();
		$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
	    $this->load->view('templates/bootstraps/header',$data);
	    $this->load->view('sertifikasi/index',$data);
	    $this->load->view('templates/bootstraps/bottom');
	}
    function facebook(){
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

        $this->load->view('templates/bootstraps/header',$data);
        $this->load->view('sertifikasi/vfacebook');
        $this->load->view('templates/bootstraps/bottom');       }
    function faq(){
        $data['marquee'] = $this->artikel_model->marquee();
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
				$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
        $data['faq'] = $this->db->get('t_faq')->result();
				$data['menu_profil'] = $this->artikel_model->menu();

				$data['pengunjung'] = $this->welcome_model->dataPengunjung();
				$data['total'] = $this->welcome_model->totalPengunjung();
				$data['rst'] = array();

        $this->load->view('templates/bootstraps/header',$data);
        $this->load->view('sertifikasi/vfaq',$data);
        $this->load->view('templates/bootstraps/bottom');
		}
    function detail_faq($id){
        $data['marquee'] = $this->artikel_model->marquee();
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
				$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
				$data['menu_profil'] = $this->artikel_model->menu();

				$data['pengunjung'] = $this->welcome_model->dataPengunjung();
				$data['total'] = $this->welcome_model->totalPengunjung();
				$data['rst'] = array();

        $this->db->where('id',$id);
        $data['faq'] = $this->db->get('t_faq')->row();
        $this->load->view('templates/bootstraps/header',$data);
        $this->load->view('sertifikasi/vdetail_faq',$data);
        $this->load->view('templates/bootstraps/bottom');
    }
    function link_terkait(){
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->load->view('templates/bootstraps/header',$data);
        $this->load->view('sertifikasi/vlink_terkait',$data);
        $this->load->view('templates/bootstraps/bottom');
    }

	function psertifikasi($id=0,$offset=0){
		$data['marquee'] = $this->artikel_model->marquee();
		$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
		$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
        // Data untuk combo nama sekolah
        $data['nama_sekolah'] = $this->Sertifikasi_Model->nama_sekolah();

        $keyword=isset($_GET['submit']) ? $_GET['submit'] : '';
        if($keyword==""){
            $offset = $this->uri->segment(4);
            $jml = $this->Sertifikasi_Model->count_peserta_uji();
            $data['jmldata'] = $jml;

            $uri=$this->uri->segment(3);
            if($uri=='ALL'){
                $limit =  $data['jmldata'];
            }else{
                $limit = $uri;
            }
            //pengaturan pagination
            $config['enable_query_strings'] = true;
            $config['base_url'] = base_url().'sertifikasi/psertifikasi/'.$limit;
            $config['total_rows'] = $data['jmldata'];
            $config['per_page'] = $limit;
            $config['first_page'] = 'Awal';
            $config['last_page'] = 'Akhir';
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';
            $config['uri_segment'] = 4;
            //inisialisasi config
            $this->pagination->initialize($config);
            //buat pagination
            $data['halaman'] = $this->pagination->create_links();
            $data['data'] = $this->Sertifikasi_Model->get_all_peserta_uji($limit,$offset);
        }else{
            //$limit = $this->uri->segment(3);
            $offset = $this->uri->segment(4);

            //$offset = $this->uri->segment(3);
            $users = $this->input->get('users');
            $nis = $this->input->get('nis');
            $asal_sekolah = $this->input->get('asal_sekolah');
            $data['jmldata'] = count($this->Sertifikasi_Model->peserta_uji_search($users,$nis,$asal_sekolah));

            $uri=$this->uri->segment(3);
            if($uri=='ALL'){
                $limit =  $data['jmldata'];
            }else{
                $limit = $uri;
            }

            $config['enable_query_strings'] = true;
            $link=isset($_GET['link']) ? $_GET['link'] : '';

            //if($link == '1'){
                //$offset = 0;
            $config['suffix'] = "?link=1&users=".$users."&nis=".$nis."&asal_sekolah=".$asal_sekolah."&submit=cari";
            $config['base_url'] = base_url().'sertifikasi/psertifikasi/'.$limit;
            $config['uri_segment'] = 4;

            $config['total_rows'] = $data['jmldata'];
            $config['per_page'] = $limit;
            $config['first_page'] = 'Awal';
            $config['last_page'] = 'Akhir';
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';
            //$config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();
            $data['data'] = $this->Sertifikasi_Model->get_all_peserta_uji($config['per_page'],$offset,1
                ,$users,$nis,$asal_sekolah);
            //var_dump($data['data']);
        }
        $this->load->view('templates/bootstraps/header',$data);
	    $this->load->view('sertifikasi/vpsertifikasi',$data);
	    $this->load->view('templates/bootstraps/bottom');
    }
    // function detail($id='0'){
      //  $data['marquee'] = $this->artikel_model->marquee();
        //$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        //if($id == '1'){
          //  $file_view = 'vpra_asesmen';
//        }else if($id == '2'){
//            $file_view = 'vdijadwalkan';
//        }else if($id == '3'){
//            $file_view = 'vkeputusan';
//        }else{
//            $file_view = 'vflow_detail';
//        }
//        $this->load->view('templates/bootstraps/header',$data);
//        $this->load->view('sertifikasi/'.$file_view,$data);
//        $this->load->view('templates/bootstraps/bottom');
//    }

function proses()
{
    $template_header = 'templates/responsive/header';
    $template_body = 'templates/responsive/sertifikasi/view';
    $template_bottom = 'templates/responsive/footer';

    $riwayat_sertifikasi = $this->Sertifikasi_Model->riwayat_sertifikat($this->id);
        //var_dump($riwayat_sertifikasi);die();
    $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
    $this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(), 'nama_user'=>$this->auth->get_user_data()->nama,'riwayat_sertifikasi'=>$riwayat_sertifikasi));
    $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
}
function view()
{

    $template_header = 'templates/responsive/header';
    $template_body = 'templates/responsive/sertifikasi/view_sertifikat';
    $template_bottom = 'templates/responsive/footer';
    $riwayat_sertifikasi = $this->Sertifikasi_Model->riwayat_sertifikat($this->id);
        //var_dump($riwayat_sertifikasi);die();
    $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
        //$this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(), 'nama_user'=>$this->auth->get_user_data()->nama,'riwayat_sertifikasi'=>$riwayat_sertifikasi));
    $this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(), 'nama_user'=>$this->auth->get_user_data()->nama,'riwayat_sertifikasi'=>$riwayat_sertifikasi));
    $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
}
function asesmen($id)
{
            //var_dump($id);die();
    //$this->load->model('bukti_pendukung_model');

    $template_header = 'templates/responsive/header';
    $template_body = 'templates/responsive/sertifikasi/detail_rekomendasi_asesmen';
    $template_bottom = 'templates/responsive/footer';

    $detail_asesmen = $this->Sertifikasi_Model->detail_sertifikasi_jadwal($id,$this->id);
    $data['mak05'] = unserialize($detail_asesmen->mak05);
    $data['mak05a'] = unserialize($detail_asesmen->mak05a);
    $data['mak03'] = unserialize($detail_asesmen->mak03);
    $data['mak04'] = unserialize($detail_asesmen->mak04);
    $data['mak04a'] = unserialize($detail_asesmen->mak04a);

            //var_dump($mak05);die();
    $data['id'] = $id;
    $data['detail_asesmen']=$detail_asesmen;
    $data['query_pesan'] = $this->query_pesan;
    $data['query_pesan_unread']=$this->query_pesan_unread;
    $data['aplikasi']=$this->aplikasi;

        //$data['minimal_syarat_pendaftaran'] = $minimal_array_skema;

    $this->load->view($template_header, $data);
    $this->load->view($template_body, $data);
    $this->load->view($template_bottom, $data);
}


function banding($id)
{
            //var_dump($id);die();
    //$this->load->model('bukti_pendukung_model');

    $template_header = 'templates/responsive/header';
    $template_body = 'templates/responsive/sertifikasi/banding';
    $template_bottom = 'templates/responsive/footer';

    $detail_asesmen = $this->Sertifikasi_Model->detail_sertifikasi_jadwal($id,$this->id);
    $data['mak02'] = unserialize($detail_asesmen->mak02);
    $data['mak02a'] = unserialize($detail_asesmen->mak02a);
            //var_dump($detail_asesmen);die();
    $id_skema = $detail_asesmen->skema_sertifikasi;
    $data['unit_kompetensi'] = $this->Sertifikasi_Model->unit_kompetensi($id_skema);
    $data['id'] = $id;
    $data['detail_asesmen']=$detail_asesmen;
    $data['query_pesan'] = $this->query_pesan;
    $data['query_pesan_unread']=$this->query_pesan_unread;
    $data['aplikasi']=$this->aplikasi;

        //$data['minimal_syarat_pendaftaran'] = $minimal_array_skema;

    $this->load->view($template_header, $data);
    $this->load->view($template_body, $data);
    $this->load->view($template_bottom, $data);
}
function persetujuan($id)
{
            //var_dump($id);die();
    //$this->load->model('bukti_pendukung_model');

    $template_header = 'templates/responsive/header';
    $template_body = 'templates/responsive/sertifikasi/persetujuan';
    $template_bottom = 'templates/responsive/footer';

    $detail_asesmen = $this->Sertifikasi_Model->detail_sertifikasi_jadwal($id,$this->id);
    $data['mak03'] = unserialize($detail_asesmen->mak03);
            //var_dump($detail_asesmen);die();
    $id_skema = $detail_asesmen->skema_sertifikasi;
    $data['id'] = $id;
    $data['detail_asesmen']=$detail_asesmen;
    $data['query_pesan'] = $this->query_pesan;
    $data['query_pesan_unread']=$this->query_pesan_unread;
    $data['aplikasi']=$this->aplikasi;

        //$data['minimal_syarat_pendaftaran'] = $minimal_array_skema;

    $this->load->view($template_header, $data);
    $this->load->view($template_body, $data);
    $this->load->view($template_bottom, $data);
}
function save_persetujuan(){
    $data['mak03'] = serialize($this->input->post('mak03'));
    $id = $this->input->post('id');
    $this->db->where('id',$id);
    if($this->db->update(kode_tbl().'asesi',$data)){
        $this->session->set_flashdata('result', 'Berhasil Menyimpan');
        $this->session->set_flashdata('mode_alert', 'success');
    }else{
        $this->session->set_flashdata('result', 'Gagal menyimpan data');
        $this->session->set_flashdata('mode_alert', 'warning');
    }
    redirect(base_url().'sertifikasi/persetujuan/'.$id);
}
function save_asesmen(){
    $data['mak05'] = serialize($this->input->post('mak05'));
    $data['mak05a'] = serialize($this->input->post('mak05a'));
    $data['mak03'] = serialize($this->input->post('mak03'));
    $id = $this->input->post('id');
    $this->db->where('id',$id);
    if($this->db->update(kode_tbl().'asesi',$data)){
        $this->session->set_flashdata('result', 'Berhasil Menyimpan');
        $this->session->set_flashdata('mode_alert', 'success');
    }else{
        $this->session->set_flashdata('result', 'Gagal menyimpan data');
        $this->session->set_flashdata('mode_alert', 'warning');
    }
    redirect(base_url().'sertifikasi/asesmen/'.$id);
}

function save_banding(){
    $data['mak02'] = serialize($this->input->post('mak02'));
    $data['mak02a'] = serialize($this->input->post('mak02a'));

    //var_dump($data); die();
    $id = $this->input->post('id');
    $this->db->where('id',$id);
    if($this->db->update(kode_tbl().'asesi',$data)){
        $this->session->set_flashdata('result', 'Berhasil Menyimpan');
        $this->session->set_flashdata('mode_alert', 'success');
    }else{
        $this->session->set_flashdata('result', 'Gagal menyimpan data');
        $this->session->set_flashdata('mode_alert', 'warning');
    }
    redirect(base_url().'sertifikasi/banding/'.$id);
}
function detail($id)
{
    $template_header = 'templates/responsive/header';
    $template_body = 'templates/responsive/sertifikasi/detail';
    $template_bottom = 'templates/responsive/footer';
    $detail_sertifikasi = $this->Sertifikasi_Model->detail_sertifikasi($id);

    //var_dump($detail_sertifikasi); die();
    $this->db->where('id_asesi', $this->id);
    $this->db->where_in('jenis_portofolio', array('0', '1', '2'));
    $bukti = $this->db->get('t_repositori')->result();

    if(count($bukti) > 0){
         $data['status_praasesmen'] = "Lengkap";
         $data['tanggal_praasesmen'] = $detail_sertifikasi->u_date_create;
     }else{
         $data['status_praasesmen'] = "Belum Lengkap";
         $data['tanggal_praasesmen'] = "-";
     }


	$this->db->where('asesi_id', $this->id_asesi);
	$apl02 = $this->db->get(kode_tbl().'asesi_detail')->result();


     if(count($apl02) > 0){
         $data['status_mandiri'] = "Lengkap";
         $data['tanggal_mandiri'] = $detail_sertifikasi->u_date_create;
     }else{
         $data['status_mandiri'] = "Belum Lengkap";
         $data['tanggal_mandiri'] = "-";
     }
    if($detail_sertifikasi->administrasi_ujk=='1'){
        $data['status_administrasi'] = "Lunas";
        $data['tanggal_administrasi'] = tgl_indo($detail_sertifikasi->tanggal_bayar);
    }else{
        $data['status_administrasi'] = "Belum Lunas";
        $data['tanggal_administrasi'] = '-';
        }
    if($detail_sertifikasi->pra_asesmen=='1'){
        $data['status_praasesmen_siap'] = "Siap dilaksanakan";
        $data['tanggal_praasesmen_siap'] = $detail_sertifikasi->pra_asesmen_date;
    }else if($detail_sertifikasi->pra_asesmen=='2'){
        $data['status_praasesmen_siap'] = "Permohonan ditolak";
        $data['tanggal_praasesmen_siap'] = $detail_sertifikasi->pra_asesmen_date;
    }else{
        $data['status_praasesmen_siap'] = "Belum di proses";
        $data['tanggal_praasesmen_siap'] = "-";
    }

    if(!is_null($detail_sertifikasi->id_asesor)){
        $data['status_penjadwalan'] = "Terjadwal";
        $this->db->where('id',$detail_sertifikasi->jadwal_id);
        $query = $this->db->get(kode_tbl().'jadual_asesmen')->row();

        //var_dump($query); die();
        $data['tanggal_penjadwalan'] = tgl_indo($query->tanggal);
    }else{
        $data['status_penjadwalan'] = "Belum Terjadwal";
        $data['tanggal_penjadwalan'] = "-";
    }
    if($detail_sertifikasi->rekomendasi_asesor == '0'){
        $data['status_rekomendasi'] = "Belum di rekomendasi";
        $data['tanggal_rekomendasi'] = "-";
    }else{
        $array_rekomendasi = array('Belum di rekomendasi','Kompeten','Belum Kompeten');
        $data['status_rekomendasi'] = $array_rekomendasi[$detail_sertifikasi->rekomendasi_asesor];
        $data['tanggal_rekomendasi'] = $detail_sertifikasi->tgl_rekomendasi_asesor;
    }
    // if($detail_sertifikasi->complete_komite_teknis == '0'){
    //     $data['status_komite_teknis'] = "Belum Selesai";
    //     $data['tanggal_komite_teknis'] = "-";
    // }else{
    //     $data['status_komite_teknis'] = "Selesai";
    //     $data['tanggal_komite_teknis'] = $detail_sertifikasi->tgl_komite_teknis;
    // }
        //var_dump($data['tanggal_komite_teknis']);die();

    // if($detail_sertifikasi->complete_berita_acara == '0'){
    //     $data['status_berita_acara'] = "Belum Lengkap";
    //     $data['tanggal_berita_acara'] = "-";
    // }else{
    //     $data['status_berita_acara'] = "Lengkap";
    //     $data['tanggal_berita_acara'] = tgl_indo($detail_sertifikasi->tgl_berita_acara);
    // }
    if($detail_sertifikasi->no_seri == ''){
        $data['status_sertifikat'] = "Belum Dicetak";
        $data['tanggal_sertifikat'] = "-";
    }else{
        $data['status_sertifikat'] = "Sudah Dicetak";
        $data['tanggal_sertifikat'] = tgl_indo($detail_sertifikasi->tanggal_terbit);
    }
    // if($detail_sertifikasi->complete_pengiriman == '0'){
    //     $data['status_pengiriman'] = "Belum Dikirm";
    //     $data['tanggal_pengiriman'] = "-";
    // }else{
    //     $data['status_pengiriman'] = "Sudah Dikirim";
    //     $data['tanggal_pengiriman'] = tgl_indo($detail_sertifikasi->tgl_pengiriman);
    // }


    $data['aplikasi']=$this->aplikasi;
    $data['unread_message']=$this->unread_message;
    $data['detail_sertifikasi']=$detail_sertifikasi;
    $data['id']=$id;

    $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
    $this->load->view($template_body, $data);
    $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
}
function detail_asesmen($id)
{
    $this->load->model('bukti_pendukung_model');
        //var_dump($this->id_asesi);die();
    $template_header = 'templates/responsive/header';
    $template_body = 'templates/responsive/sertifikasi/detail_asesmen';
    $template_bottom = 'templates/responsive/footer';

    $detail_asesmen = $this->Sertifikasi_Model->detail_sertifikasi_asesmen($id,$this->id);
    $detail_repositori = $this->bukti_pendukung_model->row_bukti_pendukung($this->id);
    if(count($detail_repositori) == '0'){
        $this->session->set_flashdata('result', 'Asesmen Mandiri Gagal, Upload Bukti Pendukung terlebih dahulu');
        $this->session->set_flashdata('mode_alert', 'warning');
        redirect('bukti_pendukung/upload/index');
        die();
    }

    $skema = $this->bukti_pendukung_model->nama_skema($id);

    $syarat_pendaftaran = $this->bukti_pendukung_model->syarat_pendaftaran($skema->skema_sertifikasi);
    foreach ($syarat_pendaftaran as $key => $value) {
        $array_skema[] = $value->nama_persyaratan;
        if($value->mandatory==1){
            $minimal_array_skema[] = $value->nama_persyaratan;
        }
    }
    $data['aplikasi']=$this->aplikasi;
    $data['unread_message']=$this->unread_message;
    $data['detail_asesmen']=$detail_asesmen;
    $data['detail_repositori']=$detail_repositori;
    $data['id']=$id;
    $data['syarat_pendaftaran']=implode(',',$array_skema);
    $data['minimal_syarat_pendaftaran']=implode(',',$minimal_array_skema);

    $data['query_pesan']=$this->query_pesan;
    $data['query_pesan_unread']=$this->query_pesan_unread;
    $data['array_skema']=$array_skema;
        //$data['minimal_syarat_pendaftaran'] = $minimal_array_skema;


    $this->load->view($template_header, $data);
    $this->load->view($template_body, $data);
    $this->load->view($template_bottom, $data);
}
function detail_asesmen_update()
{
    $nama_pekerjaan = $_POST['group-a'];
        //var_dump($nama_pekerjaan);
        //die();
        //$id_asesi = $this->input->post
    $this->db->where('id_asesi',$nama_pekerjaan[0]['id_asesi']);
    $this->db->delete('t_asesi_portofolio');
    foreach ($nama_pekerjaan as $key => $value) {
        if($value['id_repositori']  != ""){
            if($key==0){
                $id_asesi = $value['id_asesi'];
            }
            $data_array=array('id_repositori'=>$value['id_repositori'],
                'deskripsi'=>$value['deskripsi'],
                'id_asesi'=>$id_asesi);
            $this->db->insert('t_asesi_portofolio',$data_array);
        }
    }
    $this->db->where('id',$nama_pekerjaan[0]['id_asesi']);
    $this->db->update(kode_tbl().'asesi',array('complete_portofolio'=>'1','tanggal_portofolio'=>date('Y-m-d H:i:s')));
    redirect('sertifikasi/detail_asesmen/'.$nama_pekerjaan[0]['id_asesi']);
}
function asesmen_mandiri($id)
{
    $template_header = 'templates/responsive/header';
    $template_body = 'templates/responsive/sertifikasi/asesmen_mandiri';
    $template_bottom = 'templates/responsive/footer';

    $table_asesmen_mandiri = $this->table_asesmen_mandiri($id);

    $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
    $this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(), 'nama_user'=>$this->auth->get_user_data()->nama,'table_asesmen_mandiri'=>$table_asesmen_mandiri,'id'=>$id));
    $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
}
function table_asesmen_mandiri(){
    $id = $this->uri->segment(3);
    $skema = kode_tbl().'skema';
    $skema_detail = kode_tbl().'skema_detail';
    $unit_kompetensi = kode_tbl().'unit_kompetensi';
    $elemen_kompetensi = kode_tbl().'elemen_kompetensi';
    $kuk = kode_tbl().'kuk';
    $asesi = kode_tbl().'asesi';
    $asesi_detail = kode_tbl().'asesi_detail';

    $this->db->where('id',$id);
    $row_skema = $this->db->get(kode_tbl().'asesi')->row();
    $this->load->model('bukti_pendukung_model');
    $bukti_pendukung = $this->bukti_pendukung_model->bukti_pendukung($this->id);
    $select_bukti_pendukung = '<select name="txt_bukti_pendukung[]">';
    foreach ($bukti_pendukung as $key => $value) {
        $select_bukti_pendukung.='<option value="'.$value->nama_dokumen.'">'.$value->nama_dokumen.'</option>';
    }
    $select_bukti_pendukung.='</select>';
        //var_dump($bukti_pendukung);die();
    $this->db->select("a.*,c.id_unit_kompetensi,c.unit_kompetensi,d.elemen_kompetensi,e.id_elemen_kompetensi,e.kuk",false);
    $this->db->from("$skema a");
    $this->db->join("$skema_detail b","b.id_skema=a.id");
    $this->db->join("$unit_kompetensi c","c.id=b.id_unit_kompetensi");
    $this->db->join("$elemen_kompetensi d","d.id_unit_kompetensi=c.id");
    $this->db->join("$kuk e","e.id_elemen_kompetensi=d.id");
    $this->db->where("a.id",$row_skema->skema_sertifikasi);
    $d = $this->db->get()->result();
    $table='<table  width="100%" class="table table-stripped table-bordered" border="1">
    <tr align="center" style="font-weight:bold;">
    <td  align="center"> No </td>
    <td> Kode Unit </td>
    <td> Judul Unit Kompetensi / Elemen Kompetensi / <br/> Kriteria Unjuk Kerja(KUK)</td>
    <td width="30px" align="center"> K<br/>
    <input type="checkbox" id="all_k" name="all_k" />
    </td>
    <td width="30px" align="center"> BK<br/>
    <input type="checkbox" id="all_bk" name="all_k" /> </td>
    <td> Bukti Pendukung </td>
    </tr>';
    $no=1;
    $real_unit = "";
    $real_elemen = "";
    foreach($d as $key=>$value){
     if($real_unit == $value->id_unit_kompetensi){
        if($real_elemen != $value->id_elemen_kompetensi){
           $table.=' <tr style="font-weight:normal;">
           <td align="center"></td>
           <td></td>
           <td> <b>'.ltrim($value->elemen_kompetensi).'</b> </td>
           <td> </td>
           <td> </td>
           <td>
           </td>
           </tr>';
                          //if($real_elemen == $value->id_elemen_kompetensi){
           $table.=' <tr style="font-weight:normal;">
           <td align="center"></td>
           <td></td>
           <td> '.ltrim($value->kuk).' </td>
           <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']"  value="k" class="value_k"/> </td>
           <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']" value="bk" class="value_bk"/></td>
           <td class="select_bukti"> '.$select_bukti_pendukung.'
           </td>
           </tr>';
       }else{

        $table.=' <tr style="font-weight:normal;">
        <td align="center"></td>
        <td></td>
        <td> '.ltrim($value->kuk).' </td>
        <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']"  value="k" class="value_k"/> </td>
        <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']" value="bk" class="value_bk"/></td>
        <td class="select_bukti"> '.$select_bukti_pendukung.'
        </td>
        </tr>';
    }
}else{
    $table.=' <tr>
    <td align="center"> '.$no.' </td>
    <td> '.$value->id_unit_kompetensi.' </td>
    <td> <b>'.$value->unit_kompetensi.'</b> </td>
    <td align="center"> </td>
    <td align="center"> </td>
    <td>
    </td>
    </tr>';
    $table.=' <tr style="font-weight:normal;">
    <td align="center"></td>
    <td></td>
    <td> <b>'.ltrim($value->elemen_kompetensi).'</b> </td>
    <td> </td>
    <td> </td>
    <td>
    </td>
    </tr>';
    $table.=' <tr style="font-weight:normal;">
    <td align="center"></td>
    <td></td>
    <td> '.ltrim($value->kuk).' </td>
    <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']"  value="k" class="value_k"/> </td>
    <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']" value="bk" class="value_bk"/></td>
    <td class="select_bukti"> '.$select_bukti_pendukung.'
    </td>
    </tr>';
    $no++;

}
$real_unit = $value->id_unit_kompetensi;
$real_elemen = $value->id_elemen_kompetensi;
}
$table .= '</table>';
return $table;
}
function save_mandiri(){
    $is_kompeten = $this->input->post('is_kompeten');
    $txt_bukti_pendukung = $this->input->post('txt_bukti_pendukung');
        //var_dump($txt_bukti_pendukung);die();
    $id_asesi = $this->input->post('id_asesi');
    $array_update_asesi = array(
        'hasil_mandiri'=>serialize($is_kompeten),
        'bukti_mandiri' => serialize($txt_bukti_pendukung),
        'complete_praasesmen'=>'1',
        'tgl_praasesmen'=> date('Y-m-d H:i:s'),
        'invoice_no' => $id_asesi.'/INV-SERT/LSP-LAS/'.date('Y')
    );
    $this->db->where('id',$id_asesi);
    $this->db->update(kode_tbl().'asesi',$array_update_asesi);
    redirect(base_url().'sertifikasi/detail/'.$id_asesi);

}
}
