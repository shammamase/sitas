<?php 
class Model_menu extends CI_model{
    function menuutama(){
        return $this->db->query("SELECT * FROM mainmenu");
    }

    function menuutama_tambah(){
            $datadb = array('nama_menu'=>$this->db->escape_str($this->input->post('a')),
                            'link'=>$this->db->escape_str($this->input->post('b')),
                            'aktif'=>$this->db->escape_str($this->input->post('c')),
                            'adminmenu'=>$this->db->escape_str($this->input->post('d')));
        $this->db->insert('mainmenu',$datadb);
    }

    function menuutama_update(){
            $datadb = array('nama_menu'=>$this->db->escape_str($this->input->post('a')),
                            'link'=>$this->db->escape_str($this->input->post('b')),
                            'aktif'=>$this->db->escape_str($this->input->post('c')),
                            'adminmenu'=>$this->db->escape_str($this->input->post('d')));
        $this->db->where('id_main',$this->input->post('id'));
        $this->db->update('mainmenu',$datadb);
    }

    function menuutama_edit($id){
        return $this->db->query("SELECT * FROM mainmenu where id_main='$id'");
    }

    function menuutama_delete($id){
        return $this->db->query("DELETE FROM mainmenu where id_main='$id'");
    }

    public function view_ordering($table,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    function submenu(){
        return $this->db->query("SELECT a.*, b.nama_menu FROM submenu a LEFT JOIN mainmenu b ON a.id_main=b.id_main");
    }

    function cek_menuutama(){
        return $this->db->query("SELECT * FROM mainmenu where aktif='Y'");
    }

    function cek_submenu(){
        return $this->db->query("SELECT * FROM submenu where aktif='Y'");
    }

    function submenu_tambah(){
        $low = strtolower($this->input->post('a'));
        $datadb = array('nama_sub'=>$this->db->escape_str($this->input->post('a')),
                        'link_sub'=>'admin/plugin/'.$low,
                        'id_main'=>'11');
        $this->db->insert('cltr_submenu',$datadb);
    }

    function submenu_update(){
         $low = strtolower($this->input->post('a'));
        $datadb = array('nama_sub'=>$this->db->escape_str($this->input->post('a')),
                        'link_sub'=>'admin/plugin/'.$low,
                        'id_main'=>'11');
        $this->db->where('id_sub',$this->input->post('id_sub'));
        $this->db->update('cltr_submenu',$datadb);
    }

    function submenu_edit_nama($id){
        return $this->db->query("SELECT * FROM cltr_submenu where nama_sub='$id'");
    }

    function submenu_delete_komp($id){
        return $this->db->query("DELETE FROM cltr_submenu where id_sub='$id'");
    }

    function mainmenu_admin(){
        return $this->db->query("SELECT * FROM mainmenu WHERE aktif = 'N' AND adminmenu= 'Y'");
    }

    function mainmenu_admin_cltr(){
        return $this->db->query("SELECT * FROM cltr_mainmenu WHERE aktif = 'N' AND adminmenu= 'Y' ORDER BY id_main ASC");
    }

    function submenu_admin($id_main){
        return $this->db->query("SELECT * FROM submenu, mainmenu WHERE submenu.id_main = mainmenu.id_main AND submenu.id_main='$id_main' AND submenu.aktif='N'");
    }

    function submenu_admin_cltr($id_main){
        return $this->db->query("SELECT * FROM cltr_submenu, cltr_mainmenu WHERE cltr_submenu.id_main = cltr_mainmenu.id_main AND cltr_submenu.id_main='$id_main' AND cltr_submenu.aktif='N'");
    }

    function mainmenu_user(){
        return $this->db->query("SELECT * FROM modul where status='user' and aktif='Y' order by urutan");
    }

    function list_menu(){
        return $this->db->query("SELECT * FROM cltr_kat_menu ORDER BY id_kat_menu ASC");
    }

    function list_menu_tambah(){
        $datadb = array('kat_menu'=>$this->db->escape_str($this->input->post('a')));
        $this->db->insert('cltr_kat_menu',$datadb);
    }

    function list_menu_edit($x){
        return $this->db->query("SELECT * FROM cltr_kat_menu WHERE id_kat_menu = '$x'");
    }

    function list_menu_update(){
        $datadb = array('kat_menu'=>$this->db->escape_str($this->input->post('a')));
        $this->db->where('id_kat_menu',$this->input->post('id'));
        $this->db->update('cltr_kat_menu',$datadb);
    }

    function list_menu_delete($id){
        return $this->db->query("DELETE FROM cltr_kat_menu WHERE id_kat_menu = '$id'");
    }

     function list_menux(){
        return $this->db->query("SELECT cltr_menu.*, cltr_kat_menu.kat_menu, halamanstatis.judul FROM cltr_menu LEFT JOIN cltr_kat_menu ON cltr_menu.id_kat_menu = cltr_kat_menu.id_kat_menu LEFT JOIN halamanstatis ON cltr_menu.utama = halamanstatis.id_halaman ORDER BY cltr_menu.id_menu DESC");
    }

    function menu_row($x){
        return $this->db->query("select * from cltr_menu where id_menu = $x")->row();
    }

    function list_menux_tambah(){
        $config['upload_path'] = 'asset/foto_menu/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('g')) {
            $hasil = $this->upload->data();
            $gmb = $hasil['file_name'];
        } else {
            $gmb = "";
        }
        if ($this->input->post('c')!='') {
            $seki = $this->input->post('c');
            $skn = implode(",",$seki);
        } else {
            $skn = '';
        }
        $datadb = array('id_kat_menu'=>$this->input->post('a'),
                        'utama'=>$this->input->post('b'),
                        'sekunder'=>$skn,
                        'nama_menu'=>$this->db->escape_str($this->input->post('d')),
                        'icon'=>$this->db->escape_str($this->input->post('e')),
                        'url'=>$this->db->escape_str($this->input->post('f')),
                        'gambar'=>$gmb);
        $this->db->insert('cltr_menu',$datadb);
    }

