<?php date_default_timezone_set('Asia/Makassar') ?>
<div class="container">
    <div class="animate__animated animate__flipInX animate__infinite animate__slow" style="margin-top:10px;margin-bottom:10px;text-align:center"><img src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/img/core-img/kementa2.png" alt=""></div>
    
    <div class="col-12">
        <!--
        <div style="border:1px solid black;width:auto;height:100px;padding:10px">
            <div style="border:2px solid #f8b53a;background-color:#000000;opacity:0.1;width:auto;height:80px">
                <h3 style="text-align:center;color:white;text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;">Form Buku Tamu Digital BPTP Gorontalo</h3>
            </div>
        </div>
        -->
        <div class="card bg-warning text-dark mt-1">
          <div class="card-body">
            <h3 style="text-align:center;color:white;text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;">Absensi Tenaga Kontrak BPTP Gorontalo</h3>
              <form method="post" action="<?php echo site_url('bptp/tambah_buku_tamu') ?>" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="nik">Status Absen</label>
                    <select class="form-control tes" name="status_absen" required>
                        <option value="">-Pilih Status Absen-</option>
                        <option value="Masuk">Masuk</option>
                        <option value="Istirahat 1">Istirahat 1</option>
                        <option value="Istirahat 2">Istirahat 2</option>
                        <option value="Pulang">Pulang</option>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Harap Di isi</div>
                </div>
                <div class="form-group">
                    <label for="nik">Nama Pegawai</label>
                    <select class="form-control tes" name="nik" id="nik" required>
                        <option value="">-Pilih Nama-</option>
                        <?php
                            foreach ($pegawai->result() as $pg){
                        ?>
                        <option value="<?php echo $pg->nik ?>-<?php echo $pg->no_hp ?>"><?php echo $pg->nama ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Harap Di isi</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                        <br/>
                        <input type=button value="Take Snapshot" onClick="take_snapshot()">
                        <input type="hidden" name="image" class="image-tag">
                    </div>
                    <div class="col-md-6">
                        <div id="results">Your captured image will appear here...</div>
                    </div>
                    <div class="col-md-12 text-center">
                        <br/>
                        <button class="btn btn-success">Submit</button>
                    </div>
                </div>
                <input type="hidden" name="waktu" value="<?php echo date('Y-m-d H:i:s') ?>">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </form>
          </div>
        </div>
    </div>
</div>


<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>