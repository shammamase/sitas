<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Surat</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>primer/save_surat1">
            <div class="form-group">
              <label>Tanggal</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" name="tanggal" class="form-control datetimepicker-input" value="<?= $tanggal ?>" data-target="#reservationdate" required/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label>Kode Klasifikasi:</label>
              <select class="form-control select2" name="arsip" style="width: 100%;" required>
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
              <label>Lampiran</label>
              <input type="text" class="form-control" name="lampiran" value="<?= $lampiran ?>">
            </div>
            <div class="form-group">
              <label>Hal</label>
              <textarea name="hal" class="form-control"><?= $hal ?></textarea>
            </div>
            <div class="form-group">
              <label>Kepada</label>
              <input type="text" class="form-control" name="kepada" value="<?= $kepada ?>">
            </div>
            <div class="form-group">
              <label>di</label>
              <input type="text" class="form-control" name="lokasi_kepada" value="<?= $lokasi_kepada ?>">
            </div>
            <div class="form-group">
              <label>Pilih Surat Masuk :</label>
              <input class="form-control" id="surat_masuk" name="pilih_surat_masuk">
            </div>
            <div class="form-group">
              <label>Isi Surat: <div id="srt_msk"></div></label>
              <textarea name="isi_surat" id="summernote"><?= $isi_surat ?></textarea>
            </div>
            <div class="form-group">
              <label>Tembusan (Pisahkan dengan koma jika tembusan lebih dari 1)</label>
              <input type="text" class="form-control" name="tembusan" value="<?= $tembusan ?>">
            </div>
            <input type="hidden" name="status" value="<?= $status ?>">
            <input type="hidden" id="id_surat_masuk" name="id_surat_masuk" value="<?= $id_surat_masuk ?>">
            <input type="hidden" name="id_buat_surat" value="<?= $id_buat_surat ?>">
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Buat Surat</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
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
                       data-asal_surat="Berdasarkan surat dari <?= $lm->asal_surat ?>" data-tanggal=" tanggal <?= $lm->tanggal ?> , Nomor Surat " data-perihal=", perihal <?= $lm->perihal ?>"
                       data-file_pdf="<?= base_url() ?>asset/surat_masuk/<?= $lm->file_pdf ?>"
                       >
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
  <div class="modal fade" id="modal_vw_sm">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">File Surat Masuk</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
              </div>
              <div class="modal-body">
                <iframe style="height:600px;width:100%" id="filex_pdf" src=""></iframe>
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
              var el_mdl = document.querySelectorAll('[data-target="#modal_vw_sm"]');
              var jml_mdl = el_mdl.length;
              $("#modalku").modal();
              if(jml_mdl > 0){
                  el_mdl[0].parentNode.removeChild(el_mdl[0]);
              }
          });
      });
      
      $("#modalku").on('click','.pilih',function (e) {
          var textValue = "<p>"+$(this).attr('data-asal_surat')+""+$(this).attr('data-tanggal')+""+$(this).attr('data-no_surat_masuk')+""+$(this).attr('data-perihal')+"</p>";
          const pdf_sm = document.createElement("a");
          pdf_sm.innerHTML = "<i class='fas fa-file-pdf'></i> Lihat Surat Masuk";
          pdf_sm.classList.add('btn', 'btn-danger', 'btn-xs');
          pdf_sm.setAttribute('data-toggle', 'modal');
          pdf_sm.setAttribute('data-target', '#modal_vw_sm');
          document.getElementById("srt_msk").appendChild(pdf_sm);
          document.getElementById("id_surat_masuk").value = $(this).attr('data-id_surat_masuk');
          document.getElementById("surat_masuk").value = $(this).attr('data-no_surat_masuk')+" "+$(this).attr('data-asal_surat');
          //document.getElementById("summernote").value = $(this).attr('data-asal_surat')+""+$(this).attr('data-tanggal')+""+$(this).attr('data-no_surat_masuk')+""+$(this).attr('data-perihal');
          document.getElementById("filex_pdf").src = $(this).attr('data-file_pdf');
          $('#summernote').summernote('code', textValue);
      })
  </script>