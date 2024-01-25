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
            <h3 style="text-align:center;color:white;text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;">Form Digital BPTP Gorontalo</h3>
              <form method="post" action="<?php echo site_url('bptp/tambah_buku_tamu') ?>" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="nik">Pihak Terkait (PJ,PPK,PUMK,Kepala Balai,Sub Program,Bendahara)</label>
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
                <div class="form-group">
                  <label for="nama">Nama Kegiatan</label>
                  <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Kegiatan" name="nama" required>
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Harap Di isi</div>
                </div>
                <div class="form-group">
                  <label for="no_hp">No HP</label>
                  <input type="text" class="form-control" id="no_hp" placeholder="Masukkan No HP Anda" name="no_hp" required>
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Harap Di isi</div>
                </div>
                <div class="form-group">
                  <label for="asal_instansi">Sebagai</label>
                  <input type="text" class="form-control" id="asal_instansi" placeholder="Di isi (PUMK,PPK,Bendahara,PJ, dst)" name="asal_instansi" required>
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Harap Di isi</div>
                </div>
                <div class="form-group">
                  <label for="maksud_tujuan">Saran</label>
                  <textarea class="form-control" name="maksud_tujuan" id="maksud_tujuan" rows="3" required></textarea>
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Harap Di isi</div>
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