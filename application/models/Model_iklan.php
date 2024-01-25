<?php 
class Model_iklan extends CI_model{
    
    function banner_cltr(){
        return $this->db->query("SELECT * FROM cltr_banner");
    }

    function kat_banner(){
        return $this->db->query("SELECT * FROM cltr_kat_banner");
    }

    function banner_tambah_cltr(){
        $config['upload_path'] = 'asset/foto_banner_cltr/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('id_kat_banner'=>$this->input->post('kat_banner'),
                            'judul'=>$this->db->escape_str($this->input->post('a')),
                            'url'=>$this->input->post('b'),
                            'tgl_posting'=>date('Y-m-d'));
        }else{
            $datadb = array('id_kat_banner'=>$this->input->post('kat_banner'),
                            'judul'=>$this->db->escape_str($this->input->post('a')),
                            'url'=>$this->input->post('b'),
                            'gambar'=>$hasil['file_name'],
                            'tgl_posting'=>date('Y-m-d'));
        }
        $this->db->insert('cltr_banner',$datadb);
    }


    function banner_edit_cltr($id){
        return $this->db->query("SELECT * FROM cltr_banner where id_banner='$id'");
    }

    function banner_update_cltr(){
        $config['upload_path'] = 'asset/foto_banner_cltr/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('id_kat_banner'=>$this->input->post('kat_banner'),
                            'judul'=>$this->db->escape_str($this->input->post('a')),
                            'url'=>$this->input->post('b'),
                            'tgl_posting'=>date('Y-m-d'));
        }else{
            $datadb = array('id_kat_banner'=>$this->input->post('kat_banner'),
                            'judul'=>$this->db->escape_str($this->input->post('a')),
                            'url'=>$this->input->post('b'),
                            'gambar'=>$hasil['file_name'],
                            'tgl_posting'=>date('Y-m-d'));
        }
        $this->db->where('id_banner',$this->input->post('id'));
        $this->db->update('cltr_banner',$datadb);
    }

    
    function banner_delete_cltr($id){
        return $this->db->query("DELETE FROM cltr_banner where id_banner='$id'");
    }

    function banner_row($id){
        return $this->db->query("SELECT * FROM cltr_banner WHERE id_banner='$id'")->row();
    }

    function kat_banner_row($id){
        return $this->db->query("SELECT * FROM cltr_kat_banner WHERE id_kat_banner='$id'");
    }    
}