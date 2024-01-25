<style>
    @media only screen and (max-width: 600px){
        iframe{
            height:300px;
            width:100%;
        }
        
        p{
        font-family:Arial;
        font-size:9pt;
        }
        
        ul{
            font-family:Arial;
            font-size:9pt;
            margin-left:-20px;
        }
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:9pt;
        }
    }
    
    @media only screen and (min-width: 600px){
        iframe{
            height:300px;
            width:100%;
        }
        
        p{
        font-family:Arial;
        font-size:9pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:9pt;
            margin-left:-15px;
        }
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-20px;
            font-size:9pt;
        }
    }
    
    @media only screen and (min-width: 768px){
        iframe{
            height:400px;
            width:100%;
        }
        
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:12pt;
            margin-left:-15px;
        } 
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:12pt;
        }
    }
    
    @media only screen and (min-width: 992px){
        iframe{
            height:400px;
            width:100%;
        }
        
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:12pt;
            margin-left:-15px;
        } 
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:12pt;
        }
    }
    
    @media only screen and (min-width: 1200px){
        iframe{
            height:500px;
            width:100%;
        }
        
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:12pt;
            margin-left:-15px;
        } 
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:12pt;
        }
    }
    
</style>

<div class="card card-success">
<div class="card-header">
    <h3 class="card-title">Surat Masuk</h3>
</div>
<div class="card-body">

<div class="row">
    <div class="col-md-3 col-3"><p>Asal Surat</p></div>
    <div class="col-md-9 col-9"><p>: <?= $sm->asal_surat ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Perihal Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->perihal ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Tanggal Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= tgl_indoo($sm->tanggal) ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Tanggal Masuk Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= tgl_indoo($sm->tanggal_masuk) ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Nomor Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->no_surat_masuk ?></p></div>
    <div class="col-md-12 col-12" style="margin-bottom:10px"><button class="btn btn-success" data-target="#dispo" data-toggle="modal">Disposisi</button></div>
    <div class="col-md-12 col-12">
        <iframe src="<?= base_url() ?>asset/file_lainnya/surat_masuk/<?= $sm->file_pdf ?>"></iframe>
    </div>
</div>

</div>
<div class="card-footer">
    
</div>
</div>
<div class="modal fade" id="dispo" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Disposisi :</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" method="post" action="<?= base_url() ?>sijuara/kirim_disposisi">
              <input type="hidden" name="id_surat_masuk" value="<?= $sm->id_surat_masuk ?>">
              <div class="form-group">
                  <div class="row">
                  <div class="col-md-6 col-12">
                  <div class="col-md-12"><b>Diteruskan Kepada :</b></div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" name="diteruskan" value="Kepala Sub Bagian Tata Usaha">Kepala Sub Bagian Tata Usaha
                      </label>
                      <ol type="a">
                          <li>Urusan Keuangan</li>
                          <li>Urusan Kepegawaiaan dan Rumah Tangga</li>
                          <li>Urusan Umum dan Perlengkapan</li>
                      </ol>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" name="diteruskan" value="Kepala Seksi Pelayanan Pengkajian">Kepala Seksi Pelayanan Pengkajian
                      </label>
                      <ol type="a">
                          <li>Unit Kerjasama dan Pelayanan Pengkajian </li>
                          <li>Unit Media Informasi Publikasi dan Diseminasi</li>
                          <li>Unit Pengelola Benih Sumber (UPBS)</li>
                          <li>Unit Kebun Percobaan</li>
                          <li>Unit Laboratorium Tanah dan Jaringan Tanaman</li>
                      </ol>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" name="diteruskan" value="Koordinasi Program dan Evaluasi">Koordinasi Program dan Evaluasi
                      </label>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" name="diteruskan" value="Ketua Kelji">Ketua Kelji
                      </label>
                      <ol type="a">
                          <li>Sumber Daya dan Sosok Pertanian</li>
                          <li>Sistem Usaha Pertanian</li>
                      </ol>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" name="diteruskan" value="Pejabat Pembuat Komitmen">Pejabat Pembuat Komitmen
                      </label>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" name="diteruskan" value="Bendahara Pengeluaran">Bendahara Pengeluaran
                      </label>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" name="diteruskan" value="Bendahara Penerima">Bendahara Penerima
                      </label>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" name="diteruskan" value="ULP dan Pejabat Pengadaan">ULP dan Pejabat Pengadaan
                      </label>
                    </div>
                  </div>
                  
                  <div class="col-md-6 col-12">
                  <div class="col-md-12"><b>Isi Disposisi :</b></div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input" name="isi_disposisi" value="Untuk Diketahui">Untuk Diketahui
                      </label>
                    </div>
                  <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input" name="isi_disposisi" value="Untuk Penyelesaian Selanjutnya">Untuk Penyelesaian Selanjutnya
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input" name="isi_disposisi" value="Harap Saran/Pertimbangan">Harap Saran/Pertimbangan
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input" name="isi_disposisi" value="Untuk dibicarakan dengan saya">Untuk Dibicarakan dengan saya
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input" name="isi_disposisi" value="Harap Mewakili Saya">Harap Mewakili Saya
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input" name="isi_disposisi" value="Konsutasi/diskusi dengan">Konsutasi/diskusi dengan
                      </label>
                    </div>
                  </div>
                  
                  <div style="margin-top:20px" class="col-md-12 col-12">
                      <select name="pegawai" class="form-control select2">
                        <option value="">-- Pilih Pegawai --</option>
                        <?php
                        $no_wa = "";
                        foreach($peg->result() as $pg){
                            $no_hp = $pg->no_hp;
                            $no_wa = substr_replace("$no_hp","62",0,1);
                        ?>
                        <option value="<?= $pg->nama ?>-<?= $no_wa ?>"><?= $pg->nama ?></option>
                        <?php
                        }
                        ?>
                      </select>
                  </div>
                  
                  </div>
              </div>
              <button type="submit" name="submit" class="btn btn-danger">Submit</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>