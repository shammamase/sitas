<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Identitas Website</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/identitaswebsite',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Nama Website</th>   <td><input type='text' class='form-control' name='a' value='$record[nama_website]'></td></tr>
                     <tr><th scope='row'>Alamat Website</th>              <td><input type='url' class='form-control' name='c' value='$record[alamat_website]'></td></tr>
                    <tr><th scope='row'>Meta Deskripsi</th>               <td><input type='text' class='form-control' name='g' value='$record[meta_deskripsi]'></td></tr>
                    <tr><th scope='row'>Meta Keyword</th>                 <td><input type='text' class='form-control' name='h' value='$record[meta_keyword]'></td></tr>
                    <tr><th scope='row'>Redaksi</th>                 <td><input type='text' class='form-control' name='j' value='$record[redaksi]'></td></tr>
                    <tr><th scope='row'>Marketing</th>                 <td><input type='text' class='form-control' name='k' value='$record[marketing]'></td></tr>
                    <tr><th scope='row'>Alamat</th>                 <td><input type='text' class='form-control' name='l' value='$record[alamat]'></td></tr>
                    <tr><th scope='row'>No HP</th>                 <td><input type='text' class='form-control' name='q' value='$record[no_hp]'></td></tr>
                    <tr><th scope='row'>Facebook</th>                 <td><input type='text' class='form-control' name='m' value='$record[facebook]'></td></tr>
                    <tr><th scope='row'>Twitter</th>                 <td><input type='text' class='form-control' name='n' value='$record[twitter]'></td></tr>
                    <tr><th scope='row'>Youtube</th>                 <td><input type='text' class='form-control' name='o' value='$record[youtube]'></td></tr>
                    <tr><th scope='row'>Instagram</th>                 <td><input type='text' class='form-control' name='p' value='$record[instagram]'></td></tr>
                    <tr><th scope='row'>Favicon</th>                      <td><input type='file' class='form-control' name='i' value='$record[favicon]' style='display:inline-block; width:300px'> NB: nama file gambar favicon harus favicon.ico <hr style='margin:5px'>
                                                                              Favicon Aktif Saat ini : <img src='".base_url()."asset/$record[favicon]'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
