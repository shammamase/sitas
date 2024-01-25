        <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Menu</h3>
                </div>
              <div class='box-body'>
              <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/edit_menu',$attributes); 
               ?>
          <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='<?php echo $rows['id_menu'] ?>'>
                    <input type='hidden' name='gm' value='<?php echo $rows['gambar'] ?>'>
                    <tr><th width='120px' scope='row'>Kategori Menu</th>
                      <td>
                        <select name="a" class="form-control">
                        <?php 
                          $nm_kt = $this->model_menu->list_menu_edit($rows['id_kat_menu'])->row();
                            if (empty($nm_kt)) {
                              $valx = "";
                            } else {
                              $valx = $nm_kt->kat_menu;
                            }
                         ?>
                          <option value="<?php echo $rows['id_kat_menu'] ?>"><?php echo $valx  ?></option>
                          <?php 
                            foreach ($kat_menu->result() as $km) {
                          ?><option value="<?php echo $km->id_kat_menu ?>"><?php echo $km->kat_menu ?></option> <?php
                            }
                           ?>
                        </select>
                      </td>
                    </tr>
                    <tr><th scope='row'>Utama</th>
                      <td>
                        <div class='checkbox-scroll'>
                          <?php
                          $bnl = explode(",", $rows['utama']); 
                          $bnr = explode(",", $rows['sekunder']); 
                          foreach ($page->result_array() as $pg){
                            $ck = (array_search($pg['id_halaman'], $bnl) === false)? '' : 'checked';
                           ?>
                          <div class="col-md-3"><input type="radio" value="<?php echo $pg['id_halaman'] ?>" name="b" <?php echo $ck ?>> <?php echo $pg['judul'] ?></div>
                          <?php 
                          }
                          ?>
                          <div class="col-md-3"><input type="radio" value="" name="b"> Tidak Ada</div>
                        </div>
                      </td>
                    </tr>
                    <tr><th scope='row'>Sekunder</th>
                      <td>
                        <div class='checkbox-scroll'>
                          <?php 
                          foreach ($page->result_array() as $pgs){
                            $cks = (array_search($pgs['id_halaman'], $bnr) === false)? '' : 'checked';
                           ?>
                          <div class="col-md-3"><input type="checkbox" value="<?php echo $pgs['id_halaman'] ?>" name="c[]" <?php echo $cks ?>> <?php echo $pgs['judul'] ?></div>
                          <?php 
                          }
                          ?>
                        </div>
                      </td>
                    </tr>
                    <tr><th scope='row'>Nama Menu</th><td><input type='text' name='d' class="form-control" value="<?php echo $rows['nama_menu'] ?>"></td></tr>
                    <tr><th scope='row'>Icon</th><td><input type='text' name='e' class="form-control" value="<?php echo $rows['icon'] ?>"></td></tr>
                    <tr><th scope='row'>URL</th><td><input type='text' name='f' class="form-control" value="<?php echo $rows['url'] ?>"></td></tr>
                    <tr><th scope='row'>Gambar Sekarang</th><td><img src="<?php echo base_url()."asset/foto_menu/".$rows['gambar'] ?>" alt="" width="100px" height="auto"></td></tr>
                    <tr><th scope='row'>Gambar</th><td><input type='file' class='form-control' name='g'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='<?php echo base_url().$this->uri->segment(1)."/menu" ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                  </div>
            </div>
