<style>
    @media only screen and (max-width: 600px){
        iframe{
            height:300px;
            width:100%;
        }
        
        p{
        font-family:Arial;
        font-size:9pt;
        }
        
        ul{
            font-family:Arial;
            font-size:9pt;
            margin-left:-20px;
        }
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:9pt;
        }
    }
    
    @media only screen and (min-width: 600px){
        iframe{
            height:300px;
            width:100%;
        }
        
        p{
        font-family:Arial;
        font-size:9pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:9pt;
            margin-left:-15px;
        }
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-20px;
            font-size:9pt;
        }
    }
    
    @media only screen and (min-width: 768px){
        iframe{
            height:400px;
            width:100%;
        }
        
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:12pt;
            margin-left:-15px;
        } 
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:12pt;
        }
    }
    
    @media only screen and (min-width: 992px){
        iframe{
            height:400px;
            width:100%;
        }
        
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:12pt;
            margin-left:-15px;
        } 
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:12pt;
        }
    }
    
    @media only screen and (min-width: 1200px){
        iframe{
            height:500px;
            width:100%;
        }
        
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:12pt;
            margin-left:-15px;
        } 
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:12pt;
        }
    }
    
</style>

<div class="card card-success">
<div class="card-header">
    <h3 class="card-title">Surat Masuk</h3>
</div>
<div class="card-body">

<div class="row">
    <div class="col-md-3 col-3"><p>Asal Surat</p></div>
    <div class="col-md-9 col-9"><p>: <?= $sm->asal_surat ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Perihal Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->perihal ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Tanggal Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= tgl_indoo($sm->tanggal) ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Tanggal Masuk Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= tgl_indoo($sm->tanggal_masuk) ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Nomor Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->no_surat_masuk ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Disposisi</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->disposisi ?></p></div>
    <div class="col-md-3 col-3 no_srt">&nbsp;</div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->isi_disposisi ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Catatan</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->catatan ?></p></div>
    <?php
        $arr_id_disposisi = explode(",",$sm->id_pegawai_disposisi);
        if(in_array($id_pegawai_log, $arr_id_disposisi)){
    ?>
        <div class="col-md-12 col-12" style="margin-bottom:10px"><button class="btn btn-success" data-target="#dispox" data-toggle="modal">Disposisi <i class="fa fa-share"></i></button></div>
    <?php
        }
    ?>
    <?php if($vw_btn_dispo == 1){ ?>
    <div class="col-md-12 col-12" style="margin-bottom:10px"><button class="btn btn-success" data-target="#dispol" data-toggle="modal">Disposisi</button></div>
    <?php } ?>
    <!--
    <div class="col-md-12 col-12" style="margin-bottom:10px">
        <a target="_blank" class="btn btn-success" href="">Buat SPT</a>
        <a class="btn btn-info" href="">Balas Surat</a>
    </div>
    -->
    <div class="col-md-12 col-12">
        <iframe src="<?= base_url() ?>asset/surat_masuk/<?= $sm->file_pdf ?>"></iframe>
    </div>
    <div class="col-md-12 col-12">
        <iframe src="<?= base_url() ?>primer/file_disposisi/<?= $sm->id_surat_masuk ?>"></iframe>
    </div>
</div>

</div>
<div class="card-footer">
    
