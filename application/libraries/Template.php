<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
    
                
		var $template_data = array();
		
		function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}
	
		function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
		{               
			$this->CI =& get_instance();
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
			return $this->CI->load->view($template, $this->template_data, $return);
		}

		function banner_area($x){
			$this->CI =& get_instance();
			$sql_bn = $this->CI->db->query("select * from tmpl_home where id_tmpl_home = $x")->row();
			$data['titel_satu'] = $sql_bn->titel_satu;
			$data['titel_dua'] = $sql_bn->titel_dua;
			$data['dbase'] = $sql_bn->dbase;
			
			$this->CI->load->view('section/banner_area',$data);
		}

		function hero_area($x){
			$this->CI =& get_instance();
			$sql_bn = $this->CI->db->query("select * from tmpl_home where id_tmpl_home = $x")->row();
			$data['dbase'] = $sql_bn->dbase;
			
			$this->CI->load->view('section/hero_area',$data);
		}

		function feature_area(){
			$this->CI->load->view('section/services_area');
		}

		function popular_area($x){
			
			$this->CI =& get_instance();
			$sql_bn = $this->CI->db->query("select * from tmpl_home where id_tmpl_home = $x")->row();
			$data['titel_satu'] = $sql_bn->titel_satu;
			$data['titel_dua'] = $sql_bn->titel_dua;
			$data['dbase'] = $sql_bn->dbase;
			
			$this->CI->load->view('section/popular_area',$data);
		}

		function kontak_area(){
			$this->CI->load->view('section/kontak_area');
		}

		function navtabs_area(){
			$this->CI->load->view('section/navtabs_area');
		}
		
		function pranala_area(){
			$this->CI->load->view('section/pranala_area');
		}
		
		function upcoming_area($x){

			$this->CI =& get_instance();
			$sql_bn = $this->CI->db->query("select * from tmpl_home where id_tmpl_home = $x")->row();
			$data['titel_satu'] = $sql_bn->titel_satu;
			$data['titel_dua'] = $sql_bn->titel_dua;
			$data['dbase'] = $sql_bn->dbase;

			$this->CI->load->view('section/upcoming_area', $data);
		}

		function infografis_area($x){

			$this->CI =& get_instance();
			$sql_bn = $this->CI->db->query("select * from tmpl_home where id_tmpl_home = $x")->row();
			$data['titel_satu'] = $sql_bn->titel_satu;
			$data['titel_dua'] = $sql_bn->titel_dua;
			$data['dbase'] = $sql_bn->dbase;

			$this->CI->load->view('section/infografis_area', $data);
		}

		function cta_area(){
			$this->CI->load->view('section/cta_area');
		}

		function cta_dua_area(){
			$this->CI->load->view('section/cta_dua_area');
		}

		function blog_area($x){
			$this->CI =& get_instance();
			$sql_bn = $this->CI->db->query("select * from tmpl_home where id_tmpl_home = $x")->row();
			$data['titel_satu'] = $sql_bn->titel_satu;
			$data['titel_dua'] = $sql_bn->titel_dua;
			$data['dbase'] = $sql_bn->dbase;
			$this->CI->load->view('section/blog_area',$data);
		}

}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */