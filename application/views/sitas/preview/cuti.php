<?php 
if($bio->gol == ""){
    $nipx = "-";
} else {
    $nipx = $bio->nip;
}
?>
<table style='margin-top:5px;width:90%' border='0'>
    <tr>
        <td style="width:25%"></td>
        <td colspan="2"><b>PERATURAN BADAN KEPEGAWAIAN NEGARA</b></td>
        <td style="width:25%"></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2"><b>REPUBLIK INDONESIA</b></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2"><b>NOMOR 24 TAHUN 2017</b></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2"><b>TENTANG TATA CARA PEMBERIAN CUTI PEGAWAI NEGERI SIPIL</b></td>
        <td></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td style="width:25%">&nbsp;</td>
        <td style="width:25%">&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align:right">Malang, <?= tgl_indoo($data->tgl_input) ?></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align:left">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Kepada</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align:left">Yth. Kepala BPSIP Jawa Timur</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align:left">Melalui Kasubag Tata Usaha</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align:left">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Di</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align:left">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Malang</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr><td colspan="4" style="text-align:center"><b>FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</b></td></tr>
</table>
<table style='margin-left:10px;margin-top:5px;width:95%;border-collapse:collapse' border='1'>
    <tr><td colspan="4"><b>I. DATA PEGAWAI</b></td></tr>
    <tr>
        <td style="width:10%">&nbsp;Nama</td>
        <td style="width:40%">&nbsp;<?= $bio->nama ?></td>
        <td style="width:10%">&nbsp;NIP</td>
        <td style="width:40%">&nbsp;<?= $nipx ?></td>
    </tr>
    <tr>
        <td>&nbsp;Jabatan</td>
        <td>&nbsp;<?= $bio->jabatan ?></td>
        <td>Masa Kerja</td>
        <td>&nbsp;-</td>
    </tr>
    <tr>
        <td>&nbsp;Unit Kerja</td>
        <td colspan="3">&nbsp;<?= $bio->unit_kerja ?></td>
    </tr>
</table>
<table style='margin-left:10px;margin-top:10px;width:95%;border-collapse:collapse' border='1'>
    <tr><td colspan="4"><b>II. JENIS CUTI YANG DIAMBIL</b></td></tr>
    <tr>
        <td style="width:40%">&nbsp;1. Cuti Tahunan</td>
        <td style="width:10%;text-align:center">
            <?php if($data->id_jenis_cuti == 1){ echo "v"; } ?>
        </td>
        <td style="width:40%">&nbsp;2. Cuti Besar</td>
        <td style="width:10%;text-align:center"><?php if($data->id_jenis_cuti == 2){ echo "v"; } ?></td>
    </tr>
    <tr>
        <td>&nbsp;3. Cuti Sakit</td>
        <td style="text-align:center"><?php if($data->id_jenis_cuti == 3){ echo "v"; } ?></td>
        <td>4. Cuti Melahirkan</td>
        <td style="text-align:center"><?php if($data->id_jenis_cuti == 4){ echo "v"; } ?></td>
    </tr>
    <tr>
        <td>&nbsp;5. Cuti Karena Alasan Penting</td>
        <td style="text-align:center"><?php if($data->id_jenis_cuti == 5){ echo "v"; } ?></td>
        <td>6. Cuti diluar Tanggungan Negara</td>
        <td style="text-align:center"><?php if($data->id_jenis_cuti == 6){ echo "v"; } ?></td>
    </tr>
</table>
<table style='margin-left:10px;margin-top:10px;width:95%;border-collapse:collapse' border='1'>
    <tr><td colspan="4"><b>III. ALASAN CUTI</b></td></tr>
    <tr>
        <td colspan="4" style="width:100%;text-align:center">&nbsp;<?= wordwrap($data->alasan_cuti,50,"<br>") ?></td>
    </tr>
</table>
<table style='margin-left:10px;margin-top:10px;width:95%;border-collapse:collapse' border='1'>
    <tr><td colspan="8"><b>IV. LAMANYA CUTI</b></td></tr>
    <tr>
        <td style="text-align:center;width:10%">Selama</td>
        <td style="text-align:center;width:18%">(hari/bulan/tahun)*</td>
        <td style="text-align:center;width:15%">mulai tanggal</td>
        <td style="text-align:center;width:20%"><?= tgl_indo($data->tgl_mulai) ?></td>
        <td style="text-align:center;width:5%">s/d</td>
        <td style="text-align:center;width:20%"><?= tgl_indo($data->tgl_akhir) ?></td>
        <td style="text-align:center;width:7%"><?= $data->lama_cuti ?></td>
        <td style="text-align:center;width:5%">Hari</td>
    </tr>
