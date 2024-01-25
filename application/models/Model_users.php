<?php 
class Model_users extends CI_model{
    function cek_login($username,$password){
        return $this->db->query("SELECT * FROM users where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
    }
    
    function cek_login_sijuara($username,$password){
        return $this->db->query("SELECT * FROM sijuara_user where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
    }
    
	function users(){
		return $this->db->query("SELECT * FROM users");
	}

	function users_tambah(){
        $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                        'password'=>md5($this->input->post('b')),
                        'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                        'email'=>$this->db->escape_str($this->input->post('d')),
                        'no_telp'=>$this->db->escape_str($this->input->post('e')),
                        'level'=>$this->input->post('l'),
                        'blokir'=>'N',
                        'id_session'=>md5($this->input->post('a')));
        $this->db->insert('users',$datadb);
    }

    function users_edit($id){
        return $this->db->query("SELECT * FROM users where username='$id'");
    }
    
    function users_edit_sijuara($id){
        return $this->db->query("SELECT a.id_user,a.username,c.nama FROM sijuara_user a INNER JOIN sijuara_pj b ON a.id_pj=b.id_pj INNER JOIN t_biodata c ON b.id_bio=c.id_bio where a.username='$id'");
    }

    function users_update(){
        if($this->session->level=='admin'){
            $lev = $this->input->post('l');
        } else {
            $lev = 'user';
        }
        if (trim($this->input->post('b'))==''){
            $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                            'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                            'email'=>$this->db->escape_str($this->input->post('d')),
                            'no_telp'=>$this->db->escape_str($this->input->post('e')),
                            'level'=>$lev,
                            'blokir'=>$this->db->escape_str($this->input->post('h')),
                            'id_session'=>md5($this->input->post('a')));
            $this->db->where('username',$this->input->post('id'));
            $this->db->update('users',$datadb);
        }else{
            $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                            'password'=>md5($this->input->post('b')),
                            'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                            'email'=>$this->db->escape_str($this->input->post('d')),
                            'no_telp'=>$this->db->escape_str($this->input->post('e')),
                            'level'=>$lev,
                            'blokir'=>$this->db->escape_str($this->input->post('h')),
                            'id_session'=>md5($this->input->post('a')));
            $this->db->where('username',$this->input->post('id'));
            $this->db->update('users',$datadb);
        }
    }

    function users_delete($id){
        return $this->db->query("DELETE FROM users where username='$id'");
    }

    function user_kuliner($admin){
        return $this->db->query("SELECT nama_lengkap FROM users WHERE username='$admin'")->row();
    }

}