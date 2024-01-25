<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Perjanjian Kinerja Individu</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_pegawai',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='150px' scope='row'>Nama Pegawai</th>    <td><input type='text' class='form-control' name='a' required></td></tr>
                    <tr><th width='150px' scope='row'>Jabatan</th>    <td><input type='text' class='form-control' name='b' required></td></tr>
                    <tr><th width='150px' scope='row'>Atasan Langsung</th>    <td><input type='text' class='form-control' name='c' required></td></tr>
                    <tr><th width='150px' scope='row'>Cari File</th>    <td><input type='file' class='form-control' name='d'></td></tr>
                    <tr><th width='150px' scope='row'>Google Drive</th>    <td><input type='text' class='form-control' name='e'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
