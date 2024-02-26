<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Surat</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>primer/save_surat1" enctype="multipart/form-data">
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
            <!--
            <div class="form-group">
              <label>Lampiran</label>
              <input type="text" class="form-control" name="lampiran" value="<?= $lampiran ?>">
            </div>
            -->
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
            <div class="form-group">
              <label>Pilih Upload File Lampiran</label>
              <input style="width:20px;height:20px" type="checkbox" id="pilih_metode" <?= $is_file_lampiran ?>>
            </div>
            <div class="form-group" id="pilih3" style="display:<?= $display_jml_lampiran ?>">
              <label>Jumlah Lampiran</label>
              <input type="number" class="form-control" name="jml_lampiran" id="jumlahTextarea" value="<?= $lampiran ?>" onkeyup="buatTextarea()" <?= $disb ?>>
            </div>
            <div class="form-group" id="pilih1" style="display:<?= $display_file_lampiran ?>">
              <label>Jumlah Lampiran</label>
              <input id="pilih11" type="number" class="form-control" name="jml_lampiran" value="<?= $lampiran ?>" <?= $dis ?>>
            </div>
            <div class="form-group" id="pilih2" style="display:<?= $display_file_lampiran ?>">
              <label>Upload File Lampiran <?= $file_lamp ?></label>
              <input type="file" class="form-control" name="file_lampiran">
            </div>
            <div id="contextarea"></div>
            <?php $no_lp = 1; foreach($list_lamp as $lp){ ?>
              <div class="form-group lampx">
              <label>Lampiran ke-<?= $no_lp ?></label>
              <textarea name="lampiran[]" id="summernote<?= $no_lp ?>"><?= $lp->deskripsi ?></textarea>
              </div>
            <?php $no_lp++;} ?>
            <?php if($jml_lamp > 0){ ?>
              <?php for($yt = $no_lp; $yt <= 5; $yt++){ ?>
                <div class="form-group lampx">
                <label>Lampiran ke-<?= $yt ?></label>
                <textarea name="lampiran[]" id="summernote<?= $yt ?>"></textarea>
                </div>
              <?php } ?>
            <?php } ?>
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
    <div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Surat Keluar</h3>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:17%">No Surat</th>
        <th style="width:16%">Tujuan Surat</th>
        <th style="width:10%">Tanggal</th>
        <th style="width:20%">Perihal</th>
        <th style="width:15%">Status</th>
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
            if($row->alasan_tolak != ""){
            ?>
            <span class="badge badge-pill badge-danger">di tolak</span><br>
            <b>Keterangan :</b><?= $row->alasan_tolak ?>
            <?php
            } 
          ?>
          <?php if($row->id_verif1 != 0){ ?>
            <span class="badge badge-pill badge-success">di setujui verifikator awal</span><br>
          <?php } ?>
          <?php if($row->id_verif1 != 0){ ?>
            <span class="badge badge-pill badge-success">di setujui verifikator akhir</span><br>
            <b>Keterangan :</b><?= $row->keterangan ?>
          <?php } ?>
        </td>
        <td>
            <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>primer/buat_surat?id_bs=<?php echo $row->id_surat_keluar ?>"><i class='fas fa-edit'></i> Edit</a>
            <a class='btn btn-primary btn-xs' title='Copy' href="<?php echo base_url() ?>primer/buat_surat?cs=<?php echo $row->id_surat_keluar ?>"><i class='fas fa-copy'></i> Copy</a>
            <!--<a class='btn btn-info btn-xs' title='Kirim' href="#"><i class='fas fa-share'></i> Kirim WA</a>-->
            <!--<a class='btn btn-primary btn-xs' title='Copy' href="<?php echo base_url() ?>sijuara/buat_surat_keluar?copy=<?php echo $row->id_surat_keluar ?>/<?= $uri3 ?>"><i class='fas fa-copy'></i> Copy</a>-->
            <a class='btn btn-info btn-xs' title='Preview' href="<?= base_url() ?>primer/prev_surat/<?= $row->id_surat_keluar ?>"><i class='fas fa-eye'></i> Preview</a>
            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>primer/delete_surat/<?php echo $row->id_surat_keluar ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>
            <a class='btn btn-warning btn-xs' target="_blank" title='File PDF' href="<?= base_url() ?>preview/pdf_surat/<?= md5($row->id_surat_keluar) ?>/<?= $row->id_surat_keluar ?>"><i class='fas fa-file-pdf'></i> PDF</a>
            <?php if($row->file_lampiran != ""){ ?>
              <a class='btn btn-warning btn-xs' target="_blank" title='File PDF' href="<?= base_url() ?>asset/lampiran/<?= $row->file_lampiran ?>"><i class='fas fa-file-pdf'></i> Lamp</a>  
            <?php } ?>
            <?php if($row->id_verif1 == 0){ ?>
            <a class='btn btn-dark btn-xs' title='Ajukan' href="<?php echo base_url() ?>primer/ajukan_surat_keluar/<?php echo $row->id_surat_keluar ?>" onclick="return confirm('Apa anda yakin untuk ajukan data ini?')"><i class='fas fa-share'></i> Ajukan</a>
            <?php } ?>
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
                  <table id="example2" class="table table-bordered table-striped">
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

  <div class="modal fade" id="modal_vw_lam">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">File Lampiran</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
              </div>
              <div class="modal-body">
                <iframe style="height:600px;width:100%" src="<?= $isi_file_lamp ?>"></iframe>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Tutup</button>
              </div>
          </div>
      </div>
  </div>
  <script>
    const checkbox = document.getElementById("pilih_metode");
    const pilih1 = document.getElementById("pilih1");
    const pilih11 = document.getElementById("pilih11");
    const pilih2 = document.getElementById("pilih2");
    const pilih3 = document.getElementById("pilih3");
    const contextarea = document.getElementById("contextarea");
    const jumlahTextArea = document.getElementById("jumlahTextarea");
    checkbox.addEventListener("change", function () {
        if(checkbox.checked){
          pilih1.style.display = "";
          pilih2.style.display = "";
          pilih3.style.display = "none";
          contextarea.style.display = "none";
          pilih11.disabled = false;
          jumlahTextArea.disabled = true;
        } else {
          pilih1.style.display = "none";
          pilih2.style.display = "none";
          pilih3.style.display = "";
          contextarea.style.display = "";
          pilih11.disabled = true;
          jumlahTextArea.disabled = false;
        }
    });
  </script>
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
      });

      function buatTextarea(){
        // hapus dulu textarea yg telah dibuat
            var textareas = document.getElementsByClassName("lampx")
            while (textareas[0]){
                textareas[0].parentNode.removeChild(textareas[0]);
            }
        
        // buat textarea
        var jumlah = document.getElementById("jumlahTextarea").value;
        for(i = 0; i < jumlah; i++){
            var div_form = document.createElement("div");
            div_form.setAttribute("class","form-group lampx");
            var lblx = document.createElement("label");
            lblx.innerHTML = "Lampiran ke-" + (i+1);
            var textarea = document.createElement("textarea");
            textarea.setAttribute("class","form-control");
            textarea.setAttribute("name", "lampiran[]");
            textarea.setAttribute("id","summernote" + (i+1));
            div_form.appendChild(lblx);
            div_form.appendChild(textarea);
            document.getElementById("contextarea").appendChild(div_form);
        }
        
        // Inisialisasi summernote pada semua textarea yang telah dibuat
          for (ff = 0; ff < jumlah; ff++) {
            $('#summernote' + (ff+1)).summernote();
          }
    }
  </script>