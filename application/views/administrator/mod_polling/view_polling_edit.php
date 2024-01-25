<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Polling</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_polling',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_poling]'>
                    <tr><th width='120px' scope='row'>Pilihan</th>   <td><input type='text' class='form-control' name='a' value='$rows[pilihan]'></td></tr>
                    <tr><th scope='row'>Aktif</th>               <td>"; if ($rows['aktif']=='Y'){ echo "<input type='radio' name='b' value='Y' checked> Y &nbsp; <input type='radio' name='b' value='N'> N"; }else{ echo "<input type='radio' name='b' value='Y'> Y &nbsp; <input type='radio' name='b' value='N' checked> N"; } echo "</td></tr>
                    <tr><th scope='row'>Status</th>               <td>"; if ($rows['status']=='Jawaban'){ echo "<input type='radio' name='c' value='Jawaban' checked> Jawaban &nbsp; <input type='radio' name='c' value='Pertanyaan'> Pertanyaan"; }else{ echo "<input type='radio' name='c' value='Jawaban'> Jawaban &nbsp; <input type='radio' name='c' value='Pertanyaan' checked> Pertanyaan"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/polling'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";