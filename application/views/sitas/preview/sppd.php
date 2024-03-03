<?php 
$no = $data->no_sppd;
$pc_tgl_sppd = explode("-",$data->tgl_sppd);
$tgl_sampai_sppd = $data->lama_hari+1;
foreach($list as $ls){ 
    if($no == 0){
        $no = "-";
    }
    if($ls->is_internal==1){
        $row_pg = $this->model_sitas->rowDataBy("nama,pangkat,gol,jabatan","pegawai","id_pegawai=$ls->id_pegawai")->row();
        $nama = $row_pg->nama;
        $pangkat_gol = $row_pg->pangkat."/".$row_pg->gol;
        $jabatan = $row_pg->jabatan;
    } else {
        $nama = $ls->nama;
        $pangkat_gol = $ls->pangkat."/".$ls->gol;
        $jabatan = $ls->jabatan;
    }
?>
<table style='margin-left:5%;width:90%;border-collapse:collapse'>
    <tr style="border:1px solid"><td style='width:60%'>BADAN STANDARDISASI INSTRUMEN PERTANIAN</td><td colspan="3" style='width:40%;border-bottom:1px solid'></td></tr>
    <tr style="border:1px solid"><td style="border-right:1px solid;font-size:9pt"><b>BALAI PENGUJIAN STANDAR INSTRUMEN TANAMAN PEMANIS DAN SERAT</b>&nbsp;</td><td style="border-right:1px solid" colspan="3">PERATURAN MENTERI KEUANGAN</td></tr>
    <tr style="border:1px solid"><td style="border-right:1px solid">Jalan Raya Karangploso KM.4</td><td style="border-right:1px solid" colspan="3">REPUBLIK INDONESIA</td></tr>
    <tr style="border-right:1px solid"><td style="border-right:1px solid">Kode Pos : 188, Malang 65101</td><td style="border-right:1px solid" colspan="3">NOMOR 113/PMK.05/12 TENTANG</td></tr>
    <tr style="border-right:1px solid"><td style="border-right:1px solid"></td><td style="border-right:1px solid" colspan="3">PERJALANAN DINAS JABATAN</td></tr>
    <tr style="border-right:1px solid"><td style="border-right:1px solid"></td><td style="border-right:1px solid" colspan="3">DALAM NEGERI BAGI PEJABAT NEGARA,</td></tr>
    <tr style="border-right:1px solid"><td style="border-right:1px solid"></td><td style="border-right:1px solid" colspan="3">PEGAWAI NEGERI, DAN PEGAWAI </td></tr>
    <tr style="border-right:1px solid"><td style="border-right:1px solid"></td><td style="border-right:1px solid;border-bottom:1px solid" colspan="3">TIDAK TETAP</td></tr>
    <tr><td></td><td>Kode No.</td><td>:</td><td>KU.140/H.12.15/<?= $pc_tgl_sppd[1] ?>/<?= $pc_tgl_sppd[0] ?></td></tr>
    <tr><td></td><td>Nomor</td><td>:</td><td><?= $no ?></td></tr>
</table>
<h3 style='text-align:center'>SURAT PERJALANAN DINAS (SPD)</h3>
<table style='margin-left:5%;width:90%;border-collapse:collapse' border='1'>
    <tr>
        <td style='padding:10px'>1. </td>
        <td style='padding:10px'>Pejabat Pembuat Komitmen</td>
        <td style='padding:10px'>Balai Pengujian Standar Instrumen Tanaman Pemanis<br> dan Serat (BPSI TAS)</td>
    </tr>
    <tr>
        <td style='padding:10px'>2. </td>
        <td style='padding:10px'>Nama/NIP Pegawai yang melaksanakan<br>perjalanan dinas</td>
        <td style='padding:10px'><?= $nama ?></td>
    </tr>
    <tr>
        <td style='padding:10px'>3. </td>
        <td style='padding:10px'>a. Pangkat dan Golongan<br>b. Jabatan/Instansi<br>c. Tingkat Biaya Perjalanan Dinas</td>
        <td style='padding:10px'>a. <?= $pangkat_gol ?><br>b. <?= wordwrap($jabatan,30,"<br />\n") ?> <br>c. Gol C<br></td>
    </tr>
    <tr>
        <td style='padding:10px'>4. </td>
        <td style='padding:10px'>Maksud Perjalanan Dinas</td>
        <td style='padding:10px;'><?= wordwrap($data->untuk,50,"<br>") ?></td>
    </tr>
    <tr>
        <td style='padding:10px'>5. </td>
        <td style='padding:10px'>Alat angkutan yang dipergunakan</td>
        <td style='padding:10px'><?= $data->kendaraan ?></td>
    </tr>
    <tr>
        <td style='padding:10px'>6. </td>
        <td style='padding:10px'>a. Tempat Berangkat<br>b. Tempat Tujuan</td>
        <td style='padding:10px'>a. <?= wordwrap($data->ket_berangkat,20,"<br />\n") ?><br>b. <?= wordwrap($data->ket_wilayah,20,"<br />\n") ?></td>
    </tr>
    <tr>
        <td style='padding:10px'>7. </td>
        <td style='padding:10px'>a. Lamanya perjalanan dinas<br>b. Tanggal Berangkat<br>c. Tanggal harus kembali/tiba ditempat baru *)</td>
        <td style='padding:10px'>a. <?= $data->lama_hari ?> HOK<br>b. <?= tgl_indoo($data->tanggal) ?> <br>c. <?= sd_tgl2($data->tanggal,$data->lama_hari) ?></td>
    </tr>
    <tr>
        <td style='padding:10px'>8. </td>
        <td style='padding:10px'>Pengikut : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nama</td>
        <td style='padding:10px'>Tanggal Lahir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Keterangan</td>
    </tr>
    <tr>
        <td style='padding:10px'> </td>
        <td style='padding:10px'> </td>
        <td style='padding:10px'> </td>
    </tr>
    <tr>
        <td style='padding:10px'></td>
        <td style='padding:10px'>1. <br>2. <br>3. <br>4. <br>5. </td>
        <td style='padding:10px'> </td>
    </tr>
    <tr>
        <td style='padding:10px'>9. </td>
        <td style='padding:10px;font-size:12px'>Pembebanan Anggaran :<br>a. Instansi/Satker<br> b. Akun</td>
        <td style='padding:10px;font-size:12px'><br>a.<?= wordwrap($data->instansi_pembiayaan,60,"<br />\n") ?><br> b.  <?= $data->kode_pembiayaan ?></td>
    </tr>
    <tr>
        <td style='padding:10px'>10. </td>
        <td style='padding:10px'>Keterangan Lain-lain</td>
        <td style='padding:10px'> SPT No. B-<?= $no_surat_keluar ?>/TU.040/H.12.15/<?= $bulan_surat_keluar ?>/<?= $tahun_surat_keluar ?> tanggal <br> <?= tgl_indoo($tanggal_surat_keluar) ?></td>
    </tr>
