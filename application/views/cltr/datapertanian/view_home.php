<div class="animate__animated animate__flipInX animate__infinite animate__slow" style="margin-top:10px;margin-bottom:10px;text-align:center"><img src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/img/core-img/kementa2.png" alt=""></div>
<h3 style="text-align:center;color:white;text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;">Database Pertanian BPTP Gorontalo</h3>
<div style="border-radius:20px" class="card bg-light">
  <div class="card-body">
    <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Data Penyuluh</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Data Gapoktan</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Data Kios Tani</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu3">Data Alokasi Pupuk Subsidi</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu4">Data Bantuan Alsintan</a>
    </li>
     <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu5">Data Bantuan Peternakan</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="tab-pane active"><br>
      <h3>Data Penyuluh</h3>
      <?php
       $db_peny = $this->db->query("select a.*, b.wilayah
                                    from db_penyuluh a
                                    inner join db_wilayah b on a.id_wilayah=b.id_wilayah");
       
      ?>
      <div class="table-responsive">
          <table class="table table-bordered">
           <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Pangkat/Gol</th>
              <th>Keterangan</th>
              <th>Jabatan</th>
              <th>Kabupaten</th>
            </tr>
           </thead>
           <tbody>
            <?php
            $nopy = 1;
            foreach($db_peny->result() as $dbpy){
            ?>
            <tr>
              <td><?= $nopy ?></td>
              <td><?= $dbpy->penyuluh ?></td>
              <td><?= $dbpy->pangkat_gol ?></td>
              <td><?= $dbpy->keterangan ?></td>
              <td><?= $dbpy->jabatan ?></td>
              <td><?= $dbpy->wilayah ?></td>
            </tr>
            <?php
            $nopy++;
            }
            ?>
            
          </tbody>
          </table>
      </div>
    </div>
    
    <div id="menu1" class="tab-pane fade"><br>
      <h3>Data Gapoktan</h3>
      <?php
       $db_gpk = $this->db->query("select a.*, b.wilayah, c.kecamatan
                                    from db_gapoktan a
                                    inner join db_wilayah b on a.id_wilayah=b.id_wilayah
                                    inner join db_kecamatan c on a.id_kecamatan=c.id_kecamatan");
       
      ?>
      <div class="table-responsive">
          <table class="table table-bordered">
           <thead>
            <tr>
              <th>#</th>
              <th>Kecamatan</th>
              <th>Kabupaten</th>
              <th>Tahun</th>
              <th>Desa</th>
              <th>Gapoktan</th>
              <th>Ketua</th>
              <th>Bendahara</th>
              <th>Alamat</th>
              <th>Anggota</th>
            </tr>
           </thead>
           <tbody>
            <?php
            $nogp = 1;
            foreach($db_gpk->result() as $dbg){
            ?>
            <tr>
              <td><?= $nogp ?></td>
              <td><?= $dbg->kecamatan ?></td>
              <td><?= $dbg->wilayah ?></td>
              <td><?= $dbg->tahun ?></td>
              <td><?= $dbg->desa ?></td>
              <td><?= $dbg->gapoktan ?></td>
              <td><?= $dbg->ketua ?></td>
              <td><?= $dbg->bendahara ?></td>
              <td><?= $dbg->alamat ?></td>
              <td><?= $dbg->jml_anggota ?></td>
            </tr>
            <?php
            $nogp++;
            }
            ?>
            
          </tbody>
          </table>
      </div>
    </div>
    
    <div id="menu2" class="tab-pane fade"><br>
      <h3>Data Kios Tani</h3>
     <?php
       $db_kios = $this->db->query("select a.*, b.wilayah, c.kecamatan
                                    from db_kios_tani a
                                    inner join db_wilayah b on a.id_wilayah=b.id_wilayah
                                    inner join db_kecamatan c on a.id_kecamatan=c.id_kecamatan");
       
      ?>
      <div class="table-responsive">
          <table class="table table-bordered">
           <thead>
            <tr>
              <th>#</th>
              <th>Kecamatan</th>
              <th>Kabupaten</th>
              <th>Kios</th>
              <th>Pemilik</th>
              <th>Wilayah Distribusi</th>
              <th>Distributor</th>
            </tr>
           </thead>
           <tbody>
            <?php
            $nokt = 1;
            foreach($db_kios->result() as $dbkt){
            ?>
            <tr>
              <td><?= $nokt ?></td>
              <td><?= $dbkt->kecamatan ?></td>
              <td><?= $dbkt->wilayah ?></td>
              <td><?= $dbkt->kios ?></td>
              <td><?= $dbkt->pemilik ?></td>
              <td><?= $dbkt->wilayah_distribusi ?></td>
              <td><?= $dbkt->distributor ?></td>
            </tr>
            <?php
            $nokt++;
            }
            ?>
            
          </tbody>
          </table>
      </div>
    </div>
    
     <div id="menu3" class="tab-pane fade"><br>
      <h3>Data Alokasi Pupuk Subsidi</h3>
       <?php
       $db_pupuk = $this->db->query("select a.*, b.wilayah, c.kecamatan
                                    from db_alokasi_pupuk_subsidi a
                                    inner join db_wilayah b on a.id_wilayah=b.id_wilayah
                                    inner join db_kecamatan c on a.id_kecamatan=c.id_kecamatan");
       
      ?>
      <div class="table-responsive">
          <table class="table table-bordered">
           <thead>
            <tr>
              <th>#</th>
              <th>Kecamatan</th>
              <th>Kabupaten</th>
              <th>Tahun</th>
              <th>Urea</th>
              <th>SP 36</th>
              <th>ZA</th>
              <th>NPK</th>
              <th>Organik</th>
            </tr>
           </thead>
           <tbody>
            <?php
            $nopk = 1;
            foreach($db_pupuk->result() as $dbppk){
            ?>
            <tr>
              <td><?= $nopk ?></td>
              <td><?= $dbppk->kecamatan ?></td>
              <td><?= $dbppk->wilayah ?></td>
              <td><?= $dbppk->tahun ?></td>
              <td><?= $dbppk->urea ?></td>
              <td><?= $dbppk->sp_36 ?></td>
              <td><?= $dbppk->za ?></td>
              <td><?= $dbppk->npk ?></td>
              <td><?= $dbppk->organik ?></td>
            </tr>
            <?php
            $nopk++;
            }
            ?>
            
          </tbody>
          </table>
      </div>
    </div>
    
    <div id="menu4" class="tab-pane fade"><br>
      <h3>Data Bantuan Alsintan</h3>
       <?php
       $db_bantuan_alsintan = $this->db->query("select a.*, b.wilayah, c.kecamatan
                                    from db_bantuan_alsintan a
                                    inner join db_wilayah b on a.id_wilayah=b.id_wilayah
                                    inner join db_kecamatan c on a.id_kecamatan=c.id_kecamatan");
       
      ?>
      <div class="table-responsive">
          <table class="table table-bordered">
           <thead>
            <tr>
              <th>#</th>
              <th>Kecamatan</th>
              <th>Kabupaten</th>
              <th>Tahun</th>
              <th>Gapoktan</th>
              <th>Desa/Kelurahan</th>
              <th>Nama Ketua</th>
              <th>Jenis Alsintan</th>
              <th>Merk/Tipe</th>
              <th>NIK</th>
              <th>No HP</th>
              <th>Jumlah Unit</th>
              <th>Sumber Dana</th>
            </tr>
           </thead>
           <tbody>
            <?php
            $nobnal = 1;
            foreach($db_bantuan_alsintan->result() as $dbba){
            ?>
            <tr>
              <td><?= $nobnal ?></td>
              <td><?= $dbba->kecamatan ?></td>
              <td><?= $dbba->wilayah ?></td>
              <td><?= $dbba->tahun ?></td>
              <td><?= $dbba->gapoktan ?></td>
              <td><?= $dbba->desa ?></td>
              <td><?= $dbba->nama_ketua ?></td>
              <td><?= $dbba->jenis_alsintan ?></td>
              <td><?= $dbba->merk ?></td>
              <td><?= $dbba->nik ?></td>
              <td><?= $dbba->no_hp ?></td>
              <td><?= $dbba->jumlah_unit ?></td>
              <td><?= $dbba->sumber_dana ?></td>
            </tr>
            <?php
            $nobnal++;
            }
            ?>
            
          </tbody>
          </table>
      </div>
    </div>
    
    <div id="menu5" class="tab-pane fade"><br>
      <h3>Data Bantuan Peternakan</h3>
       <?php
       $db_bantuan_peternakan = $this->db->query("select a.*, b.wilayah
                                    from db_bantuan_peternakan a
                                    inner join db_wilayah b on a.id_wilayah=b.id_wilayah");
       
      ?>
      <div class="table-responsive">
          <table class="table table-bordered">
           <thead>
            <tr>
              <th>#</th>
              <th>Kabupaten</th>
              <th>Tahun</th>
              <th>Indikator</th>
              <th>Jumlah</th>
              <th>Satuan</th>
              <th>Sumber Dana</th>
            </tr>
           </thead>
           <tbody>
            <?php
            $nobpt = 1;
            foreach($db_bantuan_peternakan->result() as $dbpt){
            ?>
            <tr>
              <td><?= $nobpt ?></td>
              <td><?= $dbpt->wilayah ?></td>
              <td><?= $dbpt->tahun ?></td>
              <td><?= $dbpt->indikator ?></td>
              <td><?= $dbpt->jumlah ?></td>
              <td><?= $dbpt->satuan ?></td>
              <td><?= $dbpt->sumber_dana ?></td>
            </tr>
            <?php
            $nobpt++;
            }
            ?>
            
          </tbody>
          </table>
      </div>
    </div>
  </div>
  
  
  </div>
</div>