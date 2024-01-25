<?php 
class Model_polling extends CI_model{
    function polling(){
        return $this->db->query("SELECT * FROM poling ORDER BY id_poling DESC");
    }

    function polling_tambah(){
        $datadb = array('pilihan'=>$this->db->escape_str($this->input->post('a')),
                        'status'=>$this->db->escape_str($this->input->post('c')),
                        'rating'=>'0',
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->insert('poling',$datadb);
    }

    function polling_edit($id){
        return $this->db->query("SELECT * FROM poling where id_poling='$id'");
    }

    function polling_update(){
        $datadb = array('pilihan'=>$this->db->escape_str($this->input->post('a')),
                        'status'=>$this->db->escape_str($this->input->post('c')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->where('id_poling',$this->input->post('id'));
        $this->db->update('poling',$datadb);
    }

    function polling_delete($id){
        return $this->db->query("DELETE FROM poling where id_poling='$id'");
    }
    
    function list_kegiatan_a(){
        //$thn = date('Y');
        $thn = 2022;
        return $this->db->query("select a.*,dd.nama
                                from sijuara_subkomp a 
                                inner join sijuara_pj cc on a.id_pj = cc.id_pj
                                inner join t_biodata dd on cc.id_bio = dd.id_bio
                                inner join sijuara_komponen b on a.id_komponen = b.id_komponen
                                inner join sijuara_ro c on b.id_ro = c.id_ro
                                inner join sijuara_kro d on c.id_kro = d.id_kro
                                inner join sijuara_aktivitas e on d.id_aktivitas = e.id_aktivitas
                                inner join sijuara_program f on e.id_program = f.id_program
                                inner join sijuara_trs_alokasi g on f.id_alokasi = g.id_alokasi
                                where a.blokir != 1 and g.ta = '$thn'");
    }
    
    function list_kegiatan($x){
        return $this->db->query("select a.* from sijuara_subkomp a inner join sijuara_user b on a.id_pj = b.id_pj where a.blokir != 1 and b.username = '$x'");
    }
    
    function pj_pumk($x){
        return $this->db->query("select a.id_pj from sijuara_user a inner join sijuara_level b on a.id_user = b.id_user where b.id_stakeholder = '7' AND a.username = '$x'");
    }
    
    function list_kegiatan_pumk($x){
        //$tahun = date('Y');
        $tahun = 2022;
        return $this->db->query("select a.*,d.nama
                                from sijuara_subkomp a
                                inner join sijuara_pumk b on a.id_subkomp = b.id_subkomp
                                inner join sijuara_pj c on a.id_pj = c.id_pj
                                inner join t_biodata d on c.id_bio = d.id_bio
                                inner join sijuara_komponen e on a.id_komponen = e.id_komponen
                                inner join sijuara_ro f on e.id_ro = f.id_ro
                                inner join sijuara_kro g on f.id_kro = g.id_kro
                                inner join sijuara_aktivitas h on g.id_aktivitas = h.id_aktivitas
                                inner join sijuara_program i on h.id_program = i.id_program
                                inner join sijuara_trs_alokasi j on i.id_alokasi=j.id_alokasi
                                where b.id_pj = '$x' and j.ta = '$tahun'");
    }
    
    function detil($x){
        return $this->db->query("select * from sijuara_detil where id_subkomp = '$x'");
    }
    
    function kegiatan($x){
        return $this->db->query("select a.*, b.*, c.*, j.ta 
                                from sijuara_subkomp a 
                                inner join  sijuara_komponen b on a.id_komponen=b.id_komponen
                                inner join  sijuara_ro c on b.id_ro=c.id_ro
                                inner join sijuara_kro g on c.id_kro = g.id_kro
                                inner join sijuara_aktivitas h on g.id_aktivitas = h.id_aktivitas
                                inner join sijuara_program i on h.id_program = i.id_program
                                inner join sijuara_trs_alokasi j on i.id_alokasi=j.id_alokasi
                                where a.id_subkomp = '$x'");
    }
    
    function kegiatan_2($x){
        return $this->db->query("select a.* 
                                from sijuara_subkomp a 
                                inner join  sijuara_komponen b on a.id_komponen=b.id_komponen
                                inner join  sijuara_ro c on b.id_ro=c.id_ro
                                inner join sijuara_kro g on c.id_kro = g.id_kro
                                inner join sijuara_aktivitas h on g.id_aktivitas = h.id_aktivitas
                                inner join sijuara_program i on h.id_program = i.id_program
                                inner join sijuara_trs_alokasi j on i.id_alokasi=j.id_alokasi
                                where a.id_subkomp = '$x'");
    }
    
    function simpan_pengajuan(){
        $var_x = $_POST['inp_pass_sdt'];
        $nomor = $_POST['nomor'];
        $lampiran = $_POST['lampiran'];
        $persentase = $_POST['persentase'];
        $id_detil = $_POST['id_detil'];
        $id_subdetil = $_POST['id_subdetil'];
        $keperluan = $_POST['keperluan'];
        $pengajuan_ini = $_POST['pengajuan_ini'];
        //$tanggal = $_POST['tanggal'];
        $tanggal = date('Y-m-d');
        $tanggal_ajukan = date('Y-m-d');
        $jam = date('h:i:s');
        $username = $_POST['user'];
        $uris = $_POST['uris'];
        $kode_tr = md5($tanggal_ajukan."#".$jam."#".$var_x);
        $no_hp = $_POST['no_hp'];
        $links = $_POST['links'];
        $no_wa = substr_replace("$no_hp","62",0,1);
        $pesan = "*Layanan SIJUARA* Mohon untuk mengecek pengajuan, silahkan klik link $links";
        $data = array();
        
        $index = 0;
        foreach($pengajuan_ini as $value){
            if($value!="" and $value!="0" ){
                array_push($data, array(
                            'nomor'=>$nomor,
                            'kode_tr'=>$kode_tr,
                            'lampiran'=>$lampiran,
                            'persentase'=>$persentase,
                            'id_detil'=>$id_detil[$index],
                            'id_subdetil'=>$id_subdetil[$index],
                            'keperluan'=>$keperluan,
                            'pengajuan_ini'=>$value,
                            //'tanggal'=>$tanggal[$index],
                            'tanggal'=>$tanggal,
                            'tanggal_ajukan'=>$tanggal_ajukan,
                            'username'=>$username,
                            'deskripsi'=>$tanggal_ajukan." ".$jam." ".$var_x
                          ));
            }
            if($var_x == ""){
                echo "";
            } else {
            $this->db->query("update sijuara_rincian set status_ajukan = 1, tanggal = '$tanggal', kode_tr = '$kode_tr' where id_subdetil='$id_subdetil[$index]' and status_ajukan=0");
            
            $this->db->query("delete from sijuara_simpan_pengajuan where id_subdetil ='$id_subdetil[$index]' and ttd_pj = 'Tolak'");
            $this->db->query("delete from sijuara_simpan_pengajuan where id_subdetil ='$id_subdetil[$index]' and ttd_program = 'Tolak'");
            $this->db->query("delete from sijuara_simpan_pengajuan where id_subdetil ='$id_subdetil[$index]' and ttd_ppk = 'Tolak'");
            $this->db->query("delete from sijuara_simpan_pengajuan where id_subdetil ='$id_subdetil[$index]' and ttd_kabalai = 'Tolak'");
            
            $index++;
            }
        }
        if($var_x == ""){
            echo "<script>alert('Gagal !!, Anda belum membuat rincian')</script>";
            echo "<script>window.location.href='".base_url()."sijuara/pengajuan_full/".$uris."'</script>";
            //redirect('sijuara/pengajuan_full/'.$uris);
        } else {
            $this->db->insert_batch('sijuara_simpan_pengajuan', $data);
            //redirect('sijuara/pengajuan_full/'.$uris);
            redirect('https://api.whatsapp.com/send?phone='.$no_wa.'&text='.$pesan);
        }
        
        //$this->db->insert('poling',$datadb);
    }
    
    function simpan_rincian(){
        $pagar = "#";
        $wkt_rin = date('Y-m-d H:i:s');
        $kod_tr = $_POST['kod_tr'];
        $totalfix = $_POST['totalfix'];
        $total_semua = $_POST['total_semua'];
        $id_detil = $_POST['id_detil'];
        $id_subdetil = $_POST['id_subdetil'];
        $untuk = $_POST['untuk'];
        $nama_barang = $_POST['nama_barang'];
        $qty = $_POST['qty'];
        $vol = $_POST['vol'];
        $harga_satuan = $_POST['hps'];
        $tanggal = $_POST['tanggal'];
        $username = $_POST['user'];
        $uris = $_POST['uri3'];
        $aksi = $_POST['aksi'];
        $data = array();
        if(!empty($kod_tr)){
            $ajukan = 0;
        } else {
            $ajukan = 0;
        }
        $index = 0;
        foreach($qty as $value){
            if($value!="" and $value!="0" ){
                if($total_semua > $totalfix){
                    echo "Gagal";    
                } else {
                    array_push($data, array(
                            'id_detil'=>$id_detil,
                            'id_subdetil'=>$id_subdetil,
                            'kode_tr'=>$kod_tr,
                            'untuk'=>$untuk.$pagar.$wkt_rin,
                            'nama_barang'=>$nama_barang[$index],
                            'qty'=>$value,
                            'vol'=>$vol[$index],
                            'harga_satuan'=>$harga_satuan[$index],
                            'tanggal'=>$tanggal, 
                            'username'=>$username,
                            'status_ajukan'=>$ajukan
                          ));
                }
                
            }
            $index++;
        }
        
        if($aksi=="edit"){
            $this->db->query("delete from sijuara_rincian where id_subdetil='$id_subdetil' and status_ajukan=0");
            $this->db->insert_batch('sijuara_rincian', $data);
            redirect('sijuara/pengajuan/'.$uris);    
        } else {
            $this->db->insert_batch('sijuara_rincian', $data);
            redirect('sijuara/pengajuan/'.$uris);    
        }
        
        //$this->db->insert('poling',$datadb);
    }
    
    function gethps($postdata){
        $response = array();
        $this->db->select('*');
        if($postdata['search']){
            $this->db->where("barang like '%".$postdata['search']."%' ");
            $records = $this->db->get('sijuara_hvs')->result();
            foreach($records as $rc){
                $response[] = array(
                                    "label"=>$rc->barang,
                                    "value"=>$rc->vol,
                                    "hps"=>$rc->hps,
                                    "qty"=>1,
                                    "hpsi"=>number_format($rc->hps,0,"",".")
                                    );
            }
        }
        return $response;
    }
    
    function hpsx(){
        return $this->db->query("select * from sijuara_hvs");
    }
    
    function rincian($x){
        return $this->db->query("select a.*,b.id_subdetil,b.subdetil 
                                from sijuara_simpan_pengajuan a
                                inner join sijuara_subdetil b on a.id_subdetil = b.id_subdetil
                                inner join sijuara_detil c on b.id_detil = c.id_detil
                                inner join sijuara_subkomp d on c.id_subkomp = d.id_subkomp
                                where d.id_subkomp = '$x' order by a.id_pengajuan desc");
    }
    
    function Getsubdetil($x){
        return $this->db->query("select a.*,b.id_subdetil,b.subdetil,c.id_subkomp 
                                from sijuara_simpan_pengajuan a
                                inner join sijuara_subdetil b on a.id_subdetil = b.id_subdetil
                                inner join sijuara_detil c on b.id_detil = c.id_detil
                                where a.id_subdetil = '$x'");
    }
    
    function tanda_pj($x,$y){
        return $this->db->query("select a.ttd_pj 
                                from sijuara_simpan_pengajuan a
                                inner join sijuara_detil c on a.id_detil = c.id_detil
                                inner join sijuara_subkomp d on c.id_subkomp = d.id_subkomp
                                inner join sijuara_user e on d.id_pj = e.id_pj
                                where d.id_subkomp = '$x' and e.username = '$y'");
    }
    
    function biaya_terajukan($x){
        return $this->db->query("select sum(a.qty*a.harga_satuan) as sisa
                                from sijuara_rincian a
                                where a.id_subdetil = '$x' and a.status=0");
    }
    
    function biaya_realisasi($x){
        return $this->db->query("select sum(a.pengajuan_ini) as rlx
                                from sijuara_simpan_pengajuan a
                                where a.id_subdetil = '$x' and a.status='cair'");
    }
    
    function pengajuan_ini_detil($x){
        return $this->db->query("select a.id_detil,sum(a.qty*a.harga_satuan) as jlx_detil,status_ajukan
                                from sijuara_rincian a
                                where a.id_detil = '$x' and a.status=0");
    }
    
    function pengajuan_ini_detil2($x){
        return $this->db->query("select id_detil
                                from sijuara_rincian a
                                where a.id_detil in ($x) and a.status = 0 and a.status_ajukan=1");
    }
    
    function pengajuan_ini_detil_pdf($x,$y,$z){
        return $this->db->query("select sum(a.qty*a.harga_satuan) as jlx_detil
                                from sijuara_rincian a
                                where a.id_detil = '$x' and a.tanggal='$y' and a.kode_tr='$z'");
    }
    
    function pengajuan_ini_subdetil($x){
        return $this->db->query("select a.id_subdetil,a.tanggal,sum(a.qty*a.harga_satuan) as jlx_subdetil
                                from sijuara_rincian a
                                where a.id_subdetil = '$x' and a.status=0");
    }
    
    function pengajuan_ini_subdetil_pdf($x,$y,$z){
        return $this->db->query("select a.id_subdetil,a.tanggal,sum(a.qty*a.harga_satuan) as jlx_subdetil
                                from sijuara_rincian a
                                where a.id_subdetil = '$x' and a.tanggal='$y' and a.kode_tr='$z'");
    }
    
    function realisasi_detil($x){
        return $this->db->query("select sum(a.pengajuan_ini) as jlx_detil
                                from sijuara_simpan_pengajuan a
                                where a.id_detil = '$x' and a.status='cair'");
    }
    
    function realisasi_detil_z($x){
        return $this->db->query("select sum(a.pengajuan_ini) as jlx_detil
                                from sijuara_simpan_pengajuan a
                                where a.id_detil = '$x'");
    }
    
    function realisasi_detil_pdf_z($x,$y){
        return $this->db->query("select sum(a.pengajuan_ini) as jlx_detil
                                from sijuara_simpan_pengajuan a
                                where a.id_detil = '$x' and a.tanggal<='$y'");
    }
    
    function realisasi_detil_pdf($x,$y){
        return $this->db->query("select sum(a.pengajuan_ini) as jlx_detil
                                from sijuara_simpan_pengajuan a
                                where a.id_detil = '$x' and a.tanggal<'$y'");
    }
    
    function realisasi_subdetil($x){
        return $this->db->query("select sum(a.pengajuan_ini) as jlx_subdetil
                                from sijuara_simpan_pengajuan a
                                where a.id_subdetil = '$x' and a.status='cair'");
    }
    
    function realisasi_subdetil_pdf($x,$y){
        return $this->db->query("select sum(a.pengajuan_ini) as jlx_subdetil
                                from sijuara_simpan_pengajuan a
                                where a.id_subdetil = '$x' and a.tanggal<'$y'");
    }
    
    function get_tot_rincian($x){
        return $this->db->query("select sum(qty*harga_satuan) as tot_rn
                                from sijuara_rincian
                                where id_subdetil = '$x'");
    }
    
    function get_rincian($x){
        return $this->db->query("select a.*
                                from sijuara_rincian a
                                where a.id_subdetil = '$x' and a.status=0");
    }
    
    function get_simpan_pengajuan($x){
                           return $this->db->query("select a.*,b.detil
                                                    from sijuara_simpan_pengajuan a
                                                    inner join sijuara_detil b on a.id_detil = b.id_detil
                                                    inner join sijuara_subkomp c on b.id_subkomp = c.id_subkomp
                                                    where c.id_subkomp = '$x' and a.status = ''
                                                    order by a.id_pengajuan desc");
    }
    
    function get_simpan_pengajuan_print($x){
                           return $this->db->query("select a.*,b.detil
                                                    from sijuara_simpan_pengajuan a
                                                    inner join sijuara_detil b on a.id_detil = b.id_detil
                                                    where a.kode_tr = '$x'");
    }
    
    function get_rl($x){
        return $this->db->query("select sum(a.pengajuan_ini) as rl
                          from sijuara_simpan_pengajuan a
                          inner join sijuara_detil b on a.id_detil = b.id_detil
                          inner join sijuara_subkomp c on b.id_subkomp = c.id_subkomp
                          where c.id_subkomp = '$x' and a.status = 'cair'");
    }
    
    function get_fs($x){
        return $this->db->query("select persentase
                          from sijuara_simpan_pengajuan a
                          inner join sijuara_detil b on a.id_detil = b.id_detil
                          inner join sijuara_subkomp c on b.id_subkomp = c.id_subkomp
                          where c.id_subkomp = '$x' and a.status = 'cair' order by id_pengajuan desc");
    }
    
    function get_stakeholder($x){
        return $this->db->query("select a.nip,a.nama,a.no_hp,a.ttd
                          from t_biodata a
                          inner join sijuara_pj b on a.id_bio = b.id_bio
                          inner join sijuara_user c on b.id_pj = c.id_pj
                          inner join sijuara_level d on c.id_user = d.id_user
                          where d.id_stakeholder = '$x'");
    }
    
    function get_user_ttd($x){
        return $this->db->query("select a.nip,a.nama,a.no_hp,a.ttd
                          from t_biodata a
                          inner join sijuara_pj b on a.id_bio = b.id_bio
                          inner join sijuara_user c on b.id_pj = c.id_pj
                          inner join sijuara_level d on c.id_user = d.id_user
                          where c.username = '$x'");
    }
    
    function get_pj($x){
        return $this->db->query("select a.nip,a.nama,a.no_hp,a.ttd,c.username
                          from t_biodata a
                          inner join sijuara_pj b on a.id_bio = b.id_bio
                          inner join sijuara_user c on b.id_pj = c.id_pj
                          inner join sijuara_subkomp d on c.id_pj = d.id_pj
                          where d.id_subkomp = '$x'");
    }
    
    function get_pjx($x){
        return $this->db->query("select a.nip,a.nama,a.no_hp,a.ttd,c.username
                          from t_biodata a
                          inner join sijuara_pj b on a.id_bio = b.id_bio
                          inner join sijuara_user c on b.id_pj = c.id_pj
                          where c.username = '$x'");
    }
    
    function get_pumk($x){
        return $this->db->query("select c.nip,c.nama,c.no_hp,c.ttd
                          from sijuara_user a
                          inner join sijuara_pj b on a.id_pj = b.id_pj
                          inner join t_biodata c on b.id_bio = c.id_bio
                          where a.username = '$x'");
    }
    
    function verif_pj(){
        $ttd_pj = $_POST['username'];
        $alasan_pj = $_POST['alasan'];
        $uris = $_POST['uriss'];
        $id_subdetil = $_POST['id_subdetil'];
        $kode_tr = $_POST['kode_tr'];
        $no_hp = $_POST['no_hp'];
        $links = $_POST['links'];
        $no_wa = substr_replace("$no_hp","62",0,1);
        $pesan = "*Layanan SIJUARA* Mohon untuk mengecek pengajuan, silahkan klik link $links , Alasan = $alasan_pj";
        if($ttd_pj=="Tolak"){
              $this->db->query("update sijuara_rincian set status_ajukan = 0 where kode_tr = '$kode_tr'");  
            }
        $this->db->query("update sijuara_simpan_pengajuan set ttd_pj = '$ttd_pj', alasan_pj = '$alasan_pj' where id_subdetil IN ($id_subdetil) and kode_tr = '$kode_tr' and ttd_pj = ''");
        //redirect('sijuara/verif_pj/'.$uris);
        redirect('https://api.whatsapp.com/send?phone='.$no_wa.'&text='.$pesan);
    }
    
    function selesai(){
        $uris = $_POST['uriss'];
        $kode_tr = $_POST['kode_tr'];
        $this->db->query("update sijuara_simpan_pengajuan set status = 'cair' where kode_tr = '$kode_tr'");
        $this->db->query("update sijuara_rincian set status = 1 where kode_tr = '$kode_tr'");
        echo "<script>alert('Berhasil')</script>";
        redirect('sijuara/pengajuan_status/'.$uris);
    }
    
    function verif(){
        $ttd_pj = $_POST['username'];
        $alasan_pj = $_POST['alasan'];
        $uris = $_POST['uriss'];
        $pejabats = $_POST['pejabat'];
        $id_subdetil = $_POST['id_subdetil'];
        $kode_tr = $_POST['kode_tr'];
        $no_hp = $_POST['no_hp'];
        $links = $_POST['links'];
        $no_wa = substr_replace("$no_hp","62",0,1);
        $pesan = "*Layanan SIJUARA* Mohon untuk mengecek pengajuan, silahkan klik link $links , Alasan = $alasan_pj";
        if($pejabats==1){
            if($ttd_pj=="Tolak"){
              $this->db->query("update sijuara_rincian set status_ajukan = 0 where kode_tr = '$kode_tr'");  
            }
        $this->db->query("update sijuara_simpan_pengajuan set ttd_kabalai = '$ttd_pj', alasan_kabalai = '$alasan_pj' where id_subdetil IN ($id_subdetil) and kode_tr = '$kode_tr' and ttd_kabalai = ''");
        } else if($pejabats==2){
            if($ttd_pj=="Tolak"){
              $this->db->query("update sijuara_rincian set status_ajukan = 0 where kode_tr = '$kode_tr'");  
            }
        $this->db->query("update sijuara_simpan_pengajuan set ttd_program = '$ttd_pj', alasan_program = '$alasan_pj' where id_subdetil IN ($id_subdetil) and kode_tr = '$kode_tr' and ttd_program = ''");
        } else if($pejabats==3){
            if($ttd_pj=="Tolak"){
              $this->db->query("update sijuara_rincian set status_ajukan = 0 where kode_tr = '$kode_tr'");  
            }
        $this->db->query("update sijuara_simpan_pengajuan set ttd_ppk = '$ttd_pj', alasan_ppk = '$alasan_pj' where id_subdetil IN ($id_subdetil) and kode_tr = '$kode_tr' and ttd_ppk = ''");
        } else if($pejabats==5){
            if($ttd_pj=="Tolak"){
              $this->db->query("update sijuara_rincian set status_ajukan = 0 where kode_tr = '$kode_tr'");  
            }
        $this->db->query("update sijuara_simpan_pengajuan set verif_keuangan = '$ttd_pj', alasan_keuangan = '$alasan_pj' where id_subdetil IN ($id_subdetil) and kode_tr = '$kode_tr' and verif_keuangan = ''");
        }
        //redirect('sijuara/verif/'.$uris);
        redirect('https://api.whatsapp.com/send?phone='.$no_wa.'&text='.$pesan);
    }
    
    function list_kegiatan_ajuan_kabalai(){
        return $this->db->query("select distinct b.id_subkomp,b.subkomp from sijuara_simpan_pengajuan a inner join sijuara_detil c on a.id_detil=c.id_detil inner join sijuara_subkomp b on c.id_subkomp = b.id_subkomp where a.ttd_kabalai = '' and a.ttd_ppk != ''");
    }
    function list_kegiatan_ajuan_ppk(){
        return $this->db->query("select distinct b.id_subkomp,b.subkomp from sijuara_simpan_pengajuan a inner join sijuara_detil c on a.id_detil=c.id_detil inner join sijuara_subkomp b on c.id_subkomp = b.id_subkomp where a.ttd_ppk = '' and a.ttd_program != ''");
    }
    function list_kegiatan_ajuan_program(){
        return $this->db->query("select distinct b.id_subkomp,b.subkomp from sijuara_simpan_pengajuan a inner join sijuara_detil c on a.id_detil=c.id_detil inner join sijuara_subkomp b on c.id_subkomp = b.id_subkomp where a.ttd_program = '' and a.ttd_pj != ''");
    }
    function list_kegiatan_ajuan_keuangan(){
        return $this->db->query("select distinct b.id_subkomp,b.subkomp from sijuara_simpan_pengajuan a inner join sijuara_detil c on a.id_detil=c.id_detil inner join sijuara_subkomp b on c.id_subkomp = b.id_subkomp where a.verif_keuangan = ''");
    }
    
    function antrian_pengajuan(){
        $bulan = date('Y-m');
        return $this->db->query("select a.*,b.id_subdetil,b.subdetil,c.detil,d.subkomp
                                from sijuara_simpan_pengajuan a
                                inner join sijuara_subdetil b on a.id_subdetil = b.id_subdetil
                                inner join sijuara_detil c on b.id_detil = c.id_detil
                                inner join sijuara_subkomp d on c.id_subkomp = d.id_subkomp
                                where a.tanggal like '%$bulan%'
                                order by a.id_pengajuan asc");
    }
    
    function cek_pjb ($x){
        return $this->db->query("select a.id_stakeholder,b.username
                                from sijuara_level a
                                inner join sijuara_user b on a.id_user = b.id_user
                                inner join sijuara_pj c on b.id_pj = c.id_pj
                                inner join t_biodata d on c.id_bio = d.id_bio
                                where a.id_stakeholder = '$x'"); 
    }
    
    function get_program(){
        return $this->db->query("select d.nama,d.no_hp
                                from sijuara_level a
                                inner join sijuara_user b on a.id_user = b.id_user
                                inner join sijuara_pj c on b.id_pj = c.id_pj
                                inner join t_biodata d on c.id_bio = d.id_bio
                                where a.id_stakeholder = 2");
    }
    
    function get_pejabat($x){
        return $this->db->query("select d.nama,d.no_hp
                                from sijuara_level a
                                inner join sijuara_user b on a.id_user = b.id_user
                                inner join sijuara_pj c on b.id_pj = c.id_pj
                                inner join t_biodata d on c.id_bio = d.id_bio
                                where a.id_stakeholder = '$x'");
    }
    
    function get_username($x){
        return $this->db->query("select c.nama,c.no_hp
                                from sijuara_user a
                                inner join sijuara_pj b on b.id_pj = a.id_pj
                                inner join t_biodata c on c.id_bio = b.id_bio
                                where a.username = '$x'");
    }
    
    function get_keperluan($x,$y){
        return $this->db->query("select nama_barang,qty,vol,harga_satuan,untuk from sijuara_rincian where id_subdetil = '$x' and kode_tr = '$y'");
    }
    
    function get_pg_pj($x){
        return $this->db->query("select a.id_pengajuan,a.id_detil,a.ttd_pj
                          from sijuara_simpan_pengajuan a
                          inner join sijuara_detil b on a.id_detil = b.id_detil
                          inner join sijuara_subkomp c on b.id_subkomp = c.id_subkomp
                          where c.id_subkomp = '$x' order by id_pengajuan desc limit 1 ");
    }
    
    // super_user
    
    function pegawai(){
        return $this->db->query("select * from t_biodata");
    }
    
    function peg_id($x){
        return $this->db->query("select * from t_biodata where id_bio = '$x'");
    }
    
    function user_id($x){
        return $this->db->query("select a.*,c.nama 
                                from sijuara_user a 
                                inner join sijuara_pj b on a.id_pj=b.id_pj
                                inner join t_biodata c on b.id_bio=c.id_bio
                                where c.id_bio = '$x'");
    }
    
    function save_pegawai(){
        $config['upload_path'] = 'asset/file_lainnya/ttd_scan/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|pdf';
        $config['max_size'] = '3000';
        $this->load->library('upload', $config);
        
        if($this->upload->do_upload('gbr')){
            $hasilth = $this->upload->data();
            $thm = $hasilth['file_name'];
        } else {
            $thm = "";
        }
        
        $datadb = array('nik'=>$this->db->escape_str($this->input->post('nik')),
                        'nip'=>$this->db->escape_str($this->input->post('nip')),
                        'nama'=>$this->db->escape_str($this->input->post('nama')),
                        'jenis_kelamin'=>$this->db->escape_str($this->input->post('jenis_kelamin')),
                        'tempat_lahir'=>$this->db->escape_str($this->input->post('tempat_lahir')),
                        'tanggal_lahir'=>$this->db->escape_str($this->input->post('tanggal_lahir')),
                        'no_hp'=>$this->db->escape_str($this->input->post('no_hp')),
                        'alamat'=>$this->db->escape_str($this->input->post('alamat')),
                        'ttd'=>$thm
                        );
        $this->db->insert('t_biodata', $datadb);
    }
    
    function update_pegawai(){
        $config['upload_path'] = 'asset/file_lainnya/ttd_scan/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|pdf';
        $config['max_size'] = '3000';
        $this->load->library('upload', $config);
        
        if($this->upload->do_upload('gbr')){
            $hasilth = $this->upload->data();
            $thm = $hasilth['file_name'];
        } else {
            $thm = "";
        }
        $id_bio = $this->db->escape_str($this->input->post('id_bio'));
        $datadb = array('nik'=>$this->db->escape_str($this->input->post('nik')),
                        'nip'=>$this->db->escape_str($this->input->post('nip')),
                        'nama'=>$this->db->escape_str($this->input->post('nama')),
                        'jenis_kelamin'=>$this->db->escape_str($this->input->post('jenis_kelamin')),
                        'tempat_lahir'=>$this->db->escape_str($this->input->post('tempat_lahir')),
                        'tanggal_lahir'=>$this->db->escape_str($this->input->post('tanggal_lahir')),
                        'no_hp'=>$this->db->escape_str($this->input->post('no_hp')),
                        'alamat'=>$this->db->escape_str($this->input->post('alamat')),
                        'ttd'=>$thm
                        );
        $this->db->where('id_bio', $id_bio);
        $this->db->update('t_biodata', $datadb);
    }
    
    function save_user(){
        $datapj = array('id_bio'=>$this->db->escape_str($this->input->post('id_bio')));
        $this->db->insert('sijuara_pj', $datapj);
        $last_id_pj = $this->db->insert_id();
        $datauser = array('id_user'=>$this->db->escape_str($this->input->post('id_user')),
                        'id_pj'=>$last_id_pj,
                        'username'=>$this->db->escape_str($this->input->post('username')),
                        'password'=>$this->db->escape_str(md5($this->input->post('password')))
                        );
        $datatuser = array('kd_user'=>$this->input->post('nik'),
                            'user'=>$this->db->escape_str($this->input->post('username')),
                            'password'=>$this->db->escape_str(md5($this->input->post('password'))),
                            'status'=>1,
                            'id_level'=>1
                        );
        $this->db->insert('sijuara_user', $datauser);
        $this->db->insert('t_user', $datatuser);
    }
    
    function update_user(){
        $id_user = $this->db->escape_str($this->input->post('id_user'));
        $datauser = array('username'=>$this->db->escape_str($this->input->post('username')),
                        'password'=>$this->db->escape_str(md5($this->input->post('password')))
                        );
        $this->db->where('id_user', $id_user);
        $this->db->update('sijuara_user', $datauser);
    }
    
    function get_stak(){
        return $this->db->query("select * from sijuara_stakholder");
    }
    
    function get_level_id_user($x){
        return $this->db->query("select * from sijuara_level where id_user = '$x'");
    }
    
    function save_level(){
        $data = array();
        $id_stakholder = $this->input->post('id_stakholder');
        $id_user = $this->input->post('id_user');
        $index = 0;
        foreach($id_stakholder as $value){
                array_push($data, array(
                            'id_user'=>$id_user,
                            'id_stakeholder'=>$value
                          ));
        }
        $this->db->insert_batch('sijuara_level', $data);
    }
    
    function update_level(){
        $id_stakholder = $this->input->post('id_stakholder');
        $id_user = $this->input->post('id_user');
        $data = array();
        $index = 0;
        foreach($id_stakholder as $value){
                array_push($data, array(
                            'id_user'=>$id_user,
                            'id_stakeholder'=>$value
                          ));
        }
        $this->db->insert_batch('sijuara_level', $data);
    }
    
    function simpan_monev(){
        $limit = 10 * 1024 * 1024;
        $ekstensi =  array('png','jpg','jpeg','gif','JPG','JPEG');
        $jumlahFile = count($_FILES['eviden']['name']);
        $xxx = ""; 
        for($x=0; $x<$jumlahFile; $x++){
        	$namafile = $_FILES['eviden']['name'][$x];
        	$tmp = $_FILES['eviden']['tmp_name'][$x];
        	$tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
        	$ukuran = $_FILES['eviden']['size'][$x];	
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
        $id_subkomp = $this->input->post('id_subkomp');
        $lap_bln = $this->input->post('lap_bln');
        $capaian = $this->input->post('capaian');
        $kendala = $this->input->post('kendala');
        $solusi = $this->input->post('solusi');
        //$tindakan_bulan_lalu = $this->input->post('tindakan_bulan_lalu');
        $realisasi = $this->input->post('realisasi');
        $tgl_input = $this->input->post('tgl_input');
        $real_keu = $this->input->post('real_keu');
        $data = array(
                'id_subkomp'=>$id_subkomp,
                'lap_bln'=>$lap_bln,
                'capaian'=>$capaian,
                'kendala'=>$kendala,
                'solusi'=>$solusi,
                'tindakan_bulan_lalu'=>"",
                'realisasi'=>$realisasi,
                'tgl_input'=>$tgl_input,
                'real_keu'=>$real_keu,
                'eviden'=>$gbr
                );
        $this->db->insert('sijuara_monev',$data);
    }
    
    function edit_monev(){
        $limit = 10 * 1024 * 1024;
        $ekstensi =  array('png','jpg','jpeg','gif','JPG','JPEG');
        $jumlahFile = count($_FILES['eviden']['name']);
        $xxx = ""; 
        if($jumlahFile > 1){
        for($x=0; $x<$jumlahFile; $x++){
            $file_x = $_POST['evidens'];
            $pc_fl = explode(",",$file_x);
            foreach($pc_fl as $value){
                unlink("./asset/file_lainnya/lap_spt/$value");
            }
        	$namafile = $_FILES['eviden']['name'][$x];
        	$tmp = $_FILES['eviden']['tmp_name'][$x];
        	$tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
        	$ukuran = $_FILES['eviden']['size'][$x];	
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
            $gbr = $this->input->post('evidens');
        }
        $id_monev = $this->input->post('id_monev');
        $id_subkomp = $this->input->post('id_subkomp');
        $lap_bln = $this->input->post('lap_bln');
        $capaian = $this->input->post('capaian');
        $kendala = $this->input->post('kendala');
        $solusi = $this->input->post('solusi');
        //$tindakan_bulan_lalu = $this->input->post('tindakan_bulan_lalu');
        $realisasi = $this->input->post('realisasi');
        $tgl_input = $this->input->post('tgl_input');
        $data = array(
                'id_subkomp'=>$id_subkomp,
                'lap_bln'=>$lap_bln,
                'capaian'=>$capaian,
                'kendala'=>$kendala,
                'solusi'=>$solusi,
                'tindakan_bulan_lalu'=>"",
                'realisasi'=>$realisasi,
                'tgl_input'=>$tgl_input,
                'eviden'=>$gbr
                );
        $this->db->where('id_monev',$id_monev);
        $this->db->update('sijuara_monev',$data);
    }
}