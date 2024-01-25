   <script>
   arr = [];
   </script>
   <?php
   $uri4 = $this->uri->segment(4);
   $uri5 = $this->uri->segment(5);
   $uri6 = $this->uri->segment(6);
   $jml_lx = 45;
   
   if (!empty($uri5)){
       if($uri4=="edit"){
            $get_rincian = $this->db->query("select * from sijuara_rincian where id_subdetil = '$uri5' and status_ajukan = 0");
            $satu2 = $get_rincian->row();
            $lists = $get_rincian->result();
            $gid_detil = $satu2->id_detil;
            $get_subdetil = $this->db->query("select * from sijuara_subdetil where id_subdetil = '$uri5'")->row();
            $get_detil = $this->db->query("select * from sijuara_detil where id_detil = '$gid_detil'")->row();
            $tl_sp = $this->db->query("select sum(pengajuan_ini) as ttl from sijuara_simpan_pengajuan where id_subdetil = '$uri5'")->row();
            $tl_sr = $this->db->query("select kode_tr,sum(qty*harga_satuan) as ttlx from sijuara_rincian where id_subdetil = '$uri5' and status_ajukan = 0")->row();
            $biy_sd = $get_subdetil->vol * $get_subdetil->harga_satuan;
            if(!empty($tl_sr->kode_tr)){
                $by_sisa = $biy_sd - $tl_sp->ttl + $tl_sp->ttl;
                $kode_tr = $tl_sr->kode_tr;
            } else {
                $by_sisa = $biy_sd - $tl_sp->ttl;
                $kode_tr = "";
            }
            
            
            $ay = array();
            $et = 1;
            foreach($lists as $ls){
                //$ay[0][$et] = $ls->id_rincian;
                $ay[1][$et] = $ls->nama_barang;
                $ay[2][$et] = $ls->qty;
                $ay[3][$et] = $ls->vol;
                $ay[4][$et] = $ls->harga_satuan;
                $ay[5][$et] = $ls->qty*$ls->harga_satuan;
                $ay[6][$et] = number_format($ls->harga_satuan,0,"",".");
                $ay[7][$et] = number_format($ls->qty*$ls->harga_satuan,0,"",".");
            ?>
            <script>
            arr[<?php echo $et?>] = <?php echo $ls->qty*$ls->harga_satuan; ?>
            </script>
            <?php
                $et++;
            }
            for($iii=$et;$iii<=$jml_lx;$iii++){
            $ay[1][$iii] = "";
            $ay[2][$iii] = "";
            $ay[3][$iii] = "";
            $ay[4][$iii] = "";
            $ay[5][$iii] = "";
            $ay[6][$iii] = "";
            $ay[7][$iii] = "";
           }
            
            $vidsubdetil = $get_subdetil->id_subdetil;
            $vsubdetil = $get_subdetil->subdetil;
            $viddetil = $get_detil->id_detil;
            $vdetil = $get_detil->kd_detil."-".$get_detil->detil;
            $vtanggal = $uri6;
            $vuntuk = $satu2->untuk;
            $nonaktif_akun = "disabled";
            $aksi = "edit";
            $kod_tr = $kode_tr;
       } else {
           $get_rincian = $this->db->query("select * from sijuara_rincian where id_subdetil = '$uri5' and tanggal = '$uri6' and status_ajukan = 1");
           $satu2 = $get_rincian->row();
            $lists = $get_rincian->result();
            $gid_detil = $satu2->id_detil;
            $get_subdetil = $this->db->query("select * from sijuara_subdetil where id_subdetil = '$uri5'")->row();
            $get_detil = $this->db->query("select * from sijuara_detil where id_detil = '$gid_detil'")->row();
            $tl_sp = $this->db->query("select sum(pengajuan_ini) as ttl from sijuara_simpan_pengajuan where id_subdetil = '$uri5'")->row();
            $tl_sr = $this->db->query("select sum(qty*harga_satuan) as ttlx from sijuara_rincian where id_subdetil = '$uri5' and status_ajukan = 0")->row();
            $biy_sd = $get_subdetil->vol * $get_subdetil->harga_satuan;
            $by_sisa = $biy_sd - $tl_sp->ttl - $tl_sr->ttlx;
            
            $ay = array();
            $et = 1;
            foreach($lists as $ls){
                //$ay[0][$et] = $ls->id_rincian;
                $ay[1][$et] = $ls->nama_barang;
                $ay[2][$et] = $ls->qty;
                $ay[3][$et] = $ls->vol;
                $ay[4][$et] = $ls->harga_satuan;
                $ay[5][$et] = $ls->qty*$ls->harga_satuan;
                $ay[6][$et] = number_format($ls->harga_satuan,0,"",".");
                $ay[7][$et] = number_format($ls->qty*$ls->harga_satuan,0,"",".");
            ?>
            <script>
            arr[<?php echo $et?>] = <?php echo $ls->qty*$ls->harga_satuan; ?>
            </script>
            <?php
                $et++;
            }
            for($iii=$et;$iii<=$jml_lx;$iii++){
            $ay[1][$iii] = "";
            $ay[2][$iii] = "";
            $ay[3][$iii] = "";
            $ay[4][$iii] = "";
            $ay[5][$iii] = "";
            $ay[6][$iii] = "";
            $ay[7][$iii] = "";
           }
            
            $vidsubdetil = $get_subdetil->id_subdetil;
            $vsubdetil = $get_subdetil->subdetil;
            $viddetil = $get_detil->id_detil;
            $vdetil = $get_detil->kd_detil."-".$get_detil->detil;
            $vtanggal = $tanggal;
            $vuntuk = "";
            $nonaktif_akun = "disabled";
            $aksi = "tambah";
            $kod_tr = "";
       }
   } else {
       $by_sisa = "";
       $vidsubdetil = "";
       $vsubdetil = "";
       $viddetil = "";
       $vdetil = "";
       $vtanggal = $tanggal;
       $vuntuk = "";
       $nonaktif_akun = "";
       $aksi = "tambah";
       $kod_tr = "";
       for($iii=1;$iii<=$jml_lx;$iii++){
        $ay[1][$iii] = "";
        $ay[2][$iii] = "";
        $ay[3][$iii] = "";
        $ay[4][$iii] = "";
        $ay[5][$iii] = "";
        $ay[6][$iii] = "";
        $ay[7][$iii] = "";
       }
   }
   ?>
    <!--<script src="<?php echo base_url(); ?>plugins/jquery-ui/jquery-ui.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        
        
        window.onload=function(){
            totalxa.value = <?php echo $by_sisa ?>-sum(arr);
            totalx.value = formatRupiah(totalxa.value,"");
            totalfix.value = <?php echo $by_sisa ?>;
            total_semua.value = sum(arr);
            document.getElementById("total_semua").max = <?php echo $by_sisa ?>
        }
        
    </script>
    <div class='col-md-12'>
        <div class="card card-outline card-success">
            <div class="card-header">
                <h2 class="card-title">Form Pengajuan Rincian <?php $keg = $kegiatan->row(); echo $keg->subkomp ?> - <?php echo $keg->kd_ro ?>.<?php echo $keg->kd_komponen ?>.<?php echo $keg->kd_subkomp ?></h2>
        
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <div class="card-body">
              <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open('sijuara/isi_rincian',$attributes); 
               ?>
               <input type="hidden" name="kod_tr" value="<?php echo $kod_tr ?>">
                <input type="hidden" name="user" value="<?php echo $user ?>">
               <input type="hidden" name="tanggal" value="<?php echo $vtanggal ?>">
               <input type="hidden" name="uri3" value="<?php echo $uris ?>">
               <!--<input type="hidden" name="id_pengajuan" value="">-->
               <table border="0" style="width:100%">
                   <tr>
                       <td>Uraian</td>
                       <td>Akun</td>
                       <td>Jumlah</td>
                       <!--<td style="width:20%"><input type="text" class="form-control" id="pengajuan_ini" disabled></td>-->
                    </tr>
                   <tr>
                       <td style="width:55%"><input type="text" name="subdetil" value="<?php echo $vsubdetil ?>" id="subdetil" class="form-control" placeholder="Uraian" onclick="rek();" <?php echo $nonaktif_akun ?>><input type="hidden" name="id_subdetil" id="id_subdetil" value="<?php echo $vidsubdetil ?>"></td>
                       <td style="width:30%"><input type="text" name="detil" value="<?php echo $vdetil ?>" id="detil" class="form-control" placeholder="Akun" <?php echo $nonaktif_akun ?>><input type="hidden" name="id_detil" id="id_detil" value="<?php echo $viddetil ?>"></td>
                       <td style="width:15%"><input type="text" id="totalx" class="form-control" placeholder="Total"><input type="hidden" name="totalxa" id="totalxa"></td>
                       <input type="hidden" name="totalfix" id="totalfix">
                       <input type="hidden" name="aksi" value="<?php echo $aksi ?>">
                       <!--<td style="width:20%"><input type="text" class="form-control" id="pengajuan_ini" disabled></td>-->
                    </tr>
               </table>
               <table border="0" style="margin-top:20px;width:100%">
                   <tr>
                       <td style="width:100%"><input type="text" name="untuk" class="form-control" value="<?php echo $vuntuk ?>" placeholder="Keperluan"></td>
                       <!--<td style="width:10%"><button type="button" id="btn0" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button></td>-->
                    </tr>
               </table>
               <table style="width:100%;margin-top:20px" class='table table-bordered'>
                  <thead>
                    <tr>
                      <th style="width:2%">No</th>
                      <th style="width:43%">Uraian</th>
                      <th style="width:10%">Vol</th>
                      <th style="width:10%">Satuan</th>
                      <th style="width:15%">Harga Satuan</th>
                      <th style="width:20%">Jumlah</th>
                      <!--
                      <th style="width:15%">Database HPS</th>
                      -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        for($ii=1; $ii<=$jml_lx; $ii++){
                    ?>
                    <tr>
                        <td><?php echo $ii ?></td>
                        <td><input type="text" class="form-control" id="barang<?php echo $ii ?>" name="nama_barang[]" value="<?php echo $ay[1][$ii] ?>"></td>
                        <td><input type="text" class="form-control" id="qty<?php echo $ii ?>" name="qty[]" value="<?php echo $ay[2][$ii] ?>"></td>
                        <td><input type="text" class="form-control" id="vol<?php echo $ii ?>" name="vol[]" value="<?php echo $ay[3][$ii] ?>"></td>
                        <td><input type="hidden" class="form-control" id="hps<?php echo $ii ?>" name="hps[]" value="<?php echo $ay[4][$ii] ?>"><input type="text" class="form-control" id="hpsi<?php echo $ii ?>" value="<?php echo $ay[6][$ii] ?>"></td>
                        <td><input type="hidden" class="form-control" id="jumlah<?php echo $ii ?>" value="<?php echo $ay[5][$ii] ?>"><input type="text" class="form-control" id="jumlahi<?php echo $ii ?>" value="<?php echo $ay[7][$ii] ?>" disabled></td>
                        <!--<td><a href="#" data-toggle="modal" data-target="#myModals<?php echo $ii ?>" class="btn btn-success btn-sm"><i class="fa fa-save"></i></a></td>-->
                    </tr>
                    <script type='text/javascript'>
                        $(document).ready(function(){
                            $("#barang<?php echo $ii ?>").autocomplete({
                                source: function(request, response){
                                    $.ajax({
                                        url: "<?php echo base_url() ?>sijuara/get_datahps",
                                        type: 'post',
                                        dataType: "json",
                                        data: {
                                            search: request.term
                                        },
                                        success: function( data ){
                                            response( data );
                                        }
                                    });
                                },
                                select: function(event, ui) {
                                    //set selection
                                    $('#barang<?php echo $ii ?>').val(ui.item.label);
                                    $('#qty<?php echo $ii ?>').val(ui.item.qty);
                                    $('#vol<?php echo $ii ?>').val(ui.item.value);
                                    $('#hps<?php echo $ii ?>').val(ui.item.hps);
                                    $('#hpsi<?php echo $ii ?>').val(ui.item.hpsi);
                                    $('#jumlah<?php echo $ii ?>').val(ui.item.hpsi);
                                    jumlahi<?php echo $ii?>.value = formatRupiah(jumlah<?php echo $ii?>.value, "");
                                    arr[<?php echo $ii?>] = hps<?php echo $ii ?>.value;
                                    totalxa.value = totalfix.value - sum(arr);
                                    totalx.value = formatRupiah(totalxa.value,"");
                                    total_semua.value = sum(arr);
                                    $("#hpsi<?php echo $ii?>").attr("disabled", true);
                                    return  false;
                                },
                                focus: function( event, ui ) {
                                    $('#barang<?php echo $ii ?>').val(ui.item.label);
                                    $('#qty<?php echo $ii ?>').val(ui.item.qty);
                                    $('#vol<?php echo $ii ?>').val(ui.item.value);
                                    $('#hps<?php echo $ii ?>').val(ui.item.hps);
                                    $('#hpsi<?php echo $ii ?>').val(ui.item.hpsi);
                                    $('#jumlah<?php echo $ii ?>').val(ui.item.hpsi);
                                    jumlahi<?php echo $ii?>.value = formatRupiah(jumlah<?php echo $ii?>.value, "");
                                    arr[<?php echo $ii?>] = hps<?php echo $ii ?>.value;
                                    totalxa.value = totalfix.value - sum(arr);
                                    totalx.value = formatRupiah(totalxa.value,"");
                                    total_semua.value = sum(arr);
                                    $("#hpsi<?php echo $ii?>").attr("disabled", true);
                                    return false;
                                },
                            });
                        });
                    </script>
                    <script>
                         qty<?php echo $ii?>.addEventListener("keyup", function(e) {
                         jumlah<?php echo $ii?>.value = this.value * hps<?php echo $ii?>.value;
                          arr[<?php echo $ii ?>] = jumlah<?php echo $ii ?>.value;
                          jumlahi<?php echo $ii?>.value = formatRupiah(jumlah<?php echo $ii?>.value, "");
                          totalxa.value = totalfix.value - sum(arr);
                          totalx.value = formatRupiah(totalxa.value,"");
                          total_semua.value = sum(arr);
                        });
                        
                        hpsi<?php echo $ii?>.addEventListener("keyup", function(e) {
                            hpsi<?php echo $ii?>.value = formatRupiah(this.value, "");
                            hps<?php echo $ii?>.value = formatangka(this.value, "");
                            jumlah<?php echo $ii?>.value = qty<?php echo $ii?>.value * hps<?php echo $ii?>.value;
                            arr[<?php echo $ii?>] = jumlah<?php echo $ii?>.value
                            jumlahi<?php echo $ii?>.value = formatRupiah(jumlah<?php echo $ii?>.value, "");
                            totalxa.value = totalfix.value - sum(arr);
                            totalx.value = formatRupiah(totalxa.value,"");
                            total_semua.value = sum(arr);
                        });
                    </script>
                    <?php
                        }
                    ?>
                  </tbody>
                  <tr>
                   <td style="width:70%" colspan="5">Total</td>
                   <td style="width:30%"><input type="number" name="total_semua" max="" class="form-control" id="total_semua"></td>
                   <input type="hidden" class="form-control" id="total_arr">
                </tr>
                </table>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success" name="submit">Save</button>
            </div>
            </form>
    </div>
