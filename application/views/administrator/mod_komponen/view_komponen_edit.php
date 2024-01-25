<?php 
    $sub = $this->model_menu->submenu_edit_nama($rows['komp'])->row();
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Komponen</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/edit_komponen',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_komp]'>
                    <input type='hidden' name='id_sub' value='$sub->id_sub'>
                    <tr><th width='120px' scope='row'>Nama Komponen</th>   <td><input type='text' class='form-control' name='a' value='$rows[komp]'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/kat_menu'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
