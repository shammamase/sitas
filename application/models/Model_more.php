<?php 
class Model_more extends CI_model{
    
    function list_more(){
        $userr = $this->session->username;
        return $this->db->query("SELECT * FROM cltr_more ORDER BY id_more DESC");
    }

    function list_more_tambah(){ 
        $datadb = array('utama'=>$this->input->post('aa'),
                        'url'=>$this->db->escape_str($this->input->post('a')),
                        'nama_website'=>$this->db->escape_str($this->input->post('b')));    
        $this->db->insert('cltr_more',$datadb);
    }

    function list_more_edit($id){
        return $this->db->query("SELECT * FROM cltr_more where id_more='$id'");
    }

    function list_more_update(){
        $datadb = array('utama'=>$this->input->post('aa'),
                        'url'=>$this->db->escape_str($this->input->post('a')),
                        'nama_website'=>$this->db->escape_str($this->input->post('b')));    
        $this->db->where('id_more',$this->input->post('id'));
        $this->db->update('cltr_more',$datadb);
    }

    function list_more_delete($id){
        return $this->db->query("DELETE FROM cltr_more where id_more='$id'");
    }
    
    function produk(){
        return $this->db->query("select * from t_produk");
    }
    
    function pelanggan(){
        return $this->db->query("select * from t_biodata");
    }
    
