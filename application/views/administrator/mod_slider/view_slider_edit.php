<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Slider Terpilih</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/edit_slider',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_slider]'>
                    <tr><th width='120px' scope='row'>Teks</th>    <td><textarea id='editor1' class='form-control' name='a' style='height:320px' required>$rows[teks]</textarea></td></tr>
                    <tr><th scope='row'>Kategori</th>                    <td><div class='checkbox-scroll'>";
                                                                            $_arrNilai = explode(',', $rows['id_kat_slider']);
                                                                            foreach ($record->result_array() as $row){
                                                                                $_ck = (array_search($row['id_kat_slider'], $_arrNilai) === false)? '' : 'checked';
                                                                                echo "<div class='col-md-3'><input type=radio value='$row[id_kat_slider]' name='b' $_ck> $row[kat_slider]</div>";
                                                                            }
                    echo "</div></td></tr>
                    <tr><th scope='row'>Headline</th>               <td>"; if ($rows['status']=='Y'){ echo "<input type='radio' name='c' value='Y' checked> Ya &nbsp; <input type='radio' name='c' value='N'> Tidak"; }else{ echo "<input type='radio' name='c' value='Y'> Ya &nbsp; <input type='radio' name='c' value='N' checked> Tidak"; } echo "</td></tr>
                    <tr><th scope='row'>Ganti Gambar</th>                 <td><input type='file' class='form-control' name='e'>";
                                                                               if ($rows['slider'] != ''){ echo "<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_slider/$rows[slider]'>$rows[slider]</a>"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/slider'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
