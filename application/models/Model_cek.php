<?php 
class Model_cek extends CI_model{
    function hitung_jumlah_verif($a,$b,$c){
        if($a == 1){ $totala = 1; } else { $totala = 0;}
        if($b == 1){ $totalb = 1; } else { $totalb = 0;}
        if($c == 1){ $totalc = 1; } else { $totalc = 0;}
        $total = $totala + $totalb + $totalc;
        return $total;
    }
    function ambil_isi_p($x){
        $results = [];
        // Regex untuk menangkap elemen <p> dan <table>
        preg_match_all('/(<p.*?>.*?<\/p>|<table.*?>.*?<\/table>)/is', $x, $matches);
        // Iterasi setiap elemen hasil
        foreach ($matches[0] as $element) {
            // Cek jika elemen adalah <p>
            if (preg_match('/<p.*?>(.*?)<\/p>/is', $element, $pMatch)) {
                // Ambil konten dalam <p> dan hapus tag HTML lain
                $content = trim(strip_tags($pMatch[1]));
                $content = str_replace('&nbsp;', '', $content);

                // Jika ada teks, masukkan ke dalam array
                if (!empty($content)) {
                    $results[] = $content;
                }
            } 
            // Cek jika elemen adalah <table>
            elseif (preg_match('/<table.*?>.*?<\/table>/is', $element)) {
                // Tambahkan 'table' ke array untuk menandakan posisi
                $results[] = 'table';
            }
        }
        return $results;
    }
    function ambil_isi_table($x){
        $tabel = ""; // Variabel untuk menyimpan isi tabel
        // Regex untuk menangkap elemen <p> dan <table>
        preg_match_all('/(<p.*?>.*?<\/p>|<table.*?>.*?<\/table>)/is', $x, $matches);
        // Iterasi setiap elemen hasil
        foreach ($matches[0] as $element) {
            // Cek jika elemen adalah <table>
            if (preg_match('/<table.*?>.*?<\/table>/is', $element)) {
                // Simpan isi tabel ke variabel $tabel
                $tabel = $element;
            }
        }
        return $tabel;
    }
    function konversi_tbl_word($x){
        $table = strip_tags($x, '<td><tr>');
        // Memisahkan data berdasarkan baris <tr>
        $rows = explode('</tr>', $table);
        $tableData = [];
        foreach ($rows as $row) {
            // Mengabaikan baris kosong
            if (trim($row) === '') continue;
        
            // Memisahkan data berdasarkan kolom <td>
            $cols = explode('</td>', $row);
        
            // Mengambil data dari kolom pertama dan kolom ketiga
            if (count($cols) >= 3) {
                $key = trim(strip_tags($cols[0]));
                $penghubung = trim(strip_tags($cols[1]));
                $value = trim(strip_tags($cols[2]));
                $tableData[] = "$key#$penghubung#$value";
            }
        }
        return $tableData;        
    }
}