<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bptp extends CI_Controller {
	public function pimpinan(){
		$dat = $this->db->query("SELECT b.photo_profil, b.nama, u.email, b.no_kantor, b.alamat_tinggal, b.about
			FROM t_struktur_organisasi s
			LEFT JOIN t_organisasi o ON s.id_struktur_organisasi = o.id_struktur_organisasi
			LEFT JOIN t_biodata b ON b.nik = o.nik
			LEFT JOIN users u ON u.nik = b.nik
			WHERE s.parent_organisasi = 0");
	    $row = $dat->row();	
		$data['title'] = "Pimpinan Kami";
		$data['nama'] = $row->nama;
		$data['email'] = $row->email;
		$data['about'] = $row->about;
		$data['no_hp'] = $row->no_kantor;
		$data['alamat'] = $row->alamat_tinggal;
		$data['foto'] = $row->photo_profil;
		$this->template->load(template_cltr().'/template',template_cltr().'/bptp/pimpinan',$data);
	}
	
	public function agenda(){
	    $thn = date('Y');
	    //$data['data_agenda'] = $this->db->query("select * from sijuara_surat_masuk where tanggal like '%$thn%' order by id_surat_masuk desc")->result();
	    $data['data_agenda'] = $this->db->query("select * from cltr_agenda_bptp where waktu like '%$thn%' order by waktu desc")->result();
	    $data['title'] = "Agenda";
	    $this->template->load(template_cltr().'/template',template_cltr().'/bptp/agenda',$data);
	}
	
	public function visimisi(){
	    $dat = $this->db->query("SELECT * FROM t_visi_misi
			ORDER BY id_visi_misi DESC
			LIMIT 1");
	    $row = $dat->row();	
		$data['title'] = "Visi dan Misi";
		$data['visi'] = $row->visi;
		$data['misi'] = $row->misi;
		$data['tugas'] = $row->tugas;
		$data['fungsi'] = $row->fungsi;
		$this->template->load(template_cltr().'/template',template_cltr().'/bptp/visi_misi',$data);
	}
	
	public function tugas(){
	    $dat = $this->db->query("SELECT * FROM t_visi_misi where id_visi_misi = 2");
	    $row = $dat->row();	
		$data['title'] = "Tugas dan Fungsi";
		$data['tugas'] = $row->tugas;
		$data['fungsi'] = $row->fungsi;
		$this->template->load(template_cltr().'/template',template_cltr().'/bptp/tugas',$data);
	}
	
	public function cafeinovasi(){
	    $dat = $this->db->query("SELECT *
			FROM t_produk p
			JOIN t_harga_produk hp ON hp.kd_harga_produk = p.kd_harga_produk
			JOIN t_jenis_produk jp ON jp.id_jenis_produk = hp.id_jenis_produk
			JOIN m_teknologi t ON t.id_teknologi = p.id_teknologi
			ORDER BY p.id_produk ASC");
	    $data['res'] = $dat->result();	
		$data['title'] = "Cafe Inovasi";
		$this->template->load(template_cltr().'/template',template_cltr().'/bptp/cafeinovasi',$data);
	}
	
	public function info_teknologi(){
		$uris = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		if(empty($uri4)){
		    $datax = $this->db->query("select a.id_tek,a.id_teknologi,a.jenis_teknologi,a.img_jenis_teknologi,b.teknologi from t_jenis_teknologi a inner join m_teknologi b on a.id_teknologi = b.id_teknologi where a.id_teknologi='$uris'");
    		$get_title = $datax->row();
    		$data['title'] = $get_title->teknologi;
    		$data['dt'] = $datax->result();
    		$this->template->load(template_cltr().'/template',template_cltr().'/bptp/tanamanpangan',$data);    
		} else {
		    $datax = $this->db->query("select jenis_teknologi,list_img from t_jenis_teknologi where id_tek = '$uri4'");
		    $get_title = $datax->row();
		    $data['title'] = $get_title->jenis_teknologi;
		    $data['dt'] = $datax->row();
		    $data['uri3'] = $uris;
		    $data['uri4'] = $uri4;
		    $this->template->load(template_cltr().'/template',template_cltr().'/bptp/tanamanpangan_section',$data);
		}
		
	}
	
	public function detail_infotek(){
		$uri3 = $this->uri->segment(3);
		$uris = $this->uri->segment(4);
		$data["uri3"] = $uri3;
		$data["uris"] = $uris;
		if($uris=="varietas"){
		    $data["title"] = "Varietas ".ucfirst($uri3);
		} else if($uris=="budidaya"){
		    $data["title"] = "Budidaya ".ucfirst($uri3);
		} else if($uris=="hitung-pupuk"){
		    $data["title"] = "Hitung Pupuk ".ucfirst($uri3);
		} else if($uris=="analisis-usaha-tani"){
		    $data["title"] = "Analisis Usaha Tani ".ucfirst($uri3);
		}
		
		$this->template->load(template_cltr().'/template',template_cltr().'/bptp/info_teknologi_detail',$data);
	}
	
	public function buku_tamu(){
	    $data['pegawai'] = $this->model_identitas->biodata();
	    $this->template->load('halaman/template','halaman/buku_tamu',$data);
	}
	
	public function tambah_buku_tamu(){
	    if(isset($_POST['submit'])){
	        $this->model_identitas->tambah_buku_tamu();
	        //redirect('bptp/list_buku_tamu');
	    } else {
	        $data['pegawai'] = $this->model_identitas->biodata();
	        $this->template->load('halaman/template','halaman/buku_tamu',$data);
	    }
	}
	
	public function list_buku_tamu(){
	    $data['listx'] = $this->model_identitas->list_buku_tamu();
	    $this->template->load('halaman/template','halaman/list_buku_tamu',$data);
	}
	
	public function absensi(){
	    $data['pegawai'] = $this->model_identitas->biodata();
	    $this->template->load('halaman/template','halaman/absensi',$data);
	}
	
	public function lap_buku_tamu(){
	    $tahun = $_POST['tahun'];
	    $bulan = "-".$_POST['bulan'];
	    $tgl = "-".$_POST['tgl'];
	    if($bulan=="-"){
	        $waktu = $tahun;
	    } else {
	        $waktu = $tahun.$bulan.$tgl;
	    }
	    $data['timex'] = $waktu;
	    $data['dtx'] = $this->db->query("select * from cltr_buku_tamu where waktu like '%$waktu%'");
	    $this->load->view('halaman/lap_buku_tamu',$data);
	}
	
	public function form_digital(){
	    if(isset($_POST['submit'])){
	        $this->model_identitas->tambah_buku_tamu();
	        //redirect('bptp/list_buku_tamu');
	    } else {
	        $data['pegawai'] = $this->model_identitas->biodata();
	        $this->template->load('halaman/template','halaman/form_digital',$data);
	    }
	}
	
	public function penelitian(){
	    $dat = $this->db->query("SELECT *
			FROM cltr_post
			WHERE isi_berita LIKE '%penelitian%' AND id_page = 4 AND acc = 1
			ORDER BY id_post DESC");
	    $data['res'] = $dat->result();	
		$data['title'] = "Penelitian / Pengkajian";
		$this->template->load(template_cltr().'/template',template_cltr().'/bptp/penelitian',$data);
	}
	
	public function penyuluhan(){
	    $dat = $this->db->query("SELECT *
			FROM cltr_post
			WHERE isi_berita LIKE '%penyuluhan%' AND acc = 1
			ORDER BY id_post DESC");
	    $data['res'] = $dat->result();	
		$data['title'] = "Penyuluhan";
		$this->template->load(template_cltr().'/template',template_cltr().'/bptp/penyuluhan',$data);
	}
	
	public function diseminasi(){
	    $dat = $this->db->query("SELECT *
			FROM cltr_post
			WHERE isi_berita LIKE '%diseminasi%' AND acc = 1
			ORDER BY id_post DESC");
	    $data['res'] = $dat->result();	
		$data['title'] = "Diseminasi";
		$this->template->load(template_cltr().'/template',template_cltr().'/bptp/diseminasi',$data);
	}
	
	public function dtbase(){
	    $this->template->load(template_cltr().'/datapertanian/template',template_cltr().'/datapertanian/view_home');
	}
	
	function sertifikat(){
	        ob_start();    
	        
	        $uri3 = $this->uri->segment(3);
	        $uri4 = $this->uri->segment(4);
	        $uri5 = $this->uri->segment(5);
	        if(isset($uri4)){
	             $data['qw'] = $this->db->query("select nama from sertifikat where id = $uri4 and kab = '$uri3'")->row();
	            if($uri5=="pemateri"){
	                $this->load->view('cltr/bptp/sertifikat_pemateri',$data);
	            } else {
	                $this->load->view('cltr/bptp/sertifikat',$data);
	            }
	            
	        } else {
	            // di sni nnti yg jaga edit kalo statis
	            $this->load->view('cltr/bptp/sertifikat');
	        }
	        $html = ob_get_contents();        
	        ob_end_clean();            
	        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
	        $pdf = new Spipu\Html2Pdf\Html2Pdf('L','A4','en');    
	        $pdf->WriteHTML($html);    
	        $pdf->Output();
	        //$pdf->Output('Tes.pdf', 'D');
	}
	
	function sertifikat2(){
	        ob_start();    
	        $uri3 = $this->uri->segment(3);
	        $data['qw'] = $this->db->query("select nama from sertifikat where id = $uri3")->row();
	        $this->load->view('cltr/bptp/sertifikat2',$data);
	        $html = ob_get_contents();        
	        ob_end_clean();            
	        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
	        //$pdf = new Spipu\Html2Pdf\Html2Pdf('L','A4','en');
	        $pdf = new Spipu\Html2Pdf\Html2Pdf('L','F4','en');
	        $pdf->WriteHTML($html);    
	        $pdf->Output();
	        //$pdf->Output('Tes.pdf', 'D');
	}
	
	function daftar_hadir(){
	        ob_start();    
	        
	        $uri3 = $this->uri->segment(3);
	        $link_url = "http://new.gorontalo.litbang.pertanian.go.id/web/sijuara/status_daftar_hadir/";
	        $this->load->library('ciqrcode');
	        
	        $config['imagedir']     = './asset/file_lainnya/qr_code_daftar/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224,255,255); // array, default is array(255,255,255)
            $config['white']        = array(70,130,180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);
     
            $image_name=$uri3.'.png'; //buat name dari qr code sesuai dengan nim
     
            $params['data'] = $link_url.$uri3; //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
	        
	        $data['qw'] = $this->db->query("select a.*, c.nama from simantep_rapat a 
	                                        inner join simantep_rapat_peserta b on a.id_rapat=b.id_rapat
	                                        inner join t_biodata c on b.id_bio=c.id_bio where a.id_rapat = '$uri3' and b.ketua = 1")->row();
	        $data['psr'] = $this->db->query("select a.*, c.nip, c.nama, c.ttd from simantep_rapat a 
	                                        inner join simantep_rapat_peserta b on a.id_rapat=b.id_rapat
	                                        inner join t_biodata c on b.id_bio=c.id_bio where a.id_rapat = '$uri3'")->result();
	                                        
	        $this->load->view('cltr/bptp/daftar_hadir',$data);
	        $html = ob_get_contents();        
	        ob_end_clean();            
	        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
	        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');    
	        $pdf->WriteHTML($html);    
	        $pdf->Output();
	        //$pdf->Output('Tes.pdf', 'D');
	}
	
	public function link1(){
	    $this->template->load('halaman/template','halaman/link1');
	}
	
	public function link2(){
	    $this->template->load('halaman/template','halaman/link2');
	}
	
	public function tambah_peserta(){
	    if(isset($_POST['submit'])){
	        $this->model_identitas->tambah_peserta();
	        redirect('bptp/tambah_peserta');
	    } else {
	        $uri3 = $this->uri->segment(3);
	        if(!empty($uri3)){
	            $idx = $this->db->query("select * from sertifikat where id = $uri3")->row();
    	        $data['id'] = $uri3;
    	        $data['nama'] = $idx->nama;
	        } else {
	            $data['id'] = "";
    	        $data['nama'] = "";
	        }
	        $data['peserta'] = $this->db->query("select * from sertifikat where pemateri = 0")->result();
	        $this->template->load('halaman/template','halaman/tambah_peserta',$data);
	    }
	}
	
	public function delete_peserta(){
	    $uri3 = $this->uri->segment(3);
	    $this->db->query("delete from sertifikat where id = $uri3");
	    redirect('bptp/tambah_peserta');
	}
	
	public function monev(){
	    $dat = $this->db->query("SELECT * FROM sijuara_subkomp where blokir != 1");
		$data['title'] = "Monev Kegiatan BPTP Gorontalo";
		$data['res'] = $dat->result();
		$this->template->load(template_cltr().'/template',template_cltr().'/bptp/monev',$data);
	}
	
	public function detail_monev(){
	    $id = $this->uri->segment(3);
	    $qw_subkomp = $this->db->query("select * from sijuara_subkomp where id_subkomp = '$id'");
	    $rw_sb = $qw_subkomp->row();
	    $data['subkomp'] = $rw_sb;
	    $data['title'] = $rw_sb->subkomp;
	    $data['tahun'] = date('Y');
	    $data['bulan'] = array("01","02","03","04","05","06","07","08","09","10","11","12");
	    $data['id'] = $id;
	    $this->template->load(template_cltr().'/template',template_cltr().'/bptp/monev_id',$data);
	    
	}
	
	public function monev_eviden(){
	    if(isset($_POST['lap_bln'])){
	        $lap_bln = $this->input->post('lap_bln');
	        $data['tes'] = $lap_bln;
	        $this->load->view('cltr/bptp/monev_eviden',$data);
	    }
	}
	
	public function signage(){
	    $data["title"] = "Signage";
	    $this->template->load('halaman/template','cltr/bptp/signage',$data);
	}
}
