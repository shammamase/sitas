<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Primer extends CI_Controller {
    function index(){
		if (isset($_POST['submit'])){
			$username = strip_tags($this->input->post('a'));
			$password = md5($this->input->post('b'));
            $tahun = strip_tags($this->input->post('c'));
			$cek = $this->model_users->cek_login_sijuara($username,$password);
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata('upload_image_file_manager',true);
				$this->session->set_userdata(array('username'=>$row['username'],'tahun'=>$tahun));
				redirect('primer/tes_masuk');
			}else{
				$data['title'] = 'BSIP TAS &rsaquo; Log In';
				$this->load->view('sitas/view_login',$data);
			}
		}else{
			if ($this->session->username != ''){
				redirect('primer/tes_masuk');
			}else{
				$data['title'] = 'BSIP TAS &rsaquo; Log In';
				$this->load->view('sitas/view_login',$data);
			}
		}
	}

    function tes_masuk(){
        cek_session_admin1();
        echo "masuk ".$this->session->username." ".$this->session->tahun;
    }

    function logout(){
		$this->session->sess_destroy();
		redirect('primer');
	}
}