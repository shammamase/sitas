<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Peserta SPT</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= site_url() ?>sekunder/save_peserta_spt" enctype="multipart/form-data">
            <div class="form-group">
                <label>Peserta</label>
                <select id="is_internal" name="is_internal" style="width: 100%;" class="form-control select2">
                    <?php foreach($is_internal_opsi as $is_intx => $is_inty){ ?>
                        <option value="<?= $is_inty ?>"><?= $is_intx ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" value="<?= $nama ?>">
            </div>
            <div class="form-group">
              <label>NIP</label>
              <input type="text" class="form-control" name="nip" value="<?= $nip ?>">
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <input type="text" class="form-control" name="jabatan" value="<?= $jabatan ?>">
            </div>
            <div class="form-group">
              <label>Pangkat</label>
              <input type="text" class="form-control" name="pangkat" value="<?= $pangkat ?>">
            </div>
            <div class="form-group">
              <label>Gol</label>
              <input type="text" class="form-control" name="gol" value="<?= $gol ?>">
            </div>
            <div class="form-group">
              <label>No HP</label>
              <input type="text" class="form-control" name="no_hp" value="<?= $no_hp ?>">
            </div>
            <div class="form-group">
              <label>Unit Kerja</label>
              <input type="text" class="form-control" id="uk" name="uk" value="<?= $uk ?>">
            </div>
            <input type="hidden" name="status" value="<?= $status ?>">
            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai ?>">
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Save</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
    
    <div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Pegawai</h3>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:25%">Nama</th>
        <th style="width:15%">NIP</th>
        <th style="width:15%">Jabatan</th>
        <th style="width:10%">Pangkat</th>
        <th style="width:10%">Gol</th>
        <th style="width:10%">No HP</th>
        <th style="width:5%">Intern</th>
        <th style="width:8%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        if($rec){
        foreach ($rec as $row){
            if($row->is_internal == 1){
                $nip_peg = $row->nip;
                $jbt_peg = $row->jabatan;
                $pangkat_peg = $row->pangkat;
                $gol_peg = $row->gol;
                $is_internal = "Ya";
            } else {
                $nip_peg = $row->np;
                $jbt_peg = $row->jb;
                $pangkat_peg = $row->pkt;
                $gol_peg = $row->gl;
                $is_internal = "Tidak";
            }
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?= $row->nama ?></td>
        <td><?= $nip_peg ?></td>
        <td><?= $jbt_peg ?></td>
        <td><?= $pangkat_peg ?></td>
        <td><?= $gol_peg ?></td>
        <td><?= $row->no_hp ?></td>
        <td><?= $is_internal ?></td>
        <td>
        <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>sekunder/master_peserta_spt/<?php echo $row->id_pegawai ?>/<?php echo get_kode_uniks($row->id_pegawai) ?>"><i class='fas fa-edit'></i> Edit</a>
        <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>sekunder/hapus_peserta_spt/<?php echo $row->id_pegawai ?>/<?php echo get_kode_uniks($row->id_pegawai) ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>
      </td>
      </tr>
     <?php
      $no++;
        }
    }
      ?>
      </tbody>
    </table>
    </div>
  </div>
</div>
  <!-- /.container-fluid -->
<script>
    $(document).ready(function() {
        $('#is_internal').change(function() {
            if($(this).val() === '1'){
                $('#uk').val('Balai Pengujian Standar Instrumen Tanaman Pemanis dan Serat');
            } else {
                $('#uk').val('');
            }
        });
    });
</script>