</table>
<table style='margin-left:5%;width:90%' border='0'>
    <tr><td style='width:60%'> </td><td style='width:20%'>Dikeluarkan di</td><td style='width:2%'>:</td><td style='width:18%'> Malang </td></tr>
    <tr><td> </td><td>Pada tanggal</td><td>:</td><td> <?= tgl_indoo($data->tgl_sppd) ?> </td></tr>
    <tr><td style='height:10px'> </td><td> </td><td> </td><td> </td></tr>
    <tr><td> </td><td colspan='3'> </td></tr>
    <tr><td> </td><td colspan='3'> <b>Pejabat Pembuat Komitmen</b></td></tr>
    <tr><td style='height:60px'> </td><td colspan='3'> </td></tr>
    <tr><td> </td><td colspan='3'> <b><?= $nama_ppk ?></b></td></tr>
    <tr><td> </td><td colspan='3'> NIP. <?= $nip_ppk ?></td></tr>
</table>
<div style='page-break-after:always; clear:both'></div>
<hr/>
<table style='margin-left:5%;width:90%' border='0'>
    <tr><td style='width:25%'></td><td style='width:5%'>I. </td><td style='width:20%'>Berangkat dari </td><td style='width:2%'>:</td><td style='width:33%'> <?= wordwrap($data->ket_berangkat,20,"<br />\n") ?> </td><td style='width:15%'>&nbsp;</td></tr>
    <tr><td></td><td> </td><td style='width:20%'>(Tempat kedudukan) </td><td style='width:2%'></td><td style='width:33%'></td><td style='width:15%'>&nbsp;</td></tr>
    <tr><td></td><td> </td><td>Ke </td><td>:</td><td><?= wordwrap($data->ket_wilayah,20,"<br />\n") ?></td><td></td></tr>
    <tr><td></td><td> </td><td>Pada tanggal</td><td>:</td><td><?= tgl_indoo($data->tanggal) ?> </td><td></td></tr>
    <tr><td></td><td> </td><td colspan="3" style="text-align:center"><b>Pejabat Pembuat Komitmen</b></td><td></td></tr>
    <tr><td></td><td style='height:50px'> </td><td colspan='4'> </td></tr>
    <tr><td></td><td> </td><td colspan="3" style="text-align:center"><b><?= $nama_ppk ?></b></td><td></td></tr>
    <tr><td></td><td> </td><td colspan="3" style="text-align:center"><b>NIP. <?= $nip_ppk ?></b></td><td></td></tr>
