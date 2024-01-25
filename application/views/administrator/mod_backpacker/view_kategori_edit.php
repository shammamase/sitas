<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Kategori Backpacker</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/edit_kat_backpacker',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_kat_backpacker]'>
                    <tr><th width='120px' scope='row'>Nama Kategori</th>    <td><input type='text' class='form-control' name='a' value='$rows[nama_kat_backpacker]' required></td></tr>
                    <tr><th scope='row'>Aktif</th>                          <td>"; if ($rows['aktif']=='Y'){ echo "<input type='radio' name='b' value='Y' checked> Ya &nbsp; <input type='radio' name='b' value='N'> Tidak"; }else{ echo "<input type='radio' name='b' value='Y'> Ya &nbsp; <input type='radio' name='b' value='N' checked> Tidak"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/kat_backpacker'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";