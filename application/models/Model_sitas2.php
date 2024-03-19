<?php
class Model_sitas2 extends CI_model{
    function list_cuti(){
        $pejabat = $this->model_sitas->listDataBy("id_pegawai","struktur_organisasi","id_struktur in (1,2)","id_struktur asc");
        $pejabat_atasan_langsung = $this->model_sitas->listDataBy("id_pegawai","struktur_organisasi","id_struktur != 5","id_struktur asc");
        $kepeg = $this->model_sitas->listDataBy("id_pegawai","petugas_terima","menu = 'cuti'","id_petugas asc");
        $otoritas = array();
        $otoritas_atasan_langsung = array();
        foreach($pejabat as $pj){
            array_push($otoritas,$pj->id_pegawai);
        }
        foreach($kepeg as $kp){
            array_push($otoritas,$kp->id_pegawai);
        }
        foreach($pejabat_atasan_langsung as $pjs){
            array_push($otoritas_atasan_langsung,$pjs->id_pegawai);
        }
        //$otor = implode(",",$otoritas);
        $user_login = $this->model_sitas->get_user();
        $usernm = $this->session->username;
        $tahun = $this->session->tahun;
        if(in_array($user_login->id_pegawai,$otoritas)){
            $qw_for_user = "";
        } else {
            if(in_array($user_login->id_pegawai,$otoritas_atasan_langsung)){
                $qw_for_user = "and a.pejabat_atasan_langsung = $user_login->id_pegawai or a.username = '$usernm'";
            } else {
                $qw_for_user = "and a.username = '$usernm'";
            }
        }
        $thn_ini = $tahun;
        $thn_1 = $tahun - 1;
        $thn_2 = $tahun - 2;
        $dtx =  $this->db->query("select a.*, c.nama, d.jenis_cuti from trs_cuti a 
                                    inner join user b on a.username=b.username 
                                    inner join pegawai c on b.id_pegawai=c.id_pegawai
                                    inner join jenis_cuti d on a.id_jenis_cuti=d.id_jenis_cuti
                                    where a.tahun = '$tahun' $qw_for_user
                                    order by a.id_cuti desc")->result();
        $arr = array();
        $nor = 0;
        foreach($dtx as $dt){
            $idn_peg = $this->model_sitas->get_user_by($dt->username);
            $jml_ini = $this->db->query("select sum(lama_cuti) as jml from trs_cuti where username = '$dt->username' and tahun = '$thn_ini'")->row();
            $jml_11 = $this->db->query("select sum(lama_cuti) as jml from trs_cuti where username = '$dt->username' and tahun = '$thn_1'")->row();
            $jml_22 = $this->db->query("select sum(lama_cuti) as jml from trs_cuti where username = '$dt->username' and tahun = '$thn_2'")->row();
            $qw_thn = $this->model_sitas->rowDataBy("*","cuti_sebelum","id_pegawai=$idn_peg->id_pegawai and tahun='$thn_ini'");
            $cek_qw_thn = $qw_thn->num_rows();
            if($cek_qw_thn > 0){
                $row_qw_thn = $qw_thn->row();
                $jml_thn_ini = $row_qw_thn->jumlah - $jml_ini->jml;
            } else {
                $jml_thn_ini = 12 - $jml_ini->jml;
            }

            $qw_thn1 = $this->model_sitas->rowDataBy("*","cuti_sebelum","id_pegawai=$idn_peg->id_pegawai and tahun='$thn_1'");
            $cek_qw_thn1 = $qw_thn1->num_rows();
            if($cek_qw_thn1 > 0){
                $row_qw_thn1 = $qw_thn1->row();
                $jml_thn_1 = $row_qw_thn1->jumlah;
            } else {
                $jml_thn_1 = 12 - $jml_11->jml;
            }

            $qw_thn2 = $this->model_sitas->rowDataBy("*","cuti_sebelum","id_pegawai=$idn_peg->id_pegawai and tahun='$thn_2'");
            $cek_qw_thn2 = $qw_thn2->num_rows();
            if($cek_qw_thn2 > 0){
                $row_qw_thn2 = $qw_thn2->row();
                $jml_thn_2 = $row_qw_thn2->jumlah;
            } else {
                $jml_thn_2 = 12 - $jml_22->jml;
            }
            $sisa_cuti = $jml_thn_ini + $jml_thn_1 + $jml_thn_2;

            if($dt->verif_atasan_langsung != 0){
                $verif_atasan_langsung = $this->model_sitas->rowDataBy("*","verif_cuti","id_verif_atasan = $dt->verif_atasan_langsung")->row();
                $status_atasan_langsung = $verif_atasan_langsung->verif." Atasan Langsung";
            } else {
                $status_atasan_langsung = "";
            }
            if($dt->verif_atasan != 0){
                $verif_atasan = $this->model_sitas->rowDataBy("*","verif_cuti","id_verif_atasan = $dt->verif_atasan")->row();
                $status_atasan = $verif_atasan->verif." Kepala Balai";
            } else {
                $status_atasan = "";
            }
            $arr[$nor][0] = $dt->id_cuti;
            $arr[$nor][1] = $nor+1;
            $arr[$nor][2] = $dt->nama;
            $arr[$nor][3] = $dt->jenis_cuti;
            $arr[$nor][4] = $dt->alasan_cuti;
            $arr[$nor][5] = tgl_indoo($dt->tgl_mulai)." <b>( ".$dt->lama_cuti." Hari)</b>";
            $arr[$nor][6] = $sisa_cuti;
            $arr[$nor][7] = $status_atasan_langsung."<br>".$status_atasan;
            $nor++;
        }
        return $arr;
    }
    function atasan_selek(){
        $qw = $this->db->query("select a.id_pegawai,b.nama from struktur_organisasi a inner join pegawai b on a.id_pegawai=b.id_pegawai where a.id_struktur != 5")->result();
        $arr = array();
        $nor = 0;
        foreach($qw as $dt){
            $arr[$nor] = $dt->id_pegawai."#".$dt->nama;
            $nor++;
        }
        array_unshift($arr, "#Pilih Atasan");
        return $arr;
    }
    function atasan_selekted($x){
        $xx = $this->db->query("select a.id_pegawai,b.nama from struktur_organisasi a inner join pegawai b on a.id_pegawai=b.id_pegawai where a.id_pegawai = $x")->row();
        $qw = $this->db->query("select a.id_pegawai,b.nama from struktur_organisasi a inner join pegawai b on a.id_pegawai=b.id_pegawai where a.id_struktur != 5")->result();
        $arr = array();
        $nor = 0;
        $yy = $xx->id_pegawai."#".$xx->nama;
        foreach($qw as $dt){
            $arr[$nor] = $dt->id_pegawai."#".$dt->nama;
            $nor++;
        }
        array_unshift($arr, $yy);
        return $arr;
    }
    function jenis_cuti(){
        $qw = $this->db->query("select * from jenis_cuti")->result();
        $arr = array();
        $nor = 0;
        foreach($qw as $dt){
            $arr[$nor] = $dt->id_jenis_cuti."#".$dt->jenis_cuti;
            $nor++;
        }
        array_unshift($arr, "#Pilih Jenis Cuti");
        return $arr;
    }
    function jenis_cuti_select($x){
        $xx = $this->db->query("select * from jenis_cuti where id_jenis_cuti = $x")->row();
        $qw = $this->db->query("select * from jenis_cuti")->result();
        $arr = array();
        $nor = 0;
        $yy = $xx->id_jenis_cuti."#".$xx->jenis_cuti;
        foreach($qw as $dt){
            $arr[$nor] = $dt->id_jenis_cuti."#".$dt->jenis_cuti;
            $nor++;
        }
        array_unshift($arr, $yy);
        return $arr;
    }
    function list_sebelum_cuti(){
        $tahun = $this->session->tahun;
        $dtx =  $this->db->query("select a.*, c.nama, d.jenis_cuti from trs_cuti a 
                                    inner join user b on a.username=b.username 
                                    inner join pegawai c on b.id_pegawai=c.id_pegawai
                                    inner join jenis_cuti d on a.id_jenis_cuti=d.id_jenis_cuti
                                    where a.tahun = '$tahun' order by a.id_cuti desc")->result();
        $arr = array();
        $nor = 0;
        foreach($dtx as $dt){
            if($dt->verif_atasan_langsung != 0){
                $verif_atasan_langsung = $this->model_sitas->rowDataBy("*","verif_cuti","id_verif_atasan = $dt->verif_atasan_langsung")->row();
                $status_atasan_langsung = $verif_atasan_langsung->verif." Atasan Langsung";
            } else {
                $status_atasan_langsung = "";
            }
            if($dt->verif_atasan != 0){
                $verif_atasan = $this->model_sitas->rowDataBy("*","verif_cuti","id_verif_atasan = $dt->verif_atasan")->row();
                $status_atasan = $verif_atasan->verif." Kepala Balai";
            } else {
                $status_atasan = "";
            }
            $arr[$nor][0] = $dt->id_cuti;
            $arr[$nor][1] = $nor+1;
            $arr[$nor][2] = $dt->nama;
            $arr[$nor][3] = $dt->jenis_cuti;
            $arr[$nor][4] = $dt->alasan_cuti;
            $arr[$nor][5] = tgl_indoo($dt->tgl_mulai)." <b>( ".$dt->lama_cuti." Hari)</b>";
            $arr[$nor][6] = $status_atasan_langsung."<br>".$status_atasan;
            $nor++;
        }
        return $arr;
    }
}