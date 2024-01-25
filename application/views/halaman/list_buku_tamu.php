<div class="container-fluid">
    <div class="col-12">
        <div class="card bg-light text-dark mt-5">
          <div class="card-body">
            <div class="row" style="padding:5px">
                <div class="col-lg-6">
                <h5>Terima Kasih Telah Berkunjung di BPTP Gorontalo</h5>
                </div>
                <form class="form-inline" method="post" action="<?php echo site_url('bptp/lap_buku_tamu') ?>" target="_blank">
                <div class="col-xs-2">
                <input size="4" type="text" name="tahun" class="form-control" value="<?php echo date('Y') ?>">
                </div>
                <div style="margin-left:5px" class="col-xs-1">
                <input size="2" type="text" name="bulan" class="form-control" value="<?php echo date('m') ?>">
                </div>
                <div style="margin-left:5px" class="col-xs-1">
                <input size="2" type="text" name="tgl" class="form-control" value="<?php echo date('d') ?>">
                </div>
                <div style="margin-left:5px" class="col-xs-2">
                <button type="submit" name="submit" class="btn btn-success">Export Data</button>
                </div>
                </form>
            </div>
            <div class="table-responsive">
             <table class="table table-hover">
                <thead style="background-color:#1f441e; color:#ffffff">
                  <tr>
                    <th style="width:3%">No</th>
                    <th style="width:15%">Nama</th>
                    <th style="width:7%">No HP</th>
                    <th style="width:10%">Asal Instansi</th>
                    <th style="width:20%">Maksud dan Tujuan</th>
                    <th style="width:20%">Pesan Kesan</th>
                    <th style="width:15%">Ingin Bertemu</th>
                    <th style="width:10%">Waktu</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                 $no = 1;
                 foreach ($listx->result() as $ls) {
                ?>
                 <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $ls->nama ?></td>
                    <td><?php echo $ls->no_hp ?></td>
                    <td><?php echo $ls->asal_instansi ?></td>
                    <td><?php echo $ls->maksud_tujuan ?></td>
                    <td><?php echo $ls->pesan_kesan ?></td>
                    <td><?php echo $ls->nama_peg ?></td>
                    <td><?php echo $ls->waktu ?></td>
                  </tr>
                <?php
                $no++;
                 }
                ?>
                </tbody>
              </table>
              </div>
             <a href="<?php echo site_url('bptp/buku_tamu') ?>"><button type="button" class="btn btn-primary">Buku Tamu</button></a> 
          </div>
        </div>
    </div>
</div>