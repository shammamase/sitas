<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Kuliner Terpilih</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/edit_kuliner',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_kuliner]'>
                    <tr><th width='120px' scope='row'>Judul</th>    <td><input type='text' class='form-control' name='a' value='$rows[judul]' required></td></tr>";
                    echo "
                    <tr><th scope='row'>Headline</th>               <td>"; if ($rows['headline']=='Y'){ echo "<input type='radio' name='c' value='Y' checked> Ya &nbsp; <input type='radio' name='c' value='N'> Tidak"; }else{ echo "<input type='radio' name='c' value='Y'> Ya &nbsp; <input type='radio' name='c' value='N' checked> Tidak"; } echo "</td></tr>
                    <tr><th scope='row'>Isi Berita</th>             <td><textarea id='editor1' class='form-control' name='d' style='height:320px' required>$rows[isi_berita]</textarea></td></tr>
                    <tr><th scope='row'>Ganti Gambar</th>                 <td><input type='file' class='form-control' name='e'>";
                                                                               if ($rows['gambar'] != ''){ echo "<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_kuliner/$rows[gambar]'>$rows[gambar]</a>"; } echo "</td></tr>
                   <tr><th scope='row'>Caption</th><td><input type='text' class='form-control' name='cap' value='$rows[caption]'></td></tr>
                   <tr><th scope='row'>Tag</th><td><textarea class='form-control' name='j'>$rows[tag]</textarea>";
                    echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/kuliner'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
