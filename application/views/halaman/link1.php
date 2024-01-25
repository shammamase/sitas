<div class="container">
    <div class="animate__animated animate__flipInX animate__infinite animate__slow" style="margin-top:10px;margin-bottom:10px;text-align:center"><img src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/img/core-img/kementa2.png" alt=""></div>
    
    <div class="col-12">
        <!--
        <div style="border:1px solid black;width:auto;height:100px;padding:10px">
            <div style="border:2px solid #f8b53a;background-color:#000000;opacity:0.1;width:auto;height:80px">
                <h3 style="text-align:center;color:white;text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;">Form Buku Tamu Digital BPTP Gorontalo</h3>
            </div>
        </div>
        -->
        <div class="card text-dark mt-1">
          <div class="card-body">
            <h3 style="text-align:center;color:black;">Bimbingan Teknis Pemanfaatan Benih dan Teknologi Peningkatan Produktivitas Jagung Hibrida Boalemo 24 Agustus 2022</h3>
            
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th colspan="3">Link Materi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Teknologi Produksi Benih Jagung Hibrida</td>
                        <td>Dr. Amin Nur, SP, M.Si</td>
                        <td><a target="_blank" href="https://new.gorontalo.litbang.pertanian.go.id/web/asset/materi/Teknologi_Produksi_Benih_JH_2022.ppt" class="btn btn-success">Download Materi</a></td>
                      </tr>
                      <tr>
                        <td>TEKNOLOGI BUDIDAYA JAGUNG</td>
                        <td>Jaka Sumarno, M.Si</td>
                        <td><a target="_blank" href="https://new.gorontalo.litbang.pertanian.go.id/web/asset/materi/Materi_Jagung_Speklok_2022.ppt" class="btn btn-success">Download Materi</a></td>
                      </tr>
                      <tr>
                        <td>PENGENDALIAN HAMA DAN PENYAKIT TANAMAN JAGUNG</td>
                        <td>Herman Syariat, SP</td>
                        <td><a target="_blank" href="https://new.gorontalo.litbang.pertanian.go.id/web/asset/materi/OPT_Jagung.ppt" class="btn btn-success">Download Materi</a></td>
                      </tr>
                      <tr>
                        <td>PROSEDUR SERTIFIKASI BENIH JAGUNG HIBRIDA</td>
                        <td>LINDAWATY ISIMA, SP. M.Si</td>
                        <td><a target="_blank" href="https://new.gorontalo.litbang.pertanian.go.id/web/asset/materi/Materi_Sertifikasi_Jagung_Hibrida_2022.pptx" class="btn btn-success">Download Materi</a></td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
                  
                  <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th colspan="2">Link Sertifikat Narasumber</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $qw = $this->db->query("select * from sertifikat where kab = 'Boalemo' and pemateri = 1")->result();
                        foreach($qw as $q){
                      ?>
                      <tr>
                        <td><?= $q->nama ?></td>
                        <td><a target="_blank" href="https://new.gorontalo.litbang.pertanian.go.id/web/bptp/sertifikat/Boalemo/<?= $q->id ?>/pemateri" class="btn btn-success">Download Sertifikat</a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>
                  
                  <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Link Sertifikat Peserta</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a target="_blank" href="https://new.gorontalo.litbang.pertanian.go.id/web/bptp/sertifikat/Boalemo" class="btn btn-success">Download Sertifikat</a></td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
            
          </div>
        </div>
    </div>
</div>