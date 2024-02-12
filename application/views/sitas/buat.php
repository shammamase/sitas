<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Nomor Surat Keluar</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <!--<form method="post" action="<?= base_url() ?>sijuara/save_surat_keluar">-->
            <form method="post" action="#">
            <div class="form-group">
              <label>No Surat :</label>
              <input type="text" class="form-control" name="no_surat_keluar" value="<?= $no_surat ?>" <?= $read ?>>
            </div>
            <div class="form-group">
              <label>Tujuan Surat:</label>
              <textarea name="tujuan_surat" class="form-control"><?= $tujuan_surat ?></textarea>
            </div>
            <div class="form-group">
              <label>Tanggal</label>
                <div class="input-group date" id="reservationdates" data-target-input="nearest">
                    <input type="text" name="tanggal" class="form-control datetimepicker-input" value="<?= $tanggal ?>" data-target="#reservationdates" required/>
                    <div class="input-group-append" data-target="#reservationdates" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label>Perihal:</label>
              <textarea name="perihal" class="form-control"><?= $perihal ?></textarea>
            </div>
            <div class="form-group">
              <label>No Arsip Surat:</label>
              <select class="form-control select2" name="arsip" style="width: 100%;">
                    <option value="<?= $arsip ?>"><?= $arsip_val ?></option>
                    <?php
                        foreach($ars as $ar){
                        ?>
                        <option value="<?= $ar->kode_sub_arsip ?>"><?= $ar->kode_sub_arsip ?> - <?= $ar->arsip ?> - <?= $ar->sub_arsip ?></option>
                        <?php
                        }
                    ?>
                  </select>
            </div>
            <input type="hidden" name="status" value="<?= $status ?>">
            <input type="hidden" name="id_surat_keluar" value="<?= $id_surat_keluar ?>">
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Buat Nomor Surat</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
    
    <div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Surat Keluar</h3>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:10%">No Surat</th>
        <th style="width:15%">Tujuan Surat</th>
        <th style="width:10%">Tanggal</th>
        <th style="width:20%">Perihal</th>
        <th style="width:23%">No Surat (Lengkap)</th>
        <th style="width:20%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        if($rec){
        foreach ($rec as $row){
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->no_surat_keluar ?></td>
        <td><?= $row->tujuan_surat ?></td>
        <td><?= tgl_indoo($row->tanggal) ?></td>
        <td><?= $row->perihal ?></td>
        <td></td>
        <td>
            <?php
            if($row->verif_kabalai==1){
                if($row->id_spt==0 && $row->id_buat_surat==0){
                    $hid = "style='display:'";
                    $hids = "style='display:none'";
                } else {
                    $hid = "style='display:none'";
                    $hids = "style='display:'";
                }
                
                if($row->id_spt!=0){
                    $get_pdf = "pdf_spt";
                    $get_pdfs = "pdf_spt_manual";
                    $id_yy = $row->id_spt;
                } else {
                    $get_pdf = "pdf_surat";
                    $get_pdfs = "pdf_surat_manual";
                    $id_yy = $row->id_buat_surat;
                }
            ?>
            <a <?= $hid ?> class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>sijuara/buat_surat_keluar?id_sk=<?php echo $row->id_surat_keluar ?>/<?= $uri3 ?>"><i class='fas fa-edit'></i> Edit</a>
            <a class='btn btn-primary btn-xs' title='Copy' href="<?php echo base_url() ?>sijuara/buat_surat_keluar?copy=<?php echo $row->id_surat_keluar ?>/<?= $uri3 ?>"><i class='fas fa-copy'></i> Copy</a>
            <a <?= $hids ?> class='btn btn-danger btn-xs' title='PDF' target="_blank" href="<?php echo base_url() ?>sijuara/<?= $get_pdf ?>/<?php echo md5($id_yy) ?>/<?= $id_yy ?>"><i class='fas fa-file-pdf'></i> PDF Scan</a>
            <a <?= $hids ?> class='btn btn-danger btn-xs' title='PDF' target="_blank" href="<?php echo base_url() ?>sijuara/<?= $get_pdfs ?>/<?php echo md5($id_yy) ?>/<?= $id_yy ?>"><i class='fas fa-file-pdf'></i> PDF Asli</a>
            <!--<a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>sijuara/delete_surat_keluar/<?php echo $row->id_surat_keluar ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>-->
            <?php
            } else {
                if($row->id_spt!=0){
                    $getx = "spt";
                    $id_getx = $row->id_spt;
                } else {
                    $getx = "srt";
                    $id_getx = $row->id_buat_surat;
                }
            ?>
            <a class='btn btn-warning btn-xs' title='Buat Nomor Surat' href="<?php echo base_url() ?>sijuara/buat_surat_keluar?<?= $getx ?>=<?= $id_getx ?>/<?= $uri3 ?>"><i class='fas fa-edit'></i> Buat No Surat</a>
            <?php
            }
            ?>
        </td>
      </tr>
     <?php
      $no++;
        }
    }
      ?>
      </tbody>
    </table>
    </div>
  </div>
</div>
  <!-- /.container-fluid -->