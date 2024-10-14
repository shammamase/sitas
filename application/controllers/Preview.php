<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Preview extends CI_Controller {
    function pdf_surat(){
        ob_start();    
        $uri3 = $this->uri->segment(3);
        $id_spt = $this->uri->segment(4);
        $kd = substr($uri3,0,6);
        $nm_qr = $kd."/".$id_spt;
        $link_url = base_url('nonlogin/status_surat/');
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['imagedir']     = './asset/qr_code/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name='surat_keluar_'.$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $qw_surat = $this->db->query("select * from surat_keluar where id_surat_keluar = '$id_spt'")->row();
        $cek_lampiran = $this->model_sitas->rowDataBy("id_surat_keluar","surat_keluar_lampiran","id_surat_keluar=$id_spt")->num_rows();
        $data['cek_lampiran'] = $cek_lampiran;
        $data['list_lampiran'] = $this->model_sitas->listDataBy("deskripsi,no_view_border","surat_keluar_lampiran",
                                    "id_surat_keluar=$id_spt","id_lampiran asc");
        $data['spt'] = $qw_surat;
        $data['no_surat'] = $qw_surat->no_surat_keluar;
        $data['sifat'] = $this->model_sitas->rowDataBy("sifat,kode","sifat_surat","id_sifat = $qw_surat->sifat")->row();
        $this->load->view('sitas/preview/print_pdf',$data);
        $html = ob_get_contents();        
        ob_end_clean();            
        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');    
        $pdf->WriteHTML($html);    
        $pdf->Output();
        //$pdf->Output('Tes.pdf', 'D');
    }
    function pdf_spt(){
		ob_start();    
		$uri3 = $this->uri->segment(3);
		$id_spt = $this->uri->segment(4);
		$kd = substr($uri3,0,6);
		$nm_qr = $kd."/".$id_spt;
		$link_url = base_url('nonlogin/status_surat/');
		$this->load->library('ciqrcode'); //pemanggilan library QR CODE
		$config['imagedir']     = './asset/qr_code/'; //direktori penyimpanan qr code
		$config['quality']      = true; //boolean, the default is true
		$config['size']         = '1024'; //interger, the default is 1024
		$config['black']        = array(224,255,255); // array, default is array(255,255,255)
		$config['white']        = array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
        $image_name='surat_keluar_'.$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
		$params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $qw_spt = $this->model_sitas->rowDataBy("*","spt","id_surat_keluar=$id_spt")->row();
        $qw_sk = $this->model_sitas->rowDataBy("no_surat_keluar,id_verif","surat_keluar","id_surat_keluar=$id_spt")->row();
        $data['spt'] = $qw_spt;
        $data['sk'] = $qw_sk;
        $data['peg'] = $this->model_sitas->listDataBy("a.id_pegawai,a.tanggal_spt,b.nama,b.pangkat,b.gol,b.nip,b.jabatan,b.uk,b.is_internal",
                        "anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai","a.id_spt=$qw_spt->id_spt","a.id_anggota asc");
        $data['no_surat'] = "";
		$this->load->view('sitas/preview/print',$data);    
        $html = ob_get_contents();        
		ob_end_clean();            
		require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
		$pdf = new Spipu\Html2Pdf\Html2Pdf('P','F4','en');    
		$pdf->WriteHTML($html);    
		$pdf->Output();
		//$pdf->Output('Tes.pdf', 'D');
	}
    function pdf_sptx(){
		$uri3 = $this->uri->segment(3);
		$id_spt = $this->uri->segment(4);
		$kd = substr($uri3,0,6);
		$nm_qr = $kd."/".$id_spt;
		$link_url = base_url('nonlogin/status_surat/');
		$this->load->library('ciqrcode'); //pemanggilan library QR CODE
		$config['imagedir']     = './asset/qr_code/'; //direktori penyimpanan qr code
		$config['quality']      = true; //boolean, the default is true
		$config['size']         = '1024'; //interger, the default is 1024
		$config['black']        = array(224,255,255); // array, default is array(255,255,255)
		$config['white']        = array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
        $image_name='surat_keluar_'.$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
		$params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $qw_spt = $this->model_sitas->rowDataBy("*","spt","id_surat_keluar=$id_spt")->row();
        $qw_sk = $this->model_sitas->rowDataBy("no_surat_keluar,id_verif","surat_keluar","id_surat_keluar=$id_spt")->row();
        $data['spt'] = $qw_spt;
        $data['sk'] = $qw_sk;
        $data['peg'] = $this->model_sitas->listDataBy("a.id_pegawai,a.tanggal_spt,b.nama,b.pangkat,b.gol,b.nip,b.jabatan,b.uk,b.is_internal",
                        "anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai","a.id_spt=$qw_spt->id_spt","a.id_anggota asc");
        $data['no_surat'] = "";
		$this->load->view('sitas/preview/print_web',$data);
	}
  function sppd(){
        ob_start();
        $uri3 = $this->uri->segment(3);
        $rowx = $this->model_sitas->rowDataBy("*","spt","id_spt = $uri3")->row();
        if($rowx->id_surat_keluar == NULL or $rowx->id_surat_keluar == 0){
          echo "SPPD akan muncul jika pengajuan SPT ini sudah di verifikasi sampai pada PPK";
        } else {
          $surat_keluar = $this->model_sitas->rowDataBy("no_surat_keluar,tanggal","surat_keluar","id_surat_keluar=$rowx->id_surat_keluar")->row();
          $pc_tgl_surat_keluar = explode("-",$surat_keluar->tanggal);
          $ppk = $this->model_sitas->rowDataBy("nama,nip","pegawai","id_pegawai=$rowx->id_ppk")->row();
          $list_pegawai = $this->model_sitas->listDataBy("a.*,b.nama,b.nip,b.jabatan,b.pangkat,b.gol,b.uk,b.is_internal","anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai","a.id_spt = $uri3","b.id_peserta asc");
          if($rowx->no_sppd == 0){
            echo "SPPD belum dibuat";
          } else {
          $data['id_spt'] = $uri3;
          $data['data'] = $rowx;
          $data['no_surat_keluar'] = $surat_keluar->no_surat_keluar;
          $data['bulan_surat_keluar'] = $pc_tgl_surat_keluar[1];
          $data['tahun_surat_keluar'] = $pc_tgl_surat_keluar[0];
          $data['tanggal_surat_keluar'] = $surat_keluar->tanggal;
          $data['nama_ppk'] = $ppk->nama;
          $data['nip_ppk'] = $ppk->nip;
          $data['list'] = $list_pegawai;
          $this->load->view('sitas/preview/sppd',$data);
          $html = ob_get_contents();
          ob_end_clean(); 
          require './asset/html2pdf_v5.2-master/vendor/autoload.php';
          $pdf = new Spipu\Html2Pdf\Html2Pdf('P','F4','en');
          $pdf->WriteHTML($html);
          $pdf->Output();
          }
        }
      }
      function pdf_lap_spt(){
        ob_start();
        $uri3 = $this->uri->segment(3);
        $id_spt = $this->uri->segment(4);
        $kd = substr($uri3,0,6);
        $nm_qr = $kd."/".$id_spt;
        $link_url = base_url()."nonlogin/status_lap_spt/";
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['imagedir']     = './asset/qr_code/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name='lap_spt_'.$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
            $model_lap = $this->model_sitas->rowDataBy("*","lap_spt","id_spt = $id_spt")->row();
			$model_spt = $this->model_sitas->rowDataBy("*","spt","id_spt = $id_spt")->row();
	        $user = $model_lap->user;
		    $data['spt'] = $model_spt;
		    $data['peg'] = $this->model_sitas->listDataBy("a.tanggal_spt,b.nama","anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai",
							"a.id_spt = $id_spt","a.id_anggota asc");
		    $data['no_surat'] = $this->model_sitas->rowDataBy("a.no_surat_keluar,a.id_verif",
									"surat_keluar a inner join spt b on a.id_surat_keluar=b.id_surat_keluar",
									"a.id_surat_keluar = $model_spt->id_surat_keluar")->row();
		    $data['lap_spt'] = $model_lap;
		    $data['user'] = $this->model_sitas->rowDataBy("a.nama,a.nip","pegawai a inner join user b on a.id_pegawai=b.id_pegawai",
								"b.username='$user'")->row();
	        $this->load->view('sitas/preview/print_lap',$data);    
            $html = ob_get_contents();
            ob_end_clean(); 
            require './asset/html2pdf_v5.2-master/vendor/autoload.php';
            $pdf = new Spipu\Html2Pdf\Html2Pdf('P','F4','en');
            $pdf->WriteHTML($html);
            $pdf->Output();
	}
    function html_lap_spt(){
        $uri3 = $this->uri->segment(3);
        $id_spt = $this->uri->segment(4);
        $kd = substr($uri3,0,6);
        $nm_qr = $kd."/".$id_spt;
        $link_url = base_url()."nonlogin/status_lap_spt/";
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['imagedir']     = './asset/qr_code/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name='lap_spt_'.$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
            $model_lap = $this->model_sitas->rowDataBy("*","lap_spt","id_spt = $id_spt")->row();
			$model_spt = $this->model_sitas->rowDataBy("*","spt","id_spt = $id_spt")->row();
	        $user = $model_lap->user;
		    $data['spt'] = $model_spt;
		    $data['peg'] = $this->model_sitas->listDataBy("a.tanggal_spt,b.nama","anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai",
							"a.id_spt = $id_spt","a.id_anggota asc");
		    $data['no_surat'] = $this->model_sitas->rowDataBy("a.no_surat_keluar,a.id_verif",
									"surat_keluar a inner join spt b on a.id_surat_keluar=b.id_surat_keluar",
									"a.id_surat_keluar = $model_spt->id_surat_keluar")->row();
		    $data['lap_spt'] = $model_lap;
		    $data['user'] = $this->model_sitas->rowDataBy("a.nama,a.nip","pegawai a inner join user b on a.id_pegawai=b.id_pegawai",
								"b.username='$user'")->row();
	        $this->load->view('sitas/preview/print_lap',$data);    
	}
    public function cuti(){
        ob_start();
        $pjb =  $this->model_sitas->rowDataBy("*","pejabat_verifikator","level = 'akhir'")->row();  
        $uri3 = $this->uri->segment(3);
        $link_url = base_url('nonlogin/status_cuti/');
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['imagedir']     = './asset/qr_code/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name='cuti_'.$uri3.'.png'; //buat name dari qr code sesuai dengan nim
        $params['data'] = $link_url.$uri3; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        /*
        jika cuti masuk surat keluar 
        $qw_spt = $this->db->query("select a.*,b.tanggal from trs_cuti a 
                     inner join surat_keluar b on a.id_surat_keluar=b.id_surat_keluar
                     where a.id_cuti = '$uri3'")->row();
        */
        $qw_spt = $this->db->query("select * from trs_cuti where id_cuti = $uri3")->row();
        $get_peg = $this->model_sitas->get_user_by($qw_spt->username);
          $tahun_ini = $qw_spt->tahun;
          $tahun_lalu = $tahun_ini - 1;
          $tahun_lalux = $tahun_ini - 2;
          $cuti_thn_ini = $this->model_sitas->rowDataBy("id_pegawai,jumlah","cuti_sebelum","id_pegawai=$get_peg->id_pegawai and tahun='$tahun_ini'");
          $cek_cuti_thn_ini = $cuti_thn_ini->num_rows();
          $jml_thn_ini = $this->model_sitas->rowDataBy("sum(lama_cuti) as jml","trs_cuti","username = '$qw_spt->username' and tahun = $tahun_ini")->row();
          $jml_thn_lalu = $this->model_sitas->rowDataBy("sum(lama_cuti) as jml","trs_cuti","username = '$qw_spt->username' and tahun = $tahun_lalu")->row();
          $jml_thn_lalux = $this->model_sitas->rowDataBy("sum(lama_cuti) as jml","trs_cuti","username = '$qw_spt->username' and tahun = $tahun_lalux")->row();
          $data['data'] = $qw_spt;
          if($cek_cuti_thn_ini > 0){
            $row_cuti_ini = $cuti_thn_ini->row();
            $data['n'] = $row_cuti_ini->jumlah - $jml_thn_ini->jml;
          } else {
            $data['n'] = 12 - $jml_thn_ini->jml;
          }
          
          if($jml_thn_lalu->jml==null){
            $cuti_lalu = $this->model_sitas->rowDataBy("id_pegawai,jumlah","cuti_sebelum","id_pegawai=$get_peg->id_pegawai and tahun='$tahun_lalu'");
            $cek_cuti_lalu = $cuti_lalu->num_rows();
            if($cek_cuti_lalu > 0){
              $row_cuti_lalu = $cuti_lalu->row();
              $data['n_1'] = $row_cuti_lalu->jumlah;
            } else {
              $data['n_1'] = 0;
            }
          } else {
            $data['n_1'] = $jml_thn_lalu->jml;
          }
          if($jml_thn_lalux->jml==null){
            $cuti_lalux = $this->model_sitas->rowDataBy("id_pegawai,jumlah","cuti_sebelum","id_pegawai=$get_peg->id_pegawai and tahun='$tahun_lalux'");
            $cek_cuti_lalux = $cuti_lalux->num_rows();
            if($cek_cuti_lalux > 0){
              $row_cuti_lalux = $cuti_lalux->row();
              $data['n_2'] = $row_cuti_lalux->jumlah;
            } else {
              $data['n_2'] = 0;
            }
          } else {
            $data['n_2'] = $jml_thn_lalux->jml;
          }
          $data['kabalai'] = $this->model_sitas->get_verifikator_akhir();
          $data['bio'] = $this->model_sitas->rowDataBy("*","pegawai","id_pegawai=$get_peg->id_pegawai")->row();
          $data['atasan_langsung'] = $this->model_sitas->rowDataBy("nama,nip","pegawai","id_pegawai=$qw_spt->pejabat_atasan_langsung")->row();
          $data['atasan'] = $this->model_sitas->rowDataBy("nama,nip","pegawai","id_pegawai=$pjb->id_pegawai")->row();
          $this->load->view('sitas/preview/cuti',$data);
          $html = ob_get_contents();        
          ob_end_clean();            
          require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
          $pdf = new Spipu\Html2Pdf\Html2Pdf('P','F4','en');    
          $pdf->WriteHTML($html);    
          $pdf->Output();
    }
    public function pengajuan_spt(){
      //ob_start();
      $uri3 = $this->uri->segment(3);
		  $uri4 = $this->uri->segment(4);
		  if(get_kode_uniks($uri3) == $uri4){
        $spt = $this->model_sitas->rowDataBy("a.id_surat_keluar,a.id_subdetil,a.untuk,a.lama_hari,a.id_transport,a.ket_berangkat,a.ket_wilayah,a.tanggal,a.pj,
					a.no_sppd,a.verif_pj,a.status_verif_pa,a.status_verif_ppk,a.keterangan,a.keterangan_pa,a.keterangan_ppk,b.transportasi",
					"spt a inner join transportasi_spt b on a.id_transport=b.id_transport","a.id_spt = $uri3")->row();
          $data['pegawai_spt'] = $this->model_sitas->listDataBy("b.nama,b.nip,b.jabatan,b.gol",
									"anggota_spt a inner join pegawai b on a.id_pegawai=b.id_pegawai","a.id_spt = $uri3",
									"a.id_anggota");
			  $data['spt'] = $spt;
			  $data['pos'] = $this->model_sitas->rowDataBy("a.vol,a.satuan,a.harga_satuan,b.kd_detil,c.kd_subkomp,c.subkomp,
							d.kd_komponen,e.kd_ro",
							"a_subdetil9 a inner join a_detil8 b on a.id_detil=b.id_detil 
								inner join a_subkomp7 c on b.id_subkomp=c.id_subkomp inner join a_komponen6 d on c.id_komponen = d.id_komponen
								inner join a_ro5 e on d.id_ro = e.id_ro",
							"a.id_subdetil = $spt->id_subdetil")->row();
        $data['transport'] = $this->model_sitas->listData("*","transportasi_spt","id_transport");
        if($spt->status_verif_ppk == 1){
          $this->load->view('sitas/preview/pengajuan_spt',$data);
          /*
          $html = ob_get_contents();        
          ob_end_clean();            
          require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
          $pdf = new Spipu\Html2Pdf\Html2Pdf('L','A4','en');    
          $pdf->WriteHTML($html);    
          $pdf->Output();
          */
        } else {
          echo "Belum melewati verifikasi PPK";
        }
      } else {
        echo "Sorry Yeeee";
      }
      
}
}