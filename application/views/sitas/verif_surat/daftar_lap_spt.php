<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Perjalanan Dinas</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:3%">No</th>
        <th style="width:25%">No Surat</th>
        <th style="width:20%">Kepada</th>
        <th style="width:27%">Untuk</th>
        <th style="width:10%">Tanggal</th>
        <th style="width:15%">Aksi</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        foreach ($rec as $row){
            $pc_tgl = explode("-",$row->tanggal_input);
            $kpda = $this->model_sitas->listDataBy("a.tanggal_spt,b.nama","anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai",
                      "a.id_spt=$row->id_spt","a.id_anggota asc");
            $lap_id_spt = $this->model_sitas->rowDataBy("*","lap_spt","id_spt = $row->id_spt")->row();
            if($lap_id_spt){
                $lpi = $lap_id_spt->id_spt;
            } else {
                $lpi = 0;
            }
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td>B-<?= $row->no_surat_keluar ?>/TU.040/H.4.2/<?= $pc_tgl[1] ?>/<?= $pc_tgl[0] ?></td>
        <td>
                <?php
                $nok = 1;
                foreach($kpda as $kpd){
                    $tgl_plk = $kpd->tanggal_spt;
                ?>
                <?= $nok.". ".$kpd->nama ?><br>
                <?php
                $nok++;
                }
                
                //logika tgl s.d tgl
                $pc_tgl_plk = explode(",",$tgl_plk);
                $jml_tgl = count($pc_tgl_plk);
                if($jml_tgl>1){
                    $pc1 = explode("-",$pc_tgl_plk[0]);
                    $pc2 = explode("-",end($pc_tgl_plk));
                    if($pc1[1]==$pc2[1]){
                        $val_tgl = $pc1[2]." s.d ".tgl_indo(end($pc_tgl_plk));
                    } else {
                        $pc11 = explode(" ",tgl_indo($pc_tgl_plk[0]));
                        $val_tgl = $pc11[0]." ".$pc11[1]." s.d ".tgl_indo(end($pc_tgl_plk));
                    }
                } else {
                    $val_tgl = tgl_indo($pc_tgl_plk[0]);
                }
                // end logika tgl s.d tgl
                
                ?>
        </td>
        <td><?php echo $row->untuk ?></td>
        <td><?php echo $val_tgl ?></td>
        <td>
            <a class='btn btn-warning btn-xs' title='Lihat' href="<?php echo base_url() ?>primer/verif_lap_spt_detail/<?php echo $row->id_spt ?>"><i class='fas fa-file'></i> Lihat</a>
        </td>
      </tr>
     <?php
      $no++;
        }
      ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->