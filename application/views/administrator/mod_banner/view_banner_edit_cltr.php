      <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Banner</h3>
                </div>
              <div class='box-body'>
              <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/edit_banner',$attributes); 
               ?>
              <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='<?php echo $rows['id_banner'] ?>'>
                    <tr><th width='120px' scope='row'>Kategori</th>
                      <td>
                        <select name="kat_banner" class="form-control">
                        <?php 
                          $nm_bnx = $this->model_iklan->kat_banner_row($rows['id_kat_banner'])->row();
                            if (empty($nm_bnx)) {
                              $valb = "";
                            } else {
                              $valb = $nm_bnx->kat_banner;
                            }
                         ?>
                          <option value="<?php echo $rows['id_kat_banner'] ?>"><?php echo $valb  ?></option>
                          <?php
                            $kt_bn = $this->model_iklan->kat_banner(); 
                            foreach ($kt_bn->result() as $kbnn) {
                          ?><option value="<?php echo $kbnn->id_kat_banner ?>"><?php echo $kbnn->kat_banner ?></option> <?php
                            }
                           ?>
                        </select>
                      </td>
                    </tr>
                    <tr><th width='120px' scope='row'>Judul</th>    <td><input type='text' class='form-control' name='a' value='<?php echo $rows['judul'] ?>' required></td></tr>
                    <tr><th width='120px' scope='row'>Url</th>    <td><input type='url' class='form-control' name='b' value='<?php echo $rows['url'] ?>'></td></tr>
                    <tr><th width='120px' scope='row'>Gambar</th>    <td><input type='file' class='form-control' name='c'>
                                                                    <?php if ($rows['gambar'] != ''){ echo "Lihat Gambar : <a target='_BLANK' href='".base_url()."asset/foto_banner_cltr/$rows[gambar]'>$rows[gambar]</a>"; } echo "</td></tr>"; ?>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='<?php echo base_url().$this->uri->segment(1)."/banner" ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>
