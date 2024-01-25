<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Semua Kegiatan</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Kegiatan</th>
        <th>Dana Pagu</th>
        <th>Sisa dana dalam pagu</th>
        <th>% Realisasi Keuangan</th>
        <th>% Realisasi Fisik</th>
        <th style='width:50px'>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        foreach ($record->result() as $row){
            $get_rl = $this->model_polling->get_rl($row->id_subkomp)->row();
            //$get_lpj = $this->model_polling->get_pg_pj($row->id_subkomp)->row();
            $get_fs = $this->model_polling->get_fs($row->id_subkomp)->row();
            
            if($get_rl){
                $get_rll  = $get_rl->rl;
            } else {
                $get_rll  = 0;
            }
            
            
            $rl_mon = $this->db->query("select realisasi from sijuara_monev where id_subkomp = '$row->id_subkomp' order by id_monev desc")->row();
            if($rl_mon){
                $get_fss = $rl_mon->realisasi;
            } else {
                $get_fss = "";
            }
            
            
            
            $sisa_dana = $row->jumlah_biaya - $get_rll;
            $persen = ($get_rll / $row->jumlah_biaya) * 100;
            if($persen<=50){
                $warna_bg = "bg-danger";
            } else {
                $warna_bg = "bg-success";
            }
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->subkomp ?></td>
        <td><?php echo number_format($row->jumlah_biaya,0,"",".") ?></td>
        <td><?php echo number_format($sisa_dana,0,"",".") ?></td>
        <td>
            <div class="progress">
              <div class="progress-bar <?php echo $warna_bg ?>" style="width:<?php echo number_format($persen,2) ?>%"><?php echo number_format($persen,2) ?>%</div>
            </div>
        </td>
        <td><?php echo $get_fss ?></td>
        <td>
            <a class='btn btn-success btn-xs' target="_blank" title='Ajukan' href="<?php echo base_url() ?>sijuara/verif_pj/<?php echo $row->id_subkomp ?>"><i class='fas fa-file-invoice'></i> Detail</a>
            <a class='btn btn-primary btn-xs' target="_blank" title='Ajukan' href="<?php echo base_url() ?>sijuara/lap_monev/<?php echo $row->id_subkomp ?>"><i class='fas fa-file-invoice'></i> Monev</a>
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