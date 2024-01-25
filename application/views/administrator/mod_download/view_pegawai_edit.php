<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit File Download</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_pegawai',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_pegawai]'>
                    <tr><th width='150px' scope='row'>Nama Pegawai</th>    <td><input type='text' class='form-control' name='a' value='$rows[nama_pegawai]' required></td></tr>
                    <tr><th width='150px' scope='row'>Jabatan</th>    <td><input type='text' class='form-control' name='b' value='$rows[jabatan]' required></td></tr>
                    <tr><th width='150px' scope='row'>Atasan Langsung</th>    <td><input type='text' class='form-control' name='c' value='$rows[atasan_langsung]' required></td></tr>
                    
                    <tr><th width='150px' scope='row'>Ganti File</th>    <td><input type='file' class='form-control' name='d'>";
                                                                        if ($rows['nama_file'] != ''){ echo "File : <a target='_BLANK' href='".base_url()."pegawai/file/$rows[nama_file]'>$rows[nama_file]</a>"; } echo "</td></tr>
                    <tr><th width='150px' scope='row'>Google Drive</th>    <td><input type='text' class='form-control' name='e' value='$rows[gdrive]'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
