<?php 
class Model_utama extends CI_model{
    function headline($dari, $jumlah){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM berita a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori where a.headline='Y' ORDER BY a.id_berita DESC LIMIT $dari, $jumlah");
    }

    function kategori($dari, $jumlah){
        return $this->db->query("SELECT * FROM kategori where aktif='Y' ORDER BY id_kategori ASC LIMIT $dari, $jumlah");
    }

    function berita_perkategori($id, $dari, $jumlah){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM berita a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori where a.id_kategori='$id' ORDER BY a.id_berita DESC LIMIT $dari, $jumlah");
    }

    function berita_utama($dari, $jumlah){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM berita a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_berita DESC LIMIT $dari, $jumlah");
    }

    function sekilasinfo(){
        return $this->db->query("SELECT * FROM sekilasinfo ORDER BY id_sekilas DESC LIMIT 5");
    }

    function mainmenu(){
        return $this->db->query("SELECT * FROM mainmenu where aktif='Y' ORDER BY id_main ASC");
    }

    function submenu($id){
        return $this->db->query("SELECT * FROM submenu WHERE id_main='$id' AND aktif='Y' ORDER BY id_sub ASC");
    }

    function submenu1($id){
        return $this->db->query("SELECT * FROM submenu WHERE id_submain='$id' AND id_submain!='0' AND aktif='Y' ORDER BY id_sub ASC");
    }

    function pengumuman($dari, $jumlah){
        return $this->db->query("SELECT * FROM sekilasinfo ORDER BY id_sekilas DESC LIMIT $dari, $jumlah");
    }

    function linkterkait($posisi, $dari, $jumlah){
        return $this->db->query("SELECT * FROM link_terkait where posisi='$posisi' ORDER BY id_link_terkait ASC LIMIT $dari, $jumlah");
    }

    function banner($dari, $jumlah){
        return $this->db->query("SELECT * FROM banner ORDER BY id_banner DESC LIMIT $dari, $jumlah");
    }

