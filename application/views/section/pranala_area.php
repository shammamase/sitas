<!-- ##### About Area Start ##### -->
    <section class="about-us-area section-padding-100-0">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-12 col-lg-12">
                    <!-- Section Heading -->
                    <div class="section-heading">
                        <h2>Pranala Lainnya</h2>
                    </div>
                </div>
                
                
                  
                  
                  <?php 
                    $qw_pranala = $this->db->query("select * from cltr_menu where id_kat_menu = 10");
                    foreach($qw_pranala->result() as $pra ){
                  ?>
                    <div style="margin-top:10px" class="col-4 col-md-3 col-lg-3">
                        <a href="<?php echo $pra->url ?>" target="_blank"><img width="200" height="50" src="<?php echo base_url() ?>asset/foto_menu/<?php echo $pra->gambar ?>"></a>
                    </div>
                  <?php
                    }
                  ?>
                        
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="border-line"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### About Area End ##### -->