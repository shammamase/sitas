    <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Pemesanan</h3>
                </div>
              <div class='box-body'>
              <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open('admin/edit_pemesanan',$attributes); 
               ?>
          <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value="<?php echo $rows['id_pemesanan'] ?>">
                    <tr><th scope='row'>Produk</th>
                      <td>
                        <select name="aa" class="form-control">
                          
                          <option value="<?php echo $rows['id_produk'] ?>"><?php echo $rows['nama_produk'] ?></option>
                          <?php 
                            foreach ($page->result() as $pg) {
                          ?>
                          <option value="<?php echo $pg->id_produk ?>"><?php echo $pg->nama_produk ?></option>
                          <?php
                            }
                           ?>
                           <option value=""></option>
                        </select>
                      </td> 
                    </tr>
                    <tr><th scope='row'>Jumlah</th>                 <td><input type='text' class='form-control' name='a' value="<?php echo $rows['jumlah'] ?>"></td></tr>
                    <tr><th scope='row'>Pelanggan</th>
                      <td>
                        <select name="b" class="form-control">
                          
                          <option value="<?php echo $rows['nik'] ?>"><?php echo $rows['nama'] ?></option>
                          <?php 
                            foreach ($plng->result() as $pl) {
                          ?>
                          <option value="<?php echo $pl->nik ?>"><?php echo $pl->nama ?></option>
                          <?php
                            }
                           ?>
                           <option value=""></option>
                        </select>
                      </td> 
                    </tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href="<?php echo base_url().$this->uri->segment(1).'/pemesanan' ?>"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>
