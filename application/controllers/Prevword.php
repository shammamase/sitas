<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prevword extends CI_Controller {
    function tmpl_spt(){
        $uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        if(get_kode_uniks($uri4) == $uri3){
            $id_spt = $uri4;
            require_once 'vendor/autoload.php';
            $qw_spt = $this->model_sitas->rowDataBy("*","spt","id_surat_keluar=$id_spt")->row();
            $qw_sk = $this->model_sitas->rowDataBy("no_surat_keluar,id_verif","surat_keluar","id_surat_keluar=$id_spt")->row();
            $peg_spt = $this->model_sitas->listDataBy("a.id_pegawai,a.tanggal_spt,b.nama,b.pangkat,b.gol,b.nip,b.jabatan,b.uk,b.is_internal",
                        "anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai","a.id_spt=$qw_spt->id_spt","a.id_anggota asc");
            $awal_no_surat = "B-";
            $no_surat = $qw_sk->no_surat_keluar;
            $pc_tgl = explode("-",$qw_spt->tanggal_input);
            $bln = $pc_tgl[1];
            $thn = $pc_tgl[0];
            $narasi_tgl = sd_tgl($qw_spt->tanggal,$qw_spt->lama_hari);
            $arr_dasar = clir_ul_li($qw_spt->dasar);
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $sectionStyle = array(
                'orientation' => 'portrait',
                'marginTop' => 900,
                'marginLeft' => 300,
                'marginRight' => 200,
                'marginBottom' => 200,
                'pageSizeH' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(35.56),
                'pageSizeW' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(21.59)
            );
            $badanx = ['name' => 'Bookman Old Style', 'size' => 11];
            $badanxx = ['name' => 'Bookman Old Style', 'size' => 10];
            $badanCalibri = ['name' => 'Calibri', 'size' => 10];
            $headTbl2 = ['name' => 'Bookman Old Style', 'size' => 10, 'bold' => true];
            $justix = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH];
            $rata_tengah = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
            $section = $phpWord->addSection($sectionStyle);
            $header = $section->addHeader();
            $header->addImage('./asset/kop_surat1.png',array(
                                    'width'         => 580,
                                    //'height'         => 100,
                                    'marginTop'     => -2,
                                    //'marginLeft'    => -7,
                                    'alignment'     => 'left',
                                    'wrappingStyle' => 'behind'
                                ));
            $section->addText(
                'SURAT TUGAS',
                array('name' => 'Bookman Old Style', 'size' => 12, 'bold' => true, 'underline' => 'single'),
                array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
                'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.01))
            );
            $section->addText(
                'Nomor : '.$awal_no_surat.$no_surat.'/TU.040/H.4.2/'.$bln.'/'.$thn,
                array('name' => 'Bookman Old Style', 'size' => 11, 'bold' => true),
                array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
                    'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.01))
            );
            $section->addTextBreak(1);
            $tableStyle = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,'cellMarginLeft' => 120,'cellMarginRight' => 80];
            $tableStyle2 = ['borderSize' => 6,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,'cellMarginLeft' => 120,'cellMarginRight' => 80];
            $table = $section->addTable($tableStyle);
            $table->addRow();
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(4.95))->addText('Menimbang',$badanx);
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.76))->addText(':',$badanx);
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.09))->addText('a.',$badanx);
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(11.73))
            ->addText($qw_spt->menimbang,$badanx,$justix);
            $no_ds = 1;
            foreach($arr_dasar as $ads){
            if($no_ds == 1){
                $view_ds = "Dasar";
                $view_ds2 = ":";
            } else {
                $view_ds = "";
                $view_ds2 = "";
            }
            $table->addRow();
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(4.95))->addText($view_ds,$badanx);;
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.76))->addText($view_ds2,$badanx);
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.09))->addText(angka_ke_huruf($no_ds).'.',$badanx);
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(11.73))->addText(preg_replace('/\s+/', ' ', $ads),$badanx,$justix);
            $no_ds++;
            }
            /*
            if($qw_spt->is_dipa==1){
                $no_dipa = $no_ds;
                $table->addRow();
                $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(4.95))->addText('',$badanx);
                $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.76))->addText('',$badanx);
                $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.09))->addText(angka_ke_huruf($no_dipa).'.',$badanx);
                $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(11.73))->addText('DIPA BPSI TAS Tahun 2024 Nomor: 018.09.2.237572/2023, Tanggal  30 November 2023',$badanx,$justix);
            }
            */
            $table->addRow();
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(18.55),['gridSpan' => 4, 'valign' => 'bottom'])->addText('',$badanx,$rata_tengah);
            $table->addRow();
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(18.55),['gridSpan' => 4, 'valign' => 'bottom'])->addText('Memberi Tugas',$badanx,$rata_tengah);
            $table->addRow();
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(4.95))->addText('Kepada',$badanx);
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.76))->addText('',$badanx);
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.09))->addText('',$badanx);
            $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(11.73))->addText('',$badanx,$justix);
            $section->addTextBreak(1);
            $table2 = $section->addTable($tableStyle2);
            $table2->addRow();
            $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.02))->addText('No',$headTbl2,$rata_tengah);
            $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(3.97))->addText('Nama',$headTbl2,$rata_tengah);
            $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2.5))->addText('Pangkat/Gol Ruang',$headTbl2,$rata_tengah);
            $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(3.5))->addText('NIP',$headTbl2,$rata_tengah);
            $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2.61))->addText('Jabatan',$headTbl2,$rata_tengah);
            $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(4.64))->addText('Unit Kerja',$headTbl2,$rata_tengah);
            $no_pg = 1;
            foreach($peg_spt as $pg){
                if($pg->is_internal == 1){
                    $peg2 = $this->model_sitas->rowDataBy("pangkat,gol,nip,jabatan","pegawai","id_pegawai = $pg->id_pegawai")->row();
                    $pangkat = $peg2->pangkat;
                    $gol = $peg2->gol;
                    $nip = $peg2->nip;
                    $jabatan = $peg2->jabatan;
                } else {
                    $pangkat = $pg->pangkat;
                    $gol = $pg->gol;
                    $nip = $pg->nip;
                    $jabatan = $pg->jabatan;
                }
                $table2->addRow();
                $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.02))->addText($no_pg,$badanxx);
                $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(3.97))->addText(konversi_nama_peg($pg->nama),$badanxx);
                $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2.5))->addText(ucwords(strtolower($pangkat)).'/'.$gol,$badanxx);
                $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(3.5))->addText(pisah_nip($nip),$badanCalibri);
                $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2.61))->addText(ucwords(strtolower($jabatan)),$badanxx);
                $table2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(4.64))->addText($pg->uk,$badanxx);
                $no_pg++;
            }
            $section->addTextBreak(1);
            $table3 = $section->addTable($tableStyle);
            $table3->addRow();
            $table3->addCell(2500)->addText('Untuk',$badanx);
            $table3->addCell(375)->addText(':',$badanx);
            $table3->addCell(7650,['gridSpan' => 2])
            ->addText($qw_spt->untuk.' pada '.$narasi_tgl,$badanx,$justix);
            $section->addTextBreak(1);
            $table4 = $section->addTable($tableStyle);
            $table4->addRow();
            $table4->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(10))->addText('',$badanx);
            $tutup = $table4->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.03));
            $katax = $tutup->addTextRun();
            $katax->addText('Malang, '.tgl_indoo($qw_spt->tanggal_input),$badanx);
            $katax->addTextBreak();
            $katax->addText('Ditandatangani secara elektronik oleh',$badanx);
            $katax->addTextBreak();
            $katax->addText('${jabatan_pengirim}',$badanx);
            $katax->addTextBreak();
            $katax->addText('                       ',$badanx);
            $katax->addImage('./asset/bsre.png',array(
                'width'         => 70,
                'height'         => 34,
                'wrappingStyle'  => 'square'
            ));
            $katax->addTextBreak();
            $katax->addText('${ttd_pengirim}',$badanx);
            $katax->addTextBreak();
            $katax->addText('${nama_pengirim}',$badanx);
            $katax->addTextBreak();
            $katax->addText('NIP ${nip_pengirim}',$badanx);
            // Masukkan kode HTML Anda di sini
            /*
            $kop = "<img style='width:100%' src='".base_url()."asset/kop_surat.png'>";
            $htmlCode = "";
            $htmlCode .= "<img style='width:100%' src=''>";
            $htmlCode .= "<h1><b>Judul Utama</b></h1>";
            $htmlCode .= "<p><b>Tes</b></p>";
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, $htmlCode);
            */
            // Simpan sebagai dokumen Word
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save('asset/file_temp/myDocumentSPT.docx');
            redirect('asset/file_temp/myDocumentSPT.docx');
        } else {
            echo "Anda tidak mempunyai akses";
        }
    }

    function tes_jo(){
        $id_spt = $this->uri->segment(3);
        $qw_spt = $this->model_sitas->rowDataBy("*","spt","id_surat_keluar=$id_spt")->row();
        $tes = clir_ul_li($qw_spt->dasar);
        foreach($tes as $ts){
            echo $ts."<br>";
        }
        //$this->load->view('sitas/preview/tes_print');
    }
}