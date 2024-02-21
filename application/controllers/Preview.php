<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Preview extends CI_Controller {
    function pdf_surat(){
        //ob_start();    
        $uri3 = $this->uri->segment(3);
        $id_spt = $this->uri->segment(4);
        $kd = substr($uri3,0,6);
        /*
        $nm_qr = $kd."/".$id_spt;
        $link_url = base_url('nonlogin/status_surat/');
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['imagedir']     = './asset/file_lainnya/qr_code_surat/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name=$id_spt.'.png'; //buat name dari qr code sesuai dengan nim
        $params['data'] = $link_url.$nm_qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        */
        $qw_surat = $this->db->query("select * from surat_keluar where id_surat_keluar = '$id_spt'")->row();
        $data['spt'] = $qw_surat;
        $data['no_surat'] = $qw_surat->no_surat_keluar;
        $this->load->view('sitas/preview/print_pdf',$data);    
        /*
        $html = ob_get_contents();        
        ob_end_clean();            
        require './asset/html2pdf_v5.2-master/vendor/autoload.php';        
        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');    
        $pdf->WriteHTML($html);    
        $pdf->Output();
        */
        //$pdf->Output('Tes.pdf', 'D');
    }
}