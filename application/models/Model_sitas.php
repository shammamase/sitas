<?php 
class Model_sitas extends CI_model{
    function cek_login_sijuara($username,$password){
        return $this->db->query("SELECT * FROM user where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
    }
    function update_data($tabel,$nm_kolom,$val_kolom,$data) {
        $this->db->where($nm_kolom, $val_kolom);
        $this->db->update($tabel, $data);
        //return $this->db->affected_rows();
    }
    function saveData($tabel,$data){
        $this->db->insert($tabel, $data);
    }
    function saveDataBanyak($tabel,$data){
        $this->db->insert_batch($tabel, $data);
    }
    function saveDataWithFileBanyak($tabel,$data,$folder){
        $data['file_pdf'] = $this->upload_file_banyak($folder);
        $this->db->insert($tabel, $data);
    }
    function saveDataWithFile($tabel,$data,$folder,$folder_compres){
        $data['file_pdf'] = $this->upload_surat_masuk($folder);
        $this->db->insert($tabel, $data);
    }
    function updateDataWithFile($tabel,$kol,$val_kol,$data,$folder){
        $row = $this->rowDataBy("file_pdf",$tabel,"$kol = $val_kol")->row();
        if ($_FILES['file_pdf']['name']) {
            $path = "./".$folder."/";
            $this->hapus_pdf($path,$row->file_pdf);
            $data['file_pdf'] = $this->upload_surat_masuk($folder);
        }
        $this->db->where($kol, $val_kol);
        $this->db->update($tabel, $data);
    }
    public function deleteDataWithFile($tabel,$were,$path){
        $row = $this->rowDataBy("file_pdf",$tabel,$were)->row();
        $this->hapus_pdf($path,$row->file_pdf);
        $this->db->query("delete from $tabel where $were");
    }
    function deleteDataWithFotoKtp($tabel,$were){
        $row = $this->rowDataBy("foto_ktp",$tabel,$were)->row();
        $this->hapus_foto_ktp($row->foto_ktp);
        $this->db->query("delete from $tabel where $were");
    }
    function hapus_data($tabel,$were){
        return $this->db->query("delete from $tabel where $were");
    }
    function saveDataWithFotoBanyak($tabel,$data,$folder){
        $user = $this->get_user();
        $data['gbr_dok'] = $this->upload_foto_banyak($folder,$user->username);
        $this->db->insert($tabel, $data);
    }
    function updateDataWithFotoBanyak($tabel,$kol,$val_kol,$data,$folder){
        $user = $this->get_user();
        $row = $this->rowDataBy("gbr_dok",$tabel,"$kol = $val_kol")->row();
        $jumlahFile = $_FILES['foto']['name'];
        $path = "./".$folder;
        if (!empty($jumlahFile[0])) {
            $this->hapus_foto_banyak($path,$row->gbr_dok);
            $data['gbr_dok'] = $this->upload_foto_banyak($folder,$user->username);
        }
        $this->db->where($kol, $val_kol);
        $this->db->update($tabel, $data);
    }
    function hapus_pdf($pathx,$pdfx) {
        $path = $pathx.$pdfx;
        if (file_exists($path)) {
            unlink($path);
        }
    }
    function distinct_all($kol,$tabel){
        return $this->db->query("select distinct $kol from $tabel")->result();
    }
    function distinct_by($kol,$tabel,$were){
        return $this->db->query("select distinct $kol from $tabel $were")->result();
    }
    function listData($kolom,$tabel,$urut){
        return $this->db->query("select $kolom from $tabel order by $urut")->result();
    }
    function listDataBy($kolom,$tabel,$where,$urut){
        return $this->db->query("select $kolom from $tabel where $where order by $urut")->result();
    }
    function listDataByArr($kolom,$tabel,$where,$urut){
        return $this->db->query("select $kolom from $tabel where $where order by $urut")->result_array();
    }
    function rowDataBy($kolom,$tabel,$where){
        return $this->db->query("select $kolom from $tabel where $where");
    }
    function rowDataDesc($kolom,$tabel,$kol){
        return $this->db->query("select $kolom from $tabel order by $kol desc")->row();
    }
    function rowDataAsc($kolom,$tabel,$kol){
        return $this->db->query("select $kolom from $tabel order by $kol asc")->row();
    }
    function jmlDataAll($kolom,$tabel){
        return $this->db->query("select $kolom from $tabel")->num_rows();
    }
    function jmlDataBy($kolom,$tabel,$were){
        return $this->db->query("select $kolom from $tabel where $were")->num_rows();
    }
    function get_user(){
        $x = $this->session->username;
        return $this->db->query("select a.username,b.* from user a inner join pegawai b on a.id_pegawai=b.id_pegawai where a.username = '$x'")->row();
    }
    function get_user_by($x){
        return $this->db->query("select a.username,b.* from user a inner join pegawai b on a.id_pegawai=b.id_pegawai where a.username = '$x'")->row();
    }
    function kirim_wa($no_hp,$pesan){
        redirect('https://api.whatsapp.com/send?phone='.$no_hp.'&text='.$pesan);
    }
    
    function kirim_wa_gateway($no_target,$pesanx){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://aplikasi2.srv-cloud.my.id/api/send_express',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'token=SRqi6SGp3MZDdPfPqZrVkrtueFa9HJbXBK5GVk1U9g7oWsfu7C&number='.$no_target.'&message='.$pesanx.'&messageid=',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: ci_session=i1sn26deepc97hpgmfo3oei7noo80nhd'
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        //echo $response;
    }
    
    public function upload_foto_base64($folder_tujuan,$nama_file,$img){
        //$folderPath = "eviden_apel_pagi/";
        $folderPath = $folder_tujuan;
        //$gabungan = $id_peg."#".$hari."#".$tanggal."#".$waktu;
        $gabungan = $nama_file;
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $gabungan.'.jpg';
        
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
    }
    public function upload_fotox($folder,$fol_com) {
        // Konfigurasi untuk upload foto 
        $tmp = $_FILES['foto']['tmp_name'];
        //$config['upload_path'] = './assets/ttd_scan/';
        $config['upload_path'] = $folder;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // ukuran maksimum dalam kilobita
        $config['file_name'] = uniqid(); // nama unik untuk file foto
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto')) {
            // Jika upload gagal, tampilkan pesan error
            $error = $this->upload->display_errors();
            $this->form_validation->set_message('upload_foto', $error);
            return FALSE;
        } else {
            // Jika upload sukses, kembalikan nama file foto yang diunggah
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            $imageUploadPath = $fol_com . $file_name;
            compressImage($tmp, $imageUploadPath, 65);
            return $file_name;
        }
    }
    function upload_file($folder,$name_file) {
        // Konfigurasi untuk upload foto 
        $tmp = $_FILES[$name_file]['tmp_name'];
        //$config['upload_path'] = './assets/ttd_scan/';
        $config['upload_path'] = $folder;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 8192; // ukuran maksimum dalam kilobita
        $config['file_name'] = uniqid(); // nama unik untuk file foto
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($name_file)) {
            // Jika upload gagal, tampilkan pesan error
            $error = $this->upload->display_errors();
            $this->form_validation->set_message('upload_foto', $error);
            return FALSE;
        } else {
            // Jika upload sukses, kembalikan nama file foto yang diunggah
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            return $file_name;
        }
    }
    function upload_surat_masuk($folder) {
        $config['upload_path'] = $folder;
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size'] = 4096; // ukuran maksimum dalam kilobita
        $config['file_name'] = uniqid(); // nama unik untuk file foto
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_pdf')) {
            // Jika upload gagal, tampilkan pesan error
            $error = $this->upload->display_errors();
            $this->form_validation->set_message('upload_pdf', $error);
            return FALSE;
        } else {
            // Jika upload sukses, kembalikan nama file foto yang diunggah
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            return $file_name;
        }
    }
    function upload_foto_banyak($folderx,$userx){
        $limit = 10 * 1024 * 1024;
        $ekstensi =  array('png','jpg','jpeg','gif');
        $jumlahFile = count($_FILES['foto']['name']);
        //$uploadPath = "asset/silayak/lap_spt/";
        $uploadPath = $folderx;
        $tgld = date('d-m-Y')."-";
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
        		    $exif = exif_read_data($tmp);
                    $orientation = isset($exif['Orientation']) ? $exif['Orientation'] : null;
                    if ($orientation && in_array($orientation, [3, 6, 8])) {
                        if($tipe_file!="png"){
                            $image = imagecreatefromjpeg($tmp);
                        } else {
                            $image = imagecreatefrompng($tmp);
                        }
                        if ($orientation == 3) {
                          $image = imagerotate($image, 180, 0);
                        } elseif ($orientation == 6) {
                          $image = imagerotate($image, -90, 0);
                        } elseif ($orientation == 8) {
                          $image = imagerotate($image, 90, 0);
                        }
                        if($tipe_file!="png"){
                            imagejpeg($image, $tmp);
                        } else {
                            imagepng($image, $tmp);
                        }
                    }
        		    $enc_nm = md5($namafile);
        		    $enc_n = substr($enc_nm,0,8);
        		    //$imageUploadPath = $uploadPath . $tgld.$enc_n.".".$tipe_file;
        		    $imageUploadPath = $uploadPath . $tgld.$enc_n."-".$userx."-perjadin.".$tipe_file;
        			//move_uploaded_file($tmp, 'asset/silayak/lap_spt/'.date('d-m-Y').'-'.$enc_n.".".$tipe_file);
        			compressImage($tmp, $imageUploadPath, 80);
        			//$xxx .= date('d-m-Y').'-'.$enc_n.".".$tipe_file.",";
        			$xxx .= date('d-m-Y')."-".$enc_n."-".$userx."-perjadin.".$tipe_file.",";
        		}
        	}
        }
        return $gbr = substr($xxx,0,-1);
    }
    function hapus_foto_banyak($folder,$foto) {
        $fotox = explode(",",$foto);
        foreach($fotox as $ft){
            unlink($folder.$ft);
        }
    }
    function upload_file_banyak($folderx){
        $limit = 10 * 1024 * 1024;
        $ekstensi =  array('png','jpg','jpeg','pdf');
        $jumlahFile = count($_FILES['file_pdf']['name']);
        $uploadPath = $folderx;
        $xxx = ""; 
        for($x=0; $x<$jumlahFile; $x++){
        	$namafile = $_FILES['file_pdf']['name'][$x];
        	$tmp = $_FILES['file_pdf']['tmp_name'][$x];
        	$tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
        	$ukuran = $_FILES['file_pdf']['size'][$x];	
        	if($ukuran > $limit){
        		echo "Ukuran File Terlalu Besar";
        	}else{
        		if(!in_array($tipe_file, $ekstensi)){
        			echo "Ekstensi tidak diperbolehkan";
        		}else{
                    $imageUploadPath = $uploadPath . uniqid().".".$tipe_file;
        			$xxx .= uniqid().".".$tipe_file.",";
        		}
        	}
        }
        return $gbr = substr($xxx,0,-1);
    }
    function hapus_foto($folder,$foto) {
        //$path = './assets/foto_ktp/' . $foto;
        $path = $folder . $foto;
        if (file_exists($path)) {
            unlink($path);
        }
    }
    function cek_no_surat(){
        $uri3 = $this->session->tahun;
        $query = $this->db->query("select max(no_surat_keluar * 1) as nos from surat_keluar where tanggal like '%$uri3%'");
        $cek = $query->row();
        if($cek->nos != NULL){
            $hasil = $query->row();
            $nomornya = $hasil->nos;
        } else {
            $nomornya = 0;
        }
        return $nomornya;
    }
    function save_all_wa($dt,$tb,$idx){
        $arrs = array();
        $arrx = "";
        foreach($dt as $in){
            $pc_in = explode("#",$in);
            $dty = $pc_in[0];
            if($pc_in[1] == 0){
                $varx = $this->input->post($dty);
                if(is_array($varx)){
                    foreach($varx as $vrx){
                        if($vrx!=""){
                            $arrx .= $vrx."!@#";    
                        }
                    }
                    $sub_arx = substr($arrx,0,-3);
                    $arrs[$dty] = $sub_arx;
                } else {
                   $arrs[$dty] = strip_tags($varx);
                }
                
            } else {
                $varx = $this->input->post($dty);
                if(is_array($varx)){
                    foreach($varx as $vrx){
                        if($vrx!=""){
                            $arrx .= $vrx."!@#";    
                        }
                    }
                    $sub_arx = substr($arrx,0,-3);
                    $arrs[$dty] = $sub_arx;
                } else {
                   $arrs[$dty] = $varx;
                }
            }
        }
        $datadb = $arrs;
        if(empty($arrs[$idx])){
            $this->db->insert($tb,$datadb);
        } else {
            $this->db->where($idx,$arrs[$idx]);
            $this->db->update($tb,$datadb);
        }
    }
    function get_verifikator_awal(){
        $get_peg = $this->rowDataBy("b.*,c.username",
                        "pejabat_verifikator a inner join pegawai b on a.id_pegawai=b.id_pegawai
                        inner join user c on b.id_pegawai=c.id_pegawai",
                        "a.level = 'awal'")->row();
        return $get_peg;
    }
    function get_verifikator_akhir(){
        $get_peg = $this->rowDataBy("b.*,c.username,d.struktur,d.for_ttd",
                        "pejabat_verifikator a inner join pegawai b on a.id_pegawai=b.id_pegawai
                        inner join user c on b.id_pegawai=c.id_pegawai inner join struktur_organisasi d
                        on c.id_pegawai=d.id_pegawai",
                        "a.level = 'akhir'")->row();
        return $get_peg;
    }
    function get_sub_arsip($x){
        $qw = $this->rowDataBy("a.kode_sub_arsip,a.sub_arsip,b.arsip","klasifikasi_sub_arsip a inner join klasifikasi_arsip b on a.id_arsip=b.id_arsip",
                                "id_sub_arsip = $x")->row();
        return $qw;
    }
    function get_peg_by_user($x){
        return $this->db->query("select b.* from user a inner join pegawai b on a.id_pegawai=b.id_pegawai where a.username = '$x'")->row();
    }
    function cek_anggota_spt($tgl,$lama){
        $tglm = no_anggota_spt($tgl,$lama);
        $id_peg = "";
		$get_pgx = $this->listDataBy("id_pegawai","anggota_spt","tanggal_spt like '%$tglm%'","id_pegawai asc");
        foreach($get_pgx as $gpg){
            $id_peg .= $gpg->id_pegawai.",";
        }
        $id_pegw = substr($id_peg,0,-1);
        if($id_pegw == ""){
            $qw_inti = $this->listData("id_pegawai,nama","pegawai","id_pegawai asc");
        } else {
            $qw_inti = $this->listDataBy("id_pegawai,nama","pegawai","id_pegawai not in ($id_pegw)","id_pegawai asc");
        }
        return $qw_inti;
    }
    function get_anggota_spt_by_id_spt($id_spt)
    {
        // Mengambil data anggota_spt berdasarkan id_spt
        $this->db->where('id_spt', $id_spt);
        return $this->db->get('anggota_spt')->result();
    }
    function delete_spt($table, $key, $id)
    {
        // Menghapus data pada tabel berdasarkan kunci utama ($key) dan id
        $this->db->where($key, $id);
        $this->db->delete($table);
    }
    function get_existing_anggota_spt($id_spt, $id_pegawai){
        // Mengambil data anggota_spt berdasarkan id_spt dan id_pegawai
        $this->db->where('id_spt', $id_spt);
        $this->db->where('id_pegawai', $id_pegawai);
        return $this->db->get('anggota_spt')->row();
    }
}