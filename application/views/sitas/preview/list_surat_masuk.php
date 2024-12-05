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
        <td style="text-align:center">Perihal</td>
        <td style="text-align:center">No Agenda</td>
        <td style="text-align:center">No Surat</td>
        <td style="text-align:center">Sifat</td>
        <td style="text-align:center">Asal</td>
        <td style="text-align:center">Tgl Registrasi</td>
        <td style="text-align:center">Tgl Surat</td>
        <td style="text-align:center">Disposisi</td>
        <td style="text-align:center">Tindak Lanjut</td>
    </tr>
    <?php $no = 1;foreach($qwx as $qw){ ?>
    <tr>
        <td style="text-align:center"><?= $no ?></td>
        <td><?= $qw->perihal ?></td>
        <td><?= $qw->no_agenda ?>/<?= $qw->kode_sub_arsip ?></td>
        <td><?= $qw->no_surat_masuk ?></td>
        <td style="text-align:center"><?= $qw->sifat ?></td>
        <td><?= $qw->asal_surat ?></td>
        <td style="text-align:center"><?= tgl_indo($qw->tanggal_masuk) ?></td>
        <td style="text-align:center"><?= tgl_indo($qw->tanggal) ?></td>
        <td>
            <?= $qw->diteruskan ?><br>
            (<?= $qw->disposisi ?>)
        </td>
        <td>
            <?= $qw->isi_disposisi ?><br><br>
            link pdf surat masuk : <?= base_url('asset/surat_masuk/').$qw->file_pdf ?>
        </td>
    </tr>
    <?php 
        $no++;
    } 
    ?>
</table>
</body>
</html>