<?php 
class Model_slider extends CI_model{
    function kat_slider(){
        return $this->db->query("SELECT * FROM cltr_kat_slider ORDER BY id_kat_slider ASC");
    }

    function add_kat_slider(){
        $datadb = array('kat_slider'=>$this->db->escape_str($this->input->post('a')));
        $this->db->insert('cltr_kat_slider',$datadb);
    }

    function del_kat_slider($x){
        return $this->db->query("DELETE FROM cltr_kat_slider WHERE id_kat_slider = '$x'");
    }

    function update_kat_slider(){
        $datadb = array('kat_slider'=>$this->db->escape_str($this->input->post('a')));
        $this->db->where('id_kat_slider',$this->input->post('id_sld'));
        $this->db->update('cltr_kat_slider',$datadb);
    }

    function wilayah_tambah(){
        $datadb = array('nama_wilayah'=>$this->db->escape_str($this->input->post('a')),
                        'wilayah_seo'=>seo_title($this->input->post('a')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->insert('cltr_wilayah',$datadb);
    }

    function wilayah_edit($id){
        return $this->db->query("SELECT * FROM cltr_wilayah where id_wilayah='$id'");
    }

    function wilayah_update(){
        $datadb = array('nama_wilayah'=>$this->db->escape_str($this->input->post('a')),
                        'wilayah_seo'=>seo_title($this->input->post('a')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->where('id_wilayah',$this->input->post('id'));
        $this->db->update('cltr_wilayah',$datadb);
    }

    function wilayah_delete($id){
        return $this->db->query("DELETE FROM cltr_wilayah where id_wilayah='$id'");
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
        return $this->db->query("SELECT * FROM cltr_tag ORDER BY id_tag DESC");
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
        return $this->db->query("SELECT * FROM komentar where id_berita = '$id_berita' AND aktif='Y'");
    }

    function kirim_komentar(){
        $datadb = array('id_berita'=>cetak($this->input->post('a')),
                                'nama_komentar'=>cetak($this->input->post('b')),
                                'url'=>cetak($this->input->post('c')),
                                'isi_komentar'=>cetak($this->input->post('d')),
                                'tgl'=>date('Y-m-d'),
                                'jam_komentar'=>date('H:i:s'),
                                'aktif'=>'N');
        $this->db->insert('komentar',$datadb);
    }

    function list_berita_rss(){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM berita a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_berita DESC LIMIT 10");
    }

    function list_slider(){
        $userr = $this->session->username;
        return $this->db->query("SELECT a.*, b.kat_slider FROM cltr_slider a LEFT JOIN cltr_kat_slider b ON a.id_kat_slider=b.id_kat_slider ORDER BY a.id_slider DESC");
    }

    function list_slider_tambah(){
        $config['upload_path'] = 'asset/foto_slider/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('e');
        $hasil=$this->upload->data();
            if ($this->input->post('j')!=''){
                $tag_seo = $this->input->post('j');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }
            if ($hasil['file_name']==''){
                $datadb = array('id_kat_slider'=>$this->db->escape_str($this->input->post('b')),
                                'teks'=>$this->db->escape_str($this->input->post('a')),
                                'status'=>$this->db->escape_str($this->input->post('c')));
            }else{
                $datadb = array('id_kat_slider'=>$this->db->escape_str($this->input->post('b')),
                                'teks'=>$this->db->escape_str($this->input->post('a')),
                                'status'=>$this->db->escape_str($this->input->post('c')),
                                'slider'=>$hasil['file_name']);
            }
        $this->db->insert('cltr_slider',$datadb);
    }

    function list_slider_edit($id){
        return $this->db->query("SELECT * FROM cltr_slider where id_slider='$id'");
    }

    function list_slider_update(){
        $config['upload_path'] = 'asset/foto_slider/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('e');
        $hasil=$this->upload->data();
            if ($this->input->post('j')!=''){
                $tag_seo = $this->input->post('j');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }
            if ($hasil['file_name']==''){
                $datadb = array('id_kat_slider'=>$this->db->escape_str($this->input->post('b')),
                                'teks'=>$this->db->escape_str($this->input->post('a')),
                                'status'=>$this->db->escape_str($this->input->post('c')),
                                );
            }else{
                $datadb = array('id_kat_slider'=>$this->db->escape_str($this->input->post('b')),
                                'teks'=>$this->db->escape_str($this->input->post('a')),
                                'status'=>$this->db->escape_str($this->input->post('c')),
                                'slider'=>$hasil['file_name'],
                                );
            }
        $this->db->where('id_slider',$this->input->post('id'));
        $this->db->update('cltr_slider',$datadb);
    }

    function list_slider_delete($id){
        return $this->db->query("DELETE FROM cltr_slider where id_slider='$id'");
    }

    function slider_row($id){
        return $this->db->query("SELECT * FROM cltr_slider WHERE id_slider='$id'")->row();
    }


    function komentar(){
        return $this->db->query("SELECT * FROM komentar ORDER BY id_komentar DESC");
    }

    function komentar_edit($id){
        return $this->db->query("SELECT * FROM komentar where id_komentar='$id'");
    }

    function komentar_update(){
        $datadb = array('nama_komentar'=>$this->db->escape_str($this->input->post('a')),
                        'url'=>$this->db->escape_str($this->input->post('b')),
                        'isi_komentar'=>$this->input->post('c'),
                        'aktif'=>$this->input->post('d'));
        $this->db->where('id_komentar',$this->input->post('id'));
        $this->db->update('komentar',$datadb);
    }

    function komentar_delete($id){
        return $this->db->query("DELETE FROM komentar where id_komentar='$id'");
    }
}