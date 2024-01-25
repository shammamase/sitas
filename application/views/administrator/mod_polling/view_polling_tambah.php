<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Halaman Baru</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_polling',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Pilihan</th>   <td><input type='text' class='form-control' name='a'></td></tr>
                    <tr><th scope='row'>Aktif</th>               <td><input type='radio' name='b' value='Y' checked> Y &nbsp; <input type='radio' name='b' value='N'> N</td></tr>
                    <tr><th scope='row'>Status</th>               <td><input type='radio' name='c' value='Jawaban'> Jawaban &nbsp; <input type='radio' name='c' value='Pertanyaan' checked> Pertanyaan</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/polling'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