</table>
<hr/>
<table style='margin-left:5%;width:90%' border='0'>
    <tr><td style='width:3%'>II. </td><td style='width:10%'>Tiba di</td><td style='width:2%'>:</td><td style='width:32%'><?= wordwrap($data->ket_wilayah,20,"<br />\n") ?></td><td style='width:20%'>Berangkat dari </td><td style='width:2%'>:</td><td style='width:28%'> <?= wordwrap($data->ket_wilayah,20,"<br />\n") ?> </td></tr>
    <tr><td></td><td>Pada Tanggal</td><td>:</td><td><?= tgl_indoo($data->tanggal) ?></td><td>Ke </td><td>:</td><td> <?= wordwrap($data->ket_berangkat,20,"<br />\n") ?> </td></tr>
    <tr><td></td><td>Kepala</td><td>:</td><td><?= $data->instansi_tujuan ?></td><td>Tanggal </td><td>:</td><td><?= sd_tgl2($data->tanggal,$data->lama_hari) ?> </td></tr>
    <tr><td></td><td></td><td></td><td> </td><td>Kepala </td><td>:</td><td><?= $data->instansi_tujuan ?> </td></tr>
    <tr><td></td><td style='height:50px'></td><td></td><td> </td><td></td><td></td><td></td></tr>
    <tr><td></td><td></td><td></td><td><?= $data->nama_ttd_instansi_tujuan ?></td><td></td><td></td><td><?= $data->nama_ttd_instansi_tujuan ?></td></tr>
    <tr><td></td><td></td><td></td><td>NIP. <?= $data->nip_ttd_instansi_tujuan ?></td><td></td><td></td><td>NIP. <?= $data->nip_ttd_instansi_tujuan ?></td></tr>
</table>
<hr/>
<table style='margin-left:5%;width:90%' border='0'>
    <tr><td style='width:3%'>III. </td><td style='width:10%'>Tiba di</td><td style='width:2%'>:</td><td style='width:32%'></td><td style='width:20%'>Berangkat dari </td><td style='width:2%'>:</td><td style='width:28%'>  </td></tr>
    <tr><td></td><td>Pada Tanggal</td><td>:</td><td></td><td>Ke </td><td>:</td><td> </td></tr>
    <tr><td></td><td>Kepala/Ketua</td><td>:</td><td> </td><td>Pada Tanggal </td><td>:</td><td></td></tr>
    <tr><td></td><td></td><td></td><td> </td><td>Kepala/Ketua </td><td>:</td><td> </td></tr>
    <tr><td></td><td style='height:50px'></td><td></td><td> </td><td></td><td></td><td></td></tr>