    function list_pemesanan(){
        return $this->db->query("SELECT a.id_pemesanan,a.jumlah,a.total_harga,a.tgl_pesanan,a.status,b.id_produk,b.nama_produk,c.harga_produk,c.stok,d.nik,d.nama,d.no_hp,d.alamat
            FROM cltr_pemesanan a
            INNER JOIN t_produk b ON b.id_produk=a.id_produk
            INNER JOIN t_harga_produk c ON c.id_produk=b.id_produk
            INNER JOIN t_biodata d ON d.nik=a.kd_user
            ORDER BY a.id_pemesanan DESC");
    }

    function list_pemesanan_tambah(){
        $tglx = date("Y-m-d H:i:s");
        $datadb = array('id_produk'=>$this->input->post('aa'),
                        'jumlah'=>$this->input->post('a'),
                        'tgl_pesanan'=>$tglx,
                        'kd_user'=>$this->db->escape_str($this->input->post('b')));    
        $this->db->insert('cltr_pemesanan',$datadb);
    }

    function list_pemesanan_edit($id){
        return $this->db->query("SELECT a.id_pemesanan,a.jumlah,a.total_harga,a.tgl_pesanan,a.status,b.id_produk,b.nama_produk,c.harga_produk,c.stok,d.nik,d.nama,d.no_hp,d.alamat
            FROM cltr_pemesanan a
            INNER JOIN t_produk b ON b.id_produk=a.id_produk
            INNER JOIN t_harga_produk c ON c.id_produk=b.id_produk
            INNER JOIN t_biodata d ON d.nik=a.kd_user
            WHERE a.id_pemesanan = '$id'");
    }

    function list_pemesanan_update(){
        $datadb = array('id_produk'=>$this->input->post('aa'),
                        'jumlah'=>$this->input->post('a'),
                        'kd_user'=>$this->db->escape_str($this->input->post('b')));    
        $this->db->where('id_pemesanan',$this->input->post('id'));
        $this->db->update('cltr_pemesanan',$datadb);
    }

    function list_pemesanan_delete($id){
        return $this->db->query("DELETE FROM cltr_pemesanan where id_pemesanan='$id'");
    }
    
    function konfirmasi($id){
        return $this->db->query("UPDATE cltr_pemesanan SET status = 1 WHERE id_pemesanan = '$id'");
    }
    
    function upd_stok($id_pr,$stok_baru){
        return $this->db->query("UPDATE t_harga_produk SET stok = ".$stok_baru." WHERE id_produk=".$id_pr."");
    }
    
    // buat spt->list kegiatan
    function list_kegiatan(){
        $tahun = date('Y');
        return $this->db->query("select a.*,e.komponen
                                from sijuara_subkomp a
                                inner join sijuara_komponen e on a.id_komponen = e.id_komponen
                                inner join sijuara_ro f on e.id_ro = f.id_ro
                                inner join sijuara_kro g on f.id_kro = g.id_kro
                                inner join sijuara_aktivitas h on g.id_aktivitas = h.id_aktivitas
                                inner join sijuara_program i on h.id_program = i.id_program
                                inner join sijuara_trs_alokasi j on i.id_alokasi=j.id_alokasi
                                where j.ta = '$tahun'");
    }
    function save_spt(){
        $peg = $this->input->post('peg');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $datadb = array('id_arsip'=>$this->db->escape_str($this->input->post('id_arsip')),
                        'menimbang'=>$this->input->post('menimbang'),
                        'dasar'=>$this->input->post('dasar'),
                        'untuk'=>$this->input->post('untuk'),
                        'lama_hari'=>$this->db->escape_str($this->input->post('lama_hari')),
                        'is_dipa'=>$this->db->escape_str($this->input->post('is_dipa')),
                        'tanggal'=>$this->db->escape_str($this->input->post('tanggal')),
                        'user'=>$this->session->username,
                        'tanggal_input'=>$this->input->post('tanggal_input')
                        );
        $this->db->insert('sijuara_spt',$datadb);
        $last_id = $this->db->insert_id();
        
        //insert pelaku spt
        $data = array();
        $index = 0;
        foreach($peg as $value){
            array_push($data, array(
                'id_spt'=>$last_id,
                'id_peg'=>$value,
                'tanggal'=>$tanggal_akhir,
                'user'=>$this->session->username,
                'tanggal_input'=>date('Y-m-d H:i:s')
                ));
        }
        $this->db->insert_batch('sijuara_pelaku_spt',$data);
    }
    
    function update_spt(){
        $peg = $this->input->post('peg');
        $id_spts = $this->input->post('id_spts');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $verif = $this->input->post('verif');
        $untuk = $this->input->post('untuk');
        $datadb = array('id_arsip'=>$this->db->escape_str($this->input->post('id_arsip')),
                        'menimbang'=>$this->input->post('menimbang'),
                        'dasar'=>$this->input->post('dasar'),
                        'untuk'=>$this->input->post('untuk'),
                        'lama_hari'=>$this->db->escape_str($this->input->post('lama_hari')),
                        'is_dipa'=>$this->db->escape_str($this->input->post('is_dipa')),
                        'tanggal'=>$this->db->escape_str($this->input->post('tanggal')),
                        'user'=>$this->session->username,
                        'tanggal_input'=>$this->input->post('tanggal_input')
                        );
        $this->db->where('id_spt',$id_spts);
        $this->db->update('sijuara_spt',$datadb);
        
        //delete pelaku spt lama
        $this->db->query("delete from sijuara_pelaku_spt where id_spt='$id_spts'");
        
        //insert pelaku spt
        $data = array();
        $index = 0;
        $val_peg = "";
        foreach($peg as $value){
            $val_peg .= $value.",";
            array_push($data, array(
                'id_spt'=>$id_spts,
                'id_peg'=>$value,
                'tanggal'=>$tanggal_akhir,
                'user'=>$this->session->username,
                'tanggal_input'=>date('Y-m-d H:i:s')
                ));
        }
        
        $vl = substr($val_peg,0,-1);
        $this->db->insert_batch('sijuara_pelaku_spt',$data);
        if($verif==1){
            //logika tgl s.d tgl
            $pc_tgl_plk = explode(",",$tanggal_akhir);
            $jml_tgl = count($pc_tgl_plk);
            if($jml_tgl>1){
                $pc1 = explode("-",$pc_tgl_plk[0]);
                $pc2 = explode("-",end($pc_tgl_plk));
                if($pc1[1]==$pc2[1]){
                    $val_tgl = $pc1[2]." s.d ".tgl_indoo(end($pc_tgl_plk));
                } else {
                    $pc11 = explode(" ",tgl_indoo($pc_tgl_plk[0]));
                    $val_tgl = $pc11[0]." ".$pc11[1]." s.d ".tgl_indoo(end($pc_tgl_plk));
                }
            } else {
                $val_tgl = tgl_indoo($pc_tgl_plk[0]);
            }
            // end logika tgl s.d tgl
            $untukz = $untuk." pada Tanggal ".$val_tgl;
            $this->model_more->edit_surat_keluar_by_spt($vl,$untukz,$id_spts);
        }
    }
    
    function edit_surat_keluar_by_spt($x,$z,$y){
        $tujuan = $this->db->query("select nama from ms_peg where id_peg in ($x)")->result();
        $tuju = "";
        foreach($tujuan as $tuj){
            $tuju .= $tuj->nama.",";
        }
        $tujx = substr($tuju,0,-1);
        return $this->db->query("update sijuara_surat_keluar set tujuan_surat = '$tujx', perihal = '$z' where id_spt = $y");
    }
    
    
    function daftar_lap_spt2(){
        //$thn = date('Y');
        $thn = $this->uri->segment(3);
        return $this->db->query("select * from sijuara_lap_spt where tanggal_input like '%$thn%' order by id_lap_spt desc");
    }
    function get_surat_buat($x){
        return $this->db->query("select * from sijuara_surat_keluar where id_buat_surat = '$x'")->row();
    }
    
    function get_no_surat_spt($x){
        return $this->db->query("select * from sijuara_surat_keluar where id_spt = '$x'");
    }
    
    function get_no_surat_buat($x){
        return $this->db->query("select * from sijuara_surat_keluar where id_buat_surat = '$x'");
    }
    function get_id_sub_arsip($x){
        return $this->db->query("select a.kode_sub_arsip,a.sub_arsip,b.arsip 
                                from klasifikasi_sub_arsip a
                                inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip
                                where a.id_sub_arsip = '$x'");
    }
    function save_surat_keluar(){
        $no_surat = $this->db->escape_str($this->input->post('no_surat_keluar'));
        $tanggal = $this->input->post('tanggal');
        $pc_tgl = explode("-",$tanggal);
        $arsip = $this->input->post('arsip');
        $no_lengkap = $no_surat."/".$arsip."/H.10.29/".$pc_tgl[1]."/".$pc_tgl[0];
        $datadb = array('no_surat_keluar'=>$no_surat,
                        'tujuan_surat'=>$this->db->escape_str($this->input->post('tujuan_surat')),
                        'tanggal'=>$tanggal,
                        'perihal'=>$this->db->escape_str($this->input->post('perihal')),
                        'user'=>$this->session->username,
                        'tanggal_input'=>date('Y-m-d H:i:s'),
                        'no_lengkap'=>$no_lengkap,
                        'verif_kabalai'=>1
                        );
        $this->db->insert('sijuara_surat_keluar',$datadb);
    }
    
    function update_surat_keluar(){
        $id_surat_keluar = $this->input->post('id_surat_keluar');
        $no_surat = $this->db->escape_str($this->input->post('no_surat_keluar'));
        $tanggal = $this->input->post('tanggal');
        $pc_tgl = explode("-",$tanggal);
        $arsip = $this->input->post('arsip');
        $no_lengkap = $no_surat."/".$arsip."/H.10.29/".$pc_tgl[1]."/".$pc_tgl[0];
        $datadb = array('no_surat_keluar'=>$no_surat,
                        'tujuan_surat'=>$this->db->escape_str($this->input->post('tujuan_surat')),
                        'tanggal'=>$tanggal,
                        'perihal'=>$this->db->escape_str($this->input->post('perihal')),
                        'user'=>$this->session->username,
                        'no_lengkap'=>$no_lengkap,
                        'verif_kabalai'=>1
                        );
        $this->db->where('id_surat_keluar',$id_surat_keluar);
        $this->db->update('sijuara_surat_keluar',$datadb);
    }
    
    function save_surat_masuk(){
        $config['upload_path'] = 'asset/file_lainnya/surat_masuk/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|pdf';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        
        if($this->upload->do_upload('filex')){
            $hasilth=$this->upload->data();
            $thm = $hasilth['file_name'];
        } else {
            $thm = "";
        }
            
        $no_surat = $this->db->escape_str($this->input->post('no_surat_masuk'));
        $tanggal = $this->input->post('tanggal');
        $tanggal_masuk = $this->input->post('tanggal_masuk');
        $datadb = array('no_surat_masuk'=>$no_surat,
                        'asal_surat'=>$this->db->escape_str($this->input->post('asal_surat')),
                        'tanggal_masuk'=>$tanggal_masuk,
                        'tanggal'=>$tanggal,
                        'perihal'=>$this->db->escape_str($this->input->post('perihal')),
                        'user'=>$this->session->username,
                        'tanggal_input'=>date('Y-m-d H:i:s'),
                        'file_pdf'=>$thm
                        );
        $this->db->insert('sijuara_surat_masuk',$datadb);
    }
    
    function update_surat_masuk(){
        $fl_pdf = $this->input->post('file_pdf');
        $config['upload_path'] = 'asset/file_lainnya/surat_masuk/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|pdf';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        
        if($this->upload->do_upload('filex')){
            unlink("./asset/file_lainnya/surat_masuk/$fl_pdf");
            $hasilth=$this->upload->data();
            $thm = $hasilth['file_name'];
        } else {
            $thm = $fl_pdf;
        }
        $id_surat_masuk = $this->input->post('id_surat_masuk');
        $no_surat = $this->db->escape_str($this->input->post('no_surat_masuk'));
        $tanggal = $this->input->post('tanggal');
        $tanggal_masuk = $this->input->post('tanggal_masuk');
        $datadb = array('no_surat_masuk'=>$no_surat,
                        'asal_surat'=>$this->db->escape_str($this->input->post('asal_surat')),
                        'tanggal_masuk'=>$tanggal_masuk,
                        'tanggal'=>$tanggal,
                        'perihal'=>$this->db->escape_str($this->input->post('perihal')),
                        'user'=>$this->session->username,
                        'file_pdf'=>$thm
                        );
        $this->db->where('id_surat_masuk',$id_surat_masuk);
        $this->db->update('sijuara_surat_masuk',$datadb);
    }
    
    function save_surat(){
        $datadb = array('id_arsip'=>$this->db->escape_str($this->input->post('arsip')),
                        'lampiran'=>$this->input->post('lampiran'),
                        'hal'=>$this->input->post('hal'),
                        'kepada'=>$this->input->post('kepada'),
                        'lokasi_kepada'=>$this->input->post('lokasi_kepada'),
                        'isi_surat'=>$this->input->post('isi_surat'),
                        'tanggal'=>$this->db->escape_str($this->input->post('tanggal')),
                        'user'=>$this->session->username,
                        'tanggal_input'=>date('Y-m-d H:i:s'),
                        'tembusan'=>$this->db->escape_str($this->input->post('tembusan'))
                        );
        $this->db->insert('sijuara_buat_surat',$datadb);
    }
    
    function update_surat(){
        $id_spts = $this->input->post('id_buat_surat');
        $datadb = array('id_arsip'=>$this->db->escape_str($this->input->post('arsip')),
                        'lampiran'=>$this->input->post('lampiran'),
                        'hal'=>$this->input->post('hal'),
                        'kepada'=>$this->input->post('kepada'),
                        'lokasi_kepada'=>$this->input->post('lokasi_kepada'),
                        'isi_surat'=>$this->input->post('isi_surat'),
                        'tanggal'=>$this->db->escape_str($this->input->post('tanggal')),
                        'user'=>$this->session->username,
                        'tembusan'=>$this->db->escape_str($this->input->post('tembusan'))
                        );
        $this->db->where('id_buat_surat',$id_spts);
        $this->db->update('sijuara_buat_surat',$datadb);
    }
    
    function surat_id($x){
        return $this->db->query("select a.*,b.*,c.arsip
                                from sijuara_buat_surat a
                                inner join klasifikasi_sub_arsip b on a.id_arsip=b.id_sub_arsip 
                                inner join klasifikasi_arsip c on b.id_arsip=c.id_arsip
                                where a.id_buat_surat = '$x'");
    }
    
    function daftar_surat(){
        //$thn = date('Y');
        $thn = $this->uri->segment(3);
        return $this->db->query("select * from sijuara_buat_surat where tanggal like '%$thn%' order by id_buat_surat desc");
    }
    
    function daftar_surat_kabalai(){
        $thn = date('Y');
        return $this->db->query("select * from sijuara_buat_surat where verif_kabalai = 0 order by id_buat_surat asc");
    }
    
    function get_user_level($x){
        return $this->db->query("select a.id_stakeholder 
                                    from sijuara_level a 
                                    inner join sijuara_user b on a.id_user=b.id_user 
                                    where b.username = '$x'");
    }
    
    function get_yg_membuat($x){
        return $this->db->query("select c.nip,c.nama,c.ttd 
                    from sijuara_user a inner join sijuara_pj b on a.id_pj=b.id_pj 
                    inner join t_biodata c on b.id_bio=c.id_bio 
                    where a.username='$x'");
    }
    
    function lap_spt_id_spt($x){
        return $this->db->query("select * from sijuara_lap_spt where id_spt = '$x'");
    }
    
    function spt_no_id($x){
        return $this->db->query("select a.*,b.no_lengkap 
                                    from sijuara_spt a 
                                    inner join sijuara_surat_keluar b on a.id_spt=b.id_spt 
                                    where a.id_spt = '$x'");
    }

    function save_lap_spt(){
        
        $limit = 10 * 1024 * 1024;
        $ekstensi =  array('png','jpg','jpeg','gif','JPG','JPEG');
        $jumlahFile = count($_FILES['foto']['name']);
        $xxx = ""; 
        for($x=0; $x<$jumlahFile; $x++){
        	$namafile = $_FILES['foto']['name'][$x];
        	$tmp = $_FILES['foto']['tmp_name'][$x];
        	$tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
        	$ukuran = $_FILES['foto']['size'][$x];	
        	if($ukuran > $limit){
        		echo "Ukuran File Terlalu Besar";
        	}else{
        		if(!in_array($tipe_file, $ekstensi)){
        			echo "Ekstensi tidak diperbolehkan";
        		}else{		
        			move_uploaded_file($tmp, 'asset/file_lainnya/lap_spt/'.date('d-m-Y').'-'.$namafile);
        			$xxx .= date('d-m-Y').'-'.$namafile.",";
        		}
        	}
        }
        $gbr = substr($xxx,0,-1);
        $tolak_ukur_kegiatan = $this->db->escape_str($this->input->post('tolak_ukur_kegiatan'));
        $transportasi = $this->db->escape_str($this->input->post('transportasi'));
        $tanggal = $this->input->post('tanggal');
        $tanggal_masuk = $this->input->post('tanggal_masuk');
        $datadb = array('tolak_ukur_kegiatan'=>$tolak_ukur_kegiatan,
                        'transportasi'=>$transportasi,
                        'lokasi'=>$this->db->escape_str($this->input->post('lokasi')),
                        'uraian'=>$this->input->post('uraian'),
                        'id_spt'=>$this->db->escape_str($this->input->post('id_spt')),
                        'user'=>$this->session->username,
                        'tanggal_input'=>date('Y-m-d H:i:s'),
                        'gbr_dok'=>$gbr
                        );
        $this->db->insert('sijuara_lap_spt',$datadb);
    }
    
    function update_lap_spt(){
        
        $limit = 10 * 1024 * 1024;
        $ekstensi =  array('png','jpg','jpeg','gif','JPG','JPEG');
        $jumlahFile = count($_FILES['foto']['name']);
        $xxx = ""; 
        if($jumlahFile > 1){
        for($x=0; $x<$jumlahFile; $x++){
            $file_x = $_POST['file_pdf'];
            $pc_fl = explode(",",$file_x);
            foreach($pc_fl as $value){
                unlink("./asset/file_lainnya/lap_spt/$value");   
            }
        	$namafile = $_FILES['foto']['name'][$x];
        	$tmp = $_FILES['foto']['tmp_name'][$x];
        	$tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
        	$ukuran = $_FILES['foto']['size'][$x];	
        	if($ukuran > $limit){
        		echo "Ukuran File Terlalu Besar";
        	}else{
        		if(!in_array($tipe_file, $ekstensi)){
        			echo "Ekstensi tidak diperbolehkan";
        		}else{		
        			move_uploaded_file($tmp, 'asset/file_lainnya/lap_spt/'.date('d-m-Y').'-'.$namafile);
        			$xxx .= date('d-m-Y').'-'.$namafile.",";
        		}
        	}
        }
            $gbr = substr($xxx,0,-1);
        } else {
            $gbr = $this->input->post('file_pdf');
        }
        $tolak_ukur_kegiatan = $this->db->escape_str($this->input->post('tolak_ukur_kegiatan'));
        $transportasi = $this->db->escape_str($this->input->post('transportasi'));
        $tanggal = $this->input->post('tanggal');
        $tanggal_masuk = $this->input->post('tanggal_masuk');
        $datadb = array('tolak_ukur_kegiatan'=>$tolak_ukur_kegiatan,
                        'transportasi'=>$transportasi,
                        'lokasi'=>$this->db->escape_str($this->input->post('lokasi')),
                        'uraian'=>$this->input->post('uraian'),
                        'id_spt'=>$this->db->escape_str($this->input->post('id_spt')),
                        'user'=>$this->session->username,
                        'tanggal_input'=>date('Y-m-d H:i:s'),
                        'gbr_dok'=>$gbr
                        );
        $this->db->where('id_spt',$this->input->post('id_spt'));                
        $this->db->update('sijuara_lap_spt',$datadb);
    }
    
    function daftar_lap_spt_kabalai(){
        $thn = date('Y');
        return $this->db->query("select a.lokasi,a.keterangan as ket,b.*
                                from sijuara_lap_spt a 
                                inner join sijuara_spt b on a.id_spt=b.id_spt 
                                where a.verif_kabalai = 0 
                                order by a.id_lap_spt asc");
    }
    
}