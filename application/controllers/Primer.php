<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Primer extends CI_Controller {
    function index(){
		if (isset($_POST['submit'])){
			$username = strip_tags($this->input->post('a'));
			$password = md5($this->input->post('b'));
            $tahun = strip_tags($this->input->post('c'));
			$cek = $this->model_sitas->cek_login_sijuara($username,$password);
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata('upload_image_file_manager',true);
				$this->session->set_userdata(array('username'=>$row['username'],'tahun'=>$tahun));
				redirect('primer/home');
			}else{
				$data['title'] = 'BSIP TAS &rsaquo; Log In';
				$this->load->view('sitas/view_login',$data);
			}
		}else{
			if ($this->session->username != ''){
				redirect('primer/home');
			}else{
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
		$data['thn'] = $this->session->thn_agr;
		$data['jml_v1'] = 0;//$this->model_more->daftar_spt_kabalai()->num_rows();
		$data['jml_v2'] = 0;//$this->model_more->daftar_surat_kabalai()->num_rows();
		$data['jml_v3'] = 0;//$this->model_more->daftar_surat_masuk_kabalai()->num_rows();
		$data['jml_v4'] = 0;//$this->model_more->daftar_lap_spt_kabalai()->num_rows();
		$data['jml_surat_masuk'] = 0;//$this->model_more->daftar_surat_masuk()->num_rows();
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
		$this->template->load('sijuara/templatex','sijuara/view_homex_cltr',$data);
	}

	function buat_surat_masuk(){
		cek_session_admin1();
		$thn = $this->session->tahun;
		$id_pjs = $this->model_sitas->rowDataBy("*","pejabat_verifikator","level = 'akhir'")->row();
        $data['no_surat_masuk'] = "";
        $data['asal_surat'] = "";
        $data['tanggal_masuk'] = date('Y-m-d');
        $data['tanggal'] = date('Y-m-d');
        $data['perihal'] = "";
        $data['id_surat_masuk'] = "";
        $data['status'] = "save";
        $data['read'] = "";
        $data['file_pdf'] = "";
        $data['nama_file'] = "";
		$data['uri3'] = $this->uri->segment(3);
        
        if(isset($_GET['id_sm'])){
            $id_sm = $_GET['id_sm'];
			$qw = $this->model_sitas->rowDataBy("*","surat_masuk","id_surat_masuk = $id_sm")->row();
            $data['no_surat_masuk'] = $qw->no_surat_masuk;
            $data['asal_surat'] = $qw->asal_surat;
            $data['tanggal_masuk'] = $qw->tanggal_masuk;
            $data['tanggal'] = $qw->tanggal;
            $data['perihal'] = $qw->perihal;
            $data['id_surat_masuk'] = $qw->id_surat_masuk;
            $data['status'] = "edit";
            $data['read'] = "";
            if(!empty($qw->file_pdf)){
                $data['file_pdf'] = "<a class='btn btn-warning btn-xs' title='PDF' target='_blank' href='".base_url()."asset/file_lainnya/surat_masuk/".$qw->file_pdf."'><i class='fas fa-file-pdf'></i> Lihat PDF</a>";
            } else {
                $data['file_pdf'] = "";
            }
            
            $data['nama_file'] = $qw->file_pdf;
        }
        
        if(isset($_GET['copy'])){
            $id_skm = $_GET['copy'];
			$qw = $this->model_sitas->rowDataBy("*","surat_masuk","id_surat_masuk = $id_skm")->row();
            $data['no_surat_masuk'] = $qw->no_surat_masuk;
            $data['asal_surat'] = $qw->asal_surat;
            $data['tanggal_masuk'] = date('Y-m-d');
            $data['tanggal'] = date('Y-m-d');
            $data['perihal'] = $qw->perihal;
            $data['id_surat_masuk'] = $qw->id_surat_masuk;
            $data['status'] = "save";
            $data['read'] = "";
            $data['file_pdf'] = "";
            $data['nama_file'] = "";
        }
		/*
		select a.nip,a.nama,a.no_hp,a.ttd,c.username,b.for_ttd,b.jabatan from t_biodata a 
                                    inner join sijuara_pejabat b on a.id_bio=b.id_bio
                                    inner join sijuara_pj bb on b.id_bio=bb.id_bio
                                    inner join sijuara_user c on bb.id_pj=c.id_pj
                                    inner join sijuara_level d on c.id_user=d.id_user
                                    where b.id_pejabat = '$x'
		*/
		$data['kabalai'] = $this->model_sitas->rowDataBy("nip,nama,no_hp","pegawai","id_pegawai = $id_pjs->id_pegawai")->row();
		$data['rec'] = $this->model_sitas->rowDataBy("*","surat_masuk","tanggal like '%$thn%' order by id_surat_masuk desc")->row();
        $this->template->load('sitas/template_form','sitas/buat_surat_masuk',$data);
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
        $data['id_surat_keluar'] = "";
        $data['status'] = "save";
        $data['read'] = "";
        $data['arsip'] = "";
        $data['arsip_val'] = "--";
        //$data['nsx'] = $no_surat;
        
        if(isset($_GET['id_sk'])){
            $id_sk = $_GET['id_sk'];
            $qw = $this->db->query("select * from surat_keluar where id_surat_keluar = '$id_sk'")->row();
            if(!empty($qw->no_lengkap)){
                $pc_lengkap = explode("/",$qw->no_lengkap);
                $no_arsip = $pc_lengkap[1];
				$qw_sa = $this->model_sitas->rowDataBy("a.kode_sub_arsip,a.sub_arsip,b.arsip",
									"klasifikasi_sub_arsip a 
									inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip",
									"a.kode_sub_arsip = '$no_arsip'")->row();
                $get_sa = $qw_sa->kode_sub_arsip." - ".$qw_sa->arsip." - ".$qw_sa->sub_arsip;
            } else {
                $no_arsip = "";
                $get_sa = "--";
            }
            $data['no_surat'] = $qw->no_surat_keluar;
            $data['tujuan_surat'] = $qw->tujuan_surat;
            $data['tanggal'] = $qw->tanggal;
            $data['perihal'] = $qw->perihal;
            $data['id_surat_keluar'] = $qw->id_surat_keluar;
            $data['status'] = "edit";
            $data['read'] = "readonly";
            $data['arsip'] = $no_arsip;
            $data['arsip_val'] = $get_sa;
        }
        
        if(isset($_GET['copy'])){
            $id_skc = $_GET['copy'];
            $qw = $this->db->query("select * from surat_keluar where id_surat_keluar = '$id_skc'")->row();
             if(!empty($qw->no_lengkap)){
                $pc_lengkap = explode("/",$qw->no_lengkap);
                $no_arsip = $pc_lengkap[1];
                $qw_sa = $this->model_sitas->rowDataBy("a.kode_sub_arsip,a.sub_arsip,b.arsip",
									"klasifikasi_sub_arsip a 
									inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip",
									"a.kode_sub_arsip = '$no_arsip'")->row();
                $get_sa = $qw_sa->kode_sub_arsip." - ".$qw_sa->arsip." - ".$qw_sa->sub_arsip;
            } else {
                $no_arsip = "";
                $get_sa = "--";
            }
            $data['no_surat'] = $qw->no_surat_keluar;
            $data['tujuan_surat'] = "";
            $data['tanggal'] = $qw->tanggal;
            $data['perihal'] = $qw->perihal;
            $data['id_surat_keluar'] = "";
            $data['status'] = "save";
            $data['read'] = "";
            $data['arsip'] = $no_arsip;
            $data['arsip_val'] = $get_sa;
        }
        
        if(isset($_GET['spt'])){
            $id_spt = $_GET['spt'];
            $qw = $this->db->query("select * from surat_keluar where id_spt = '$id_spt'")->row();
            if(!empty($qw->no_lengkap)){
                $pc_lengkap = explode("/",$qw->no_lengkap);
                $no_arsip = $pc_lengkap[1];
                $qw_sa = $this->model_sitas->rowDataBy("a.kode_sub_arsip,a.sub_arsip,b.arsip",
									"klasifikasi_sub_arsip a 
									inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip",
									"a.kode_sub_arsip = '$no_arsip'")->row();
                $get_sa = $qw_sa->kode_sub_arsip." - ".$qw_sa->arsip." - ".$qw_sa->sub_arsip;
            } else {
                $no_arsip = "";
                $get_sa = "--";
            }
            $data['no_surat'] = $no_suratx;
            $data['tujuan_surat'] = $qw->tujuan_surat;
            $data['tanggal'] = $qw->tanggal;
            $data['perihal'] = $qw->perihal;
            $data['id_surat_keluar'] = $qw->id_surat_keluar;
            $data['status'] = "edit";
            $data['read'] = "";
            $data['arsip'] = $no_arsip;
            $data['arsip_val'] = $get_sa;
        }
        
        if(isset($_GET['srt'])){
            $id_srt = $_GET['srt'];
            $qw = $this->db->query("select * from surat_keluar where id_buat_surat = '$id_srt'")->row();
            if(!empty($qw->no_lengkap)){
                $pc_lengkap = explode("/",$qw->no_lengkap);
                $no_arsip = $pc_lengkap[1];
                $qw_sa = $this->model_sitas->rowDataBy("a.kode_sub_arsip,a.sub_arsip,b.arsip",
									"klasifikasi_sub_arsip a 
									inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip",
									"a.kode_sub_arsip = '$no_arsip'")->row();
                $get_sa = $qw_sa->kode_sub_arsip." - ".$qw_sa->arsip." - ".$qw_sa->sub_arsip;
            } else {
                $no_arsip = "";
                $get_sa = "--";
            }
            $data['no_surat'] = $no_suratx;
            $data['tujuan_surat'] = $qw->tujuan_surat;
            $data['tanggal'] = $qw->tanggal;
            $data['perihal'] = $qw->perihal;
            $data['id_surat_keluar'] = $qw->id_surat_keluar;
            $data['status'] = "edit";
            $data['read'] = "";
            $data['arsip'] = $no_arsip;
            $data['arsip_val'] = $get_sa;
        }
        $data['rec'] = $this->model_sitas->listDataBy("*","surat_keluar","tanggal like '%$thn%'","id_surat_keluar desc"); 
		$data['ars'] = $this->model_sitas->listData("a.id_sub_arsip,a.kode_sub_arsip,a.sub_arsip,b.arsip",
								"klasifikasi_sub_arsip a
								inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip","a.id_sub_arsip asc");
		$this->template->load('sitas/template_form','sitas/buat',$data); 
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
    function logout(){
		$this->session->sess_destroy();
		redirect('primer');
	}
}