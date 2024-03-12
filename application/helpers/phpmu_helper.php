<?php 
    function cetak($str){
        return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
    }

    function cetak_meta($str,$mulai,$selesai){
        return strip_tags(html_entity_decode(substr($str,$mulai,$selesai), ENT_COMPAT, 'UTF-8'));
    }

    function sensor($teks){
        $ci = & get_instance();
        $query = $ci->db->query("SELECT * FROM katajelek");
        foreach ($query->result_array() as $r) {
            $teks = str_replace($r['kata'], $r['ganti'], $teks);       
        }
        return $teks;
    }  

    function getSearchTermToBold($text, $words){
        preg_match_all('~[A-Za-z0-9_äöüÄÖÜ]+~', $words, $m);
        if (!$m)
            return $text;
        $re = '~(' . implode('|', $m[0]) . ')~i';
        return preg_replace($re, '<b style="color:red">$0</b>', $text);
    }

    function tgl_indo($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = getBulan(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $tanggal.' '.$bulan.' '.$tahun;       
    } 

    function tgl_indoo($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = getBulann(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $tanggal.' '.$bulan.' '.$tahun;       
    } 

    function tgl_simpan($tgl){
            $tanggal = substr($tgl,0,2);
            $bulan = substr($tgl,3,2);
            $tahun = substr($tgl,6,4);
            return $tahun.'-'.$bulan.'-'.$tanggal;       
    }

    function tgl_view($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = substr($tgl,5,2);
            $tahun = substr($tgl,0,4);
            return $tanggal.'-'.$bulan.'-'.$tahun;       
    }

    function tgl_grafik($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = getBulan(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $tanggal.'_'.$bulan;       
    }   

    function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    } 

    function hari_ini(){
        date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
        $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $hari = date("w");
        return $seminggu[$hari];
    }

    function seo_title($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }

    function getBulan($bln){
                switch ($bln){
                    case 1: 
                        return "Jan";
                        break;
                    case 2:
                        return "Feb";
                        break;
                    case 3:
                        return "Mar";
                        break;
                    case 4:
                        return "Apr";
                        break;
                    case 5:
                        return "Mei";
                        break;
                    case 6:
                        return "Jun";
                        break;
                    case 7:
                        return "Jul";
                        break;
                    case 8:
                        return "Agu";
                        break;
                    case 9:
                        return "Sep";
                        break;
                    case 10:
                        return "Okt";
                        break;
                    case 11:
                        return "Nov";
                        break;
                    case 12:
                        return "Des";
                        break;
                }
            } 

    function getBulann($bln){
                switch ($bln){
                    case 1: 
                        return "Januari";
                        break;
                    case 2:
                        return "Februari";
                        break;
                    case 3:
                        return "Maret";
                        break;
                    case 4:
                        return "April";
                        break;
                    case 5:
                        return "Mei";
                        break;
                    case 6:
                        return "Juni";
                        break;
                    case 7:
                        return "Juli";
                        break;
                    case 8:
                        return "Agustus";
                        break;
                    case 9:
                        return "September";
                        break;
                    case 10:
                        return "Oktober";
                        break;
                    case 11:
                        return "November";
                        break;
                    case 12:
                        return "Desember";
                        break;
                }
            }

function cek_terakhir($datetime, $full = false) {
	 $today = time();    
     $createdday= strtotime($datetime); 
     $datediff = abs($today - $createdday);  
     $difftext="";  
     $years = floor($datediff / (365*60*60*24));  
     $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
     $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
     $hours= floor($datediff/3600);  
     $minutes= floor($datediff/60);  
     $seconds= floor($datediff);  
     //year checker  
     if($difftext=="")  
     {  
       if($years>1)  
        $difftext=$years." Tahun";  
       elseif($years==1)  
        $difftext=$years." Tahun";  
     }  
     //month checker  
     if($difftext=="")  
     {  
        if($months>1)  
        $difftext=$months." Bulan";  
        elseif($months==1)  
        $difftext=$months." Bulan";  
     }  
     //month checker  
     if($difftext=="")  
     {  
        if($days>1)  
        $difftext=$days." Hari";  
        elseif($days==1)  
        $difftext=$days." Hari";  
     }  
     //hour checker  
     if($difftext=="")  
     {  
        if($hours>1)  
        $difftext=$hours." Jam";  
        elseif($hours==1)  
        $difftext=$hours." Jam";  
     }  
     //minutes checker  
     if($difftext=="")  
     {  
        if($minutes>1)  
        $difftext=$minutes." Menit";  
        elseif($minutes==1)  
        $difftext=$minutes." Menit";  
     }  
     //seconds checker  
     if($difftext=="")  
     {  
        if($seconds>1)  
        $difftext=$seconds." Detik";  
        elseif($seconds==1)  
        $difftext=$seconds." Detik";  
     }  
     return $difftext;  
	}

function _POST($par)
{
    $ci = &get_instance();
    $par = $ci->input->post($par);
    $par = htmlspecialchars($par);
    $par = str_replace("'", "", $par);
    return $par;
}

function _view($view, $data = array())
{
    $ci = &get_instance();
    $ci->load->view($view, $data);
}

function _GET($par)
{
    $ci = &get_instance();
    $par = $ci->input->get($par);
    $par = htmlspecialchars($par);
    $par = str_replace("'", "", $par);
    return $par;
}

function no_anggota_spt($tgl,$lama_hari){
    $ex_tgl = explode("-",$tgl);
    $jml_hari = cal_days_in_month(CAL_GREGORIAN, $ex_tgl[1], $ex_tgl[0]);
    $tglx = $ex_tgl[2];
    $tglz = substr($tglx,0,1);
    if($tglz==0){
        $tgly = substr($tglx,1,1);
    } else {
        $tgly = $tglx;
    }
    $tot_tgl = $tgly + $lama_hari;
    $tgln = "";
    $iis = 0;
    for($ii=$tgly; $ii<$tot_tgl; $ii++){
        if($ii > $jml_hari){
            $iis = $ii - $jml_hari;
            if(strlen($iis) != 1){
                $iisx = $iis;
            } else {
                $iisx = "0".$iis;
            }
            $bln = $ex_tgl[1] + 1;
            if(strlen($bln)==1){
                $blnx = "0".$bln;
            } else {
                $blnx = $bln;
            }
        } else {
            if(strlen($ii) != 1){
                $iisx = $ii;
            } else {
                $iisx = "0".$ii;
            }
            $blnx = $ex_tgl[1];
        }
        $tgln .= $ex_tgl[0]."-".$blnx."-".$iisx.",";
    }
    $tglm = substr($tgln,0,-1);
    return $tglm;
}
function get_kode_uniks($x){
    $kode = md5($x);
    $kode_fix = substr($kode,13,6);
    return $kode_fix;
}
function tgl_selesai($tgl_awal,$lama_hari){
    $tglx = explode("-",$tgl_awal);
    $jml_hari = cal_days_in_month(CAL_GREGORIAN, $tglx[1], $tglx[0]);
    $tgly = $tglx[2] + $lama_hari - 1;
    if($tgly > $jml_hari){
        $tglyy = $tgly - $jml_hari;
        $jml_tgly = strlen($tglyy);
        if($jml_tgly != 1){
            $tglyyy = $tglyy;
        } else {
            $tglyyy = "0".$tglyy;
        }
        
        $bln = $tglx[1] + 1;
        
        if(strlen($bln)==1){
            $blnx = "0".$bln;
        } else {
            $blnx = $bln;
        }
        $tgl_akhir = $tglx[0]."-".$blnx."-".$tglyyy;
    } else {
        $jml_tgly = strlen($tgly);
        if($jml_tgly != 1){
            $tglyy = $tgly;
        } else {
            $tglyy = "0".$tgly;
        }
        $bln = $tglx[1];
        $tgl_akhir = $tglx[0]."-".$bln."-".$tglyy;
    }
    
    return $tgl_akhir;
}

function sd_tgl($tgl_awal,$lama_hari){
    $tglx = explode("-",$tgl_awal);
    $jml_hari = cal_days_in_month(CAL_GREGORIAN, $tglx[1], $tglx[0]);
    $tgly = $tglx[2] + $lama_hari - 1;
    if($tgly > $jml_hari){
        $tglyy = $tgly - $jml_hari;
        $jml_tgly = strlen($tglyy);
        if($jml_tgly != 1){
            $tglyyy = $tglyy;
        } else {
            $tglyyy = "0".$tglyy;
        }
        
        $bln = $tglx[1] + 1;
        
        if(strlen($bln)==1){
            $blnx = "0".$bln;
        } else {
            $blnx = $bln;
        }
        $tgl_akhir = $tglx[0]."-".$blnx."-".$tglyyy;
        if($lama_hari > 1){
            $narasi = "pada tanggal ".tgl_indoo($tgl_awal)." s/d ".tgl_indoo($tgl_akhir);
        } else {
            $narasi = "tanggal ".tgl_indoo($tgl_akhir);
        }
    } else {
        $jml_tgly = strlen($tgly);
        if($jml_tgly != 1){
            $tglyy = $tgly;
        } else {
            $tglyy = "0".$tgly;
        }
        $bln = $tglx[1];
        $tgl_akhir = $tglx[0]."-".$bln."-".$tglyy;
        if($lama_hari > 1){
            $narasi = "pada tanggal ".$tglx[2]." s/d ".tgl_indoo($tgl_akhir);
        } else {
            $narasi = "tanggal ".tgl_indoo($tgl_akhir);
        }
    }
    
    return $narasi;
}

function sd_tgl2($tgl_awal,$lama_hari){
    $tglx = explode("-",$tgl_awal);
    $jml_hari = cal_days_in_month(CAL_GREGORIAN, $tglx[1], $tglx[0]);
    $tgly = $tglx[2] + $lama_hari - 1;
    if($tgly > $jml_hari){
        $tglyy = $tgly - $jml_hari;
        $jml_tgly = strlen($tglyy);
        if($jml_tgly != 1){
            $tglyyy = $tglyy;
        } else {
            $tglyyy = "0".$tglyy;
        }
        
        $bln = $tglx[1] + 1;
        
        if(strlen($bln)==1){
            $blnx = "0".$bln;
        } else {
            $blnx = $bln;
        }
        $tgl_akhir = $tglx[0]."-".$blnx."-".$tglyyy;
        $narasi = tgl_indoo($tgl_akhir);
    } else {
        $jml_tgly = strlen($tgly);
        if($jml_tgly != 1){
            $tglyy = $tgly;
        } else {
            $tglyy = "0".$tgly;
        }
        $bln = $tglx[1];
        $tgl_akhir = $tglx[0]."-".$bln."-".$tglyy;
        $narasi = tgl_indoo($tgl_akhir);
    }
    return $narasi;
}
function br_str($a){
    $c = substr($a,0,12);
    $d = substr($a,12,10);
    $hasil = $c."<br>".$d;
    return $hasil;
}
function angka_ke_huruf($angka) {
    $huruf = range('a', 'z');
    return isset($huruf[$angka - 1]) ? $huruf[$angka - 1] : null;
}
function clir_ul_li($x){
   $text = $x;
   $clir = trim($text);
   $ganti = str_replace("<ul>","",$clir);
   $ganti2 = str_replace("</ul>","",$ganti);
   $ganti3 = str_replace("<li>","",$ganti2);
   $ganti4 = str_replace("</li>","#",$ganti3);
   $ganti5 = substr($ganti4,0,-1);
   $arr = explode("#",$ganti5);
   return $arr;
}
function clir_ul($x){
    $text = $x;
    $clir = trim($text);
    $ganti = str_replace("<ul>","",$clir);
    $ganti2 = str_replace("</ul>","",$ganti);
    // Pisahkan data berdasarkan </li> dan hilangkan </li>
    $items = explode("</li>", $ganti2);
    // Hapus elemen terakhir dari $items karena itu hanya akan menjadi string kosong
    array_pop($items);
    // Tambahkan kembali </li> ke setiap elemen
    $items = array_map(function($item) {
        return $item . "</li>";
    }, $items);
    // Tambahkan tanda kutip ganda di awal dan akhir setiap elemen
    $items = array_map(function($item) {
        return "\"" . $item . "\"";
    }, $items);
    // Gabungkan kembali semua elemen menjadi satu string
    $result = implode(",", $items);
    return $result;
}
function pisah_nip($x){
    $a = substr($x,0,8);
    $b = substr($x,8,6);
    $c = substr($x,14,1);
    $d = substr($x,15,5);
    $e = $a." ".$b." ".$c." ".$d;
    return $e;
}
function konversi_nama_peg($x){
    $a = explode(",",$x);
    $jml = count($a) - 1;
    $aa = ucwords(strtolower($a[0]));
    $title = "";
    for($ii=1; $ii<=$jml; $ii++){
        $title .= $a[$ii].",";
    }
    $title_fix = substr($title,0,-1);
    $hasil = $aa.",".$title_fix;
    return $hasil;
}
// Fungsi untuk kompres gamber sebelum upload
function compressImage($source, $destination, $quality) {
    // mendapatkan info image
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime'];  
    // membuat image baru
    switch($mime){ 
    // proses kode memilih tipe tipe image 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
      
    // Menyimpan image dengan ukuran yang baru
    imagejpeg($image, $destination, $quality);       
    // Return image
    return $destination; 
}