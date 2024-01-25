<?php 
class Model_halaman extends CI_model{
    function halamanstatis(){
        return $this->db->query("SELECT * FROM halamanstatis ORDER BY id_halaman DESC");
    }

    function halamanstatis_tambah(){
            $config['upload_path'] = 'asset/foto_page/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'page_seo'=>seo_title($this->input->post('a')),
                                    'kategori'=>$this->input->post('bbb'),
                                    'isi_halaman'=>$this->input->post('b'),
                                    'tgl_posting'=>date('Y-m-d'));
            }else{
            		$datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'page_seo'=>seo_title($this->input->post('a')),
                                    'kategori'=>$this->input->post('bbb'),
                                    'isi_halaman'=>$this->input->post('b'),
                                    'tgl_posting'=>date('Y-m-d'),
                                    'gambar'=>$hasil['file_name']);
            }
        $this->db->insert('halamanstatis',$datadb);
    }

    function halamanstatis_edit($id){
        return $this->db->query("SELECT * FROM halamanstatis where id_halaman='$id'");
    }

    function halamanstatis_update(){
        $config['upload_path'] = 'asset/foto_page/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'page_seo'=>seo_title($this->input->post('a')),
                                    'kategori'=>$this->input->post('bbb'),
                                    'isi_halaman'=>$this->input->post('b'),
                                    'tgl_posting'=>date('Y-m-d'));
        }else{
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'page_seo'=>seo_title($this->input->post('a')),
                                    'kategori'=>$this->input->post('bbb'),
                                    'isi_halaman'=>$this->input->post('b'),
                                    'tgl_posting'=>date('Y-m-d'),
                                    'gambar'=>$hasil['file_name']);
        }
        $this->db->where('id_halaman',$this->input->post('id'));
        $this->db->update('halamanstatis',$datadb);
    }

    function halamanstatis_delete($id){
        return $this->db->query("DELETE FROM halamanstatis where id_halaman='$id'");
    }


    function page(){
        return $this->db->query("SELECT * FROM halamanstatis ORDER BY id_halaman DESC");
    }

    function kate(){
        return $this->db->query("SELECT * FROM cltr_page ORDER BY id_page DESC");
    }

    function page_tambah(){
            
        $datadb = array('page'=>$this->db->escape_str($this->input->post('a')),
                        'page_seo'=>seo_title($this->input->post('a')),
                        'nm_menu'=>$this->db->escape_str($this->input->post('a')));
        $this->db->insert('cltr_page',$datadb);
    }

    function page_edit($id){
        return $this->db->query("SELECT * FROM cltr_page where id_page='$id'");
    }

    function page_edit2($id){
        return $this->db->query("SELECT * FROM halamanstatis where id_halaman='$id'");
    }

    function page_update(){
        $datadb = array('page'=>$this->db->escape_str($this->input->post('a')),
                        'page_seo'=>seo_title($this->input->post('a')),
                        'nm_menu'=>$this->db->escape_str($this->input->post('a')));
        $this->db->where('id_page',$this->input->post('id'));
        $this->db->update('cltr_page',$datadb);
    }

    function page_delete($id){
        return $this->db->query("DELETE FROM cltr_page where id_page='$id'");
    }
}