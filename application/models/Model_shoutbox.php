<?php 
class Model_shoutbox extends CI_model{
    function shoutbox(){
        return $this->db->query("SELECT * FROM shoutbox ORDER BY id_shoutbox DESC");
    }

    function shoutbox_edit($id){
        return $this->db->query("SELECT * FROM shoutbox where id_shoutbox='$id'");
    }

    function shoutbox_update(){
        $datadb = array('nama'=>$this->db->escape_str($this->input->post('a')),
                        'website'=>$this->db->escape_str($this->input->post('b')),
                        'pesan'=>$this->db->escape_str($this->input->post('c')),
                        'tanggal'=>date('Y-m-d'),
                        'jam'=>date('H:i:s'),
                        'aktif'=>$this->db->escape_str($this->input->post('d')));
        $this->db->where('id_shoutbox',$this->input->post('id'));
        $this->db->update('shoutbox',$datadb);
    }

    function shoutbox_delete($id){
        return $this->db->query("DELETE FROM shoutbox where id_shoutbox='$id'");
    }
}