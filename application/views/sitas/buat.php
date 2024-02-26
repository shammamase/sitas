<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Nomor Surat Keluar</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>primer/save_surat_keluar" enctype="multipart/form-data">
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
              <label>Sifat:</label>
              <select class="form-control select2" name="sifat" style="width: 100%;" required>
                    <option value="<?= $sifat ?>"><?= $sifat_val ?></option>
                    <?php
                        foreach($sif as $sf){
                        ?>
                        <option value="<?= $sf->id_sifat ?>"><?= $sf->sifat ?></option>
                        <?php
                        }
                    ?>
                  </select>
            </div>
            <div class="form-group">
              <label>Kode Klasifikasi:</label>
              <select class="form-control select2" name="arsip" style="width: 100%;">
                    <option value="<?= $arsip ?>"><?= $arsip_val ?></option>
                    <?php
                        foreach($ars as $ar){
                        ?>
                        <option value="<?= $ar->id_sub_arsip ?>"><?= $ar->kode_sub_arsip ?> - <?= $ar->arsip ?> - <?= $ar->sub_arsip ?></option>
                        <?php
                        }
                    ?>
                  </select>
            </div>
            <div class="form-group" style="display:<?= $view_balas_sm ?>">
              <label>Balas Surat Masuk :</label>
              <input class="form-control" id="surat_masuk" name="pilih_surat_masuk" <?= $dis_sm ?>>
            </div>
            <div class="form-group" style="display:<?= $view_upl_pdf ?>">
              <label>Upload File PDF:</label>
              <input type="file" class="form-control" name="file_pdf" <?= $dis_pdf ?>>
            </div>
            <input type="hidden" name="status" value="<?= $status ?>">
            <input type="hidden" name="id_surat_keluar" value="<?= $id_surat_keluar ?>">
            <input type="hidden" id="id_surat_masuk" name="id_surat_masuk" value="<?= $id_surat_masuk ?>">
            <input type="hidden" name="lokasi_tujuan_surat" value="<?= $lokasi_tujuan_surat ?>">
            <input type="hidden" name="user" value="<?= $user ?>">
            <input type="hidden" name="id_verif" value="<?= $id_verif ?>">
            <input type="hidden" name="waktu_verif" value="<?= $waktu_verif ?>">
            <input type="hidden" name="tanggal_input" value="<?= $tanggal_input ?>">
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
    <table id="example2" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:22%">No Surat</th>
        <th style="width:21%">Tujuan Surat</th>
        <th style="width:10%">Tanggal</th>
        <th style="width:25%">Perihal</th>
        <th style="width:20%">Aksi</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        if($rec){
        foreach ($rec as $row){
          $pc_tgl = explode("-",$row->tanggal);
          $kode_sifat = $this->model_sitas->rowDataBy("kode","sifat_surat","id_sifat=$row->sifat")->row();
          $kode_arsip = $this->model_sitas->rowDataBy("kode_sub_arsip","klasifikasi_sub_arsip","id_sub_arsip=$row->id_sub_arsip")->row();
          $surat_masuk = $this->model_sitas->rowDataBy("no_surat_masuk,asal_surat","surat_masuk","id_surat_masuk = $row->id_surat_masuk");
          $cek_sm = $surat_masuk->num_rows();
          if($cek_sm > 0) {
            $sm = $surat_masuk->row();
            $balasan = $sm->no_surat_masuk."-".$sm->asal_surat;
          } else {
            $balasan = "-";
          }

     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $kode_sifat->kode."-".$row->no_surat_keluar."/".$kode_arsip->kode_sub_arsip."/H.4.2/".$pc_tgl[1]."/".$pc_tgl[0] ?></td>
        <td><?= $row->tujuan_surat ?><br><b>Balasan Surat</b> : <?= $balasan ?></td>
        <td><?= tgl_indoo($row->tanggal) ?></td>
        <td><?= $row->perihal ?></td>
        <td>
            <?php
            if($row->no_surat_keluar!=""){
            ?>
            <!--<a class='btn btn-primary btn-xs' title='Copy' href="<?php echo base_url() ?>sijuara/buat_surat_keluar?copy=<?php echo $row->id_surat_keluar ?>/<?= $id_surat_keluar ?>"><i class='fas fa-copy'></i> Copy</a>-->
              <?php if($row->file_pdf != ""){ ?>
                <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>primer/buat_surat_keluar/<?php echo $row->id_surat_keluar ?>"><i class='fas fa-edit'></i> Edit</a>
                <a class='btn btn-warning btn-xs' target="_blank" title='File PDF' href="<?php echo base_url() ?>asset/surat_keluar/<?php echo $row->file_pdf ?>"><i class='fas fa-file-pdf'></i> PDF</a>
                <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>primer/delete_surat_keluar/<?php echo $row->id_surat_keluar ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>
              <?php } else {
              ?>
                <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>primer/buat_surat_keluar?id_sk=<?php echo $row->id_surat_keluar ?>"><i class='fas fa-edit'></i> Edit</a>
                <a class="btn btn-warning btn-xs" target="_blank" title="file pdf" href="<?= base_url() ?>preview/pdf_surat/<?= md5($row->id_surat_keluar) ?>/<?= $row->id_surat_keluar ?>"><i class='fas fa-file-pdf'></i> PDF</a>
              <?php
              }
            ?>
            <?php
            } else {
            ?>
            <a class='btn btn-warning btn-xs' title='Buat Nomor Surat' href="<?php echo base_url() ?>primer/buat_surat_keluar?id_sk=<?= $row->id_surat_keluar ?>"><i class='fas fa-edit'></i> Buat No Surat</a>
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

  <div class="modal fade" id="modalku">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Pilih Surat Masuk</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
              </div>
              <div class="modal-body">
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th style="width:3%">No</th>
                        <th style="width:15%">No Surat</th>
                        <th style="width:25%">Asal Surat</th>
                        <th style="width:15%">Tanggal Surat</th>
                        <th style="width:42%">Perihal Surat</th>
                      </tr>
                      </thead>
                      <tbody>
                       <tr style="cursor:pointer;text-align:center;color:#ff0000" class="pilih" data-dismiss="modal" data-id_surat_masuk="0" data-no_surat_masuk=""
                       data-asal_surat="" data-tanggal="" data-perihal="" data-file_pdf="<?= base_url() ?>sijuara/tidak_ada_pilihan_surat_masuk"><td>0</td><td>Batal Pilih Surat Masuk</td>
                       <td>Batal Pilih Surat Masuk</td><td>Batal</td><td>Batal Pilih Surat Masuk</td>
                       </tr>
                       <?php
                       $nor = 1;
                       foreach($list_sm as $lm){
                       ?>
                       <tr style="cursor:pointer" class="pilih" data-dismiss="modal" 
                       data-id_surat_masuk="<?= $lm->id_surat_masuk ?>" data-no_surat_masuk="<?= $lm->no_surat_masuk ?>"
                       data-asal_surat="Berdasarkan surat dari <?= $lm->asal_surat ?>">
                           <td><?= $nor ?></td>
                           <td><?= $lm->no_surat_masuk ?></td>
                           <td><?= $lm->asal_surat ?></td>
                           <td><?= tgl_indoo($lm->tanggal) ?></td>
                           <td><?= $lm->perihal ?></td>
                       </tr>
                       <?php
                       $nor++;
                       }
                       ?>
                      </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Tutup</button>
              </div>
          </div>
      </div>
  </div>
  
  <script>
      $(document).ready(function(){
          $("#surat_masuk").click(function(){
              $("#modalku").modal();
          });
      });
      
      $("#modalku").on('click','.pilih',function (e) {
          document.getElementById("id_surat_masuk").value = $(this).attr('data-id_surat_masuk');
          document.getElementById("surat_masuk").value = $(this).attr('data-no_surat_masuk')+" "+$(this).attr('data-asal_surat');
      })
  </script>