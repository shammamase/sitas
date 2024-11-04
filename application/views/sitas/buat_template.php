<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Template Surat</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>sekunder/save_template_surat">
            <div class="form-group">
              <label>Isi Surat:</label>
              <textarea name="isi_surat" id="summernote" required><?= $isi_surat ?></textarea>
            </div>
            <div class="form-group">
                 <div class="icheck-primary d-inline">
                        <input type="checkbox" name="is_lampiran" <?= $ceck ?> id="checkboxPrimary1">
                        <label for="checkboxPrimary1">
                        </label>
                  </div>
                  <label>Surat Lampiran ?</label>
            </div>
            <input type="hidden" name="id_template" value="<?= $id_template ?>">
          </div>
          <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-primary">Buat Template Surat</button>
          </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Template Surat</h3>
  </div>
  <div class="card-body">
    <table id="example3" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:68%">Isi Surat</th>
        <th style="width:10%">Kategori</th>
        <th style="width:20%">Aksi</th>
      </tr>
      </thead>
      <tbody>
      <?php
        $no = 1;
        foreach($list as $ls){ 
            if($ls->is_lampiran == 1){
                $kategori = "Lampiran";
                $lihat_surat = "<a class='btn btn-primary btn-xs' data-toggle='modal' data-target='#lihatLampiran' data-id='".$ls->id_template."' title='Lihat'><i class='fa fa-eye'></i> Lihat</a>";
            } else {
                $kategori = "Surat Utama";
                $lihat_surat = "<a class='btn btn-primary btn-xs' data-toggle='modal' data-target='#lihatSurat' data-id='".$ls->id_template."' title='Lihat'><i class='fa fa-eye'></i> Lihat</a>";
            }
      ?>
      <tr>
        <td><?= $no ?></td>
        <td><?= substr($ls->isi,0,250) ?>.....</td>
        <td><?= $kategori ?></td>
        <td>
            <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>sekunder/buat_template/<?php echo $ls->id_template ?>"><i class='fas fa-edit'></i> Edit</a>
            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>sekunder/delete_template/<?php echo $ls->id_template ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>
            <?= $lihat_surat ?>
        </td>
      </tr>
      <?php 
        $no++;
        } 
       ?>
      </tbody>
    </table>
    </div>
  </div>
</div>
  <!-- /.container-fluid -->

<div class="modal fade" id="lihatSurat" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Template Surat</h4>
            </div>
            <div class="modal-body">
                <div class="ambilData"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="lihatLampiran" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Template Lampiran</h4>
            </div>
            <div class="modal-body">
                <div class="ambilData"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#lihatSurat').on('show.bs.modal', function(e){
            var rowId = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : '<?= base_url() ?>sekunder/lihat_surat',
                data : 'id_template='+ rowId,
                success : function(data){
                    $('.ambilData').html(data);
                }
            });
        });
        $('#lihatLampiran').on('show.bs.modal', function(e){
            var rowId = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : '<?= base_url() ?>sekunder/lihat_lampiran',
                data : 'id_template='+ rowId,
                success : function(data){
                    $('.ambilData').html(data);
                }
            });
        });
    });
</script>