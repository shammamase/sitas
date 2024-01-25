<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Sub Menu</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_submenu',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Sub Menu</th>  <td><input type='text' class='form-control' name='a'></td></tr>
                    <tr><th scope='row'>Menu Utama</th>              <td><select name='b' class='form-control'>
                                                                            <option value='0' selected>- Pilih Menu Utama -</option>";
                                                                            foreach ($utama->result_array() as $row){
                                                                                echo "<option value='$row[id_main]'>$row[nama_menu]</option>";
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Pilih Sub Menu</th>           <td><select name='c' class='form-control'>
                                                                            <option value='0' selected>- Pilih Sub Menu -</option>";
                                                                            foreach ($submenu->result_array() as $row){
                                                                                echo "<option value='$row[id_sub]'>$row[nama_sub]</option>";
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Link Sub Menu</th>            <td><input type='text' class='form-control' name='d'></td></tr>
                    <tr><th scope='row'>Aktif</th>                    <td><input type='radio' name='e' value='Y' checked> Y <input type='radio' name='e' value='N'> N</td></tr>
                    <tr><th scope='row'>Admin Sub Menu</th>           <td><input type='radio' name='f' value='Y'> Y <input type='radio' name='f' value='N' checked> N</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/submenu'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
