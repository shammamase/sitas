<?php 
    if($this->session->level=="admin"){
?>
<section class="col-lg-12 connectedSortable">
    <?php include "home_grafik.php"; ?>
</section><!-- /.Left col -->
<?php
    }
?>
<section class="col-lg-8">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">10 Besar Konten Terpopuler</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style='width:20px'>No</th>
                <th>Judul Konten</th>
                <th>Dibaca</th>
                <th>Tgl Post</th>
              </tr>
            </thead>
            <tbody>
          <?php 
            $usr = $this->session->username;
            $no = 1;
            if($this->session->level=='admin'){
            $qw_rank_konten = $this->db->query("select judul, tanggal, dibaca from cltr_post order by dibaca desc limit 0,10");
            } else {
            $qw_rank_konten = $this->db->query("select judul, tanggal, dibaca from cltr_post where username = '$usr' order by dibaca desc limit 0,10");
            }
            foreach ($qw_rank_konten->result_array() as $row){
            $tgl_posting = tgl_indo($row['tanggal']);
            echo "<tr><td>$no</td>
                      <td>$row[judul]</td>
                      <td>$row[dibaca] Kali</td>
                      <td>$tgl_posting</td>
                  </tr>";
              $no++;
            }
          ?>
          </tbody>
        </table>
      </div>
    </div>
</section>
<section class="col-lg-4">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Info Lainnya</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped">
            <?php  
            $bln_ini = date('Y-m');
            if($this->session->level=="admin"){
            ?>
            <thead>
              <tr>
                <th colspan="2">Jumlah Pengunjung</th>
              </tr>
            </thead>
            <tbody>
            <tr>
                <td>Total Pengunjung sampai saat ini</td>
                <td>
                    <?php
                        $qw_sum_kun = $this->db->query("SELECT DISTINCT ip FROM statistik");
                        echo $qw_sum_kun->num_rows();
                    ?>
                </td>
            </tr>
            <tr>
                <td>Total Pengunjung bulan ini</td>
                <td>
                    <?php
                        $qw_bln_ini = $this->db->query("SELECT DISTINCT ip FROM statistik WHERE tanggal LIKE '%$bln_ini%'");
                        echo $qw_bln_ini->num_rows();
                    ?>
                </td>
            </tr>
            </tbody>
            <?php
            }
            ?>
            <thead>
              <tr>
                <th colspan="2">Jumlah Konten</th>
              </tr>
            </thead>
            <tbody>
            <tr>
                <td>Total Konten sampai saat ini</td>
                <td>
                    <?php
                        if($this->session->level=="admin"){
                        $qw_sum_konten = $this->db->query("select judul, tanggal, dibaca from cltr_post where acc = 1");
                        } else {
                        $qw_sum_konten = $this->db->query("select judul, tanggal, dibaca from cltr_post where username = '$usr'");
                        }
                        echo $qw_sum_konten->num_rows();
                    ?>
                </td>
            </tr>
            <tr>
                <td>Total Konten bulan ini</td>
                <td>
                    <?php
                        if($this->session->level=="admin"){
                        $qw_sum_konten_bln = $this->db->query("select judul, tanggal, dibaca from cltr_post where tanggal like '%$bln_ini%' and acc = 1");
                        } else {
                        $qw_sum_konten_bln = $this->db->query("select judul, tanggal, dibaca from cltr_post where tanggal like '%$bln_ini%' and username = '$usr'");
                        }
                        echo $qw_sum_konten_bln->num_rows();
                    ?>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</section>
            