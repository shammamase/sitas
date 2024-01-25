<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Sub Menu</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_submenu',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_sub]'>
                    <tr><th width='120px' scope='row'>Sub Menu</th>  <td><input type='text' class='form-control' name='a' value='$rows[nama_sub]'></td></tr>
                    <tr><th scope='row'>Menu Utama</th>              <td><select name='b' class='form-control'>
                                                                            <option value='0' selected>- Pilih Menu Utama -</option>";
                                                                            foreach ($utama->result_array() as $row){
                                                                                if ($rows['id_main']==$row['id_main']){
                                                                                  echo "<option value='$row[id_main]' selected>$row[nama_menu]</option>";
                                                                                }else{
                                                                                  echo "<option value='$row[id_main]'>$row[nama_menu]</option>";
                                                                                }
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Pilih Sub Menu</th>           <td><select name='c' class='form-control'>
                                                                            <option value='0' selected>- Pilih Sub Menu -</option>";
                                                                            foreach ($submenu->result_array() as $row){
                                                                              if ($rows['id_submain']==$row['id_sub']){
                                                                                echo "<option value='$row[id_sub]' selected>$row[nama_sub]</option>";
                                                                              }else{
                                                                                echo "<option value='$row[id_sub]'>$row[nama_sub]</option>";
                                                                              }
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Link Sub Menu</th>            <td><input type='text' class='form-control' name='d' value='$rows[link_sub]'></td></tr>
                    <tr><th scope='row'>Aktif</th>                  <td>"; if ($rows['aktif'] == 'Y'){
                                                                                echo "<input type='radio' name='e' value='Y' checked> Y 
                                                                                      <input type='radio' name='e' value='N'> N";
                                                                              }else{
                                                                                echo "<input type='radio' name='e' value='Y'> Y 
                                                                                      <input type='radio' name='e' value='N' checked> N";
                                                                              }
                    echo "</td></tr>
                    <tr><th scope='row'>Admin Sub Menu</th>                  <td>"; if ($rows['adminsubmenu'] == 'Y'){
                                                                                echo "<input type='radio' name='f' value='Y' checked> Y 
                                                                                      <input type='radio' name='f' value='N'> N";
                                                                              }else{
                                                                                echo "<input type='radio' name='f' value='Y'> Y 
                                                                                      <input type='radio' name='f' value='N' checked> N";
                                                                              }
                    echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/submenu'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
