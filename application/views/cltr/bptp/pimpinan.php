<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(<?php echo base_url() ?>template/<?php echo template_cltr() ?>/assets/img/bg-img/24_2.jpg);">
        <h2><?php echo $title ?></h2>
    </div>
</div>
<br>
<section class="blog-content-area section-padding-0-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Blog Posts Area -->
            <div class="col-12 col-md-12 col-lg-12">
                
                <button type="button" class="btn btn-outline-success btn-block btn-lg" data-toggle="modal" data-target="#kabalai">Kepala Balai</button>
                
                <!--
                <div class="blog-posts-area">
                    
                    <div class="single-post-details-area">
                        <div class="post-content">
                            <div style="text-align:center" class="post-thumbnail mb-30">
                                <img class="img-thumbnail" style="width:200px;height:133px" src="<?php echo base_url() ?>asset/foto_content/<?php echo $foto ?>" alt="">
                            </div>
                            <h3><?php echo $nama ?></h3>
                            <h6><?php echo $no_hp ?></h6>
                            <h6><?php echo $email ?></h6>
                            <h6><?php echo $alamat ?></h6>
                            <p><?php echo $about ?></p>
                            <p style="margin-top:-10px">Penghargaan Yang Pernah Diterima :</p>
                        </div>
                    </div>
                </div>
                -->
            </div>
            <!--<div class="row">-->
                <?php 
                    $idn = 1;
                    $qw_pejabat = $this->db->query("select * from t_biodata where id_bio in (5,23,24) order by id_bio desc");
                    foreach($qw_pejabat->result() as $get_pj){
                        if($idn==1){
                            $jabatan = "Kasubag Tata Usaha";
                            $penghargaan = "";
                        } else if($idn==2){
                            $jabatan = "Sub Koordinator KSPP";
                            $penghargaan = "";
                        } else if($idn==3){
                            $jabatan = "Sub Koordinator Program";
                            $penghargaan = "";
                        }
                ?>
                
                <div class="col-12 col-md-12 col-lg-12">
                    <button style="margin-top:10px" type="button" class="btn btn-outline-success btn-block btn-lg" data-toggle="modal" data-target="#pjs<?php echo $idn ?>"><?php echo $jabatan ?></button>
                </div>
                
                
                <!--
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="blog-posts-area">
    
                        
                        <div class="single-post-details-area">
                            <div class="post-content">
                                <div style="text-align:center" class="post-thumbnail">
                                    <img class="img-thumbnail" src="<?php echo base_url() ?>asset/foto_content/<?php echo $get_pj->photo_profil ?>" alt="">
                                </div>
                                <h5 align="center" class="text-success"><?php echo $jabatan ?></h5>
                                <div style="padding:10px" class="bg-success">
                                    <h5 class="text-white" style="font-size:15px"><?php echo $get_pj->nama ?></h5>
                                    <h5 class="text-white" style="font-size:15px"><?php echo $get_pj->alamat ?></h5>
                                    <h5 class="text-white" style="font-size:15px"><?php echo $get_pj->no_kantor ?></h5>
                                    <!--<h6 class="text-white" style="font-size:15px"><?php echo $get_pj->alamat ?></h6>-->
              <!--
                                    <h6 class="text-white"><?php echo $get_pj->alamat_tinggal ?></h6>
                                    <h6 class="text-white">Penghargaan Yang Pernah Diterima :</h6>
                                    <h6 class="text-white"><?php echo $penghargaan ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                -->
                
                <div class="modal fade" id="pjs<?php echo $idn ?>">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                      
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title"></h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
                          <div class="row">
                              <div class="col-12 col-lg-6 col-md-6">
                                  <div style="text-align:center" class="post-thumbnail mb-30">
                                  <img class="img-thumbnail" src="<?php echo base_url() ?>asset/foto_content/<?php echo $get_pj->photo_profil ?>" alt="">
                                  </div>
                              </div>
                              <div class="col-12 col-lg-6 col-md-6">
                                  <table style="width:100%" class="table table-striped">
                                    <tbody>
                                      <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><?php echo $get_pj->nama ?></td>
                                      </tr>
                                      <tr>
                                        <td>Jabatan</td>
                                        <td>:</td>
                                        <td><?php echo $jabatan ?></td>
                                      </tr>
                                      <tr>
                                        <td>No Telp</td>
                                        <td>:</td>
                                        <td><?php echo $get_pj->no_kantor ?></td>
                                      </tr>
                                      <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td><?php echo $get_pj->alamat ?></td>
                                      </tr>
                                      <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td><?php echo $get_pj->alamat_tinggal ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-12 col-lg-12 col-md-12">
                                  <div class="card">
                                    <div class="card-header bg-success text-white">Profil</div>
                                    <div class="card-body">
                                        <p style="text-align:justify"><?php echo $get_pj->about ?></p>
                                        <br/><br/>
                                        <p style="margin-top:-10px">Penghargaan Yang Pernah Diterima :</p>
                                        <p><?php echo $penghargaan ?></p>
                                    </div> 
                                  </div>
                              </div>
                          </div>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                <?php
                $idn++;
                    }
                ?>
            <!--</div>-->
        </div>
    </div>
    
    <!-- modal -->
    <!-- The Modal -->
  <div class="modal fade" id="kabalai">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="row">
              <div class="col-12 col-lg-6 col-md-6">
                  <div style="text-align:center" class="post-thumbnail mb-30">
                  <!--<img class="img-thumbnail" style="width:200px;height:133px" src="<?php echo base_url() ?>asset/foto_content/<?php echo $foto ?>" alt="">-->
                  <img class="img-thumbnail" src="<?php echo base_url() ?>asset/foto_content/<?php echo $foto ?>" alt="">
                  </div>
              </div>
              <div class="col-12 col-lg-6 col-md-6">
                  <table style="width:100%" class="table table-striped">
                    <tbody>
                      <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo $nama ?></td>
                      </tr>
                      <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>Kepala Balai</td>
                      </tr>
                      <tr>
                        <td>No Telp</td>
                        <td>:</td>
                        <td><?php echo $no_hp ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $email ?></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $alamat ?></td>
                      </tr>
                    </tbody>
                  </table>
              </div>
          </div>
          <div class="row">
              <div class="col-12 col-lg-12 col-md-12">
                  <div class="card">
                    <div class="card-header bg-success text-white">Profil</div>
                    <div class="card-body">
                        <?php echo $about ?>
                        <br/><br/>
                        <p style="margin-top:-10px">Penghargaan Yang Pernah Diterima :</p>
                    </div> 
                  </div>
              </div>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

</section>
<!-- ##### Blog Content Area End ##### -->
