<?php 
class Model_sekilasinfo extends CI_model{
    function sekilasinfo(){
        return $this->db->query("SELECT * FROM sekilasinfo ORDER BY id_sekilas DESC");
    }

    function sekilasinfo_tambah(){
            $config['upload_path'] = 'asset/foto_info/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('b');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $datadb = array('info'=>$this->db->escape_str($this->input->post('a')),
                                    'tgl_posting'=>date('Y-m-d'));
            }else{
            		$datadb = array('info'=>$this->db->escape_str($this->input->post('a')),
                                    'tgl_posting'=>date('Y-m-d'),
                                    'gambar'=>$hasil['file_name']);
            }
        $this->db->insert('sekilasinfo',$datadb);
    }

    function sekilasinfo_edit($id){
        return $this->db->query("SELECT * FROM sekilasinfo where id_sekilas='$id'");
    }

    function sekilasinfo_update(){
        $config['upload_path'] = 'asset/foto_info/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('b');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
                    $datadb = array('info'=>$this->db->escape_str($this->input->post('a')));
            }else{
                    $datadb = array('info'=>$this->db->escape_str($this->input->post('a')),
                                    'gambar'=>$hasil['file_name']);
            }
        $this->db->where('id_sekilas',$this->input->post('id'));
        $this->db->update('sekilasinfo',$datadb);
    }

    function sekilasinfo_delete($id){
        return $this->db->query("DELETE FROM sekilasinfo where id_sekilas='$id'");
    }
}