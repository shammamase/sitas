<?php 
	$pc_mn = explode("-", $id_menu);
	$pg = $this->model_halaman->page_edit2($pc_mn[0])->row();
	$hal_pg = $this->model_halaman->page();
	$qw_menu2 = $this->db->query("SELECT * FROM cltr_menu2 WHERE id_kat_menu = '$pc_mn[1]' AND level = '3' AND menu1 = '$pc_mn[0]'");
	$jml_mn2 = $qw_menu2->num_rows();
	$mn2 = $qw_menu2->row();
	if ($jml_mn2>0) {
 ?>
<form method="post" action="<?php echo site_url('admin/edit_menu2') ?>" class="form-horizontal" role="form">
 	
 		<table class="table table-condensed table-bordered">
 			<tbody>
 				<input type="hidden" name="id_menu2" value="<?php echo $mn2->id_menu2 ?>">
 				<input type="hidden" id="id_kat_menu" name="id_kat_menu" value="<?php echo $pc_mn[1] ?>">
 				<input type="hidden" id="level" name="level" value="3">
 				<input type="hidden" id="menu1" name="menu1" value="<?php echo $pc_mn[0] ?>">
 				<tr>
 					<th scope="row">Menu</th>
 					<td><input type="text" class="form-control" name="menu11" value="<?php echo $pg->judul ?>" readonly></td>
 				</tr>
 				<tr>
 					<th scope="row">Sub Menu</th>
 					<td>
 						<div class="checkbox-scroll">
 						<?php 
 						  $sbx = explode(",", $mn2->menu2);
                          foreach ($hal_pg->result_array() as $pgs){
                          	$ceks = (array_search($pgs['id_halaman'], $sbx) === false)? '' : 'checked';
                           ?>
                          <div class="col-md-3"><input type=checkbox value="<?php echo $pgs['id_halaman'] ?>" id="menu2" name="menu2[]" <?php echo $ceks ?>> <?php echo $pgs['judul'] ?></div>
                          <?php 
                          }
                         ?>
 						</div>
 					</td>
 				</tr>
 				<tr>
 					<th colspan="2" style="text-align:center">
 						<button type="submit" id="sub" name="submit" class="btn btn-info">Simpan</button>
 					</th>
 				</tr>
 			</tbody>
 		</table>
 </form>
 <?php
	} else {
 ?>
<form method="post" action="<?php echo site_url('admin/tambah_menu2') ?>" class="form-horizontal" role="form">
 	
 		<table class="table table-condensed table-bordered">
 			<tbody>
 				<input type="hidden" id="id_kat_menu" name="id_kat_menu" value="<?php echo $pc_mn[1] ?>">
 				<input type="hidden" id="level" name="level" value="3">
 				<input type="hidden" id="menu1" name="menu1" value="<?php echo $pc_mn[0] ?>">
 				<tr>
 					<th scope="row">Menu</th>
 					<td><input type="text" class="form-control" name="menu11" value="<?php echo $pg->judul ?>" readonly></td>
 				</tr>
 				<tr>
 					<th scope="row">Sub Menu</th>
 					<td>
 						<div class="checkbox-scroll">
 						<?php 
                          foreach ($hal_pg->result_array() as $pgs){
                           ?>
                          <div class="col-md-3"><input type=checkbox value="<?php echo $pgs['id_halaman'] ?>" id="menu2" name="menu2[]"> <?php echo $pgs['judul'] ?></div>
                          <?php 
                          }
                         ?>
 						</div>
 					</td>
 				</tr>
 				<tr>
 					<th colspan="2" style="text-align:center">
 						<button type="submit" id="sub" name="submit" class="btn btn-info">Simpan</button>
 					</th>
 				</tr>
 			</tbody>
 		</table>
 </form>
 <?php
	}
 ?>
 