<?php 
class Model_rkakl extends CI_model{
    function get_rev(){
        $file_dir = $this->get_folder();
        $files = scandir($file_dir['folder1'], SCANDIR_SORT_DESCENDING);
        // Ambil file terbaru
        $newestFile = reset($files);
        $pc_file = explode(".",$newestFile);
        $rev = $pc_file[0];
        return $rev;
    }
    
    function get_folder(){
        $arr = array();
        $folder_file_adk = "asset/file_lainnya/file_adk";
        $folder_file_unzip = "asset/file_lainnya/hasil_unzip";
        $dir1 = opendir($folder_file_adk);
        $dir2 = opendir($folder_file_unzip);
        
        if ($dir1) {
            $fileCount = 0;
            // Membaca setiap item dalam folder
            while (false !== ($file = readdir($dir1))) {
                // Mengabaikan entri "." dan ".."
                if ($file != "." && $file != "..") {
                    $fileCount++;
                }
            }
            closedir($dir1);
            //echo "Jumlah file di dalam folder $folder_file_adk adalah $fileCount";
            //echo "<br>";
        }
        if ($dir2) {
            $fileCount2 = 0;
            // Membaca setiap item dalam folder
            while (false !== ($file2 = readdir($dir2))) {
                // Mengabaikan entri "." dan ".."
                if ($file2 != "." && $file2 != "..") {
                    $fileCount2++;
                }
            }
            closedir($dir2);
            //echo "Jumlah file di dalam folder $folder_file_unzip adalah $fileCount2";
        }
        $arr = array('file1'=>$fileCount,'file2'=>$fileCount2,'folder1'=>$folder_file_adk,'folder2'=>$folder_file_unzip);
        return $arr;
    }
    
    function save_trs_alokasi($total_trs_alokasi,$thn_agri){
        $qw_ta = $this->db->query("select ta from a_trs_alokasi1 where ta = '$thn_agri'");
        $cek_ta = $qw_ta->num_rows();
        $thn_agr = array('alokasi'=>$total_trs_alokasi,'ta'=>$thn_agri);
        if($cek_ta > 0){
            $this->db->where('ta',$thn_agri);
            $this->db->update('a_trs_alokasi1',$thn_agr);
        } else {
            $this->db->insert('a_trs_alokasi1',$thn_agr);
        }
    }
    