</div>
</div>
<?php if(in_array($id_pegawai_log, $arr_id_disposisi)){ ?>
<div class="modal fade" id="dispox" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Disposisi :</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?= base_url() ?>primer/kirim_disposisi_kebawah">
              <input type="hidden" name="id_surat_masuk" value="<?= $sm->id_surat_masuk ?>">
              <div class="form-group">
                  <div class="row">
                  <div class="col-md-6 col-12">
                  <div class="col-md-12"><b>Diteruskan Kepada :</b></div>
                  <?php 
                    foreach($sub_disposisi as $sd){ 
                    if(in_array($sd->no_hp,$arr_dispo)){
                        $centang = "checked";
                    } else {
                        $centang = "";
                    }
                  ?>
                    <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" name="diteruskan[]" value="<?= $sd->no_hp ?>" <?= $centang ?>>
                        <?= $sd->sub_struktur ?> - <?= $sd->nama ?>
                      </label>
                    </div>
                  <?php } ?>
                  </div>
                  
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Catatan:</label>
                      <textarea name="catatan" class="form-control"><?= $catatan ?></textarea>
                    </div>
                  </div>
                  <!--
                  <div style="margin-top:20px" class="col-md-12 col-12">
                      <select id="selectBox" multiple name="pegawai[]" data-placeholder="Pilih Pegawai" class="form-control select2" required>
                        <?php
                        foreach($peg as $pg){
                        ?>
                        <option value="<?= $pg->id_pegawai ?>"><?= $pg->nama ?></option>
                        <?php
                        }
                        ?>
                      </select>
                  </div>
                  -->
                  </div>
              </div>
              <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <?php } ?>

  <?php if($vw_btn_dispo == 1){ ?>
  <div class="modal fade" id="dispol" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Disposisi :</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form onsubmit="return validateForm();" class="" method="post" action="<?= base_url() ?>primer/kirim_disposisi">
              <input type="hidden" name="id_surat_masuk" value="<?= $sm->id_surat_masuk ?>">
              <div class="form-group">
                  <div class="row">
                  <div class="col-md-6 col-12">
                  <div class="col-md-12"><b>Diteruskan Kepada :</b></div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" id="cb1" name="diteruskan[]" value="Kepala Balai">Kepala Balai
                      </label>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" id="cb2" name="diteruskan[]" value="Kepala Sub Bagian Tata Usaha">Kepala Sub Bagian Tata Usaha
                      </label>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" id="cb3" name="diteruskan[]" value="Ketua Tim Kerja Program Evaluasi<br>dan Penyebarluasan Hasil<br>Standardisasi">Ketua Tim Kerja Program, Evaluasi, dan Penyebarluasan Hasil Standardisasi
                      </label>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" id="cb4" name="diteruskan[]" value="Ketua Tim Kerja Layanan Pengujian<br>dan Penilaian Standar">Ketua Tim Kerja Layanan Pengujian dan Penilaian Standar
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" id="cb5" name="diteruskan[]" value="Pejabat Pembuat Komitmen">Pejabat Pembuat Komitmen
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" id="cb6" name="diteruskan[]" value="IP2SIP">IP2SIP
                      </label>
                    </div>
                    <!--
                    <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" name="diteruskan[]" value="IP2SIP Bajeng">IP2SIP Bajeng
                      </label>
                    </div>
                    -->
                    <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" id="cb7" name="diteruskan[]" value="Manajer UPBS">Manajer UPBS
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" id="cb8" name="diteruskan[]" value="Manajer Laboratorium">Manajer Laboratorium
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" id="cb9" name="diteruskan[]" value="Manajer Keuangan">Manajer Keuangan
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="checkbox" class="form-check-input" id="cb10" name="diteruskan[]" value="Jabatan Fungsional">Jabatan Fungsional
                      </label>
                    </div>
                  </div>
                  
                  <div class="col-md-6 col-12">
                  <div class="col-md-12"><b>Isi Disposisi :</b></div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="checkbox" class="form-check-input" name="isi_disposisi[]" value="Untuk Diketahui">Untuk Diketahui
                      </label>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="checkbox" class="form-check-input" name="isi_disposisi[]" value="Untuk Penyelesaian Selanjutnya">Untuk Penyelesaian Selanjutnya
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="checkbox" class="form-check-input" name="isi_disposisi[]" value="Harap Saran/Pertimbangan">Harap Saran/Pertimbangan
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="checkbox" class="form-check-input" name="isi_disposisi[]" value="Untuk dibicarakan dengan saya">Untuk Dibicarakan dengan saya
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="checkbox" class="form-check-input" name="isi_disposisi[]" value="Harap Mewakili Saya">Harap Mewakili Saya
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="checkbox" class="form-check-input" name="isi_disposisi[]" value="Konsutasi/diskusi dengan">Konsutasi/diskusi dengan
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="checkbox" class="form-check-input" name="isi_disposisi[]" value="Siapkan Bahan">Siapkan Bahan
                      </label>
                    </div>
                    
                    <div class="form-group">
                      <label>Catatan:</label>
                      <textarea name="catatan" class="form-control"></textarea>
                    </div>
                  </div>
                  
                  <div style="margin-top:20px" class="col-md-12 col-12">
                      <select id="selectBox" multiple name="pegawai[]" data-placeholder="Pilih Pegawai" class="form-control select2" required>
                        <?php
                        foreach($peg as $pg){
                        ?>
                        <option value="<?= $pg->id_pegawai ?>"><?= $pg->nama ?></option>
                        <?php
                        }
                        ?>
                      </select>
                  </div>
                  
                  </div>
              </div>
              <button type="submit" name="submit" class="btn btn-danger">Submit</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  

  <script>
    function validateForm() {
            var diteruskanCheckboxes = document.getElementsByName('diteruskan[]');
            var untukCheckboxes = document.getElementsByName('isi_disposisi[]');

            var diteruskanChecked = false;
            var untukChecked = false;

            for (var i = 0; i < diteruskanCheckboxes.length; i++) {
                if (diteruskanCheckboxes[i].checked) {
                    diteruskanChecked = true;
                    break;
                }
            }

            for (var i = 0; i < untukCheckboxes.length; i++) {
                if (untukCheckboxes[i].checked) {
                    untukChecked = true;
                    break;
                }
            }

            if (!diteruskanChecked || !untukChecked) {
                alert("Minimal satu checkbox dari kedua grup harus dicentang.");
                return false;
            }
        }

    const cb1 = document.getElementById('cb1');
    const cb2 = document.getElementById('cb2');
    const cb3 = document.getElementById('cb3');
    const cb4 = document.getElementById('cb4');
    const cb5 = document.getElementById('cb5');
    const selectBox = document.getElementById('selectBox');
    cb1.addEventListener('change', updateSelect);
    cb2.addEventListener('change', updateSelect);
    cb3.addEventListener('change', updateSelect);
    cb4.addEventListener('change', updateSelect);
    cb5.addEventListener('change', updateSelect);
    function updateSelect(){
        if(cb1.checked){
            selectBox.querySelector('option[value="1"]').setAttribute('selected', 'selected');
        } else {
            selectBox.querySelector('option[value="1"]').removeAttribute('selected');
        }
        if(cb2.checked){
            selectBox.querySelector('option[value="12"]').setAttribute('selected', 'selected');
        } else {
            selectBox.querySelector('option[value="12"]').removeAttribute('selected');
        }
        if(cb3.checked){
            selectBox.querySelector('option[value="13"]').setAttribute('selected', 'selected');
        } else {
            selectBox.querySelector('option[value="13"]').removeAttribute('selected');
        }
        if(cb4.checked){
            selectBox.querySelector('option[value="31"]').setAttribute('selected', 'selected');
        } else {
            selectBox.querySelector('option[value="31"]').removeAttribute('selected');
        }
        if(cb5.checked){
            selectBox.querySelector('option[value="5"]').setAttribute('selected', 'selected');
        } else {
            selectBox.querySelector('option[value="5"]').removeAttribute('selected');
        }
    }
  </script>
  <?php } ?>