<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar SPT</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <!--<th style="width:23%">SPT</th>-->
        <th style="width:23%">No Surat</th>
        <th style="width:23%">Kepada</th>
        <th style="width:27%">Untuk</th>
        <th style="width:7%">Tanggal</th>
        <!--<th style="width:7%">Tanggal SPT</th>-->
        <th style="width:8%">DIPA</th>
        <th style="width:10%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        $no_hp = $petugas->no_hp;
        $no_wa = substr_replace("$no_hp","62",0,1);
        $links = base_url()."primer?redir=buat_surat";
        $pesan = "Layanan BSIP TAS Ada pengajuan SPT silahkan klik link $links";
        foreach ($rec as $row){
            /*
            $links = base_url()."sijuara/verif_spt_detail/".$row->id_spt;
            $pesan = "*Layanan Aplikasi* Mohon untuk mengecek pengajuan SPT, silahkan klik link $links";
            */
            $pc_tgl = explode("-",$row->tanggal_input);
            if($row->id_surat_keluar == NULL and $row->id_surat_keluar == 0){
                $no_surat = "";
                $file_pdf = "";
                $id_verif = 0;
            } else {
                $surat_keluar = $this->model_sitas->rowDataBy("no_surat_keluar,file_pdf,id_verif","surat_keluar","id_surat_keluar=$row->id_surat_keluar")->row();
                $no_surat = "B-".$surat_keluar->no_surat_keluar."/TU.040/H.4.2/".$pc_tgl[1]."/".$pc_tgl[0];
                $id_verif = $surat_keluar->id_verif;
                if($surat_keluar->file_pdf == ""){
                  $file_pdf = "";
                } else {
                  $file_pdf = $surat_keluar->file_pdf;
                }
            }
            $kpda = $this->model_sitas->listDataBy("a.tanggal_spt,b.nama","anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai",
                      "a.id_spt=$row->id_spt","a.id_anggota asc");
            //$no_surat = $this->model_more->get_surat_spt($row->id_spt);
            if($row->is_dipa==1){
                $dip = "Ya";
            } else {
                $dip = "Tidak";
            }
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <!--<td><?php echo $row->menimbang ?></td>-->
        <td><?= $no_surat ?></td>
        <td>
                <?php
                $nok = 1;
                foreach($kpda as $kpd){
                    $tgl_plk = $kpd->tanggal_spt;
                ?>
                <?= $nok.". ".konversi_nama_peg($kpd->nama) ?><br>
                <?php
                $nok++;
                }
                
                //logika tgl s.d tgl
                $pc_tgl_plk = explode(",",$tgl_plk);
                $jml_tgl = count($pc_tgl_plk);
                if($jml_tgl>1){
                    $pc1 = explode("-",$pc_tgl_plk[0]);
                    $pc2 = explode("-",end($pc_tgl_plk));
                    if($pc1[1]==$pc2[1]){
                        $val_tgl = $pc1[2]." s.d ".tgl_indo(end($pc_tgl_plk));
                    } else {
                        $pc11 = explode(" ",tgl_indo($pc_tgl_plk[0]));
                        $val_tgl = $pc11[0]." ".$pc11[1]." s.d ".tgl_indo(end($pc_tgl_plk));
                    }
                } else {
                    $val_tgl = tgl_indo($pc_tgl_plk[0]);
                }
                // end logika tgl s.d tgl
                ?>
        </td>
        <td><?php echo $row->untuk ?></td>
        <td><?php echo $val_tgl ?></td>
        <!--<td><?php echo tgl_indoo($row->tanggal) ?></td>-->
        <td><?php echo $dip ?></td>
        <td>
            <?php
            if($row->id_verif!=0){
            ?>
            <a class='btn btn-warning btn-xs' title='Copy Data' href="<?php echo base_url() ?>primer/copy_spt?id_spt=<?php echo $row->id_spt ?>"><i class='fas fa-copy'></i> Copy</a>
            <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>primer/data_spt/<?php echo $row->id_spt ?>"><i class='fas fa-edit'></i> Edit</a>
            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>primer/delete_spt/<?php echo $row->id_spt ?>/<?= get_kode_uniks($row->id_spt) ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>
            <button class='btn btn-primary btn-xs' data-target="#myModalsx" data-toggle="modal" data-id="<?= $row->id_spt ?>"><i class='fas fa-file'></i> Lihat</button>
            <a class='btn btn-danger btn-xs' title='PDF' target="_blank" href="<?php echo base_url() ?>sijuara/pdf_spt/<?php echo md5($row->id_spt) ?>/<?= $row->id_spt ?>"><i class='fas fa-file-pdf'></i> PDF Scan</a>
            <a class='btn btn-danger btn-xs' title='PDF' target="_blank" href="<?php echo base_url() ?>sijuara/pdf_spt_manual/<?php echo md5($row->id_spt) ?>/<?= $row->id_spt ?>"><i class='fas fa-file-pdf'></i> PDF Asli</a>
            <?php
            } else {
            ?>
              <?php if($row->id_surat_keluar == NULL and $row->id_surat_keluar == 0){ ?>
                  <?php if($row->ajukan == 1){ ?>
                    <a href="<?= base_url() ?>primer/status_spt/<?= $row->id_spt ?>/<?= get_kode_uniks($row->id_spt) ?>" class="btn btn-primary btn-xs"><i class="fas fa-list"></i> Status</a>
                    <a class="btn btn-warning btn-xs" style="cursor:pointer" data-toggle="modal" data-id="<?= $row->id_spt ?>" data-target="#no_sppd"><i class="fas fa-edit"></i> SPPD</a>
                    <a target="_blank" href="<?= base_url('preview/sppd/') ?><?= $row->id_spt ?>" class="btn btn-danger btn-xs"><i class="fas fa-file-pdf"></i> SPPD</a>
                  <?php } else { ?>
                    <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>primer/data_spt/<?php echo $row->id_spt ?>"><i class='fas fa-edit'></i> Edit</a>
                    <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>primer/delete_spt/<?php echo $row->id_spt ?>/<?= get_kode_uniks($row->id_spt) ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>
                    <a class='btn btn-info btn-xs' title='Kirim' href="<?= base_url() ?>primer/kirim_pesan?no_wa=<?= $no_wa ?>&pesan=<?= $pesan ?>&ctrl=daftar_spt&id_spt=<?= $row->id_spt ?>&kode_unik=<?= get_kode_uniks($row->id_spt) ?>"><i class='fa fa-share'></i> Kirim</a>
                    <button class='btn btn-primary btn-xs' data-target="#myModalsx" data-toggle="modal" data-id="<?= $row->id_spt ?>"><i class='fas fa-file'></i> Lihat</button>
                  <?php } ?>
              <?php } else { ?>
              <?php if($row->is_dipa == 1){ ?>
                <a href="<?= base_url() ?>primer/status_spt/<?= $row->id_spt ?>/<?= get_kode_uniks($row->id_spt) ?>" class="btn btn-primary btn-xs"><i class="fas fa-list"></i> Status</a>
                <a class="btn btn-warning btn-xs" style="cursor:pointer" data-toggle="modal" data-id="<?= $row->id_spt ?>" data-target="#no_sppd"><i class="fas fa-edit"></i>SPPD</a>
                <a target="_blank" href="<?= base_url('preview/sppd/') ?><?= $row->id_spt ?>" class="btn btn-danger btn-xs"><i class="fas fa-file-pdf"></i> SPPD</a>
              <?php } ?>
              <?php if($id_verif != 0){ ?>
                  <?php if($file_pdf == ""){ ?>
                    <a class='btn btn-danger btn-xs' title='Preview PDF' target="_blank" href="<?= base_url() ?>preview/pdf_spt/<?= md5($row->id_surat_keluar) ?>/<?= $row->id_surat_keluar ?>"><i class='fas fa-file-pdf'></i> PDF</a>
                  <?php } else { ?>
                    <a class='btn btn-danger btn-xs' title='Preview PDF' target="_blank" href="<?= base_url() ?>asset/surat_keluar/<?= $file_pdf ?>"><i class='fas fa-file-pdf'></i> PDF</a>                          
                  <?php } ?>
              <?php }  ?>
              <?php } ?>
            <?php } ?>
        </td>
      </tr>
     <?php
      $no++;
        }
      ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card --> 
<div class="modal fade" id="no_sppd" tabindex="-1"  role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Buat Nomor SPPD</h5>
					<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
                    <div class="isi_form_sppd"></div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModalsx" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Surat Perintah Tugas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="fetch_data"></div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
<script>
    $(document).ready(function(){
        $('#myModalsx').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
               type : 'post',
               url : '<?= base_url() ?>primer/lihat_spt',
               data : 'id_spt='+ rowid,
               success : function(data){
                   $('.fetch_data').html(data);
               }
            });
        });

        $('#no_sppd').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : '<?= base_url() ?>primer/no_sppd',
                data : 'id='+ rowid,
                success : function(data){
                    $('.isi_form_sppd').html(data);
                }
            });
        });
    });
</script>