<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Komentar Berita</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_komentar',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_komentar]'>
                    <tr><th width='120px' scope='row'>Nama</th>   <td><input type='text' class='form-control' name='a' value='$rows[nama_komentar]'></td></tr>
                    <tr><th scope='row'>Website</th>   <td><input type='text' class='form-control' name='b' value='$rows[url]'></td></tr>
                    <tr><th scope='row'>Isi Komentar</th>                 <td><textarea class='textarea form-control' name='c' style='height:220px'>$rows[isi_komentar]</textarea></td></tr>
                    <tr><th scope='row'>Aktif</th>               <td>"; if ($rows['aktif']=='Y'){ echo "<input type='radio' name='d' value='Y' checked> Y &nbsp; <input type='radio' name='d' value='N'> N"; }else{ echo "<input type='radio' name='d' value='Y'> Y &nbsp; <input type='radio' name='d' value='N' checked> N"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/komentar'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";