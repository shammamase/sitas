<?php 
class Model_template extends CI_model{
    function template(){
        return $this->db->query("SELECT * FROM templates");
    }

    function template_tambah(){
        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                        'pembuat'=>$this->db->escape_str($this->input->post('b')),
                        'folder'=>$this->db->escape_str($this->input->post('c')),
                        'aktif'=>$this->db->escape_str($this->input->post('d')));
        $this->db->insert('templates',$datadb);
    }

    function template_update(){
        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                        'pembuat'=>$this->db->escape_str($this->input->post('b')),
                        'folder'=>$this->db->escape_str($this->input->post('c')),
                        'aktif'=>$this->db->escape_str($this->input->post('d')));
        $this->db->where('id_templates',$this->input->post('id'));
        $this->db->update('templates',$datadb);
    }

    function template_edit($id){
        return $this->db->query("SELECT * FROM templates where id_templates='$id'");
    }

    function template_delete($id){
        return $this->db->query("DELETE FROM templates where id_templates='$id'");
    }

    function list_post(){
        return $this->db->query("SELECT id_post, judul FROM cltr_post ORDER BY id_post DESC LIMIT 10");
    }

    function list_halaman(){
        return $this->db->query("SELECT id_halaman, judul FROM halamanstatis ORDER BY id_halaman DESC LIMIT 10");
    }

    function properti_per_komponen($x){
        return $this->db->query("SELECT * FROM cltr_properti WHERE id_komp = '$x'");
    }

    function plugin($x){
        return $this->db->query("SELECT a.*, b.*, c.* FROM cltr_plugin a LEFT JOIN cltr_properti b ON a.id_properti=b.id_properti LEFT JOIN cltr_komp c ON b.id_komp=c.id_komp WHERE c.id_komp =  '$x'");
    }

    function edit_plugin($x){
        return $this->db->query("SELECT * FROM cltr_plugin WHERE id_plugin IN ($x)");
    }

    function delete_plugin($x){
        return $this->db->query("DELETE FROM cltr_plugin WHERE id_plugin IN ($x)");
    }
}