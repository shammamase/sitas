<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar SPT</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:29%">SPT</th>
        <th style="width:10%">No Surat</th>
        <th style="width:18%">Kepada</th>
        <th style="width:17%">Untuk</th>
        <th style="width:7%">Tanggal</th>
        <th style="width:7%">DIPA</th>
        <th style="width:10%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        
        foreach ($rec->result() as $row){
            $kpda = $this->model_more->get_peg_spt($row->id_spt);
            $no_surat = $this->model_more->get_surat_spt($row->id_spt);
            if($no_surat){
                $no_sr = $no_surat->no_surat_keluar;
            } else {
                $no_sr = $row->keterangan;
            }
            
            if($row->is_dipa==1){
                $dip = "Ya";
            } else {
                $dip = "Tidak";
            }
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->menimbang ?></td>
        <td><?= $no_sr ?></td>
        <td>
                <?php
                $nok = 1;
                foreach($kpda as $kpd){
                    $tgl_plk = $kpd->tanggal;
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
        <td><?php echo $dip ?></td>
        <td>
            <a class='btn btn-warning btn-xs' title='Lihat' href="<?php echo base_url() ?>sijuara/verif_spt_detail/<?php echo $row->id_spt ?>"><i class='fas fa-file'></i> Lihat</a>
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