<?php 
class Model_identitas extends CI_model{
    function identitas(){
        return $this->db->query("SELECT * FROM cltr_identitas ORDER BY id_identitas DESC LIMIT 1");
    }

    function identitas_update(){
            $config['upload_path'] = 'asset/';
            $config['allowed_types'] = 'ico';
            $config['max_size'] = '20'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('i');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $datadb = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                    'alamat_website'=>$this->db->escape_str($this->input->post('c')),
                                    'meta_deskripsi'=>$this->db->escape_str($this->input->post('g')),
                                    'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                                    'redaksi'=>$this->db->escape_str($this->input->post('j')),
                                    'marketing'=>$this->db->escape_str($this->input->post('k')),
                                    'alamat'=>$this->db->escape_str($this->input->post('l')),
                                    'no_hp'=>$this->db->escape_str($this->input->post('q')),
                                    'facebook'=>$this->db->escape_str($this->input->post('m')),
                                    'twitter'=>$this->db->escape_str($this->input->post('n')),
                                    'youtube'=>$this->db->escape_str($this->input->post('o')),
                                    'instagram'=>$this->db->escape_str($this->input->post('p')));
            }else{
                    $datadb = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                    'alamat_website'=>$this->db->escape_str($this->input->post('c')),
                                    'meta_deskripsi'=>$this->db->escape_str($this->input->post('g')),
                                    'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                                    'redaksi'=>$this->db->escape_str($this->input->post('j')),
                                    'marketing'=>$this->db->escape_str($this->input->post('k')),
                                    'alamat'=>$this->db->escape_str($this->input->post('l')),
                                    'no_hp'=>$this->db->escape_str($this->input->post('q')),
                                    'facebook'=>$this->db->escape_str($this->input->post('m')),
                                    'twitter'=>$this->db->escape_str($this->input->post('n')),
                                    'youtube'=>$this->db->escape_str($this->input->post('o')),
                                    'instagram'=>$this->db->escape_str($this->input->post('p')),
                                    'favicon'=>$hasil['file_name']);
            }
            $this->db->where('id_identitas',1);
            $this->db->update('cltr_identitas',$datadb);
    }
    
    function biodata(){
        return $this->db->query("select a.*, b.id_level from t_biodata a inner join t_user b on a.nik = b.kd_user where b.id_level = 1 order by a.id_bio desc");
    }
    
    function tambah_buku_tamu(){
        $pc_nik = explode("-",$this->input->post('nik'));
        $no_wa = substr_replace("$pc_nik[1]","62",0,1);
        $pesan = "Assalamualaikum, Dari Recepsionist BPTP Gorontalo ada yang ingin bertemu atas nama ".$this->input->post('nama')." asal instansi ".$this->input->post('asal_instansi')." dengan maksud tujuan ".$this->input->post('maksud_tujuan')." No HP tamu anda ".$this->input->post('no_hp')." Terima Kasih";
        $datadb = array('nama'=>$this->db->escape_str($this->input->post('nama')),
                        'no_hp'=>$this->db->escape_str($this->input->post('no_hp')),
                        'asal_instansi'=>$this->db->escape_str($this->input->post('asal_instansi')),
                        'maksud_tujuan'=>$this->db->escape_str($this->input->post('maksud_tujuan')),
                        'pesan_kesan'=>$this->db->escape_str($this->input->post('pesan_kesan')),
                        'nik'=>$pc_nik[0],
                        'no_hp2'=>$pc_nik[1],
                        'waktu'=>$this->input->post('waktu')
                        );
        $this->db->insert('cltr_buku_tamu',$datadb);
        redirect('https://api.whatsapp.com/send?phone='.$no_wa.'&text='.$pesan);
    }
    
    function list_buku_tamu(){
        $wkt = date('Y-m');
        return $this->db->query("select a.*, b.nama as nama_peg from cltr_buku_tamu a inner join t_biodata b on a.nik=b.nik where waktu like '%$wkt%' order by a.id_tamu desc");
    }
    
    function tambah_peserta(){
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $datadb = array('nama'=>$this->db->escape_str($nama));
        if($id==""){
            $this->db->insert('sertifikat',$datadb);
        } else {
            $this->db->where('id',$id);
            $this->db->update('sertifikat',$datadb);
        }
        
    }
}