<?php 
    $nm_pg = $this->db->query("SELECT judul FROM halamanstatis WHERE id_halaman = '$id_sld'")->row();
	$id_sd = $this->db->query("SELECT * FROM cltr_kat_slider WHERE kat_slider = '$nm_pg->judul'")->row();
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Halaman Statis</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/edit_halamanbaru',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    
                    <input type='hidden' name='id' value='$rows[id_halaman]'>
                    <tr><th width='120px' scope='row'>Judul</th>   <td><input type='text' class='form-control' name='a' value='$rows[judul]'></td></tr>
                    <tr><th scope='row'>Kategori</th>                    <td><div class='checkbox-scroll'>";
                                                                            $_arrNilai = explode(',', $rows['kategori']);
                                                                            foreach ($tag->result_array() as $tag){
                                                                                $_ck = (array_search($tag['id_page'], $_arrNilai) === false)? '' : 'checked';
                                                                                echo "<div class='col-md-3'><input type=radio value='$tag[id_page]' name='bbb' $_ck> $tag[page]</div>";
                                                                            }
                    echo "</div></td></tr>
                    <tr><th scope='row'>Isi Halaman</th>                 <td><textarea id='editor1' class='form-control' name='b' style='height:320px'>$rows[isi_halaman]</textarea></td></tr>
                    <tr><th scope='row'>Ganti Gambar</th>                    <td><input type='file' class='form-control' name='c'><hr style='margin:5px'>";
                                                                               if ($rows['gambar'] != ''){ echo "<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_page/$rows[gambar]'>$rows[gambar]</a>"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/halamanbaru'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";