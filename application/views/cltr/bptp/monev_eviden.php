<?php 
    $pc_tes = explode("#",$tes);
    $qw_evi = $this->db->query("select a.untuk, b.gbr_dok from sijuara_spt a inner join sijuara_lap_spt b on a.id_spt=b.id_spt where a.tanggal like '%$pc_tes[0]%' and b.tolak_ukur_kegiatan = '$pc_tes[1]'")->result();
?>
<table class="table table-bordered table-striped">
    <tr>
        <th>Perihal</th>
        <th>Foto</th>
    </tr>
    <?php 
        foreach($qw_evi as $qv){
    ?>
    <tr>
        <td><?= $qv->untuk ?></td>
        <td>
            <?php 
            $pc_gbr = explode(",",$qv->gbr_dok);
            foreach($pc_gbr as $pgb){
            ?>
            <img src="<?= base_url() ?>asset/file_lainnya/lap_spt/<?= $pgb ?>" style="height:200px; width:auto">
            <?php
            }
            ?>
        </td>
    </tr>
    <?php
        }
    ?>
    
</table>