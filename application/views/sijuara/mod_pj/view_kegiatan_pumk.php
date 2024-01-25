<?php
$usd = $this->session->username;
$levs = $this->db->query("select username from sijuara_user where username = '$usd'")->row();
?>
<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Kegiatan</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" style="width:100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style='width:2%'>No</th>
        <th style='width:38%'>Nama Kegiatan</th>
        <th style='width:10%'>Jumlah Biaya</th>
        <th style='width:20%'>Persentase Realisasi</th>
        <th style='width:20%'>PJ</th>
        <th style='width:10%'>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        foreach ($record->result() as $row){
            $get_rl = $this->model_polling->get_rl($row->id_subkomp)->row();
            if($get_rl){
                $get_rll  = $get_rl->rl;
            } else {
                $get_rll  = 0;
            }
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
        <td>
            <div class="progress">
              <div class="progress-bar <?php echo $warna_bg ?>" style="width:<?php echo number_format($persen,2) ?>%"><?php echo number_format($persen,2) ?>%</div>
            </div>
        </td>
        <td><?php echo $row->nama ?></td>
        <td>
            
            <?php if($levs->username=="yusufantu"){ ?>
            <a class='btn btn-success btn-xs' target="_blank" title='List' href="<?php echo base_url() ?>sijuara/pengajuan_full/<?php echo $row->id_subkomp ?>"><i class='fas fa-file-invoice'></i> List Pengajuan</a>
            <?php } else { ?>
            <a class='btn btn-primary btn-xs' target="_blank" title='Rincian' href="<?php echo base_url() ?>sijuara/pengajuan/<?php echo $row->id_subkomp ?>"><i class='fas fa-file-invoice'></i> Rincian</a>
            <a class='btn btn-success btn-xs' target="_blank" title='Ajukan' href="<?php echo base_url() ?>sijuara/pengajuan_full/<?php echo $row->id_subkomp ?>"><i class='fas fa-file-invoice'></i> Ajukan</a>
            <a class='btn btn-warning btn-xs' target="_blank" title='Ajukan' href="<?php echo base_url() ?>sijuara/pengajuan_status/<?php echo $row->id_subkomp ?>"><i class='fas fa-file-invoice'></i> Status</a>
            <?php } ?>
            <!--
            <a class='btn btn-success btn-xs' title='Mengajukan' href="<?php echo base_url() ?>admin/konfirmasi_pemesanan/" onclick="return confirm('Apa anda yakin melakukan konfirmasi ?')"><i class='fa fa-check'></i></a>
            <a class='btn btn-primary btn-xs' title='Edit Data' href="<?php echo base_url() ?>admin/edit_pemesanan/"><i class='fa fa-edit'></i></a>
            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>admin/delete_pemesanan/" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i></a>
            -->
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