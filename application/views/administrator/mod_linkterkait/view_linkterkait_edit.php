<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Link Terkait</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_linkterkait',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_link_terkait]'>
                    <tr><th width='120px' scope='row'>Info</th>              <td><input type='text' class='form-control' name='a' value='$rows[judul]' required></td></tr>
                    <tr><th width='120px' scope='row'>Url</th>    <td><input type='text' class='form-control' name='c' value='$rows[url]' required></td></tr>
                    <tr><th scope='row'>Posisi</th>               <td>"; if ($rows['posisi']=='content'){ echo "<input type='radio' name='d' value='content' checked> Content &nbsp; <input type='radio' name='d' value='sidebar'> Sidebar"; }else{ echo "<input type='radio' name='d' value='content'> Content &nbsp; <input type='radio' name='d' value='sidebar' checked> Sidebar"; } echo "</td></tr>
                    <tr><th scope='row'>Ganti Gambar</th>                    <td><input type='file' class='form-control' name='b'><hr style='margin:5px'>";
                                                                               if ($rows['icon'] != ''){ echo "<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_linkterkait/$rows[icon]'>$rows[icon]</a>"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";