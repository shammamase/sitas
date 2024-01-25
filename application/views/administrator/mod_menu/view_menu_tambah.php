        <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Menu</h3>
                </div>
              <div class='box-body'>
              <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/tambah_menu',$attributes); 
               ?>
          <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Kategori Menu</th>
                      <td>
                        <select name="a" class="form-control">
                          <option value="">-Pilih Kategori Menu--</option>
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
                          foreach ($page->result_array() as $pg){
                           ?>
                          <div class="col-md-3"><input type="radio" value="<?php echo $pg['id_halaman'] ?>" name="b"> <?php echo $pg['judul'] ?></div>
                          <?php 
                          }
                          ?>
                        </div>
                      </td>
                    </tr>
                    <tr><th scope='row'>Sekunder</th>
                      <td>
                        <div class='checkbox-scroll'>
                          <?php 
                          foreach ($page->result_array() as $pgs){
                           ?>
                          <div class="col-md-3"><input type=checkbox value="<?php echo $pgs['id_halaman'] ?>" name="c[]"> <?php echo $pgs['judul'] ?></div>
                          <?php 
                          }
                          ?>
                        </div>
                      </td>
                    </tr>
                    <tr><th scope='row'>Nama Menu</th><td><input type='text' name='d' class="form-control"></td></tr>
                    <tr><th scope='row'>Icon</th><td><input type='text' name='e' class="form-control"></td></tr>
                    <tr><th scope='row'>URL</th><td><input type='text' name='f' class="form-control"></td></tr>
                    <tr><th scope='row'>Gambar</th><td><input type='file' class='form-control' name='g'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='<?php echo base_url().$this->uri->segment(1)."/menu" ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                  </div>
            </div>
