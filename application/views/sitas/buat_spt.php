<div class="container-fluid">
    <div class="row">

      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat SPT</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <!--<form method="post" action="<?= base_url() ?>primer/add_spt">-->
            <form method="post" action="#">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" class="datepicker form-control" placeholder="Masukan Tanggal"
              name="tanggal" id="tgl_spt" value="<?= $tgl_ini ?>" onchange="ubahURL()" required>
            </div>
            <div class="form-group">
                <label>Lamanya</label>
                <input type="text" name="lamanya" id="lama_hari" onkeyup="ubahURL()" 
                class="form-control" value="<?= $lamanya?>" min="1" placeholder="lamanya" required>
            </div>
            <div class="form-group">
              <label>Surat Masuk :</label>
              <input class="form-control" id="surat_masuk" name="pilih_surat_masuk">
            </div>
            <div class="form-group">
              <label>Menimbang :</label>
              <textarea id="menimbang" class="form-control" name="menimbang"><?= $menimbang ?></textarea>
            </div>
            <div class="form-group">
              <label>Dasar:</label>
              <textarea name="dasar" id="summernote">
                <?= $dasar ?>
              </textarea>
            </div>
            <div class="form-group">
                  <label>Kepada:</label>
                  <select class="form-control select2" multiple="multiple" name="peg[]" data-placeholder="Pilih Pegawai" style="width: 100%;" required>
                    <?php
                    if($peg){
                        foreach($arr as $ar){
                        ?>
                        <option selected value="<?= $ar->id_pegawai ?>"><?= $ar->nama ?></option>
                        <?php
                        }
                        foreach($spt as $pg){
                        ?>
                        <option value="<?= $pg->id_pegawai ?>"><?= $pg->nama ?></option>
                        <?php
                        }
                    }
                    
                    ?>
                  </select>
            </div>
            <div class="form-group">
                  <label>Untuk: <div id="srt_msk"></div></label>
                  <textarea class="form-control" name="untuk" required><?= $untuk ?></textarea>
            </div>
            <div class="form-group">
                 <div class="icheck-primary d-inline">
                        <input type="checkbox" name="is_dipa" value="1" <?= $ceck ?> id="checkboxPrimary1">
                        <label for="checkboxPrimary1">
                        </label>
                  </div>
                  <label>DIPA BPSI TAS Tahun <?= date('Y') ?></label>
            </div>
            <div class="form-group">
              <label>Tanggal Input:</label>
                <div class="input-group date" id="reservationdates" data-target-input="nearest">
                    <input type="text" name="tanggal_input" class="form-control datetimepicker-input" value="<?= $tanggal_input ?>" data-target="#reservationdates" required/>
                    <div class="input-group-append" data-target="#reservationdates" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
          </div>
          <input type="hidden" name="verif" value="<?= $verif ?>">
          <input type="hidden" name="id_arsip" value="45">
          <input type="hidden" name="user" value="<?= $this->session->username ?>">
          <input type="hidden" name="tanggal_akhir" value="<?= $tgl_no ?>">
          <input type="hidden" name="status" value="<?= $status ?>">
          <input type="hidden" name="id_spt" value="<?= $id_spt ?>">
          <input type="hidden" id="id_surat_masuk" name="id_surat_masuk" value="<?= $id_surat_masuk ?>">
            <div class="card-footer">
                <button type="submit" name="buat_spt" class="btn btn-primary btn-block">Buat SPT</button>
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
                       data-asal_surat="Berdasarkan surat dari <?= $lm->asal_surat ?>" data-tanggal=" tanggal <?= tgl_indoo($lm->tanggal) ?> , Nomor Surat " data-perihal=", perihal <?= $lm->perihal ?>"
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
          const pdf_sm = document.createElement("a");
          pdf_sm.innerHTML = "<i class='fas fa-file-pdf'></i> Lihat Surat Masuk";
          pdf_sm.classList.add('btn', 'btn-danger', 'btn-xs');
          pdf_sm.setAttribute('data-toggle', 'modal');
          pdf_sm.setAttribute('data-target', '#modal_vw_sm');
          document.getElementById("srt_msk").appendChild(pdf_sm);
          document.getElementById("id_surat_masuk").value = $(this).attr('data-id_surat_masuk');
          document.getElementById("surat_masuk").value = $(this).attr('data-no_surat_masuk')+" "+$(this).attr('data-asal_surat');
          document.getElementById("menimbang").value = $(this).attr('data-asal_surat')+""+$(this).attr('data-tanggal')+""+$(this).attr('data-no_surat_masuk')+""+$(this).attr('data-perihal');
          document.getElementById("filex_pdf").src = $(this).attr('data-file_pdf');
      })
  </script>

  <script>
        function ubahURL() {
            var tanggal = document.getElementById('tgl_spt').value;
            var lama_hari = document.getElementById('lama_hari').value;
            if(lama_hari.trim() !== "" && !isNaN(lama_hari)){
                var url = window.location.href.split('?')[0]; // Ambil URL tanpa parameter
                var parameter = 'tanggal=' + encodeURIComponent(tanggal);
                var parameter2 = '&lama_hari=' + encodeURIComponent(lama_hari);
                var newURL = url + '?' + parameter + parameter2;
                history.pushState(null, '', newURL);
                // Lakukan refresh halaman setelah memilih tanggal
                location.reload();
            }
        }

        window.onload = function () {
        var parameterString = window.location.search.substr(1); // Ambil parameter dari URL
        var parameterArray = parameterString.split('&');
        var parameterMap = {};
        parameterArray.forEach(function (param) {
            var paramParts = param.split('=');
            parameterMap[paramParts[0]] = decodeURIComponent(paramParts[1]);
        });

        var tanggal = parameterMap['tanggal'];
        var lama_hari = parameterMap['lama_hari'];
        if (tanggal) {
            document.getElementById('tgl_spt').value = tanggal;
        }
        if (lama_hari) {
            document.getElementById('lama_hari').value = lama_hari;
        }
    };
    </script>