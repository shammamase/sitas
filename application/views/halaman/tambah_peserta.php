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
            <h3 style="text-align:center;color:white;text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;">Form Peserta Seminar</h3>
              <form method="post" action="<?php echo site_url('bptp/tambah_peserta') ?>" class="needs-validation" novalidate>
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Peserta" name="nama" value="<?= $nama ?>" required>
                  <input type="hidden" name="id" value="<?= $id ?>">
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Harap Di isi</div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </form>
              <br>
              <a href="<?= site_url() ?>bptp/tambah_peserta" class="btn btn-success">+ Peserta</a>
          </div>
        </div>
        
        <div class="card text-dark mt-1">
          <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th colspan="2">Daftar Peserta</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($peserta as $q){
                  ?>
                  <tr>
                    <td><?= $q->nama ?></td>
                    <td>
                        <a href="<?= site_url() ?>bptp/tambah_peserta/<?= $q->id ?>" class="btn btn-success">Edit</a>
                        &nbsp;&nbsp;&nbsp;
                        <a onclick="return confirm('Apakah anda ingin menghapus <?= $q->nama ?> ?')" href="<?= site_url() ?>bptp/delete_peserta/<?= $q->id ?>" class="btn btn-danger">Hapus</a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
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