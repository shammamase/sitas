<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Banner</h3>
                </div>
              <div class='box-body'>
              <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/tambah_banner',$attributes); 
               ?>
              <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Kategori</th>    <td>
                    <select name='kat_banner' class='form-control'>
                      <option value="">Kategori</option>
                      <?php 
                          $kt_bn = $this->model_iklan->kat_banner();
                          foreach ($kt_bn->result() as $kbn) {
                      ?>
                      <option value="<?php echo $kbn->id_kat_banner ?>"><?php echo $kbn->kat_banner ?></option>
                      <?php
                          }
                       ?>
                    </select>
                    </td></tr>
                    <tr><th width='120px' scope='row'>Judul</th>    <td><input type='text' class='form-control' name='a' required></td></tr>
                    <tr><th width='120px' scope='row'>Url</th>    <td><input type='url' class='form-control' name='b'></td></tr>
                    <tr><th width='120px' scope='row'>Gambar</th>    <td><input type='file' class='form-control' name='c'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='<?php echo base_url().$this->uri->segment(1)."/banner" ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>       
                  </div>
            </div>
