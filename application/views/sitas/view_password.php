    <div class='col-md-12'>
    
        <div class="card card-outline card-success">
            <div class="card-header">
                <h2 class="card-title">Rubah Password</h2>
        
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <div class="card-body">
                <?php
                $attributes = array('class'=>'form-horizontal','role'=>'form');
                      echo form_open('primer/ganti_password',$attributes);
                ?>
                  <!--<input type="hidden" name="uriss" value="<?php echo $uris ?>">-->
                  <input type="text" class="form-control" name="user" value="<?php echo $user ?>" disabled><br>
                  <input type="text" class="form-control" name="password" placeholder="Isi Password"><br>
                  <button type="submit" name="submit" class="btn btn-success">Ganti Password</button>
                </form>
                  
                  
            </div>
        </div>
    </div>