    function save_program($totals_program,$thn_agri){
        $ind_qw = 0;
        $data = array();
        $data_qw = array();
        $queri = $this->db->query("select id_alokasi from a_trs_alokasi1 where ta = '$thn_agri'")->row();
        $qwri = $this->db->query("select id_program,kd_program from a_program2 where id_alokasi = '$queri->id_alokasi'");
        $cek = $qwri->num_rows();
        if($cek > 0){
            foreach($qwri->result() as $qwr){
                array_push($data_qw,array('id_program'=>$qwr->id_program,'kd_program'=>$qwr->kd_program));
            }
            foreach($totals_program as $tpr){
                $id_program = $data_qw[$ind_qw]['id_program'];
                $kd_program = $tpr['kd_program'];
                $program = $tpr['lbl_program'];
                $jml_biaya = $tpr['jml_program'];
                //if(in_array($tpr['kd_program'], )){
                if($data_qw[$ind_qw]['kd_program'] == $kd_program){
                    $this->db->query("update a_program2 set kd_program = '$kd_program', program = '$program', jumlah_biaya = '$jml_biaya' where id_program = $id_program");   
                } else {
                    $this->db->query("insert into a_program2 (id_alokasi,kd_program,program,jumlah_biaya) values ('$queri->id_alokasi','$kd_program','$lbl_program','$jml_program')");
                }
                $ind_qw++;
            }
        } else {
            foreach($totals_program as $tpr){
                array_push($data,array('id_alokasi'=>$queri->id_alokasi,'kd_program'=>$tpr['kd_program'],'program'=>$tpr['lbl_program'],'jumlah_biaya'=>$tpr['jml_program']));
            }
            $this->db->insert_batch('a_program2',$data);
        }
        echo "jml program yg lama : ".count($data_qw)." jml program yg baru : ".count($totals_program)."<br>";
    }
    function save_aktivitas($aktivitas,$thn){
        $data = array();
        $data_qw = array();
        $ind_qw = 0;
        $qwri = $this->db->query("select a.id_aktivitas,a.kd_aktivitas from a_aktivitas3 a 
                                    inner join a_program2 b on a.id_program=b.id_program
                                    inner join a_trs_alokasi1 c on b.id_alokasi=c.id_alokasi
                                    where c.ta = '$thn'");
        $cek = $qwri->num_rows();
        if($cek > 0){
            foreach($qwri->result() as $qwr){
                array_push($data_qw,array('id_aktivitas'=>$qwr->id_aktivitas,'kd_aktivitas'=>$qwr->kd_aktivitas));
            }
            foreach($aktivitas as $aktv){
                $id_aktivitas = $data_qw[$ind_qw]['id_aktivitas'];
                if($data_qw[$ind_qw]['kd_aktivitas'] == $aktv['kd_aktivitas']){
                    $this->db->query("update a_aktivitas3 set kd_aktivitas = '$aktv[kd_aktivitas]', aktivitas = '$aktv[aktivitas]' where id_aktivitas = $id_aktivitas");   
                } else {
                    $id_prog = $this->db->query("select a.id_program from a_program2 a inner join a_trs_alokasi1 b on a.id_alokasi=b.id_alokasi where a.kd_program = '$aktv[kd_program]' and b.ta = '$thn'")->row();
                    $this->db->query("insert into a_aktivitas3 (id_program,kd_aktivitas,aktivitas) values ('$id_prog->id_program','$aktv[kd_aktivitas]','$aktv[aktivitas]')");
                }
                $ind_qw++;
            }
        } else {
            foreach($aktivitas as $akt){
            $id_prog = $this->db->query("select a.id_program from a_program2 a inner join a_trs_alokasi1 b on a.id_alokasi=b.id_alokasi where a.kd_program = '$akt[kd_program]' and b.ta = '$thn'")->row();
            array_push($data,array('id_program'=>$id_prog->id_program,'kd_aktivitas'=>$akt['kd_aktivitas'],'aktivitas'=>$akt['aktivitas']));
            }
            $this->db->insert_batch('a_aktivitas3',$data);
        }
        echo "jml aktivitas yg lama : ".count($data_qw)." jml aktivitas yg baru : ".count($aktivitas)."<br>";
    }
    function save_kro($kro,$thn){
        $data = array();
        $data_qw = array();
        $ind_qw = 0;
        $qwri = $this->db->query("select a.id_kro,a.kd_kro from a_kro4 a 
                                    inner join a_aktivitas3 b on a.id_aktivitas=b.id_aktivitas
                                    inner join a_program2 c on b.id_program=c.id_program
                                    inner join a_trs_alokasi1 d on c.id_alokasi=d.id_alokasi
                                    where d.ta = '$thn'");
        $cek = $qwri->num_rows();
        if($cek > 0){
            foreach($qwri->result() as $qwr){
                array_push($data_qw,array('id_kro'=>$qwr->id_kro,'kd_kro'=>$qwr->kd_kro));
            }
            foreach($kro as $krov){
                $id_kro = $data_qw[$ind_qw]['id_kro'];
                if($data_qw[$ind_qw]['kd_kro'] == $krov['kd_kro']){
                    $this->db->query("update a_kro4 set kd_kro = '$krov[kd_kro]', kro = '$krov[lbl]', vol = '$krov[vol]' where id_kro = $id_kro");   
                } else {
                    $id_aktivitas = $this->db->query("select a.id_aktivitas from a_aktivitas3 a 
                                                        inner join a_program2 bb on a.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_aktivitas = '$krov[kd_aktivitas]' and b.ta = '$thn'")->row();
                    $this->db->query("insert into a_kro4 (id_aktivitas,kd_kro,kro,vol) values ('$id_aktivitas->id_aktivitas','$krov[kd_kro]','$krov[lbl]','$krov[vol]')");
                }
                $ind_qw++;
            }
        } else {
            foreach($kro as $krx){
            $id_aktivitas = $this->db->query("select a.id_aktivitas from a_aktivitas3 a 
                                                        inner join a_program2 bb on a.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_aktivitas = '$krx[kd_aktivitas]' and b.ta = '$thn'")->row();
            array_push($data,array('id_aktivitas'=>$id_aktivitas->id_aktivitas,'kd_kro'=>$krx['kd_kro'],'kro'=>$krx['lbl'],'vol'=>$krx['vol']));
            }
            $this->db->insert_batch('a_kro4',$data);
        }
        echo "jml kro yg lama : ".count($data_qw)." jml kro yg baru : ".count($kro)."<br>";
    }
    function save_ro($list,$thn){
        $data = array();
        $data_qw = array();
        $ind_qw = 0;
        $qwri = $this->db->query("select a.id_ro,a.kd_ro from a_ro5 a 
                                    inner join a_kro4 bb on a.id_kro=bb.id_kro
                                    inner join a_aktivitas3 b on bb.id_aktivitas=b.id_aktivitas
                                    inner join a_program2 c on b.id_program=c.id_program
                                    inner join a_trs_alokasi1 d on c.id_alokasi=d.id_alokasi
                                    where d.ta = '$thn'");
        $cek = $qwri->num_rows();
        if($cek > 0){
            foreach($qwri->result() as $qwr){
                array_push($data_qw,array('id_ro'=>$qwr->id_ro,'kd_ro'=>$qwr->kd_ro));
            }
            foreach($list as $rov){
                $id_ro = $data_qw[$ind_qw]['id_ro'];
                if($data_qw[$ind_qw]['kd_ro'] == $rov['kd_ro']){
                    $this->db->query("update a_ro5 set kd_ro = '$rov[kd_ro]', ro = '$rov[ro]', vol = '$rov[vol]' where id_ro = $id_ro");   
                } else {
                    $id_kro = $this->db->query("select a.id_kro from a_kro4 a 
                                                        inner join a_aktivitas3 bbb on a.id_aktivitas=bbb.id_aktivitas
                                                        inner join a_program2 bb on bbb.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_kro = '$rov[kd_kro]' and b.ta = '$thn'")->row();
                    $this->db->query("insert into a_ro5 (id_kro,kd_ro,ro,vol) values ('$id_kro->id_kro','$rov[kd_ro]','$rov[ro]','$rov[vol]')");
                }
                $ind_qw++;
            }
        } else {
            foreach($list as $rox){
            $id_kro = $this->db->query("select a.id_kro from a_kro4 a 
                                                        inner join a_aktivitas3 bbb on a.id_aktivitas=bbb.id_aktivitas
                                                        inner join a_program2 bb on bbb.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_kro = '$rox[kd_kro]' and b.ta = '$thn'")->row();
            array_push($data,array('id_kro'=>$id_kro->id_kro,'kd_ro'=>$rox['kd_ro'],'ro'=>$rox['ro'],'vol'=>$rox['vol']));
            }
            $this->db->insert_batch('a_ro5',$data);
        }
        echo "jml ro yg lama : ".count($data_qw)." jml ro yg baru : ".count($list)."<br>";
    }
    function save_komponen($list,$thn){
        $data = array();
        $data_qw = array();
        $ind_qw = 0;
        $qwri = $this->db->query("select a.id_komponen,a.kd_komponen from a_komponen6 a 
                                    inner join a_ro5 bbb on a.id_ro=bbb.id_ro
                                    inner join a_kro4 bb on bbb.id_kro=bb.id_kro
                                    inner join a_aktivitas3 b on bb.id_aktivitas=b.id_aktivitas
                                    inner join a_program2 c on b.id_program=c.id_program
                                    inner join a_trs_alokasi1 d on c.id_alokasi=d.id_alokasi
                                    where d.ta = '$thn'");
        $cek = $qwri->num_rows();
        if($cek > 0){
            foreach($qwri->result() as $qwr){
                array_push($data_qw,array('id_komponen'=>$qwr->id_komponen,'kd_komponen'=>$qwr->kd_komponen));
            }
            foreach($list as $kom){
                $id_komponen = $data_qw[$ind_qw]['id_komponen'];
                if($data_qw[$ind_qw]['kd_komponen'] == $kom['kd_komponen']){
                    $this->db->query("update a_komponen6 set kd_komponen = '$kom[kd_komponen]', komponen = '$kom[komponen]' where id_komponen = $id_komponen");   
                } else {
                    $id_ro = $this->db->query("select a.id_ro from a_ro5 a 
                                                        inner join a_kro4 bbbb on a.id_kro=bbbb.id_kro
                                                        inner join a_aktivitas3 bbb on bbbb.id_aktivitas=bbb.id_aktivitas
                                                        inner join a_program2 bb on bbb.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_ro = '$kom[kd_ro]' and b.ta = '$thn'")->row();
                    $this->db->query("insert into a_komponen6 (id_ro,kd_komponen,komponen) values ('$id_ro->id_ro','$kom[kd_komponen]','$kom[komponen]')");
                }
                $ind_qw++;
            }
        } else {
            foreach($list as $komp){
            $id_ro = $this->db->query("select a.id_ro from a_ro5 a 
                                                        inner join a_kro4 bbbb on a.id_kro=bbbb.id_kro
                                                        inner join a_aktivitas3 bbb on bbbb.id_aktivitas=bbb.id_aktivitas
                                                        inner join a_program2 bb on bbb.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_ro = '$komp[kd_ro]' and b.ta = '$thn'")->row();
            array_push($data,array('id_ro'=>$id_ro->id_ro,'kd_komponen'=>$komp['kd_komponen'],'komponen'=>$komp['komponen']));
            }
            $this->db->insert_batch('a_komponen6',$data);
        }
        echo "jml komponen yg lama : ".count($data_qw)." jml komponen yg baru : ".count($list)."<br>";
    }
    function save_subkomp($list,$thn){
        $data = array();
        $data_qw = array();
        $ind_qw = 0;
        $qwri = $this->db->query("select a.id_subkomp,a.kd_subkomp,bbbb.kd_komponen,bbb.kd_ro from a_subkomp7 a 
                                    inner join a_komponen6 bbbb on a.id_komponen=bbbb.id_komponen
                                    inner join a_ro5 bbb on bbbb.id_ro=bbb.id_ro
                                    inner join a_kro4 bb on bbb.id_kro=bb.id_kro
                                    inner join a_aktivitas3 b on bb.id_aktivitas=b.id_aktivitas
                                    inner join a_program2 c on b.id_program=c.id_program
                                    inner join a_trs_alokasi1 d on c.id_alokasi=d.id_alokasi
                                    where d.ta = '$thn' order by a.id_subkomp asc");
        $cek = $qwri->num_rows();
        if($cek > 0){
            foreach($qwri->result() as $qwr){
                $kodex = $qwr->kd_ro.".".$qwr->kd_komponen.".".$qwr->kd_subkomp;
                array_push($data_qw,array('id_subkomp'=>$qwr->id_subkomp,'kodex'=>$kodex,'kd_subkomp'=>$qwr->kd_subkomp));
            }
            foreach($list as $kom){
                $id_subkomp = $data_qw[$ind_qw]['id_subkomp'];
                if($data_qw[$ind_qw]['kodex'] == $kom['kodex']){
                    $this->db->query("update a_subkomp7 set kd_subkomp = '$kom[kd_subkomp]', subkomp = '$kom[subkomp]' where id_subkomp = $id_subkomp");
                } else {
                    $id_komponen = $this->db->query("select a.id_komponen from a_komponen6 a 
                                                        inner join a_ro5 bbbbb on a.id_ro=bbbbb.id_ro
                                                        inner join a_kro4 bbbb on bbbbb.id_kro=bbbb.id_kro
                                                        inner join a_aktivitas3 bbb on bbbb.id_aktivitas=bbb.id_aktivitas
                                                        inner join a_program2 bb on bbb.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_komponen = '$kom[kd_komponen]' and bbbbb.kd_ro = '$kom[kd_ro]' and b.ta = '$thn'")->row();
                    $this->db->query("insert into a_subkomp7 (id_komponen,kd_subkomp,subkomp) values ('$id_komponen->id_komponen','$kom[kd_subkomp]','$kom[subkomp]')");
                }
                $ind_qw++;
            }
        } else {
            foreach($list as $komp){
            $id_komponen = $this->db->query("select a.id_komponen from a_komponen6 a 
                                                        inner join a_ro5 bbbbb on a.id_ro=bbbbb.id_ro
                                                        inner join a_kro4 bbbb on bbbbb.id_kro=bbbb.id_kro
                                                        inner join a_aktivitas3 bbb on bbbb.id_aktivitas=bbb.id_aktivitas
                                                        inner join a_program2 bb on bbb.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_komponen = '$komp[kd_komponen]' and bbbbb.kd_ro = '$komp[kd_ro]' and b.ta = '$thn'")->row();
            array_push($data,array('id_komponen'=>$id_komponen->id_komponen,'kd_subkomp'=>$komp['kd_subkomp'],'subkomp'=>$komp['subkomp']));
            }
            $this->db->insert_batch('a_subkomp7',$data);
        }
        echo "jml subkomp yg lama : ".count($data_qw)." jml subkomp yg baru : ".count($list)."<br>";
    }
    function save_detil($list,$thn){
        $data = array();
        $data_qw = array();
        $ind_qw = 0;
        $qwri = $this->db->query("select a.id_detil,a.kd_detil,bbbbb.id_subkomp,bbbbb.kd_subkomp,bbbb.kd_komponen,bbb.kd_ro from a_detil8 a 
                                    inner join a_subkomp7 bbbbb on a.id_subkomp=bbbbb.id_subkomp
                                    inner join a_komponen6 bbbb on bbbbb.id_komponen=bbbb.id_komponen
                                    inner join a_ro5 bbb on bbbb.id_ro=bbb.id_ro
                                    inner join a_kro4 bb on bbb.id_kro=bb.id_kro
                                    inner join a_aktivitas3 b on bb.id_aktivitas=b.id_aktivitas
                                    inner join a_program2 c on b.id_program=c.id_program
                                    inner join a_trs_alokasi1 d on c.id_alokasi=d.id_alokasi
                                    where d.ta = '$thn' order by a.id_detil asc");
        $cek = $qwri->num_rows();
        if($cek > 0){
            foreach($qwri->result() as $qwr){
                $kodex = $qwr->kd_ro.".".$qwr->kd_komponen.".".$qwr->kd_subkomp.".".$qwr->kd_detil;
                array_push($data_qw,array('id_detil'=>$qwr->id_detil,'kodex'=>$kodex,'kd_detil'=>$qwr->kd_detil));
            }
            foreach($list as $kom){
                $id_detil = $data_qw[$ind_qw]['id_detil'];
                if($data_qw[$ind_qw]['kodex'] == $kom['kodex']){
                    $this->db->query("update a_detil8 set kd_detil = '$kom[kd_detil]', detil = '$kom[detil]', jumlah_biaya = '$kom[jumlah_biaya]' where id_detil = $id_detil");
                } else {
                    $id_subkomp = $this->db->query("select a.id_subkomp from a_subkomp7 a 
                                                        inner join a_komponen6 bbbbbb on a.id_komponen=bbbbbb.id_komponen
                                                        inner join a_ro5 bbbbb on bbbbbb.id_ro=bbbbb.id_ro
                                                        inner join a_kro4 bbbb on bbbbb.id_kro=bbbb.id_kro
                                                        inner join a_aktivitas3 bbb on bbbb.id_aktivitas=bbb.id_aktivitas
                                                        inner join a_program2 bb on bbb.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_subkomp = '$kom[kd_subkomp]' and bbbbbb.kd_komponen = '$kom[kd_komponen]' and bbbbb.kd_ro = '$kom[kd_ro]' and b.ta = '$thn'")->row();
                    $this->db->query("insert into a_detil8 (id_subkomp,kd_detil,detil,jumlah_biaya) values ('$id_subkomp->id_subkomp','$kom[kd_detil]','$kom[detil]','$kom[jumlah_biaya]')");
                }
                $ind_qw++;
            }
        } else {
            foreach($list as $komp){
            $id_subkomp = $this->db->query("select a.id_subkomp from a_subkomp7 a 
                                                        inner join a_komponen6 bbbbbb on a.id_komponen=bbbbbb.id_komponen
                                                        inner join a_ro5 bbbbb on bbbbbb.id_ro=bbbbb.id_ro
                                                        inner join a_kro4 bbbb on bbbbb.id_kro=bbbb.id_kro
                                                        inner join a_aktivitas3 bbb on bbbb.id_aktivitas=bbb.id_aktivitas
                                                        inner join a_program2 bb on bbb.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_subkomp = '$komp[kd_subkomp]' and bbbbbb.kd_komponen = '$komp[kd_komponen]' and bbbbb.kd_ro = '$komp[kd_ro]' and b.ta = '$thn'")->row();
            array_push($data,array('id_subkomp'=>$id_subkomp->id_subkomp,'kd_detil'=>$komp['kd_detil'],'detil'=>$komp['detil'],'jumlah_biaya'=>$komp['jumlah_biaya']));
            }
            $this->db->insert_batch('a_detil8',$data);
        }
        echo "jml detil yg lama : ".count($data_qw)." jml detil yg baru : ".count($list)."<br>";
    }
    function save_subdetil($list,$thn){
        $data = array();
        $data_qw = array();
        $ind_qw = 0;
        $qwri = $this->db->query("select a.id_subdetil,bbbbbb.id_detil,bbbbbb.kd_detil,bbbbb.id_subkomp,bbbbb.kd_subkomp,bbbb.kd_komponen,bbb.kd_ro from a_subdetil9 a 
                                    inner join a_detil8 bbbbbb on a.id_detil=bbbbbb.id_detil
                                    inner join a_subkomp7 bbbbb on bbbbbb.id_subkomp=bbbbb.id_subkomp
                                    inner join a_komponen6 bbbb on bbbbb.id_komponen=bbbb.id_komponen
                                    inner join a_ro5 bbb on bbbb.id_ro=bbb.id_ro
                                    inner join a_kro4 bb on bbb.id_kro=bb.id_kro
                                    inner join a_aktivitas3 b on bb.id_aktivitas=b.id_aktivitas
                                    inner join a_program2 c on b.id_program=c.id_program
                                    inner join a_trs_alokasi1 d on c.id_alokasi=d.id_alokasi
                                    where d.ta = '$thn' order by a.id_subdetil asc");
        $cek = $qwri->num_rows();
        if($cek > 0){
            foreach($qwri->result() as $qwr){
                $kodex = $qwr->kd_ro.".".$qwr->kd_komponen.".".$qwr->kd_subkomp.".".$qwr->kd_detil;
                array_push($data_qw,array('id_subdetil'=>$qwr->id_subdetil,'kodex'=>$kodex,'id_detil'=>$qwr->id_detil));
            }
            foreach($list as $kom){
                $id_subdetil = $data_qw[$ind_qw]['id_subdetil'];
                if($data_qw[$ind_qw]['kodex'] == $kom['kodex']){
                    $this->db->query("update a_subdetil9 set subdetil = '$kom[subdetil]', vol = '$kom[vol]', satuan = '$kom[satuan]', harga_satuan = '$kom[harga_satuan]' where id_subdetil = $id_subdetil");
                } else {
                    $id_detil = $this->db->query("select a.id_detil from a_detil8 a 
                                                        inner join a_subkomp7 bbbbbbb on a.id_subkomp=bbbbbbb.id_subkomp
                                                        inner join a_komponen6 bbbbbb on bbbbbbb.id_komponen=bbbbbb.id_komponen
                                                        inner join a_ro5 bbbbb on bbbbbb.id_ro=bbbbb.id_ro
                                                        inner join a_kro4 bbbb on bbbbb.id_kro=bbbb.id_kro
                                                        inner join a_aktivitas3 bbb on bbbb.id_aktivitas=bbb.id_aktivitas
                                                        inner join a_program2 bb on bbb.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_detil = '$kom[kd_detil]' and bbbbbbb.kd_subkomp = '$kom[kd_subkomp]' and bbbbbb.kd_komponen = '$kom[kd_komponen]' and bbbbb.kd_ro = '$kom[kd_ro]' and b.ta = '$thn'")->row();
                    $this->db->query("insert into a_subdetil9 (id_detil,subdetil,vol,satuan,harga_satuan) values ('$id_detil->id_detil','$kom[subdetil]','$kom[vol]','$kom[satuan]','$kom[harga_satuan]')");
                }
                $ind_qw++;
            }
        } else {
            foreach($list as $komp){
            $id_detil = $this->db->query("select a.id_detil from a_detil8 a 
                                                        inner join a_subkomp7 bbbbbbb on a.id_subkomp=bbbbbbb.id_subkomp
                                                        inner join a_komponen6 bbbbbb on bbbbbbb.id_komponen=bbbbbb.id_komponen
                                                        inner join a_ro5 bbbbb on bbbbbb.id_ro=bbbbb.id_ro
                                                        inner join a_kro4 bbbb on bbbbb.id_kro=bbbb.id_kro
                                                        inner join a_aktivitas3 bbb on bbbb.id_aktivitas=bbb.id_aktivitas
                                                        inner join a_program2 bb on bbb.id_program=bb.id_program
                                                        inner join a_trs_alokasi1 b on bb.id_alokasi=b.id_alokasi 
                                                        where a.kd_detil = '$komp[kd_detil]' and bbbbbbb.kd_subkomp = '$komp[kd_subkomp]' and bbbbbb.kd_komponen = '$komp[kd_komponen]' and bbbbb.kd_ro = '$komp[kd_ro]' and b.ta = '$thn'")->row();
            array_push($data,array('id_detil'=>$id_detil->id_detil,'subdetil'=>$komp['subdetil'],'vol'=>$komp['vol'],'satuan'=>$komp['satuan'],'harga_satuan'=>$komp['harga_satuan']));
            }
            $this->db->insert_batch('a_subdetil9',$data);
        }
        echo "jml subdetil yg lama : ".count($data_qw)." jml subdetil yg baru : ".count($list)."<br>";
    }
    function isi_biaya_subkomp($thn){
        $qwri = $this->db->query("select a.id_subkomp from a_subkomp7 a 
                                    inner join a_komponen6 bbbb on a.id_komponen=bbbb.id_komponen
                                    inner join a_ro5 bbb on bbbb.id_ro=bbb.id_ro
                                    inner join a_kro4 bb on bbb.id_kro=bb.id_kro
                                    inner join a_aktivitas3 b on bb.id_aktivitas=b.id_aktivitas
                                    inner join a_program2 c on b.id_program=c.id_program
                                    inner join a_trs_alokasi1 d on c.id_alokasi=d.id_alokasi
                                    where d.ta = '$thn'")->result();
        foreach($qwri as $qw){
            $jml = $this->db->query("select sum(jumlah_biaya) as jml from a_detil8 where id_subkomp = $qw->id_subkomp")->row();
            $this->db->query("update a_subkomp7 set jumlah_biaya = '$jml->jml' where id_subkomp = $qw->id_subkomp");
        }
    }
    function isi_biaya_komponen($thn){
        $qwri = $this->db->query("select a.id_komponen from a_komponen6 a 
                                    inner join a_ro5 bbb on a.id_ro=bbb.id_ro
                                    inner join a_kro4 bb on bbb.id_kro=bb.id_kro
                                    inner join a_aktivitas3 b on bb.id_aktivitas=b.id_aktivitas
                                    inner join a_program2 c on b.id_program=c.id_program
                                    inner join a_trs_alokasi1 d on c.id_alokasi=d.id_alokasi
                                    where d.ta = '$thn'")->result();
        foreach($qwri as $qw){
            $jml = $this->db->query("select sum(jumlah_biaya) as jml from a_subkomp7 where id_komponen = $qw->id_komponen")->row();
            $this->db->query("update a_komponen6 set jumlah_biaya = '$jml->jml' where id_komponen = $qw->id_komponen");
        }
    }
    function isi_biaya_ro($thn){
        $qwri = $this->db->query("select a.id_ro from a_ro5 a 
                                    inner join a_kro4 bb on a.id_kro=bb.id_kro
                                    inner join a_aktivitas3 b on bb.id_aktivitas=b.id_aktivitas
                                    inner join a_program2 c on b.id_program=c.id_program
                                    inner join a_trs_alokasi1 d on c.id_alokasi=d.id_alokasi
                                    where d.ta = '$thn'")->result();
        foreach($qwri as $qw){
            $jml = $this->db->query("select sum(jumlah_biaya) as jml from a_komponen6 where id_ro = $qw->id_ro")->row();
            $this->db->query("update a_ro5 set jumlah_biaya = '$jml->jml' where id_ro = $qw->id_ro");
        }
    }
    
}