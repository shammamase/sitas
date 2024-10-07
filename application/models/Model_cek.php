<?php 
class Model_cek extends CI_model{
    function hitung_jumlah_verif($a,$b,$c){
        if($a == 1){ $totala = 1; } else { $totala = 0;}
        if($b == 1){ $totalb = 1; } else { $totalb = 0;}
        if($c == 1){ $totalc = 1; } else { $totalc = 0;}
        $total = $totala + $totalb + $totalc;
        return $total;
    }
}