</div>

<div class="modal fade" id="akun" tabindex="-1">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Uraian</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <table style="width:100%" id="datatable-responsive" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="width:30%">Uraian</th>
                        <th style="width:55%">Akun</th>
                        <th style="width:15%">Jumlah Biaya</th>
                    </tr>
                </thead>
                <tbody>
                   <?php 
                    $std_akun = $this->db->query("select a.*,b.id_detil,b.kd_detil, b.detil 
                                                  from sijuara_subdetil a
                                                  inner join sijuara_detil b on a.id_detil=b.id_detil
                                                  where b.id_subkomp='$uris'")->result();
                        if ($std_akun) {
                            foreach ($std_akun as $sa) {
                                $biaya_keluar = $this->model_polling->biaya_terajukan($sa->id_subdetil)->row();
                                $biaya_realisasi = $this->model_polling->biaya_realisasi($sa->id_subdetil)->row();
                                if($biaya_keluar){
                                    $sisa = $biaya_keluar->sisa + $biaya_realisasi->rlx;
                                } else {
                                    $sisa = 0;
                                }
                                $juml = ($sa->vol * $sa->harga_satuan) - $sisa;
                    ?>
                            <tr class="pili" data-dismiss="modal"
                                data-subdetil="<?php echo $sa->subdetil ?>"
                                data-detil="<?php echo $sa->kd_detil."-".$sa->detil ?>"
                                data-totala="<?php echo $juml ?>"
                                data-totalfix="<?php echo $juml ?>"
                                data-id_subdetil="<?php echo $sa->id_subdetil ?>"
                                data-id_detil="<?php echo $sa->id_detil ?>">
                                <td><?php echo $sa->subdetil ?></td>
                                <td><?php echo $sa->kd_detil."-".$sa->detil ?></td>
                                <td><?php echo number_format($juml,0,"",".") ?></td>
                            </tr>
                    <?php
                            } 
                        }
                     ?>
                </tbody>
            </table>
            </div>
            <div class = "modal-footer" > 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

<?php
    for($aa = 1; $aa<=$jml_lx; $aa++){
?>

<div id="myModals<?php echo $aa ?>" class = "modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Data HPS</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <table style="width:100%" id="datatables-responsive<?php echo $aa ?>" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="width:60%">Nama</th>
                        <th style="width:20%">Vol</th>
                        <th style="width:20%">HPS</th>
                    </tr>
                </thead>
                <tbody>
                   <?php 
                    $std_biaya = $this->db->query("select * from sijuara_hvs")->result();
                        if ($std_biaya) {
                            foreach ($std_biaya as $rs) {
                    ?>
                            <tr class="pilih<?php echo $aa ?>" data-dismiss="modal"
                                data-barang="<?php echo $rs->barang ?>"
                                data-vol="<?php echo $rs->vol ?>"
                                data-hps="<?php echo $rs->hps ?>"
                                data-hpsi="<?php echo number_format($rs->hps,0,"",".") ?>">
                                <td><?php echo $rs->barang ?></td>
                                <td><?php echo $rs->vol ?></td>
                                <td><?php echo number_format($rs->hps,0,"",".") ?></td>
                            </tr>
                    <?php
                            } 
                        }
                     ?>
                </tbody>
            </table>
            </div>
            <div class = "modal-footer" > 
            </div>
        </div>
    </div>
</div>

<script>
$('#myModals<?php echo $aa ?>').on('click', '.pilih<?php echo $aa ?>', function (e) {
    arr[<?php echo $aa?>] = $(this).attr('data-hps');
    hps<?php echo $aa?>.value = $(this).attr('data-hps');
    hpsi<?php echo $aa?>.value = $(this).attr('data-hpsi');
    qty<?php echo $aa?>.value = 1;
    vol<?php echo $aa?>.value = $(this).attr('data-vol');
    barang<?php echo $aa?>.value = $(this).attr('data-barang');
    jumlah<?php echo $aa?>.value = $(this).attr('data-hps');
    jumlahi<?php echo $aa?>.value = formatRupiah(jumlah<?php echo $aa?>.value, "");
    totalxa.value = totalfix.value - sum(arr);
    totalx.value = formatRupiah(totalxa.value,"");
    total_semua.value = sum(arr);
    //$("#barang"+count).attr("disabled", true);
    //$("#vol"+count).attr("disabled", true);
    $("#hpsi<?php echo $aa?>").attr("disabled", true);
});
</script>
<?php
    }
?>

<script>
/* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
          var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
          // tambahkan titik jika yang di input sudah menjadi angka ribuan
          if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
          }
        
          rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
          return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
        }
        
        /* Fungsi formatangka */
        function formatangka(x,y) {
          var w = x.replace(/[^,\d]/g, "").toString(),
            split = w.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
            if (ribuan) {
            separator = sisa ? "" : "";
            rupiah += separator + ribuan.join("");
          }
        
          rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
          return y == undefined ? rupiah : rupiah ? "" + rupiah : "";
        }
        
        function tandaPemisahTitik(b){
	var _minus = false;
	if (b<0) _minus = true;
	b = b.toString();
	b=b.replace(".","");
	
	c = "";
	panjang = b.length;
	j = 0;
	for (i = panjang; i > 0; i--){
		 j = j + 1;
		 if (((j % 3) == 1) && (j != 1)){
		   c = b.substr(i-1,1) + "." + c;
		 } else {
		   c = b.substr(i-1,1) + c;
		 }
	}
	if (_minus) c = "-" + c ;
	return c;
}

function sum(input){
             
 if (toString.call(input) !== "[object Array]")
    return false;
      
            var total =  0;
            for(var i=0;i<input.length;i++)
              {                  
                if(isNaN(input[i])){
                continue;
                 }
                  total += Number(input[i]);
               }
             return total;
            }

function rek() {
    $('#akun').show().modal();
} 

$('#akun').on('click', '.pili', function (e) {
        document.getElementById("subdetil").value = $(this).attr('data-subdetil');
        document.getElementById("detil").value = $(this).attr('data-detil');
        document.getElementById("totalxa").value = $(this).attr('data-totala') - document.getElementById("total_semua").value;
        document.getElementById("totalx").value = formatRupiah(document.getElementById("totalxa").value,"");
        document.getElementById("totalfix").value = $(this).attr('data-totalfix');
        document.getElementById("id_subdetil").value = $(this).attr('data-id_subdetil');
        document.getElementById("id_detil").value = $(this).attr('data-id_detil');
        document.getElementById("total_semua").max = $(this).attr('data-totalfix');
        });
        

    $(document).ready(function(){   
        $('#datatable-responsive').DataTable();
        <?php
            for($uu = 1; $uu <= 20; $uu++){
        ?>
        $('#datatables-responsive<?php echo $uu ?>').DataTable();
        <?php
            }
        ?>
    });
    
</script>

<div class='col-md-12'>
        <div class="card card-outline card-success">
            <div class="card-header">
                <h2 class="card-title">List Pengajuan Rincian <?php $keg = $kegiatan->row(); echo $keg->subkomp ?> - <?php echo $keg->kd_ro ?>.<?php echo $keg->kd_komponen ?>.<?php echo $keg->kd_subkomp ?></h2>
        
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <div class="card-body">
               <table style="width:100%;margin-top:20px" class='table table-bordered'>
                  <thead>
                    <tr>
                      <th style="width:2%">No</th>
                      <th style="width:30%">Akun</th>
                      <th style="width:38%">Uraian/Keperluan</th>
                      <th style="width:10%">Pengajuan</th>
                      <th style="width:20%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                        $qw_pju = $this->db->query("select a.status,a.status_ajukan,a.untuk,a.id_subdetil,a.tanggal,b.kd_detil,b.detil,c.subdetil,sum(a.qty*a.harga_satuan) as tot
                                                    from sijuara_rincian a
                                                    inner join sijuara_detil b on a.id_detil=b.id_detil
                                                    inner join sijuara_subdetil c on a.id_subdetil=c.id_subdetil
                                                    inner join sijuara_subkomp d on b.id_subkomp=d.id_subkomp
                                                    where d.id_subkomp='$uris'
                                                    group by a.untuk
                                                    order by a.id_rincian desc")->result();
                        $nq = 1;
                    if($qw_pju){
                        foreach($qw_pju as $qq){
                            $pc_for = explode("#",$qq->untuk);
                            if($qq->status_ajukan==1){
                                $vw = "none";
                                $vww = "";
                            } else {
                                $vw = "";
                                $vww = "none";
                            }
                            if($qq->status==1){
                                $bgx = "bg-success";
                            } else {
                                $bgx = "";
                            }
                        ?>
                    <tr class="<?php echo $bgx ?>">
                        <td><?php echo $nq ?></td>
                        <td><?php echo $qq->kd_detil ?>-<?php echo $qq->detil ?></td>
                        <td><?php echo $qq->subdetil ?> / <?php echo $pc_for[0] ?></td>
                        <td><?php echo number_format($qq->tot) ?></td>
                        <td>
                            <a style="display:<?php echo $vw ?>" href="<?php echo base_url()."sijuara/pengajuan/".$uris."/edit/".$qq->id_subdetil."/".$qq->tanggal ?>"><i class="fa fa-edit"></i> Edit </a>
                            <a style="display:<?php echo $vww ?>; color:white" href="<?php echo base_url()."sijuara/pengajuan/".$uris."/copy/".$qq->id_subdetil."/".$qq->tanggal ?>"> <i class="fa fa-copy"></i>  Copy </a> 
                            <a style="display:<?php echo $vw ?>" onclick="alert('Apakah anda ingin menghapus data ini ?')" href="<?php echo base_url()."sijuara/hapus_rincian/".$uris."/".$qq->id_subdetil ?>"> <i class="fa fa-trash"></i> Hapus </a></td>
                    </tr>
                        <?php
                        $nq++;
                        }
                    }
                        ?>
                  </tbody>
                </table>
            </div>
    </div>
</div>