    
<!-- modal -->

<?php
    $subdetil = $hasil->row();
?>
<div class="modal-header">
  <h4 class="modal-title">Rincian <?php echo $subdetil->subdetil ?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
    <!--
    <div style class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-ban"></i> Peringatan</h5>
      Uang yang telah diajukan melebihi <?php echo number_format($subdetil->pengajuan_ini,0,"",".")?>
    </div>
    -->
  <?php 
  $attributes = array('class'=>'form-horizontal','role'=>'form');
  echo form_open('sijuara/isi_rincian',$attributes); 
   ?>
   <input type="hidden" name="user" value="<?php echo $user ?>">
   <input type="hidden" name="tanggal" value="<?php echo $tanggal ?>">
   <input type="hidden" name="uri3" value="<?php echo $subdetil->id_subkomp ?>">
   <input type="hidden" name="id_pengajuan" value="<?php echo $subdetil->id_pengajuan ?>">
   <table border="0" style="width:100%">
       <tr>
           <td style="width:70%" colspan="5"><input type="text" name="untuk" class="form-control" placeholder="Keperluan"><input type="hidden" id="pengajuan_inia" value="<?php echo $subdetil->pengajuan_ini ?>"></td>
           <td style="width:20%"><input type="text" class="form-control" id="pengajuan_ini" disabled></td>
           <td style="width:10%"><button type="button" id="btn0" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button></td>
        </tr>
   </table>
   <table style="width:100%;margin-top:20px" class='table table-bordered'>
      <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:28%">Uraian</th>
          <th style="width:10%">Vol</th>
          <th style="width:10%">Satuan</th>
          <th style="width:15%">Harga Satuan</th>
          <th style="width:20%">Jumlah</th>
          <th style="width:15%">Aksi</th>
        </tr>
      </thead>
      <tbody id="frm">
        
      </tbody>
      <tr>
       <td style="width:70%" colspan="6">Total</td>
       <td style="width:30%"><input type="number" max="<?php echo $subdetil->pengajuan_ini ?>" class="form-control" id="total_semua"></td>
    </tr>
    </table>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-success" name="submit">Save</button>
</div>
<div class="modal-footer justify-content-between">
  
</div>
</form>   
<div id="myModals" class = "modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              
            </div>
            <div class="modal-body">
            <table style="width:100%" id="datatable-responsive" class="table table-hover table-striped table-bordered">
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
                            <tr class="pilih"
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
    pengajuan_ini.value = formatRupiah(pengajuan_inia.value,"");
    
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


$(document).ready(function(){
        var count=0;
        var arr = [];
        $("#btn0").click(function(){
            count++;
            $("#frm").append('<tr>'
                +'<td>'
                +count
                +'</td>'
                +'<td>'
                +'<input type="text" class="form-control" id="barang'+count+'" name="nama_barang[]">'
                +'</td>'
                +'<td>'
                +'<input type="text" class="form-control" id="qty'+count+'" name="qty[]">'
                +'</td>'
                +'<td>'
                +'<input type="text" class="form-control" id="vol'+count+'" name="vol[]">'
                +'</td>'
                +'<td>'
                +'<input type="hidden" class="form-control" id="hps'+count+'" name="hps[]"><input type="text" class="form-control" id="hpsi'+count+'">'
                +'</td>'
                +'<td>'
                +'<input type="hidden" class="form-control" id="jumlah'+count+'"><input type="text" class="form-control" id="jumlahi'+count+'">'
                +'</td>'
                +'<td>'
                +'<a href="#" data-toggle="modal" data-target="#myModals" class="btn btn-success btn-sm"><i class="fa fa-save"></i></a>'
                +'</td>'
                +'</tr>');
                
                $('#myModals').on('click', '.pilih', function (e) {
                    arr[count] = $(this).attr('data-hps');
                    document.getElementById("hps"+count).value = $(this).attr('data-hps');
                    document.getElementById("hpsi"+count).value = $(this).attr('data-hpsi');
                    document.getElementById("qty"+count).value = 1;
                    document.getElementById("vol"+count).value = $(this).attr('data-vol');
                    document.getElementById("barang"+count).value = $(this).attr('data-barang');
                    document.getElementById("jumlah"+count).value = $(this).attr('data-hps');
                    document.getElementById("jumlahi"+count).value = formatRupiah(document.getElementById("jumlah"+count).value, "");
                    document.getElementById("pengajuan_inia").value = <?php echo $subdetil->pengajuan_ini ?> - sum(arr);
                    pengajuan_ini.value = formatRupiah(pengajuan_inia.value,"");
                    document.getElementById("total_semua").value = sum(arr);
                    //$("#barang"+count).attr("disabled", true);
                    //$("#vol"+count).attr("disabled", true);
                    $("#hpsi"+count).attr("disabled", true);
                });
                
                document.getElementById("qty"+count).addEventListener("keyup", function(e) {
                  document.getElementById("jumlah"+count).value = this.value * document.getElementById("hps"+count).value;
                  arr[count] = document.getElementById("jumlah"+count).value;
                  document.getElementById("jumlahi"+count).value = formatRupiah(document.getElementById("jumlah"+count).value, "");
                  document.getElementById("pengajuan_inia").value = <?php echo $subdetil->pengajuan_ini ?> - sum(arr);
                  pengajuan_ini.value = formatRupiah(pengajuan_inia.value,"");
                  document.getElementById("total_semua").value = sum(arr);
                });
                
                document.getElementById("hpsi"+count).addEventListener("keyup", function(e) {
                    document.getElementById("hpsi"+count).value = formatRupiah(this.value, "");
                    document.getElementById("hps"+count).value = formatangka(this.value, "");
                    document.getElementById("jumlah"+count).value = document.getElementById("qty"+count).value * document.getElementById("hps"+count).value;
                    arr[count] = document.getElementById("jumlah"+count).value
                    document.getElementById("jumlahi"+count).value = formatRupiah(document.getElementById("jumlah"+count).value, "");
                    document.getElementById("pengajuan_inia").value = <?php echo $subdetil->pengajuan_ini ?> - sum(arr);
                    pengajuan_ini.value = formatRupiah(pengajuan_inia.value,"");
                    document.getElementById("total_semua").value = sum(arr);
                });
                $("#jumlahi"+count).attr("disabled", true);
        });
        $('#datatable-responsive').DataTable();
    });

</script>