</table>
<hr/>
<table style='margin-left:5%;width:90%' border='0'>
    <tr><td style='width:3%'>IV. </td><td style='width:10%'>Tiba di</td><td style='width:2%'>:</td><td style='width:32%'></td><td style='width:20%'>Berangkat dari </td><td style='width:2%'>:</td><td style='width:28%'>  </td></tr>
    <tr><td></td><td>Pada Tanggal</td><td>:</td><td></td><td>Ke </td><td>:</td><td> </td></tr>
    <tr><td></td><td>Kepala/Ketua</td><td>:</td><td> </td><td>Pada Tanggal </td><td>:</td><td></td></tr>
    <tr><td></td><td></td><td></td><td> </td><td>Kepala/Ketua </td><td>:</td><td> </td></tr>
    <tr><td></td><td style='height:50px'></td><td></td><td> </td><td></td><td></td><td></td></tr>
</table>
<hr/>
<table style='margin-left:5%;width:90%' border='0'>
    <tr><td style='width:3%'>V. </td><td style='width:10%'>Tiba di</td><td style='width:2%'>:</td><td style='width:32%'></td><td style='width:20%'>Berangkat dari </td><td style='width:2%'>:</td><td style='width:28%'>  </td></tr>
    <tr><td></td><td>Pada Tanggal</td><td>:</td><td></td><td>Ke </td><td>:</td><td> </td></tr>
    <tr><td></td><td>Kepala/Ketua</td><td>:</td><td> </td><td>Pada Tanggal </td><td>:</td><td></td></tr>
    <tr><td></td><td></td><td></td><td> </td><td>Kepala/Ketua </td><td>:</td><td> </td></tr>
    <tr><td></td><td style='height:50px'></td><td></td><td> </td><td></td><td></td><td></td></tr>
</table>
<hr/>
<table style='margin-left:5%;width:90%' border='0'>
    <tr><td style='width:3%;vertical-align:top'>VI. </td><td style='width:10%;vertical-align:top'>Tiba di</td><td style='width:2%;vertical-align:top'>:</td><td style='width:32%;vertical-align:top'> <?= wordwrap($data->ket_berangkat,20,"<br />\n") ?> </td><td colspan='3' rowspan='3' style='width:50%;text-align:justify'>Telah diperiksa dengan keterangan bahwa perjalanan tersebut diatas benar dilaksanakan atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya</td></tr>
    <tr><td></td><td>Pada Tanggal</td><td>:</td><td><?= sd_tgl2($data->tanggal,$tgl_sampai_sppd) ?></td></tr>
    <tr><td></td><td>&nbsp;</td><td></td><td> &nbsp;</td></tr>
    <tr><td></td><td></td><td></td><td> <b>Pejabat Pembuat Komitmen</b> </td><td colspan='3' style='text-align:center'>&nbsp;</td></tr>
    <tr><td colspan='4'></td><td colspan='3' style='text-align:center'><b>Pejabat Pembuat Komitmen</b></td></tr>
    <tr><td></td><td style='height:60px'></td><td></td><td> </td><td></td><td></td><td></td></tr>
    <tr><td></td><td></td><td></td><td>  <b><?= $nama_ppk ?></b> </td><td colspan='3' style='text-align:center'> <b><?= $nama_ppk ?></b></td></tr>
    <tr><td></td><td></td><td></td><td>  NIP. <?= $nip_ppk ?> </td><td colspan='3' style='text-align:center'> NIP. <?= $nip_ppk ?></td></tr>
</table>
<hr/>
<table style='margin-left:5%;width:90%' border='0'>
    <tr><td style='width:3%;vertical-align:top'>VI. </td><td colspan='6'>Catatan Lain-lain</td></tr>
</table>
<hr/>
<table style='margin-left:5%;width:90%' border='0'>
    <tr><td style='width:3%;vertical-align:top'>VII.</td><td style="width:97%" colspan='6'>PERHATIAN :</td></tr>
    <tr><td></td><td colspan="6" style='vertical-align:top'>PPK menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal <br>
    berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan Keuangan<br>
    Negara apabila negara menderita rugi akibat kesalahan, kelalaian, dan kealpaannya</td></tr>
</table>
<div style='page-break-after:always; clear:both'></div>
<?php 
$no++;
} 
?>