<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Nonlogin extends CI_Controller
{
  public function buku_tamu(){
    $tgl_hari_ini = date('Y-m-d');
    $peg_spt = $this->model_sitas->listDataBy("id_pegawai","anggota_spt","tanggal_spt like '%$tgl_hari_ini%'","id_anggota asc");
    $larik = "";
    foreach($peg_spt as $qw){
        $larik .= $qw->id_pegawai.",";
    }
    $larikx = substr($larik,0,-1);
    $larik_fix = "(".$larikx.")";
    $cek_peg = $this->db->query("select id_pegawai from anggota_spt where tanggal_spt like '%$tgl_hari_ini%'")->num_rows();
    if($cek_peg > 0){
        $data['pegawai'] = $this->model_sitas->listDataBy("id_pegawai,nama,no_hp","pegawai","id_pegawai not in $larik_fix","id_pegawai asc");
    } else {
        $data['pegawai'] = $this->model_sitas->listData("id_pegawai,nama,no_hp","pegawai","id_pegawai ASC");
    }
    $this->load->view('sitas/buku_tamu',$data);
  }

  public function kirim_buku_tamu(){
    date_default_timezone_set('Asia/Jakarta');
    $img = $_POST['image'];
    $fileName = uniqid();
    $nama = htmlspecialchars(strip_tags($_POST['nama']));
    $alamat = htmlspecialchars(strip_tags($_POST['alamat']));
    $no_hp = htmlspecialchars(strip_tags($_POST['no_hp']));
    $pengikut = htmlspecialchars(strip_tags($_POST['pengikut']));
    $jk = $_POST['jk'];
    $asal_instansi = htmlspecialchars(strip_tags($_POST['asal_instansi']));
    $maksud_tujuan = $_POST['maksud_tujuan'];
    $pc_peg = explode("-",$this->input->post('id_pegawai'));
    $no_wa = substr_replace("$pc_peg[1]","62",0,1);
    $pesan = "*Recepsionist BSIP TAS* ada yang ingin bertemu atas nama ".$nama." asal instansi ".$asal_instansi." dengan maksud tujuan ".$maksud_tujuan." No HP tamu anda ".$no_hp." Terima Kasih";
    $datadb = array('nama'=>$nama,
                        'no_hp'=>$no_hp,
                        'asal_instansi'=>$asal_instansi,
                        'alamat'=>$alamat,
                        'jk'=>$jk,
                        'maksud_tujuan'=>$maksud_tujuan,
                        'id_pegawai'=>$pc_peg[0],
                        'waktu'=>date('Y-m-d H:i:s'),
                        'foto_tamu'=>$fileName,
                        'pengikut'=>$pengikut
                        );
        $this->model_sitas->upload_foto_base64("asset/foto_tamu/",$fileName,$img);
        $this->db->insert('buku_tamu',$datadb);
        $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
        echo "<script>alert('Registrasi Tamu Berhasil')</script>";
        echo "<script>window.location.href='".base_url()."nonlogin/buku_tamu'</script>";   
        //redirect('home/buku_tamu');
        //$this->load->view('sweetalert/buku_tamu');
  }
  public function list_buku_tamu(){
    cek_session_admin1();
    date_default_timezone_set('Asia/Jakarta');
    $wkt = date('Y-m');
    $data['listx'] = $this->model_sitas->listDataBy("a.*,b.nama as nm","buku_tamu a inner join pegawai b on a.id_pegawai=b.id_pegawai","a.waktu like '%$wkt%'","a.id_tamu asc");
    $this->load->view('sitas/list_buku_tamu',$data);
  }
  public function lap_buku_tamu(){
    cek_session_admin1();
    $tahun = $_POST['tahun'];
    $bulan = "-".$_POST['bulan'];
    $tgl = "-".$_POST['tgl'];
    if($bulan=="-"){
        $waktu = $tahun;
    } else {
        $waktu = $tahun.$bulan.$tgl;
    }
    $data['timex'] = $waktu;
    $data['dtx'] = $this->db->query("select * from buku_tamu where waktu like '%$waktu%'");
    $this->load->view('sitas/lap_buku_tamu',$data);
  }
  public function status_surat(){
    $uri3 = $this->uri->segment(3);
    $uri4 = $this->uri->segment(4);
    $qw = $this->model_sitas->rowDataBy("*","surat_keluar","id_surat_keluar=$uri4")->row();
    $data['kode_arsip'] = $this->model_sitas->rowDataBy("*","klasifikasi_sub_arsip","id_sub_arsip = $qw->id_sub_arsip")->row();
    $data['data'] = $qw;
    $this->load->view('sitas/preview/status_surat',$data);
  }
  public function tes_wa_gateway(){
    $nox = "6281282410448";
    $pesan = "tes kirim";
    $this->model_sitas->kirim_wa_gateway($nox,$pesan);
    redirect('nonlogin/buku_tamu');
  }
}