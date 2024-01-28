<?php 
class Model_sitas extends CI_model{
    function cek_login_sijuara($username,$password){
        return $this->db->query("SELECT * FROM user where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
    }
}