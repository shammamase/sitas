<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sijuara extends CI_Controller {
	function index(){
		if (isset($_POST['submit'])){
			$username = $this->input->post('a');
			$password = md5($this->input->post('b'));
			$cek = $this->model_users->cek_login_sijuara($username,$password);
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata('upload_image_file_manager',true);
				$this->session->set_userdata(array('username'=>$row['username']));
				redirect('sijuara/homex');
			}else{
				$data['title'] = 'BSIP TAS &rsaquo; Log In';
				$this->load->view('sitas/view_login',$data);
			}
		}else{
			if ($this->session->username != ''){
				redirect('sijuara/homex');
			}else{
				$data['title'] = 'BSIP TAS &rsaquo; Log In';
				$this->load->view('sitas/view_login',$data);
			}
		}
	}
	
	function contoh(){
	    $this->load->view('sijuara/contoh');
	}

	function home(){
		cek_session_admin1();
		$user = $this->session->username;
		$get_us = $this->db->query("select id_user from sijuara_user where username = '$user'")->row();
		$get_sk = $this->db->query("select * from sijuara_level where id_user = '$get_us->id_user' and id_stakeholder in (1,2,3,6,7)")->num_rows();
		if($get_sk > 0){
		    $this->template->load('sijuara/template_cltr','sijuara/view_home_cltr');
		} else {
		    echo "Anda Tidak Memiliki Akses";
		}
		
	}
	
	function homex(){
		cek_session_admin1();
		$this->template->load('sijuara/templatex','sijuara/view_homex_cltr');
	}

	
	function logout(){
		$this->session->sess_destroy();
		redirect('sijuara');
	}

	// program,ppk,kabalai
	function kegiatan_all(){
		cek_session_admin1();
		$data['record'] = $this->model_polling->list_kegiatan_a();
		$this->template->load('sijuara/template_cltr','sijuara/mod_pj/view_kegiatan_all',$data);
	}
	
	function hpsx(){
	    cek_session_admin1();
		$data['record'] = $this->model_polling->hpsx();
		$this->template->load('sijuara/template_cltr','sijuara/mod_pj/view_hps',$data);
	}
	
	// pj
	function kegiatan(){
		cek_session_admin1();
		$user = $this->session->username;
		$data['record'] = $this->model_polling->list_kegiatan($user);
		$this->template->load('sijuara/template_cltr','sijuara/mod_pj/view_kegiatan',$data);
	}
	
	function buat_lap_monev(){
		cek_session_admin1();
		$user = $this->session->username;
		$data['record'] = $this->model_polling->list_kegiatan($user);
		$this->template->load('sijuara/template_cltr','sijuara/mod_pj/view_kegiatan_monev',$data);
	}
	
	function lap_monev(){
		cek_session_admin1();
		$id = $this->uri->segment(3);
        $data['keg'] = $this->model_polling->kegiatan_2($id)->row();
        $data['uris'] = $id;
		$this->template->load('sijuara/template_cltr','sijuara/mod_pj/view_lap_monev',$data);
	}
	
	function lap_monev_xl(){
		$id = $this->uri->segment(3);
        $data['keg'] = $this->model_polling->kegiatan_2($id)->row();
        $data['uris'] = $id;
		$this->load->view('sijuara/mod_pj/view_lap_monev_xl',$data);
	}
	
	//pumk
	function kegiatan_pumk(){
		cek_session_admin1();
		$user = $this->session->username;
		$pj_pumk = $this->model_polling->pj_pumk($user)->row();
		$id_pj = $pj_pumk->id_pj;
		$data['record'] = $this->model_polling->list_kegiatan_pumk($id_pj);
		$this->template->load('sijuara/template_cltr','sijuara/mod_pj/view_kegiatan_pumk',$data);
	}
	
	function monitor_pengajuan(){
		cek_session_admin1();
		$data['record'] = $this->model_polling->list_kegiatan_a();
		$this->template->load('sijuara/template_cltr','sijuara/mod_pj/view_kegiatan_pumk',$data);
	}
	
	function pengajuan(){
		cek_session_admin1();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_polling->simpan_pengajuan();
		}else{
			$data['detil'] = $this->model_polling->detil($id);
	        $data['kegiatan'] = $this->model_polling->kegiatan($id);
	        $data['user'] = $this->session->username;
	        $data['tanggal'] = date('Y-m-d');
	        $data['uris'] = $id;
	        
	        //$data['rincian'] = $this->model_polling->rincian($id);
			//$this->template->load('sijuara/template_cltr','sijuara/mod_pumk/pengajuan',$data);
			
			$this->template->load('sijuara/template_cltr','sijuara/mod_pumk/pengajuan_rincian',$data);
			//$this->load->view('sijuara/mod_pumk/pengajuan_rincian',$data);
		}
	}
	
	function pengajuan_full(){
	    cek_session_admin1();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_polling->simpan_pengajuan();
		}else{
	    $data['detil'] = $this->model_polling->detil($id);
        $data['kegiatan'] = $this->model_polling->kegiatan($id);
        $data['user'] = $this->session->username;
        $data['get_pj'] = $this->model_polling->get_pj($id);
        $data['tanggal'] = date('Y-m-d');
        $data['uris'] = $id;
        $this->template->load('sijuara/template_cltr','sijuara/mod_pumk/pengajuan',$data);
		}
	}
	
	function verif_pj(){
	    cek_session_admin1();
		$id = $this->uri->segment(3);
		$get_pj = $this->model_polling->get_pj($id)->row();
		if (isset($_POST['submit'])){
			$this->model_polling->verif_pj();
		}else{
		if($this->session->username==$get_pj->username or $this->session->username=="ariabdulrouf" or $this->session->username=="yusufantu" or $this->session->username=="sumarni"){
		    $data['detil'] = $this->model_polling->detil($id);
            $data['kegiatan'] = $this->model_polling->kegiatan($id);
            $data['dt_sp'] = $this->model_polling->get_simpan_pengajuan($id);
            $data['user'] = $this->session->username;
            $data['uris'] = $id;
            $this->template->load('sijuara/template_cltr','sijuara/mod_pj/verif',$data);
		} else {
    	    redirect('sijuara/home');
    	} 
		}
	}
	
	function isi_pj(){
	    cek_session_admin1();
		$id = $this->uri->segment(3);
		$id4 = $this->uri->segment(4);
		$get_pj = $this->model_polling->get_pj($id)->row();
		if (isset($_POST['submit'])){
		    $id_subkomp = $this->input->post('id_subkomp');
		    $tipe = $this->input->post('tipe');
			if($tipe=="save"){
			    $this->model_polling->simpan_monev();
			} else {
			    $this->model_polling->edit_monev();
			}
			redirect('sijuara/isi_pj/'.$id_subkomp);
		}else{
		if($this->session->username==$get_pj->username){
		    if(empty($id4)){
		        $data['tipe'] = "save";
		        $data['id_monev'] = "";
		        $data['lap_bln'] = date('Y-m');
		        $data['capaianx'] = "";
		        $data['kendalax'] = "";
		        $data['solusix'] = "";
		        $data['realisasix'] = "";
		        $data['harus'] = 'required';
		        $data['eviden'] = '';
		    } else {
		        $get_mov = $this->db->query("select * from sijuara_monev where id_monev = '$id4'")->row();
		        $data['tipe'] = "edit";
		        $data['id_monev'] = $id4;
		        $data['lap_bln'] = $get_mov->lap_bln;
		        $data['capaianx'] = $get_mov->capaian;
		        $data['kendalax'] = $get_mov->kendala;
		        $data['solusix'] = $get_mov->solusi;
		        $data['realisasix'] = $get_mov->realisasi;
		        $data['harus'] = '';
		        $data['eviden'] = $get_mov->eviden;
		    }
		    
		    $data['detil'] = $this->model_polling->detil($id);
            $data['kegiatan'] = $this->model_polling->kegiatan_2($id);
            $data['dt_sp'] = $this->model_polling->get_simpan_pengajuan($id);
            $data['user'] = $this->session->username;
            $data['uris'] = $id;
            $data['get_rl'] = $this->model_polling->get_rl($id)->row();
            $this->template->load('sijuara/template_cltr','sijuara/mod_pj/verif_monev',$data);
		} else {
    	    redirect('sijuara/home');
    	} 
		}
	}
	
	function isi_eval_pj(){
	    cek_session_admin1();
		$id = $this->uri->segment(3);
		$id4 = $this->uri->segment(4);
		$get_pj = $this->model_polling->get_pj($id)->row();
		if (isset($_POST['submit'])){
		    $id_subkomp = $this->input->post('id_subkomp');
		    $tipe = $this->input->post('tipe');
			if($tipe=="save"){
			    $this->model_polling->simpan_monev();
			} else {
			    $this->model_polling->edit_monev();
			}
			redirect('sijuara/isi_eval_pj/'.$id_subkomp);
		}else{
		    $get_mov = $this->db->query("select * from sijuara_monev where id_monev = '$id4'")->row();
		    $data['id_monev'] = $id4;
		    $data['tipe'] = "edit";
		    $data['lap_bln'] = $get_mov->lap_bln;
	        $data['capaianx'] = $get_mov->capaian;
	        $data['kendalax'] = $get_mov->kendala;
	        $data['solusix'] = $get_mov->solusi;
	        $data['realisasix'] = $get_mov->realisasi;
	        $data['harus'] = 'readonly';
		    $data['detil'] = $this->model_polling->detil($id);
            $data['kegiatan'] = $this->model_polling->kegiatan_2($id);
            $data['dt_sp'] = $this->model_polling->get_simpan_pengajuan($id);
            $data['user'] = $this->session->username;
            $data['uris'] = $id;
            $data['get_rl'] = $this->model_polling->get_rl($id)->row();
            $this->template->load('sijuara/template_cltr','sijuara/mod_pj/verif_monev2',$data);
		
		}
	}
	
	function selesai(){
	    $this->model_polling->selesai();
	}
	
	function pengajuan_status(){
	    cek_session_admin1();
	    $id = $this->uri->segment(3);
	    $data['detil'] = $this->model_polling->detil($id);
        $data['kegiatan'] = $this->model_polling->kegiatan($id);
        $data['dt_sp'] = $this->model_polling->get_simpan_pengajuan($id);
        $data['uris'] = $id;
        $this->template->load('sijuara/template_cltr','sijuara/mod_pumk/status_pengajuan',$data);
	}
	
	function isi_rincian(){
	    if (isset($_POST['submit'])){
			$this->model_polling->simpan_rincian();
		}
	}
	
	function get_datahps(){
	    $postdata = $this->input->post();
	    $data = $this->model_polling->gethps($postdata);
	    echo json_encode($data);
	}

	function tambah_kegiatan(){
		cek_session_admin1();
		if (isset($_POST['submit'])){
			$this->model_more->list_pemesanan_tambah();
			redirect('admin/pemesanan');
		}else{
			$data['page'] = $this->model_more->produk();
			$data['plng'] = $this->model_more->pelanggan();
			$this->template->load('administrator/template_cltr','administrator/mod_pemesanan/view_pemesanan_tambah',$data);
		}
	}
	
	function tambah_rincian(){
	    $nim=$this->input->post('nim');
	    $data['user'] = $this->session->username;
	    $data['tanggal'] = date('Y-m-d');
        $data['hasil']=$this->model_polling->Getsubdetil($nim);
        $this->load->view('sijuara/rincian_modal',$data);
	}
	
	function list_rincian(){
	    $nim=$this->input->post('nim');
	    $data['id_subdetil'] = $nim;
        $data['hasil']=$this->model_polling->get_rincian($nim);
        $this->load->view('sijuara/rincian_modals',$data);
	}

	function edit_kegiatan(){
		cek_session_admin1();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_more->list_pemesanan_update();
			redirect('admin/pemesanan');
		}else{
			$data['page'] = $this->model_more->produk();
			$data['plng'] = $this->model_more->pelanggan();
			$data['rows'] = $this->model_more->list_pemesanan_edit($id)->row_array();
			$this->template->load('administrator/template_cltr','administrator/mod_pemesanan/view_pemesanan_edit',$data);
		}
	}

	function delete_kegiatan(){
		$id = $this->uri->segment(3);
		$this->model_more->list_pemesanan_delete($id);
		redirect('admin/pemesanan');
	}
	
	function konfirmasi_kegiatan(){
	    cek_session_admin1();
	    $id = $this->uri->segment(3);
		$user = $this->session->username;
		if($id==1){
		    $data['record'] = $this->model_polling->list_kegiatan_ajuan_kabalai();
		} else if($id==2){
		    $data['record'] = $this->model_polling->list_kegiatan_ajuan_program(); 
		} else if($id==3){
		    $data['record'] = $this->model_polling->list_kegiatan_ajuan_ppk();
		} else if($id==5){
		    $data['record'] = $this->model_polling->list_kegiatan_ajuan_keuangan();
		}
		$this->template->load('sijuara/template_cltr','sijuara/view_ajuan_kegiatan',$data);
	}
	
	// belum selesai function verif
	function verif(){
	    cek_session_admin1();
		$id = $this->uri->segment(3);
		$pejabat = $this->uri->segment(4);
		$cek_pjb = $this->model_polling->cek_pjb($pejabat)->row();
		if (isset($_POST['submit'])){
			$this->model_polling->verif();
		}else{
		if($this->session->username!=$cek_pjb->username){
		    redirect('sijuara/home');
		} else {
		   $data['detil'] = $this->model_polling->detil($id);
            $data['kegiatan'] = $this->model_polling->kegiatan($id);
            $data['dt_sp'] = $this->model_polling->get_simpan_pengajuan($id);
            $data['user'] = $this->session->username;
            $data['uris'] = $id;
            $data['pejabat'] = $pejabat;
            $this->template->load('sijuara/template_cltr','sijuara/verif',$data);    
		}
	    
		}
	}
	
	function tes_pdf(){
	        ob_start();    
	        $uri3 = $this->uri->segment(3);
	        $uri4 = $this->uri->segment(4);
	        $uri5 = $this->uri->segment(5);
	        $link_url = "http://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status/";
	        
	        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        //$config['cacheable']    = true; //boolean, the default is true
        //$config['cachedir']     = './assets/'; //string, the default is application/cache/
        //$config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './asset/file_lainnya/qr_code/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$uri5.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $link_url.$uri5; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
 
	        
	        $data['detil'] = $this->model_polling->detil($uri3);
            $data['kegiatan'] = $this->model_polling->kegiatan($uri3);
            $data['dt_sp'] = $this->model_polling->get_simpan_pengajuan_print($uri5);
            $data['uris'] = $uri3;
            $data['uri4'] = $uri4;
            $data['uri5'] = $uri5;
            $data['pjb'] = $this->db->query("select ttd_pj,ttd_program,ttd_ppk,ttd_kabalai from sijuara_simpan_pengajuan where kode_tr = '$uri5'")->row();
	        $this->load->view('sijuara/print',$data);    
	        $html = ob_get_contents();        
	        ob_end_clean();            
	        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
	        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','F4','en');    
	        $pdf->WriteHTML($html);    
	        $pdf->Output();
	        //$pdf->Output('Tes.pdf', 'D');
	}
	
	function tes_pdf_manual(){
	        ob_start();    
	        $uri3 = $this->uri->segment(3);
	        $uri4 = $this->uri->segment(4);
	        $uri5 = $this->uri->segment(5);
	        $link_url = "http://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status/";
	        
	        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        //$config['cacheable']    = true; //boolean, the default is true
        //$config['cachedir']     = './assets/'; //string, the default is application/cache/
        //$config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './asset/file_lainnya/qr_code/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$uri5.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $link_url.$uri5; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
 
	        
	        $data['detil'] = $this->model_polling->detil($uri3);
            $data['kegiatan'] = $this->model_polling->kegiatan($uri3);
            $data['dt_sp'] = $this->model_polling->get_simpan_pengajuan_print($uri5);
            $data['uris'] = $uri3;
            $data['uri4'] = $uri4;
            $data['uri5'] = $uri5;
	        $this->load->view('sijuara/print_manual',$data);    
	        $html = ob_get_contents();        
	        ob_end_clean();            
	        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
	        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','F4','en');    
	        $pdf->WriteHTML($html);    
	        $pdf->Output();
	        //$pdf->Output('Tes.pdf', 'D');
	}
	
	function status(){
		$id = $this->uri->segment(3);
        $data['dt_sp'] = $this->model_polling->get_simpan_pengajuan_print($id);
        $data['uris'] = $id;
        $this->load->view('sijuara/status',$data);
	}
	
	function hapus_rincian(){
	    $uri3 = $this->uri->segment(3);
	    $uri4 = $this->uri->segment(4);
	    $this->db->query("delete from sijuara_rincian where id_subdetil = '$uri4' and status_ajukan = 0");
	    redirect('sijuara/pengajuan/'.$uri3);    
	}
	// buat spt
	function buat_spt(){
	    cek_session_admin1();
		//$id = $this->uri->segment(3);
		if (isset($_GET['buat_tgl'])){
		    $tgl = $this->input->get('tanggal');
		    $ex_tgl = explode("-",$tgl);
		    $lama = $this->input->get('lama_hari');
		    $tglx = $ex_tgl[2];
		    $tglz = substr($tglx,0,1);
		    if($tglz==0){
		        $tgly = substr($tglx,1,1);
		    } else {
		        $tgly = $tglx;
		    }
		    $tot_tgl = $tgly + $lama;
		    $tgln = "";
		    for($ii=$tgly; $ii<$tot_tgl; $ii++){
		        $tgln .= $ex_tgl[0]."-".$ex_tgl[1]."-".$ii.",";
		    }
		    $tglm = substr($tgln,0,-1);
		    $id_peg = "";
		    $get_pgx = $this->db->query("select id_peg from sijuara_pelaku_spt where tanggal like '%$tglm%'");
		    foreach($get_pgx->result() as $gpg){
		        $id_peg .= $gpg->id_peg.",";
		    }
		    $id_pegw = substr($id_peg,0,-1);
		    
		    $data['verif'] = 0;
		    $data['menimbang'] = "";
		    $data['dasar'] = "<ul><li>SK. Kepala BPTP Gorontalo tentang penanggung jawab kegiatan tahun ".date('Y')."</li></ul>";
		    $data['untuk'] = "";
		    $data['ceck'] = "";
			$data['tanggal'] = $tgl;
			$data['tanggal_input'] = date('Y-m-d');
			$data['lama_hari'] = $lama;
			$data['kegiatan'] = $this->model_more->list_kegiatan();
			$data['surat_masuk'] = $this->model_more->list_surat_masuk();
			if(!empty($id_pegw)){
			    $data['peg'] = $this->model_more->list_peg($id_pegw);    
			} else {
			    $data['peg'] = $this->model_more->list_peg_all();
			}
			
			$data['tgl_no'] = $tglm;
			$data['arr'] = "";
			
			$data['id_spt'] = "";
			$data['kunci_id_spt'] = "disabled";
			$data['status'] = "save";
			$this->template->load('sijuara/persuratan/spt/template_form','sijuara/persuratan/spt/buat_spt',$data);
		}else{
		    $data['verif'] = 0;
		    $data['menimbang'] = "";
		    $data['dasar'] = "<ul><li>SK. Kepala BPTP Gorontalo tentang penanggung jawab kegiatan tahun ".date('Y')."</li></ul>";
		    $data['untuk'] = "";
		    $data['ceck'] = "";
		    $data['tanggal'] = "";
		    $data['tanggal_input'] = date('Y-m-d');
			$data['lama_hari'] = "1";
			$data['kegiatan'] = "";
			$data['surat_masuk'] = "";
			$data['peg'] = "";
			$data['tgl_no'] = "";
			$data['arr'] = "";
			
			$data['id_spt'] = "";
			$data['kunci_id_spt'] = "disabled";
			$data['status'] = "";
            $this->template->load('sijuara/persuratan/spt/template_form','sijuara/persuratan/spt/buat_spt',$data);
		}
	}
	
	function edit_spt(){
	    cek_session_admin1();
	    if(isset($_GET['id_spt'])){
		    $id_spt = $_GET['id_spt'];
		    $get_spt = $this->model_more->get_spt_id($id_spt);
		    $get_spt_peg = $this->model_more->get_peg_spt($id_spt);
		    if(isset($_GET['tanggal'])){
		        $tgl = $this->input->get('tanggal');
		        $lama = $this->input->get('lama_hari');
		    } else {
		        $tgl = $get_spt->tanggal;
		        $lama = $get_spt->lama_hari;
		    }
		    
		    $ex_tgl = explode("-",$tgl);
		    $tglx = $ex_tgl[2];
		    $tglz = substr($tglx,0,1);
		    if($tglz==0){
		        $tgly = substr($tglx,1,1);
		    } else {
		        $tgly = $tglx;
		    }
		    $tot_tgl = $tgly + $lama;
		    $tgln = "";
		    for($ii=$tgly; $ii<$tot_tgl; $ii++){
		        $tgln .= $ex_tgl[0]."-".$ex_tgl[1]."-".$ii.",";
		    }
		    $tglm = substr($tgln,0,-1);
		    $id_peg = "";
		    $get_pgx = $this->db->query("select id_peg from sijuara_pelaku_spt where tanggal like '%$tglm%'");
		    foreach($get_pgx->result() as $gpg){
		        $id_peg .= $gpg->id_peg.",";
		    }
		    $id_pegw = substr($id_peg,0,-1);
		    
		    if($get_spt->is_dipa==1){
		        $ckd = "checked";
		    } else {
		        $ckd = "";
		    }
		    
		    /*
		    $arr_pg = "";
		    foreach($get_spt_peg as $gs){
		        $arr_pg .= $gs->id_peg.",";
		    }
		    $arr_p = substr($arr_pg,0,-1);
		    */
		    
		    $data['verif'] = $get_spt->verif_kabalai;
		    $data['menimbang'] = $get_spt->menimbang;
			$data['dasar'] = $get_spt->dasar;
			$data['untuk'] = $get_spt->untuk;
			$data['ceck'] = $ckd;
			$data['tanggal'] = $tgl;
			$data['tanggal_input'] = $get_spt->tanggal_input;
			$data['lama_hari'] = $lama;
			$data['kegiatan'] = "";
			$data['surat_masuk'] = "";
			if(!empty($id_pegw)){
			    $data['peg'] = $this->model_more->list_peg($id_pegw);    
			} else {
			    $data['peg'] = $this->model_more->list_peg_all();
			}
			$data['tgl_no'] = $tglm;
			$data['arr'] = $get_spt_peg;
			$data['kegiatan'] = $this->model_more->list_kegiatan();
			$data['surat_masuk'] = $this->model_more->list_surat_masuk();
			
			$data['id_spt'] = $id_spt;
			$data['kunci_id_spt'] = "";
			$data['status'] = "edit";
			$this->template->load('sijuara/persuratan/spt/template_form','sijuara/persuratan/spt/buat_spt',$data);
		}
	}
	
	function copy_spt(){
	    cek_session_admin1();
	    if(isset($_GET['id_spt'])){
		    $id_spt = $_GET['id_spt'];
		    $get_spt = $this->model_more->get_spt_id($id_spt);
		    if(isset($_GET['tanggal'])){
		        $tgl = $this->input->get('tanggal');
		        $lama = $this->input->get('lama_hari');
		    } else {
		        $tgl = date('Y-m-d');
		        $lama = "1";
		    }
		    
		    $ex_tgl = explode("-",$tgl);
		    $tglx = $ex_tgl[2];
		    $tglz = substr($tglx,0,1);
		    if($tglz==0){
		        $tgly = substr($tglx,1,1);
		    } else {
		        $tgly = $tglx;
		    }
		    $tot_tgl = $tgly + $lama;
		    $tgln = "";
		    for($ii=$tgly; $ii<$tot_tgl; $ii++){
		        $tgln .= $ex_tgl[0]."-".$ex_tgl[1]."-".$ii.",";
		    }
		    $tglm = substr($tgln,0,-1);
		    $id_peg = "";
		    $get_pgx = $this->db->query("select id_peg from sijuara_pelaku_spt where tanggal like '%$tglm%'");
		    foreach($get_pgx->result() as $gpg){
		        $id_peg .= $gpg->id_peg.",";
		    }
		    $id_pegw = substr($id_peg,0,-1);
		    $ckd = "";
		    
		    $data['verif'] = 0;
		    $data['menimbang'] = $get_spt->menimbang;
			$data['dasar'] = $get_spt->dasar;
			$data['untuk'] = $get_spt->untuk;
			$data['ceck'] = $ckd;
			$data['tanggal'] = $tgl;
			$data['tanggal_input'] = date('Y-m-d');
			$data['lama_hari'] = $lama;
			$data['kegiatan'] = "";
			$data['surat_masuk'] = "";
			if(!empty($id_pegw)){
			    $data['peg'] = $this->model_more->list_peg($id_pegw);    
			} else {
			    $data['peg'] = $this->model_more->list_peg_all();
			}
			$data['tgl_no'] = $tglm;
			$data['arr'] = "";
			$data['kegiatan'] = $this->model_more->list_kegiatan();
			$data['surat_masuk'] = $this->model_more->list_surat_masuk();
			
			$data['id_spt'] = $id_spt;
			$data['kunci_id_spt'] = "";
			$data['status'] = "save";
			$this->template->load('sijuara/persuratan/spt/template_form','sijuara/persuratan/spt/buat_spt',$data);
		}
	}

	function lihat_surat(){
	    cek_session_admin1();
	    if(isset($_POST['id_buat_surat'])){
		    $id_spt = $_POST['id_buat_surat'];
		    $data['spt'] = $this->db->query("select * from sijuara_buat_surat where id_buat_surat = '$id_spt'")->row();
		    $data['no_surat'] = $this->model_more->get_no_surat_buat($id_spt)->row();
			$this->load->view('sijuara/persuratan/surat_keluar/lihat_surat',$data);
		}
	}
	
	function lihat_perjadin(){
	    cek_session_admin1();
	    if(isset($_POST['id_spt'])){
		    $id_spt = $_POST['id_spt'];
		    $model_lap = $this->model_more->lap_spt_id_spt($id_spt)->row();
	        $user = $model_lap->user;
		    $data['spt'] = $this->model_more->get_spt_id($id_spt);
		    $data['peg'] = $this->model_more->get_peg_spt($id_spt);
		    $data['no_surat'] = $this->model_more->get_no_surat_spt($id_spt)->row();
		    $data['lap_spt'] = $model_lap;
		    $data['user'] = $this->model_more->get_yg_membuat($user)->row();
                    
			$this->load->view('sijuara/persuratan/spt/lihat_perjadin',$data);
		}
	}
	
	function save_spt(){
	    $status = $this->input->post('status');
	    if($status=="save"){
	        $this->model_more->save_spt();    
	    } else {
	        $this->model_more->update_spt();
	    }
		
		redirect('sijuara/daftar_spt');
	}
	
	function delete_spt(){
	    $id = $this->uri->segment(3);
	    $q = $this->model_more->get_spt_id($id);
	    $verif = $q->verif_kabalai;
	    $this->db->query("delete from sijuara_spt where id_spt='$id'");
	    $this->db->query("delete from sijuara_pelaku_spt where id_spt='$id'");
	    if($verif == 1){
	        $this->db->query("delete from sijuara_surat_keluar where id_spt='$id'");
	    }
	    redirect('sijuara/daftar_spt');
	}
	function verif_spt(){
	    cek_session_admin1();
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
	    $kabalai = $this->model_more->get_pj_ttd($id_pjs->id_pejabat)->row();
	    $user_vr = $this->session->username;
	    if($kabalai->username==$user_vr){
	        $data['rec'] = $this->model_more->daftar_spt_kabalai();
    		$data['kabalai'] = $kabalai;
            $this->template->load('sijuara/persuratan/verif_surat/template_form','sijuara/persuratan/verif_surat/daftar_spt',$data);    
	    } else {
	        echo "Anda Tidak Memiliki Hak Akses";
	    }
		
	}
	
	function verif_spt_detail(){
	    cek_session_admin1();
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
	    $kabalai = $this->model_more->get_pj_ttd($id_pjs->id_pejabat)->row();
	    $user_vr = $this->session->username;
	    if($kabalai->username==$user_vr){
    	    $id_spt = $this->uri->segment(3);
    	    $qw_spt = $this->model_more->get_spt_id($id_spt);
    	    if($qw_spt->verif_kabalai==0){
    	        $data['spt'] = $qw_spt;
        	    $data['peg'] = $this->model_more->get_peg_spt($id_spt);
        	    $data['no_surat'] = $this->model_more->get_no_surat_spt($id_spt)->row();
        	    $data['kabalai'] = $kabalai;
        	    $data['ss'] = $this->session->username;
        	    $this->template->load('sijuara/persuratan/verif_surat/template_form','sijuara/persuratan/verif_surat/verif_spt',$data);
        		//$this->load->view('sijuara/persuratan/spt/lihat_spt',$data);   
    	    } else {
    	        echo "SPT Sudah di Setujui";
    	    }
	    } else {
	        echo "Anda Tidak Memiliki Akses !!!";
	    }
	}
	
	function setuju_spt(){
	    cek_session_admin1();
	    $id_spt = $this->uri->segment(3);
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
	    $qw_spt = $this->model_more->get_spt_id($id_spt);
	    $qw_pl = $this->model_more->get_peg_spt($id_spt);
	    $tj = "";
	    foreach($qw_pl as $qp){
	        $tj .= $qp->nama.",";
	        $tgl_plk = $qp->tanggal;
	        //logika tgl s.d tgl
                $pc_tgl_plk = explode(",",$tgl_plk);
                $jml_tgl = count($pc_tgl_plk);
                if($jml_tgl>1){
                    $pc1 = explode("-",$pc_tgl_plk[0]);
                    $pc2 = explode("-",end($pc_tgl_plk));
                    if($pc1[1]==$pc2[1]){
                        $val_tgl = $pc1[2]." s.d ".tgl_indoo(end($pc_tgl_plk));
                    } else {
                        $pc11 = explode(" ",tgl_indoo($pc_tgl_plk[0]));
                        $val_tgl = $pc11[0]." ".$pc11[1]." s.d ".tgl_indoo(end($pc_tgl_plk));
                    }
                } else {
                    $val_tgl = tgl_indoo($pc_tgl_plk[0]);
                }
                // end logika tgl s.d tgl
	    }
	    $qw_id_arsip = $this->model_more->get_id_sub_arsip($qw_spt->id_arsip)->row();
	    $tujuan_surat = substr($tj,0,-1);
	    $user = $qw_spt->user;
	    $tanggal = $qw_spt->tanggal_input;
	    $pc_tgx = explode("-",$tanggal);
	    $perihal = $qw_spt->untuk." pada Tanggal ".$val_tgl;
	    $tgl_input = date('Y-m-d H:i:s');
	    $no_lengkap = "-/".$qw_id_arsip->kode_sub_arsip."/H.10.29/".$pc_tgx[1]."/".$pc_tgx[0];
	    $this->db->query("update sijuara_spt set verif_kabalai = 1, pj_ttd = '$id_pjs->id_pejabat' where id_spt = '$id_spt'");
	     $this->db->query("insert into sijuara_surat_keluar 
	                        (id_spt,tujuan_surat,tanggal,perihal,user,tanggal_input,no_lengkap)
	                        values ('$id_spt','$tujuan_surat','$tanggal','$perihal','$user','$tgl_input','$no_lengkap')
	                        ");
	    redirect('sijuara/verif_spt');
	}
	
	function tolak_spt(){
	    cek_session_admin1();
	    $id_spt = $_POST['id_spt'];
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
	    $ket = $_POST['keterangan'];
	    $this->db->query("update sijuara_spt set keterangan = '$ket', pj_ttd = '$id_pjs->id_pejabat' where id_spt = '$id_spt'");
	    redirect('sijuara/verif_spt');
	}
	
	function pdf_spt(){
	        ob_start();    
	        $uri3 = $this->uri->segment(3);
	        $id_spt = $this->uri->segment(4);
	        $kd = substr($uri3,0,6);
	        $nm_qr = $kd."/".$id_spt;
	        $link_url = "http://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status_spt/";
	        
	        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        //$config['cacheable']    = true; //boolean, the default is true
        //$config['cachedir']     = './assets/'; //string, the default is application/cache/
        //$config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './asset/file_lainnya/qr_code_spt/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
 
    	    $data['spt'] = $this->model_more->get_spt_id($id_spt);
    	    $data['peg'] = $this->model_more->get_peg_spt($id_spt);
    	    $data['no_surat'] = $this->model_more->get_no_surat_spt($id_spt)->row();
	        $this->load->view('sijuara/persuratan/spt/print',$data);    
	        $html = ob_get_contents();        
	        ob_end_clean();            
	        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
	        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');    
	        $pdf->WriteHTML($html);    
	        $pdf->Output();
	        //$pdf->Output('Tes.pdf', 'D');
	}
	
	function pdf_spt_manual(){
	        ob_start();    
	        $uri3 = $this->uri->segment(3);
	        $id_spt = $this->uri->segment(4);
	        $kd = substr($uri3,0,6);
	        $nm_qr = $kd."/".$id_spt;
	        $link_url = "http://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status_spt/";
	        
	        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        //$config['cacheable']    = true; //boolean, the default is true
        //$config['cachedir']     = './assets/'; //string, the default is application/cache/
        //$config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './asset/file_lainnya/qr_code_spt/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
 
    	    $data['spt'] = $this->model_more->get_spt_id($id_spt);
    	    $data['peg'] = $this->model_more->get_peg_spt($id_spt);
    	    $data['no_surat'] = $this->model_more->get_no_surat_spt($id_spt)->row();
	        $this->load->view('sijuara/persuratan/spt/print_manual',$data);    
	        $html = ob_get_contents();        
	        ob_end_clean();            
	        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
	        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');    
	        $pdf->WriteHTML($html);    
	        $pdf->Output();
	        //$pdf->Output('Tes.pdf', 'D');
	}
	
    function status_spt(){
        $uri3 = $this->uri->segment(3);
        $id_spt = $this->uri->segment(4);
        $a = md5($id_spt);
        $b = substr($a,0,6);
        if($uri3==$b){
            $data['spt'] = $this->model_more->get_spt_id($id_spt);
    	    $data['peg'] = $this->model_more->get_peg_spt($id_spt);
    	    $data['no_surat'] = $this->model_more->get_no_surat_spt($id_spt)->row();
            $this->load->view('sijuara/persuratan/spt/status',$data);
        } else {
            echo "zonk";
        }
    }

    function save_surat_keluar(){
	    $status = $this->input->post('status');
	    if($status=="save"){
	        $this->model_more->save_surat_keluar();    
	    } else {
	        $this->model_more->update_surat_keluar();
	    }
		
		redirect('sijuara/buat_surat_keluar');
	}
	
	function delete_surat_keluar(){
	    $id = $this->uri->segment(3);
	    $this->db->query("delete from sijuara_surat_keluar where id_surat_keluar='$id'");
	    redirect('sijuara/buat_surat_keluar');
	}
	
    function save_surat_masuk(){
	    $status = $this->input->post('status');
	    if($status=="save"){
	        $this->model_more->save_surat_masuk();    
	    } else {
	        $this->model_more->update_surat_masuk();
	    }
		
		redirect('sijuara/buat_surat_masuk');
	}

	function daftar_surat(){
	    cek_session_admin1();
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
		$data['rec'] = $this->model_more->daftar_surat();
		$data['kabalai'] = $this->model_more->get_pj_ttd($id_pjs->id_pejabat)->row();
        $this->template->load('sijuara/persuratan/surat_keluar/template_form','sijuara/persuratan/surat_keluar/surat',$data);
	}
	
	function buat_surat(){
	    $data['tanggal'] = date('Y-m-d');
	    $data['lampiran'] = "";
	    $data['hal'] = "";
	    $data['kepada'] = "";
	    $data['lokasi_kepada'] = "";
	    $data['isi_surat'] = "";
	    $data['status'] = "save";
	    $data['id_buat_surat'] = "";
	    $data['tembusan'] = "";
	    $data['arsip'] = "";
        $data['arsip_val'] = "--";
	    $data['ars'] = $this->model_more->get_klas_arsip();
	    
	    if(isset($_GET['id_bs'])){
	        $id_bs = $_GET['id_bs'];
	        $qw_id = $this->model_more->surat_id($id_bs)->row();
	        $data['tanggal'] = $qw_id->tanggal;
    	    $data['lampiran'] = $qw_id->lampiran;
    	    $data['hal'] = $qw_id->hal;
    	    $data['kepada'] = $qw_id->kepada;
    	    $data['lokasi_kepada'] = $qw_id->lokasi_kepada;
    	    $data['isi_surat'] = $qw_id->isi_surat;
    	    $data['status'] = "edit";
    	    $data['id_buat_surat'] = $qw_id->id_buat_surat;
    	    $data['tembusan'] = $qw_id->tembusan;
    	    $data['arsip'] = $qw_id->id_sub_arsip;
            $data['arsip_val'] = $qw_id->kode_sub_arsip." - ".$qw_id->arsip." - ".$qw_id->sub_arsip;
	        
	    }
	    
	    if(isset($_GET['cs'])){
	        $cs = $_GET['cs'];
	        $qw_id = $this->model_more->surat_id($cs)->row();
	        $data['tanggal'] = date('Y-m-d');
    	    $data['lampiran'] = $qw_id->lampiran;
    	    $data['hal'] = $qw_id->hal;
    	    $data['kepada'] = $qw_id->kepada;
    	    $data['lokasi_kepada'] = $qw_id->lokasi_kepada;
    	    $data['isi_surat'] = $qw_id->isi_surat;
    	    $data['status'] = "save";
    	    $data['id_buat_surat'] = $qw_id->id_buat_surat;
    	    $data['tembusan'] = $qw_id->tembusan;
    	    $data['arsip'] = $qw_id->id_sub_arsip;
            $data['arsip_val'] = $qw_id->kode_sub_arsip." - ".$qw_id->arsip." - ".$qw_id->sub_arsip;
	        
	    }
	    $this->template->load('sijuara/persuratan/surat_keluar/template_form','sijuara/persuratan/surat_keluar/buat_surat',$data);
	}
	function delete_surat(){
	    $id = $this->uri->segment(3);
	    $this->db->query("delete from sijuara_buat_surat where id_buat_surat='$id'");
	    redirect('sijuara/daftar_surat');
	}
	
	function verif_surat(){
	    cek_session_admin1();
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
	    $kabalai = $this->model_more->get_pj_ttd($id_pjs->id_pejabat)->row();
	    $user_vr = $this->session->username;
	    if($kabalai->username==$user_vr){
	        $data['rec'] = $this->model_more->daftar_surat_kabalai();
    		$data['kabalai'] = $kabalai;
            $this->template->load('sijuara/persuratan/verif_surat/template_form','sijuara/persuratan/verif_surat/daftar_surat',$data);    
	    } else {
	        echo "Anda Tidak Memiliki Hak Akses";
	    }
		
	}
	
	function verif_surat_detail(){
	    cek_session_admin1();
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
	    $kabalai = $this->model_more->get_pj_ttd($id_pjs->id_pejabat)->row();
	    $user_vr = $this->session->username;
	    if($kabalai->username==$user_vr){
    	    $id_spt = $this->uri->segment(3);
    	    $qw_spt = $this->db->query("select * from sijuara_buat_surat where id_buat_surat = '$id_spt'")->row();
    	    if($qw_spt->verif_kabalai==0){
    	        $data['spt'] = $qw_spt;
        	    $data['no_surat'] = $this->model_more->get_no_surat_buat($id_spt)->row();
        	    $data['kabalai'] = $kabalai;
        	    $data['ss'] = $this->session->username;
        	    $this->template->load('sijuara/persuratan/verif_surat/template_form','sijuara/persuratan/verif_surat/verif_surat',$data);
    	    } else {
    	        echo "Surat Sudah di Setujui";
    	    }
	    } else {
	        echo "Anda Tidak Memiliki Akses !!!";
	    }
	}
	
	function setuju_surat(){
	    cek_session_admin1();
	    $id_spt = $this->uri->segment(3);
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
	    $qw_spt = $this->db->query("select * from sijuara_buat_surat where id_buat_surat = '$id_spt'")->row();
	    
	    $qw_id_arsip = $this->model_more->get_id_sub_arsip($qw_spt->id_arsip)->row();
	    $tujuan_surat = $qw_spt->kepada;
	    $user = $qw_spt->user;
	    $tanggal = $qw_spt->tanggal;
	    $pc_tgx = explode("-",$tanggal);
	    $perihal = $qw_spt->hal;
	    $tgl_input = date('Y-m-d H:i:s');
	    $no_lengkap = "-/".$qw_id_arsip->kode_sub_arsip."/H.10.29/".$pc_tgx[1]."/".$pc_tgx[0];
	    $this->db->query("update sijuara_buat_surat set verif_kabalai = 1, pj_ttd = '$id_pjs->id_pejabat' where id_buat_surat = '$id_spt'");
	     $this->db->query("insert into sijuara_surat_keluar 
	                        (id_buat_surat,tujuan_surat,tanggal,perihal,user,tanggal_input,no_lengkap)
	                        values ('$id_spt','$tujuan_surat','$tanggal','$perihal','$user','$tgl_input','$no_lengkap')
	                        ");
	    redirect('sijuara/verif_surat');
	}
	function pdf_surat_manual(){
	        ob_start();    
	        $uri3 = $this->uri->segment(3);
	        $id_spt = $this->uri->segment(4);
	        $kd = substr($uri3,0,6);
	        $nm_qr = $kd."/".$id_spt;
	        $link_url = "http://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status_surat/";
	        
	        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        //$config['cacheable']    = true; //boolean, the default is true
        //$config['cachedir']     = './assets/'; //string, the default is application/cache/
        //$config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './asset/file_lainnya/qr_code_surat/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
 
    	    $data['spt'] = $this->db->query("select * from sijuara_buat_surat where id_buat_surat = '$id_spt'")->row();
    	    $data['no_surat'] = $this->model_more->get_no_surat_buat($id_spt)->row();
	        $this->load->view('sijuara/persuratan/surat_keluar/print_manual',$data);    
	        $html = ob_get_contents();        
	        ob_end_clean();            
	        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
	        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');    
	        $pdf->WriteHTML($html);    
	        $pdf->Output();
	        //$pdf->Output('Tes.pdf', 'D');
	}
	
	function pdf_suratx(){
	        $uri3 = $this->uri->segment(3);
	        $id_spt = $this->uri->segment(4);
	        $kd = substr($uri3,0,6);
	        $nm_qr = $kd."/".$id_spt;
	        $link_url = "http://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status_surat/";
	        
	        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        $config['imagedir']     = './asset/file_lainnya/qr_code_surat/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
 
    	    $data['spt'] = $this->db->query("select * from sijuara_buat_surat where id_buat_surat = '$id_spt'")->row();
    	    $data['no_surat'] = $this->model_more->get_no_surat_buat($id_spt)->row();
	        $this->load->view('sijuara/persuratan/surat_keluar/print',$data);
	}
	
	function pdf_surat_manualx(){
	        $uri3 = $this->uri->segment(3);
	        $id_spt = $this->uri->segment(4);
	        $kd = substr($uri3,0,6);
	        $nm_qr = $kd."/".$id_spt;
	        $link_url = "http://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status_surat/";
	        
	        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        $config['imagedir']     = './asset/file_lainnya/qr_code_surat/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
 
    	    $data['spt'] = $this->db->query("select * from sijuara_buat_surat where id_buat_surat = '$id_spt'")->row();
    	    $data['no_surat'] = $this->model_more->get_no_surat_buat($id_spt)->row();
	        $this->load->view('sijuara/persuratan/surat_keluar/print_manual',$data);
	}
	
	function status_surat(){
        $uri3 = $this->uri->segment(3);
        $id_spt = $this->uri->segment(4);
        $a = md5($id_spt);
        $b = substr($a,0,6);
        if($uri3==$b){
            $data['spt'] = $this->db->query("select * from sijuara_buat_surat where id_buat_surat = '$id_spt'")->row();
    	    $data['no_surat'] = $this->model_more->get_no_surat_buat($id_spt)->row();
            $this->load->view('sijuara/persuratan/surat_keluar/status',$data);
        } else {
            echo "zonk";
        }
    }
	function lap_spt(){
	    $id_spt = $this->uri->segment(3);
	    $spt_id = $this->model_more->spt_no_id($id_spt)->row();
	    $data['id_lap_spt'] = "";
	    $data['id_spt'] = "";
	    $data['transportasi'] = "";
	    $data['tolak_ukur_kegiatan'] = "";
	    $data['lokasi'] = "";
	    $data['uraian'] = "";
	    $data['gbr_dok'] = "";
	    $data['status'] = "save";
	    $data['nama_file'] = "";
	    $data['spt'] = $spt_id;
	    $data['harus'] = 'required';
	    
	    if(isset($_GET['edit'])){
	        $id_spt = $_GET['edit'];
	        $spt_id = $this->model_more->lap_spt_id_spt($id_spt)->row();
	        $data['id_lap_spt'] = $spt_id->id_lap_spt;
    	    $data['id_spt'] = "";
    	    $data['transportasi'] = $spt_id->transportasi;
    	    $data['tolak_ukur_kegiatan'] = $spt_id->tolak_ukur_kegiatan;
    	    $data['lokasi'] = $spt_id->lokasi;
    	    $data['uraian'] = $spt_id->uraian;
    	    $data['gbr_dok'] = "";
    	    $data['status'] = "edit";
    	    $data['nama_file'] = $spt_id->gbr_dok;
    	    $data['spt'] = $this->model_more->spt_no_id($id_spt)->row();
    	    $data['harus'] = '';
	    }
	    $data['arr'] = $this->model_polling->list_kegiatan_a()->result();
	    /*
	    $data['arr'] = $this->db->query("select b.id_pj 
	                                from sijuara_pelaku_spt a 
	                                inner join ms_peg b on a.id_peg=b.id_peg
	                                where a.id_spt = '$id_spt'")->result();
	   */
	    $this->template->load('sijuara/persuratan/spt/template_form','sijuara/persuratan/spt/buat_lap_spt',$data);
	}
	
	function save_lap_spt(){
	    $status = $this->input->post('status');
	    if($status=="save"){
	        $this->model_more->save_lap_spt();    
	    } else {
	        $this->model_more->update_lap_spt();
	    }
		
		redirect('sijuara/buat_lap_spt');
	}
	
	function verif_lap_spt(){
	    cek_session_admin1();
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
	    $kabalai = $this->model_more->get_pj_ttd($id_pjs->id_pejabat)->row();
	    $user_vr = $this->session->username;
	    if($kabalai->username==$user_vr){
	        $data['rec'] = $this->model_more->daftar_lap_spt_kabalai();
    		$data['kabalai'] = $kabalai;
            $this->template->load('sijuara/persuratan/verif_surat/template_form','sijuara/persuratan/verif_surat/daftar_lap_spt',$data);    
	    } else {
	        echo "Anda Tidak Memiliki Hak Akses";
	    }
		
	}
	
	function verif_lap_spt_detail(){
	    cek_session_admin1();
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
	    $kabalai = $this->model_more->get_pj_ttd($id_pjs->id_pejabat)->row();
	    $user_vr = $this->session->username;
	    if($kabalai->username==$user_vr){
    	    $id_spt = $this->uri->segment(3);
    	    $model_lap = $this->model_more->lap_spt_id_spt($id_spt)->row();
	        $user = $model_lap->user;
    	    if($model_lap->verif_kabalai==0){
    	        $data['spt'] = $this->model_more->get_spt_id($id_spt);
    		    $data['peg'] = $this->model_more->get_peg_spt($id_spt);
    		    $data['no_surat'] = $this->model_more->get_no_surat_spt($id_spt)->row();
    		    $data['lap_spt'] = $model_lap;
    		    $data['user'] = $this->model_more->get_yg_membuat($user)->row();
        	    $data['kabalai'] = $kabalai;
        	    //$data['ss'] = $this->session->username;
        	    $this->template->load('sijuara/persuratan/verif_surat/template_form','sijuara/persuratan/verif_surat/verif_lap_spt',$data);
    	    } else {
    	        echo "Laporan Perjalanan Dinas Sudah di Setujui";
    	    }
	    } else {
	        echo "Anda Tidak Memiliki Akses !!!";
	    }
	}
	
	function setuju_lap_spt(){
	    cek_session_admin1();
	    $id_spt = $this->uri->segment(3);
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
	    $this->db->query("update sijuara_lap_spt set verif_kabalai = 1, pj_ttd = '$id_pjs->id_pejabat' where id_spt = '$id_spt'");
	    redirect('sijuara/verif_lap_spt');
	}
	
	function tolak_lap_spt(){
	    cek_session_admin1();
	    $id_spt = $_POST['id_spt'];
	    $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
	    $ket = $_POST['keterangan'];
	    $this->db->query("update sijuara_lap_spt set keterangan = '$ket', pj_ttd = '$id_pjs->id_pejabat' where id_spt = '$id_spt'");
	    redirect('sijuara/verif_lap_spt');
	}
	
	function pdf_lap_spt(){
	        ob_start();    
	        $uri3 = $this->uri->segment(3);
	        $id_spt = $this->uri->segment(4);
	        $kd = substr($uri3,0,6);
	        $nm_qr = $kd."/".$id_spt;
	        $link_url = "https://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status_lap_spt/";
	        $model_lap = $this->model_more->lap_spt_id_spt($id_spt)->row();
	        $user = $model_lap->user;
	        
	        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        //$config['cacheable']    = true; //boolean, the default is true
        //$config['cachedir']     = './assets/'; //string, the default is application/cache/
        //$config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './asset/file_lainnya/qr_code_lap_spt/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
 
    	    $data['spt'] = $this->model_more->get_spt_id($id_spt);
    	    $data['peg'] = $this->model_more->get_peg_spt($id_spt);
    	    $data['no_surat'] = $this->model_more->get_no_surat_spt($id_spt)->row();
    	    $data['lap_spt'] = $model_lap;
    		$data['user'] = $this->model_more->get_yg_membuat($user)->row();
	        $this->load->view('sijuara/persuratan/spt/print_lap',$data);    
	        $html = ob_get_contents();        
	        ob_end_clean();            
	        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
	        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');    
	        $pdf->WriteHTML($html);    
	        $pdf->Output();
	        //$pdf->Output('Tes.pdf', 'D');
	}
	
	function pdf_lap_spt_manual(){
	        ob_start();    
	        $uri3 = $this->uri->segment(3);
	        $id_spt = $this->uri->segment(4);
	        $kd = substr($uri3,0,6);
	        $nm_qr = $kd."/".$id_spt;
	        $link_url = "http://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status_lap_spt/";
	        $model_lap = $this->model_more->lap_spt_id_spt($id_spt)->row();
	        $user = $model_lap->user;
	        
	        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        //$config['cacheable']    = true; //boolean, the default is true
        //$config['cachedir']     = './assets/'; //string, the default is application/cache/
        //$config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './asset/file_lainnya/qr_code_lap_spt/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
 
    	    $data['spt'] = $this->model_more->get_spt_id($id_spt);
    	    $data['peg'] = $this->model_more->get_peg_spt($id_spt);
    	    $data['no_surat'] = $this->model_more->get_no_surat_spt($id_spt)->row();
    	    $data['lap_spt'] = $model_lap;
    		$data['user'] = $this->model_more->get_yg_membuat($user)->row();
	        $this->load->view('sijuara/persuratan/spt/print_lap_manual',$data);    
	        $html = ob_get_contents();        
	        ob_end_clean();            
	        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
	        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');    
	        $pdf->WriteHTML($html);    
	        $pdf->Output();
	        //$pdf->Output('Tes.pdf', 'D');
	}
	
	function pdf_lap_spt2(){
        $uri3 = $this->uri->segment(3);
        $id_spt = $this->uri->segment(4);
        $kd = substr($uri3,0,6);
        $nm_qr = $kd."/".$id_spt;
        $link_url = "https://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status_lap_spt/";
        $model_lap = $this->model_more->lap_spt_id_spt($id_spt)->row();
        $user = $model_lap->user;
        
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['imagedir']     = './asset/file_lainnya/qr_code_lap_spt/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
 
    	    $data['spt'] = $this->model_more->get_spt_id($id_spt);
    	    $data['peg'] = $this->model_more->get_peg_spt($id_spt);
    	    $data['no_surat'] = $this->model_more->get_no_surat_spt($id_spt)->row();
    	    $data['lap_spt'] = $model_lap;
    		$data['user'] = $this->model_more->get_yg_membuat($user)->row();
	        $this->load->view('sijuara/persuratan/spt/print_lap',$data);    
	}
	
	function pdf_lap_spt_manual2(){
	        $uri3 = $this->uri->segment(3);
	        $id_spt = $this->uri->segment(4);
	        $kd = substr($uri3,0,6);
	        $nm_qr = $kd."/".$id_spt;
	        $link_url = "http://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status_lap_spt/";
	        $model_lap = $this->model_more->lap_spt_id_spt($id_spt)->row();
	        $user = $model_lap->user;
	        
	        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['imagedir']     = './asset/file_lainnya/qr_code_lap_spt/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
 
    	    $data['spt'] = $this->model_more->get_spt_id($id_spt);
    	    $data['peg'] = $this->model_more->get_peg_spt($id_spt);
    	    $data['no_surat'] = $this->model_more->get_no_surat_spt($id_spt)->row();
    	    $data['lap_spt'] = $model_lap;
    		$data['user'] = $this->model_more->get_yg_membuat($user)->row();
	        $this->load->view('sijuara/persuratan/spt/print_lap_manual',$data);
	}
	
    function status_lap_spt(){
        $uri3 = $this->uri->segment(3);
        $id_spt = $this->uri->segment(4);
        $a = md5($id_spt);
        $b = substr($a,0,6);
        if($uri3==$b){
            $model_lap = $this->model_more->lap_spt_id_spt($id_spt)->row();
	        $user = $model_lap->user;
            $data['spt'] = $this->model_more->get_spt_id($id_spt);
    	    $data['peg'] = $this->model_more->get_peg_spt($id_spt);
    	    $data['no_surat'] = $this->model_more->get_no_surat_spt($id_spt)->row();
    	    $data['lap_spt'] = $model_lap;
    		$data['user'] = $this->model_more->get_yg_membuat($user)->row();
            $this->load->view('sijuara/persuratan/spt/status_lap',$data);
        } else {
            echo "zonk";
        }
    }
    
    // super_user
    
    function pegawai(){
        $data['peg'] = $this->model_polling->pegawai();
        $this->template->load('sijuara/template_cltr','sijuara/super_user/pegawai',$data);
    }
    
    function save_pegawai(){
        $status = $this->db->escape_str($this->input->post('status'));
        if($status=="save"){
            $this->model_polling->save_pegawai();
        } else {
            $this->model_polling->update_pegawai();
        }
        redirect('sijuara/pegawai');
    }
    
    function hapus_pegawai(){
        $uri3 = $this->uri->segment(3);
        $get_pj = $this->db->query("select id_pj from sijuara_pj where id_bio = '$uri3'")->row();
        $id_pj = $get_pj->id_pj;
        $this->db->query("delete from t_biodata where id_bio = '$uri3'");
        $this->db->query("delete from sijuara_pj where id_bio = '$uri3'");
        $this->db->query("delete from sijuara_user where id_pj = '$id_pj'");
        redirect('sijuara/pegawai');
    }
    
    function edit_pegawai(){
	    cek_session_admin1();
	    if(isset($_POST['id_bio'])){
		    $id_bio = $_POST['id_bio'];
		    $data['peg'] = $this->model_polling->peg_id($id_bio)->row();
			$this->load->view('sijuara/super_user/edit_pegawai',$data);
		}
	}
	
	function buat_user(){
	    cek_session_admin1();
	    if(isset($_POST['id_bio'])){
		    $id_bio = $_POST['id_bio'];
		    $user = $this->model_polling->user_id($id_bio)->row();
		    $data['bio'] = $this->model_polling->peg_id($id_bio)->row();
		    if(!empty($user->username)){
		        $data['id_user'] = $user->id_user;
		        $data['id_pj'] = $user->id_pj;
		        $data['username'] = $user->username;
		        $data['password'] = "12345678";
		        $data['status'] = "edit";
		    } else {
		        $data['id_user'] = "";
		        $data['id_pj'] = "";
		        $data['username'] = "";
		        $data['password'] = "";
		        $data['status'] = "save";
		    }
		    
			$this->load->view('sijuara/super_user/buat_user',$data);
		}
	}
	
	function save_user(){
        $status = $this->db->escape_str($this->input->post('status'));
        if($status=="save"){
            $this->model_polling->save_user();
        } else {
            $this->model_polling->update_user();
        }
        redirect('sijuara/pegawai');
    }
    
    function buat_level(){
	    cek_session_admin1();
	    if(isset($_POST['id_bio'])){
		    $id_bio = $_POST['id_bio'];
		    $user = $this->model_polling->user_id($id_bio)->row();
		    $data['bio'] = $this->model_polling->peg_id($id_bio)->row();
		    $data['stakh'] = $this->model_polling->get_stak()->result();
		    if(!empty($user->username)){
		        $lev = $this->model_polling->get_level_id_user($user->id_user)->result();
		        if($lev){
		            $lvll = "";
    		        foreach($lev as $lv){
    		            $lvll .= $lv->id_stakeholder.",";
    		        }
    		        $data['lvl'] = substr($lvll,0,-1);
    		        $data['status'] = "edit";
		        } else {
		            $data['lvl'] = "";
		            $data['status'] = "save";
		        }
		        
		        $data['id_user'] = $user->id_user;
		        $data['id_pj'] = $user->id_pj;
		        $data['username'] = $user->username;
		        $data['password'] = "12345678";
		    } else {
		        $data['lvl'] = "";
		        $data['id_user'] = "";
		        $data['id_pj'] = "";
		        $data['username'] = "";
		        $data['password'] = "";
		        $data['status'] = "save";
		    }
		    
			$this->load->view('sijuara/super_user/buat_level',$data);
		}
	}
	
	function save_level(){
	    $id_user = $this->db->escape_str($this->input->post('id_user'));
        $status = $this->db->escape_str($this->input->post('status'));
        if($status=="save"){
            $this->model_polling->save_level();
        } else {
            $this->db->query("delete from sijuara_level where id_user = '$id_user'");
            $this->model_polling->update_level();
        }
        redirect('sijuara/pegawai');
    }
    
    function logbook(){
	    cek_session_admin1();
	    $user = $this->session->username;
	    $data['bio'] = $this->db->query("select a.* from t_biodata a 
	                                    inner join sijuara_pj b on a.id_bio=b.id_bio 
	                                    inner join sijuara_user c on b.id_pj=c.id_pj
	                                    where c.username='$user'")->row();
	    $data['bulan'] = array("Januari"=>"01","Februari"=>"02","Maret"=>"03",
	                            "April"=>"04","Mei"=>"05","Juni"=>"06",
	                            "Juli"=>"07","Agusutus"=>"08","September"=>"09",
	                            "Oktober"=>"10","November"=>"11","Desember"=>"12");
	    $data['thn'] = date('Y');
	    $data['user'] = $user;
        $this->template->load('sijuara/persuratan/surat_keluar/template_form','sijuara/persuratan/surat_keluar/logbook',$data);
	}
	
	function logbook_detail(){
	    $waktu = $this->uri->segment(3);
	    $user = $this->uri->segment(4);
	    $data['waktu'] = $waktu;
	    $data['username'] = $user;
	    $data['bio'] = $this->db->query("select a.* from t_biodata a 
	                                    inner join sijuara_pj b on a.id_bio=b.id_bio 
	                                    inner join sijuara_user c on b.id_pj=c.id_pj
	                                    where c.username='$user'")->row();
	    $this->template->load('sijuara/persuratan/surat_keluar/template_form','sijuara/persuratan/surat_keluar/logbook_detail',$data);
	}
	
}