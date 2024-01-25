<!-- ##### About Area Start ##### -->
    <section class="about-us-area bg-gray section-padding-100-0">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-12 col-lg-12">
                    <!-- Section Heading -->
                    <div class="section-heading">
                        <h2>Link Terkait</h2>
                    </div>
                </div>
                
                <div class="container">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#home">Link Internal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#menu1">Link Eksternal</a>
                    </li>
                  </ul>
                
                  <!-- Tab panes -->
                  <div class="tab-content" style="height:300px;overflow:scroll">
                    <div id="home" class="container tab-pane active"><br>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Url</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $no_link = 1;
                            $qw_link_internal = $this->db->query("select * from t_antar_balai where kategori = 'internal'");
                            foreach($qw_link_internal->result() as $internal ){
                          ?>
                          <tr>
                            <td><?php echo $no_link ?></td>
                            <td><?php echo $internal->nama ?></td>
                            <td><a class="btn btn-sm btn-success" target="_blank" href="<?php echo $internal->url ?>">Link Url</a></td>
                          </tr>
                          <?php
                          $no_link++;
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Url</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $no_linka = 1;
                            $qw_link_eksternal = $this->db->query("select * from t_antar_balai where kategori = 'eksternal'");
                            foreach($qw_link_eksternal->result() as $eks ){
                          ?>
                          <tr>
                            <td><?php echo $no_linka ?></td>
                            <td><?php echo $eks->nama ?></td>
                            <td><a class="btn btn-sm btn-success" target="_blank" href="<?php echo $eks->url ?>">Link Url</a></td>
                          </tr>
                          <?php
                          $no_linka++;
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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