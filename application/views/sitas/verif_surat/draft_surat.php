<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Draft Surat</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:20%">Perihal</th>
        <th style="width:30%">Kepada</th>
        <th style="width:15%">Tanggal</th>
        <th style="width:10%">Sifat</th>
        <th style="width:13%">Konseptor</th>
        <th style="width:10%">Aksi</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        foreach ($rec as $row){
            $sifat = $this->model_sitas->rowDataBy("sifat","sifat_surat","id_sifat=$row->sifat")->row();
            if($row->user == NULL){
              $konseptor = "";
            } else {
              $konseptor = ucwords(strtolower($this->model_sitas->get_user_by($row->user)->nama));
            }
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->perihal ?></td>
        <?php if($row->lokasi_tujuan_surat != "SPT"){ ?>
        <td><?php echo $row->tujuan_surat." di ".$row->lokasi_tujuan_surat ?></td>
        <?php } else { ?>
        <td><?php echo $row->tujuan_surat ?></td>
        <?php } ?>
        <td><?php echo tgl_indoo($row->tanggal) ?></td>
        <td><?php echo $sifat->sifat ?></td>
        <td><?= $konseptor ?></td>
        <td>
            <a class='btn btn-warning btn-xs' title='Lihat' href="<?php echo base_url() ?>primer/verif_draft_surat/<?php echo md5($row->id_surat_keluar) ?>/<?php echo $row->id_surat_keluar ?>"><i class='fas fa-file'></i> Lihat</a>
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