    function kunjungan(){
        $ip      = $_SERVER['REMOTE_ADDR'];
        $tanggal = date("Y-m-d");
        $waktu   = time(); 
        $cekk = $this->db->query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
        $rowh = $cekk->row_array();
        if($cekk->num_rows() == 0){
            $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>'1', 'online'=>$waktu);
            $this->db->insert('statistik',$datadb);
        }else{
            $hitss = $rowh['hits'] + 1;
            $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>$hitss, 'online'=>$waktu);
            $array = array('ip' => $ip, 'tanggal' => $tanggal);
            $this->db->where($array);
            $this->db->update('statistik',$datadb);
        }
    }

    function grafik_kunjungan(){
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 30");
    }

    function pengunjung(){
        return $this->db->query("SELECT * FROM statistik WHERE tanggal='".date("Y-m-d")."' GROUP BY ip");
    }

    function totalpengunjung(){
        return $this->db->query("SELECT COUNT(hits) as total FROM statistik");
    }

    function hits(){
        return $this->db->query("SELECT SUM(hits) as total FROM statistik WHERE tanggal='".date("Y-m-d")."' GROUP BY tanggal");
    }

    function totalhits(){
        return $this->db->query("SELECT SUM(hits) as total FROM statistik");
    }

    function pengunjungonline(){
        $bataswaktu       = time() - 300;
        return $this->db->query("SELECT * FROM statistik WHERE online > '$bataswaktu'");
    }

    function cek_poling(){
        return $this->db->query("SELECT * from modul where nama_modul='Poling' and publish='Y'");
    }

    function pertanyaan(){
        return $this->db->query("SELECT * FROM poling WHERE aktif='Y' and status='Pertanyaan'");
    }

    function jawaban(){
        return $this->db->query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
    }

    function semua_berita($start, $limit){
        return $this->db->query("SELECT * FROM berita a JOIN users b on a.username=b.username ORDER BY id_berita DESC LIMIT $start,$limit");
    }

    function hitungberita(){
        return $this->db->query("SELECT * FROM berita");
    }

    function semua_berita_cari($start, $limit, $kata){
        $pisah_kata = explode(" ",$kata);
        $jml_katakan = (integer)count($pisah_kata);
        $jml_kata = $jml_katakan-1;

        $cari = "SELECT * FROM berita WHERE " ;
            for ($i=0; $i<=$jml_kata; $i++){
              $cari .= "judul OR isi_berita LIKE '%$pisah_kata[$i]%'";
              if ($i < $jml_kata ){
                $cari .= " OR ";
              }
            }
        $cari .= " ORDER BY id_berita DESC LIMIT $start,$limit";
        return $this->db->query($cari);
    }

    function berita_detail($id){
        return $this->db->query("SELECT * FROM berita a LEFT JOIN users b ON a.username=b.username LEFT JOIN kategori c ON a.id_kategori=c.id_kategori where a.id_berita='".$this->db->escape_str($id)."' OR a.judul_seo='".$this->db->escape_str($id)."'");
    }

    function berita_dibaca_update($id){
        return $this->db->query("UPDATE berita SET dibaca=dibaca+1 where id_berita='".$this->db->escape_str($id)."' OR judul_seo='".$this->db->escape_str($id)."'");
    }

    function detail_kategori($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM berita where id_kategori='".$this->db->escape_str($id)."' ORDER BY id_berita DESC LIMIT $dari,$sampai");
    }

    function info_terkait($limit,$tag){
        $pisah_kata  = explode(",",$tag);
        $jml_katakan = (integer)count($pisah_kata);
        $jml_kata = $jml_katakan-1; 
        $cari = "SELECT * FROM berita WHERE " ;
                for ($i=0; $i<=$jml_kata; $i++){
                  $cari .= "tag LIKE '%$pisah_kata[$i]%'";
                  if ($i < $jml_kata ){
                    $cari .= " OR ";
                  }
                }
        $cari .= " ORDER BY id_berita DESC LIMIT $limit";
        return $this->db->query($cari);
    }

    function hitungberitakategori($kat){
        return $this->db->query("SELECT * FROM berita where id_kategori='".$this->db->escape_str($kat)."'");
    }

    function page_detail($id){
        return $this->db->query("SELECT * FROM halamanstatis where lower(replace(judul,' ','-'))='".$this->db->escape_str($id)."'");
    }

    function agenda($start, $limit){
        return $this->db->query("SELECT a.*, b.nama_lengkap FROM agenda a JOIN users b ON a.username=b.username ORDER BY a.id_agenda DESC LIMIT $start, $limit");
    }

    function hitungagenda(){
        return $this->db->query("SELECT * FROM agenda");
    }

    function agenda_detail($id){
        return $this->db->query("SELECT a.*, b.nama_lengkap FROM agenda a JOIN users b ON a.username=b.username where a.tema_seo='".$this->db->escape_str($id)."'");
    }

    function index($start,$limit){
        return $this->db->query("SELECT * FROM download ORDER BY id_download DESC LIMIT $start,$limit");
    }

    function updatehits($file){
        return $this->db->query("UPDATE download set hits=hits+1 where nama_file='".$this->db->escape_str($file)."'");
    }

    function hitungdownload(){
        return $this->db->query("SELECT * FROM download");
    }

    function album($start, $limit){
        return $this->db->query("SELECT * FROM album ORDER BY id_album DESC LIMIT $start, $limit");
    }

    function hitungalbum(){
        return $this->db->query("SELECT * FROM album");
    }

    function hitungfoto($album){
        return $this->db->query("SELECT * FROM gallery where id_album='$album'");
    }

    function gallery($id, $start, $limit){
        return $this->db->query("SELECT * FROM gallery where id_album='$id' ORDER BY id_gallery DESC LIMIT $start, $limit");
    }

    function kirim_Pesan(){
        $nama     = cetak($this->input->post('a'));
        $email    = cetak($this->input->post('b'));
        $subjek   = cetak($this->input->post('c'));
        $pesan    = cetak($this->input->post('d'));
            $datadb = array('nama'=>$nama,
                            'email'=>$email,
                            'subjek'=>$subjek,
                            'pesan'=>$pesan,
                            'tanggal'=>date('Y-m-d'));
        $this->db->insert('hubungi',$datadb);
    }

    function vote($pilihan){
        return $this->db->query("UPDATE poling SET rating=rating+1 WHERE id_poling='$pilihan'");
    }

    function jumlah_vote(){
        return $this->db->query("SELECT SUM(rating) as jml_vote FROM poling WHERE aktif='Y'");
    }

    function hasil_vote(){
        return $this->db->query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
    }
}