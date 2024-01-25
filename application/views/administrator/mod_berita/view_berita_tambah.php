<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Berita Baru</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/tambah_berita',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Judul</th>    <td><input type='text' class='form-control' name='a' required></td></tr>
                    <tr><th scope='row'>Headline</th>               <td><input type='radio' name='c' value='Y'> Ya &nbsp; <input type='radio' name='c' value='N' checked> Tidak</td></tr>
                    <tr><th scope='row'>Isi Berita</th>             <td><textarea id='editor1' class='form-control' name='d' style='height:320px' required></textarea></td></tr>
                    <tr><th scope='row'>Gambar</th>                 <td><input type='file' class='form-control' name='e'></td></tr>
                    <tr><th scope='row'>Thumbnail</th>                 <td><input type='file' class='form-control' name='th'></td></tr>
                    <tr><th scope='row'>Caption</th>                 <td><input type='text' class='form-control' name='cap'></td></tr>
                    <tr><th scope='row'>Kategori</th>                    <td><div class='checkbox-scroll'>";
                                                                            foreach ($tag->result_array() as $tag){
                                                                                echo "<div class='col-md-3'><input type=radio value='$tag[id_page]' name='b'> $tag[page]</div>";
                                                                            }
                    echo "</div></td></tr>
                    <tr><th scope='row'>Tag (Label)</th>            <td><textarea placeholder='contoh: Tag 1,Tag2,Tag 3,dst..(hindari spasi setelah koma)' class='form-control' name='j'></textarea></td></tr>";
                ?>    
                    <tr><th scope='row'>Users</th><td><input type='text' name='u' class='form-control' value='<?php echo $users ?>' readonly>
                    </td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='<?php echo base_url().$this->uri->segment(1) ?>/berita'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
              </div>
            </div>