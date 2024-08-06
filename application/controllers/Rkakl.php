<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rkakl extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('model_rkakl');
    }
	public function index(){
		echo "ini index";
	}


    public function awal_import_adk(){
        $file_dir = $this->model_rkakl->get_folder();
        if($file_dir['file1'] > $file_dir['file2']){
            redirect('rkakl/import_zip');
        } else {
            redirect('rkakl/import_adk');
        }
    }
    
    public function import_adk(){
        $file_dir = $this->model_rkakl->get_folder();
        if($file_dir['file1'] > $file_dir['file2']){
            redirect('rkakl/import_zip');
        } else {
            $this->load->view('rkakl/import_adk');
        }
    }
    
    public function import_zip(){
        $file_dir = $this->model_rkakl->get_folder();
        $files = scandir($file_dir['folder1'], SCANDIR_SORT_DESCENDING);
        // Ambil file terbaru
        $newestFile = reset($files);
        if($file_dir['file1'] > $file_dir['file2']){
            $data['nama_file'] = $newestFile;
            $data['unduh'] = $file_dir['folder1']."/".$newestFile;
            $this->load->view('rkakl/import_zip',$data);
        } else {
            redirect('rkakl/import_adk');
        }
    }
    
    public function proses_adk(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the file was uploaded without errors
            if (isset($_FILES["filex"]) && $_FILES["filex"]["error"] == 0) {
                $targetDir = "asset/file_lainnya/file_adk/";
                $targetFile = $targetDir . basename($_FILES["filex"]["name"]);
                
                // ambil ekstensi file
                //$fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
                $file_extension = pathinfo($targetFile, PATHINFO_EXTENSION);
                $huruf_awal = substr($file_extension,0,1);
                $ekor_thn = substr($file_extension,1,2);
                $panjang_ext = strlen($file_extension);
                //buat ekstensi jadi zip
                $fileType = ".zip";
                
                // jika panjang ekstensi 3 karakter
                if($panjang_ext == 3){
                    $rev_ke = "00_20".$ekor_thn;
                } else {
                    //ambil 2 digit dibelakang nama file asli untuk mendapatkan revisi keberapa
                    $rev_ke = substr($file_extension,-2)."_20".$ekor_thn;   
                }
                
                $newFileName = "revisi_".$rev_ke . $fileType;
                if($huruf_awal == "s"){
                    if (move_uploaded_file($_FILES["filex"]["tmp_name"], $targetFile)) {
                    rename($targetFile, $targetDir . $newFileName);
                    redirect('rkakl/import_zip');
                    } else {
                        echo "Maaf, terjadi kesalahan saat mengunggah file Anda";
                    }
                } else {
                    echo "Maaf yang diupload bukan file adk, silahkan coba lagi";
                }
            } else {
                echo "Terjadi kesalahan saat upload file";
            }
        }
    }
    
    public function proses_unzip(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_FILES["filex"]) && $_FILES["filex"]["error"] == 0) {
                $targetDir = "asset/file_lainnya/file_adk/";
                $targetFile = $targetDir . basename($_FILES["filex"]["name"]);
                $file_name = explode(" ",basename($_FILES["filex"]["name"]));
                $file_name_fix = $file_name[0];
                //hapus file awal di sini
                if (move_uploaded_file($_FILES["filex"]["tmp_name"], $targetFile)) {
                    rename($targetFile, $targetDir . $file_name_fix);
                    $zipFile = $targetDir . $file_name_fix;
                    $extractTo = 'asset/file_lainnya/hasil_unzip/';
                    // Membuka arsip ZIP
                        $zip = zip_open($zipFile);
                        
                        if ($zip) {
                            // Membaca setiap file dalam arsip
                            while ($zipEntry = zip_read($zip)) {
                                $entryName = zip_entry_name($zipEntry);
                                $entrySize = zip_entry_filesize($zipEntry);
                        
                                // Membuat direktori jika tidak ada
                                $entryPath = $extractTo . '/' . $entryName;
                                if (!is_dir(dirname($entryPath))) {
                                    mkdir(dirname($entryPath), 0755, true);
                                }
                        
                                // Mengekstrak file
                                if (zip_entry_open($zip, $zipEntry, "r")) {
                                    $fileContent = zip_entry_read($zipEntry, $entrySize);
                                    file_put_contents($entryPath, $fileContent);
                                    zip_entry_close($zipEntry);
                                }
                            }
                        
                            // Menutup arsip ZIP
                            zip_close($zip);
                            
                            echo "Files berhasil diekstrak.";
                        } else {
                            echo "Gagal membuka arsip ZIP.";
                        }
                    //echo "File " . $newFileName . " telah diupload";
                }
            }
        }
        redirect('rkakl/simulasi_proses');
    }
    
    public function selesai_import(){
        echo "Selesai";
    }
    
    public function simulasi_proses(){
        $get_rev = $this->model_rkakl->get_rev();
        $list = new SimpleXMLElement(base_url('asset/file_lainnya/hasil_unzip/'.$get_rev.'/d_item01809002375722.xml'), null, true);
        $list2 = new SimpleXMLElement(base_url('asset/file_lainnya/hasil_unzip/'.$get_rev.'/d_output01809002375722.xml'), null, true);
        $list3 = new SimpleXMLElement(base_url('asset/file_lainnya/hasil_unzip/'.$get_rev.'/d_soutput01809002375722.xml'), null, true);
        $list4 = new SimpleXMLElement(base_url('asset/file_lainnya/hasil_unzip/'.$get_rev.'/d_kmpnen01809002375722.xml'), null, true);
        $list5 = new SimpleXMLElement(base_url('asset/file_lainnya/hasil_unzip/'.$get_rev.'/d_skmpnen01809002375722.xml'), null, true);
        $list6 = new SimpleXMLElement(base_url('asset/file_lainnya/hasil_unzip/'.$get_rev.'/d_akun01809002375722.xml'), null, true);
        $ls_arr = array();
        $total_trs_alokasi = 0;
        foreach($list as $ls){
            //array_push($ls_arr,$ls->thang);
            $total_trs_alokasi += $ls->jumlah;
            $kd_program = $ls->kddept.".".$ls->kdunit.".".$ls->kdprogram;
            array_push($ls_arr,array('kd_program'=>$kd_program,'jml_program'=>$ls->jumlah,'thn'=>$ls->thang));
        }
        $thn_agri = $ls_arr[0]['thn'];
        $this->model_rkakl->save_trs_alokasi($total_trs_alokasi,$thn_agri);
        $last_ta_id = $this->db->insert_id();
        $totals_program = array();
        foreach($ls_arr as $fy){
            $kd_program = $fy['kd_program'];
            $jml_program = $fy['jml_program'];
            $prog = $this->db->query("select program from a_program2 where kd_program = '$kd_program'");
            $cek_prog = $prog->num_rows();
            if($cek_prog > 0){
                $progx = $prog->row();
                $lbl_program = $progx->program;
            } else {
                $lbl_program = "";
            }
            $found_program = false;
            foreach($totals_program as &$resultItem){
                if ($resultItem['kd_program'] === $kd_program) {
                    $resultItem['jml_program'] += $jml_program;
                    $found_program = true;
                    break;
                }
            }
            if (!$found_program) {
                array_push($totals_program,array('kd_program' => $kd_program, 'jml_program' => $jml_program, 'lbl_program' => $lbl_program));
            }
        }
        $this->model_rkakl->save_program($totals_program,$thn_agri);
        // aktivitas
        $fix = array();
        $fix_akt = array();
        foreach($list2 as $ls2){
            $kd_program2 = $ls2->kddept.".".$ls2->kdunit.".".$ls2->kdprogram."-".$ls2->kdgiat;
            array_push($fix,$kd_program2);
        }
        $fixx = array_unique($fix);
        foreach($fixx as $fx){
            $kd_aktivitas = explode("-",$fx);
            $akt = $this->db->query("select aktivitas from a_aktivitas3 where kd_aktivitas = '$kd_aktivitas[1]'")->row();
            array_push($fix_akt,array('kd_program'=>$kd_aktivitas[0],'kd_aktivitas'=>$kd_aktivitas[1],'aktivitas'=>$akt->aktivitas));
        }
        $this->model_rkakl->save_aktivitas($fix_akt,$thn_agri);
        // kro
        $fix_kro = array();
        foreach($list3 as $ls3){
            $kd_kro = $ls3->kdgiat.".".$ls3->kdoutput;
            array_push($fix_kro,array('kd_kro'=>$kd_kro,'vol'=>$ls3->volsout));
        }
        $totals_kro = array();
        foreach($fix_kro as $fy_kro){
            $kd_kro2 = $fy_kro['kd_kro'];
            $jml_kro = $fy_kro['vol'];
            $pc_kd = explode(".",$kd_kro2);
            $kro = $this->db->query("select kro from a_kro4 where kd_kro = '$kd_kro2'");
            $cek_kro = $kro->num_rows();
            if($cek_kro > 0){
                $krox = $kro->row();
                $lbl_kro = $krox->kro;
            } else {
                $lbl_kro = "";
            }
            $found_kro = false;
            foreach($totals_kro as &$resultItemKro){
                if ($resultItemKro['kd_kro'] === $kd_kro2) {
                    $resultItemKro['vol'] += $jml_kro;
                    $found_kro = true;
                    break;
                }
            }
            if (!$found_kro) {
                array_push($totals_kro,array('kd_aktivitas' => $pc_kd[0], 'kd_kro' => $kd_kro2, 'vol' => $jml_kro, 'lbl' => $lbl_kro));
            }
        }
        $this->model_rkakl->save_kro($totals_kro,$thn_agri);
        // ro
        $fix_ro = array();
        foreach($list3 as $ls31){
            $kd_kro3 = $ls31->kdgiat.".".$ls31->kdoutput;
            $kd_ro = $ls31->kdgiat.".".$ls31->kdoutput.".".$ls31->kdsoutput;
            array_push($fix_ro,array('kd_kro'=>$kd_kro3,'kd_ro'=>$kd_ro,'ro'=>$ls31->ursoutput,'vol'=>$ls31->volsout));
        }
        $this->model_rkakl->save_ro($fix_ro,$thn_agri);
        // komponen
        $fix_komponen = array();
        foreach($list4 as $ls4){
            $kd_ro2 = $ls4->kdgiat.".".$ls4->kdoutput.".".$ls4->kdsoutput;
            array_push($fix_komponen,array('kd_ro'=>$kd_ro2,'kd_komponen'=>$ls4->kdkmpnen,'komponen'=>$ls4->urkmpnen));
        }
        $this->model_rkakl->save_komponen($fix_komponen,$thn_agri);
        //subkomp
        $fix_subkomp = array();
        foreach($list5 as $ls5){
            $kd_ro3 = $ls5->kdgiat.".".$ls5->kdoutput.".".$ls5->kdsoutput;
            $kodex = $kd_ro3.".".$ls5->kdkmpnen.".".$ls5->kdskmpnen;
            array_push($fix_subkomp,array('kodex'=>$kodex,'kd_ro'=>$kd_ro3,'kd_komponen'=>$ls5->kdkmpnen,'kd_subkomp'=>$ls5->kdskmpnen,'subkomp'=>$ls5->urskmpnen));
        }
        $this->model_rkakl->save_subkomp($fix_subkomp,$thn_agri);
        //detil
        $ls_detil = array();
        foreach($list as $ls1){
            $kd_ro4 = $ls1->kdgiat.".".$ls1->kdoutput.".".$ls1->kdsoutput;
            $kodex2 = $kd_ro4.".".$ls1->kdkmpnen.".".$ls1->kdskmpnen.".".$ls1->kdakun;
            array_push($ls_detil,array('kodex'=>$kodex2,'kd_ro'=>$kd_ro4,'kd_komponen'=>$ls1->kdkmpnen,'kd_subkomp'=>$ls1->kdskmpnen,'kd_detil'=>$ls1->kdakun,'jumlah_biaya'=>$ls1->jumlah));
        }
        $totals_detil = array();
        foreach($ls_detil as $ldt){
            $kodex21 = $ldt['kodex'];
            $kd_ro41 = $ldt['kd_ro'];
            $kd_komponen = $ldt['kd_komponen'];
            $kd_subkomp = $ldt['kd_subkomp'];
            $kd_detil = $ldt['kd_detil'];
            $jml_detil = $ldt['jumlah_biaya'];
            $detil = $this->db->query("select detil from a_detil8 where kd_detil = '$kd_detil'");
            $cek_detil = $detil->num_rows();
            if($cek_detil > 0){
                $detx = $detil->row();
                $lbl_detil = $detx->detil;
            } else {
                $lbl_detil = "";
            }
            $found_detil = false;
            foreach($totals_detil as &$resultItemDetil){
                if ($resultItemDetil['kodex'] === $kodex21) {
                    $resultItemDetil['jumlah_biaya'] += $jml_detil;
                    $found_detil = true;
                    break;
                }
            }
            if (!$found_detil) {
                array_push($totals_detil,array('kodex' => $kodex21, 'kd_ro' => $kd_ro41, 'kd_komponen' => $kd_komponen, 'kd_subkomp' => $kd_subkomp, 'kd_detil' => $kd_detil, 'jumlah_biaya' => $jml_detil, 'detil' => $lbl_detil));
            }
        }
        $this->model_rkakl->save_detil($totals_detil,$thn_agri);
        //subdetil
        $fix_subdetil = array();
        foreach($list as $lsen){
            $kd_ro5 = $lsen->kdgiat.".".$lsen->kdoutput.".".$lsen->kdsoutput;
            $kodex3 = $kd_ro5.".".$lsen->kdkmpnen.".".$lsen->kdskmpnen.".".$lsen->kdakun;
            array_push($fix_subdetil,array('kodex'=>$kodex3,'kd_ro'=>$kd_ro5,'kd_komponen'=>$lsen->kdkmpnen,'kd_subkomp'=>$lsen->kdskmpnen,'kd_detil'=>$lsen->kdakun,'no_item'=>$lsen->noitem,'subdetil'=>$lsen->nmitem,'vol'=>$lsen->volkeg,'satuan'=>$lsen->satkeg,'harga_satuan'=>$lsen->hargasat));
        }
        $this->model_rkakl->save_subdetil($fix_subdetil,$thn_agri);
        $this->model_rkakl->isi_biaya_subkomp($thn_agri);
        $this->model_rkakl->isi_biaya_komponen($thn_agri);
        $this->model_rkakl->isi_biaya_ro($thn_agri);
        echo "OK<br>";
        //echo $totals_program[2]['kd_program'];
    }
    
}