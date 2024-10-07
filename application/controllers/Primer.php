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
		$username = $this->session->username;
		$thn = $this->session->tahun;
		$get_kabalai = $this->model_sitas->get_verifikator_akhir();
		$get_ktu = $this->model_sitas->get_verifikator_awal();
		$kepeg = $this->model_sitas->listDataBy("a.id_pegawai,b.username","petugas_terima a inner join user b on a.id_pegawai=b.id_pegawai",
				"menu = 'cuti'","a.id_petugas asc");
		$tim_kepeg = array();
		foreach($kepeg as $kp){
			array_push($tim_kepeg,$kp->username);
		}
		$idn_peg_log = $this->model_sitas->get_user();
		$data['thn'] = $thn;
		$data['jml_v1'] = 0;//$this->model_more->daftar_spt_kabalai()->num_rows();
		$data['jml_v2'] = $this->model_sitas->jmlDataBy("id_surat_keluar","surat_keluar","tanggal like '%$thn%' and id_verif1 != 0 and id_verif = 0");
		$data['jml_v3'] = $this->model_sitas->jmlDataBy("id_surat_masuk","surat_masuk","id_verifikasi = 0");
		$data['jml_v4'] = $this->model_sitas->jmlDataBy("id_lap_spt","lap_spt","verif_kabalai = 0 and is_publish = 1");
		$data['jml_v5'] = $this->model_sitas->jmlDataBy("id_cuti","trs_cuti","verif_atasan_langsung = 1 and pejabat_atasan = 0");
		$data['jml_surat_masuk'] = $this->model_sitas->jmlDataBy("id_surat_masuk","surat_masuk","tanggal_masuk like '%$thn%'");
		$data['jml_surat_keluar'] = $this->model_sitas->jmlDataBy("id_surat_keluar","surat_keluar","no_surat_keluar != '' and tanggal like '%$thn%'");
		$data['jml_surat'] = 0;//$this->model_more->daftar_surat()->num_rows();
		$data['jml_spt'] = $this->model_sitas->jmlDataBy("id_spt","spt","tanggal like '%$thn%'");
		$data['jml_perjadin'] = $this->model_sitas->jmlDataBy("id_lap_spt","lap_spt","tanggal_input like '%$thn%'");
		$data['jml_anggaran'] = 0;//$this->db->query("select id_pengajuan from sijuara_simpan_pengajuan a
		if(in_array($username,array($get_kabalai->username,$get_ktu->username))){
			$data['jml_cuti'] = $this->model_sitas->jmlDataBy("id_cuti","trs_cuti","tgl_mulai like '%$thn%'");
		} else if(in_array($username,$tim_kepeg)){
			$data['jml_cuti'] = $this->model_sitas->jmlDataBy("id_cuti","trs_cuti","tgl_mulai like '%$thn%'");
		} else {
			$data['jml_cuti'] = $this->model_sitas->jmlDataBy("id_cuti","trs_cuti",
								"tgl_mulai like '%$thn%' and pejabat_atasan_langsung = $idn_peg_log->id_pegawai or username = '$username'");
		}
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
		$data['jml_drive'] = $this->model_sitas->jmlDataBy("id_file","file","tahun = '$thn'");
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
		$data['file_word'] = "";
        $data['nama_file'] = "";
		$data['id_sub_arsip'] = "";
        $data['kode_klasifikasi'] = "Pilih Klasifikasi";
		$data['uri3'] = $this->uri->segment(3);
        $data['list_kode'] = $list_kode;
		$data['sifat'] = "";
		$data['sifat_val'] = "--";
        if(isset($_GET['id_sm'])){
            $id_sm = $_GET['id_sm'];
			$qw = $this->model_sitas->rowDataBy("*","surat_masuk","id_surat_masuk = $id_sm")->row();
			$qw_sf = $this->model_sitas->rowDataBy("id_sifat,sifat","sifat_surat","id_sifat = $qw->id_sifat")->row();
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
			if(!empty($qw->file_word)){
				$data['file_word'] = "<a class='btn btn-primary btn-xs' title='Word' target='_blank' href='".base_url()."asset/surat_masuk/".$qw->file_word."'><i class='fas fa-file-word'></i> Lihat Word</a>";
			} else {
				$data['file_word'] = "";
			}
            
            $data['nama_file'] = $qw->file_pdf;
			$data['id_sub_arsip'] = $qw->id_sub_arsip;
            $data['kode_klasifikasi'] = $kode_kl->kode_sub_arsip." - ".$kode_kl->sub_arsip;
			$data['sifat'] = $qw->id_sifat;
			$data['sifat_val'] = $qw_sf->sifat;
        }
        
        if(isset($_GET['copy'])){
            $id_skm = $_GET['copy'];
			$qw = $this->model_sitas->rowDataBy("*","surat_masuk","id_surat_masuk = $id_skm")->row();
			$qw_sf = $this->model_sitas->rowDataBy("id_sifat,sifat","sifat_surat","id_sifat = $qw->id_sifat")->row();
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
			$data['file_word'] = "";
            $data['nama_file'] = "";
			$data['id_sub_arsip'] = $qw->id_sub_arsip;
            $data['kode_klasifikasi'] = $kode_kl->kode_sub_arsip." - ".$kode_kl->sub_arsip;
			$data['sifat'] = $qw->id_sifat;
			$data['sifat_val'] = $qw_sf->sifat;
        }
		$data['kabalai'] = $this->model_sitas->rowDataBy("nip,nama,no_hp","pegawai","id_pegawai = $id_pjs->id_pegawai")->row();
		$data['rec'] = $this->model_sitas->listDataBy("*","surat_masuk","tanggal_masuk like '%$thn%'","id_surat_masuk desc");
		$data['sif'] = $this->model_sitas->listData("*","sifat_surat","id_sifat asc");
		$this->template->load('sitas/template_form','sitas/buat_surat_masuk',$data);
    }
	public function save_surat_masuk(){
        date_default_timezone_set('Asia/Jakarta');
		$id_surat_masuk = $this->input->post('id_surat_masuk');
        $get_pjb_ttd = $this->model_sitas->rowDataBy("b.no_hp","pejabat_verifikator a inner join pegawai b on a.id_pegawai=b.id_pegawai","a.level = 'akhir'")->row();
        $no_hp = $get_pjb_ttd->no_hp;
        $links = base_url('primer?redir=disposisi');
        $no_wa = substr_replace("$no_hp","62",0,1);
        $pesan = "*Layanan LinTAS* Ada surat masuk, silahkan klik link berikut $links ";
        $data = [
            'id_sub_arsip' => $this->input->post('id_sub_arsip'),
			'id_sifat' => _POST('sifat'),
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
			$this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
        } else {
            $this->model_sitas->updateDataWithFile("surat_masuk","id_surat_masuk",$id_surat_masuk,$data,"asset/surat_masuk");
        }
        redirect('primer/buat_surat_masuk');
  }
  public function hapus_surat_masuk(){
    $uri = $this->uri->segment(3);
	$file_word = $this->model_sitas->rowDataBy("file_word","surat_masuk","id_surat_masuk = $uri")->row();
	if($file_word->file_word != ""){
		$this->model_sitas->hapus_pdf("./asset/surat_masuk/",$file_word->file_word);
	}
    $this->model_sitas->deleteDataWithFile("surat_masuk","id_surat_masuk = '$uri'","./asset/surat_masuk/");
    redirect('primer/buat_surat_masuk');
  }
  function buat_surat(){
	cek_session_admin1();
	$thn = $this->session->tahun;
	date_default_timezone_set("Asia/Jakarta");
	$qw_surat_masuk = $this->model_sitas->listData("id_surat_masuk,no_surat_masuk,asal_surat,tanggal,perihal,file_pdf",
						"surat_masuk","id_surat_masuk desc limit 200");
	$data['list_sm'] = $qw_surat_masuk;
	$data['tanggal'] = date('Y-m-d');
	$data['lampiran'] = "";
	$data['hal'] = "";
	$data['kepada'] = "";
	$data['lokasi_kepada'] = "";
	$data['isi_surat'] = "";
	$data['status'] = "save";
	$data['id_buat_surat'] = "0";
	$data['tembusan'] = "";
	$data['arsip'] = "";
	$data['arsip_val'] = "--";
	$data['sifat'] = "";
	$data['sifat_val'] = "--";
	$data['id_surat_masuk'] = "0";
	$data['list_lamp'] = array();
	$data['disb'] = "";
	$data['dis'] = "disabled";
	$data['view_lamp'] = 0;
	$data['jml_lamp'] = 0;
	$data['is_file_lampiran'] = "";
	$data['display_jml_lampiran'] = "";
	$data['display_file_lampiran'] = "none";
	$data['file_lamp'] = "";
	$data['isi_file_lamp'] = "";
	$data['ars'] = $this->model_sitas->listData("a.id_sub_arsip,a.kode_sub_arsip,a.sub_arsip,b.arsip",
						"klasifikasi_sub_arsip a inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip","a.id_sub_arsip asc");
	$data['sif'] = $this->model_sitas->listData("*","sifat_surat","id_sifat asc");
	if(isset($_GET['id_bs'])){
		$id_bs = $_GET['id_bs'];
		$qw_lamp = $this->model_sitas->rowDataBy("id_surat_keluar","surat_keluar_lampiran","id_surat_keluar = $id_bs");
		$cek_lamp = $qw_lamp->num_rows();
		$qw_id = $this->model_sitas->rowDataBy("a.*,b.*,c.arsip","surat_keluar a
							inner join klasifikasi_sub_arsip b on a.id_sub_arsip=b.id_sub_arsip 
							inner join klasifikasi_arsip c on b.id_arsip=c.id_arsip","a.id_surat_keluar = $id_bs")->row();
		$qw_sf = $this->model_sitas->rowDataBy("id_sifat,sifat","sifat_surat","id_sifat = $qw_id->sifat")->row();
		$pc_lamp = $this->model_sitas->listDataBy("*","surat_keluar_lampiran","id_surat_keluar = $id_bs","id_lampiran asc");
		$data['list_sm'] = $qw_surat_masuk;
		$data['tanggal'] = $qw_id->tanggal;
		if($cek_lamp > 0){
			$data['lampiran'] = $cek_lamp;
		} else {
			$data['lampiran'] = $qw_id->lampiran;
		}
		$data['hal'] = $qw_id->perihal;
		$data['kepada'] = $qw_id->tujuan_surat;
		$data['lokasi_kepada'] = $qw_id->lokasi_tujuan_surat;
		$data['isi_surat'] = $qw_id->isi_surat;
		$data['status'] = "edit";
		$data['id_buat_surat'] = $qw_id->id_surat_keluar;
		$data['tembusan'] = $qw_id->tembusan;
		$data['arsip'] = $qw_id->id_sub_arsip;
		$data['arsip_val'] = $qw_id->kode_sub_arsip." - ".$qw_id->arsip." - ".$qw_id->sub_arsip;
		$data['sifat'] = $qw_id->sifat;
		$data['sifat_val'] = $qw_sf->sifat;
		$data['id_surat_masuk'] = $qw_id->id_surat_masuk;
		$data['list_lamp'] = $pc_lamp;
		$data['jml_lamp'] = $cek_lamp;
		if($qw_id->file_lampiran != ""){
			$data['disb'] = "disabled";
			$data['dis'] = "";
			$data['view_lamp'] = 0;
			$data['is_file_lampiran'] = "checked";
			$data['display_jml_lampiran'] = "none";
			$data['display_file_lampiran'] = "";
			$data['file_lamp'] = "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#modal_vw_lam'><i class='fas fa-file-pdf'></i> Lihat Lampiran</a>";
			$data['isi_file_lamp'] = base_url('asset/lampiran/').$qw_id->file_lampiran;
		} else {
			$data['disb'] = "";
			$data['dis'] = "disabled";
			$data['view_lamp'] = 1;
			$data['is_file_lampiran'] = "";
			$data['display_jml_lampiran'] = "";
			$data['display_file_lampiran'] = "none";
			$data['file_lamp'] = "";
			$data['isi_file_lamp'] = "";
		}
	}
	if(isset($_GET['cs'])){
		$cs = $_GET['cs'];
		$qw_lamp = $this->model_sitas->rowDataBy("id_surat_keluar","surat_keluar_lampiran","id_surat_keluar = $cs");
		$cek_lamp = $qw_lamp->num_rows();
		$qw_id = $qw_id = $this->model_sitas->rowDataBy("a.*,b.*,c.arsip","surat_keluar a
							inner join klasifikasi_sub_arsip b on a.id_sub_arsip=b.id_sub_arsip 
							inner join klasifikasi_arsip c on b.id_arsip=c.id_arsip","a.id_surat_keluar = $cs")->row();
		$qw_sf = $this->model_sitas->rowDataBy("id_sifat,sifat","sifat_surat","id_sifat = $qw_id->sifat")->row();
		$pc_lamp = $this->model_sitas->listDataBy("*","surat_keluar_lampiran","id_surat_keluar = $cs","id_lampiran asc");
		$data['list_sm'] = $qw_surat_masuk;
		$data['tanggal'] = date('Y-m-d');
		if($cek_lamp > 0){
			$data['lampiran'] = $cek_lamp;
		} else {
			$data['lampiran'] = $qw_id->lampiran;
		}
		$data['hal'] = $qw_id->perihal;
		$data['kepada'] = $qw_id->tujuan_surat;
		$data['lokasi_kepada'] = $qw_id->lokasi_tujuan_surat;
		$data['isi_surat'] = $qw_id->isi_surat;
		$data['status'] = "save";
		$data['id_buat_surat'] = $qw_id->id_surat_keluar;
		$data['tembusan'] = $qw_id->tembusan;
		$data['arsip'] = $qw_id->id_sub_arsip;
		$data['arsip_val'] = $qw_id->kode_sub_arsip." - ".$qw_id->arsip." - ".$qw_id->sub_arsip;
		$data['sifat'] = $qw_id->sifat;
		$data['sifat_val'] = $qw_sf->sifat;
		$data['id_surat_masuk'] = "0";
		$data['list_lamp'] = $pc_lamp;
		$data['jml_lamp'] = 0;
		if($qw_id->file_lampiran != ""){
			$data['disb'] = "disabled";
			$data['dis'] = "";
			$data['view_lamp'] = 0;
			$data['is_file_lampiran'] = "checked";
			$data['display_jml_lampiran'] = "none";
			$data['display_file_lampiran'] = "";
			$data['file_lamp'] = "";
			$data['isi_file_lamp'] = "";
		} else {
			$data['disb'] = "";
			$data['dis'] = "disabled";
			$data['view_lamp'] = 1;
			$data['is_file_lampiran'] = "";
			$data['display_jml_lampiran'] = "";
			$data['display_file_lampiran'] = "none";
			$data['file_lamp'] = "";
			$data['isi_file_lamp'] = "";
		}
	}
	$data['rec'] = $this->model_sitas->listDataBy("*","surat_keluar","tanggal like '%$thn%' and isi_surat != '' and file_pdf = ''","id_surat_keluar desc"); 
	$this->template->load('sitas/template_form','sitas/buat_surat',$data);
  }
  function save_surat1(){
	$status = _POST('status');
	$id_surat_keluar = _POST('id_buat_surat');
	$jml_lampiran = _POST('jml_lampiran');
	if(empty($this->input->post('lampiran'))){
		$lampiran = array();
	} else {
		$lampiran = $this->input->post('lampiran');
	}
	
	$data = [
		'id_surat_masuk'=>_POST('id_surat_masuk'),
		'id_sub_arsip'=>_POST('arsip'),
		'tujuan_surat'=>_POST('kepada'),
		'lokasi_tujuan_surat'=>_POST('lokasi_kepada'),
		'tanggal'=>_POST('tanggal'),
		'sifat'=>_POST('sifat'),
		'lampiran'=>$jml_lampiran,
		'perihal'=>_POST('hal'),
		'isi_surat'=>$this->input->post('isi_surat'),
		'user'=>$this->session->username,
		'tanggal_input'=>date('Y-m-d H:i:s'),
		'tembusan'=>_POST('tembusan')
	];
	if($status=="save"){
		if ($_FILES['file_lampiran']['name']) {
			$count_lamp = 0;
			// Upload gambar baru
			$data['file_lampiran'] = $this->model_sitas->upload_file("asset/lampiran","file_lampiran");
			$this->model_sitas->saveData("surat_keluar",$data);
		} else {
			$count_lamp = 0;
			$this->model_sitas->saveData("surat_keluar",$data);
			$idx = $this->db->insert_id();
			foreach($lampiran as $lm){
				$this->db->query("insert into surat_keluar_lampiran (id_surat_keluar,deskripsi) values 
								('$idx','$lm')");
			}
		}
	} else {
		if ($_FILES['file_lampiran']['name']) {
			$count_lamp = 0;
			// Hapus gambar sebelumnya dari server
			$get_file_lamp = $this->model_sitas->rowDataBy("file_lampiran","surat_keluar",
								"id_surat_keluar=$id_surat_keluar")->row();
			if($get_file_lamp->file_lampiran != ""){
			$this->model_sitas->hapus_pdf("./asset/lampiran/",$get_file_lamp->file_lampiran);
			}
			// Upload gambar baru
			$data['file_lampiran'] = $this->model_sitas->upload_file("asset/lampiran","file_lampiran");
			$this->model_sitas->update_data("surat_keluar","id_surat_keluar",$id_surat_keluar,$data);
			$cek_lamp = $this->model_sitas->rowDataBy("id_surat_keluar","surat_keluar_lampiran","id_surat_keluar = $id_surat_keluar")->num_rows();
			if($cek_lamp > 0){
				$this->model_sitas->hapus_data("surat_keluar_lampiran","id_surat_keluar = $id_surat_keluar");
			}
		} else {
			$count_lamp = count($lampiran);
			$idx = $id_surat_keluar;
			$cek_lamp = $this->model_sitas->rowDataBy("id_surat_keluar","surat_keluar_lampiran","id_surat_keluar = $id_surat_keluar")->num_rows();
			if($count_lamp > 0){
				$hit_lm = 0;
				foreach($lampiran as $lm_hit){
					if($lm_hit != "<p><br></p>" && $lm_hit != ""){ $hit_lm++; }
				}
				$get_file_lamp = $this->model_sitas->rowDataBy("file_lampiran","surat_keluar",
								"id_surat_keluar=$id_surat_keluar")->row();
				if($get_file_lamp->file_lampiran != ""){
					$this->model_sitas->hapus_pdf("./asset/lampiran/",$get_file_lamp->file_lampiran);
				}
				$data['file_lampiran'] = "";
				if($cek_lamp != $hit_lm){
					$this->model_sitas->hapus_data("surat_keluar_lampiran","id_surat_keluar = $idx");
					foreach($lampiran as $lm){
						if($lm != "" && $lm != "<p><br></p>"){
							$this->db->query("insert into surat_keluar_lampiran (id_surat_keluar,deskripsi) values 
							('$idx','$lm')");
						}
					}
				} else {
					$ls_lamp = $this->model_sitas->listDataBy("id_lampiran","surat_keluar_lampiran","id_surat_keluar = $idx",
								"id_lampiran asc");
					$ind_lam = 0;
					foreach($ls_lamp as $lm){
						$this->db->query("update surat_keluar_lampiran set deskripsi = '$lampiran[$ind_lam]' where id_lampiran = $lm->id_lampiran");
						$ind_lam++;
					}
				}
			} else {
				$get_file_lamp = $this->model_sitas->rowDataBy("file_lampiran","surat_keluar",
								"id_surat_keluar=$id_surat_keluar")->row();
				$data['file_lampiran'] = $get_file_lamp->file_lampiran;
				$this->model_sitas->hapus_data("surat_keluar_lampiran","id_surat_keluar = $id_surat_keluar");

			}
			$this->model_sitas->update_data("surat_keluar","id_surat_keluar",$id_surat_keluar,$data);
		}
	}
	if($jml_lampiran == 0){
		$get_file_lamp = $this->model_sitas->rowDataBy("file_lampiran","surat_keluar",
							"id_surat_keluar=$id_surat_keluar")->row();
		if($get_file_lamp->file_lampiran != ""){
			$this->model_sitas->hapus_pdf("./asset/lampiran/",$get_file_lamp->file_lampiran);
		}
		$data['file_lampiran'] = "";
		$cek_lamp = $this->model_sitas->rowDataBy("id_surat_keluar","surat_keluar_lampiran","id_surat_keluar = $id_surat_keluar")->num_rows();
		if($cek_lamp > 0){
			$this->model_sitas->hapus_data("surat_keluar_lampiran","id_surat_keluar = $id_surat_keluar");
		}
		$this->model_sitas->update_data("surat_keluar","id_surat_keluar",$id_surat_keluar,$data);
	}
	redirect('primer/buat_surat');
  }
  public function save_surat_keluar(){
	date_default_timezone_set('Asia/Jakarta');
	$status = _POST('status');
	$id_surat_keluar = _POST('id_surat_keluar');
	$isSPT = $this->input->post('isSPT');
	$data_spt = array();
	$data_pelaku_spt = array();
	if($isSPT == "on"){
		$tujuan_suratx = $this->input->post('tujuan_surat');
		$nmPeg = "";
		foreach($tujuan_suratx as $ts){
			$rowPeg = $this->model_sitas->rowDataBy("nama","pegawai","id_pegawai=$ts")->row();
			$nmPeg .= $rowPeg->nama.",";
		}
		$nmPeg2 = substr($nmPeg,0,-1);
		$tujuan_surat = $nmPeg2;
		$perihal = _POST('perihal')." ".sd_tgl(_POST('tanggal_spt'),_POST('lama_hari'));
	} else {
		$tujuan_surat = _POST('tujuan_surat');
		$perihal = _POST('perihal');
	}
	$data = [
		'no_surat_keluar'=>_POST('no_surat_keluar'),
		'tujuan_surat'=>$tujuan_surat,
		'tanggal'=>_POST('tanggal'),
		'perihal'=>$perihal,
		'sifat'=>_POST('sifat'),
		'id_sub_arsip'=>_POST('arsip'),
		'lokasi_tujuan_surat'=>_POST('lokasi_tujuan_surat'),
		//'isi_surat'=>"",
		'user'=>_POST('user'),
		'tanggal_input'=>_POST('tanggal_input'),
		'id_verif'=>_POST('id_verif'),
		'waktu_verif'=>_POST('waktu_verif'),
		'id_surat_masuk'=>_POST('id_surat_masuk')
	];
	if($status=="save"){
		if($isSPT == "on"){
			$tgl_anggota_spt = no_anggota_spt(_POST('tanggal_spt'),_POST('lama_hari'));
			$this->model_sitas->saveDataWithFile("surat_keluar",$data,"asset/surat_keluar","");
			$id_surat_keluar = $this->db->insert_id();
			if($this->input->post('is_dipa') == "on"){
				$dipa_ya = 1;
			} else {
				$dipa_ya = 0;
			}
			$data_spt = [
				'id_surat_masuk'=>_POST('id_surat_masuk'),
				'id_surat_keluar'=>$id_surat_keluar,
				'id_sub_arsip'=>_POST('arsip'),
				'dasar'=>"<ul><li>Peraturan Menteri Pertanian Nomor 13 Tahun 2023 tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis Lingkup Badan Standardisasi Instrumen Pertanian</li></ul>",
				'menimbang'=>"Bahwa dalam rangka mendukung terlaksananya kegiatan standardisasi instrumen tanaman perkebunan, maka dipandang perlu menugaskan pegawai yang berkompeten sesuai bidangnya dibawah ini.",
				'untuk' => _POST('perihal'),
				'tanggal' => _POST('tanggal_spt'),
				'lama_hari' => _POST('lama_hari'),
				'is_dipa' => $dipa_ya,
				'user' => _POST('user'),
				'tanggal_input' => _POST('tanggal_input'),
				'keterangan' => null
			];
			print_r($data_spt);
			$this->model_sitas->saveData('spt', $data_spt);
			$id_spt = $this->db->insert_id();
			foreach($this->input->post('tujuan_surat') as $tsx){
				array_push($data_pelaku_spt, array(
					'id_spt'=> $id_spt,
					'id_pegawai' => $tsx,
					'tanggal_spt' => $tgl_anggota_spt,
				));
			}
			$this->model_sitas->saveDataBanyak('anggota_spt', $data_pelaku_spt);
		} else {
			$this->model_sitas->saveDataWithFile("surat_keluar",$data,"asset/surat_keluar","");
		}
	} else {
		$this->model_sitas->updateDataWithFile("surat_keluar","id_surat_keluar",$id_surat_keluar,$data,"asset/surat_keluar");
	}
	redirect('primer/buat_surat_keluar');
  }
  function buat_surat_keluar(){
		date_default_timezone_set('Asia/Jakarta');
		cek_session_admin1();
		$user = $this->session->username;
		$verif = $this->model_sitas->rowDataBy("id_pegawai","pejabat_verifikator","level='akhir'")->row();
		$thn = $this->session->tahun;
        $no_surat = $this->model_sitas->cek_no_surat();
        $no_urut = substr($no_surat,0,5);
        $no_surat_now = $no_urut + 1;
        $no_suratx = "".sprintf("%03s", $no_surat_now);
		$data['sif'] = $this->model_sitas->listData("*","sifat_surat","id_sifat asc");
		$data['peg'] = $this->model_sitas->listData("*","pegawai","id_pegawai ASC");
		$uri3 = $this->uri->segment(3);
		if(empty($uri3)){
			$data['toggle_spt'] = "";
			$data['no_surat'] = $no_suratx;
			$data['lokasi_tujuan_surat'] = "Tempat";
			$data['user'] = $user;
			$data['id_verif'] = $verif->id_pegawai;
			$data['waktu_verif'] = date('Y-m-d H:i:s');
			$data['tanggal_input'] = date('Y-m-d H:i:s');
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
			$data['view_balas_sm'] = "";
			$data['dis_sm'] = "";
			$data['view_upl_pdf'] = "";
			$data['dis_pdf'] = "";
			//$data['nsx'] = $no_surat;
		} else {
			$qw = $this->db->query("select * from surat_keluar where id_surat_keluar = $uri3")->row();
			$qw_sf = $this->model_sitas->rowDataBy("id_sifat,sifat","sifat_surat","id_sifat = $qw->sifat")->row();
			$qw_sa = $this->model_sitas->rowDataBy("a.id_sub_arsip,a.kode_sub_arsip,a.sub_arsip,b.arsip",
								"klasifikasi_sub_arsip a 
								inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip",
								"a.id_sub_arsip = $qw->id_sub_arsip")->row();
			$get_sa = $qw_sa->kode_sub_arsip." - ".$qw_sa->arsip." - ".$qw_sa->sub_arsip;
			$data['toggle_spt'] = "style='display:none'";
			$data['no_surat'] = $qw->no_surat_keluar;
			$data['user'] = $qw->user;
			$data['id_verif'] = $qw->id_verif;
			$data['waktu_verif'] = $qw->waktu_verif;
			$data['tanggal_input'] = $qw->tanggal_input;
			$data['lokasi_tujuan_surat'] = $qw->lokasi_tujuan_surat;

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
			$data['view_balas_sm'] = "";
			$data['dis_sm'] = "";
			$data['view_upl_pdf'] = "";
			$data['dis_pdf'] = "";
		}

        if(isset($_GET['id_sk'])){
			$data['toggle_spt'] = "style='display:none'";
            $id_sk = $_GET['id_sk'];
            $qw = $this->db->query("select * from surat_keluar where id_surat_keluar = '$id_sk'")->row();
			$qw_sf = $this->model_sitas->rowDataBy("id_sifat,sifat","sifat_surat","id_sifat = $qw->sifat")->row();
			$qw_sa = $this->model_sitas->rowDataBy("a.id_sub_arsip,a.kode_sub_arsip,a.sub_arsip,b.arsip",
								"klasifikasi_sub_arsip a 
								inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip",
								"a.id_sub_arsip = $qw->id_sub_arsip")->row();
			$get_sa = $qw_sa->kode_sub_arsip." - ".$qw_sa->arsip." - ".$qw_sa->sub_arsip;
            if($qw->no_surat_keluar == ""){
				$data['no_surat'] = $no_suratx;
			} else {
				$data['no_surat'] = $qw->no_surat_keluar;
			}
			if($qw->lokasi_tujuan_surat=="SPT"){
				$verify = $this->model_sitas->rowDataBy("id_pegawai","pejabat_verifikator","level='akhir'")->row();
				$id_verif = $verify->id_pegawai;
				$waktu_verif = date('Y-m-d H:i:s');
				$tanggal_input = date('Y-m-d H:i:s');
				$user = $this->session->username;
			} else {
				$id_verif = $qw->id_verif;
				$waktu_verif = $qw->waktu_verif;
				$tanggal_input = $qw->tanggal_input;
				$user = $qw->user;
			}
			$data['user'] = $user;
			$data['id_verif'] = $id_verif;
			$data['waktu_verif'] = $waktu_verif;
			$data['tanggal_input'] = $tanggal_input;
			$data['lokasi_tujuan_surat'] = $qw->lokasi_tujuan_surat;
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
			$data['view_balas_sm'] = "none";
			$data['dis_sm'] = "disabled";
			if($qw->lokasi_tujuan_surat == "SPT"){
				$data['view_upl_pdf'] = "";
				$data['dis_pdf'] = "";
			} else {
				$data['view_upl_pdf'] = "none";
				$data['dis_pdf'] = "disabled";
			}
        }
		$qw_surat_masuk = $this->model_sitas->listDataBy("id_surat_masuk,no_surat_masuk,asal_surat,tanggal,perihal,file_pdf",
						"surat_masuk","id_verifikasi != 0","id_surat_masuk desc limit 200");
		$data['list_sm'] = $qw_surat_masuk;
        $data['rec'] = $this->model_sitas->listDataBy("*","surat_keluar","tanggal like '%$thn%' and id_verif!=0","id_surat_keluar desc"); 
		$data['ars'] = $this->model_sitas->listData("a.id_sub_arsip,a.kode_sub_arsip,a.sub_arsip,b.arsip",
								"klasifikasi_sub_arsip a
								inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip","a.id_sub_arsip asc");
		$this->template->load('sitas/template_form','sitas/buat',$data); 
    }
	function delete_surat_keluar(){
		$uri = $this->uri->segment(3);
		$this->model_sitas->deleteDataWithFile("surat_keluar","id_surat_keluar = '$uri'","./asset/surat_keluar/");
		$cekSPT = $this->model_sitas->rowDataBy("id_surat_keluar","spt","id_surat_keluar=$uri")->num_rows();
		if($cekSPT > 0){
			$data = array('id_surat_keluar'=>NULL);
			$this->model_sitas->update_data("spt","id_surat_keluar",$uri,$data);
		}
		redirect('primer/buat_surat_keluar');
	}
	function delete_surat(){
		$uri = $this->uri->segment(3);
		$cek_file_lampiran = $this->model_sitas->rowDataBy("file_lampiran","surat_keluar","id_surat_keluar=$uri")->row();
		$cek_text_lampiran = $this->model_sitas->rowDataBy("id_surat_keluar","surat_keluar_lampiran","id_surat_keluar = $uri")->num_rows();
		if($cek_file_lampiran->file_lampiran != ""){
			$this->model_sitas->hapus_pdf("./asset/lampiran/",$cek_file_lampiran->file_lampiran);
		}
		$this->model_sitas->hapus_data("surat_keluar","id_surat_keluar = $uri");
		if($cek_text_lampiran > 0){
			$this->model_sitas->hapus_data("surat_keluar_lampiran","id_surat_keluar = $uri");
		}
		redirect('primer/buat_surat');
	}
	function delete_surat_spt(){
		$uri = $this->uri->segment(3);
		$data = array('id_surat_keluar'=>NULL);
		$this->model_sitas->hapus_data("surat_keluar","id_surat_keluar = $uri");
		$this->model_sitas->update_data("spt","id_surat_keluar",$uri,$data);
		redirect('primer/buat_surat');
	}
	function kirim_pesan(){
		cek_session_admin1();
		$id_spt = $_GET['id_spt'];
		$kode_unik = $_GET['kode_unik'];
		if(get_kode_uniks($id_spt)==$kode_unik){
			$spt = $this->model_sitas->rowDataBy("id_surat_masuk,id_sub_arsip,untuk,tanggal,lama_hari,tanggal_input,is_dipa,pj",
							"spt","id_spt=$id_spt")->row();
			if($spt->is_dipa == 1){
				$pj = $this->model_sitas->rowDataBy("no_hp","pegawai","id_pegawai = $spt->pj")->row();
				$no_wa = substr_replace($pj->no_hp,"62",0,1);
				$links = base_url()."primer?redir=status_spt/".$id_spt."/".$kode_unik;
        		$pesan = "Layanan BSIP TAS Ada pengajuan SPT silahkan klik link $links";
				$url = "daftar_spt";
				$data_spt = array(
							'ajukan'=>1,
							'verif_pj'=>0,
							'waktu_verif_pj'=>NULL,
							'keterangan'=>NULL,
							'status_verif_pa'=>0,
							'waktu_verif_pa'=>"",
							'keterangan_pa'=>"",
							'status_verif_ppk'=>0,
							'waktu_verif_ppk'=>"",
							'keterangan_ppk'=>"",
						);
				$this->model_sitas->update_data("spt","id_spt",$id_spt,$data_spt);
			} else {
				$no_wa = $_GET['no_wa'];
				$pesan = $_GET['pesan'];
				$url = $_GET['ctrl'];
				$peg_spt = $this->model_sitas->listDataBy("b.nama",
							"anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai",
							"a.id_spt=$id_spt","a.id_anggota asc");
				$data_peg = array();
				foreach($peg_spt as $ps){
					array_push($data_peg,$ps->nama);
				}
				$untuk = implode(",",$data_peg);
				$narasi_tgl = sd_tgl($spt->tanggal,$spt->lama_hari);
				$data_sk = array(
					'id_surat_masuk'=>$spt->id_surat_masuk,
					'id_sub_arsip'=>$spt->id_sub_arsip,
					'tujuan_surat'=>$untuk,
					'lokasi_tujuan_surat'=>"SPT",
					'tanggal'=>$spt->tanggal_input,
					'sifat'=>1,
					'lampiran'=>0,
					'perihal'=>$spt->untuk." ".$narasi_tgl,
					'isi_surat'=>"SPT"
				);
				$this->model_sitas->saveData("surat_keluar",$data_sk);
				$id_surat_keluar = $this->db->insert_id();
				$data_spt = array('id_surat_keluar'=>$id_surat_keluar);
				$this->model_sitas->update_data("spt","id_spt",$id_spt,$data_spt);
			}
			//echo $no_wa."---".$pesan;
			$this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
			redirect('primer/'.$url);
		} else {
			echo "Sorry Yee WKWKWK";
		}
	}
	function status_spt(){
		cek_session_admin1();
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		if(get_kode_uniks($uri3) == $uri4){
			$spt = $this->model_sitas->rowDataBy("a.id_surat_keluar,a.id_subdetil,a.untuk,a.lama_hari,a.ket_berangkat,a.ket_wilayah,a.tanggal,a.pj,
					a.no_sppd,a.verif_pj,a.status_verif_pa,a.status_verif_ppk,a.keterangan,a.keterangan_pa,a.keterangan_ppk,b.transportasi",
					"spt a inner join transportasi_spt b on a.id_transport=b.id_transport","a.id_spt = $uri3")->row();
			$pengendali_anggaran = $this->model_sitas->rowDataBy("id_pegawai","verifikator","menu = 'spt' and tingkat = 1")->row();
			$ppk = $this->model_sitas->rowDataBy("id_pegawai","verifikator","menu = 'spt' and tingkat = 2")->row();
			if($spt->verif_pj == 1){
				$is_verif_pj = 1;
			} else {
				$is_verif_pj = 0;
			}
			if($spt->status_verif_pa == 1){
				$is_verif_pa = 1;
			} else {
				$is_verif_pa = 0;
			}
			if($spt->status_verif_ppk == 1){
				$is_verif_ppk = 1;
			} else {
				$is_verif_ppk = 0;
			}
			$data['pegawai_spt'] = $this->model_sitas->listDataBy("b.nama,b.nip,b.jabatan,b.gol",
									"anggota_spt a inner join pegawai b on a.id_pegawai=b.id_pegawai","a.id_spt = $uri3",
									"a.id_anggota");
			$data['spt'] = $spt;
			$data['pos'] = $this->model_sitas->rowDataBy("a.vol,a.satuan,a.harga_satuan,b.kd_detil,c.kd_subkomp,c.subkomp,
							d.kd_komponen,e.kd_ro",
							"a_subdetil9 a inner join a_detil8 b on a.id_detil=b.id_detil 
								inner join a_subkomp7 c on b.id_subkomp=c.id_subkomp inner join a_komponen6 d on c.id_komponen = d.id_komponen
								inner join a_ro5 e on d.id_ro = e.id_ro",
							"a.id_subdetil = $spt->id_subdetil")->row();
			$data['id_pegawai_login'] = $this->model_sitas->get_user()->id_pegawai;
			$data['id_pj'] = $spt->pj;
			$data['id_pa'] = $pengendali_anggaran;
			$data['id_ppk'] = $ppk;
			$data['arr_disetujui'] = array($spt->pj,$pengendali_anggaran->id_pegawai,$ppk->id_pegawai);
			$data['total_verif'] = $is_verif_pj + $is_verif_pa + $is_verif_ppk;
			$data['uri3'] = $uri3;
			$data['uri4'] = $uri4;
			$this->template->load('sitas/template_form','sitas/status_spt',$data);
		} else {
			echo "Sorry YEeee WKWKWKW";
		}
	}
	function ajukan_surat_keluar(){
		cek_session_admin1();
		$uri3 = $this->uri->segment(3);
		$uri_kd = md5($uri3);
		$get_verif_awal = $this->model_sitas->get_verifikator_awal();
		$links = base_url('primer?redir=verif_surat_detail1/'.$uri_kd.'/'.$uri3);
        $no_wa = substr_replace($get_verif_awal->no_hp,"62",0,1);
        $pesan = "*Layanan LinTAS* Ada surat yang akan diverifikasi, silahkan klik link berikut $links ";
		$data = array(
			'waktu_verif1'=>"",
			'id_verif1'=>0,
			'alasan_tolak'=>"",
			'ajukan'=>1
		);
		$this->model_sitas->update_data("surat_keluar","id_surat_keluar",$uri3,$data);
		$this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
		redirect('primer/buat_surat');
		//echo $no_wa."---".$pesan;
	}
	function list_ver_surat_keluar1(){
		cek_session_admin1();
		$username = $this->session->username;
		$tahun = $this->session->tahun;
		$get_verif_awal = $this->model_sitas->get_verifikator_awal();
		if($username == $get_verif_awal->username){
			$data['rec'] = $this->model_sitas->listDataBy("*","surat_keluar",
							"tanggal like '%$tahun%' and id_verif1 = 0 and ajukan = 1","id_surat_keluar desc");
			$this->template->load('sitas/template_form','sitas/verif_surat/daftar_surat1',$data);
		} else {
			$this->load->view('sitas/verif_surat/no_akses');
		}
	}
	function verif_surat(){
		cek_session_admin1();
		$username = $this->session->username;
		$tahun = $this->session->tahun;
		$get_verif_akhir = $this->model_sitas->get_verifikator_akhir();
		if($username == $get_verif_akhir->username){
			$data['rec'] = $this->model_sitas->listDataBy("*","surat_keluar",
							"tanggal like '%$tahun%' and id_verif1 != 0 and id_verif = 0","id_surat_keluar desc");
			$this->template->load('sitas/verif_surat/template_form','sitas/verif_surat/daftar_surat',$data);
		} else {
			$this->load->view('sitas/verif_surat/no_akses');
		}
	}
	function verif_surat_detail1(){
		cek_session_admin1();
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$username = $this->session->username;
		$get_verif_awal = $this->model_sitas->get_verifikator_awal();
		$cek_data_lamp = $this->model_sitas->rowDataBy("deskripsi","surat_keluar_lampiran","id_surat_keluar = $uri4")->num_rows();
		$cek_file_lamp = $this->model_sitas->rowDataBy("file_lampiran","surat_keluar","id_surat_keluar = $uri4")->row();
		$qw_spt = $this->model_sitas->rowDataBy("*","surat_keluar","id_surat_keluar = $uri4")->row();
		if($username == $get_verif_awal->username){
			$data['kabalai'] = $this->model_sitas->get_verifikator_akhir();
			$data['cek_data_lamp'] = $cek_data_lamp;
			if($cek_data_lamp > 0){
			$data['lampiran'] = $this->model_sitas->listDataBy("deskripsi,no_view_border","surat_keluar_lampiran",
								"id_surat_keluar = $uri4","id_surat_keluar asc");
			} else {
			$data['lampiran'] = array();
			}
			if($cek_file_lamp->file_lampiran != ""){
				$data['file_lampiran'] = $cek_file_lamp->file_lampiran;
			} else {
				$data['file_lampiran'] = "";
			}
			if($qw_spt->lokasi_tujuan_surat=="SPT"){
				$qw_spt2 = $this->model_sitas->rowDataBy("*","spt","id_surat_keluar = $uri4")->row();
				$data['spt'] = $qw_spt2;
				$data['peg'] = $this->model_sitas->listDataBy("a.id_pegawai,a.tanggal_spt,b.nama,b.pangkat,b.gol,b.nip,b.jabatan,b.uk,b.is_internal",
							"anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai","a.id_spt=$qw_spt2->id_spt","a.id_anggota asc");
				$this->template->load('sitas/template_form','sitas/verif_surat/verif_spt1',$data);
			} else {
				$qw_spt2 = "";
				$data['spt'] = $qw_spt;
				$data['peg'] = array();
				$this->template->load('sitas/template_form','sitas/verif_surat/verif_surat1',$data);
			}
		} else {
			$this->load->view('sitas/verif_surat/no_akses');
		}
	}
	function setuju_surat1(){
	    cek_session_admin1();
		date_default_timezone_set('Asia/Jakarta');
		$user = $this->model_sitas->get_user();
		$tgl = date('Y-m-d H:i:s');
	    $id_spt = $_POST['id_buat_surat'];
	    $get_verif_akhir = $this->model_sitas->get_verifikator_akhir();
	    $ket = $_POST['keterangan'];
	    $this->db->query("update surat_keluar set keterangan = '$ket', waktu_verif1 = '$tgl', id_verif1 = $user->id_pegawai where id_surat_keluar = $id_spt");
	    $no_wa = substr_replace($get_verif_akhir->no_hp,62,0,1);
        $links = base_url('primer?redir=verif_surat_detail/'.md5($id_spt).'/'.$id_spt);
        $pesan = "*Layanan LinTAS* Ada surat yang akan diverifikasi, silahkan klik link berikut $links";
        $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
		redirect('primer/list_ver_surat_keluar1');
		//echo $no_wa."---".$pesan;
	}
	function tolak_surat1(){
	    cek_session_admin1();
		date_default_timezone_set('Asia/Jakarta');
		$user = $this->model_sitas->get_user();
		$tgl = date('Y-m-d H:i:s');
	    $id_spt = $_POST['id_buat_surat'];
	    $qw_surat = $this->model_sitas->rowDataBy("user","surat_keluar","id_surat_keluar = $id_spt")->row();
		$get_buat_surat = $this->model_sitas->get_peg_by_user($qw_surat->user);
	    $ket = $_POST['alasan_tolak'];
	    $this->db->query("update surat_keluar set alasan_tolak = '$ket', ajukan = 0 where id_surat_keluar = $id_spt");
	    $no_wa = substr_replace($get_buat_surat->no_hp,62,0,1);
        $links = base_url('primer?redir=buat_surat');
        $pesan = "*Layanan LinTAS* Pengajuan surat ditolak, silahkan klik link berikut $links";
        $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
		redirect('primer/list_ver_surat_keluar1');
	}
	function setuju_surat(){
	    cek_session_admin1();
		date_default_timezone_set('Asia/Jakarta');
		$user = $this->model_sitas->get_user();
		$qw_petugas_surat = $this->model_sitas->rowDataBy("id_pegawai","petugas_terima","menu = 'surat_keluar'")->row();
		$qw_user_petugas = $this->model_sitas->rowDataBy("username","user","id_pegawai = $qw_petugas_surat->id_pegawai")->row();
		$get_buat_surat = $this->model_sitas->get_peg_by_user($qw_user_petugas->username);
		$tgl = date('Y-m-d H:i:s');
	    $id_spt = $_POST['id_buat_surat'];
		$id_spt_asli = $_POST['id_spt'];
	    $ket = $_POST['keterangan'];
		$qw_surat_keluar = $this->model_sitas->rowDataBy("isi_surat","surat_keluar","id_surat_keluar = $id_spt")->row();
	    $this->db->query("update surat_keluar set keterangan = '$ket', waktu_verif = '$tgl', id_verif = $user->id_pegawai where id_surat_keluar = $id_spt");
		$no_wa = substr_replace($get_buat_surat->no_hp,62,0,1);
        $links = base_url('primer?redir=buat_surat_keluar');
        $pesan = "*Layanan LinTAS* Pemberian nomor surat, silahkan klik link berikut $links";
        $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
		//echo $no_wa."---".$pesan."<br><br>";
		if($qw_surat_keluar->isi_surat == "SPT"){
			$qw_petugas_spt = $this->model_sitas->listDataBy("b.is_internal,c.nama,c.no_hp,d.tanggal,d.lama_hari,d.untuk,d.ket_wilayah",
			"anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai 
			inner join pegawai c on b.id_pegawai=c.id_pegawai inner join spt d on a.id_spt=d.id_spt",
			"a.id_spt = $id_spt_asli","a.id_anggota asc");
			foreach($qw_petugas_spt as $qps){
				$pesan_untuk_petugas = "*Layanan LinTAS* Anda mendapatkan Surat Perintah Tugas perihal ".$qps->untuk." di ".$qps->ket_wilayah.". Pada tanggal ".sd_tgl($qps->tanggal,$qps->lama_hari);
				if($qps->is_internal == 1){
					$no_wa_petugas = substr_replace($qps->no_hp,62,0,1);
					$this->model_sitas->kirim_wa_gateway($no_wa_petugas,$pesan_untuk_petugas);
					//echo $no_wa_petugas."---".$pesan_untuk_petugas."<br>";
				}
			}
		}
		redirect('primer/verif_surat');
	}
	function tolak_surat(){
	    cek_session_admin1();
		date_default_timezone_set('Asia/Jakarta');
		$user = $this->model_sitas->get_user();
		$tgl = date('Y-m-d H:i:s');
	    $id_spt = $_POST['id_buat_surat'];
	    $qw_surat = $this->model_sitas->rowDataBy("user","surat_keluar","id_surat_keluar = $id_spt")->row();
		$get_buat_surat = $this->model_sitas->get_peg_by_user($qw_surat->user);
	    $ket = $_POST['alasan_tolak'];
	    $this->db->query("update surat_keluar set alasan_tolak = '$ket', ajukan = 0 where id_surat_keluar = $id_spt");
	    $no_wa = substr_replace($get_buat_surat->no_hp,62,0,1);
        $links = base_url('primer?redir=buat_surat');
        $pesan = "*Layanan LinTAS* Pengajuan surat ditolak, silahkan klik link berikut $links";
        $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
		redirect('primer/verif_surat');
	}
	function verif_surat_detail(){
		cek_session_admin1();
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$username = $this->session->username;
		$get_verif_akhir = $this->model_sitas->get_verifikator_akhir();
		$cek_data_lamp = $this->model_sitas->rowDataBy("deskripsi","surat_keluar_lampiran","id_surat_keluar = $uri4")->num_rows();
		$cek_file_lamp = $this->model_sitas->rowDataBy("file_lampiran","surat_keluar","id_surat_keluar = $uri4")->row();
		$qw_spt = $this->model_sitas->rowDataBy("*","surat_keluar","id_surat_keluar = $uri4")->row();
		if($username == $get_verif_akhir->username){
			$data['kabalai'] = $get_verif_akhir;
			$data['cek_data_lamp'] = $cek_data_lamp;
			if($cek_data_lamp > 0){
			$data['lampiran'] = $this->model_sitas->listDataBy("deskripsi,no_view_border","surat_keluar_lampiran",
								"id_surat_keluar = $uri4","id_surat_keluar asc");
			} else {
			$data['lampiran'] = array();
			}
			if($cek_file_lamp->file_lampiran != ""){
				$data['file_lampiran'] = $cek_file_lamp->file_lampiran;
			} else {
				$data['file_lampiran'] = "";
			}
			if($qw_spt->lokasi_tujuan_surat=="SPT"){
				$qw_spt2 = $this->model_sitas->rowDataBy("*","spt","id_surat_keluar = $uri4")->row();
				$data['spt'] = $qw_spt2;
				$data['peg'] = $this->model_sitas->listDataBy("a.id_pegawai,a.tanggal_spt,b.nama,b.pangkat,b.gol,b.nip,b.jabatan,b.uk,b.is_internal",
							"anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai","a.id_spt=$qw_spt2->id_spt","a.id_anggota asc");
				$this->template->load('sitas/template_form','sitas/verif_surat/verif_spt',$data);
			} else {
				$qw_spt2 = "";
				$data['spt'] = $qw_spt;
				$data['peg'] = array();
				$this->template->load('sitas/template_form','sitas/verif_surat/verif_surat',$data);
			}
		} else {
			$this->load->view('sitas/verif_surat/no_akses');
		}
	}
	function prev_surat(){
		cek_session_admin1();
		$uri3 = $this->uri->segment(3);
		$qw_surat = $this->model_sitas->rowDataBy("id_surat_keluar,id_sub_arsip,no_surat_keluar,tujuan_surat,lokasi_tujuan_surat,tanggal,sifat,lampiran,perihal,isi_surat,id_verif,tembusan,no_view_border",
					"surat_keluar","id_surat_keluar = $uri3")->row();
		$qw_sub_arsip = $this->model_sitas->rowDataBy("a.kode_sub_arsip,b.arsip,a.sub_arsip",
						"klasifikasi_sub_arsip a inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip",
						"a.id_sub_arsip = $qw_surat->id_sub_arsip")->row();
		$cek_lampiran = $this->model_sitas->jmlDataBy("id_surat_keluar","surat_keluar_lampiran","id_surat_keluar=$uri3");
		if($cek_lampiran > 0){
			$data['list_lp'] = $this->model_sitas->listDataBy("*","surat_keluar_lampiran","id_surat_keluar=$uri3","id_lampiran asc");
		} else {
			$data['list_lp'] = array();
		}
		$data['uri3'] = $uri3;
		$data['cek_lampiran'] = $cek_lampiran;
		$data['surat'] = $qw_surat;
		$data['sub_arsip'] = $qw_sub_arsip;
		$data['ars'] = $this->model_sitas->listData("a.id_sub_arsip,a.kode_sub_arsip,b.arsip,a.sub_arsip",
						"klasifikasi_sub_arsip a inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip","id_sub_arsip asc");
		$data['row_sifat'] = $this->model_sitas->rowDataBy("sifat","sifat_surat","id_sifat = $qw_surat->sifat")->row();
		$data['sif'] = $this->model_sitas->listData("id_sifat,sifat","sifat_surat","id_sifat asc");
		$this->template->load('sitas/template_form','sitas/prev_surat',$data);
	}
	function save_surat_prev(){
		$is_garis = _POST('is_garis');
		$id_surat_keluar = _POST('id_surat_keluar');
		$data = [
			'isi_surat'=>$this->input->post('isi_surat'),
			'no_view_border'=>$is_garis
		];
		$this->model_sitas->update_data("surat_keluar","id_surat_keluar",$id_surat_keluar,$data);
		redirect('primer/prev_surat/'.$id_surat_keluar);
	}
	function save_lampiran_prev(){
		$deskripsi = $this->input->post('deskripsi');
		$id_surat_keluar = _POST('id_surat_keluar');
		$id_lampiran = $this->input->post('id_lampiran');
		$no = 0;
		foreach($deskripsi as $desk){
			$this->db->query("update surat_keluar_lampiran set deskripsi = '$desk' where id_lampiran = $id_lampiran[$no]");
			$no++;
		}
		redirect('primer/prev_surat/'.$id_surat_keluar);
	}
	function daftar_spt(){
	    cek_session_admin1();
		$thn = $this->session->tahun;
		//$id_pjs = $this->model_sitas->rowDataBy("*","pejabat_verifikator","level = 'akhir'")->row();
		$id_pjs = $this->model_sitas->rowDataBy("*","petugas_terima","menu = 'surat_keluar'")->row();
		$data['rec'] = $this->model_sitas->listDataBy("*","spt","tanggal like '%$thn%'","id_spt desc");
		//$data['kabalai'] = $this->model_sitas->rowDataBy("nip,nama,no_hp","pegawai","id_pegawai = $id_pjs->id_pegawai")->row();
		$data['petugas'] = $this->model_sitas->rowDataBy("nip,nama,no_hp","pegawai","id_pegawai = $id_pjs->id_pegawai")->row();
        $this->template->load('sitas/template_form','sitas/daftar_spt',$data);
	}
	function buat_sptxx(){
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
	function data_spt(){
		date_default_timezone_set('Asia/Jakarta');
		cek_session_admin1();
		$tahun = $this->session->tahun;
        $uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        $uri5 = $this->uri->segment(5);
        $uri6 = $this->uri->segment(6);
        $user = $this->model_sitas->get_user();
        $cek_tgl = $this->input->get('tanggal');
        if (isset($cek_tgl)) {
            $get_tgl = $this->input->get('tanggal');
            $get_lama = $this->input->get('lama_hari');
        } else {
            $get_tgl = date('Y-m-d');
            $get_lama = "1";
        }
		$qw_surat_masuk = $this->db->query("select id_surat_masuk,no_surat_masuk,asal_surat,tanggal,perihal,file_pdf from surat_masuk order by id_surat_masuk desc limit 200")->result();
		$data['list'] = $this->model_sitas->listDataBy("*","spt","tanggal_input like '%$tahun%' and is_dipa = 0","id_spt desc");
        //$data['list_sm'] = $this->model_sitas->listDataBy("*","surat_masuk","tanggal like '%$tahun%' and id_pegawai_disposisi != 0","id_surat_masuk desc limit 200");
		$data['peg'] = $this->model_sitas->listData("*","pegawai","id_pegawai ASC");
		$data['list_sm'] = $qw_surat_masuk;
		$data['transportasi'] = $this->model_sitas->listData("*","transportasi_spt","id_transport");
		$data['subkomp'] = $this->model_sitas->listDataBy("a.id_subkomp,a.kd_subkomp,a.subkomp",
							"a_subkomp7 a inner join a_komponen6 b on a.id_komponen=b.id_komponen
								inner join a_ro5 c on b.id_ro=c.id_ro
								inner join a_kro4 d on c.id_kro=d.id_kro
								inner join a_aktivitas3 e on d.id_aktivitas=e.id_aktivitas
								inner join a_program2 f on e.id_program=f.id_program
								inner join a_trs_alokasi1 g on f.id_alokasi=g.id_alokasi",
								"g.ta = '2024'","a.id_subkomp");
		$data['pegawai'] = $this->model_sitas->listData("id_pegawai,nama","pegawai","id_pegawai");
		if(empty($uri3)){
            $data['spt'] = $this->model_sitas->cek_anggota_spt($get_tgl,$get_lama);
            $data['tgl_ini'] = date('Y-m-d');
            $data['menimbang'] = "Bahwa dalam rangka mendukung terlaksananya kegiatan standardisasi instrumen tanaman perkebunan, maka dipandang perlu menugaskan pegawai yang berkompeten sesuai bidangnya dibawah ini.";
            $data['lamanya'] = 1;  
            $data['untuk'] = "";
			$data['dasar'] = "<ul><li>Peraturan Menteri Pertanian Nomor 13 Tahun 2023
			tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis
			Lingkup Badan Standardisasi Instrumen Pertanian</li></ul>";
			$data['ceck'] = "";
			$data['verif'] = 0;
            /*
			if($uri2 == "spt_surat_masuk"){
                $data['id_surat_masuk'] = $uri3;
                $data['isi_surat'] = $this->model_sitas->model_dasar_spt2($uri3);
            } else {
                $data['id_surat_masuk'] = "";
                $data['isi_surat'] = $this->model_sitas->model_dasar_spt();    
            }
			*/
            $data['user'] = "";
			$data['tempat_berangkat'] = "Malang";
			$data['ket_wilayah'] = "";
            $data['tanggal_input'] = date('Y-m-d');
            $data['npj'] = "--Pilih Pegawai--";
            $data['pj'] = "";
            $data['is_dipa'] = 0;
            $data['id_spt'] = 0;
            $data['arr'] = "";
            $data['status'] = "save";
			$data['tgl_no'] = "";
			$data['id_surat_masuk'] = 0;
			$data['li_dasar'] = "'<li>Peraturan Menteri Pertanian Nomor 13 Tahun 2023 tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis Lingkup Badan Standardisasi Instrumen Pertanian</li>'";
        } else {
			$row = $this->model_sitas->rowDataBy("*","spt","id_spt = $uri3")->row();
            //$get_pj = $this->model_sitas->rowDataBy("nama","pegawai","id_pegawai = $row->pj")->row();
            $get_spt_peg = $this->model_sitas->listDataBy("a.id_pegawai,b.nama","anggota_spt a inner join pegawai b on a.id_pegawai=b.id_pegawai",
                            "a.id_spt = $uri3","a.id_anggota asc");
            if (isset($cek_tgl)) {
                $data['spt'] = $this->model_sitas->cek_anggota_spt($get_tgl,$get_lama);
            } else {
                $data['spt'] = $this->model_sitas->cek_anggota_spt($row->tanggal,$row->lama_hari);
            }
            $data['tgl_ini'] = $row->tanggal;
            $data['menimbang'] = $row->menimbang;
            $data['lamanya'] = $row->lama_hari;
            $data['untuk'] = $row->untuk;
			$data['dasar'] = $row->dasar;
			if($row->is_dipa == 1){
				$data['ceck'] = "checked";
			} else {
				$data['ceck'] = "";
			}
			$data['verif'] = 0;
			/*
            if($uri5 == "surat_masuk"){
                $data['id_surat_masuk'] = $uri6;
                $data['isi_surat'] = $this->model_sitas->model_dasar_spt2($uri6);
            } else {
                $data['id_surat_masuk'] = "";
                $data['isi_surat'] = $row->dasar;
            }
			*/
            $data['tanggal_input'] = $row->tanggal_input;   
            $data['is_dipa'] = $row->is_dipa;
            $data['pj'] = $row->pj;
            $data['npj'] = "";//$get_pj->nama;
            $data['id_pj'] = $row->pj;
            $data['user'] = $row->user;
			$data['tempat_berangkat'] = $row->tempat_berangkat;
			$data['ket_wilayah'] = $row->ket_wilayah;
            $data['id_spt'] = $row->id_spt;
            $data['arr'] = $get_spt_peg;
            $data['status'] = "edit";
			$data['tgl_no'] = "";
			$data['id_surat_masuk'] = $row->id_surat_masuk;
			$data['li_dasar'] = clir_ul($row->dasar);
        }
		$this->template->load('sitas/template_form','sitas/buat_spt',$data);
	}
	public function add_spt()
  	{
		$id_spt = _POST('id_spt');
		$id_peg_selected = $this->input->post('peg');
		$anggota_spt_existing = $this->model_sitas->get_anggota_spt_by_id_spt($id_spt);
		$menimbang = _POST('menimbang');
		$status = _POST('status');
		$is_dipa = $this->input->post('is_dipa') ? 1 : 0;
			if($is_dipa == 1){
				$data = [
					'id_surat_masuk'=>_POST('id_surat_masuk'),
					'id_sub_arsip'=>_POST('id_arsip'),
					'menimbang' => $menimbang,
					'dasar' => $this->input->post('dasar'),
					'untuk' => _POST('untuk'),
					'tanggal' => _POST('tanggal'),
					'lama_hari' => _POST('lamanya'),
					'is_dipa' => $is_dipa,
					'ket_berangkat' => _POST('tempat_berangkat'),
					'ket_wilayah' => _POST('ket_wilayah'),
					'id_transport' => _POST('id_transport'),
					'id_subdetil' => _POST('id_subdetil'),
					'pj' => _POST('pj'),
					'user' => _POST('user'),
					'tanggal_input' => _POST('tanggal_input'),
					'keterangan' => null
				];
			} else {
				$data = [
					'id_surat_masuk'=>_POST('id_surat_masuk'),
					'id_sub_arsip'=>_POST('id_arsip'),
					'menimbang' => $menimbang,
					'dasar' => $this->input->post('dasar'),
					'untuk' => _POST('untuk'),
					'tanggal' => _POST('tanggal'),
					'lama_hari' => _POST('lamanya'),
					'is_dipa' => $is_dipa,
					'user' => _POST('user'),
					'tanggal_input' => _POST('tanggal_input'),
					'keterangan' => null
				];
			}
    	$tgl_anggota_spt = no_anggota_spt(_POST('tanggal'),_POST('lamanya'));
    	if($status != "edit"){
			$this->model_sitas->saveData('spt', $data);
			$anggota_spt = $this->db->insert_id();
			//$anggota_spt = 1;
			$id_pegawai = implode(",",$this->input->post('peg'));
			$pegawai = explode(",",$id_pegawai);
			$data2 = array();
			foreach($pegawai as $peg){
				array_push($data2, array(
					'id_spt' => $anggota_spt,
					//'id_spt'=> 1,
					'id_pegawai' => $peg,
					'tanggal_spt' => $tgl_anggota_spt,
				));
			}
			$this->model_sitas->saveDataBanyak('anggota_spt', $data2);
			redirect('primer/daftar_spt');
			/*
			print_r($data);
			echo "<br>";
			print_r($data2);
			*/
    	} else {
			foreach ($anggota_spt_existing as $anggota) {
				if (!in_array($anggota->id_pegawai, $id_peg_selected)) {
					$this->model_sitas->delete_spt("anggota_spt", "id_anggota", $anggota->id_anggota);
				}
			}
			foreach ($id_peg_selected as $id_pegawai) {
				$data_anggota_spt = array(
					'id_spt' => $id_spt,
					'id_pegawai' => $id_pegawai,
					'tanggal_spt' => $tgl_anggota_spt,
				);
				$existing_anggota_spt = $this->model_sitas->get_existing_anggota_spt($id_spt, $id_pegawai);
				if ($existing_anggota_spt) {
					$this->model_sitas->update_data("anggota_spt", "id_anggota", $existing_anggota_spt->id_anggota, $data_anggota_spt);
				} else {
					$this->model_sitas->saveData('anggota_spt', $data_anggota_spt);
				}
			}
			$this->model_sitas->update_data("spt","id_spt",$id_spt,$data);
			redirect('primer/daftar_spt');
    	}
  	}	
	function delete_spt(){
		cek_session_admin1();
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		if($uri4 == get_kode_uniks($uri3)){
			$this->model_sitas->hapus_data("spt","id_spt = $uri3");
			$this->model_sitas->hapus_data("anggota_spt","id_spt = $uri3");
		} 
		redirect('primer/daftar_spt');

	}
	function lihat_spt(){
	    cek_session_admin1();
	    if(isset($_POST['id_spt'])){
		    $id_spt = $_POST['id_spt'];
			$data['spt'] = $this->model_sitas->rowDataBy("*","spt","id_spt=$id_spt")->row();
			$data['peg'] = $this->model_sitas->listDataBy("a.id_pegawai,a.tanggal_spt,b.nama,b.pangkat,b.gol,b.nip,b.jabatan,b.uk,b.is_internal",
							"anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai","a.id_spt=$id_spt","a.id_anggota asc");
		    $data['no_surat'] = "";
			$this->load->view('sitas/lihat_spt',$data);
		}
	}
	function no_sppd(){
		$id_spt = _POST('id');
		$no_current = $this->db->query("select a.id_transport,a.id_subdetil,a.is_dipa,a.ket_berangkat,a.ket_wilayah,
						a.instansi_pembiayaan,a.kode_pembiayaan,a.no_sppd,a.kendaraan,a.instansi_tujuan,a.nama_ttd_instansi_tujuan,
						a.nip_ttd_instansi_tujuan,a.id_ppk,a.tgl_sppd,b.transportasi 
						from spt a inner join transportasi_spt b on a.id_transport=b.id_transport where a.id_spt = $id_spt")->row();
		$no_max = $this->db->query("select max(no_sppd) as nox from spt")->row();
		$spt_last = $this->db->query("select id_spt from spt where no_sppd != 0 order by id_spt desc")->row();
		$pjb_ppk = $this->model_sitas->rowDataBy("id_pegawai","struktur_organisasi","id_struktur = 5")->row();
		if(empty($spt_last)){
			$get_jml_anggota = 1;
		} else {
			$get_jml_anggota = $this->db->query("select id_anggota from anggota_spt where id_spt = $spt_last->id_spt")->num_rows();
		}
		$jml_anggota = $get_jml_anggota - 1;
		if($no_current->no_sppd != 0){
			$nomor_sppd = $no_current->no_sppd;
			$tgl_sppd = $no_current->tgl_sppd;
			$id_ppk = $no_current->id_ppk;
		} else {
			$nomor_sppd = $no_max->nox + 1 + $jml_anggota;
			$tgl_sppd = date('Y-m-d');
			$id_ppk = $pjb_ppk->id_pegawai;
		}
		$data['nox'] = $nomor_sppd;
		if($no_current->id_transport == 0){
			$data['kendaraan'] = $no_current->kendaraan;
		} else {
			$data['kendaraan'] = $no_current->transportasi;
		}
		$data['ket_wilayah'] = $no_current->ket_wilayah;
		if($no_current->ket_berangkat==""){
			$data['ket_berangkat'] = "BPSI TAS";
		} else {
			$data['ket_berangkat'] = $no_current->ket_berangkat;
		}
		if($no_current->instansi_pembiayaan==""){
			if($no_current->is_dipa == 1){	
				$data['instansi_pembiayaan'] = "Balai Pengujian Standar Instrumen Tanaman Pemanis dan Serat";
			} else {
				$data['instansi_pembiayaan'] = "";
			}
		} else {
			$data['instansi_pembiayaan'] = $no_current->instansi_pembiayaan;
		}
		if($no_current->id_subdetil == 0){
			$data['kode_pembiayaan'] = $no_current->kode_pembiayaan;
		} else {
			$pos = $this->model_sitas->rowDataBy("a.vol,a.satuan,a.harga_satuan,b.kd_detil,c.kd_subkomp,c.subkomp,
							d.kd_komponen,e.kd_ro",
							"a_subdetil9 a inner join a_detil8 b on a.id_detil=b.id_detil 
								inner join a_subkomp7 c on b.id_subkomp=c.id_subkomp inner join a_komponen6 d on c.id_komponen = d.id_komponen
								inner join a_ro5 e on d.id_ro = e.id_ro",
							"a.id_subdetil = $no_current->id_subdetil")->row();
			$data['kode_pembiayaan'] = $pos->kd_ro.".".$pos->kd_komponen.".".$pos->kd_subkomp.".".$pos->kd_detil;
		}
		$data['instansi_tujuan'] = $no_current->instansi_tujuan;
		$data['nama_ttd_instansi_tujuan'] = $no_current->nama_ttd_instansi_tujuan;
		$data['nip_ttd_instansi_tujuan'] = $no_current->nip_ttd_instansi_tujuan;
		$data['tgl_sppd'] = $tgl_sppd;
		$data['id_ppk'] = $id_ppk;
		$data['id_spt'] = $id_spt;
		$this->load->view('sitas/form_sppd',$data);
	}
	function add_no_sppd(){
		$tgl = date('Y-m-d');
		$no_sppd = _POST('no_sppd');
		$kendaraan = _POST('kendaraan');
		$ket_wilayah = _POST('ket_wilayah');
		$ket_berangkat = _POST('ket_berangkat');
		$instansi_pembiayaan = _POST('instansi_pembiayaan');
		$kode_pembiayaan = _POST('kode_pembiayaan');
		//$instansi_tujuan = _POST('instansi_tujuan');
		//$nama_ttd_yg_dikunjungi = _POST('nama_ttd_yg_dikunjungi');
		//$nip_ttd_yg_dikunjungi = _POST('nip_ttd_yg_dikunjungi');
		$id_ppk = _POST('id_ppk');
		$tgl_sppd = _POST('tgl_sppd');
		$id_spt = _POST('id_spt');
		$data = ['no_sppd'=>$no_sppd,
					'kendaraan'=>$kendaraan,
					'ket_berangkat'=>$ket_berangkat,
					'ket_wilayah'=>$ket_wilayah,
					'instansi_pembiayaan'=>$instansi_pembiayaan,
					'kode_pembiayaan'=>$kode_pembiayaan,
					//'instansi_tujuan'=>$instansi_tujuan,
					//'nama_ttd_instansi_tujuan'=>$nama_ttd_yg_dikunjungi,
					//'nip_ttd_instansi_tujuan'=>$nip_ttd_yg_dikunjungi,
					'id_ppk'=>$id_ppk,
					'tgl_sppd'=>$tgl_sppd
				];
		$this->model_sitas->update_data("spt","id_spt",$id_spt,$data);
		redirect('primer/daftar_spt');
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
            $inp = array("id_cuti#0","id_jenis_cuti#0","alasan_cuti#0","lama_cuti#0","tgl_mulai#0","tgl_akhir#0","alamat_cuti#0","tgl_input#0","tahun#0","username#0","pejabat_atasan_langsung#0");
            $tbl = "trs_cuti";
            $idx = "id_cuti";
            $this->model_sitas->save_all_wa($inp,$tbl,$idx);
			redirect('primer/buat_cuti');
        } else {
            if(empty($uri3)){
                $tgl = date('Y-m-d');
                $tgl_wkt = date('Y-m-d H:i:s');
                $thn = $this->session->tahun;
                $data['judul'] = "Input Permohonan Cuti";
                $data['metod'] = "post";
                $data['aktion'] = "";
                $data['enctype'] = "";
				$data['idx'] = "onsubmit='return cekTanggal()'";
                // (type,name,value,placeholder,label,option (for select),required/readonly)
                $data['forms'] = array(
                                        array("select","id_jenis_cuti","","Jenis Cuti","Jenis Cuti",$jn_cuti,"required"),
                                        array("textarea","alasan_cuti","","Masukkan Alasan Cuti","Masukkan Alasan Cuti","","required"),
                                        array("number","lama_cuti","","Lama Cuti","Lama Cuti","","required"),
                                        array("date","tgl_mulai",$tgl,"Tanggal Mulai","Tanggal Mulai","","id='tanggal_mulai' required"),
                                        array("date","tgl_akhir",$tgl,"Tanggal Akhir","Tanggal Akhir","","id='tanggal_selesai' required"),
                                        array("textarea","alamat_cuti","","Masukkan Alamat Cuti","Masukkan Alamat Cuti","","required"),
                                        array("select","pejabat_atasan_langsung","","Atasan Langsung","Atasan Langsung",$atasan,"required"),
                                        array("hidden","tgl_input",$tgl_wkt,"","","",""),
                                        array("hidden","tahun",$thn,"","","",""),
                                        array("hidden","username",$usr,"","","",""),
                                        array("submit","submit","Simpan","","","","")
                                        );
            } else {
				$qwx = $this->model_sitas->rowDataBy("*","trs_cuti","id_cuti = $uri3")->row();
                $jn_cutix = $this->model_sitas2->jenis_cuti_select($qwx->id_jenis_cuti);
				$atasan_selex = $this->model_sitas2->atasan_selekted($qwx->pejabat_atasan_langsung);
                $data['judul'] = "Edit Permohonan Cuti";
                $data['metod'] = "post";
                $data['aktion'] = "";
                $data['enctype'] = "";
				$data['idx'] = "onsubmit='return cekTanggal()'";
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
                                        array("date","tgl_mulai",$qwx->tgl_mulai,"Tanggal Mulai","Tanggal Mulai","","id='tanggal_mulai' required"),
                                        array("date","tgl_akhir",$qwx->tgl_akhir,"Tanggal Akhir","Tanggal Akhir","","id='tanggal_selesai' required"),
                                        array("textarea","alamat_cuti",$qwx->alamat_cuti,"Masukkan Alamat Cuti","Masukkan Alamat Cuti","","required"),
                                        array("select","pejabat_atasan_langsung","","Atasan Langsung","Atasan Langsung",$atasan_selex,"required"),
                                        array("hidden","tgl_input",$qwx->tgl_input,"","","",""),
                                        array("hidden","tahun",$qwx->tahun,"","","",""),
                                        array("hidden","username",$usr,"","","",""),
                                        array("hidden","id_cuti",$qwx->id_cuti,"","","",""),
                                        $send
                                        );
            }
			$heads = array("No","Nama","Jenis Cuti","Alasan","Tanggal","Sisa","Status","Aksi");
            $data['judul2'] = "Daftar Cuti Pegawai";
            $data['heads'] = $heads;
            $data['list'] = $dtx;
            $data['jml_col'] = count($heads);
            // (style,ukuran btn,warna btn,href,icon,isi,onclick)
			$data['aksi'] = array(array("","btn-sm","btn-primary","primer/buat_cuti/","<i class='fas fa-edit'></i>","Edit",""),
						array("margin-top:2px","btn-sm","btn-danger","primer/delete_cuti/","<i class='fas fa-trash-alt'></i>","Hapus","return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')"),
						array("","btn-sm","btn-warning","preview/cuti/","<i class='fas fa-file-pdf'></i>","PDF",""),
						array("","btn-sm","btn-success","primer/ajukan_cuti/","<i class='fas fa-share'></i>","Ajukan","")
						);
			$data['uri2'] = $this->uri->segment(2);
            $this->template->load('sitas/template_form','sitas/view_ini',$data);
        }
    }
	public function delete_cuti(){
		cek_session_admin1();
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		if(get_kode_uniks($uri3) == $uri4){
			$this->model_sitas->hapus_data("trs_cuti","id_cuti=$uri3");
			redirect('primer/buat_cuti');
		} else {
			echo "Sori Yeee wkwkwkwk";
		}
	}
	public function ajukan_cuti(){
		cek_session_admin1();
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$kepeg = $this->model_sitas->rowDataBy("a.id_pegawai,b.nama,b.no_hp",
					"petugas_terima a inner join pegawai b on a.id_pegawai=b.id_pegawai","a.menu = 'cuti'","a.id_petugas asc")->row();
		$cuti = $this->model_sitas->rowDataBy("*","trs_cuti","id_cuti = $uri3")->row();
		$pjb_atasan = $this->model_sitas->rowDataBy("nama,no_hp","pegawai","id_pegawai=$cuti->pejabat_atasan_langsung")->row();
		$id_pemohon = $this->model_sitas->get_user_by($cuti->username);
		$get_kabalai = $this->model_sitas->get_verifikator_akhir();
		$is_before = $this->model_sitas->rowDataBy("id_pegawai","cuti_sebelum","id_pegawai = $id_pemohon->id_pegawai")->num_rows();
		if($is_before > 0){
			if($cuti->verif_atasan_langsung == 1){
				if($cuti->verif_atasan == 1){
					$this->load->view('sitas/verif_surat/setuju');
				} else {
					$no_wa = substr_replace($get_kabalai->no_hp,62,0,1);
					$links = base_url('primer?redir=verif_cuti/'.$uri3.'/'.$uri4);
					$pesan = "*Layanan LinTAS* Ada Cuti Pegawai yang akan diverifikasi, silahkan klik link berikut $links";
					$this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
					redirect('primer/buat_cuti');
				}
			} else {
				$no_wa = substr_replace($pjb_atasan->no_hp,62,0,1);
				$links = base_url('primer?redir=verif_cuti2/'.$uri3.'/'.$uri4);
				//$links = base_url('sekunder/list_verif_cuti2/'.$uri3.'/'.$uri4);
				$pesan = "*Layanan LinTAS* Ada Cuti Pegawai yang akan diverifikasi, silahkan klik link berikut $links";
				$this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
				redirect('primer/buat_cuti');
			}
		} else {
			$no_wa = substr_replace($kepeg->no_hp,62,0,1);
            $links = base_url('primer?redir=input_cuti_sebelum/'.$uri3.'/'.$uri4);
            $pesan = "*Layanan LinTAS* Tentukan jumlah cuti pegawai sebelumnya, dengan klik link berikut $links";
            $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
			redirect('primer/buat_cuti');
		}
	}
    public function drive(){
		cek_session_admin1();
	    $uri3 = $this->uri->segment(3);
	    $thn = $this->session->tahun;
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
			$data['vw_edit'] = "display:none";
	    } else {
	        $id_folder = $this->db->query("select id_folder,folder from folder where url = '$uri3'")->row();
	        $qw_folder = $this->db->query("select folder,url from folder where root = $id_folder->id_folder")->result();
	        $qw_surat_keluar = $this->db->query("select id_surat_keluar,id_sub_arsip,perihal,no_surat_keluar,sifat,tanggal from surat_keluar where tanggal like '%$thn%' order by id_surat_keluar desc")->result();
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
	        /*
			$judul = str_replace("_"," > ",$uri3);
	        $judull = str_replace("-"," ",$judul);
	        $judulll = ucwords($judull);
			*/
			$judulll = $this->model_sitas->get_info_drive($uri3);
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
			$data['vw_edit'] = "display:";
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
		$pesan = "*Layanan LinTAS* Disposisi Surat kepada $penerima , silahkan klik link berikut $links ";
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
		$user_log = $this->model_sitas->get_user($this->session->username);
		$kabalai = $this->model_sitas->rowDataBy("a.id_pegawai,b.nama",
							"pejabat_verifikator a inner join pegawai b on a.id_pegawai=b.id_pegawai","a.level = 'akhir'")->row();
		if($user_log->id_pegawai == $kabalai->id_pegawai){
			$view_btn_disposisi = 1;
		} else {
			$view_btn_disposisi = 0;
		}
	    $qw_sm =  $this->model_sitas->rowDataBy("*","surat_masuk","id_surat_masuk=$id_sm")->row();
		$qw_dispox = $this->model_sitas->rowDataBy("catatan_disposisi","disposisi_tk_bawah","id_surat_masuk=$id_sm");
        $cek_qw_dispox = $qw_dispox->num_rows();
		if($qw_dispox->num_rows() > 0){
			$catatan = $qw_dispox->row()->catatan_disposisi;
		} else {
			$catatan = "";
		}
		$peg_dispo = $this->model_sitas->listDataBy("b.no_hp","disposisi_tk_bawah a inner join pegawai b on a.id_pegawai_terima_disposisi=b.id_pegawai",
					"a.id_surat_masuk=$id_sm","a.id_disposisi_bawah asc");
		$arr_peg_dispo = array();
		foreach($peg_dispo as $peg_dis){
			array_push($arr_peg_dispo,$peg_dis->no_hp);
		}
		$data['sm'] = $qw_sm;
		$data['id_pegawai_log'] = $user_log->id_pegawai;
		$data['sub_disposisi'] = $this->model_sitas->listDataBy("a.sub_struktur,b.nama,b.no_hp",
									"sub_struktur_organisasi a inner join struktur_organisasi aa on a.id_struktur=aa.id_struktur
									inner join pegawai b on a.id_pegawai=b.id_pegawai",
									"aa.id_pegawai=$user_log->id_pegawai","a.id_sub_struktur asc");
		$data['arr_dispo'] = $arr_peg_dispo;
		$data['catatan'] = $catatan;
		$data['vw_btn_dispo'] = $view_btn_disposisi;
		$data['peg'] = $this->model_sitas->listData("*","pegawai","id_pegawai asc");
	    $this->template->load('sitas/template_form','sitas/sm_detail',$data);
	}
	function kirim_disposisi_kebawah(){
		date_default_timezone_set('Asia/Jakarta');
		$user = $this->model_sitas->get_user();
		$id_surat_masuk = _POST('id_surat_masuk');
		$diteruskan = $this->input->post('diteruskan');
		$catatan = _POST('catatan');
		$pengirim = $this->model_sitas->rowDataBy("struktur","struktur_organisasi","id_pegawai=$user->id_pegawai")->row();
		$links = base_url('primer?redir=sm_detail/').$id_surat_masuk;
		$pesan = "*Layanan LinTAS* Anda menerima disposisi surat dari $pengirim->struktur, silahkan klik link berikut $links\nCatatan : $catatan";
		$data_ins = array();
		//$peg = implode(",",$this->input->post('pegawai'));
		$peg = $this->input->post('pegawai');
		if(empty($diteruskan)){
			if(empty($peg)){
				$data['judul'] = "Gagal !!!";
				$data['pesan'] = "Anda belum memilih pegawai yang akan menerima disposisi";
				$data['back'] = site_url('primer/sm_detail/'.$id_surat_masuk);
				$this->template->load('sitas/template_form','sitas/pesan_galat',$data);
			} else {
				foreach($peg as $pegw){
					$pegxx = $this->model_sitas->rowDataBy("id_pegawai","pegawai","no_hp='$pegw'")->row();
					array_push($data_ins,array(
						'id_surat_masuk'=>$id_surat_masuk,
						'id_pegawai_kirim_disposisi'=>$user->id_pegawai,
						'id_pegawai_terima_disposisi'=>$pegxx->id_pegawai,
						'catatan_disposisi'=>$catatan
					));
					$no_wa2 = substr_replace("$pegw","62",0,1);
					$this->model_sitas->kirim_wa_gateway($no_wa2,$pesan);
				}
				$cek_surat_masuk = $this->model_sitas->rowDataBy("id_surat_masuk","disposisi_tk_bawah","id_surat_masuk=$id_surat_masuk")->num_rows();
				if($cek_surat_masuk > 0){
					$this->db->query("delete from disposisi_tk_bawah where id_surat_masuk=$id_surat_masuk");
					$this->db->insert_batch('disposisi_tk_bawah',$data_ins);
				} else {
					$this->db->insert_batch('disposisi_tk_bawah',$data_ins);
				}
				redirect('primer/buat_surat_masuk');
			}
		} else {
			if(empty($peg)){
				foreach($diteruskan as $rp){
					$pegx = $this->model_sitas->rowDataBy("id_pegawai","pegawai","no_hp='$rp'")->row();
					array_push($data_ins,array(
					  'id_surat_masuk'=>$id_surat_masuk,
					  'id_pegawai_kirim_disposisi'=>$user->id_pegawai,
					  'id_pegawai_terima_disposisi'=>$pegx->id_pegawai,
					  'catatan_disposisi'=>$catatan
					));
					$no_wa = substr_replace("$rp","62",0,1);
					$this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
				}
				$cek_surat_masuk = $this->model_sitas->rowDataBy("id_surat_masuk","disposisi_tk_bawah","id_surat_masuk=$id_surat_masuk")->num_rows();
				if($cek_surat_masuk > 0){
					$this->db->query("delete from disposisi_tk_bawah where id_surat_masuk=$id_surat_masuk");
					$this->db->insert_batch('disposisi_tk_bawah',$data_ins);
				} else {
					$this->db->insert_batch('disposisi_tk_bawah',$data_ins);
				}
				redirect('primer/buat_surat_masuk');  
			} else {
				  foreach($diteruskan as $rp){
					$pegx = $this->model_sitas->rowDataBy("id_pegawai","pegawai","no_hp='$rp'")->row();
					array_push($data_ins,array(
					  'id_surat_masuk'=>$id_surat_masuk,
					  'id_pegawai_kirim_disposisi'=>$user->id_pegawai,
					  'id_pegawai_terima_disposisi'=>$pegx->id_pegawai,
					  'catatan_disposisi'=>$catatan
					));
					$no_wa = substr_replace("$rp","62",0,1);
					$this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
				  }
				  foreach($peg as $pegw){
					  $pegxx = $this->model_sitas->rowDataBy("id_pegawai","pegawai","no_hp='$pegw'")->row();
					  array_push($data_ins,array(
						  'id_surat_masuk'=>$id_surat_masuk,
						  'id_pegawai_kirim_disposisi'=>$user->id_pegawai,
						  'id_pegawai_terima_disposisi'=>$pegxx->id_pegawai,
						  'catatan_disposisi'=>$catatan
					  ));
					  $no_wa2 = substr_replace("$pegw","62",0,1);
					  $this->model_sitas->kirim_wa_gateway($no_wa2,$pesan);
				  }
				  	$cek_surat_masuk = $this->model_sitas->rowDataBy("id_surat_masuk","disposisi_tk_bawah","id_surat_masuk=$id_surat_masuk")->num_rows();
					if($cek_surat_masuk > 0){
						$this->db->query("delete from disposisi_tk_bawah where id_surat_masuk=$id_surat_masuk");
						$this->db->insert_batch('disposisi_tk_bawah',$data_ins);
					} else {
						$this->db->insert_batch('disposisi_tk_bawah',$data_ins);
					}
					redirect('primer/buat_surat_masuk');
			}
		}
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
	public function save_folder(){
	    $folder = strip_tags($_POST['folder']);
	    $uris = strip_tags($_POST['uris']);
	    $url = strip_tags($_POST['url']);
	    $url_folder = strtolower($folder);
	    $url_folder_fix = str_replace(" ","-",$url_folder);
	    $url_arr = array($url,$url_folder_fix);
	    $fix = implode('_',$url_arr);
	    $data = array(
	                    'folder'=>$folder,
	                    'url'=>$fix,
	                    'tgl_buat'=>date('Y-m-d'),
	                    'root'=>strip_tags($_POST['root'])
	            );
	   $this->db->insert('folder',$data);
	   redirect($uris);
	}
	
	public function save_file(){
	    if ($_SERVER["REQUEST_METHOD"] == "POST") {
	        date_default_timezone_set('Asia/Jakarta');
	        $uris = strip_tags($_POST['uris']);
	        $nama_file = strip_tags($_POST['nama_file']);
	        $link_file = strip_tags($_POST['link_file']);
	        $id_surat_keluar = strip_tags($_POST['id_surat_keluar']);
	        $root = strip_tags($_POST['root']);
	        $tahun = strip_tags($_POST['tahun']);
	        $nama_filenya = md5(date('Y-m-d H:i:s'));
	        $newFileName = "";
	        $file_extension = "";
	        if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
	            $targetDir = "asset/folder_drive/";
                $targetFile = $targetDir . basename($_FILES["file"]["name"]);
                $file_extension = pathinfo($targetFile, PATHINFO_EXTENSION);
                $newFileName = $nama_filenya .".". $file_extension;
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                    rename($targetFile, $targetDir . $newFileName);
                } else {
                    echo "Maaf, terjadi kesalahan saat mengunggah file Anda";
                }
	        } else {
                echo "Terjadi kesalahan saat upload file";
            }
            $data = array(
                            'id_folder'=>$root,
                            'id_surat_keluar'=>$id_surat_keluar,
                            'nama_file'=>$nama_file,
                            'link_file'=>$link_file,
                            'filex'=>$newFileName,
                            'tipe_file'=>$file_extension,
                            'tgl_upload'=>date('Y-m-d H:i:s'),
                            'tahun'=>$tahun,
                            'username'=>$this->session->username
                        );
            $this->db->insert('file',$data);
            //redirect($uris);
	    }
	}
	
	public function hapus_file(){
	    $uri3 = "primer/drive/".$this->uri->segment(3);
	    $uri4 = $this->uri->segment(4);
	    $qw_file = $this->db->query("select filex,tipe_file from file where id_file = $uri4")->row();
	    if($qw_file->filex == ""){
	        $this->db->query("delete from file where id_file = $uri4");
	    } else {
	        unlink("./asset/folder_drive/$qw_file->filex");
	        $this->db->query("delete from file where id_file = $uri4");
	    }
	    redirect($uri3);
	}
	function hapus_folder(){
	    $uri3 = "primer/drive/".$this->uri->segment(3);
	    $uri4 = $this->uri->segment(4);
	    $this->db->query("delete from folder where id_folder = $uri4");
	    redirect($uri3);
	}
	function lap_spt(){
	    $id_spt = $this->uri->segment(3);
	    if(!empty($id_spt)){
			$spt_id = $this->model_sitas->rowDataBy("a.*,b.no_surat_keluar",
										"spt a inner join surat_keluar b on a.id_surat_keluar=b.id_surat_keluar",
										"a.id_spt = $id_spt")->row();
		} else {
			$spt_id = $this->model_sitas->rowDataBy("a.*,b.no_surat_keluar",
										"spt a inner join surat_keluar b on a.id_surat_keluar=b.id_surat_keluar",
										"a.id_spt = $_GET[edit]")->row();
		}
		$pc_tgl = explode("-",$spt_id->tanggal_input);
	    
		$data['id_lap_spt'] = "";
		$data['bln'] = $pc_tgl[1];
		$data['thn'] = $pc_tgl[0];
	    $data['id_spt'] = "";
	    $data['transportasi'] = $spt_id->kendaraan;
	    $data['tolak_ukur_kegiatan'] = "";
	    $data['lokasi'] = $spt_id->ket_wilayah;
	    $data['uraian'] = "";
	    $data['gbr_dok'] = "";
	    $data['status'] = "save";
	    $data['nama_file'] = "";
	    $data['spt'] = $spt_id;
	    $data['harus'] = 'required';
	    
	    if(isset($_GET['edit'])){
	        $id_spt = $_GET['edit'];
	        $spt_id = $this->model_sitas->rowDataBy("*","lap_spt","id_spt=$id_spt")->row();
			$pc_tgl = explode("-",$spt_id->tanggal_input);
	        $data['bln'] = $pc_tgl[1];
			$data['thn'] = $pc_tgl[0];
			$data['id_lap_spt'] = $spt_id->id_lap_spt;
    	    $data['id_spt'] = "";
    	    $data['transportasi'] = $spt_id->transportasi;
    	    $data['tolak_ukur_kegiatan'] = $spt_id->tolak_ukur_kegiatan;
    	    $data['lokasi'] = $spt_id->lokasi;
    	    $data['uraian'] = $spt_id->uraian;
    	    $data['gbr_dok'] = "";
    	    $data['status'] = "edit";
    	    $data['nama_file'] = $spt_id->gbr_dok;
    	    $data['spt'] = $this->model_sitas->rowDataBy("a.*,b.no_surat_keluar",
								"spt a inner join surat_keluar b on a.id_surat_keluar=b.id_surat_keluar",
								"a.id_spt = $id_spt")->row();
    	    $data['harus'] = '';
	    }
	    //$data['arr'] = $this->model_polling->list_kegiatan_a()->result();
	    $this->template->load('sitas/template_form','sitas/buat_lap_spt',$data);
	}
	
	function save_lap_spt(){
		cek_session_admin1();
		date_default_timezone_set('Asia/Jakarta');
	    $status = $this->input->post('status');
		$id_lap_spt = _POST('id_lap_spt');
	    if($status=="save"){
	        //$tolak_ukur_kegiatan = $this->db->escape_str($this->input->post('tolak_ukur_kegiatan'));
        	$transportasi = $this->db->escape_str($this->input->post('transportasi'));
        	$datadb = array(//'tolak_ukur_kegiatan'=>$tolak_ukur_kegiatan,
                        'transportasi'=>$transportasi,
                        'lokasi'=>$this->db->escape_str($this->input->post('lokasi')),
                        'uraian'=>$this->input->post('uraian'),
                        'id_spt'=>$this->db->escape_str($this->input->post('id_spt')),
                        'user'=>$this->session->username,
                        'tanggal_input'=>date('Y-m-d H:i:s')
			);
			$this->model_sitas->saveDataWithFotoBanyak("lap_spt",$datadb,"asset/lap_spt/");    
	    } else {
			$transportasi = $this->db->escape_str($this->input->post('transportasi'));
        	$datadb = array(//'tolak_ukur_kegiatan'=>$tolak_ukur_kegiatan,
                        'transportasi'=>$transportasi,
                        'lokasi'=>$this->db->escape_str($this->input->post('lokasi')),
                        'uraian'=>$this->input->post('uraian'),
                        'id_spt'=>$this->db->escape_str($this->input->post('id_spt')),
                        'user'=>$this->session->username,
                        'tanggal_input'=>date('Y-m-d H:i:s')
			);
	        $this->model_sitas->updateDataWithFotoBanyak("lap_spt","id_lap_spt",$id_lap_spt,$datadb,"asset/lap_spt/");
	    }
		redirect('primer/buat_lap_spt');
	}
	function lihat_perjadin(){
	    cek_session_admin1();
	    if(isset($_POST['id_spt'])){
		    $id_spt = $_POST['id_spt'];
		    $model_lap = $this->model_sitas->rowDataBy("*","lap_spt","id_spt = $id_spt")->row();
			$model_spt = $this->model_sitas->rowDataBy("*","spt","id_spt = $id_spt")->row();
	        $user = $model_lap->user;
		    $data['spt'] = $model_spt;
		    $data['peg'] = $this->model_sitas->listDataBy("a.tanggal_spt,b.nama","anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai",
							"a.id_spt = $id_spt","a.id_anggota asc");
		    $data['no_surat'] = $this->model_sitas->rowDataBy("a.no_surat_keluar,a.id_verif",
									"surat_keluar a inner join spt b on a.id_surat_keluar=b.id_surat_keluar",
									"a.id_surat_keluar = $model_spt->id_surat_keluar")->row();
		    $data['lap_spt'] = $model_lap;
		    $data['user'] = $this->model_sitas->rowDataBy("a.nama,a.nip","pegawai a inner join user b on a.id_pegawai=b.id_pegawai",
								"b.username='$user'")->row();
			$this->load->view('sitas/lihat_perjadin',$data);
		}
	}
	function delete_lap_spt(){
		cek_session_admin1();
		$uri3 = $this->uri->segment(3);
		$row = $this->model_sitas->rowDataBy("gbr_dok","lap_spt","id_spt=$uri3")->row();
		$this->model_sitas->hapus_data("lap_spt","id_spt=$uri3");
		$this->model_sitas->hapus_foto_banyak("./asset/lap_spt/",$row->gbr_dok);
		redirect('primer/buat_lap_spt');
	}
	function kirim_ajuan_lap_spt(){
		$uri3 = $this->uri->segment(3);
		$get_kabalai = $this->model_sitas->get_verifikator_akhir();
		$no_hp = $get_kabalai->no_hp;
        $no_wa = substr_replace("$no_hp","62",0,1);
		$links = base_url()."primer?redir=verif_lap_spt_detail/".$uri3;
        $pesan = "*Layanan LinTAS* Mohon untuk mengecek Laporan Perjalanan Dinas, silahkan klik link $links";
		$data = ['is_publish' => 1];
		$this->model_sitas->update_data("lap_spt","id_spt",$uri3,$data);
		$this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
		redirect('primer/buat_lap_spt');
	}
	function verif_lap_spt(){
		cek_session_admin1();
		$username = $this->session->username;
		//$tahun = $this->session->tahun;
		$get_verif_akhir = $this->model_sitas->get_verifikator_akhir();
		if($username == $get_verif_akhir->username){
			$data['rec'] = $this->model_sitas->listDataBy("b.*,c.no_surat_keluar",
							"lap_spt a inner join spt b on a.id_spt=b.id_spt inner join surat_keluar c on b.id_surat_keluar=c.id_surat_keluar",
							"verif_kabalai = 0 and is_publish = 1","a.id_lap_spt asc");
			$this->template->load('sitas/verif_surat/template_form','sitas/verif_surat/daftar_lap_spt',$data);    
		} else {
			$this->load->view('sitas/verif_surat/no_akses');
		}
	}
	function verif_lap_spt_detail(){
		cek_session_admin1();
		$id_spt = $this->uri->segment(3);
		$username = $this->session->username;
		$get_verif_akhir = $this->model_sitas->get_verifikator_akhir();
		if($username == $get_verif_akhir->username){
			$model_lap = $this->model_sitas->rowDataBy("*","lap_spt","id_spt = $id_spt")->row();
			$model_spt = $this->model_sitas->rowDataBy("*","spt","id_spt = $id_spt")->row();
	        $user = $model_lap->user;
			$data['kabalai'] = $get_verif_akhir;
		    $data['spt'] = $model_spt;
		    $data['peg'] = $this->model_sitas->listDataBy("a.tanggal_spt,b.nama","anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai",
							"a.id_spt = $id_spt","a.id_anggota asc");
		    $data['no_surat'] = $this->model_sitas->rowDataBy("a.no_surat_keluar,a.id_verif",
									"surat_keluar a inner join spt b on a.id_surat_keluar=b.id_surat_keluar",
									"a.id_surat_keluar = $model_spt->id_surat_keluar")->row();
		    $data['lap_spt'] = $model_lap;
			$data['user'] = $this->model_sitas->rowDataBy("a.nama,a.nip","pegawai a inner join user b on a.id_pegawai=b.id_pegawai",
								"b.username='$user'")->row();
			$this->template->load('sitas/verif_surat/template_form','sitas/verif_surat/verif_lap_spt',$data);
		} else {
			$this->load->view('sitas/verif_surat/no_akses');
		}
	}
	function setuju_lap_spt(){
	    cek_session_admin1();
	    $id_spt = $_POST['id_spt'];
		$ket = $_POST['keterangan'];
		$user = $this->model_sitas->get_user();
	    $this->db->query("update lap_spt set keterangan = '$ket', verif_kabalai = 1, pj_ttd = $user->id_pegawai where id_spt = $id_spt");
	    redirect('primer/verif_lap_spt');
	}
	function tolak_lap_spt(){
	    cek_session_admin1();
	    $id_spt = $_POST['id_spt'];
	    $ket = $_POST['keterangan'];
		$user = $this->model_sitas->get_user();
	    $this->db->query("update lap_spt set keterangan = '$ket', pj_ttd = $user->id_pegawai where id_spt = $id_spt");
	    redirect('primer/verif_lap_spt');
	}
	function input_cuti_sebelum(){
		cek_session_admin1();
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$tahun = $this->session->tahun;
		$cuti_cek = $this->model_sitas->rowDataBy("*","trs_cuti","id_cuti=$uri3")->num_rows();
		if($cuti_cek > 0){
			$cuti = $this->model_sitas->rowDataBy("*","trs_cuti","id_cuti=$uri3")->row();
			$user_pemohon = $this->model_sitas->get_user_by($cuti->username);
			$cek_cuti_lalu = $this->model_sitas->rowDataBy("id_pegawai","cuti_sebelum","id_pegawai=$user_pemohon->id_pegawai")->num_rows();
			$tahun_ini = $tahun;
			$tahun_lalu = $tahun - 1;
			$dua_tahun_lalu = $tahun - 2;
			if($cek_cuti_lalu > 0){
				$cuti_ini = $this->model_sitas->rowDataBy("jumlah","cuti_sebelum","id_pegawai=$user_pemohon->id_pegawai and tahun='$tahun_ini'")->row();
				$cuti_lalu = $this->model_sitas->rowDataBy("jumlah","cuti_sebelum","id_pegawai=$user_pemohon->id_pegawai and tahun='$tahun_lalu'")->row();
				$cuti_lalu_sekali = $this->model_sitas->rowDataBy("jumlah","cuti_sebelum","id_pegawai=$user_pemohon->id_pegawai and tahun='$dua_tahun_lalu'")->row();
				$jumlah_cuti_ini = $cuti_ini->jumlah;
				$jumlah_cuti_lalu = $cuti_lalu->jumlah;
				$jumlah_cuti_lalu_sekali = $cuti_lalu_sekali->jumlah;
			} else {
				$jumlah_cuti_ini = 0;
				$jumlah_cuti_lalu = 0;
				$jumlah_cuti_lalu_sekali = 0;
			}
			$data['nama'] = $user_pemohon->nama;
			$data['alasan'] = $cuti->alasan_cuti;
			$data['tanggal'] = $cuti->tgl_mulai;
			$data['lama'] = $cuti->lama_cuti;
			$data['pejabat_atasan_langsung'] = $cuti->pejabat_atasan_langsung;
			$data['sisa'] = $jumlah_cuti_ini + $jumlah_cuti_lalu + $jumlah_cuti_lalu_sekali - $cuti->lama_cuti;
			$data['jumlah_cuti_ini'] = $jumlah_cuti_ini;
			$data['jumlah_cuti_lalu'] = $jumlah_cuti_lalu;
			$data['jumlah_cuti_lalu_sekali'] = $jumlah_cuti_lalu_sekali;
			$data['id_pegawai'] = $user_pemohon->id_pegawai;
			$data['uri3'] = $uri3;
			$data['uri4'] = $uri4;
			$data['thn_lalu_sekali'] = $dua_tahun_lalu;
			$data['thn_lalu'] = $tahun_lalu;
			$data['thn_ini'] = $tahun_ini;
			$this->template->load('sitas/template_form','sitas/input_sebelum_cuti',$data);
		} else {
			$this->load->view('sitas/verif_surat/not_found');
		}
	}
	function proses_cuti_sebelum(){
		$id_pegawai = _POST('id_pegawai');
		$pejabat_atasan_langsung = _POST('pejabat_atasan_langsung');
		$uri3 = _POST('uri3');
		$uri4 = _POST('uri4');
		$jumlah = $_POST['jumlah'];
		$tahun = $_POST['thnx'];
		if(get_kode_uniks($uri3) == $uri4){
			$pejabat_atasan = $this->model_sitas->rowDataBy("no_hp","pegawai","id_pegawai=$pejabat_atasan_langsung")->row();
			$cek_cuti_lalu = $this->model_sitas->rowDataBy("id_pegawai","cuti_sebelum","id_pegawai=$id_pegawai")->num_rows();
			$no_wa = substr_replace($pejabat_atasan->no_hp,62,0,1);
			$links = base_url('primer?redir=verif_cuti2/'.$uri3.'/'.$uri4);
            $pesan = "*Layanan LinTAS* Ada Cuti Pegawai yang akan diverifikasi, silahkan klik link berikut $links";
			if($cek_cuti_lalu > 0){
				for($yy = 0; $yy < $cek_cuti_lalu; $yy++){
					$this->db->query("update cuti_sebelum set jumlah = $jumlah[$yy] where id_pegawai = $id_pegawai and tahun = $tahun[$yy]");
				}
				redirect('primer/input_cuti_sebelum/'.$uri3.'/'.$uri4);
			} else {
				$data = array();
				$indx = 0;
				foreach($jumlah as $jmlx){
					array_push($data,array('id_pegawai'=>$id_pegawai,'jumlah'=>$jmlx,'tahun'=>$tahun[$indx]));
					$indx++;
				}
				$this->model_sitas->saveDataBanyak('cuti_sebelum',$data);
				$this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
				redirect('primer/input_cuti_sebelum/'.$uri3.'/'.$uri4);
			}
		} else {
			echo "Sori Yeee wkwkwk";
		}
	}
	function verif_cuti2(){
        cek_session_admin1();
        $uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        $rowx = $this->db->query("select a.*, c.nama, d.jenis_cuti from trs_cuti a 
                    inner join user b on a.username=b.username 
                    inner join pegawai c on b.id_pegawai=c.id_pegawai
                    inner join jenis_cuti d on a.id_jenis_cuti=d.id_jenis_cuti
                    where a.id_cuti = $uri3")->row();
        $get_peg = $this->model_sitas->get_user_by($rowx->username);
        $tahun_ini = $rowx->tahun;
        $tahun_lalu = $tahun_ini - 1;
        $tahun_lalux = $tahun_ini - 2;
        $cuti_thn_ini = $this->model_sitas->rowDataBy("id_pegawai,jumlah","cuti_sebelum","id_pegawai=$get_peg->id_pegawai and tahun='$tahun_ini'");
        $cek_cuti_thn_ini = $cuti_thn_ini->num_rows();
        $jml_thn_ini = $this->model_sitas->rowDataBy("sum(lama_cuti) as jml","trs_cuti","username = '$rowx->username' and tahun = $tahun_ini")->row();
        $jml_thn_lalu = $this->model_sitas->rowDataBy("sum(lama_cuti) as jml","trs_cuti","username = '$rowx->username' and tahun = $tahun_lalu")->row();
        $jml_thn_lalux = $this->model_sitas->rowDataBy("sum(lama_cuti) as jml","trs_cuti","username = '$rowx->username' and tahun = $tahun_lalux")->row();
        if($cek_cuti_thn_ini > 0){
          $row_cuti_ini = $cuti_thn_ini->row();
          $data['n'] = $row_cuti_ini->jumlah - $jml_thn_ini->jml;
        } else {
          $data['n'] = 12 - $jml_thn_ini->jml;
        }
          if($jml_thn_lalu->jml==null){
            $cuti_lalu = $this->model_sitas->rowDataBy("id_pegawai,jumlah","cuti_sebelum","id_pegawai=$get_peg->id_pegawai and tahun='$tahun_lalu'");
            $cek_cuti_lalu = $cuti_lalu->num_rows();
            if($cek_cuti_lalu > 0){
              $row_cuti_lalu = $cuti_lalu->row();
              $data['n_1'] = $row_cuti_lalu->jumlah;
            } else {
              $data['n_1'] = 0;
            }
          } else {
            $data['n_1'] = $jml_thn_lalu->jml;
          }
          if($jml_thn_lalux->jml==null){
            $cuti_lalux = $this->model_sitas->rowDataBy("id_pegawai,jumlah","cuti_sebelum","id_pegawai=$get_peg->id_pegawai and tahun='$tahun_lalux'");
            $cek_cuti_lalux = $cuti_lalux->num_rows();
            if($cek_cuti_lalux > 0){
              $row_cuti_lalux = $cuti_lalux->row();
              $data['n_2'] = $row_cuti_lalux->jumlah;
            } else {
              $data['n_2'] = 0;
            }
          } else {
            $data['n_2'] = $jml_thn_lalux->jml;
          }
        $data['uri3'] = $uri3;
        $data['uri4'] = $uri4;
        $data['rec'] = $rowx;
        $data['tahun_ini'] = $tahun_ini;
        $data['tahun_lalu'] = $tahun_lalu;
        $data['tahun_lalux'] = $tahun_lalux;
        $data['verif_cuti'] = $this->model_sitas->listData("*","verif_cuti","id_verif_atasan asc");
        $data['id_pegawai'] = $get_peg->id_pegawai;
		$this->template->load('sitas/template_form','sitas/verif_surat/verif_cuti2',$data);
    }
	function verif_cuti(){
        cek_session_admin1();
        $uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        $rowx = $this->db->query("select a.*, c.nama, d.jenis_cuti from trs_cuti a 
                    inner join user b on a.username=b.username 
                    inner join pegawai c on b.id_pegawai=c.id_pegawai
                    inner join jenis_cuti d on a.id_jenis_cuti=d.id_jenis_cuti
                    where a.id_cuti = $uri3")->row();
        $get_peg = $this->model_sitas->get_verifikator_akhir();
        $get_pemohon = $this->model_sitas->get_user_by($rowx->username);
        $tahun_ini = $rowx->tahun;
        $tahun_lalu = $tahun_ini - 1;
        $tahun_lalux = $tahun_ini - 2;
        $cuti_thn_ini = $this->model_sitas->rowDataBy("id_pegawai,jumlah","cuti_sebelum","id_pegawai=$get_pemohon->id_pegawai and tahun='$tahun_ini'");
        $cek_cuti_thn_ini = $cuti_thn_ini->num_rows();
        $jml_thn_ini = $this->model_sitas->rowDataBy("sum(lama_cuti) as jml","trs_cuti","username = '$rowx->username' and tahun = $tahun_ini")->row();
        $jml_thn_lalu = $this->model_sitas->rowDataBy("sum(lama_cuti) as jml","trs_cuti","username = '$rowx->username' and tahun = $tahun_lalu")->row();
        $jml_thn_lalux = $this->model_sitas->rowDataBy("sum(lama_cuti) as jml","trs_cuti","username = '$rowx->username' and tahun = $tahun_lalux")->row();
        if($cek_cuti_thn_ini > 0){
          $row_cuti_ini = $cuti_thn_ini->row();
          $data['n'] = $row_cuti_ini->jumlah - $jml_thn_ini->jml;
        } else {
          $data['n'] = 12 - $jml_thn_ini->jml;
        }
          if($jml_thn_lalu->jml==null){
            $cuti_lalu = $this->model_sitas->rowDataBy("id_pegawai,jumlah","cuti_sebelum","id_pegawai=$get_pemohon->id_pegawai and tahun='$tahun_lalu'");
            $cek_cuti_lalu = $cuti_lalu->num_rows();
            if($cek_cuti_lalu > 0){
              $row_cuti_lalu = $cuti_lalu->row();
              $data['n_1'] = $row_cuti_lalu->jumlah;
            } else {
              $data['n_1'] = 0;
            }
          } else {
            $data['n_1'] = $jml_thn_lalu->jml;
          }
          if($jml_thn_lalux->jml==null){
            $cuti_lalux = $this->model_sitas->rowDataBy("id_pegawai,jumlah","cuti_sebelum","id_pegawai=$get_pemohon->id_pegawai and tahun='$tahun_lalux'");
            $cek_cuti_lalux = $cuti_lalux->num_rows();
            if($cek_cuti_lalux > 0){
              $row_cuti_lalux = $cuti_lalux->row();
              $data['n_2'] = $row_cuti_lalux->jumlah;
            } else {
              $data['n_2'] = 0;
            }
          } else {
            $data['n_2'] = $jml_thn_lalux->jml;
          }
        $data['uri3'] = $uri3;
        $data['uri4'] = $uri4;
        $data['rec'] = $rowx;
        $data['tahun_ini'] = $tahun_ini;
        $data['tahun_lalu'] = $tahun_lalu;
        $data['tahun_lalux'] = $tahun_lalux;
        $data['verif_cuti'] = $this->model_sitas->listData("*","verif_cuti","id_verif_atasan asc");
        $data['pejabat_atasan'] = $get_peg->id_pegawai;
        $data['no_pemohon'] = $get_pemohon->no_hp;
		$this->template->load('sitas/verif_surat/template_form','sitas/verif_surat/verif_cuti',$data);
    }
	function lap_gratifikasi(){
		$user = $this->model_sitas->get_user();
		$data['list_data'] = $this->model_sitas->listDataBy("*","lapor_gratifikasi","id_pegawai=$user->id_pegawai",
							"id_lap_gratifikasi desc");
		$data['jenis_gratifikasi'] = "";
		$data['jenis_gratifikasi_val'] = "--Pilih Jenis Gratifikasi--";
		$data['nilai'] = "";
		$data['tgl_terima'] = date('Y-m-d');
		$data['lokasi_terima'] = "";
		$data['pemberi'] = "";
		$data['hub_pemberi'] = "";
		$data['status'] = "add";
		$data['id_pegawai'] = $user->id_pegawai;
		$data['id_lap_gratifikasi'] = 0;
		$data['list_surat'] = $this->model_sitas->listDataBy("a.id_surat_keluar,a.perihal",
								"surat_keluar a inner join spt b on a.id_surat_keluar=b.id_surat_keluar
								 inner join anggota_spt c on b.id_spt=c.id_spt",
								"c.id_pegawai=$user->id_pegawai","a.id_surat_keluar desc");
		$this->template->load('sitas/template_form','sitas/lap_gratifikasi',$data);
	}
    function logout(){
		$this->session->sess_destroy();
		redirect('primer');
	}
}