</table>
<table style='margin-left:10px;margin-top:10px;width:95%;border-collapse:collapse' border='1'>
    <tr><td colspan="5"><b>V. CATATAN CUTI</b></td></tr>
    <tr>
        <td colspan="3">1. CUTI TAHUNAN</td>
        <td style="width:35%">2. CUTI BESAR</td>
        <td style="width:34%"></td>
    </tr>
    <tr>
        <td>Tahun</td>
        <td>Sisa</td>
        <td>Keterangan</td>
        <td>3. CUTI SAKIT</td>
        <td></td>
    </tr>
    <tr>
        <td>N-2</td>
        <td style="width:10%;text-align:center"><?= $n_2 ?> hari</td>
        <td></td>
        <td>4. CUTI MELAHIRKAN</td>
        <td></td>
    </tr>
    <tr>
        <td>N-1</td>
        <td style="width:10%;text-align:center"><?= $n_1 ?> hari</td>
        <td></td>
        <td>5. CUTI KARENA ALASAN PENTING</td>
        <td></td>
    </tr>
    <tr>
        <td style="width:10%">N</td>
        <td style="width:10%;text-align:center"><?= $n ?> hari</td>
        <td style="width:10%"></td>
        <td>6. CUTI DILUAR TANGGUNGAN NEGARA</td>
        <td></td>
    </tr>
</table>
<table style='margin-left:10px;margin-top:10px;width:95%;border-collapse:collapse' border='1'>
    <tr><td colspan="3"><b>VI. ALAMAT SELAMA MENJALANKAN CUTI</b></td></tr>
    <tr>
        <td style="width:40%">&nbsp;</td>
        <td style="width:10%">Telp</td>
        <td style="width:50%"><?= $bio->no_hp ?></td>
    </tr>
    <tr>
        <td style="height:5%;vertical-align:top"><?= wordwrap($data->alamat_cuti,25,"<br>") ?></td>
        <td style="text-align:center" colspan="2">
            Hormat saya,<br><br><br><br><u><?= $bio->nama ?></u><br>NIP.<?= $nipx ?>
        </td>
    </tr>
</table>
<table style='margin-left:10px;margin-top:10px;width:95%;border-collapse:collapse' border='1'>
    <tr><td colspan="4"><b>VII. PERTIMBANGAN ATASAN LANGSUNG</b></td></tr>
    <tr>
        <td style="width:20%">DISETUJUI</td>
        <td style="width:20%">PERUBAHAN</td>
        <td style="width:20%">DITANGGUHKAN</td>
        <td style="width:40%">TIDAK DISETUJUI</td>
    </tr>
    <tr>
        <td style="text-align:center"><?php if($data->verif_atasan_langsung == 1){ echo "v"; } ?></td>
        <td style="text-align:center"><?php if($data->verif_atasan_langsung == 2){ echo "v"; } ?></td>
        <td style="text-align:center"><?php if($data->verif_atasan_langsung == 3){ echo "v"; } ?></td>
        <td style="text-align:center"><?php if($data->verif_atasan_langsung == 4){ echo "v"; } ?></td>
    </tr>
    <tr>
        <td colspan="3" style="height:5%;vertical-align:top"></td>
        <td style="text-align:center">
            Atasan Langsung<br><br><br><br><br><u><?= $atasan_langsung->nama ?></u><br>NIP.<?= $atasan_langsung->nip ?>
        </td>
    </tr>
</table>
<table style='margin-left:10px;margin-top:10px;width:95%;border-collapse:collapse' border='1'>
    <tr><td colspan="4"><b>VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI</b></td></tr>
    <tr>
        <td style="width:20%">DISETUJUI</td>
        <td style="width:20%">PERUBAHAN</td>
        <td style="width:20%">DITANGGUHKAN</td>
        <td style="width:40%">TIDAK DISETUJUI</td>
    </tr>
    <tr>
        <td style="text-align:center">v</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td colspan="3" style="height:5%;vertical-align:middle;text-align:center">
        <?php if($data->verif_atasan_langsung == 1){ ?>
        <img style="height:100px;width:auto" src="<?= base_url() ?>assets/qr_code/cuti_<?= $data->id_cuti ?>.png">
        <?php } ?>
        </td>
        <td style="text-align:center">
            Keputusan Pejabat<br>Berwenang Memberikan Cuti<br><br><br><br><br><u><?= $atasan->nama ?></u><br>NIP.<?= $atasan->nip ?>
        </td>
    </tr>
</table>