<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Verifikasi Berita User</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/edit_berita',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_post]'>
                    <input type='hidden' name='gbr1' value='$rows[gambar]'>
                    <input type='hidden' name='thm1' value='$rows[thumbnail]'>
                    <tr><th width='120px' scope='row'>Judul</th>    <td><input type='text' class='form-control' name='a' value='$rows[judul]' required></td></tr>
                    <tr><th scope='row'>Headline</th>               <td>"; if ($rows['headline']=='Y'){ echo "<input type='radio' name='c' value='Y' checked> Ya &nbsp; <input type='radio' name='c' value='N'> Tidak"; }else{ echo "<input type='radio' name='c' value='Y'> Ya &nbsp; <input type='radio' name='c' value='N' checked> Tidak"; } echo "</td></tr>
                    <tr><th scope='row'>Isi Berita</th>             <td><textarea id='editor1' class='form-control' name='d' style='height:320px' required>$rows[isi_berita]</textarea></td></tr>
                    <tr><th scope='row'>Ganti Gambar</th>                 <td><input type='file' class='form-control' name='e'>";
                                                                               if ($rows['gambar'] != ''){ echo "<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_content/$rows[gambar]'>$rows[gambar]</a>"; } echo "</td></tr>
                    <tr><th scope='row'>Ganti Thumbnail</th>                 <td><input type='file' class='form-control' name='th'>";
                                                                               if ($rows['gambar'] != ''){ echo "<i style='color:red'>Lihat Thumbnail Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_content/$rows[thumbnail]'>$rows[thumbnail]</a>"; } echo "</td></tr>
                    <tr><th scope='row'>Caption</th>                 <td><input type='text' class='form-control' name='cap' value='$rows[caption]'></td></tr>
                    <tr><th scope='row'>Kategori</th>                    <td><div class='checkbox-scroll'>";
                                                                            $_arrNilai = explode(',', $rows['id_page']);
                                                                            foreach ($tag->result_array() as $tag){
                                                                                $_ck = (array_search($tag['id_page'], $_arrNilai) === false)? '' : 'checked';
                                                                                echo "<div class='col-md-3'><input type=radio value='$tag[id_page]' name='b' $_ck> $tag[page]</div>";
                                                                            }
                    echo "</div></td></tr>
                    <tr><th scope='row'>Tag (Label)</th>            <td><textarea class='form-control' name='j'>$rows[tag]</textarea></td></tr>
                    <tr><th scope='row'>Users</th>               <td><input type='text' name='u' class='form-control' value='$rows[username]' readonly>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Accept</button>
                    <a href='".base_url().$this->uri->segment(1)."/berita_user'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
