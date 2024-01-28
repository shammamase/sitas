<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Primer extends CI_Controller {
    function index(){
		if (isset($_POST['submit'])){
			$username = strip_tags($this->input->post('a'));
			$password = md5($this->input->post('b'));
            $tahun = strip_tags($this->input->post('c'));
			$cek = $this->model_sitas->cek_login_sijuara($username,$password);
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata('upload_image_file_manager',true);
				$this->session->set_userdata(array('username'=>$row['username'],'tahun'=>$tahun));
				redirect('primer/home');
			}else{
				$data['title'] = 'BSIP TAS &rsaquo; Log In';
				$this->load->view('sitas/view_login',$data);
			}
		}else{
			if ($this->session->username != ''){
				redirect('primer/home');
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

	function home(){
		cek_session_admin1();
		$data['thn'] = $this->session->thn_agr;
		$data['jml_v1'] = 0;//$this->model_more->daftar_spt_kabalai()->num_rows();
		$data['jml_v2'] = 0;//$this->model_more->daftar_surat_kabalai()->num_rows();
		$data['jml_v3'] = 0;//$this->model_more->daftar_surat_masuk_kabalai()->num_rows();
		$data['jml_v4'] = 0;//$this->model_more->daftar_lap_spt_kabalai()->num_rows();
		$data['jml_surat_masuk'] = 0;//$this->model_more->daftar_surat_masuk()->num_rows();
		$data['jml_surat_keluar'] = 0;//$this->model_more->daftar_surat_keluar()->num_rows();
		$data['jml_surat'] = 0;//$this->model_more->daftar_surat()->num_rows();
		$data['jml_spt'] = 0;//$this->model_more->daftar_spt()->num_rows();
		$data['jml_perjadin'] = 0;//$this->model_more->daftar_lap_spt22()->num_rows();
		$data['jml_anggaran'] = 0;//$this->db->query("select id_pengajuan from sijuara_simpan_pengajuan a
		/*									
		inner join sijuara_detil b on a.id_detil=b.id_detil
											inner join sijuara_subkomp c on b.id_subkomp=c.id_subkomp
											inner join sijuara_komponen d on c.id_komponen=d.id_komponen
											inner join sijuara_ro e on d.id_ro=e.id_ro
											inner join sijuara_kro f on e.id_kro=f.id_kro
											inner join sijuara_aktivitas g on f.id_aktivitas=g.id_aktivitas
											inner join sijuara_program h on g.id_program=h.id_program
											inner join sijuara_trs_alokasi i on h.id_alokasi=i.id_alokasi
											where i.ta like '%$thn%'")->num_rows();
		*/
		$data['jml_monev'] = 0;//$this->db->query("select id_monev from sijuara_monev where lap_bln like '%$thn%'")->num_rows();
		$data['jml_drive'] = 0;//$this->db->query("select id_file from sijuara_file where tahun = '$thn'")->num_rows();
		$data['list_x_perjadin'] = 0;//$this->model_more->daftar_belum_buat_perjadin();
		$data['jml_list_x_perjadin'] = 0;//$this->model_more->daftar_belum_buat_perjadin_jml();
		$this->template->load('sijuara/templatex','sijuara/view_homex_cltr',$data);
	}

    function logout(){
		$this->session->sess_destroy();
		redirect('primer');
	}
}