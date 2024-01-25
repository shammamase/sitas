        <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Properti</h3>
                </div>
              <div class='box-body'>
              <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('admin/tambah_properti',$attributes); 
               ?>
          <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Komponen</th>
                      <td>
                        <select name="a" class="form-control">
                          <option value="">-Pilih Komponen--</option>
                          <?php 
                            foreach ($komp->result() as $km) {
                          ?><option value="<?php echo $km->id_komp ?>"><?php echo $km->komp ?></option> <?php
                            }
                           ?>
                        </select>
                      </td>
                    </tr>
                    <tr><th scope='row'>Properti</th><td><input type='text' name='b' class="form-control"></td></tr>
                    <tr><th scope='row'>Tipe</th><td><input type='text' name='c' class="form-control"></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='<?php echo base_url().$this->uri->segment(1)."/menu" ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                  </div>
            </div>
