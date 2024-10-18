<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends CI_Controller {
    function index(){
        cek_session_admin1();
        echo "halo";
    }
    function pengajuan_spt(){
        cek_session_admin1();
        $data['thn'] = $this->session->tahun;
        $data['bln'] = array("01","02","03","04","05","06","07","08","09","10","11","12");
        $this->template->load('sitas/template_form','sitas/report/pengajuan_spt',$data);
    }
    function print_pengajuan_spt(){
        if(empty(_POST('tanggal'))){
            redirect('report/pengajuan_spt');
        } else {
            $tanggal = _POST('tanggal');
            $arr_spt = array();
            $spt = $this->model_sitas->listDataBy("a.id_spt,a.id_surat_keluar,a.id_subdetil,a.untuk,a.lama_hari,a.id_transport,a.ket_berangkat,a.ket_wilayah,a.tanggal,a.pj,
                        a.no_sppd,a.verif_pj,a.status_verif_pa,a.status_verif_ppk,a.keterangan,a.keterangan_pa,a.keterangan_ppk,b.transportasi",
                        "spt a inner join transportasi_spt b on a.id_transport=b.id_transport",
                        "a.tanggal like '%$tanggal%' and a.status_verif_ppk=1",
                        "a.id_spt");
            foreach($spt as $sptx){
                $pos = $this->model_sitas->rowDataBy("a.vol,a.satuan,a.harga_satuan,b.kd_detil,c.kd_subkomp,c.subkomp,
                            d.kd_komponen,e.kd_ro",
                            "a_subdetil9 a inner join a_detil8 b on a.id_detil=b.id_detil 
                                inner join a_subkomp7 c on b.id_subkomp=c.id_subkomp inner join a_komponen6 d on c.id_komponen = d.id_komponen
                                inner join a_ro5 e on d.id_ro = e.id_ro",
                            "a.id_subdetil = $sptx->id_subdetil")->row();
                array_push($arr_spt, array(
                        'id_spt' => $sptx->id_spt,
                        'id_surat_keluar' => $sptx->id_surat_keluar,
                        'id_subdetil' => $sptx->id_subdetil,
                        'untuk' => $sptx->untuk,
                        'lama_hari' => $sptx->lama_hari,
                        'id_transport' => $sptx->id_transport,
                        'ket_berangkat' => $sptx->ket_berangkat,
                        'ket_wilayah' => $sptx->ket_wilayah,
                        'tanggal' => $sptx->tanggal,
                        'pj' => $sptx->pj,
                        'no_sppd' => $sptx->no_sppd,
                        'verif_pj' => $sptx->verif_pj,
                        'status_verif_pa' => $sptx->status_verif_pa,
                        'status_verif_ppk' => $sptx->status_verif_ppk,
                        'keterangan' => $sptx->keterangan,
                        'keterangan_pa' => $sptx->keterangan_pa,
                        'keterangan_ppk' => $sptx->keterangan_ppk,
                        'transportasi' => $sptx->transportasi,
                        'vol' => $pos->vol,
                        'satuan' => $pos->satuan,
                        'harga_satuan' => $pos->harga_satuan,
                        'kd_detil' => $pos->kd_detil,
                        'kd_subkomp' => $pos->kd_subkomp,
                        'subkomp' => $pos->subkomp,
                        'kd_komponen' => $pos->kd_komponen,
                        'kd_ro' => $pos->kd_ro,
                        'pegawai' => $this->model_sitas->listDataBy("b.nama,b.nip,b.jabatan,b.gol",
                        "anggota_spt a inner join pegawai b on a.id_pegawai=b.id_pegawai","a.id_spt = $sptx->id_spt",
                        "a.id_anggota")
                    ));
            }
            $obj_list = json_decode(json_encode($arr_spt));
            $data['list'] = $obj_list;
            $data['transport'] = $this->model_sitas->listData("*","transportasi_spt","id_transport");
            $this->load->view('sitas/preview/pengajuan_spt_periode',$data);
            //print_r($obj_list);
        }
    }
}