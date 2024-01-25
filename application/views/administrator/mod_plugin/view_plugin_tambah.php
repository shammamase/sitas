    <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah <?php echo $komp ?></h3>
                </div>
              <div class='box-body'>
              <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/tambah_plugin',$attributes); 
               ?>
          <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <input type="hidden" name="uri" value="<?php echo $uri3 ?>">
                    <tr><th width='120px' scope='row'>Post</th>
                      <td>
                        <select name="a" class="form-control">
                          <option value="">--Pilih Post Berita--</option>
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
                          <option value="">--Pilih Halaman Berita--</option>
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
                      foreach ($proper as $pr) {
                        if ($pr->id_komp==4 AND $pr->properti=="gambar") {
                                 $prope = "Audio";
                              } else {
                                $prope = $pr->properti;
                              }
                    ?>
                    <tr>
                      <th width='120px' scope='row'><?php echo $prope ?></th>
                      <td>
                        <?php 
                            if ($pr->tipe=="textarea") {
                        ?>
                        <textarea id='editor1' class='form-control' name='<?php echo $pr->properti ?>' style='height:320px' required></textarea>
                        <?php
                            } else {
                        ?>
                        <input type="<?php echo $pr->tipe ?>" name="<?php echo $pr->properti ?>" class="form-control">
                        <?php
                            }
                         ?>
                      </td>
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
