<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print</title>
  <style>
    /* CSS untuk media print */
    @media print {
      .page-break {
        page-break-before: always; /* Memulai halaman baru sebelum elemen ini */
      }

      /* Opsional: Sembunyikan elemen tertentu di print */
      .no-print {
        display: none;
      }
    }
    p{
        font-size:12px;
    }
    table{
        font-size:12px;
    }
  </style>
</head>
<body>
<?php foreach($list as $ls) { ?>
<div><img style="width:100%" src="<?php echo base_url().'asset/kop_surat1.png' ?>"></div>
<p style="text-align:center;margin-top:-10px"><b>PENGAJUAN PERJALANAN DINAS</b></p>
<table>
    <tr>
        <td style="vertical-align:top">Anggaran Kegiatan</td>
        <td style="vertical-align:top">:</td>
        <td style="vertical-align:top"><b><?= $ls->subkomp ?></b></td>
    </tr>
    <tr>
        <td style="vertical-align:top">Kode POS</td>
        <td style="vertical-align:top">:</td>
        <td style="vertical-align:top">
            <b><?= $ls->kd_ro.".".$ls->kd_komponen.".".$ls->kd_subkomp.".".$ls->kd_detil ?></b>
        </td>
    </tr>
</table>
<table style='margin-left:10px;margin-top:0px;width:95%;border-collapse:collapse' border='1'>
    <tr>
        <td style="text-align:center">No</td>
        <td style="text-align:center">No<br>SPPD</td>
        <td style="text-align:center">Nama</td>
        <td style="text-align:center">NIP</td>
        <td style="text-align:center">Jabatan</td>
        <td style="text-align:center">Gol</td>
        <td style="text-align:center">&nbsp;&nbsp;&nbsp;TTD&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <?php $no_sppd = $ls->no_sppd; $no = 1;foreach($ls->pegawai as $peg){ ?>
    <tr>
        <td><?= $no ?></td>
        <td><?= $no_sppd ?></td>
        <td><?= $peg->nama ?></td>
        <td><?= $peg->nip ?></td>
        <td><?= $peg->jabatan ?></td>
        <td><?= $peg->gol ?></td>
        <td></td>
    </tr>
    <?php 
        $no++;
        if($ls->no_sppd != 0){
            $no_sppd++;
        } 
        } 
    ?>
</table>
<table style='margin-left:10px;margin-top:5px;width:95%;border-collapse:collapse' border='1'>
    <tr>
        <td style="text-align:center">Tempat<br>Berangkat</td>
        <td style="text-align:center">Tanggal<br>Berangkat</td>
        <td style="text-align:center">Tanggal<br>Kembali</td>
        <td style="text-align:center">Lama<br>Perjalanan</td>
        <td style="text-align:center">Tempat<br>Tujuan</td>
        <td style="text-align:center">Transport</td>
    </tr>
    <tr>
        <td><?= $ls->ket_berangkat ?></td>
        <td><?= tgl_indoo($ls->tanggal) ?></td>
        <td><?= sd_tgl2($ls->tanggal,$ls->lama_hari) ?></td>
        <td><?= $ls->lama_hari ?> HK</td>
        <td><?= $ls->ket_wilayah ?></td>
        <td>
            <table style="margin-top:10px;margin-left:10px;margin-bottom:10px;border-collapse:collapse">
                <?php 
                    foreach ($transport as $trsp){ 
                        if($ls->id_transport==$trsp->id_transport){
                            $bg_cl = "#000000";
                        } else {
                            $bg_cl = "#ffffff";
                        }
                ?>
                    <tr>
                        <td style="border:1px solid black;background-color:<?= $bg_cl ?>">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                        <td>&nbsp;</td>
                        <td><?= $trsp->transportasi ?></td>
                    </tr>
                <?php 
                    } 
                ?>
            </table>
        </td>
    </tr>
</table>
<table style='margin-left:10px;margin-top:5px;width:95%;border-collapse:collapse' border='1'>
    <tr>
        <td style="text-align:center">Mengetahui :</td>
        <td style="text-align:center" colspan="4">Disetujui oleh :</td>
    </tr>
    <tr>
        <td style="text-align:center">Kepala Sub Bag Tata<br>Usaha</td>
        <td style="text-align:center">PJ Kegiatan</td>
        <td style="text-align:center">Pengendali Anggaran</td>
        <td style="text-align:center">PPK</td>
        <td style="text-align:center">Kepala Balai</td>
    </tr>
    <tr>
        <td style="height:60px"></td>
        <td></td>
        <td></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align:center" colspan="5">Maksud Perjalanan</td>
    </tr>
    <tr>
        <td style="text-align:center" colspan="5">
        <b><i><?= $ls->untuk.", ".$ls->ket_wilayah." ".sd_tgl($ls->tanggal,$ls->lama_hari) ?></i></b>
        </td>
    </tr>
</table>
<p>KETERANGAN :</p>
<p style="margin-top:-10px">- PENGAJUAN SPPD DISAHKAN PALING LAMBAT 7 HARI SEBELUM MELAKSANAKAN PERJALANAN DINAS</p>
<div class="page-break"></div>
<?php } ?>
</body>
</html>