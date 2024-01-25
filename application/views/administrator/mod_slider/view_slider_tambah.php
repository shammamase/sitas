<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Slider Baru</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/tambah_slider',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Teks</th>    <td><textarea id='editor1' class='form-control' name='a' style='height:320px' required></textarea></td></tr>
                    <tr><th scope='row'>Kategori</th>                    <td><div class='checkbox-scroll'>";
                                                                            foreach ($record->result_array() as $row){
                                                                                echo "<div class='col-md-3'><input type=radio value='$row[id_kat_slider]' name='b'> $row[kat_slider]</div>";
                                                                            }
                    echo "</div></td></tr>
                    <tr><th scope='row'>Headline</th>               <td><input type='radio' name='c' value='Y'> Ya &nbsp; <input type='radio' name='c' value='N' checked> Tidak</td></tr>
                    <tr><th scope='row'>Gambar</th>                 <td><input type='file' class='form-control' name='e'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/slider'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
