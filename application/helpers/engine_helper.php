<?php 
    function cek_session_admin(){
        $ci = & get_instance();
        $session = $ci->session->userdata('level');
        if ($session == ''){
            redirect(base_url());
        }
    }
    
    function cek_session_admin1(){
        $ci = & get_instance();
        $session = $ci->session->userdata('username');
        if ($session == ''){
            redirect(base_url().'sijuara');
        }
    }

    function cek_session_akses($link,$id){
    	$ci = & get_instance();
    	$session = $ci->db->query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'")->num_rows();
    	if ($session == '0' AND $ci->session->userdata('level') != 'admin'){
    		redirect(base_url().'administrator/home');
    	}
    }

    function template(){
        $ci = & get_instance();
        $query = $ci->db->query("SELECT folder FROM templates where aktif='Y'");
        $tmp = $query->row_array();
        if ($query->num_rows()>=1){
            return $tmp['folder'];
        }else{
            return 'errors';
        }
    }

     function template_cltr(){
        $ci = & get_instance();
        $query = $ci->db->query("SELECT folder FROM cltr_templates where aktif='Y'");
        $tmp = $query->row_array();
        if ($query->num_rows()>=1){
            return $tmp['folder'];
        }else{
            return 'errors';
        }
    }