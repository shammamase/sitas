<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Utama extends CI_Controller {
	public function index(){
		$this->template->load(template().'/template',template().'/view_home');
	}

	function master_rkakl(){
		cek_session_admin1();
		if(isset($_POST['submit'])){
			$aksi = strip_tags($_POST['aksi']);
			$alokasi = strip_tags($_POST['alokasi']);
			$ta = strip_tags($_POST['ta']);
			$idx = strip_tags($_POST['idx']);
			if($aksi == "edit"){
				$this->db->query("update sijuara_trs_alokasi 
									set alokasi = '$alokasi', ta = '$ta' where id_alokasi = '$idx'");
			} else {
				$this->db->query("insert into sijuara_trs_alokasi (alokasi,ta) values ('$alokasi','$ta')");
			}
			redirect('utama/master_rkakl');
		} else {
			$aksi = $this->uri->segment(3);
			$idx = $this->uri->segment(4);
			if(empty($aksi)){
				$data['aksi'] = "";
				$data['alokasi'] = "";
				$data['ta'] = "";
				$data['idx'] = "";
			} else {
				$qwx = $this->db->query("select * from sijuara_trs_alokasi where id_alokasi = $idx")->row();
				$data['aksi'] = $aksi;
				$data['alokasi'] = $qwx->alokasi;
				$data['ta'] = $qwx->ta;
				$data['idx'] = $idx;
			}
			$this->template->load('sijuara/super/template_form','sijuara/super/buat_rkakl',$data);
		}
	}

	function program(){
		cek_session_admin1();
		if(isset($_POST['submit'])){
			$aksi = strip_tags($_POST['aksi']);
			$id_alokasi = strip_tags($_POST['id_alokasi']);
			$ta = strip_tags($_POST['ta']);
			$kd_program = strip_tags($_POST['kd_program']);
			$program = strip_tags($_POST['program']);
			$jumlah_biaya = strip_tags($_POST['jumlah_biaya']);
			$idx = strip_tags($_POST['idx']);
			if($ta == ""){
				$id_alokasix = $id_alokasi;
			} else {
				$id_alokasix = $ta;
			}
			if($aksi == "edit"){
				$this->db->query("update sijuara_program 
									set id_alokasi = '$id_alokasix', kd_program = '$kd_program', program = '$program', 
									jumlah_biaya = '$jumlah_biaya' where id_program = '$idx'");
			} else {
				$this->db->query("insert into sijuara_program (id_alokasi,kd_program,program,jumlah_biaya) 
									values ('$id_alokasix','$kd_program','$program','$jumlah_biaya')");
			}
			redirect('utama/program/'.$id_alokasix);
		} else {
			$id_alokasi = $this->uri->segment(3);
			$aksi = $this->uri->segment(4);
			$idx = $this->uri->segment(5);
			if(empty($aksi)){
				$data['aksi'] = "";
				$data['kd_program'] = "";
				$data['program'] = "";
				$data['jumlah_biaya'] = "";
				$data['idx'] = "";
			} else {
				$qwx = $this->db->query("select * from sijuara_program where id_program = $idx")->row();
				$data['aksi'] = $aksi;
				$data['kd_program'] = $qwx->kd_program;
				$data['program'] = $qwx->program;
				$data['jumlah_biaya'] = $qwx->jumlah_biaya;
				$data['idx'] = $idx;
			}
			$data['id_alokasi'] = $id_alokasi;
			$data['ta'] = $this->db->query("select * from sijuara_trs_alokasi")->result();
			$this->template->load('sijuara/super/template_form','sijuara/super/buat_program',$data);
		}
	}

	function aktivitas(){
		cek_session_admin1();
		if(isset($_POST['submit'])){
			$aksi = strip_tags($_POST['aksi']);
			$id_program = strip_tags($_POST['id_program']);
			$kd_aktivitas = strip_tags($_POST['kd_aktivitas']);
			$aktivitas = strip_tags($_POST['aktivitas']);
			$idx = strip_tags($_POST['idx']);
			if($aksi == "edit"){
				$this->db->query("update sijuara_aktivitas 
									set id_program = '$id_program', kd_aktivitas = '$kd_aktivitas', aktivitas = '$aktivitas'
								 	where id_aktivitas = '$idx'");
			} else {
				$this->db->query("insert into sijuara_aktivitas (id_program,kd_aktivitas,aktivitas) 
									values ('$id_program','$kd_aktivitas','$aktivitas')");
			}
			redirect('utama/aktivitas/'.$id_program);
		} else {
			$id_program = $this->uri->segment(3);
			$back = $this->db->query("select id_alokasi from sijuara_program where id_program = $id_program")->row();
			$aksi = $this->uri->segment(4);
			$idx = $this->uri->segment(5);
			if(empty($aksi)){
				$data['aksi'] = "";
				$data['kd_aktivitas'] = "";
				$data['aktivitas'] = "";
				$data['idx'] = "";
			} else {
				$qwx = $this->db->query("select * from sijuara_aktivitas where id_aktivitas = $idx")->row();
				$data['aksi'] = $aksi;
				$data['kd_aktivitas'] = $qwx->kd_aktivitas;
				$data['aktivitas'] = $qwx->aktivitas;
				$data['idx'] = $idx;
			}
			$data['back'] = $back->id_alokasi;
			$data['id_program'] = $id_program;
			$this->template->load('sijuara/super/template_form','sijuara/super/buat_aktivitas',$data);
		}
	}

	function kro(){
		cek_session_admin1();
		if(isset($_POST['submit'])){
			$aksi = strip_tags($_POST['aksi']);
			$id_aktivitas = strip_tags($_POST['id_aktivitas']);
			$kd_kro = strip_tags($_POST['kd_kro']);
			$kro = strip_tags($_POST['kro']);
			$vol = strip_tags($_POST['vol']);
			$satuan = strip_tags($_POST['satuan']);
			$idx = strip_tags($_POST['idx']);
			if($aksi == "edit"){
				$this->db->query("update sijuara_kro 
									set id_aktivitas = '$id_aktivitas', kd_kro = '$kd_kro', kro = '$kro', vol = '$vol', satuan = '$satuan'
								 	where id_kro = '$idx'");
			} else {
				$this->db->query("insert into sijuara_kro (id_aktivitas,kd_kro,kro,vol,satuan) 
									values ('$id_aktivitas','$kd_kro','$kro','$vol','$satuan')");
			}
			redirect('utama/kro/'.$id_aktivitas);
		} else {
			$id_aktivitas = $this->uri->segment(3);
			$back = $this->db->query("select id_program from sijuara_aktivitas where id_aktivitas = $id_aktivitas")->row();
			$aksi = $this->uri->segment(4);
			$idx = $this->uri->segment(5);
			if(empty($aksi)){
				$data['aksi'] = "";
				$data['kd_kro'] = "";
				$data['kro'] = "";
				$data['vol'] = "";
				$data['satuan'] = "";
				$data['idx'] = "";
			} else {
				$qwx = $this->db->query("select * from sijuara_kro where id_kro = $idx")->row();
				$data['aksi'] = $aksi;
				$data['kd_kro'] = $qwx->kd_kro;
				$data['kro'] = $qwx->kro;
				$data['vol'] = $qwx->vol;
				$data['satuan'] = $qwx->satuan;
				$data['idx'] = $idx;
			}
			$data['back'] = $back->id_program;
			$data['id_aktivitas'] = $id_aktivitas;
			$this->template->load('sijuara/super/template_form','sijuara/super/buat_kro',$data);
		}
	}

	function ro(){
		cek_session_admin1();
		if(isset($_POST['submit'])){
			$aksi = strip_tags($_POST['aksi']);
			$id_kro = strip_tags($_POST['id_kro']);
			$kd_ro = strip_tags($_POST['kd_ro']);
			$ro = strip_tags($_POST['ro']);
			$vol = strip_tags($_POST['vol']);
			$satuan = strip_tags($_POST['satuan']);
			$jumlah_biaya = strip_tags($_POST['jumlah_biaya']);
			$idx = strip_tags($_POST['idx']);
			if($aksi == "edit"){
				$this->db->query("update sijuara_ro 
									set id_kro = '$id_kro', kd_ro = '$kd_ro', ro = '$ro', 
									vol = '$vol', satuan = '$satuan', jumlah_biaya = '$jumlah_biaya'
								 	where id_ro = '$idx'");
			} else {
				$this->db->query("insert into sijuara_ro (id_kro,kd_ro,ro,vol,satuan,jumlah_biaya) 
									values ('$id_kro','$kd_ro','$ro','$vol','$satuan','$jumlah_biaya')");
			}
			redirect('utama/ro/'.$id_kro);
		} else {
			$id_kro = $this->uri->segment(3);
			$back = $this->db->query("select id_aktivitas from sijuara_kro where id_kro = $id_kro")->row();
			$aksi = $this->uri->segment(4);
			$idx = $this->uri->segment(5);
			if(empty($aksi)){
				$data['aksi'] = "";
				$data['kd_ro'] = "";
				$data['ro'] = "";
				$data['vol'] = "";
				$data['satuan'] = "";
				$data['jumlah_biaya'] = "";
				$data['idx'] = "";
			} else {
				$qwx = $this->db->query("select * from sijuara_ro where id_ro = $idx")->row();
				$data['aksi'] = $aksi;
				$data['kd_ro'] = $qwx->kd_ro;
				$data['ro'] = $qwx->ro;
				$data['vol'] = $qwx->vol;
				$data['satuan'] = $qwx->satuan;
				$data['jumlah_biaya'] = $qwx->jumlah_biaya;
				$data['idx'] = $idx;
			}
			$data['back'] = $back->id_aktivitas;
			$data['id_kro'] = $id_kro;
			$this->template->load('sijuara/super/template_form','sijuara/super/buat_ro',$data);
		}
	}

	function komponen(){
		cek_session_admin1();
		if(isset($_POST['submit'])){
			$aksi = strip_tags($_POST['aksi']);
			$id_ro = strip_tags($_POST['id_ro']);
			$kd_komponen = strip_tags($_POST['kd_komponen']);
			$komponen = strip_tags($_POST['komponen']);
			$jumlah_biaya = strip_tags($_POST['jumlah_biaya']);
			$idx = strip_tags($_POST['idx']);
			if($aksi == "edit"){
				$this->db->query("update sijuara_komponen 
									set id_ro = '$id_ro', kd_komponen = '$kd_komponen', komponen = '$komponen', 
									jumlah_biaya = '$jumlah_biaya'
								 	where id_komponen = '$idx'");
			} else {
				$this->db->query("insert into sijuara_komponen (id_ro,kd_komponen,komponen,jumlah_biaya) 
									values ('$id_ro','$kd_komponen','$komponen','$jumlah_biaya')");
			}
			redirect('utama/komponen/'.$id_ro);
		} else {
			$id_ro = $this->uri->segment(3);
			$back = $this->db->query("select id_kro from sijuara_ro where id_ro = $id_ro")->row();
			$aksi = $this->uri->segment(4);
			$idx = $this->uri->segment(5);
			if(empty($aksi)){
				$data['aksi'] = "";
				$data['kd_komponen'] = "";
				$data['komponen'] = "";
				$data['jumlah_biaya'] = "";
				$data['idx'] = "";
			} else {
				$qwx = $this->db->query("select * from sijuara_komponen where id_komponen = $idx")->row();
				$data['aksi'] = $aksi;
				$data['kd_komponen'] = $qwx->kd_komponen;
				$data['komponen'] = $qwx->komponen;
				$data['jumlah_biaya'] = $qwx->jumlah_biaya;
				$data['idx'] = $idx;
			}
			$data['back'] = $back->id_kro;
			$data['id_ro'] = $id_ro;
			$this->template->load('sijuara/super/template_form','sijuara/super/buat_komponen',$data);
		}
	}

	function subkomp(){
		cek_session_admin1();
		if(isset($_POST['submit'])){
			$aksi = strip_tags($_POST['aksi']);
			$id_komponen = strip_tags($_POST['id_komponen']);
			$kd_subkomp = strip_tags($_POST['kd_subkomp']);
			$subkomp = strip_tags($_POST['subkomp']);
			$jumlah_biaya = strip_tags($_POST['jumlah_biaya']);
			$id_pj = strip_tags($_POST['id_pj']);
			$id_pumk = strip_tags($_POST['id_pumk']);
			$blokir = strip_tags($_POST['blokir']);
			$idx = strip_tags($_POST['idx']);
			if($aksi == "edit"){
				$this->db->query("update sijuara_subkomp 
									set id_komponen = '$id_komponen', kd_subkomp = '$kd_subkomp', subkomp = '$subkomp', 
									jumlah_biaya = '$jumlah_biaya', id_pj = '$id_pj', blokir = '$blokir'
								 	where id_subkomp = '$idx'");
				$this->db->query("update sijuara_pumk set id_pj = '$id_pumk' where id_subkomp = '$idx'");
			} else {
				$this->db->query("insert into sijuara_subkomp (id_komponen,kd_subkomp,subkomp,jumlah_biaya,id_pj,blokir) 
									values ('$id_komponen','$kd_subkomp','$subkomp','$jumlah_biaya','$id_pj','$blokir')");
				$last_id = $this->db->insert_id();
				$this->db->query("insert into sijuara_pumk (id_pj,id_subkomp) values ('$id_pumk','$last_id')");
			}
			redirect('utama/subkomp/'.$id_komponen);
		} else {
			$id_komponen = $this->uri->segment(3);
			$back = $this->db->query("select id_ro from sijuara_komponen where id_komponen = $id_komponen")->row();
			$aksi = $this->uri->segment(4);
			$idx = $this->uri->segment(5);
			if(empty($aksi)){
				$data['aksi'] = "";
				$data['kd_subkomp'] = "";
				$data['subkomp'] = "";
				$data['jumlah_biaya'] = "";
				$data['id_pj'] = "";
				$data['nama_pj'] = "-- Pilih PJ--";
				$data['id_pumk'] = "";
				$data['nama_pumk'] = "-- Pilih PUMK--";
				$data['blokir'] = "";
				$data['idx'] = "";
			} else {
				$qwx = $this->db->query("select * from sijuara_subkomp where id_subkomp = $idx")->row();
				$pj_select = $this->db->query("select a.id_pj, b.nama from sijuara_pj a 
												inner join t_biodata b on a.id_bio=b.id_bio 
												where a.id_pj = $qwx->id_pj")->row();
				$pum_select = $this->db->query("select a.id_pj, b.nama from sijuara_pj a 
												inner join sijuara_pumk aa on aa.id_pj=a.id_pj
												inner join t_biodata b on a.id_bio=b.id_bio 
												where aa.id_subkomp = $qwx->id_subkomp")->row();
				$data['aksi'] = $aksi;
				$data['kd_subkomp'] = $qwx->kd_subkomp;
				$data['subkomp'] = $qwx->subkomp;
				$data['jumlah_biaya'] = $qwx->jumlah_biaya;
				$data['id_pj'] = $qwx->id_pj;
				$data['nama_pj'] = $pj_select->nama;
				$data['id_pumk'] = $pum_select->id_pj;
				$data['nama_pumk'] = $pum_select->nama;
				$data['blokir'] = $qwx->blokir;
				$data['idx'] = $idx;
			}
			$data['back'] = $back->id_ro;
			$data['id_komponen'] = $id_komponen;
			$data['pjx'] = $this->db->query("select a.id_pj, b.id_bio, b.nama from sijuara_pj a 
											inner join sijuara_user aa on a.id_pj=aa.id_pj
											inner join sijuara_level aaa on aa.id_user=aaa.id_user
											inner join t_biodata b on a.id_bio=b.id_bio 
											where aaa.id_stakeholder = 6")->result();
			$data['pum'] = $this->db->query("select a.id_pj, b.id_bio, b.nama from sijuara_pj a 
											inner join sijuara_user aa on a.id_pj=aa.id_pj
											inner join sijuara_level aaa on aa.id_user=aaa.id_user
											inner join t_biodata b on a.id_bio=b.id_bio 
											where aaa.id_stakeholder = 7")->result();
			$this->template->load('sijuara/super/template_form','sijuara/super/buat_subkomp',$data);
		}
	}

	function detil(){
		cek_session_admin1();
		if(isset($_POST['submit'])){
			$aksi = strip_tags($_POST['aksi']);
			$id_subkomp = strip_tags($_POST['id_subkomp']);
			$kd_detil = strip_tags($_POST['kd_detil']);
			$detil = explode("-",$kd_detil);
			$jumlah_biaya = strip_tags($_POST['jumlah_biaya']);
			$idx = strip_tags($_POST['idx']);
			if($aksi == "edit"){
				$this->db->query("update sijuara_detil 
									set id_subkomp = '$id_subkomp', kd_detil = '$detil[0]', detil = '$detil[1]', 
									jumlah_biaya = '$jumlah_biaya' where id_detil = '$idx'");
			} else {
				$this->db->query("insert into sijuara_detil (id_subkomp,kd_detil,detil,jumlah_biaya) 
									values ('$id_subkomp','$detil[0]','$detil[1]','$jumlah_biaya')");
			}
			redirect('utama/detil/'.$id_subkomp);
		} else {
			$id_subkomp = $this->uri->segment(3);
			$back = $this->db->query("select id_komponen from sijuara_subkomp where id_subkomp = $id_subkomp")->row();
			$aksi = $this->uri->segment(4);
			$idx = $this->uri->segment(5);
			$qw_sk = $this->db->query("select subkomp from sijuara_subkomp where id_subkomp = '$id_subkomp'")->row();
			if(empty($aksi)){
				$data['aksi'] = "";
				$data['jumlah_biaya'] = "";
				$data['kd_detilx'] = "";
				$data['nama_detil'] = "-- Pilih Kode Detil --";
				$data['idx'] = "";
			} else {
				$qwx = $this->db->query("select * from sijuara_detil where id_detil = $idx")->row();
				$dtl_slc = $this->db->query("select kd_detil, detil from sijuara_detil  
												where kd_detil = $qwx->kd_detil")->row();
				$data['aksi'] = $aksi;
				$data['jumlah_biaya'] = $qwx->jumlah_biaya;
				$data['kd_detilx'] = $dtl_slc->kd_detil;
				$data['nama_detil'] = $dtl_slc->detil;
				$data['idx'] = $idx;
			}
			$data['back'] = $back->id_komponen;
			$data['subkomp'] = $qw_sk->subkomp;
			$data['id_subkomp'] = $id_subkomp;
			$data['list_dtl'] = $this->db->query("select distinct kd_detil, detil from sijuara_detil")->result();
			$this->template->load('sijuara/super/template_form','sijuara/super/buat_detil',$data);
		}
	}

	function subdetil(){
		cek_session_admin1();
		if(isset($_POST['submit'])){
			$id_detil = strip_tags($_POST['id_detil']);
			$id_subdetil = $_POST['id_subdetil'];
			$subdetil = $_POST['subdetil'];
			$vol = $_POST['vol'];
			$satuan = $_POST['satuan'];
			$harga_satuan = $_POST['harga_satuan'];
			$datax = array();
			$datay = array();
			$index = 0;
			$indx = 0;
			
			foreach($id_subdetil as $value){
				if($value != ""){
					array_push($datax, array(
						'id_subdetil'=>$value,
						'id_detil'=>$id_detil,
						'subdetil'=>$subdetil[$index],
						'vol'=>$vol[$index],
						'satuan'=>$satuan[$index],
						'harga_satuan'=>$harga_satuan[$index]
					));
					$index++;
				}	
			}
			if($index > 0){
				$this->db->update_batch('sijuara_subdetil', $datax, 'id_subdetil');
			}
			foreach($subdetil as $value){
				if($value != "" && $id_subdetil[$indx] == ""){
					array_push($datay, array(
						'id_detil'=>$id_detil,
						'subdetil'=>$value,
						'vol'=>$vol[$indx],
						'satuan'=>$satuan[$indx],
						'harga_satuan'=>$harga_satuan[$indx]
					));
					$indx++;
				}
			}
			if($indx > 0){
				$this->db->insert_batch('sijuara_subdetil', $datay);
			}
			redirect('utama/subdetil/'.$id_detil);
		} else {
			$jml = 20;
			$id_detil = $this->uri->segment(3);
			$back = $this->db->query("select id_subkomp from sijuara_detil where id_detil = $id_detil")->row();
			$qwx = $this->db->query("select * from sijuara_subdetil where id_detil = $id_detil");
			$cek = $qwx->num_rows();
			if($cek > 0){
				$data['subdetil'] = $qwx->result();
				$data['jml'] = $jml;
			} else {
				$data['subdetil'] = "";
				$data['jml'] = $jml;
			}
			$data['back'] = $back->id_subkomp;
			$data['id_detil'] = $id_detil;
			$data['dtl'] = $this->db->query("select kd_detil,detil from sijuara_detil where id_detil = $id_detil")->row();
			$this->template->load('sijuara/super/template_form','sijuara/super/buat_subdetil',$data);
		}
	}

	function hapus_subdetil(){
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$this->db->query("delete from sijuara_subdetil where id_subdetil = $uri4");
		redirect('utama/subdetil/'.$uri3);
	}

	function buat_subdetil(){
		cek_session_admin1();
		if(isset($_POST['submit'])){
			$id_detil = strip_tags($_POST['id_detil']);
			$jumlah_biaya = strip_tags($_POST['jumlah_biaya']);
			$detilx = explode("-",$id_detil);
			$id_subkomp = strip_tags($_POST['id_subkomp']);
			$id_subdetil = $_POST['id_subdetil'];
			$subdetil = $_POST['subdetil'];
			$vol = $_POST['vol'];
			$satuan = $_POST['satuan'];
			$harga_satuan = $_POST['harga_satuan'];
			$datax = array();
			$index = 0;

			$this->db->query("insert into sijuara_detil (id_subkomp,kd_detil,detil,jumlah_biaya) 
									values ('$id_subkomp','$detilx[0]','$detilx[1]','$jumlah_biaya')");
			$last_id_dtl = $this->db->insert_id();
			foreach($subdetil as $value){
				if($value != ""){
					array_push($datax, array(
						'id_detil'=>$last_id_dtl,
						'subdetil'=>$value,
						'vol'=>$vol[$index],
						'satuan'=>$satuan[$index],
						'harga_satuan'=>$harga_satuan[$index]
					));
					$index++;
				}
			}
			if($index > 0){
				$this->db->insert_batch('sijuara_subdetil', $datax);
			}
			redirect('utama/buat_subdetil');
		} else {
			$thn = date('Y');
			if(empty($_GET['kd_detil'])){
				$kd_detil = "";
				$id_subkomp = "";
				$data['keg'] = "";
				$data['kd_detil'] = "";
				$data['detil'] = "";
				$data['sdtl'] = NULL;
			} else {
				$kd_detil = $_GET['kd_detil'];
				$id_subkomp = $_GET['id_subkomp'];
				$qw_keg = $this->db->query("select a.kd_detil,a.detil,b.subkomp from sijuara_detil a 
											inner join sijuara_subkomp b on a.id_subkomp = b.id_subkomp
											where b.id_subkomp = $id_subkomp and a.kd_detil like '%$kd_detil%'")->row();
				$sdtl = $this->db->query("select a.subdetil,a.vol,a.satuan,a.harga_satuan from sijuara_subdetil a 
											inner join sijuara_detil b on a.id_detil = b.id_detil
											inner join sijuara_subkomp c on b.id_subkomp = c.id_subkomp
											where c.id_subkomp = $id_subkomp and b.kd_detil like '%$kd_detil%'")->result();
				$data['keg'] = $qw_keg->subkomp;
				$data['kd_detil'] = $qw_keg->kd_detil;
				$data['detil'] = $qw_keg->detil;
				$data['sdtl'] = $sdtl;
			}
			$data['list_dtl'] = $this->db->query("select distinct kd_detil, detil from sijuara_detil")->result();
			$data['subkomp'] = $this->db->query("select a.id_subkomp, a.subkomp, g.ta 
													from sijuara_subkomp a
													inner join sijuara_komponen b on a.id_komponen = b.id_komponen
													inner join sijuara_ro c on b.id_ro = c.id_ro
													inner join sijuara_kro d on c.id_kro = d.id_kro
													inner join sijuara_aktivitas e on d.id_aktivitas = e.id_aktivitas
													inner join sijuara_program f on e.id_program = f.id_program
													inner join sijuara_trs_alokasi g on f.id_alokasi = g.id_alokasi")->result();
			$data['subkomp2'] = $this->db->query("select a.id_subkomp, a.subkomp, g.ta 
													from sijuara_subkomp a
													inner join sijuara_komponen b on a.id_komponen = b.id_komponen
													inner join sijuara_ro c on b.id_ro = c.id_ro
													inner join sijuara_kro d on c.id_kro = d.id_kro
													inner join sijuara_aktivitas e on d.id_aktivitas = e.id_aktivitas
													inner join sijuara_program f on e.id_program = f.id_program
													inner join sijuara_trs_alokasi g on f.id_alokasi = g.id_alokasi
													where g.ta = '$thn'")->result();
			$this->template->load('sijuara/super/template_form','sijuara/super/buat_subdetil2',$data);
		}
	}
	
}
