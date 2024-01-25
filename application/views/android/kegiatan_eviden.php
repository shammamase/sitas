<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <a class="navbar-brand" href="#">Dokumentasi</a>
</nav>
<br>
<div class="container-fluid">
  <div class="row">
      <?php 
      foreach($dts->result() as $dt){
      ?>
      <div data-toggle="modal" onclick="showdetail('<?php echo $dt->id_eviden ?>')" href="#doku" style="margin-bottom:5px" class="col-lg-4 col-md-4 col-6">
          <img class="img-fluid img-thumbnail" src="<?php echo base_url() ?>asset/android/eviden/<?php echo $dt->gambar ?>">
      </div>
      <?php } ?>
  </div>
  
        <div class="modal fade" id="doku">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="bodymodal_userDetail">
                    </div>
                </div>
            </div>
        </div>
        <script>
            function showdetail(id)
            {
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url('android/detail_eviden'); ?>",
                    data: "id="+id,
                    dataType: "html",
                    success: function (response) {
                        $('#bodymodal_userDetail').empty();
                        $('#bodymodal_userDetail').append(response);
                    }
                });
            }
        </script>
</div>