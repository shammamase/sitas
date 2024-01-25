            <!-- start banner Area -->
            <section class="banner-area relative" id="home">
                <div class="overlay overlay-bg"></div>  
                <div class="container">
                    <div class="row fullscreen d-flex align-items-center justify-content-between">
                        <div class="banner-content col-lg-9 col-md-12">
                            <h1 class="text-uppercase">
                                <?php echo $titel_satu ?>
                            </h1>
                            <p class="pt-10 pb-10">
                                <?php echo $titel_dua ?>
                            </p>
                            <form action="<?php echo site_url('berita/cari') ?>" method="post" role="form">
                        <!-- Input Group -->
                                <div class="input-group">
                                    <input type="text" name="cari" class="form-control"
                                           placeholder="Type Something"> 
                                    <span class="input-group-btn">
                                        <button type="submit" name="submit" 
                                                class="btn btn-primary">Search
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>                                      
                    </div>
                </div>                  
            </section>
            <!-- End banner Area -->