    function list_menux_edit($x){
        return $this->db->query("SELECT * FROM cltr_menu WHERE id_menu = '$x'");
    }

    function list_menux_update(){
        $gmx = $this->input->post('gm');
        $config['upload_path'] = 'asset/foto_menu/';
        $config['allowed_types'] = 'gif|png|jpg|JPG|JPEG';
        $config['max_size'] = '3000';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('g')) {
            $hasil = $this->upload->data();
            $gmb = $hasil['file_name'];
            unlink("./asset/foto_menu/$gmx");
        } else {
            $gmb = $gmx;
        }
        if ($this->input->post('c')!='') {
            $seki = $this->input->post('c');
            $skn = implode(",",$seki);
        } else {
            $skn = '';
        }
        $datadb = array('id_kat_menu'=>$this->input->post('a'),
                        'utama'=>$this->input->post('b'),
                        'sekunder'=>$skn,
                        'nama_menu'=>$this->db->escape_str($this->input->post('d')),
                        'icon'=>$this->db->escape_str($this->input->post('e')),
                        'url'=>$this->db->escape_str($this->input->post('f')),
                        'gambar'=>$gmb);
        $this->db->where('id_menu',$this->input->post('id'));
        $this->db->update('cltr_menu',$datadb);
    }

    function list_menux_delete($id){
        return $this->db->query("DELETE FROM cltr_menu WHERE id_menu = '$id'");
    }

     function list_komponen(){
        return $this->db->query("SELECT * FROM cltr_komp ORDER BY id_komp DESC");
    }

    function list_komponen_tambah(){
        $datadb = array('komp'=>$this->input->post('a'));
        $this->db->insert('cltr_komp',$datadb);
    }

    function list_komponen_edit($x){
        return $this->db->query("SELECT * FROM cltr_komp WHERE id_komp = '$x'");
    }

    function list_komponen_update(){
        $datadb = array('komp'=>$this->input->post('a'));
        $this->db->where('id_komp',$this->input->post('id'));
        $this->db->update('cltr_komp',$datadb);
    }

    function list_komponen_delete($id){
        return $this->db->query("DELETE FROM cltr_komp WHERE id_komp = '$id'");
    }

    function komponen_nama($id){
        return $this->db->query("SELECT * FROM cltr_komp WHERE komp = '$id'");
    }

    // property
    function list_properti(){
        return $this->db->query("SELECT cltr_properti.*, cltr_komp.* FROM cltr_properti INNER JOIN cltr_komp ON cltr_komp.id_komp=cltr_properti.id_komp ORDER BY cltr_properti.id_properti DESC");
    }

    function list_properti_tambah(){
        $datadb = array('id_komp'=>$this->input->post('a'),
                        'properti'=>$this->input->post('b'),
                        'tipe'=>$this->input->post('c')
                        );
        $this->db->insert('cltr_properti',$datadb);
    }

    function list_properti_edit($x){
        return $this->db->query("SELECT * FROM cltr_properti WHERE id_properti = '$x'");
    }

    function list_properti_update(){
        $datadb = array('id_komp'=>$this->input->post('a'),
                        'properti'=>$this->input->post('b'),
                        'tipe'=>$this->input->post('c')
                        );
        $this->db->where('id_properti',$this->input->post('id'));
        $this->db->update('cltr_properti',$datadb);
    }

    function list_properti_delete($id){
        return $this->db->query("DELETE FROM cltr_properti WHERE id_properti = '$id'");
    }

    function tambah_plugin(){
        $config['upload_path'] = 'asset/file_lainnya/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg|mp3';
        $config['max_size'] = '30000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar');
        $hasil=$this->upload->data();
        $id_properti = $this->input->post('id_properti');
        $aa = $this->input->post('a');
        $bb = $this->input->post('b');
        $uris = $this->input->post('uri');
        $data = array();
        //$index = 0;

        $jml = count($id_properti);
        for($ii=0; $ii<$jml; $ii++){
            $propers = $this->db->query("SELECT * FROM cltr_properti WHERE id_properti = '$id_properti[$ii]'")->row();
            if ($propers->tipe=="file") {
                $input = $hasil['file_name'];
            } else {
                $xx = $propers->properti;
                $input = $_POST[$xx];
            }
             array_push($data, array('id_properti'=>$id_properti[$ii],
                                    'id_post'=>$aa,
                                    'id_halaman'=>$bb,
                                    'plugin'=>$input
                                    ));
        } 
        $this->db->insert_batch('cltr_plugin',$data);
        redirect('admin/plugin/'.$uris);
    }

    function tambah_submenu2(){
        if ($this->input->post('menu2')!='') {
            $seki = $this->input->post('menu2');
            $skn = implode(",",$seki);
        } else {
            $skn = '';
        }
        $datadb = array('id_kat_menu'=>$this->input->post('id_kat_menu'),
                        'level'=>$this->input->post('level'),
                        'menu1'=>$this->input->post('menu1'),
                        'menu2'=>$skn);
        $this->db->insert('cltr_menu2',$datadb);
        redirect('admin/menu');
    }

    function edit_submenu2(){
        if ($this->input->post('menu2')!='') {
            $seki = $this->input->post('menu2');
            $skn = implode(",",$seki);
        } else {
            $skn = '';
        }
        $datadb = array('id_kat_menu'=>$this->input->post('id_kat_menu'),
                        'level'=>$this->input->post('level'),
                        'menu1'=>$this->input->post('menu1'),
                        'menu2'=>$skn);
        $this->db->where('id_menu2',$this->input->post('id_menu2'));
        $this->db->update('cltr_menu2',$datadb);
        redirect('admin/menu');
    }
}