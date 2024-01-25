    <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Buat Pemesanan</h3>
                </div>
              <div class='box-body'>
              <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open('admin/tambah_pemesanan',$attributes); 
               ?>
          <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    
                    <tr><th scope='row'>Produk</th>                 
                    <td>
                    <select name='aa' class='form-control'>
                      <option>-Pilih Produk-</option>
                      <?php 
                          foreach ($page->result() as $pg) {
                      ?><option value="<?php echo $pg->id_produk ?>"><?php echo $pg->nama_produk ?></option> <?php
                          }
                       ?>
                    </select></td></tr>
                    <tr><th scope='row'>Jumlah</th>                 <td><input type='text' class='form-control' name='a'></td></tr>
                    <tr><th scope='row'>Pelanggan</th>                 
                    <td>
                    <select name='b' class='form-control'>
                      <option>-Pilih Pelanggan-</option>
                      <?php 
                          foreach ($plng->result() as $pl) {
                      ?><option value="<?php echo $pl->nik ?>"><?php echo $pl->nama ?></option> <?php
                          }
                       ?>
                    </select></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href="<?php echo base_url().$this->uri->segment(1).'/pemesanan' ?>"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>
