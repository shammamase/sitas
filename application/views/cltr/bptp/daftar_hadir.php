<html> 
	<body>
        <table style="margin-left:10px;margin-top:10px;width:95%;font-size:13px" border="1">
          <tr>
              <td rowspan="3" style="width:10%;text-align:center"><img src="<?= base_url() ?>asset/logo1.png" style="height:50px;width:auto"></td>
              <td style="width:60%;text-align:center"><b>BALAI PENGKAJIAN TEKNOLOGI PERTANIAN</b> <br> <b>(BPTP) GORONTALO</b></td>
              <td colspan="2" style="width:30%;text-align:center"><b>FM-BPTP</b> <br> <b>GORONTALO/WM-20</b></td>
          </tr>
          <tr>
              <td rowspan="2" style="width:60%;text-align:center"><b>DAFTAR HADIR</b></td>
              <td style="width:15%;text-align:center">Revisi</td>
              <td style="width:15%;text-align:center">Tanggal Terbit</td>
          </tr>
          <tr>
              <td style="width:15%;text-align:center">00</td>
              <td style="width:15%;text-align:center">01-01-2014</td>
          </tr>
        </table>
        
        <table style="margin-left:10px;margin-top:10px;width:95%;font-size:13px" border="0">
          <tr>
              <td style="width:30%;"><b>Nama Pertemuan</b></td>
              <td style="width:5%;">:</td>
              <td style="width:65%;"><?= $qw->rapat ?></td>
          </tr>
          <tr>
              <td><b>Pimpinan Pertemuan</b></td>
              <td>:</td>
              <td><?= $qw->nama ?></td>
          </tr>
          <tr>
              <td><b>Tanggal</b></td>
              <td>:</td>
              <td><?= tgl_indoo($qw->tanggal) ?></td>
          </tr>
        </table>
        
        <table style="width:95%;margin-left:10px;margin-top:10px;border-collapse:collapse;border:1 px solid black;font-size:13px;">
            <tr style="border:1 px solid black">
              <td style="text-align:center;border:1 px solid black;width:3%;font-weight:bold">No</td>
              <td style="text-align:center;border:1 px solid black;width:32%;font-weight:bold">NAMA</td>
              <td style="text-align:center;border:1 px solid black;width:25%;font-weight:bold">NIP</td>
              <td style="text-align:center;border:1 px solid black;width:20%;font-weight:bold">SUB BAGIAN/SEKSI</td>
              <td style="text-align:center;border:1 px solid black;width:20%;font-weight:bold">TANDA TANGAN</td>
            </tr>
            <?php 
            $nor = 1;
            foreach($psr as $ps){ 
            ?>
            <tr style="border:1 px solid black">
              <td style="text-align:center;border:1 px solid black;width:3%;"><?= $nor ?></td>
              <td style="text-align:left;border:1 px solid black;width:32%;"><?= $ps->nama ?></td>
              <td style="text-align:left;border:1 px solid black;width:25%;"><?= $ps->nip ?></td>
              <td style="text-align:center;border:1 px solid black;width:20%;"></td>
              <td style="text-align:center;border:1 px solid black;width:20%;"><img src="<?= $ps->ttd ?>" style="height:40px;width:auto"></td>
            </tr>
            <?php 
            $nor++;
            } ?>
        </table>
        
        <table style="margin-left:10px;margin-top:10px;width:95%;font-size:13px" border="0">
          <tr>
              <td style="width:60%;text-align:center">&nbsp;</td>
              <td style="width:40%;text-align:center"><b>Mengetahui</b></td>
          </tr>
          <tr>
              <td>&nbsp;</td>
              <td style="text-align:center;font-weight:bold">Kepala Balai</td>
          </tr>
          <tr>
              <td><img src="<?= base_url() ?>asset/file_lainnya/qr_code_daftar/<?= $qw->id_rapat ?>.png" style="height:90px;width:auto"></td>
              <td>
                  <?php
                        $get_kb = $this->db->query("select a.*,b.nip,b.nama from simantep_kabalai a inner join t_biodata b on a.id_bio=b.id_bio where a.tahun_awal <= '$qw->tanggal' and a.tahun_selesai >= '$qw->tanggal'")->row();
                        
                  ?>
                  <img src="<?= $get_kb->ttd_cap ?>" style="height:140px;width:auto">
              </td>
          </tr>
          <tr>
              <td>&nbsp;</td>
              <td style="text-align:center;font-weight:bold"><?= $get_kb->nama ?></td>
          </tr>
          <tr>
              <td>&nbsp;</td>
              <td style="text-align:center;font-weight:bold">NIP. <?= $get_kb->nip ?></td>
          </tr>
        </table>
	</body>
	</html>