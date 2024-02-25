<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <iframe style="width:100%;height:600px" src="<?= base_url() ?>preview/pdf_surat/<?= md5($uri3) ?>/<?= $uri3 ?>"></iframe>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <!--
            <div class="card card-primary">
                <div class="card-body">
            -->
                    <form method="post" action="<?= base_url() ?>primer/save_surat_prev">
                        <!--
                        <div class="form-group">
                        <label>Tanggal</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" name="tanggal" class="form-control datetimepicker-input" value="<?= $surat->tanggal ?>" data-target="#reservationdate" required/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        <label>Kode Klasifikasi:</label>
                        <select class="form-control select2" name="arsip" style="width: 100%;" required>
                                <option value="<?= $surat->id_sub_arsip ?>"><?= $sub_arsip->kode_sub_arsip ?> - <?= $sub_arsip->arsip ?> - <?= $sub_arsip->sub_arsip ?></option>
                                <?php
                                    foreach($ars as $ar){
                                    ?>
                                    <option value="<?= $ar->id_sub_arsip ?>"><?= $ar->kode_sub_arsip ?> - <?= $ar->arsip ?> - <?= $ar->sub_arsip ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label>Sifat:</label>
                        <select class="form-control select2" name="sifat" style="width: 100%;" required>
                                <option value="<?= $surat->sifat ?>"><?= $row_sifat->sifat ?></option>
                                <?php
                                    foreach($sif as $sf){
                                    ?>
                                    <option value="<?= $sf->id_sifat ?>"><?= $sf->sifat ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label>Lampiran</label>
                        <input type="text" class="form-control" name="lampiran" value="<?= $surat->lampiran ?>">
                        </div>
                        <div class="form-group">
                        <label>Hal</label>
                        <textarea name="hal" class="form-control"><?= $surat->perihal ?></textarea>
                        </div>
                        <div class="form-group">
                        <label>Kepada</label>
                        <input type="text" class="form-control" name="kepada" value="<?= $surat->tujuan_surat ?>">
                        </div>
                        <div class="form-group">
                        <label>di</label>
                        <input type="text" class="form-control" name="lokasi_kepada" value="<?= $surat->lokasi_tujuan_surat ?>">
                        </div>
                        -->
                        <div class="form-group">
                        <label>Garis Tabel Hilang</label>
                        <input type="checkbox" name="is_garis" value="1" 
                            <?php if($surat->no_view_border==1){ echo "checked"; } else { echo ""; } ?>>
                        </div>
                        <div class="form-group">
                        <label>Isi Surat:</label>
                        <textarea name="isi_surat" id="summernote"><?= $surat->isi_surat ?></textarea>
                        </div>
                        <!--
                        <div class="form-group">
                        <label>Tembusan (Pisahkan dengan koma jika tembusan lebih dari 1)</label>
                        <input type="text" class="form-control" name="tembusan" value="<?= $surat->tembusan ?>">
                        </div>
                        -->
                        <input type="hidden" name="id_surat_keluar" value="<?= $surat->id_surat_keluar ?>">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                <!--
                </div>
            </div>
            -->
        </div>
        <?php if($cek_lampiran > 0){ ?>
        <div class="col-12 col-md-12 col-lg-12">
            <form method="post" action="<?= base_url() ?>primer/save_lampiran_prev">
                <?php $no_lp = 1; foreach($list_lp as $lp){ ?>
                    <div class="form-group">
                    <label>Lampiran <?= $no_lp ?> :</label>
                    <textarea name="deskripsi[]" id="summernote<?= $no_lp ?>"><?= $lp->deskripsi ?></textarea>
                    </div>
                    <input type="hidden" name="id_lampiran[]" value="<?= $lp->id_lampiran ?>">
                <?php $no_lp++; } ?>
            <input type="hidden" name="id_surat_keluar" value="<?= $surat->id_surat_keluar ?>">
            <button type="submit" name="submitx" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <?php } ?>
    </div>
</div>