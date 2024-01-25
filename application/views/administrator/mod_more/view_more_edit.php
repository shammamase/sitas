    <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Link Terpilih</h3>
                </div>
              <div class='box-body'>
              <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open('admin/edit_more',$attributes); 
               ?>
          <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value="<?php echo $rows['id_more'] ?>">
                    <tr><th scope='row'>Page</th>
                      <td>
                        <select name="aa" class="form-control">
                          <?php 
                            $nm_pg = $this->model_halaman->page_edit($rows['utama'])->row();
                            if (empty($nm_pg)) {
                              $valx = "";
                            } else {
                              $valx = $nm_pg->page;
                            }
                          ?>
                          <option value="<?php echo $rows['utama'] ?>"><?php echo $valx ?></option>
                          <?php 
                            foreach ($page->result() as $pg) {
                          ?>
                          <option value="<?php echo $pg->id_page ?>"><?php echo $pg->page ?></option>
                          <?php
                            }
                           ?>
                           <option value=""></option>
                        </select>
                      </td> 
                    </tr>
                    <tr><th scope='row'>URL</th>                 <td><input type='text' class='form-control' name='a' value="<?php echo $rows['url'] ?>"></td></tr>
                    <tr><th scope='row'>Nama Website</th>                 <td><input type='text' class='form-control' name='b' value="<?php echo $rows['nama_website'] ?>"></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href="<?php echo base_url().$this->uri->segment(1).'/more' ?>"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>
