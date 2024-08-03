<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Drive <?= $title ?></h3><br>
                    <?= $buat_folder ?>&nbsp;
                    <?= $upload_file ?>&nbsp;
                    <?= $kembali ?>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr><th>Nama</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach($folder as $fld){
                                $pc = explode("#",$fld);
                                $qw_folder = $this->db->query("select id_folder from folder where url = '$pc[0]'")->row();
                                $qw_file = $this->db->query("select id_file from file where id_folder = $qw_folder->id_folder")->num_rows();
                                $qw_root = $this->db->query("select id_folder from folder where root = $qw_folder->id_folder")->num_rows();
                                $jumlah_inodes = $qw_file + $qw_root;
                          ?>
                          <tr>
                            <td><a href="<?= base_url() ?>primer/drive/<?= $pc[0] ?>"><i style="font-size:20px;color:#fcba03" class="fa fa-folder"></i> <b><?= $pc[1] ?></b></a></td>
                            <td>
                            <a style="<?= $vw_edit ?>" class="btn btn-primary btn-xs" data-target="#modalEditDrive" data-toggle="modal" data-id="<?= $qw_folder->id_folder ?>"><i class="fa fa-edit"></i> Edit</a>
                                <?php if($jumlah_inodes == 0){ ?>
                                <a style="<?= $vw_hapus ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')" href="<?= base_url('primer/hapus_folder/') ?><?= $uri3 ?>/<?= $qw_folder->id_folder ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
                                <?php } ?>
                            </td>
                          </tr>
                          <?php 
                            }
                          ?>
                          
                          <?php
                            foreach($file as $flx){
                                if($flx->tipe_file == "zip"){
                                    $isi_file = "<i style='font-size:20px;color:#fcba03' class='fa fa-file-archive'></i>";
                                    $link_file = base_url()."asset/folder_drive/".$flx->filex;
                                } else if($flx->tipe_file == "rar"){
                                    $isi_file = "<i style='font-size:20px;color:#fcba03' class='fa fa-file-archive'></i>";
                                    $link_file = base_url()."asset/folder_drive/".$flx->filex;
                                } else if($flx->tipe_file == "pdf"){
                                    $isi_file = "<i style='font-size:20px;color:#f0140c' class='fa fa-file-pdf'></i>";
                                    $link_file = base_url()."asset/folder_drive/".$flx->filex;
                                } else if($flx->tipe_file == "docx"){
                                    $isi_file = "<i style='font-size:20px;color:#1767fc' class='fa fa-file-word'></i>";
                                    $link_file = base_url()."asset/folder_drive/".$flx->filex;
                                } else if($flx->tipe_file == "doc"){
                                    $isi_file = "<i style='font-size:20px;color:#1767fc' class='fa fa-file-word'></i>";
                                    $link_file = base_url()."asset/folder_drive/".$flx->filex;
                                } else if($flx->tipe_file == "xlsx"){
                                    $isi_file = "<i style='font-size:20px;color:#04bf4f' class='fa fa-file-excel'></i>";
                                    $link_file = base_url()."asset/folder_drive/".$flx->filex;
                                } else if($flx->tipe_file == "xls"){
                                    $isi_file = "<i style='font-size:20px;color:#04bf4f' class='fa fa-file-excel'></i>";
                                    $link_file = base_url()."asset/folder_drive/".$flx->filex;
                                } else if($flx->tipe_file == "pptx"){
                                    $isi_file = "<i style='font-size:20px;color:#f58a20' class='fa fa-file-powerpoint'></i>";
                                    $link_file = base_url()."asset/folder_drive/".$flx->filex;
                                } else if($flx->tipe_file == "ppt"){
                                    $isi_file = "<i style='font-size:20px;color:#f58a20' class='fa fa-file-powerpoint'></i>";
                                    $link_file = base_url()."asset/folder_drive/".$flx->filex;
                                } else if($flx->tipe_file == ""){
                                    $isi_file = "<i style='font-size:20px;color:#0c9cf0' class='fa fa-link'></i>";
                                    $link_file = $flx->link_file;
                                } else {
                                    $isi_file = "<img src='".base_url()."asset/folder_drive/".$flx->filex."' style='height:100px;width:auto'>";
                                    $link_file = base_url()."asset/folder_drive/".$flx->filex;
                                }
                          ?>
                          <tr>
                            <td><a target="_blank" href="<?= $link_file ?>"><?= $isi_file ?> <b><?= $flx->nama_file ?></b></a></td>
                            <td>
                              <?php if($flx->username == $this->session->username){ ?>
                              <a data-target="#editFile" data-toggle="modal" data-id="<?= $flx->id_file ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                              <a onclick="return confirm('Apa anda yakin untuk hapus Data ini?')" href="<?= base_url('primer/hapus_file/') ?><?= $uri3 ?>/<?= $flx->id_file ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
                              <?php } ?>
                            </td>
                          </tr>
                          <?php 
                            }
                          ?>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModalFolder">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Buat Folder</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="<?= site_url('primer/save_folder') ?>">
          <div class="form-group">
            <label for="email">Nama Folder</label>
            <input type="text" class="form-control" name="folder" required>
          </div>
          <input type="hidden" name="url" value="<?= $uri3 ?>">
          <input type="hidden" name="uris" value="primer/drive/<?= $uri3 ?>">
          <input type="hidden" name="root" value="<?= $root ?>">
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModalFile">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Upload File</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="<?= site_url('primer/save_file') ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="email">Dasar</label>
            <select name="id_surat_keluar" id="id_surat_keluar" class="form-control select2">
                <option value="0">--Pilih Dasar Surat--</option>
                <?php 
                foreach($surat_keluar as $sk){ 
                $pc_tgl = explode("-",$sk->tanggal);
                $kd_sifat = $this->model_sitas->rowDataBy("kode","sifat_surat","id_sifat=$sk->sifat")->row();
                $kd_arsip = $this->model_sitas->rowDataBy("kode_sub_arsip","klasifikasi_sub_arsip","id_sub_arsip=$sk->id_sub_arsip")->row();
                $no_surat_lengkap = $kd_sifat->kode."-".$sk->no_surat_keluar."/".$kd_arsip->kode_sub_arsip."/H.4.2/".$pc_tgl[1]."/".$pc_tgl[0];
                ?>
                <option value="<?= $sk->id_surat_keluar ?>"><?= $no_surat_lengkap ?> - <?= $sk->perihal ?></option>
                <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="email">Nama File</label>
            <input type="text" class="form-control" name="nama_file" id="nama_file" required>
          </div>
          <div class="form-group">
            <label for="email">Link</label>
            <input type="text" class="form-control" name="link_file" id="link_file">
          </div>
          <div class="form-group">
            <label for="email">Upload File</label>
            <input type="file" class="form-control" name="file" id="fileInput">
          </div>
          <input type="hidden" name="uris" id="uris" value="primer/drive/<?= $uri3 ?>">
          <input type="hidden" name="root" id="root" value="<?= $root ?>">
          <input type="hidden" name="tahun" id="tahun" value="<?= $thn ?>">
          <button type="button" onclick="uploadFile()" class="btn btn-primary">Submit</button><br>
          <progress id="progressBar" value="0" max="100"></progress>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="modalEditDrive" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Folder</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="fetch_data"></div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="editFile" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit File</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="fetch_data_edit_file"></div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<script>
        $(document).ready(function(){
          $('#modalEditDrive').on('show.bs.modal',function (e) {
            var rowId = $(e.relatedTarget).data('id');
            $.ajax({
              type : 'post',
              url : '<?= base_url() ?>sekunder/edit_drive',
              data : 'id_folder='+ rowId,
              success : function(data){
                $('.fetch_data').html(data);
              }
            });
          });
          $('#editFile').on('show.bs.modal',function (e) {
            var idFile = $(e.relatedTarget).data('id');
            $.ajax({
              type : 'post',
              url : '<?= base_url() ?>sekunder/edit_file',
              data : 'id_file='+ idFile,
              success : function(data){
                $('.fetch_data_edit_file').html(data);
              }
            });
          });
        });
        function uploadFile() {
            var fileInput = document.getElementById('fileInput');
            var id_surat_keluar = document.getElementById('id_surat_keluar');
            var nama_file = document.getElementById('nama_file');
            var link_file = document.getElementById('link_file');
            var uris = document.getElementById('uris');
            var root = document.getElementById('root');
            var tahun = document.getElementById('tahun');
            
            var file = fileInput.files[0];
            var id_surat_keluar_val = id_surat_keluar.value;
            var nama_file_val = nama_file.value;
            var link_file_val = link_file.value;
            var uris_val = uris.value;
            var root_val = root.value;
            var tahun_val = tahun.value;
            
            //if (file) {
                var formData = new FormData();
                formData.append('file', file);
                formData.append('id_surat_keluar', id_surat_keluar_val);
                formData.append('nama_file', nama_file_val);
                formData.append('link_file', link_file_val);
                formData.append('uris', uris_val);
                formData.append('root', root_val);
                formData.append('tahun', tahun_val);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?= base_url() ?>primer/save_file', true);

                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        var percent = (e.loaded / e.total) * 100;
                        document.getElementById('progressBar').value = percent;
                    }
                };

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // File uploaded successfully
                        window.location.href = "<?= base_url() ?>"+uris_val;
                        //alert('Berhasil Upload File!');
                    }
                };

                xhr.send(formData);
            /*
            } else {
                alert('Please select a file to upload.');
            }
            */
        }
    </script>