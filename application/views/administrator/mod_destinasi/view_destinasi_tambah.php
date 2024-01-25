<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Destinasi Baru</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/tambah_destinasi',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Judul</th>    <td><input type='text' class='form-control' name='a' required></td></tr>
                    <tr><th scope='row'>Wilayah</th>               <td><select name='b' class='form-control' required>
                                                                            <option value='' selected>- Pilih Wilayah -</option>";
                                                                            foreach ($record->result_array() as $row){
                                                                                echo "<option value='$row[id_wilayah]'>$row[nama_wilayah]</option>";
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Headline</th>               <td><input type='radio' name='c' value='Y'> Ya &nbsp; <input type='radio' name='c' value='N' checked> Tidak</td></tr>
                    <tr><th scope='row'>Isi Konten</th>             <td><textarea id='editor1' class='form-control' name='d' style='height:320px' required></textarea></td></tr>
                    <tr><th scope='row'>Gambar</th>                 <td><input type='file' class='form-control' name='e'></td></tr>
                    <tr><th scope='row'>Caption</th>                 <td><input type='text' class='form-control' name='cap'></td></tr>
                    <tr><th scope='row'>Tag (Label)</th>            <td><textarea class='form-control' name='j'></textarea></td></tr>
                    <tr><th scope='row'>Users</th>               <td><input type='text' name='u' class='form-control' value='$users' readonly>";
                    echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/destinasi'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
