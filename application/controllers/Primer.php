<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Primer extends CI_Controller {
    function index(){
		if (isset($_POST['submit'])){
			$username = strip_tags($this->input->post('a'));
			$password = md5($this->input->post('b'));
            $tahun = strip_tags($this->input->post('c'));
			$redir = strip_tags($this->input->post('d'));
			$cek = $this->model_sitas->cek_login_sijuara($username,$password);
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata('upload_image_file_manager',true);
				$this->session->set_userdata(array('username'=>$row['username'],'tahun'=>$tahun));
				if($redir != ""){
					redirect('primer/'.$redir);
				} else {
					redirect('primer/home');
				}
			}else{
				if(!empty($_GET['redir'])){
					$redir = $_GET['redir'];
				} else {
					$redir = "";
				}
				$data['redir'] = $redir;
				$data['title'] = 'BSIP TAS &rsaquo; Log In';
				$this->load->view('sitas/view_login',$data);
			}
		}else{
			if(!empty($_GET['redir'])){
				$redir = $_GET['redir'];
			} else {
				$redir = "";
			}
			if ($this->session->username != ''){
				if($redir != ""){
					redirect('primer/'.$redir);
				} else {
					redirect('primer/home');
				}
			}else{
				$data['redir'] = $redir;
				$data['title'] = 'BSIP TAS &rsaquo; Log In';
				$this->load->view('sitas/view_login',$data);
			}
		}
	}

    function tes_masuk(){
        cek_session_admin1();
        echo "masuk ".$this->session->username." ".$this->session->tahun;
    }

	function home(){
		cek_session_admin1();
		$thn = $this->session->tahun;
		$data['thn'] = $thn;
		$data['jml_v1'] = 0;//$this->model_more->daftar_spt_kabalai()->num_rows();
		$data['jml_v2'] = 0;//$this->model_more->daftar_surat_kabalai()->num_rows();
		$data['jml_v3'] = $this->model_sitas->jmlDataBy("id_surat_masuk","surat_masuk","id_verifikasi = 0");
		$data['jml_v4'] = 0;//$this->model_more->daftar_lap_spt_kabalai()->num_rows();
		$data['jml_surat_masuk'] = $this->model_sitas->jmlDataBy("id_surat_masuk","surat_masuk","tanggal_masuk like '%$thn%'");
		$data['jml_surat_keluar'] = 0;//$this->model_more->daftar_surat_keluar()->num_rows();
		$data['jml_surat'] = 0;//$this->model_more->daftar_surat()->num_rows();
		$data['jml_spt'] = 0;//$this->model_more->daftar_spt()->num_rows();
		$data['jml_perjadin'] = 0;//$this->model_more->daftar_lap_spt22()->num_rows();
		$data['jml_anggaran'] = 0;//$this->db->query("select id_pengajuan from sijuara_simpan_pengajuan a
		/*									
		inner join sijuara_detil b on a.id_detil=b.id_detil
											inner join sijuara_subkomp c on b.id_subkomp=c.id_subkomp
											inner join sijuara_komponen d on c.id_komponen=d.id_komponen
											inner join sijuara_ro e on d.id_ro=e.id_ro
											inner join sijuara_kro f on e.id_kro=f.id_kro
											inner join sijuara_aktivitas g on f.id_aktivitas=g.id_aktivitas
											inner join sijuara_program h on g.id_program=h.id_program
											inner join sijuara_trs_alokasi i on h.id_alokasi=i.id_alokasi
											where i.ta like '%$thn%'")->num_rows();
		*/
		$data['jml_monev'] = 0;//$this->db->query("select id_monev from sijuara_monev where lap_bln like '%$thn%'")->num_rows();
		$data['jml_drive'] = 0;//$this->db->query("select id_file from sijuara_file where tahun = '$thn'")->num_rows();
		$data['list_x_perjadin'] = 0;//$this->model_more->daftar_belum_buat_perjadin();
		$data['jml_list_x_perjadin'] = 0;//$this->model_more->daftar_belum_buat_perjadin_jml();
		$data['jml_tamu'] = $this->model_sitas->jmlDataBy("id_tamu","buku_tamu","waktu like '%$thn%'");
		$this->template->load('sijuara/templatex','sijuara/view_homex_cltr',$data);
	}

	function buat_surat_masuk(){
		cek_session_admin1();
		$thn = $this->session->tahun;
		$id_pjs = $this->model_sitas->rowDataBy("*","pejabat_verifikator","level = 'akhir'")->row();
		$list_kode = $this->model_sitas->listData("*","klasifikasi_sub_arsip","id_sub_arsip");
		$agenda = $this->model_sitas->rowDataDesc("no_agenda","surat_masuk","id_surat_masuk");
		if(empty($agenda->no_agenda)){
            $no_agenda = 1;
        } else {
            $no_agenda = $agenda->no_agenda + 1;
        }
        $data['no_agenda'] = $no_agenda;
		$data['no_surat_masuk'] = "";
        $data['asal_surat'] = "";
        $data['tanggal_masuk'] = date('Y-m-d');
        $data['tanggal'] = date('Y-m-d');
        $data['perihal'] = "";
        $data['id_surat_masuk'] = 0;
        $data['status'] = "save";
        $data['read'] = "";
        $data['file_pdf'] = "";
        $data['nama_file'] = "";
		$data['id_sub_arsip'] = "";
        $data['kode_klasifikasi'] = "Pilih Klasifikasi";
		$data['uri3'] = $this->uri->segment(3);
        $data['list_kode'] = $list_kode;
        if(isset($_GET['id_sm'])){
            $id_sm = $_GET['id_sm'];
			$qw = $this->model_sitas->rowDataBy("*","surat_masuk","id_surat_masuk = $id_sm")->row();
			$kode_kl = $this->model_sitas->rowDataBy("kode_sub_arsip,sub_arsip","klasifikasi_sub_arsip","id_sub_arsip = $qw->id_sub_arsip")->row();
            $data['no_agenda'] = $qw->no_agenda;
			$data['no_surat_masuk'] = $qw->no_surat_masuk;
            $data['asal_surat'] = $qw->asal_surat;
            $data['tanggal_masuk'] = $qw->tanggal_masuk;
            $data['tanggal'] = $qw->tanggal;
            $data['perihal'] = $qw->perihal;
            $data['id_surat_masuk'] = $qw->id_surat_masuk;
            $data['status'] = "edit";
            $data['read'] = "";
            if(!empty($qw->file_pdf)){
                $data['file_pdf'] = "<a class='btn btn-warning btn-xs' title='PDF' target='_blank' href='".base_url()."asset/surat_masuk/".$qw->file_pdf."'><i class='fas fa-file-pdf'></i> Lihat PDF</a>";
            } else {
                $data['file_pdf'] = "";
            }
            
            $data['nama_file'] = $qw->file_pdf;
			$data['id_sub_arsip'] = $qw->id_sub_arsip;
            $data['kode_klasifikasi'] = $kode_kl->kode_sub_arsip." - ".$kode_kl->sub_arsip;
        }
        
        if(isset($_GET['copy'])){
            $id_skm = $_GET['copy'];
			$qw = $this->model_sitas->rowDataBy("*","surat_masuk","id_surat_masuk = $id_skm")->row();
			$kode_kl = $this->model_sitas->rowDataBy("kode_sub_arsip,sub_arsip","klasifikasi_sub_arsip","id_sub_arsip = $qw->id_sub_arsip")->row();
            $data['no_agenda'] = $no_agenda;
			$data['no_surat_masuk'] = $qw->no_surat_masuk;
            $data['asal_surat'] = $qw->asal_surat;
            $data['tanggal_masuk'] = date('Y-m-d');
            $data['tanggal'] = date('Y-m-d');
            $data['perihal'] = $qw->perihal;
            $data['id_surat_masuk'] = 0;
            $data['status'] = "save";
            $data['read'] = "";
            $data['file_pdf'] = "";
            $data['nama_file'] = "";
			$data['id_sub_arsip'] = $qw->id_sub_arsip;
            $data['kode_klasifikasi'] = $kode_kl->kode_sub_arsip." - ".$kode_kl->sub_arsip;
        }
		$data['kabalai'] = $this->model_sitas->rowDataBy("nip,nama,no_hp","pegawai","id_pegawai = $id_pjs->id_pegawai")->row();
		$data['rec'] = $this->model_sitas->listDataBy("*","surat_masuk","tanggal_masuk like '%$thn%'","id_surat_masuk desc");
		$this->template->load('sitas/template_form','sitas/buat_surat_masuk',$data);
    }
	public function save_surat_masuk(){
        date_default_timezone_set('Asia/Jakarta');
		$id_surat_masuk = $this->input->post('id_surat_masuk');
        $get_pjb_ttd = $this->model_sitas->rowDataBy("b.no_hp","pejabat_verifikator a inner join pegawai b on a.id_pegawai=b.id_pegawai","a.level = 'akhir'")->row();
        $no_hp = $get_pjb_ttd->no_hp;
        $links = base_url('primer?redir=disposisi');
        $no_wa = substr_replace("$no_hp","62",0,1);
        $pesan = "*Layanan BSIP TAS* Ada surat masuk, silahkan klik link berikut $links ";
        $data = [
            'id_sub_arsip' => $this->input->post('id_sub_arsip'),
            'no_agenda' => $this->input->post('no_agenda'),
            'no_surat_masuk' => $this->input->post('no_surat_masuk'),
            'asal_surat' => $this->input->post('asal_surat'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'tanggal' => $this->input->post('tanggal'),
            'perihal' => $this->input->post('perihal'),
            'user' => $this->session->username,
            'tanggal_input' => date('Y-m-d H:i:s')
        ];
        if($id_surat_masuk == 0){
            //(tabel,data,folder_tujuan,folder_tujuan_compres)
            $this->model_sitas->saveDataWithFile("surat_masuk",$data,"asset/surat_masuk","");
        } else {
            $this->model_sitas->updateDataWithFile("surat_masuk","id_surat_masuk",$id_surat_masuk,$data,"asset/surat_masuk");
        }
        $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
        redirect('primer/buat_surat_masuk');
  }
  public function hapus_surat_masuk(){
    $uri = $this->uri->segment(3);
    $this->model_sitas->deleteDataWithFile("surat_masuk","id_surat_masuk = '$uri'","./asset/surat_masuk/");
    redirect('primer/buat_surat_masuk');
  }
  function buat_surat(){
	date_default_timezone_set("Asia/Jakarta");
	$qw_surat_masuk = $this->model_sitas->listData("id_surat_masuk,no_surat_masuk,asal_surat,tanggal,perihal,file_pdf",
						"surat_masuk","id_surat_masuk desc limit 50");
	$data['list_sm'] = $qw_surat_masuk;
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
	$data['sifat'] = "";
	$data['sifat_val'] = "--";
	$data['id_surat_masuk'] = "0";
	$data['ars'] = $this->model_sitas->listData("a.id_sub_arsip,a.kode_sub_arsip,a.sub_arsip,b.arsip",
						"klasifikasi_sub_arsip a inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip","a.id_sub_arsip asc");
	$data['sif'] = $this->model_sitas->listData("*","sifat_surat","id_sifat asc");
	if(isset($_GET['id_bs'])){
		$id_bs = $_GET['id_bs'];
		$qw_id = $this->model_sitas->rowDataBy("a.*,b.*,c.arsip","surat_keluar a
							inner join klasifikasi_sub_arsip b on a.id_arsip=b.id_sub_arsip 
							inner join klasifikasi_arsip c on b.id_arsip=c.id_arsip","a.id_surat_keluar = $id_bs")->row();
		$qw_sf = $this->model_sitas->rowDataBy("id_sifat,sifat","sifat_surat","id_sifat = $qw_id->sifat")->row();
		$data['list_sm'] = $qw_surat_masuk;
		$data['tanggal'] = $qw_id->tanggal;
		$data['lampiran'] = $qw_id->lampiran;
		$data['hal'] = $qw_id->hal;
		$data['kepada'] = $qw_id->kepada;
		$data['lokasi_kepada'] = $qw_id->lokasi_kepada;
		$data['isi_surat'] = $qw_id->isi_surat;
		$data['status'] = "edit";
		$data['id_buat_surat'] = $qw_id->id_surat_keluar;
		$data['tembusan'] = $qw_id->tembusan;
		$data['arsip'] = $qw_id->id_sub_arsip;
		$data['arsip_val'] = $qw_id->kode_sub_arsip." - ".$qw_id->arsip." - ".$qw_id->sub_arsip;
		$data['sifat'] = $qw_id->sifat;
		$data['sifat_val'] = $qw_sf->sifat;
		$data['id_surat_masuk'] = $qw_id->id_surat_masuk;
	}
	if(isset($_GET['cs'])){
		$cs = $_GET['cs'];
		$qw_id = $qw_id = $this->model_sitas->rowDataBy("a.*,b.*,c.arsip","surat_keluar a
							inner join klasifikasi_sub_arsip b on a.id_arsip=b.id_sub_arsip 
							inner join klasifikasi_arsip c on b.id_arsip=c.id_arsip","a.id_surat_keluar = $cs")->row();
		$qw_sf = $this->model_sitas->rowDataBy("id_sifat,sifat","sifat_surat","id_sifat = $qw_id->sifat")->row();
		$data['list_sm'] = $qw_surat_masuk;
		$data['tanggal'] = date('Y-m-d');
		$data['lampiran'] = $qw_id->lampiran;
		$data['hal'] = $qw_id->hal;
		$data['kepada'] = $qw_id->kepada;
		$data['lokasi_kepada'] = $qw_id->lokasi_kepada;
		$data['isi_surat'] = $qw_id->isi_surat;
		$data['status'] = "save";
		$data['id_buat_surat'] = $qw_id->id_surat_keluar;
		$data['tembusan'] = $qw_id->tembusan;
		$data['arsip'] = $qw_id->id_sub_arsip;
		$data['arsip_val'] = $qw_id->kode_sub_arsip." - ".$qw_id->arsip." - ".$qw_id->sub_arsip;
		$data['sifat'] = $qw_id->sifat;
		$data['sifat_val'] = $qw_sf->sifat;
		$data['id_surat_masuk'] = "0";
	}
	$this->template->load('sitas/template_form','sitas/buat_surat',$data);
  }
  function save_surat1(){
	$status = _POST('status');
	$id_surat_keluar = _POST('id_buat_surat');
	$data = [
		'id_surat_masuk'=>_POST('id_surat_masuk'),
		'id_sub_arsip'=>_POST('arsip'),
		'tujuan_surat'=>_POST('kepada'),
		'lokasi_tujuan_surat'=>_POST('lokasi_kepada'),
		'tanggal'=>_POST('tanggal'),
		'sifat'=>_POST('sifat'),
		'lampiran'=>_POST('lampiran'),
		'perihal'=>_POST('hal'),
		'isi_surat'=>$this->input->post('isi_surat'),
		'user'=>$this->session->username,
		'tanggal_input'=>date('Y-m-d H:i:s'),
		'tembusan'=>_POST('tembusan')
	];
	if($status=="save"){
		$this->model_sitas->saveData("surat_keluar",$data);
	} else {
		$this->model_sitas->update_data("surat_keluar","id_surat_keluar",$id_surat_keluar,$data);
	}
	redirect('primer/buat_surat_keluar');
  }
  public function save_surat_keluar(){
	date_default_timezone_set('Asia/Jakarta');
	$user = $this->session->username;
	$verif = $this->model_sitas->rowDataBy("id_pegawai","pejabat_verifikator","level='akhir'")->row();
	$status = _POST('status');
	$id_surat_keluar = _POST('id_surat_keluar');
	$data = [
		'no_surat_keluar'=>_POST('no_surat_keluar'),
		'tujuan_surat'=>_POST('tujuan_surat'),
		'tanggal'=>_POST('tanggal'),
		'perihal'=>_POST('perihal'),
		'sifat'=>_POST('sifat'),
		'id_sub_arsip'=>_POST('arsip'),
		'lokasi_tujuan_surat'=>"Tempat",
		'isi_surat'=>"",
		'user'=>$user,
		'tanggal_input'=>date('Y-m-d H:i:s'),
		'id_verif'=>$verif->id_pegawai,
		'waktu_verif'=>date('Y-m-d H:i:s'),
		'id_surat_masuk'=>_POST('id_surat_masuk')
	];
	if($status=="save"){
		$this->model_sitas->saveDataWithFile("surat_keluar",$data,"asset/surat_keluar","");
	} else {
		$this->model_sitas->updateDataWithFile("surat_keluar","id_surat_keluar",$id_surat_keluar,$data,"asset/surat_keluar");
	}
	redirect('primer/buat_surat_keluar');
  }
  function buat_surat_keluar(){
		cek_session_admin1();
		$thn = $this->session->tahun;
        $no_surat = $this->model_sitas->cek_no_surat();
        $no_urut = substr($no_surat,0,5);
        $no_surat_now = $no_urut + 1;
        $no_suratx = "".sprintf("%03s", $no_surat_now);
		$data['uri3'] = $this->uri->segment(3);
        $data['no_surat'] = $no_suratx;
        $data['tujuan_surat'] = "";
        $data['tanggal'] = "";
        $data['perihal'] = "";
        $data['id_surat_keluar'] = "0";
        $data['status'] = "save";
        $data['read'] = "";
        $data['arsip'] = "";
        $data['arsip_val'] = "--";
		$data['sifat'] = "";
		$data['sifat_val'] = "--";
		$data['id_surat_masuk'] = "0";
        //$data['nsx'] = $no_surat;
        $data['sif'] = $this->model_sitas->listData("*","sifat_surat","id_sifat asc");
        if(isset($_GET['id_sk'])){
            $id_sk = $_GET['id_sk'];
            $qw = $this->db->query("select * from surat_keluar where id_surat_keluar = '$id_sk'")->row();
			$qw_sf = $this->model_sitas->rowDataBy("id_sifat,sifat","sifat_surat","id_sifat = $qw->sifat")->row();
			$qw_sa = $this->model_sitas->rowDataBy("a.id_sub_arsip,a.kode_sub_arsip,a.sub_arsip,b.arsip",
								"klasifikasi_sub_arsip a 
								inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip",
								"a.id_sub_arsip = $qw->id_sub_arsip")->row();
			$get_sa = $qw_sa->kode_sub_arsip." - ".$qw_sa->arsip." - ".$qw_sa->sub_arsip;
            $data['no_surat'] = $qw->no_surat_keluar;
            $data['tujuan_surat'] = $qw->tujuan_surat;
            $data['tanggal'] = $qw->tanggal;
            $data['perihal'] = $qw->perihal;
            $data['id_surat_keluar'] = $qw->id_surat_keluar;
            $data['status'] = "edit";
            $data['read'] = "";
            $data['arsip'] = $qw_sa->id_sub_arsip;
            $data['arsip_val'] = $get_sa;
			$data['sifat'] = $qw->sifat;
			$data['sifat_val'] = $qw_sf->sifat;
			$data['id_surat_masuk'] = $qw->id_surat_masuk;
        }
		$qw_surat_masuk = $this->model_sitas->listDataBy("id_surat_masuk,no_surat_masuk,asal_surat,tanggal,perihal,file_pdf",
						"surat_masuk","id_verifikasi != 0","id_surat_masuk desc limit 50");
		$data['list_sm'] = $qw_surat_masuk;
        $data['rec'] = $this->model_sitas->listDataBy("*","surat_keluar","tanggal like '%$thn%'","id_surat_keluar desc"); 
		$data['ars'] = $this->model_sitas->listData("a.id_sub_arsip,a.kode_sub_arsip,a.sub_arsip,b.arsip",
								"klasifikasi_sub_arsip a
								inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip","a.id_sub_arsip asc");
		$this->template->load('sitas/template_form','sitas/buat',$data); 
    }
	function delete_surat_keluar(){
		$uri = $this->uri->segment(3);
		$this->model_sitas->deleteDataWithFile("surat_keluar","id_surat_keluar = '$uri'","./asset/surat_keluar/");
		redirect('primer/buat_surat_keluar');
	  }
	function daftar_spt(){
	    cek_session_admin1();
		$thn = $this->session->tahun;
		$id_pjs = $this->model_sitas->rowDataBy("*","pejabat_verifikator","level = 'akhir'")->row();
		$data['rec'] = $this->model_sitas->listDataBy("*","spt","tanggal like '%$thn%'","id_spt desc");
		$data['kabalai'] = $this->model_sitas->rowDataBy("nip,nama,no_hp","pegawai","id_pegawai = $id_pjs->id_pegawai")->row();
        $this->template->load('sitas/template_form','sitas/daftar_spt',$data);
	}
	function buat_spt(){
	    cek_session_admin1();
		//$id = $this->uri->segment(3);
		$tahun = $this->session->tahun;
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
		    $get_pgx = $this->db->query("select id_pegawai from anggota_spt where tanggal_spt like '%$tglm%'");
		    foreach($get_pgx->result() as $gpg){
		        $id_peg .= $gpg->id_peg.",";
		    }
		    $id_pegw = substr($id_peg,0,-1);
		    
		    $data['verif'] = 0;
		    $data['menimbang'] = "";
		    $data['dasar'] = "<ul><li>Peraturan Menteri Pertanian Nomor 13 Tahun 2023
			tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis
			Lingkup Badan Standardisasi Instrumen Pertanian</li></ul>";
		    $data['untuk'] = "";
		    $data['ceck'] = "";
			$data['tanggal'] = $tgl;
			$data['tanggal_input'] = date('Y-m-d');
			$data['lama_hari'] = $lama;
			$data['surat_masuk'] = $this->model_sitas->listDataBy("*","surat_masuk","tanggal like '%$tahun%'","id_surat_masuk desc limit 10");
			if(!empty($id_pegw)){
				$data['peg'] = $this->model_sitas->listDataBy("*","peserta_spt","id_pegawai not in ($id_pegw)","id_peserta asc");  
			} else {
				$data['peg'] = $this->model_sitas->listData("*","peserta_spt","id_peserta asc");
			}
			
			$data['tgl_no'] = $tglm;
			$data['arr'] = "";
			
			$data['id_spt'] = "";
			$data['kunci_id_spt'] = "disabled";
			$data['status'] = "save";
			$this->template->load('sitas/template_form','sitas/buat_spt',$data);
		}else{
		    $data['verif'] = 0;
		    $data['menimbang'] = "";
		    $data['dasar'] = "<ul><li>Peraturan Menteri Pertanian Nomor 13 Tahun 2023
			tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis
			Lingkup Badan Standardisasi Instrumen Pertanian</li></ul>";
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
            $this->template->load('sitas/template_form','sitas/buat_spt',$data);
		}
	}
	function buat_lap_spt(){
		cek_session_admin1();
		$thn = $this->session->tahun;
		$id_pjs = $this->model_sitas->rowDataBy("*","pejabat_verifikator","level = 'akhir'")->row();
		$data['kabalai'] = $this->model_sitas->rowDataBy("nip,nama,no_hp","pegawai","id_pegawai = $id_pjs->id_pegawai")->row();
	    $data['rec'] = $this->model_sitas->listDataBy("a.*,b.no_surat_keluar","spt a 
								inner join surat_keluar b on a.id_surat_keluar=b.id_surat_keluar","a.tanggal like '%$thn%'",
								"a.id_spt desc");
	    $this->template->load('sitas/template_form','sitas/lap_spt',$data);
	}
	function ganti_password(){
	    cek_session_admin1();
		$user = $this->session->username;
		if(isset($_POST['submit'])){
		    $pass = md5($_POST['password']);
		    $this->db->query("update user set password = '$pass' where username = '$user'");
		    echo "<script>alert('Berhasil Mengubah Password')</script>";
		    echo "<script>window.location.href='".base_url()."/primer/ganti_password'</script>";
		} else {
		 $data["user"] = $user;
		 $this->template->load('sitas/template_form','sitas/view_password',$data);   
		}
	}
	public function buat_cuti(){
        cek_session_admin1();
        $usr = $this->session->username;
        $uri3 = $this->uri->segment(3);
        $dtx = $this->model_sitas2->list_cuti();
        $atasan = $this->model_sitas2->atasan_selek();
        $jn_cuti = $this->model_sitas2->jenis_cuti();
        if (isset($_POST['submit'])){
            $inp = array("id_cuti#0","id_jenis_cuti#0","alasan_cuti#0","lama_cuti#0","tgl_mulai#0","tgl_akhir#0","alamat_cuti#0","tgl_input#0","tahun#0","username#0","atasan_langsung#0");
            $tbl = "cuti";
            $idx = "id_cuti";
            $this->model_sitas->save_all_wa($inp,$tbl,$idx);
            $atasanx = $this->input->post("atasan_langsung");
            $no_peg = $this->model_sitas->rowDataBy("no_hp","pegawai","id_pegawai = $atasanx")->row();
            $no_wa = substr_replace("$no_peg->no_hp",62,0,1);
            $links = base_url('primer/verif_cuti2');
            $pesan = "*Layanan Aplikasi* Ada Cuti Pegawai yang akan diverifikasi, silahkan klik link berikut $links";
            $this->model_sitas->kirim_wa($no_wa,$pesan);
        } else {
            if(empty($uri3)){
                $tgl = date('Y-m-d');
                $tgl_wkt = date('Y-m-d H:i:s');
                $thn = $this->session->tahun;
                $data['judul'] = "Input Permohonan Cuti";
                $data['metod'] = "post";
                $data['aktion'] = "";
                $data['enctype'] = "";
                // (type,name,value,placeholder,label,option (for select),required/readonly)
                $data['forms'] = array(
                                        array("select","id_jenis_cuti","","Jenis Cuti","Jenis Cuti",$jn_cuti,"required"),
                                        array("textarea","alasan_cuti","","Masukkan Alasan Cuti","Masukkan Alasan Cuti","","required"),
                                        array("number","lama_cuti","","Lama Cuti","Lama Cuti","","required"),
                                        array("date","tgl_mulai",$tgl,"Tanggal Mulai","Tanggal Mulai","","required"),
                                        array("date","tgl_akhir",$tgl,"Tanggal Akhir","Tanggal Akhir","","required"),
                                        array("textarea","alamat_cuti","","Masukkan Alamat Cuti","Masukkan Alamat Cuti","","required"),
                                        array("select","atasan_langsung","","Atasan Langsung","Atasan Langsung",$atasan,"required"),
                                        array("hidden","tgl_input",$tgl_wkt,"","","",""),
                                        array("hidden","tahun",$thn,"","","",""),
                                        array("hidden","username",$usr,"","","",""),
                                        array("submit","submit","Simpan","","","","")
                                        );
            } else {
				$qwx = $this->model_sitas->rowDataBy("*","trs_cuti","id_cuti = $uri3")->row();
                $jn_cutix = $this->model_sitas2->jenis_cuti_select($qwx->id_jenis_cuti);
                $data['judul'] = "Edit Permohonan Cuti";
                $data['metod'] = "post";
                $data['aktion'] = "";
                $data['enctype'] = "";
                if($qwx->verif_atasan_langsung != 1){
                    $send = array("submit","submit","Simpan","","","","");
                } else {
                    $send = array("text","","Permohonan cuti tidak bisa diedit karena telah disetujui atasan langsung","","Edit Terkunci !","","readonly");
                }
                // (type,name,value,placeholder,label,option (for select),required/readonly)
                $data['forms'] = array(
                                       array("select","id_jenis_cuti","","Jenis Cuti","Jenis Cuti",$jn_cutix,"required"),
                                        array("textarea","alasan_cuti",$qwx->alasan_cuti,"Masukkan Alasan Cuti","Masukkan Alasan Cuti","","required"),
                                        array("text","lama_cuti",$qwx->lama_cuti,"Lama Cuti","Lama Cuti","","required"),
                                        array("date","tgl_mulai",$qwx->tgl_mulai,"Tanggal Mulai","Tanggal Mulai","","required"),
                                        array("date","tgl_akhir",$qwx->tgl_akhir,"Tanggal Akhir","Tanggal Akhir","","required"),
                                        array("textarea","alamat_cuti",$qwx->alamat_cuti,"Masukkan Alamat Cuti","Masukkan Alamat Cuti","","required"),
                                        array("select","atasan_langsung","","Atasan Langsung","Atasan Langsung",$atasan,"required"),
                                        array("hidden","tgl_input",$qwx->tgl_input,"","","",""),
                                        array("hidden","tahun",$qwx->tahun,"","","",""),
                                        array("hidden","username",$usr,"","","",""),
                                        array("hidden","id_cuti",$qwx->id_cuti,"","","",""),
                                        $send
                                        );
            }
            $heads = array("No","Nama","Jenis Cuti","Alasan","Tanggal","Status","Aksi");
            $data['judul2'] = "Daftar Cuti Pegawai";
            $data['heads'] = $heads;
            $data['list'] = $dtx;
            $data['jml_col'] = count($heads);
            // (style,ukuran btn,warna btn,href,icon,isi,onclick)
            $data['aksi'] = array(array("","btn-sm","btn-primary","silayakx/buat_cuti/","<i class='fas fa-edit'></i>","Edit",""),
                            array("margin-top:2px","btn-sm","btn-danger","silayakx/delete_cuti/","<i class='fas fa-trash-alt'></i>","Hapus","return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')"),
                            array("","btn-sm","btn-warning","silayakx/cetak_cuti/","<i class='fas fa-file-pdf'></i>","PDF","")
                                );   
            $this->template->load('sitas/template_form','sitas/view_ini',$data);
        }
    }
    public function drive(){
	    $uri3 = $this->uri->segment(3);
	    $thn = $this->session->thn_agr;
	    if(empty($uri3)){
	        $folder_utama = array('kepala-balai#Kepala Balai','tata-usaha#Tata Usaha','tim-kerja-layanan-pengujian#Tim Kerja Layanan Pengujian','tim-kerja-program-dan-evaluasi#Tim Kerja Program dan Evaluasi');
	        $data['title'] = "BSIP TAS";
	        $data['buat_folder'] = "";
	        $data['upload_file'] = "";
	        $data['kembali'] = "";
	        $data['folder'] = $folder_utama;
	        $data['file'] = array();
	        $data['uri3'] = $uri3;
	        $data['thn'] = $thn;
	        $data['vw_hapus'] = "display:none";
	    } else {
	        $id_folder = $this->db->query("select id_folder from folder where url = '$uri3'")->row();
	        $qw_folder = $this->db->query("select folder,url from folder where root = $id_folder->id_folder")->result();
	        $qw_surat_keluar = $this->db->query("select id_surat_keluar,perihal,no_surat_keluar from surat_keluar where tanggal like '%$thn%' order by id_surat_keluar desc")->result();
	        $qw_file = $this->db->query("select * from file where id_folder = $id_folder->id_folder and tahun='$thn'")->result();
	        $pc_url = explode("_",$uri3);
	        $panjang_url = count($pc_url);
	        $akhir = $panjang_url - 1;
	        $akhir_url = $pc_url[$akhir];
	        if($panjang_url == 1){
	            $urix = "drive";
	        } else {
	            $urix = "drive/".substr(substr($uri3, 0, strpos($uri3,$akhir_url)),0,-1);
	        }
	        $folder_utama = array();
	        foreach($qw_folder as $qf){
	            array_push($folder_utama,$qf->url."#".$qf->folder);
	        }
	        $judul = str_replace("_"," > ",$uri3);
	        $judull = str_replace("-"," ",$judul);
	        $judulll = ucwords($judull);
	        $data['title'] = $judulll;
	        $data['buat_folder'] = "<button type='button' class='btn btn-warning btn-xs' data-toggle='modal' data-target='#myModalFolder'><b><i class='fa fa-folder-open'></i> Buat Folder</b></button>";
	        $data['upload_file'] = "<button type='button' class='btn btn-warning btn-xs' data-toggle='modal' data-target='#myModalFile'><b><i class='fa fa-upload'></i> Upload File</b></button>";
	        $data['kembali'] = "<a style='color:black' href='".base_url('primer/').$urix."' class='btn btn-warning btn-xs'><b><i class='fa fa-reply'></i> Kembali</b></a>";
	        $data['folder'] = $folder_utama;
	        $data['file'] = $qw_file;
	        $data['uri3'] = $uri3;
	        $data['root'] = $id_folder->id_folder;
	        $data['thn'] = $thn;
	        $data['surat_keluar'] = $qw_surat_keluar;
	        $data['vw_hapus'] = "display:";
	    }
	    $this->template->load('sitas/template_form','sitas/folder',$data);
	}
    function logbook(){
	    cek_session_admin1();
	    $user = $this->session->username;
	    $data['bio'] = $this->db->query("select a.* from pegawai a 
	                                    inner join user b on a.id_pegawai=b.id_pegawai
	                                    where b.username='$user'")->row();
	    $data['bulan'] = array("Januari"=>"01","Februari"=>"02","Maret"=>"03",
	                            "April"=>"04","Mei"=>"05","Juni"=>"06",
	                            "Juli"=>"07","Agusutus"=>"08","September"=>"09",
	                            "Oktober"=>"10","November"=>"11","Desember"=>"12");
	    $data['thn'] = $this->session->tahun;
	    $data['user'] = $user;
        $this->template->load('sitas/template_form','sitas/logbook',$data);
	}
	function logbook_detail(){
	    $waktu = $this->uri->segment(3);
	    $user = $this->uri->segment(4);
	    $data['waktu'] = $waktu;
	    $data['username'] = $user;
	    $data['bio'] = $this->db->query("select a.* from pegawai a 
	                                    inner join user b on a.id_pegawai=b.id_pegawai
	                                    where b.username='$user'")->row();
	    $this->template->load('sitas/template_form','sitas/logbook_detail',$data);
	}
    function verif_spt(){
	    cek_session_admin1();
        $thn = $this->session->tahun;
	    $id_pjs = $this->db->query("select * from pejabat_verifikator where level = 'akhir'")->row();
        $kabalai = $this->model_sitas->rowDataBy("a.nip,a.nama,a.no_hp,b.username","pegawai a inner join user b on a.id_pegawai=b.id_pegawai","a.id_pegawai = $id_pjs->id_pegawai")->row();
	    $user_vr = $this->session->username;
	    if($kabalai->username==$user_vr){
	        $data['rec'] = $this->model_sitas->listDataBy("*","spt","id_verif = 0","id_spt asc");
    		$data['kabalai'] = $kabalai;
            $this->template->load('sitas/verif_surat/template_form','sitas/verif_surat/daftar_spt',$data);    
	    } else {
	        $this->load->view('sitas/verif_surat/no_akses');
	    }
	}
	function disposisi(){
	    cek_session_admin1();
	    $thn = $this->session->tahun;
	    $id_pjs = $this->db->query("select * from pejabat_verifikator where level = 'akhir'")->row();
        $kabalai = $this->model_sitas->rowDataBy("a.nip,a.nama,a.no_hp,b.username","pegawai a inner join user b on a.id_pegawai=b.id_pegawai","a.id_pegawai = $id_pjs->id_pegawai")->row();
	    $user_vr = $this->session->username;
	    if($kabalai->username==$user_vr){
	        $data['rec'] = $this->model_sitas->listDataBy("*","surat_masuk","id_verifikasi = 0","id_surat_masuk asc");
    		$data['kabalai'] = $kabalai;
            $this->template->load('sitas/verif_surat/template_form','sitas/verif_surat/daftar_surat_masuk',$data);   
	    } else {
	        $this->load->view('sitas/verif_surat/no_akses'); 
	    }
	}
	function disposisi_detail(){
	    cek_session_admin1();
	    $id_pjs = $this->db->query("select * from pejabat_verifikator where level = 'akhir'")->row();
        $kabalai = $this->model_sitas->rowDataBy("a.nip,a.nama,a.no_hp,b.username","pegawai a inner join user b on a.id_pegawai=b.id_pegawai","a.id_pegawai = $id_pjs->id_pegawai")->row();
	    $user_vr = $this->session->username;
	    if($kabalai->username==$user_vr){
    	    $id_sm = $this->uri->segment(3);
    	    $qw_sm = $this->model_sitas->rowDataBy("*","surat_masuk","id_surat_masuk=$id_sm")->row();
	        $data['sm'] = $qw_sm;
    	    $data['kabalai'] = $kabalai;
    	    $data['ss'] = $this->session->username;
    	    $data['peg'] = $this->model_sitas->listData("*","pegawai","id_pegawai asc");
    	    $this->template->load('sitas/verif_surat/template_form','sitas/verif_surat/disposisi',$data);
	    } else {
	        $this->load->view('sitas/verif_surat/no_akses');
	    }
	}
	function kirim_disposisi(){
		date_default_timezone_set('Asia/Jakarta');
		$user = $this->model_sitas->get_user();
		$peg = implode(",",$this->input->post('pegawai'));
		$arr_peg = explode(",",$peg);
		$penerima = implode(",",$this->input->post('diteruskan'));
		$id_surat_masuk = _POST('id_surat_masuk');
		$links = base_url('primer?redir=sm_detail/').$id_surat_masuk;
		$pesan = "*Layanan Aplikasi BSIP TAS* Disposisi Surat kepada $penerima , silahkan klik link berikut $links ";
		$row_peg = $this->model_sitas->rowDataBy("no_hp","pegawai","id_pegawai in ($peg)","id_pegawai asc")->result();
		$ls_peg = $this->model_sitas->listDataBy("nama","pegawai","id_pegawai in ($peg)","id_pegawai asc");
		$nm_peg = "";
		foreach($ls_peg as $pegx){
		  $nm_peg .= $pegx->nama.",";
		}
		$nm_peg_fix = substr($nm_peg,0,-1);
		$data = [
			'id_verifikasi' => $user->id_pegawai,
			'waktu_verifikasi' => date('Y-m-d H:i:s'),
			'disposisi' => $nm_peg_fix,
			'id_pegawai_disposisi' => $peg,
			'diteruskan' => $penerima,
			'isi_disposisi' => implode(",",$this->input->post('isi_disposisi')),
			'catatan' => _POST('catatan')
		];
		$this->model_sitas->update_data("surat_masuk","id_surat_masuk",$id_surat_masuk,$data);
		foreach($row_peg as $rp){
		  $no_hp = $rp->no_hp;
		  $no_wa = substr_replace("$no_hp","62",0,1);
		  $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
		}
		redirect('primer/disposisi');
	}
	function sm_detail(){
	    cek_session_admin1();
	    $id_sm = $this->uri->segment(3);
	    $qw_sm =  $this->model_sitas->rowDataBy("*","surat_masuk","id_surat_masuk=$id_sm")->row();
        $data['sm'] = $qw_sm;
	    $this->template->load('sitas/template_form','sitas/sm_detail',$data);
	}
	function file_disposisi(){
		ob_start();    
		$uri3 = $this->uri->segment(3);
		$rowx = $this->model_sitas->rowDataBy("*","surat_masuk","id_surat_masuk = $uri3")->row();
		 $data['spt'] =$rowx;
		 $data['kode_arsip'] = $this->model_sitas->rowDataBy("*","klasifikasi_sub_arsip","id_sub_arsip = $rowx->id_sub_arsip")->row();
		 $data['dispo'] = array("Kepala Balai",
								 "Kepala Sub Bagian Tata Usaha",
								 "Ketua Tim Kerja Program Evaluasi<br>dan Penyebarluasan Hasil<br>Standardisasi",
								 "Ketua Tim Kerja Layanan Pengujian<br>dan Penilaian Standar",
								 "Pejabat Pembuat Komitmen",
								 "IP2SIP",
								 "Manajer UPBS",
								 "Manajer Laboratorium",
								 "Manajer Keuangan",
								 "Jabatan Fungsional");
		 $data['ket'] = array("Untuk Penyelesaian Selanjutnya",
								 "Harap Saran/Pertimbangan",
								 "Untuk Diketahui",
								 "Untuk dibicarakan dengan saya",
								 "Harap Mewakili Saya",
								 "Konsutasi/diskusi dengan",
								 "Siapkan Bahan");
		 $this->load->view('sitas/file_disposisi',$data);
		 $html = ob_get_contents();        
		 ob_end_clean();            
		 require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
		 $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');    
		 $pdf->WriteHTML($html);    
		 $pdf->Output();
		 //$pdf->Output('Tes.pdf', 'D');
	 }
	function tamu(){
		cek_session_admin1();
		$thn = $this->session->tahun;
		$data['rec'] = $this->model_sitas->listDataBy("a.*,b.nama as nm","buku_tamu a inner join pegawai b on a.id_pegawai=b.id_pegawai","a.waktu like '%$thn%'","a.id_tamu desc");
        $this->template->load('sitas/template_form','sitas/tamu',$data);
	}
	function pejabat_tanda_tangan(){
		cek_session_admin1();
	    $data['akhir'] = $this->model_sitas->rowDataBy("a.id_pegawai,b.nama",
							"pejabat_verifikator a inner join pegawai b on a.id_pegawai=b.id_pegawai","a.level = 'akhir'")->row();
		$data['awal'] = $this->model_sitas->rowDataBy("a.id_pegawai,b.nama",
							"pejabat_verifikator a inner join pegawai b on a.id_pegawai=b.id_pegawai","a.level = 'awal'")->row();
		$data['pjb'] = $this->model_sitas->listData("a.id_pegawai,a.struktur,b.nama",
							"struktur_organisasi a inner join pegawai b on a.id_pegawai=b.id_pegawai",
							"a.id_struktur asc");
	    $this->template->load('sitas/template_form','sitas/verif_surat/pj_ttd',$data);
	}
	function save_pejabat(){
	    $id_pejabat1 = _POST('id_pejabat1');
		$id_pejabat2 = _POST('id_pejabat2');
	    $this->db->query("update pejabat_verifikator set id_pegawai = $id_pejabat1 where level = 'awal'");
		$this->db->query("update pejabat_verifikator set id_pegawai = $id_pejabat2 where level = 'akhir'");
	    redirect('primer/pejabat_tanda_tangan');
	}
    function logout(){
		$this->session->sess_destroy();
		redirect('primer');
	}
}