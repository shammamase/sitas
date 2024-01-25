<?php 
class Model_berita extends CI_model{
    function kategori_berita($x){
        return $this->db->query("SELECT * FROM cltr_page WHERE id_page = '$x'");
    }

    function kategori_berita_id($x){
        return $this->db->query("SELECT * FROM cltr_page WHERE id_page = '$x'");
    }    

    function kat_menu($x){
        return $this->db->query("SELECT sekunder FROM cltr_menu WHERE id_kat_menu = 2 AND utama = '$x'");
    }

    function berita($x){
        return $this->db->query("SELECT * FROM cltr_post WHERE id_page IN ($x) AND acc = 1");
    }

    function semua_berita($x,$y,$z){
        return $this->db->query("SELECT * FROM cltr_post WHERE id_page IN ($z) AND acc = 1 ORDER BY id_post DESC LIMIT $x,$y");
    }

    function list_berita_tambah(){
        $config['upload_path'] = 'asset/foto_content/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        
            if ($this->input->post('j')!=''){
                $tag_seo = $this->input->post('j');
                $pc_tag = explode(",", $tag_seo);
                $sum_tag = count($pc_tag);
                for ($i=0; $i < $sum_tag; $i++) { 
                    $pc_tag[$i] = seo_title($pc_tag[$i]);
                }
                $tag=implode(',',$pc_tag);
            }else{
                $tag = '';
            }
            
            if($this->upload->do_upload('th')){
                $hasilth=$this->upload->data();
                $thm = $hasilth['file_name'];
            } else {
                $thm = "";
            }
            if($this->upload->do_upload('e')){
                $hasil=$this->upload->data();
                $gmb = $hasil['file_name'];
            } else {
                $gmb = "";
            }
            
            if($this->session->level=='admin'){
                $acep = 1;
            } else {
                $acep = 0;
            }
           
                $datadb = array('username'=>$this->db->escape_str($this->input->post('u')),
                                'id_page'=>$this->db->escape_str($this->input->post('b')),
                                'judul'=>$this->db->escape_str($this->input->post('a')),
                                'judul_seo'=>seo_title($this->input->post('a')),
                                'headline'=>$this->db->escape_str($this->input->post('c')),
                                'isi_berita'=>$this->input->post('d'),
                                'isi'=>strip_tags($this->input->post('d')),
                                'hari'=>hari_ini(date('w')),
                                'tanggal'=>date('Y-m-d'),
                                'jam'=>date('H:i:s'),
                                'thumbnail'=>$thm,
                                'gambar'=>$gmb,
                                'caption'=>$this->db->escape_str($this->input->post('cap')),
                                'dibaca'=>'0',
                                'tag'=>$tag_seo,
                                'tag_asli'=>$tag,
                                'acc'=>$acep);
            
        $this->db->insert('cltr_post',$datadb);
    }

    function list_berita_update(){
        $config['upload_path'] = 'asset/foto_content/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        
            if ($this->input->post('j')!=''){
                $tag_seo = $this->input->post('j');
                $pc_tag = explode(",", $tag_seo);
                $sum_tag = count($pc_tag);
                for ($i=0; $i < $sum_tag; $i++) { 
                    $pc_tag[$i] = seo_title($pc_tag[$i]);
                }
                $tag=implode(',',$pc_tag);
            }else{
                $tag = '';
            }
            
            if($this->upload->do_upload('th')){
                $hasilth=$this->upload->data();
                $thm = $hasilth['file_name'];
            } else {
                $thm = $this->input->post('thm1');
            }
            if($this->upload->do_upload('e')){
                $hasil=$this->upload->data();
                $gmb = $hasil['file_name'];
            } else {
                $gmb = $this->input->post('gbr1');
            }
            
                $datadb = array('id_page'=>$this->db->escape_str($this->input->post('b')),
                                'judul'=>$this->db->escape_str($this->input->post('a')),
                                'judul_seo'=>seo_title($this->input->post('a')),
                                'headline'=>$this->db->escape_str($this->input->post('c')),
                                'isi_berita'=>$this->input->post('d'),
                                'isi'=>strip_tags($this->input->post('d')),
                                'hari'=>hari_ini(date('w')),
                                'tanggal'=>date('Y-m-d'),
                                'jam'=>date('H:i:s'),
                                'thumbnail'=>$thm,
                                'gambar'=>$gmb,
                                'caption'=>$this->db->escape_str($this->input->post('cap')),
                                'tag'=>$tag_seo,
                                'tag_asli'=>$tag,
                                'acc'=>1);
                                
        $this->db->where('id_post',$this->input->post('id'));
        $this->db->update('cltr_post',$datadb);
    }

