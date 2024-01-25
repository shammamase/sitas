    
<!-- modal -->

<?php
    $get_subdetil = $this->db->query("select a.untuk,b.subdetil 
                                     from sijuara_rincian a 
                                     inner join sijuara_subdetil b on a.id_subdetil=b.id_subdetil
                                     where a.id_subdetil='$id_subdetil' order by id_rincian desc")->row();
                                     $pc_for = explode("#",$get_subdetil->untuk);
?>
<div class="modal-header">
  <h4 class="modal-title">Rincian / Keperluan : <?php echo $get_subdetil->subdetil ?> / <?php echo $pc_for[0] ?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
   <table style="width:100%;margin-top:20px" class='table table-bordered'>
      <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:43%">Uraian Barang</th>
          <th colspan="2" style="width:20%">Volume</th>
          <th style="width:15%">Harga Satuan</th>
          <th style="width:20%">Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $nor = 1;
        $jum_tot = 0;
         foreach($hasil->result() as $hs){
             $jl = $hs->qty*$hs->harga_satuan;
        ?>
        <tr>
        <td><?php echo $nor ?></td>
        <td><?php echo $hs->nama_barang ?></td>
        <td><?php echo $hs->qty ?></td>
        <td><?php echo $hs->vol ?></td>
        <td><?php echo number_format($hs->harga_satuan) ?></td>
        <td><?php echo number_format($jl) ?></td>
        </tr>
        <?php
        $jum_tot += $jl;
        $nor++;
         }
        ?>
      </tbody>
      <tr>
       <td colspan="5">Jumlah</td>
       <td><?php echo number_format($jum_tot) ?></td>
    </tr>
    </table>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
<div class="modal-footer justify-content-between">
  
</div>