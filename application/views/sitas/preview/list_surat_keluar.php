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
<div><img style="width:100%" src="<?php echo base_url().'asset/kop_surat1.png' ?>"></div>
<table style='margin-top:0px;width:100%;border-collapse:collapse' border='1'>
    <tr>
        <td style="text-align:center">No</td>
        <td style="text-align:center">No Surat</td>
        <td style="text-align:center">Sifat</td>
        <td style="text-align:center">Tujuan</td>
        <td style="text-align:center">Perihal</td>
        <td style="text-align:center">Tanggal</td>
        <!--<td style="text-align:center">Link PDF</td>-->
    </tr>
    <?php 
        $no = 1;foreach($qwx as $qw){ 
            $tgl_in = explode("-",$qw->tanggal);
            $linkx = base_url('asset/surat_keluar/').$qw->file_pdf;
    ?>
    <tr>
        <td style="text-align:center"><?= $no ?></td>
        <td><?= $qw->kode."-".$qw->no_surat_keluar."/".$qw->kode_sub_arsip ?>/H.4.2/<?= $tgl_in[1]."/".$tgl_in[0] ?></td>
        <td style="text-align:center"><?= $qw->sifat ?></td>
        <td><?= $qw->tujuan_surat ?> di <?= $qw->lokasi_tujuan_surat ?></td>
        <td><?= $qw->perihal ?></td>
        <td style="text-align:center"><?= tgl_indoo($qw->tanggal) ?></td>
        <!--<td><?= $linkx ?></td>-->
    </tr>
    <?php 
        $no++;
    } 
    ?>
</table>
</body>
</html>