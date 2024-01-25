    <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit <?php echo $komp ?></h3>
                </div>
              <div class='box-body'>
              <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/edit_plugin',$attributes); 
               ?>
          <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <input type="hidden" name="uri" value="<?php echo $uri3 ?>">
                    <tr><th width='120px' scope='row'>Post</th>
                      <td>
                      <?php
                          $id_post = array(); 
                          $id_hal = array(); 
                          foreach ($plugin->result() as $idp) {
                            $id_post[] = $idp->id_post;
                            $id_hal[] = $idp->id_halaman;
                          }
                          $id_ps = array_unique($id_post);
                          $id_ha = array_unique($id_hal);
                          $id_p = $this->model_berita->berita_row($id_ps[0]);
                          if ($id_ps[0]==0) {
                            $id_pp = "";
                            $pp = "";
                          } else {
                            $id_pp = $id_ps[0];
                            $pp = $id_p->judul;
                          }
                          $id_h = $this->model_halaman->halamanstatis_edit($id_ha[0])->row();
                          if ($id_ha[0]==0) {
                            $id_ha = "";
                            $ha = "";
                          } else {
                            $id_ha = $id_ha[0];
                            $ha = $id_h->judul;
                          }
                       ?>
                        <select name="a" class="form-control">
                          <option value="<?php echo $id_pp ?>"><?php echo $pp ?></option>
                          <?php 
                              foreach ($post as $ps) {
                          ?>
                          <option value="<?php echo $ps->id_post ?>"><?php echo $ps->judul ?></option>
                          <?php
                              }
                           ?>
                        </select>
                      </td>
                    </tr>
                    <tr><th width='120px' scope='row'>Halaman</th>
                      <td>
                        <select name="b" class="form-control">
                          <option value="<?php echo $id_ha ?>"><?php echo $ha ?></option>
                          <?php 
                              foreach ($hal as $hl) {
                          ?>
                          <option value="<?php echo $hl->id_halaman ?>"><?php echo $hl->judul ?></option>
                          <?php
                              }
                           ?>
                        </select>
                      </td>
                    </tr>
                    <?php 
                      foreach ($plugin->result() as $pr) {
                    ?>
                    <tr>
                      <th width='120px' scope='row'><?php echo $pr->properti ?></th>
                      <td><input type="<?php echo $pr->tipe ?>" name="<?php echo $pr->properti ?>" value="<?php echo $pr->plugin ?>" class="form-control"></td>
                    </tr>
                    <input type="hidden" name="id_properti[]" value="<?php echo $pr->id_properti ?>">
                    <?php
                      }
                     ?>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='<?php echo base_url().$this->uri->segment(1) ?>/plugin/<?php echo $uri3 ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>
