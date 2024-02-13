<!DOCTYPE html>
<!-- saved from url=(0036)https://s.bootsnipp.com/iframe/dlZAN -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="robots" content="noindex, nofollow">

    <title>Buku Tamu Digital</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?= base_url() ?>asset/favicon.png" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" id="bootstrap-css">
    <style type="text/css">
    .register{
    background: -webkit-linear-gradient(left, #39ac39, #66a3ff);
    border-radius:20px;
    margin-top: 3%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
        });
    </script>

<link href="<?= base_url() ?>asset/lte31/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
<script src="<?= base_url() ?>asset/lte31/plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>asset/lte31/plugins/select2/css/select2.min.css">
</head>
<body>
<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <a href="<?= base_url('nonlogin/buku_tamu') ?>"><img src="<?= base_url() ?>asset/logo_kementan.png" alt="" style="margin-left:-30px; width: 150px; height: auto;"></a>
            <h3 style="margin-left:-30px">Selamat Datang</h3>
            <a href="<?= base_url('nonlogin/buku_tamu') ?>"><h3 style="margin-left:-30px;text-decoration: none; color: white; font-weight: bold">di BSIP TAS</h3></a>
            <!--
            <br>
            <a href="<?= base_url('nonlogin/list_buku_tamu') ?>" style="margin-left:-30px" class="btn btn-warning">Buku Tamu</a>
            -->
            <?php
            $satu_hari = mktime(0,0,0,date("n"),date("j"),date("Y"));
            function tglIndonesia($str){
             $tr   = trim($str);
             $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
             return $str;
            }
            ?>
            <br>
            <div style="margin-left:-30px;">
            <b style="color: white; font-size: 16px; font-weight: bold; padding: -30px; text-align: left; box-shadow: 5px 5px #; text-shadow: 4px 4px 4px #;" >
            <?php
                echo "<b>".tglIndonesia(date('D, d F Y', $satu_hari))."</b> ";
                date_default_timezone_set('Asia/Jakarta');
                echo "<br>";
                echo "<strong  id='clock'></strong>";
            ?> 
            </b>
            </div>
        </div>
        <div class="col-md-9" style="background-color:#ffffff; border-radius:20px">
            <a href="#" style="text-decoration:none">
                <div style="background-color:#339933; margin-top:20px; border-radius:20px; color: white; font-weight: bold; font-size: 20px">
                <marquee>Kunjungi Website BSIP TAS : <a style="text-decoration:none;color:#ffff00" target="_blank" href="https://tanamanpemanis.bsip.pertanian.go.id/">https://tanamanpemanis.bsip.pertanian.go.id/</a></marquee>
                </div>
            </a>
            <div class="tab-content" id="myTabContent">
                <h3 style="margin-top:10px" class="register-heading">Buku Tamu Digital</h3>
                <div class="register-form">
                    <div class="box box-danger box-solid">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-7">
                                    <form role="form" method="POST" enctype="multipart/form-data" action="<?= base_url('nonlogin/kirim_buku_tamu') ?>">
                                        <div class="form-group"> 
                                            <input type="text" name="nama"  class="form-control" placeholder="Nama" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="no_hp"  class="form-control" placeholder="No HP/WA" required>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="jk" required>
                                                <option value="">--Pilih Jenis Kelamin--</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>               
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="asal_instansi"  class="form-control" placeholder="Asal Instansi/Akademik" required>
                                        </div> 
                                        <div class="form-group">
                                            <textarea name="alamat" class="form-control" placeholder="Alamat" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="maksud_tujuan" class="form-control" placeholder="Maksud dan Tujuan" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah yang ikut (abaikan jika sendiri)</label>
                                            <input type="number" name="pengikut"  class="form-control" value=0>
                                        </div>
                                        <div class="form-group">
                                            <label>Ingin Bertemu :</label> <br>
                                            <select class="form-control select2" name="id_pegawai"  required>
                                                <option value="">-Pilih Nama-</option>
                                                <?php
                                                    foreach ($pegawai as $pg){
                                                ?>
                                                <option value="<?php echo $pg->id_pegawai ?>-<?php echo $pg->no_hp ?>"><?php echo $pg->nama ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select> 
                                        </div>
                                </div>
                                <div style="text-align:center" class="col-lg-5">
                                    <p>Ambil Foto</p>
                                    <div id="camera">Capture</div>
                                    
                                    <div id="webcam">
                                        <input type=button value="Capture" class="btn btn-warning" onClick="preview()">
                                    </div>
                                    <div id="simpan" style="display:none">
                                        <input type=button value="Batal" class="btn btn-danger" onClick="batal()">
                                        <input type="submit" id="btnSaveSign" name="save" value="Simpan" onClick="simpan()" >
                                        <input type="hidden" name="image" class="image-tag">
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var detik = <?php echo date('s'); ?>;
    var menit = <?php echo date('i'); ?>;
    var jam   = <?php echo date('H'); ?>;
     
    function clock()
    {
        if (detik!=0 && detik%60==0) {
            menit++;
            detik=0;
        }
        second = detik;
         
        if (menit!=0 && menit%60==0) {
            jam++;
            menit=0;
        }
        minute = menit;
         
        if (jam!=0 && jam%24==0) {
            jam=0;
        }
        hour = jam;
         
        if (detik<10){
            second='0'+detik;
        }
        if (menit<10){
            minute='0'+menit;
        }
         
        if (jam<10){
            hour='0'+jam;
        }
        waktu = hour+':'+minute+':'+second;
         
        document.getElementById("clock").innerHTML = waktu;
        detik++;
    }
 
    setInterval(clock,1000);
</script>                     
<script src="<?= base_url() ?>asset/lte31/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
        //Date range as a button
        $('#daterange-btn').daterangepicker(
        {
            ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
        },
        function (start, end) {
            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
        )

        //Date picker
        $('#datepicker').datepicker({
        autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
        showInputs: false
        })
    })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script language="Javascript">
        // konfigursi webcam
        Webcam.set({
            width: 310,
            height: 250,
            image_format: 'jpg',
            jpeg_quality: 100
        });
        Webcam.attach( '#camera' );
 
        function preview() {
            // untuk preview gambar sebelum di upload
            Webcam.freeze();
            // ganti display webcam menjadi none dan simpan menjadi terlihat
            document.getElementById('webcam').style.display = 'none';
            document.getElementById('simpan').style.display = '';
        }
        
        function batal() {
            // batal preview
            Webcam.unfreeze();
            
            // ganti display webcam dan simpan seperti semula
            document.getElementById('webcam').style.display = '';
            document.getElementById('simpan').style.display = 'none';
        }
        
        function simpan() {
            // ambil foto
           Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
           
                
                Webcam.unfreeze();

                document.getElementById('webcam').style.display = '';
                document.getElementById('simpan').style.display = 'none';  
            } );
        }
    </script>
</body>
</html>