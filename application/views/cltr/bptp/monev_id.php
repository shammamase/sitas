<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(<?php echo base_url() ?>template/<?php echo template_cltr() ?>/assets/img/bg-img/24_2.jpg);">
        <h2><?php echo $title ?></h2>
    </div>
</div>
<br>
<section class="blog-content-area section-padding-0-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Blog Posts Area -->
            <div class="col-12 col-md-12 col-lg-12">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <th>Bulan</th>
                        <th>Capaian</th>
                        <th>Kendala</th>
                        <th>Solusi</th>
                        <th>Eviden</th>
                    </thead>
                    <tbody>
                    <?php 
                    foreach($bulan as $bln){
                        $blnx = $tahun."-".$bln;
                        $qw_monev = $this->db->query("select * from sijuara_monev where lap_bln = '$blnx' and id_subkomp = '$id'")->row();
                        if(!empty($qw_monev)){
                            $capaian = $qw_monev->capaian;
                            $kendala = $qw_monev->kendala;
                            $solusi = $qw_monev->solusi;
                        } else {
                            $capaian = "";
                            $kendala = "";
                            $solusi = "";
                        }
                    ?>
                    <tr>
                        <td><?= tgl_indoo($blnx) ?></td>
                        <td><?= $capaian ?></td>
                        <td><?= $kendala ?></td>
                        <td><?= $solusi ?></td>
                        <td><button class="btn btn-success btn-xs" data-target="#eviden" data-toggle="modal" data-id="<?= $blnx."#".$title ?>">Link</button></td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->

<div class="modal fade" id="eviden" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Eviden</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="fetch_data_ev"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#eviden').on('show.bs.modal', function (e) {
           var rows = $(e.relatedTarget).data('id');
           $.ajax({
              type : 'post',
              url : '<?= base_url() ?>bptp/monev_eviden',
              data : 'lap_bln='+ rows,
              success : function(data){
                  $('.fetch_data_ev').html(data);
              }
           });
        });
    });
</script>
