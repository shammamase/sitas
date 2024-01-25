<?php
date_default_timezone_set("Asia/Makassar")
?>
<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <a class="navbar-brand" href="#">Upload Foto</a>
  <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url() ?>android/kegiatan"><i style="font-size:20px" class="fa fa-image"></i></a>
        </li>
    </ul>
</nav>
<br>
<div class="container-fluid">
  <div class="row">
      <div class="col-lg-12 col-md-12 col-12">
          <form method="post" action="<?php echo site_url('android/simpan_eviden') ?>" enctype="multipart/form-data">
          <!--<input type="file" accept="image/*" id="file-input">-->
          <label class="btn btn-outline-success btn-block">
                <i class="fa fa-camera" style="font-size:24px"></i><input type="file" name="gambar" accept="image/*" onchange="readURL(this);" style="display: none;">
          </label>
          <img style="margin-bottom:10px" class="img-fluid" id="blah" src="<?php echo base_url() ?>asset/foto_banner_cltr/no_photo.jpg" alt="your image" />
          <input type="hidden" name="tanggal" value="<?php echo date('Y-m-d') ?>">
          <input type="hidden" name="jam" value="<?php echo date('h:i:sa') ?>">
          <textarea class="form-control" rows="5" name="keterangan" placeholder="Keterangan"></textarea>
          <button style="margin-top:10px" type="submit" name="submit" class="btn btn-success btn-block">Simpan</button>
          </form>
            <script>
             function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
    
                    reader.onload = function (e) {
                        $('#blah')
                            .attr('src', e.target.result);
                    };
    
                    reader.readAsDataURL(input.files[0]);
                }
            }
            </script>
      </div>
  </div>  
</div>