<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Surat Masuk <?= $this->session->flashdata('success') ?></h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= site_url() ?>primer/save_surat_masuk" enctype="multipart/form-data">
            <!--<form method="post" action="#">-->
            <div class="form-group">
              <label>No Agenda :</label>
              <input type="number" class="form-control" name="no_agenda" value="<?= $no_agenda ?>">
            </div>
            <div class="form-group">
              <label>Kode Klasifikasi:</label>
              <select class="form-control select2" name="id_sub_arsip" required>
              <option value="<?= $id_sub_arsip ?>"><?= $kode_klasifikasi ?></option>
              <?php foreach($list_kode as $ls_kd){ ?>
                <option value="<?= $ls_kd->id_sub_arsip ?>">
                <?= $ls_kd->kode_sub_arsip." - ".$ls_kd->sub_arsip ?>
                </option>
              <?php } ?>      
              </select>
            </div>
            <div class="form-group">
              <label>No Surat Masuk :</label>
              <input type="text" class="form-control" name="no_surat_masuk" value="<?= $no_surat_masuk ?>">
            </div>
            <div class="form-group">
              <label>Asal Surat:</label>
              <textarea name="asal_surat" class="form-control"><?= $asal_surat ?></textarea>
            </div>
            <div class="form-group">
              <label>Tanggal Masuknya Surat</label>
                <div class="input-group date" id="reservationdates" data-target-input="nearest">
                    <input type="text" name="tanggal_masuk" class="form-control datetimepicker-input" value="<?= $tanggal_masuk ?>" data-target="#reservationdates" required/>
                    <div class="input-group-append" data-target="#reservationdates" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label>Tanggal Surat</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" name="tanggal" class="form-control datetimepicker-input" value="<?= $tanggal ?>" data-target="#reservationdate" required/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label>Perihal:</label>
              <textarea name="perihal" class="form-control"><?= $perihal ?></textarea>
            </div>
            <div class="form-group">
              <label>Upload File PDF : <?= $file_pdf ?></label>
              <input type="file" class="form-control" name="file_pdf">
            </div>
            <input type="hidden" name="status" value="<?= $status ?>">
            <input type="hidden" name="id_surat_masuk" value="<?= $id_surat_masuk ?>">
            <input type="hidden" name="file_pdfx" value="<?= $nama_file ?>">
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Buat Surat Masuk</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
    
    <div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Surat Masuk</h3>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:10%">No Agenda</th>
        <th style="width:18%">Asal Surat</th>
        <th style="width:10%">Tanggal Masuknya Surat</th>
        <th style="width:10%">Tanggal Surat</th>
        <th style="width:20%">Perihal Surat</th>
        <th style="width:10%">Disposisi</th>
        <th style="width:20%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        $no_hp = $kabalai->no_hp;
        $no_wa = substr_replace("$no_hp","62",0,1);
        if($rec){
        foreach ($rec as $row){
            $kode_arsip = $this->model_sitas->rowDataBy("kode_sub_arsip","klasifikasi_sub_arsip","id_sub_arsip = $row->id_sub_arsip")->row();
            $links = base_url()."sijuara/disposisi_detail/".$row->id_surat_masuk;
            $pesan = "*Layanan Aplikasi* Ada Surat Masuk, lebih detailnya silahkan klik link $links";
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->no_agenda ?>/<?= $kode_arsip->kode_sub_arsip ?></td>
        <td><?= $row->asal_surat ?></td>
        <td><?= tgl_indoo($row->tanggal_masuk) ?></td>
        <td><?= tgl_indoo($row->tanggal) ?></td>
        <td><?= $row->perihal ?></td>
        <td>(<?= $row->diteruskan ?>)<br><?= $row->disposisi ?><br><?= $row->isi_disposisi ?></td>
        <td>
            <?php
            if($row->id_verifikasi==0){
            ?>
            <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>primer/buat_surat_masuk?id_sm=<?php echo $row->id_surat_masuk ?>"><i class='fas fa-edit'></i> Edit</a>
            <a class='btn btn-primary btn-xs' title='Copy' href="<?php echo base_url() ?>primer/buat_surat_masuk?copy=<?php echo $row->id_surat_masuk ?>"><i class='fas fa-copy'></i> Copy</a>
            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>primer/hapus_surat_masuk/<?php echo $row->id_surat_masuk ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>
            <!--<a class='btn btn-info btn-xs' title='Kirim' target="_blank" href="https://api.whatsapp.com/send?phone=<?= $no_wa ?>&text=<?= $pesan ?>"><i class='fa fa-share'></i> Kirim</a>-->
            <?php
            
            } else {
            ?>
            <a class='btn btn-success btn-xs' title='Detail' href="<?php echo base_url() ?>primer/sm_detail/<?php echo $row->id_surat_masuk ?>/<?= $uri3 ?>"><i class='fas fa-file'></i> Detail</a>
            <a class='btn btn-info btn-xs' target='_blank' title='Disposisi' href="<?php echo base_url() ?>primer/file_disposisi/<?php echo $row->id_surat_masuk ?>"><i class='fas fa-file-pdf'></i> Disposisi</a>
            <?php
            }
            
            if(!empty($row->file_pdf)){
            ?>
            <a class='btn btn-warning btn-xs' target='_blank' title='PDF' href="<?php echo base_url() ?>asset/surat_masuk/<?php echo $row->file_pdf ?>"><i class='fas fa-file-pdf'></i> PDF</a>
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