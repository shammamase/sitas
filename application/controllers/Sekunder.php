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
    public function verif_cuti2(){
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
                $links = base_url('primer/buat_cuti');
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
                $links = base_url('sekunder/verif_cuti/'.$uri3.'/'.$uri4);
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
    public function verif_cuti(){
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
            $links = base_url('primer/buat_cuti');
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
}
