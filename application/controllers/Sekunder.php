<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sekunder extends CI_Controller {
    public function list_verif_cuti2(){
        cek_session_admin1();
        $username = $this->session->username;
        $tahun = $this->session->tahun;
        $get_pegawai = $this->model_sitas->get_user_by($username);
        $cek_list_cuti = $this->model_sitas->rowDataBy("*","trs_cuti","pejabat_atasan_langsung = $get_pegawai->id_pegawai")->num_rows();
        if($cek_list_cuti > 0){
                $data['rec'] = $this->db->query("select a.*, c.nama, d.jenis_cuti from trs_cuti a 
                                inner join user b on a.username=b.username 
                                inner join pegawai c on b.id_pegawai=c.id_pegawai
                                inner join jenis_cuti d on a.id_jenis_cuti=d.id_jenis_cuti
                                where pejabat_atasan_langsung = $get_pegawai->id_pegawai and verif_atasan_langsung = 0 order by a.id_cuti asc")->result();
          $this->template->load('sitas/template_form','sitas/verif_surat/daftar_cuti2',$data);
        } else {
          $this->load->view('sitas/verif_surat/no_akses');
        }
    }
    
    public function proses_verif_cuti2(){
        cek_session_admin1();
        $pjb_atasan = $this->model_sitas->get_verifikator_akhir();
        $get_user = $this->model_sitas->get_user();
        $uri3 = _POST('uri3');
        $uri4 = _POST('uri4');
        if(get_kode_uniks($uri3) == $uri4){
            if($pjb_atasan->id_pegawai == $get_user->id_pegawai){
                $data = array(
                    'verif_atasan_langsung' => _POST('id_verif_cuti'),
                    'alasan_atasan_langsung' => _POST('alasan_atasan_langsung'),
                    'verif_atasan' => _POST('id_verif_cuti'),
                    'alasan_atasan' => _POST('alasan_atasan_langsung'),
                    'pejabat_atasan' => $pjb_atasan->id_pegawai
                );
                $cuti = $this->model_sitas->rowDataBy("username","trs_cuti","id_cuti=$uri3")->row();
                $idn_pemohon = $this->model_sitas->get_user_by($cuti->username);
                $this->model_sitas->update_data("trs_cuti","id_cuti",$uri3,$data);
                $no_wa = substr_replace($idn_pemohon->no_hp,62,0,1);
                $links = base_url('primer?redir=buat_cuti');
                $pesan = "*Layanan Aplikasi BSIP TAS* Cuti anda telah diverifikasi, silahkan klik link berikut $links";
                $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
			    //echo $no_wa."-----".$pesan;
            } else {
                $data = array(
                    'verif_atasan_langsung' => _POST('id_verif_cuti'),
                    'alasan_atasan_langsung' => _POST('alasan_atasan_langsung')
                );
                $this->model_sitas->update_data("trs_cuti","id_cuti",$uri3,$data);
                $no_wa = substr_replace($pjb_atasan->no_hp,62,0,1);
                $links = base_url('primer?redir=verif_cuti/'.$uri3.'/'.$uri4);
                $pesan = "*Layanan Aplikasi BSIP TAS* Ada Cuti Pegawai yang akan diverifikasi, silahkan klik link berikut $links";
                $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
                //echo $no_wa."-----".$pesan;
            }
            redirect('sekunder/list_verif_cuti2');
        } else {
            echo "Sori Yee wkwkwk";
        }
    }
    public function list_verif_cuti(){
        cek_session_admin1();
        $tahun = $this->session->tahun;
        $username = $this->session->username;
        $get_kabalai = $this->model_sitas->get_verifikator_akhir();
        if($username == $get_kabalai->username){
                $data['rec'] = $this->db->query("select a.*, c.nama, d.jenis_cuti from trs_cuti a 
                                inner join user b on a.username=b.username 
                                inner join pegawai c on b.id_pegawai=c.id_pegawai
                                inner join jenis_cuti d on a.id_jenis_cuti=d.id_jenis_cuti
                                where verif_atasan_langsung = 1 and verif_atasan = 0 order by a.id_cuti asc")->result();
          $this->template->load('sitas/verif_surat/template_form','sitas/verif_surat/daftar_cuti',$data);
        } else {
          $this->load->view('sitas/verif_surat/no_akses');
        }
    }
    
    public function proses_verif_cuti(){
        cek_session_admin1();
        $pjb_atasan = $this->model_sitas->get_verifikator_akhir();
        $uri3 = _POST('uri3');
        $uri4 = _POST('uri4');
        $no_pemohon = _POST('no_pemohon');
        if(get_kode_uniks($uri3) == $uri4){
            $data = array(
                'verif_atasan' => _POST('id_verif_cuti'),
                'pejabat_atasan' => _POST('pejabat_atasan'),
                'alasan_atasan' => _POST('alasan_atasan')
            );
            $this->model_sitas->update_data("trs_cuti","id_cuti",$uri3,$data);
            $no_wa = substr_replace($no_pemohon,62,0,1);
            $links = base_url('primer?redir=buat_cuti');
            $pesan = "*Layanan Aplikasi BSIP TAS* Cuti anda telah diverifikasi, silahkan klik link berikut $links";
            $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
			//echo $no_wa."-----".$pesan;
            redirect('sekunder/list_verif_cuti');
        } else {
            echo "Sori Yee wkwkwk";
        }
    }
    function logbook_detail(){
	    $waktu = $this->uri->segment(3);
	    $user = $this->uri->segment(4);
        $idn_peg = $this->model_sitas->get_user();
	    $data['waktu'] = $waktu;
	    $data['username'] = $user;
	    $data['bio'] = $this->db->query("select a.* from pegawai a 
	                                    inner join user b on a.id_pegawai=b.id_pegawai
	                                    where b.username='$user'")->row();
		$data['verif_surat'] = $this->model_sitas->listDataBy("a.no_surat_keluar,a.tujuan_surat,a.tanggal,a.perihal
                                ,b.kode_sub_arsip,b.sub_arsip,c.sifat",
								"surat_keluar a inner join klasifikasi_sub_arsip b on a.id_sub_arsip = b.id_sub_arsip
                                inner join sifat_surat c on a.sifat=c.id_sifat",
								"a.id_verif = $idn_peg->id_pegawai and a.tanggal like '%$waktu%'","a.id_surat_keluar desc");
		$data['verif_cuti'] = $this->model_sitas->listDataBy("a.alasan_cuti,a.lama_cuti,a.tgl_mulai,a.tgl_akhir,alamat_cuti,
                                b.jenis_cuti,c.verif,d.nama",
                                "trs_cuti a inner join jenis_cuti b on a.id_jenis_cuti=b.id_jenis_cuti
                                inner join verif_cuti c on a.verif_atasan=c.id_verif_atasan
                                inner join user d on a.username=d.username",
                                "a.pejabat_atasan = $idn_peg->id_pegawai and a.tgl_mulai like '%$waktu%'","a.id_cuti desc");
		$data['verif_surat1'] = $this->model_sitas->listDataBy("a.no_surat_keluar,a.tujuan_surat,a.tanggal,a.perihal
                                ,b.kode_sub_arsip,b.sub_arsip,c.sifat",
                                "surat_keluar a inner join klasifikasi_sub_arsip b on a.id_sub_arsip = b.id_sub_arsip
                                inner join sifat_surat c on a.sifat=c.id_sifat",
                                "a.id_verif1 = $idn_peg->id_pegawai and a.tanggal like '%$waktu%'","a.id_surat_keluar desc");
		$data['verif_cuti1'] = $this->model_sitas->listDataBy("a.alasan_cuti,a.lama_cuti,a.tgl_mulai,a.tgl_akhir,alamat_cuti,
                                b.jenis_cuti,c.verif,d.nama",
                                "trs_cuti a inner join jenis_cuti b on a.id_jenis_cuti=b.id_jenis_cuti
                                inner join verif_cuti c on a.verif_atasan=c.id_verif_atasan
                                inner join user d on a.username=d.username",
                                "a.pejabat_atasan_langsung = $idn_peg->id_pegawai and a.verif_atasan_langsung != 0 and a.tgl_mulai like '%$waktu%'","a.id_cuti desc");
		$data['verif_lap_perjadin'] = $this->model_sitas->listDataBy("a.untuk,a.is_dipa,a.user,a.tanggal_input,b.id_spt",
                                        "spt a inner join lap_spt b on a.id_spt=b.id_spt",
                                        "b.pj_ttd = $idn_peg->id_pegawai and b.tanggal_input like '%$waktu%'",
                                        "b.id_lap_spt desc");
		$data['disposisi_surat'] = $this->model_sitas->listDataBy("a.no_agenda,a.no_surat_masuk,a.asal_surat,a.perihal,a.disposisi,
                                    a.diteruskan,a.isi_disposisi,a.tanggal_masuk,b.kode_sub_arsip,b.sub_arsip,c.sifat",
                                    "surat_masuk a inner join klasifikasi_sub_arsip b on a.id_sub_arsip=b.id_sub_arsip
                                    inner join sifat_surat c on a.id_sifat=c.id_sifat",
                                    "a.id_verifikasi = $idn_peg->id_pegawai and a.tanggal_masuk like '%$waktu%'","a.id_surat_masuk desc");
        $data['terima_disposisi'] = $this->model_sitas->listDataBy("a.no_agenda,a.no_surat_masuk,a.asal_surat,a.perihal,a.disposisi,
                                    a.diteruskan,a.isi_disposisi,a.tanggal_masuk,b.kode_sub_arsip,b.sub_arsip,c.sifat",
                                    "surat_masuk a inner join klasifikasi_sub_arsip b on a.id_sub_arsip=b.id_sub_arsip
                                    inner join sifat_surat c on a.id_sifat=c.id_sifat",
                                    "a.disposisi like '%$idn_peg->nama%' and a.tanggal_masuk like '%$waktu%'","a.id_surat_masuk desc");
        $data['tamu'] = $this->model_sitas->listDataBy("nik,nama,asal_instansi,alamat,maksud_tujuan,waktu,foto_tamu","buku_tamu",
                        "id_pegawai = $idn_peg->id_pegawai and waktu like '%$waktu%'","id_tamu desc");
        $data['surat_masuk'] = $this->model_sitas->listDataBy("a.no_agenda,a.no_surat_masuk,a.asal_surat,a.perihal,a.disposisi,
                                    a.diteruskan,a.isi_disposisi,a.tanggal_masuk,a.tanggal_input,b.kode_sub_arsip,b.sub_arsip,c.sifat",
                                    "surat_masuk a inner join klasifikasi_sub_arsip b on a.id_sub_arsip=b.id_sub_arsip
                                    inner join sifat_surat c on a.id_sifat=c.id_sifat",
                                    "a.user = '$user' and a.tanggal_input like '%$waktu%'","a.id_surat_masuk desc");
        $data['surat_keluar'] = $this->model_sitas->listDataBy("a.no_surat_keluar,a.tujuan_surat,a.tanggal,a.perihal
                                ,b.kode_sub_arsip,b.sub_arsip,c.sifat",
								"surat_keluar a inner join klasifikasi_sub_arsip b on a.id_sub_arsip = b.id_sub_arsip
                                inner join sifat_surat c on a.sifat=c.id_sifat",
								"a.user = '$user' and a.tanggal like '%$waktu%'","a.id_surat_keluar desc");
	    $this->template->load('sitas/template_form','sitas/logbook_detail2',$data);
	}
    function master_pegawai(){
        cek_session_admin1();
        $uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        if(empty($uri3)){
            $data['nama'] = "";
            $data['nip'] = "";
            $data['jabatan'] = "";
            $data['pangkat'] = "";
            $data['gol'] = "";
            $data['no_hp'] = "";
            $data['status'] = "tambah";
            $data['id_pegawai'] = 0;
        } else {
            if(get_kode_uniks($uri3) == $uri4){
                $peg = $this->model_sitas->rowDataBy("*","pegawai","id_pegawai=$uri3")->row();
                $data['nama'] = $peg->nama;
                $data['nip'] = $peg->nip;
                $data['jabatan'] = $peg->jabatan;
                $data['pangkat'] = $peg->pangkat;
                $data['gol'] = $peg->gol;
                $data['no_hp'] = $peg->no_hp;
                $data['status'] = "edit";
                $data['id_pegawai'] = $peg->id_pegawai;
            } else {
                $data['nama'] = "Sori Yeeee";
                $data['nip'] = "Sori Yeeee";
                $data['jabatan'] = "Sori Yeeee";
                $data['pangkat'] = "Sori Yeeee";
                $data['gol'] = "Sori Yeeee";
                $data['no_hp'] = "Sori Yeeee";
                $data['status'] = "tambah";
                $data['id_pegawai'] = 0;
            }
        }
        $data['rec'] = $this->model_sitas->listData("*","pegawai","id_pegawai asc");
        $this->template->load('sitas/template_form','sitas/master/pegawai',$data);
    }
    function save_pegawai(){
        cek_session_admin1();
        $data_peg = array(
            'nama' => _POST('nama'),
            'nip' => _POST('nip'),
            'jabatan' => _POST('jabatan'),
            'pangkat' => _POST('pangkat'),
            'gol' => _POST('gol'),
            'no_hp' => _POST('no_hp'),
        );
       if(_POST('status') == "tambah"){
        $this->db->insert('pegawai',$data_peg);
        $data_spt = array(
            'id_pegawai'=>$this->db->insert_id(),
            'nama'=>_POST('nama'),
            'uk'=>"Balai Pengujian Standar Instrumen Tanaman Pemanis dan Serat",
            'is_internal'=>1
        );
        $this->db->insert('peserta_spt',$data_spt);
       } else {
        $this->db->where('id_pegawai',_POST('id_pegawai'));
        $this->db->update('pegawai',$data_peg);
        $data_spt = array(
            'nama'=>_POST('nama')
        );
        $this->db->where('id_pegawai',_POST('id_pegawai'));
        $this->db->update('peserta_spt',$data_spt);
       }
       redirect('sekunder/master_pegawai');
    }
    function hapus_pegawai(){
        $uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        if(get_kode_uniks($uri3)==$uri4){
            $this->model_sitas->hapus_data("pegawai","id_pegawai=$uri3");
            $this->model_sitas->hapus_data("peserta_spt","id_pegawai=$uri3");
            $this->model_sitas->hapus_data("user","id_pegawai=$uri3");
            redirect('sekunder/master_pegawai');
        } else {
            echo "Sori Yeeee";
        }
    }
    function lihat_user(){
        cek_session_admin1();
        if(isset($_POST['id_pegawai'])){
            $id_pegawai = $_POST['id_pegawai'];
            $rowUser = $this->model_sitas->rowDataBy("*","user","id_pegawai=$id_pegawai");
            $cekUser = $rowUser->num_rows();
            if($cekUser > 0){
                $getUser = $rowUser->row();
                $data['username'] = $getUser->username;
            } else {
                $data['username'] = "";
            }
            $data['id_pegawai'] = $id_pegawai;
            $this->load->view('sitas/master/userx',$data);
        }
    }
    function simpan_user(){
        cek_session_admin1();
        $id_pegawai = _POST('id_pegawai');
        $getPeg = $this->model_sitas->rowDataBy("nama,nip","pegawai","id_pegawai=$id_pegawai")->row();
        $data = array(
            'id_pegawai'=> $id_pegawai,
            'nama'=> $getPeg->nama,
            'nip'=> $getPeg->nip,
            'username'=> _POST('username'),
            'password'=> md5(_POST('password'))
        );
        $cekUser = $this->model_sitas->rowDataBy("*","user","id_pegawai=$id_pegawai")->num_rows();
        if($cekUser > 0){
            $this->model_sitas->update_data('user','id_pegawai',$id_pegawai,$data);
        } else {
            $this->model_sitas->saveData('user',$data);
        }
        redirect('sekunder/master_pegawai');
    }
    function save_lap_gratifikasi(){
        cek_session_admin1();
		$status = _POST('status');
		$id_lap_gratifikasi = _POST('id_lap_gratifikasi');
		$data = array(
			'id_pegawai'=>_POST('id_pegawai'),
			'id_surat_keluar'=>_POST('id_surat_keluar'),
			'tgl_terima'=>_POST('tgl_terima'),
			'jenis_gratifikasi'=>_POST('jenis_gratifikasi'),
			'nilai'=>str_replace('.','',_POST('nilai')),
			'lokasi_terima'=>_POST('lokasi_terima'),
			'pemberi'=>_POST('pemberi'),
			'hub_pemberi'=>_POST('hub_pemberi')
		);
		if($status == "add"){
			$this->model_sitas->saveData("lapor_gratifikasi",$data);
		} else {
			$this->model_sitas->update_data("lapor_gratifikasi","id_lap_gratifikasi",$id_lap_gratifikasi,$data);
		}
        redirect('primer/lap_gratifikasi');
	}
    function get_row_lap_gratifikai(){
        cek_session_admin1();
        $id_lap = _POST('id');
        $qw = $this->model_sitas->rowDataBy("*","lapor_gratifikasi","id_lap_gratifikasi=$id_lap")->row();
        echo json_encode($qw);
    }
    function hapus_gratifikasi(){
        $uri3 = $this->uri->segment(3);
        $this->model_sitas->hapus_data("lapor_gratifikasi","id_lap_gratifikasi=$uri3");
        redirect('primer/lap_gratifikasi');
    }
    function edit_drive(){
        cek_session_admin1();
        $id_folder = _POST('id_folder');
        $qwx = $this->model_sitas->rowDataBy("*","folder","id_folder=$id_folder")->row();
        $data['nama'] = $qwx->folder;
        $data['id_folder'] = $id_folder;
        $this->load->view('sitas/edit_drive',$data);
    }
    function proses_edit_folder(){
        $folder = _POST('folder');
        $id_folder = _POST('id_folder');
        $qw_curent = $this->model_sitas->rowDataBy("*","folder","id_folder=$id_folder")->row();
        $qw_root = $this->model_sitas->rowDataBy("*","folder","id_folder=$qw_curent->root")->row();
        /*
        $cek_qw_down = $this->model_sitas->rowDataBy("*","folder","root=$id_folder")->num_rows();
        $url_folder = strtolower($folder);
	    $url_folder_fix = str_replace(" ","-",$url_folder);
        $url = $qw_root->url."_".$url_folder_fix;
        */
        $data = array(
            'folder'=>$folder,
            //'url'=>$url,
            //'tgl_buat'=>date('Y-m-d'),
            //'root'=>$qw_curent->root
        );
        $this->model_sitas->update_data("folder","id_folder",$id_folder,$data);
        /*
        if($cek_qw_down > 0){
            $qw_down = $this->model_sitas->listDataBy("*","folder","root=$id_folder","id_folder asc");
            foreach($qw_down as $qwd){
                $pisah_url = explode("_",$qwd->url);
                $url_down = end($pisah_url);
                $url_fix = $url."_".$url_down;
                //echo $url_fix."--".$id_folder."<br>";
                $this->db->query("update folder set url = '$url_fix' where id_folder = $qwd->id_folder and root = $id_folder");
            }
        }
        */
        redirect('primer/drive/'.$qw_root->url);
    }
    function edit_file(){
        cek_session_admin1();
        $id_file = _POST('id_file');
        $qwx = $this->model_sitas->rowDataBy("id_file,nama_file","file","id_file=$id_file")->row();
        $data['nama_file'] = $qwx->nama_file;
        $data['id_file'] = $id_file;
        $this->load->view('sitas/edit_file',$data);
    }
    function proses_edit_file(){
        $nama_file = _POST('nama_file');
        $id_file = _POST('id_file');
        $qwx = $this->model_sitas->rowDataBy("b.url","file a inner join folder b on a.id_folder=b.id_folder",
                                                "a.id_file=$id_file")->row();
        $data = array('nama_file'=>$nama_file);
        $this->model_sitas->update_data("file","id_file",$id_file,$data);
        redirect('primer/drive/'.$qwx->url);
    }
    function get_subkomponen(){
        $id_subkomp = _POST('id_subkomp');
        $data["subdetil"] = $this->model_sitas->listDataBy("a.id_subdetil,a.id_detil,a.subdetil,b.kd_detil,b.detil",
                            "a_subdetil9 a
                            inner join a_detil8 b on a.id_detil=b.id_detil
                            inner join a_subkomp7 c on b.id_subkomp=c.id_subkomp",
                            "c.id_subkomp = $id_subkomp and b.kd_detil like '%524%'","a.id_subdetil");
        $this->load->view('sitas/get_subkomponen',$data);
    }
    function tolak_status_spt(){
        cek_session_admin1();
        date_default_timezone_set('Asia/Jakarta');
        $id_spt = _POST('id_spt');
        $kd_spt = _POST('kd_spt');
        if(get_kode_uniks($id_spt) == $kd_spt){
            $spt = $this->model_sitas->rowDataBy("user,pj","spt","id_spt = $id_spt")->row();
            $pengendali_anggaran = $this->model_sitas->rowDataBy("id_pegawai","verifikator","menu = 'spt' and tingkat = 1")->row();
			$ppk = $this->model_sitas->rowDataBy("id_pegawai","verifikator","menu = 'spt' and tingkat = 2")->row();
            $get_user_log = $this->model_sitas->get_user();
            $get_user = $this->model_sitas->get_user_by($spt->user);
            if($get_user_log->id_pegawai == $spt->pj){
                $data = array('ajukan'=>0,'verif_pj'=>2,'waktu_verif_pj'=>date('Y-m-d H:i:s'),'keterangan'=>_POST('keterangan'));
            }
            if($get_user_log->id_pegawai == $pengendali_anggaran->id_pegawai){
                $data = array('ajukan'=>0,'status_verif_pa'=>2,'id_verif_pa'=>_POST('verifikator'),'waktu_verif_pa'=>date('Y-m-d H:i:s'),'keterangan_pa'=>_POST('keterangan'));
            }
            if($get_user_log->id_pegawai == $ppk->id_pegawai){
                $data = array('ajukan'=>0,'status_verif_ppk'=>2,'id_verif_ppk'=>_POST('verifikator'),'waktu_verif_ppk'=>date('Y-m-d H:i:s'),'keterangan_ppk'=>_POST('keterangan'));
            }
            $this->model_sitas->update_data("spt","id_spt",$id_spt,$data);
            $no_wa = substr_replace($get_user->no_hp,"62",0,1);
			$links = base_url()."primer?redir=status_spt/".$id_spt."/".$kd_spt;
        	$pesan = "*Layanan BSIP TAS* Pengajuan SPT anda ditolak, untuk detailnya silahkan klik link $links";
            $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
            //echo $no_wa."---".$pesan;
            redirect('primer/status_spt/'.$id_spt.'/'.$kd_spt);
        } else {
            echo "Sorry Yee wkwkwkw";
        }
    }
    function setuju_status_spt(){
        cek_session_admin1();
        date_default_timezone_set('Asia/Jakarta');
        $id_spt = _POST('id_spt');
        $kd_spt = _POST('kd_spt');
        if(get_kode_uniks($id_spt) == $kd_spt){
            $spt = $this->model_sitas->rowDataBy("id_surat_masuk,id_sub_arsip,tanggal,lama_hari,tanggal_input,pj,untuk,verif_pj,status_verif_pa,status_verif_ppk",
                    "spt","id_spt = $id_spt")->row();
            $pengendali_anggaran = $this->model_sitas->rowDataBy("a.id_pegawai,b.no_hp",
                                    "verifikator a inner join pegawai b on a.id_pegawai=b.id_pegawai",
                                    "a.menu = 'spt' and a.tingkat = 1")->row();
			$ppk = $this->model_sitas->rowDataBy("a.id_pegawai,b.no_hp",
                    "verifikator a inner join pegawai b on a.id_pegawai=b.id_pegawai",
                    "a.menu = 'spt' and a.tingkat = 2")->row();
            $get_user_log = $this->model_sitas->get_user();
            $total_verif = $this->model_cek->hitung_jumlah_verif($spt->verif_pj,$spt->status_verif_pa,$spt->status_verif_ppk);
            if($total_verif == 0){
                $data = array('verif_pj'=>1,'waktu_verif_pj'=>date('Y-m-d H:i:s'),'keterangan'=>_POST('keterangan'));
                $data_sk = array();
                $no_wa = substr_replace($pengendali_anggaran->no_hp,"62",0,1);
                $links = base_url()."primer?redir=status_spt/".$id_spt."/".$kd_spt;
        	    $pesan = "*Layanan BSIP TAS* Ada pengajuan SPT yang akan diverifikasi oleh anda, untuk detailnya silahkan klik link $links";
            } else if($total_verif == 1) {
                $data = array('status_verif_pa'=>1,'id_verif_pa'=>_POST('verifikator'),'waktu_verif_pa'=>date('Y-m-d H:i:s'),'keterangan_pa'=>_POST('keterangan'));
                $data_sk = array();
                $no_wa = substr_replace($ppk->no_hp,"62",0,1);
                $links = base_url()."primer?redir=status_spt/".$id_spt."/".$kd_spt;
        	    $pesan = "*Layanan BSIP TAS* Ada pengajuan SPT yang akan diverifikasi oleh anda, untuk detailnya silahkan klik link $links";
            } else if($total_verif == 2){
                $petugas_terima_sk = $this->model_sitas->rowDataBy("b.no_hp",
                                        "petugas_terima a inner join pegawai b on a.id_pegawai=b.id_pegawai",
                                        "menu = 'surat_keluar'")->row();
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
                //$id_surat_keluar = 0;
                $data = array('id_surat_keluar'=>$id_surat_keluar,'status_verif_ppk'=>1,
                                'id_verif_ppk'=>_POST('verifikator'),'waktu_verif_ppk'=>date('Y-m-d H:i:s'),
                                'keterangan_ppk'=>_POST('keterangan'));
                $no_wa = substr_replace($petugas_terima_sk->no_hp,"62",0,1);
                $links = base_url()."primer?redir=buat_surat";
        	    $pesan = "*Layanan BSIP TAS* Ada pengajuan SPT silahkan klik link $links";
            }
            $this->model_sitas->update_data("spt","id_spt",$id_spt,$data);
            $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
            //echo $no_wa."---".$pesan;
            redirect('primer/status_spt/'.$id_spt.'/'.$kd_spt);
        } else {
            echo "Sorry Yee wkwkwkw";
        }
    }
    function send_info_spt(){
        cek_session_admin1();
        $uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        if(get_kode_uniks($uri3) == $uri4){
            $spt = $this->model_sitas->rowDataBy("id_surat_masuk,id_sub_arsip,tanggal,lama_hari,tanggal_input,pj,untuk,verif_pj,status_verif_pa,status_verif_ppk",
                    "spt","id_spt = $uri3")->row();
            $pj = $this->model_sitas->rowDataBy("no_hp","pegawai","id_pegawai = $spt->pj")->row();
            $pengendali_anggaran = $this->model_sitas->rowDataBy("a.id_pegawai,b.no_hp",
                                    "verifikator a inner join pegawai b on a.id_pegawai=b.id_pegawai",
                                    "a.menu = 'spt' and a.tingkat = 1")->row();
			$ppk = $this->model_sitas->rowDataBy("a.id_pegawai,b.no_hp",
                    "verifikator a inner join pegawai b on a.id_pegawai=b.id_pegawai",
                    "a.menu = 'spt' and a.tingkat = 2")->row();
            $get_user_log = $this->model_sitas->get_user();
            $total_verif = $this->model_cek->hitung_jumlah_verif($spt->verif_pj,$spt->status_verif_pa,$spt->status_verif_ppk);
            if($total_verif == 0){
                $no_wa = substr_replace($pj->no_hp,"62",0,1);
                echo "kirim ke PJ";
            } else if($total_verif == 1) {
                $no_wa = substr_replace($pengendali_anggaran->no_hp,"62",0,1);
                echo "kirim ke PA";
            } else if($total_verif == 2){
                $no_wa = substr_replace($ppk->no_hp,"62",0,1);
                echo "kirim ke PPK";
            }
            $links = base_url()."primer?redir=status_spt/".$uri3."/".$uri4;
        	$pesan = "*Layanan BSIP TAS* Ada pengajuan SPT yang akan diverifikasi oleh anda, untuk detailnya silahkan klik link $links";
            $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
            //echo $no_wa."---".$pesan;
            redirect('primer/status_spt/'.$uri3.'/'.$uri4);
        } else {
            echo "Sorry YEEE";
        }

    }
    function profil(){
        cek_session_admin1();
        $user = $this->model_sitas->get_user();
        $data['nama'] = $user->nama;
        $data['nip'] = $user->nip;
        $data['jabatan'] = $user->jabatan;
        $data['pangkat'] = $user->pangkat;
        $data['gol'] = $user->gol;
        $data['no_hp'] = $user->no_hp;
        $data['id_pegawai'] = $user->id_pegawai;
        $data['alert'] = "";
        $this->template->load('sitas/template_form','sitas/profil',$data);
    }
    function update_profil(){
        cek_session_admin1();
        $id_pegawai = _POST('id_pegawai');
        $data_peg = array(
                    'nip' => _POST('nip'),
                    'jabatan' => _POST('jabatan'),
                    'pangkat' => _POST('pangkat'),
                    'gol' => _POST('gol'),
                    'no_hp' => _POST('no_hp'),
                );
        $data_user = array('nip' => _POST('nip'));
        $this->model_sitas->update_data("pegawai","id_pegawai",$id_pegawai,$data_peg);
        $this->model_sitas->update_data("user","id_pegawai",$id_pegawai,$data_user);
        $user = $this->model_sitas->get_user();
        $data['nama'] = $user->nama;
        $data['nip'] = $user->nip;
        $data['jabatan'] = $user->jabatan;
        $data['pangkat'] = $user->pangkat;
        $data['gol'] = $user->gol;
        $data['no_hp'] = $user->no_hp;
        $data['id_pegawai'] = $user->id_pegawai;
        $data['alert'] = "<div class='alert alert-success'><strong>Berhasil!</strong> Update Data Pegawai.</div>";
        $this->template->load('sitas/template_form','sitas/profil',$data);
    }
}
