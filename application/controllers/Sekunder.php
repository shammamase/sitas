<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sekunder extends CI_Controller {
    public function input_cuti_sebelum(){
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
                // (type,name,value,placeholder,label,option (for select),required/readonly)
                $data['forms'] = array(
                                        array("select","id_jenis_cuti","","Jenis Cuti","Jenis Cuti",$jn_cuti,"required"),
                                        array("textarea","alasan_cuti","","Masukkan Alasan Cuti","Masukkan Alasan Cuti","","required"),
                                        array("number","lama_cuti","","Lama Cuti","Lama Cuti","","required"),
                                        array("date","tgl_mulai",$tgl,"Tanggal Mulai","Tanggal Mulai","","required"),
                                        array("date","tgl_akhir",$tgl,"Tanggal Akhir","Tanggal Akhir","","required"),
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
                                        array("select","pejabat_atasan_langsung","","Atasan Langsung","Atasan Langsung",$atasan_selex,"required"),
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
			$data['aksi'] = array(array("","btn-sm","btn-primary","primer/buat_cuti/","<i class='fas fa-edit'></i>","Edit",""),
						array("margin-top:2px","btn-sm","btn-danger","primer/delete_cuti/","<i class='fas fa-trash-alt'></i>","Hapus","return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')"),
						array("","btn-sm","btn-warning","primer/cetak_cuti/","<i class='fas fa-file-pdf'></i>","PDF",""),
						array("","btn-sm","btn-success","primer/ajukan_cuti/","<i class='fas fa-share'></i>","Ajukan","")
						);   
            $this->template->load('sitas/template_form','sitas/view_ini',$data);
        }
    }
}
