<?php
class Model_sitas2 extends CI_model{
    function list_cuti(){
        $tahun = $this->session->tahun;
        $dtx =  $this->db->query("select a.*, c.nama, d.jenis_cuti from trs_cuti a 
                                    inner join user b on a.username=b.username 
                                    inner join pegawai c on b.id_pegawai=c.id_pegawai
                                    inner join jenis_cuti d on a.id_jenis_cuti=d.id_jenis_cuti
                                    where a.tahun = '$tahun'
                                    order by a.id_cuti desc")->result();
        $arr = array();
        $nor = 0;
        foreach($dtx as $dt){
            if($dt->verif_atasan_langsung != 0){
                $verif_atasan_langsung = $this->model_silayak2->rowDataBy("*","verif_cuti","id_verif_atasan = $dt->verif_atasan_langsung")->row();
                $status_atasan_langsung = $verif_atasan_langsung->verif." Atasan Langsung";
            } else {
                $status_atasan_langsung = "";
            }
            if($dt->verif_atasan != 0){
                $verif_atasan = $this->model_silayak2->rowDataBy("*","verif_cuti","id_verif_atasan = $dt->verif_atasan")->row();
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
    function atasan_selek(){
        $qw = $this->db->query("select a.id_pegawai,b.nama from struktur_organisasi a inner join pegawai b on a.id_pegawai=b.id_pegawai")->result();
        $arr = array();
        $nor = 0;
        foreach($qw as $dt){
            $arr[$nor] = $dt->id_pegawai."#".$dt->nama;
            $nor++;
        }
        array_unshift($arr, "#Pilih Atasan");
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
}