    function berita_row($id){
        return $this->db->query("SELECT * FROM cltr_post WHERE id_post='$id'")->row();
    }

    function list_berita_delete($id){
        return $this->db->query("DELETE FROM cltr_post where id_post='$id'");
    }
    
    function list_berita_off($id){
        return $this->db->query("UPDATE cltr_post SET acc = 0 WHERE id_post='$id'");
    }

    function sensorkata(){
        return $this->db->query("SELECT * FROM katajelek ORDER BY id_jelek DESC");
    }

    function sensorkata_tambah(){
        $datadb = array('kata'=>$this->db->escape_str($this->input->post('a')),
                        'ganti'=>$this->db->escape_str($this->input->post('b')));
        $this->db->insert('katajelek',$datadb);
    }

    function sensorkata_edit($id){
        return $this->db->query("SELECT * FROM katajelek where id_jelek='$id'");
    }

    function sensorkata_update(){
        $datadb = array('kata'=>$this->db->escape_str($this->input->post('a')),
                        'ganti'=>$this->db->escape_str($this->input->post('b')));
        $this->db->where('id_jelek',$this->input->post('id'));
        $this->db->update('katajelek',$datadb);
    }

    function sensorkata_delete($id){
        return $this->db->query("DELETE FROM katajelek where id_jelek='$id'");
    }



    function tag_berita(){
        return $this->db->query("SELECT * FROM cltr_page ORDER BY id_page DESC");
    }

    function tag_berita_tambah(){
        $datadb = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'tag_seo'=>seo_title($this->input->post('a')),
                        'count'=>'0');
        $this->db->insert('tag',$datadb);
    }

    function tag_berita_edit($id){
        return $this->db->query("SELECT * FROM tag where id_tag='$id'");
    }

    function tag_berita_update(){
        $datadb = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'tag_seo'=>seo_title($this->input->post('a')));
        $this->db->where('id_tag',$this->input->post('id'));
        $this->db->update('tag',$datadb);
    }

    function tag_berita_delete($id){
        return $this->db->query("DELETE FROM tag where id_tag='$id'");
    }

    function komentar_berita($id_berita){
        return $this->db->query("SELECT * FROM cltr_komentar where id_post = '$id_berita' AND aktif='Y'");
    }

    function kirim_komentar(){
        $datadb = array('id_post'=>cetak($this->input->post('a')),
                                'nama_komentar'=>cetak($this->input->post('b')),
                                'url'=>cetak($this->input->post('c')),
                                'isi_komentar'=>cetak($this->input->post('d')),
                                'tgl'=>date('Y-m-d'),
                                'jam_komentar'=>date('H:i:s'),
                                'aktif'=>'N');
        $this->db->insert('cltr_komentar',$datadb);
    }

    function list_berita_rss(){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM berita a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_berita DESC LIMIT 10");
    }

    function list_berita(){
        $userr = $this->session->username;
        if($this->session->level=='admin'){
        return $this->db->query("SELECT * FROM cltr_post a LEFT JOIN cltr_page b ON a.id_page=b.id_page WHERE a.acc = 1 ORDER BY a.id_post DESC LIMIT 100");
        } else {
        return $this->db->query("SELECT * FROM cltr_post a LEFT JOIN cltr_page b ON a.id_page=b.id_page WHERE username = '$userr' ORDER BY a.id_post DESC");
        }
    }
    
    function list_berita_user(){
        return $this->db->query("SELECT * FROM cltr_post a LEFT JOIN cltr_page b ON a.id_page=b.id_page WHERE a.acc = 0 ORDER BY a.id_post DESC");
    }

    function list_berita_edit($id){
        return $this->db->query("SELECT * FROM cltr_post where id_post='$id'");
    }

}