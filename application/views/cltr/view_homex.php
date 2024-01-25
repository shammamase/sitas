<nav id="menu-top">

    <svg version="1.1" id="btn-menu" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24">
        <polygon points="4,6  20,6"></polygon>
        <polygon points="4,12 16,12"></polygon>
        <polygon points="4,18 12,18"></polygon>
    </svg>

    <span class="brand">
        <?php 
            $lg = "logo_2.png";
        ?>
        <a href="./">
            <img src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/img/core-img/<?php echo $lg ?>" alt="">
        </a>
    </span>

    <ul id="quick-links">
        <li>
            <a href="./"><svg class="svg-inline--fa fa-home fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="home" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"></path></svg><!-- <i class="fas fa-home"></i> Font Awesome fontawesome.com --> Home</a>
        </li>
        <li>
            <a href="javascript:void()"><svg class="svg-inline--fa fa-vials fa-w-20" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="vials" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M72 64h24v240c0 44.1 35.9 80 80 80s80-35.9 80-80V64h24c4.4 0 8-3.6 8-8V8c0-4.4-3.6-8-8-8H72c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8zm72 0h64v96h-64V64zm480 384H16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h608c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM360 64h24v240c0 44.1 35.9 80 80 80s80-35.9 80-80V64h24c4.4 0 8-3.6 8-8V8c0-4.4-3.6-8-8-8H360c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8zm72 0h64v96h-64V64z"></path></svg><!-- <i class="fas fa-vials"></i> Font Awesome fontawesome.com --> Program Utama</a>
            <ul>
                <li><a href="<?= base_url() ?>page/hal/penelitian-dan-pengkajian">Penelitian dan Pengkajian</a></li>
                <li><a href="<?= base_url() ?>page/hal/penyuluhan">Penyuluhan</a></li>
                <li><a href="<?= base_url() ?>page/hal/diseminasi">Diseminasi</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:void()"><svg class="svg-inline--fa fa-handshake fa-w-20" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="handshake" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M434.7 64h-85.9c-8 0-15.7 3-21.6 8.4l-98.3 90c-.1.1-.2.3-.3.4-16.6 15.6-16.3 40.5-2.1 56 12.7 13.9 39.4 17.6 56.1 2.7.1-.1.3-.1.4-.2l79.9-73.2c6.5-5.9 16.7-5.5 22.6 1 6 6.5 5.5 16.6-1 22.6l-26.1 23.9L504 313.8c2.9 2.4 5.5 5 7.9 7.7V128l-54.6-54.6c-5.9-6-14.1-9.4-22.6-9.4zM544 128.2v223.9c0 17.7 14.3 32 32 32h64V128.2h-96zm48 223.9c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16zM0 384h64c17.7 0 32-14.3 32-32V128.2H0V384zm48-63.9c8.8 0 16 7.2 16 16s-7.2 16-16 16-16-7.2-16-16c0-8.9 7.2-16 16-16zm435.9 18.6L334.6 217.5l-30 27.5c-29.7 27.1-75.2 24.5-101.7-4.4-26.9-29.4-24.8-74.9 4.4-101.7L289.1 64h-83.8c-8.5 0-16.6 3.4-22.6 9.4L128 128v223.9h18.3l90.5 81.9c27.4 22.3 67.7 18.1 90-9.3l.2-.2 17.9 15.5c15.9 13 39.4 10.5 52.3-5.4l31.4-38.6 5.4 4.4c13.7 11.1 33.9 9.1 45-4.7l9.5-11.7c11.2-13.8 9.1-33.9-4.6-45.1z"></path></svg><!-- <i class="fas fa-handshake"></i> Font Awesome fontawesome.com --> Publikasi</a>
            <ul>
                <li><a href="<?= base_url() ?>page/hal/buku">Buku</a></li>
                <li><a href="<?= base_url() ?>page/hal/poster">Poster</a></li>
                <li><a href="<?= base_url() ?>page/hal/leaflet">Leaflet</a></li>
                <li><a href="<?= base_url() ?>page/hal/artikel">Artikel</a></li>
                <li><a href="<?= base_url() ?>page/hal/info-grafis">Info Grafis</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:void()"><svg class="svg-inline--fa fa-question-circle fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zM262.655 90c-54.497 0-89.255 22.957-116.549 63.758-3.536 5.286-2.353 12.415 2.715 16.258l34.699 26.31c5.205 3.947 12.621 3.008 16.665-2.122 17.864-22.658 30.113-35.797 57.303-35.797 20.429 0 45.698 13.148 45.698 32.958 0 14.976-12.363 22.667-32.534 33.976C247.128 238.528 216 254.941 216 296v4c0 6.627 5.373 12 12 12h56c6.627 0 12-5.373 12-12v-1.333c0-28.462 83.186-29.647 83.186-106.667 0-58.002-60.165-102-116.531-102zM256 338c-25.365 0-46 20.635-46 46 0 25.364 20.635 46 46 46s46-20.636 46-46c0-25.365-20.635-46-46-46z"></path></svg><!-- <i class="fas fa-question-circle"></i> Font Awesome fontawesome.com --> Kerja Sama</a>
            <ul>
                <li><a href="<?= base_url() ?>page/hal/kerjasama-dalam-negeri">Kerjasama Dalam Negeri</a></li>
                <li><a href="<?= base_url() ?>page/hal/kerjasama-luar-negeri">Kerjasama Luar Negeri</a></li>
            </ul>
        </li>
    </ul>

    <svg version="1.1" id="btn-contrast" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;">
        <circle cx="12" cy="12" r="9"></circle>
        <path d="M12,18c-3.31,0-6-2.69-6-6s2.69-6,6-6V18z"></path>
    </svg>

    <div id="google_translate_element"></div>
    
    <svg version="1.1" id="btn-mute" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;">
        <path class="curve" d="M10.2,13.8c-1-1-1-2.6,0-3.5"></path>
        <path class="curve" d="M7.6,16.4C5.1,14,5.1,10,7.6,7.6"></path>
        <path class="curve" d="M4.9,19.1C1,15.2,1,8.8,4.9,4.9"></path>
    </svg>

    <form action="<?php echo site_url('berita/cari') ?>" method="POST">
        <input id="search-input" name="cari" type="text">
        <input id="mod" name="mod" type="hidden" value="NEWS_LIST">
        <input type="button" style="visibility: hidden;" name="submit" value="Cari">
        <!--<button type="submit" name="submit" class="d-none"></button>-->
    </form>

    <svg version="1.1" id="btn-search" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24">
        <path id="btn-search-glass" d="M14.2,14.2c-2.3,2.3-6.1,2.3-8.5,0 s-2.3-6.1,0-8.5s6.1-2.3,8.5,0S16.6,11.9,14.2,14.2"></path>
        <path id="btn-search-handle" d="M14.2,14.2L20,20"></path>
    </svg>

    </nav>
    
    <nav id="menu-side">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a>Profil</a>
                <ul>
                    <li><a href="./page-detail.php?id=1">Sejarah Singkat</a></li>
                    <li><a href="./page-detail.php?id=2">Visi, Misi, dan Tupoksi</a></li>
                    <li><a href="./page-detail.php?id=3">Logo, Moto, dan Janji Layanan</a></li>
                    <li><a href="./page-detail.php?id=4">Kebijakan Mutu Dan Maklumat Layanan</a></li>
                    <li><a>Manajemen Balai</a>
                        <ul>
                            <li><a href="./page-detail.php?id=5">Struktur Organisasi</a></li>
                            <li><a href="./page-detail.php?id=120">Profil Struktural</a></li>
                            <li><a href="./page-detail.php?id=7">LHKPN</a></li>
                        </ul>
                    </li>
                    <li><a href="./page-detail.php?id=142">Sumber Daya Manusia</a></li>
                    <li><a>Unit Kerja</a>
                        <ul>
                            <li><a href="./page-detail.php?id=9">Sub Bagian Tata Usaha</a></li>
                            <li><a href="./page-detail.php?id=10">Pemeliharaan Ternak</a></li>
                            <li><a href="./page-detail.php?id=11">Produksi dan Aplikasi</a></li>
                            <li><a href="./page-detail.php?id=12">Informasi dan Penyebaran Hasil</a></li>
                        </ul>
                    </li>
                    <li><a href="./page-detail.php?id=13">Sarana &amp; Prasarana</a></li>
                    <li><a href="./page-detail.php?id=16">Prestasi</a></li>
                    <li><a href="./page-detail.php?id=17">Kontak Kami</a></li>
                </ul>
            </li>
            <li><a>Program</a>
                <ul>
                    <li><a href="./page-detail.php?id=64">Produksi Embrio</a></li>
                    <li><a href="./page-detail.php?id=65">Transfer Embrio</a></li>
                    <li><a href="./page-detail.php?id=19">Kerja Sama</a></li>
                    <li><a href="./page-detail.php?id=20">Bimbingan Teknis/Magang</a></li>
                    <li><a href="./page-detail.php?id=157">CSR</a></li>
                </ul>
            </li>
            <li><a>Produk</a>
                <ul>
                    <li><a href="./page-detail.php?id=21">Embrio</a></li>
                    <li><a href="./page-detail.php?id=22">Ternak Bibit</a></li>
                </ul>
            </li>
            <li><a>Informasi Publik</a>
                <ul>
                    <li><a href="./page-detail.php?id=23">Portal PPID BET Cipelang</a></li>
                    <li><a>Standar Operasional Prosedur (SOP)</a>
                        <ul>
                            <li><a href="./page-detail.php?id=29">SOP PPID</a></li>
                            <li><a href="./page-detail.php?id=123">SOP Penanggulangan Bencana</a></li>
                            <li><a href="./page-detail.php?id=126">SOP Produksi dan Aplikasi TE</a></li>
                            <li><a href="./page-detail.php?id=127">SOP Sub Bagian Tata Usaha</a></li>
                            <li><a href="./page-detail.php?id=129">SOP Pemeliharaan Ternak</a></li>
                            <li><a href="./page-detail.php?id=130">SOP Informasi dan Penyebaran
                                    Hasil</a></li>
                            <li><a href="./page-detail.php?id=131">SOP Pelayanan BET Cipelang</a></li>
                        </ul>
                    </li>
                    <li><a>PPID dan Pelayanan Publik</a>
                        <ul>
                            <li><a href="./page-detail.php?id=24">Hak Atas Informasi Publik</a></li>
                            <li><a href="./page-detail.php?id=25">Profil PPID BET Cipelang</a></li>
                            <li><a href="./page-detail.php?id=26">Regulasi PPID BET Cipelang</a></li>
                            <li><a href="./page-detail.php?id=27">Maklumat Pelayanan PPID</a></li>
                            <li><a href="./page-detail.php?id=28">Standar Pelayanan Publik </a></li>
                            <li><a href="./page-detail.php?id=30">Jam dan Standar Pelayanan</a></li>
                            <li><a href="./page-detail.php?id=31">Mekanisme Pengaduan Masyarakat</a></li>
                            <li><a>Daftar Informasi Publik</a>
                                <ul>
                                    <li><a href="./page-detail.php?id=86">Daftar Informasi Publik
                                            Berkala</a></li>
                                    <li><a href="./page-detail.php?id=87">DIP_Setiap Saat</a></li>
                                    <li><a href="./page-detail.php?id=88">DIP_Serta Merta</a></li>
                                </ul>
                            </li>
                            <li><a href="./page-detail.php?id=34">Formulir Permohonan IP</a></li>
                            <li><a href="./page-detail.php?id=76">Alur Pelayanan</a></li>
                            <li><a href="./page-detail.php?id=122">RUU Terkait Kementerian
                                    Pertanian</a></li>
                        </ul>
                    </li>
                    <li><a>Informasi Keuangan</a>
                        <ul>
                            <li><a href="./page-detail.php?id=35">DIPA BET</a></li>
                            <li><a href="./page-detail.php?id=36">RKA-KL</a></li>
                            <li><a href="./page-detail.php?id=37">Realisasi Anggaran</a></li>
                            <li><a href="./page-detail.php?id=38">Laporan Keuangan </a></li>
                            <li><a href="./page-detail.php?id=39">Neraca Keuangan</a></li>
                            <li><a href="./page-detail.php?id=40">Penerimaan Negara Bukan Pajak</a></li>
                            <li><a href="./page-detail.php?id=41">Daftar Aset</a></li>
                            <li><a href="./page-detail.php?id=125">Arus Kas</a></li>
                            <li><a href="./page-detail.php?id=128">Rencana Anggaran</a></li>
                        </ul>
                    </li>
                    <li><a>Laporan-laporan</a>
                        <ul>
                            <li><a href="./page-detail.php?id=42">LAKIP/LAKIN</a></li>
                            <li><a href="./page-detail.php?id=43">Laporan Bulanan</a></li>
                            <li><a href="./page-detail.php?id=44">Laporan Tahunan</a></li>
                            <li><a href="./page-detail.php?id=45">Laporan PPID</a></li>
                            <li><a href="./page-detail.php?id=46">Laporan Akses Informasi Publik
                                    Tahunan</a></li>
                            <li><a href="./page-detail.php?id=47">Laporan Pengaduan Masyarakat</a></li>
                            <li><a href="./page-detail.php?id=48">Indeks Kepuasan Masyarakat</a></li>
                        </ul>
                    </li>
                    <li><a>Kinerja BET Cipelang</a>
                        <ul>
                            <li><a href="./page-detail.php?id=49">Renstra dan RKT</a></li>
                            <li><a href="./page-detail.php?id=50">Penetapan Kinerja</a></li>
                            <li><a href="./page-detail.php?id=51">Capaian Kinerja</a></li>
                        </ul>
                    </li>
                    <li><a href="./page-detail.php?id=52">Pengadaan Barang dan Jasa</a></li>
                    <li><a href="./page-detail.php?id=53">Perpustakaan Digital</a></li>
                    <li><a href="./page-detail.php?id=54">Peraturan-Peraturan</a></li>
                    <li><a href="./page-detail.php?id=55">Link Website</a></li>
                    <li><a href="./page-detail.php?id=56">Tarif PNBP</a></li>
                    <li><a href="./page-detail.php?id=57">Grafik Perkembangan</a></li>
                </ul>
            </li>
            <li><a>Pojok Artikel</a>
                <ul>
                    <li><a href="./page-detail.php?id=72">Jurnal Penelitian</a></li>
                    <li><a>Materi</a>
                        <ul>
                            <li><a href="./page-detail.php?id=79">Materi Pertemuan</a></li>
                            <li><a>Materi Bimtek/Pelatihan</a>
                                <ul>
                                    <li><a href="./page-detail.php?id=82">Inseminasi Buatan (IB)</a></li>
                                    <li><a href="./page-detail.php?id=83">Pemeriksaan Kebuntingan
                                            (PKb)</a></li>
                                    <li><a href="./page-detail.php?id=84">Asisten Teknis
                                            Reproduksi (ATR)</a></li>
                                    <li><a href="./page-detail.php?id=85">Transfer Embrio (TE)</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="./page-detail.php?id=90">Pengembangan Sapi Belgian Blue</a></li>
                    <li><a href="./page-detail.php?id=121">Frequently Asked Questions</a></li>
                    <li><a href="./page-detail.php?id=73">Fungsional Corner</a></li>
                    <li><a href="./page-detail.php?id=74">Siaran Pers</a></li>
                </ul>
            </li>
            <li><a>Reformasi Beti</a>
                <ul>
                    <li><a href="./page-detail.php?id=92">Profil Reformasi Birokrasi </a></li>
                    <li><a>Manajemen Perubahan</a>
                        <ul>
                            <li><a href="./page-detail.php?id=94">Team Zona Integritas</a></li>
                            <li><a href="./page-detail.php?id=96">Rencana Kerja Zona Integritas</a></li>
                            <li><a href="./page-detail.php?id=97">Pemantauan dan Evaluasi</a></li>
                            <li><a href="./page-detail.php?id=98">Perubahan Pola Pikir</a></li>
                        </ul>
                    </li>
                    <li><a>Penataan Tatalaksana</a>
                        <ul>
                            <li><a href="./page-detail.php?id=99">Proses Bisnis</a></li>
                            <li><a href="./page-detail.php?id=100">E Office</a></li>
                            <li><a href="./page-detail.php?id=101">Keterbukaan Informasi Publik</a></li>
                        </ul>
                    </li>
                    <li><a>Penataan Sistem Manajemen SDM</a>
                        <ul>
                            <li><a href="./page-detail.php?id=108">Perencanaan Kebutuhan Pegawai
                                    dan Mutasi Internal</a></li>
                            <li><a href="./page-detail.php?id=109">Pengembangan Pegawai</a></li>
                            <li><a href="./page-detail.php?id=110">Penetapan Kinerja Individu</a></li>
                            <li><a href="./page-detail.php?id=111">Penegakan Aturan Disiplin</a></li>
                            <li><a href="./page-detail.php?id=112">Evaluasi Jabatan</a></li>
                            <li><a href="./page-detail.php?id=113">Sistem Informasi Kepegawaian</a></li>
                        </ul>
                    </li>
                    <li><a>Penguatan Akuntabilitas</a>
                        <ul>
                            <li><a href="./page-detail.php?id=114">Akuntabilitas Kinerja</a></li>
                            <li><a href="./page-detail.php?id=115">Akuntabilitas Keuangan</a></li>
                        </ul>
                    </li>
                    <li><a href="./page-detail.php?id=105">Penguatan Pengawasan</a></li>
                    <li><a href="./page-detail.php?id=106">Peningkatan Pelayanan Publik</a></li>
                    <li><a>Inovasi BETY</a>
                        <ul>
                            <li><a href="./page-detail.php?id=116">SKM Online</a></li>
                            <li><a href="./page-detail.php?id=117">SIBETI</a></li>
                            <li><a target="_blank" href="https://sibeti.ditjenpkh.pertanian.go.id/siscobeti/front">SiscoBeti</a></li>
                            <li><a href="./page-detail.php?id=158">Cuti/Ijin Online</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="./sitemap.php">Site Map</a></li>
            <li><a href="./page-detail.php?id=152">Galeri</a></li>
        </ul>
    </nav>
    
    <header>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $qw_brt = $this->db->query("select * from cltr_post where id_page = 4 and acc = 1 order by id_post desc limit 4")->result();
                foreach($qw_brt as $qw_br){
                ?>
                <div class="swiper-slide">
    				<img src="<?php echo base_url().'/asset/foto_content/'.$qw_br->thumbnail ?>" class="" alt="Cover">
    				<div style="display: flex;justify-content: center;background-color:rgba(0,0,0,0.5);position: absolute;width: 80%;top: 612px;left:50px;z-index: 20;color: #fff;-webkit-text-fill-color: white; /* Will override color (regardless of order) */-webkit-text-stroke-width: 1px;-webkit-text-stroke-color: black;">
    				    <section>
                            <h2 style="font-size:30px"><?php echo $qw_br->judul ?></h2>
                            <a href="<?php echo site_url('berita/detail/'.$qw_br->judul_seo) ?>"><b>Baca Selengkapnya</b></a>
                        </section>
    				    
    				</div>
    			</div>
                <?php
                }
                ?>
    		</div>        
	    </div>
    </header>
    
    
    <main>

        <section class="tts buttons" style="display:none">
            <button id="TTSplay"><svg class="svg-inline--fa fa-play fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="play" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg><!-- <i class="fas fa-play"></i> Font Awesome fontawesome.com -->&nbsp; Baca <span>Artikel</span></button>
            <button id="TTSpause"><svg class="svg-inline--fa fa-pause fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pause" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M144 479H48c-26.5 0-48-21.5-48-48V79c0-26.5 21.5-48 48-48h96c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zm304-48V79c0-26.5-21.5-48-48-48h-96c-26.5 0-48 21.5-48 48v352c0 26.5 21.5 48 48 48h96c26.5 0 48-21.5 48-48z"></path></svg><!-- <i class="fas fa-pause"></i> Font Awesome fontawesome.com -->&nbsp; Jeda</button>
            <button id="TTSstop"><svg class="svg-inline--fa fa-stop fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="stop" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48z"></path></svg><!-- <i class="fas fa-stop"></i> Font Awesome fontawesome.com -->&nbsp; Stop</button>
        </section>

        <section class="welcome">
            <h1><svg class="svg-inline--fa fa-hands-helping fa-w-20" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="hands-helping" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M488 192H336v56c0 39.7-32.3 72-72 72s-72-32.3-72-72V126.4l-64.9 39C107.8 176.9 96 197.8 96 220.2v47.3l-80 46.2C.7 322.5-4.6 342.1 4.3 357.4l80 138.6c8.8 15.3 28.4 20.5 43.7 11.7L231.4 448H368c35.3 0 64-28.7 64-64h16c17.7 0 32-14.3 32-32v-64h8c13.3 0 24-10.7 24-24v-48c0-13.3-10.7-24-24-24zm147.7-37.4L555.7 16C546.9.7 527.3-4.5 512 4.3L408.6 64H306.4c-12 0-23.7 3.4-33.9 9.7L239 94.6c-9.4 5.8-15 16.1-15 27.1V248c0 22.1 17.9 40 40 40s40-17.9 40-40v-88h184c30.9 0 56 25.1 56 56v28.5l80-46.2c15.3-8.9 20.5-28.4 11.7-43.7z"></path></svg><!-- <i class="fas fa-hands-helping"></i> Font Awesome fontawesome.com --> Kami Siap Melayani Anda Sepenuh Hati</h1>
            <h2 class="success">Selamat Datang di Website Resmi Balai Embrio Ternak - Cipelang</h2>
            <p><strong>Balai Embrio Ternak - Cipelang Bogor</strong> merupakan salah satu Unit Pelaksana Teknis yang
                berada dibawah Direktorat Jenderal Peternakan dan Kesehatan Hewan, Kementerian Pertanian Republik
                Indonesia.</p>
        </section>

        <section class="menu-images">
            <article>
                <a href="#produk">
                    <img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617781912.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617781912.jpeg" alt="Image">
                    <h2>Produk BET</h2>
                </a>
            </article>
            <article>
                <a target="_blank" href="https://sibeti.ditjenpkh.pertanian.go.id/siscobeti/public/home">
                    <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/menu-siscobeti.jpg" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/menu-siscobeti.jpg" alt="Image">
                    <h2>SiscoBETI</h2>
                </a>
            </article>
            <article>
                <a href="#layanan">
                    <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/menu-layanan.jpg" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/menu-layanan.jpg" alt="Image">
                    <h2>Layanan</h2>
                </a>
            </article>
            <article>
                <a href="faq.php">
                    <img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618451409.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618451409.jpeg" alt="Image">
                    <h2>FAQ</h2>
                </a>
            </article>
        </section>

        <hr>

        <div class="swiper-container swiper-container-initialized swiper-container-horizontal">

            <div class="swiper-wrapper" style="transform: translate3d(-996px, 0px, 0px); transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 332px;">
                        <a data-fslightbox="slider" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575443.jpeg">
                            <img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575443.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575443.jpeg" alt="slide">
                        </a>
                    </div>
                                    <div class="swiper-slide" data-swiper-slide-index="0" style="width: 332px;">
                        <a data-fslightbox="slider" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1612639871.jpeg">
                            <img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1612639871.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1612639871.jpeg" alt="slide">
                        </a>
                    </div>
                                    <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="1" style="width: 332px;">
                        <a data-fslightbox="slider" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1621907573.jpeg">
                            <img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1621907573.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1621907573.jpeg" alt="slide">
                        </a>
                    </div>
                                    <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="2" style="width: 332px;">
                        <a data-fslightbox="slider" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575672.jpeg">
                            <img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575672.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575672.jpeg" alt="slide">
                        </a>
                    </div>
                                    <div class="swiper-slide swiper-slide-next" data-swiper-slide-index="3" style="width: 332px;">
                        <a data-fslightbox="slider" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575486.jpeg">
                            <img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575486.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575486.jpeg" alt="slide">
                        </a>
                    </div>
                                    <div class="swiper-slide" data-swiper-slide-index="4" style="width: 332px;">
                        <a data-fslightbox="slider" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575443.jpeg">
                            <img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575443.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1659575443.jpeg" alt="slide">
                        </a>
                    </div>
                            <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="width: 332px;">
                        <a data-fslightbox="slider" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1612639871.jpeg">
                            <img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1612639871.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1612639871.jpeg" alt="slide">
                        </a>
                    </div></div>

            <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"></div>
            <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"></div>

            <div class="swiper-scrollbar"><div class="swiper-scrollbar-drag" style="width: 46.4286px; transform: translate3d(139.286px, 0px, 0px); transition-duration: 0ms;"></div></div>


        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

        <hr>

        <h1><svg class="svg-inline--fa fa-newspaper fa-w-18 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="newspaper" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M552 64H88c-13.255 0-24 10.745-24 24v8H24c-13.255 0-24 10.745-24 24v272c0 30.928 25.072 56 56 56h472c26.51 0 48-21.49 48-48V88c0-13.255-10.745-24-24-24zM56 400a8 8 0 0 1-8-8V144h16v248a8 8 0 0 1-8 8zm236-16H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm-208-96H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm0-96H140c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h360c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12z"></path></svg><!-- <i class="fas fa-fw fa-newspaper"></i> Font Awesome fontawesome.com --> Berita Umum</h1>
        <section>
            <section><article>
								<a href="./news-detail.php?id=615" title="BET Cipelang Terus Genjot Realisasi Banpem Jatim ">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1666065130.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1666065130.jpeg" alt="Image">
									<h2>BET Cipelang Terus Genjot Realisasi Banpem Jatim </h2>
									<p>17 Oktober 2022</p>
								</a>
							</article><article>
								<a href="./news-detail.php?id=614" title="BET Hadiri Rakor dan Bimtek Penandaan dan Pendataan Ternak di Banten">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1666054752.png" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1666054752.png" alt="Image">
									<h2>BET Hadiri Rakor dan Bimtek Penandaan dan Pendataan Ternak di Banten</h2>
									<p>06 Oktober 2022</p>
								</a>
							</article><article>
								<a href="./news-detail.php?id=613" title="BET, Audit Eksternal SNI ISO 37001, SNI ISO 9001 dan SNI ISO 14001">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1663479335.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1663479335.jpeg" alt="Image">
									<h2>BET, Audit Eksternal SNI ISO 37001, SNI ISO 9001 dan SNI ISO 14001</h2>
									<p>14 September 2022</p>
								</a>
							</article><article>
								<a href="./news-detail.php?id=612" title="BET Dampingi Penandaan dan Pendataan Ternak di Kalbar">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1663230679.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1663230679.jpeg" alt="Image">
									<h2>BET Dampingi Penandaan dan Pendataan Ternak di Kalbar</h2>
									<p>15 September 2022</p>
								</a>
							</article><article>
								<a href="./news-detail.php?id=611" title="Percepat Realisasi Banpem Jatim, BET Lakukan Koordinasi dan Distribusi Ternak">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1662440702.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1662440702.jpeg" alt="Image">
									<h2>Percepat Realisasi Banpem Jatim, BET Lakukan Koordinasi dan Distribusi Ternak</h2>
									<p>07 September 2022</p>
								</a>
							</article><article>
								<a href="./news-detail.php?id=609" title="Digitalisasi Identitas Ternak, BET Hadiri Bimtek Penandaan dan Pendataan Ternak di Banten">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1662436022.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1662436022.jpeg" alt="Image">
									<h2>Digitalisasi Identitas Ternak, BET Hadiri Bimtek Penandaan dan Pendataan Ternak di Banten</h2>
									<p>02 September 2022</p>
								</a>
							</article><article>
								<a href="./news-detail.php?id=608" title="BET, Data Ternak Digital Pasca Vaksinasi">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1661931626.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1661931626.jpeg" alt="Image">
									<h2>BET, Data Ternak Digital Pasca Vaksinasi</h2>
									<p>31 Agustus 2022</p>
								</a>
							</article><article>
								<a href="./news-detail.php?id=606" title="BET Ikuti Remote Evaluation SNI Award 2022">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1661930832.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1661930832.jpeg" alt="Image">
									<h2>BET Ikuti Remote Evaluation SNI Award 2022</h2>
									<p>30 Agustus 2022</p>
								</a>
							</article><article>
								<a href="./news-detail.php?id=605" title="BET Cipelang raih penghargaan dari KPPN Bogor">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1661918772.png" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1661918772.png" alt="Image">
									<h2>BET Cipelang raih penghargaan dari KPPN Bogor</h2>
									<p>11 Agustus 2022</p>
								</a>
							</article></section>
        </section>

        <a class="btn btn-block btn-primary" href="./berita.php?mod=NEWS_LIST"><svg class="svg-inline--fa fa-newspaper fa-w-18 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="newspaper" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M552 64H88c-13.255 0-24 10.745-24 24v8H24c-13.255 0-24 10.745-24 24v272c0 30.928 25.072 56 56 56h472c26.51 0 48-21.49 48-48V88c0-13.255-10.745-24-24-24zM56 400a8 8 0 0 1-8-8V144h16v248a8 8 0 0 1-8 8zm236-16H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm-208-96H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm0-96H140c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h360c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12z"></path></svg><!-- <i class="fas fa-fw fa-newspaper"></i> Font Awesome fontawesome.com --> Lihat Semua
            Berita</a>

        <hr>

        <section>
            
            <div class="stok-embrio">
                <div class="header-top">
                    <img src="./assets/img/stok-embrio-header-top.jpg" alt="header">
                </div>
                <div class="header-bottom">
                 
                    <h4 align="center">STOK EMBRIO</h4>
                    <h5 align="center">PER 13 Oktober 2022</h5>
                </div>
                <div class="stock-list">
                                    <div class="row">
                        <div>1</div>
                        <div>Frisian Holstein</div>
                        <div>31</div>
                    </div>

                                    <div class="row">
                        <div>2</div>
                        <div>Limousin</div>
                        <div>69</div>
                    </div>

                                    <div class="row">
                        <div>3</div>
                        <div>Simmental</div>
                        <div>245</div>
                    </div>

                                    <div class="row">
                        <div>4</div>
                        <div>Angus</div>
                        <div>156</div>
                    </div>

                                    <div class="row">
                        <div>5</div>
                        <div>Brangus</div>
                        <div>3</div>
                    </div>

                                    <div class="row">
                        <div>6</div>
                        <div>Wagyu</div>
                        <div>129</div>
                    </div>

                                    <div class="row">
                        <div>7</div>
                        <div>Aceh</div>
                        <div>2</div>
                    </div>

                                </div>
            </div>

        </section>
        <hr>

        <h1><svg class="svg-inline--fa fa-map-marker-alt fa-w-12 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path></svg><!-- <i class="fas fa-fw fa-map-marker-alt"></i> Font Awesome fontawesome.com --> Lokasi Kami</h1>
        <section>
            <div>
                <a data-fslightbox="map" href="./assets/img/peta-betcipelang.jpg"> <img class="peta-betcipelang" src="./assets/img/peta-betcipelang-small.jpg" data-src="./assets/img/peta-betcipelang-small.jpg" alt="Peta"> </a>
                <a class="btn btn-block btn-primary" target="_blank" href="https://goo.gl/maps/WjSLF2fLKN72"><svg class="svg-inline--fa fa-map-marked-alt fa-w-18 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marked-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M288 0c-69.59 0-126 56.41-126 126 0 56.26 82.35 158.8 113.9 196.02 6.39 7.54 17.82 7.54 24.2 0C331.65 284.8 414 182.26 414 126 414 56.41 357.59 0 288 0zm0 168c-23.2 0-42-18.8-42-42s18.8-42 42-42 42 18.8 42 42-18.8 42-42 42zM20.12 215.95A32.006 32.006 0 0 0 0 245.66v250.32c0 11.32 11.43 19.06 21.94 14.86L160 448V214.92c-8.84-15.98-16.07-31.54-21.25-46.42L20.12 215.95zM288 359.67c-14.07 0-27.38-6.18-36.51-16.96-19.66-23.2-40.57-49.62-59.49-76.72v182l192 64V266c-18.92 27.09-39.82 53.52-59.49 76.72-9.13 10.77-22.44 16.95-36.51 16.95zm266.06-198.51L416 224v288l139.88-55.95A31.996 31.996 0 0 0 576 426.34V176.02c0-11.32-11.43-19.06-21.94-14.86z"></path></svg><!-- <i class="fas fa-fw fa-map-marked-alt"></i> Font Awesome fontawesome.com --> Lihat di Google Map</a>
            </div>
        </section>

        <hr>

        <h2><svg class="svg-inline--fa fa-exclamation-triangle fa-w-18 fa-fw danger" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"></path></svg><!-- <i class="fas fa-fw fa-exclamation-triangle danger"></i> Font Awesome fontawesome.com --> Tidak puas dengan pelayanan kami? klik berikut:
        </h2>

        <section class="two-col">
            <a target="_blank" href="https://lapor.go.id/">
                <img src="./assets/img/link/laporgoid.jpeg" alt="Lapor!">
            </a>
            <a target="_blank" href="https://saberpungli.id/">
                <img src="./assets/img/link/saber-pungli.png" alt="SABERPUNGLI">
            </a>
        </section>

        <section class="three-col">
            <a target="_blank" href="https://fungsional.pertanian.go.id/">
                <img src="./assets/img/beti/dupak.png" alt="Dupak">
            </a>
            <a target="_blank" href="https://epersonal.pertanian.go.id/login/">
                <img src="./assets/img/beti/e-personal.png" alt="e-Personal">
            </a>
            <!-- <a target="_blank" href="https://sibeti.ditjenpkh.pertanian.go.id/monev/admin/login">
                <img src="./assets/img/beti/pengendalian_bety.png" alt="Pengendalian Bety">
            </a> -->
        </section>

    </main>
    
    <aside>
        <section>
            <a target="_blank" href="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/logo-aksesbilitas.jpeg" data-tippy-content="Klik untuk Informasi dan Pelayanan"><img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/logo-aksesbilitas.jpeg" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/logo-aksesbilitas.jpeg" alt=""></a>
            <!-- <p class="success"><strong>Website Ramah Aksesbilitas</strong></p> -->
        </section>
        <section>
            <h4><a href="">Layanan Pelanggan <strong>SiscoBETI</strong></a></h4>
            <a target="_blank" href="https://sibeti.ditjenpkh.pertanian.go.id/siscobeti/front" data-tippy-content="Klik untuk Informasi dan Pelayanan"><img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/beti/Sisco-BETI.png" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/beti/Sisco-BETI.png" alt=""></a>
            <p class="success"><strong>Butuh Benih dan Bibit?<br>Kami Siap Melayani!</strong></p>
        </section>

        <section>
            <h4><a href="">Layanan Data <strong>SiBETI</strong></a></h4>
            <a target="_blank" href="https://sibeti.ditjenpkh.pertanian.go.id/"><img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/beti/sibeti.png" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/beti/sibeti.png" alt=""></a>
        </section>

        <!--<section>
            <h4><a href=""><strong>Pengendalian Beti</strong></a></h4>
            <a target="_blank" href="https://sibeti.ditjenpkh.pertanian.go.id/monev"><img src="./assets/img/img-fake.png" data-src="./assets/img/beti/pengendalian_bety.png" alt=""></a>
        </section>-->

        <section>
            <h4><a href=""><strong>Cuti/Ijin Online</strong></a></h4>
            <a target="_blank" href="https://betcipelang.ditjenpkh.pertanian.go.id/hrd/"><img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/beti/logo-cuti.jpeg" height="100px" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/beti/logo-cuti.jpeg" alt=""></a>
        </section>

        <section>
            <h4><a href=""><svg class="svg-inline--fa fa-poll-h fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="poll-h" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M448 432V80c0-26.5-21.5-48-48-48H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48zM112 192c-8.84 0-16-7.16-16-16v-32c0-8.84 7.16-16 16-16h128c8.84 0 16 7.16 16 16v32c0 8.84-7.16 16-16 16H112zm0 96c-8.84 0-16-7.16-16-16v-32c0-8.84 7.16-16 16-16h224c8.84 0 16 7.16 16 16v32c0 8.84-7.16 16-16 16H112zm0 96c-8.84 0-16-7.16-16-16v-32c0-8.84 7.16-16 16-16h64c8.84 0 16 7.16 16 16v32c0 8.84-7.16 16-16 16h-64z"></path></svg><!-- <i class="fas fa-fw fa-poll-h"></i> Font Awesome fontawesome.com --> Survei Kepuasan Pelanggan</a></h4>
            <a class="survey" target="_blank" href="https://ikm.pertanian.go.id/?u=EO" data-tippy-content="Yuk bantu tingkatkan kualitas kami">
                <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/beti/bety-1.png" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/beti/bety-1.png" alt="Survei">
            </a>
            <p class="primary"><strong>Masukan dari Anda untuk meningkatkan kualitas pelayanan kami</strong></p>
        </section>

        <section>
            <h4><svg class="svg-inline--fa fa-calendar-alt fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg><!-- <i class="fas fa-fw fa-calendar-alt"></i> Font Awesome fontawesome.com --> Agenda Kegiatan</h4>
            <div id="agenda" class=" NavShow-true DateTimeShow-true DateTimeFormat-mmm, yyyy NavShow-true DateTimeShow-true DateTimeFormat-mmm, yyyy"><div class="cld-main"><div class="cld-datetime"><div class=" cld-rwd cld-nav"><svg height="15" width="15" viewBox="0 0 75 100" fill="rgba(0,0,0,0.5)"><polyline points="0,50 75,0 75,100"></polyline></svg></div><div class=" today">Oktober, 2022</div><div class=" cld-fwd cld-nav"><svg height="15" width="15" viewBox="0 0 75 100" fill="rgba(0,0,0,0.5)"><polyline points="0,0 75,50 0,100"></polyline></svg></div></div><ul class="cld-labels"><li class="cld-label">Min</li><li class="cld-label">Sen</li><li class="cld-label">Sel</li><li class="cld-label">Rab</li><li class="cld-label">Kam</li><li class="cld-label">Jum</li><li class="cld-label">Sab</li></ul><ul class="cld-days"><li class="cld-day prevMonth"><p class="cld-number">25</p></li><li class="cld-day prevMonth"><p class="cld-number">26</p></li><li class="cld-day prevMonth"><p class="cld-number">27</p></li><li class="cld-day prevMonth"><p class="cld-number">28</p></li><li class="cld-day prevMonth"><p class="cld-number">29</p></li><li class="cld-day prevMonth"><p class="cld-number">30</p></li><li class="cld-day currMonth"><p class="cld-number">1</p></li><li class="cld-day currMonth"><p class="cld-number">2</p></li><li class="cld-day currMonth"><p class="cld-number">3</p></li><li class="cld-day currMonth"><p class="cld-number eventday">4<span class="cld-title"><a href="#">Distribusi banpem Rumpot di Kab Trenggalek</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">5<span class="cld-title"><a href="#">Distribusi banpem Rumpot di Kab Trenggalek</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">6<span class="cld-title"><a href="#">Distribusi banpem Rumpot di Kab Trenggalek</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">7<span class="cld-title"><a href="#">Distribusi banpem Rumpot di Kab Trenggalek</a></span></p></li><li class="cld-day currMonth"><p class="cld-number">8</p></li><li class="cld-day currMonth"><p class="cld-number">9</p></li><li class="cld-day currMonth"><p class="cld-number">10</p></li><li class="cld-day currMonth"><p class="cld-number eventday">11<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Jombang</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">12<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Jombang</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">13<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Jombang</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">14<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Jombang</a></span></p></li><li class="cld-day currMonth"><p class="cld-number">15</p></li><li class="cld-day currMonth"><p class="cld-number">16</p></li><li class="cld-day currMonth"><p class="cld-number">17</p></li><li class="cld-day currMonth"><p class="cld-number eventday">18<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di Kab Nganjuk</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">19<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di Kab Nganjuk</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">20<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di Kab Nganjuk</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">21<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di Kab Nganjuk</a></span></p></li><li class="cld-day currMonth"><p class="cld-number">22</p></li><li class="cld-day currMonth"><p class="cld-number">23</p></li><li class="cld-day currMonth today"><p class="cld-number">24</p></li><li class="cld-day currMonth"><p class="cld-number eventday">25<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Kediri Tahap I</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">26<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Kediri Tahap I</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">27<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Kediri Tahap I</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">28<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Kediri Tahap I</a></span></p></li><li class="cld-day currMonth"><p class="cld-number">29</p></li><li class="cld-day currMonth"><p class="cld-number">30</p></li><li class="cld-day currMonth"><p class="cld-number">31</p></li><li class="cld-day nextMonth"><p class="cld-number">1</p></li><li class="cld-day nextMonth"><p class="cld-number">2</p></li><li class="cld-day nextMonth"><p class="cld-number">3</p></li><li class="cld-day nextMonth"><p class="cld-number">4</p></li><li class="cld-day nextMonth"><p class="cld-number">5</p></li></ul></div><div class="cld-main"><div class="cld-datetime"><div class=" cld-rwd cld-nav"><svg height="15" width="15" viewBox="0 0 75 100" fill="rgba(0,0,0,0.5)"><polyline points="0,50 75,0 75,100"></polyline></svg></div><div class=" today">Oktober, 2022</div><div class=" cld-fwd cld-nav"><svg height="15" width="15" viewBox="0 0 75 100" fill="rgba(0,0,0,0.5)"><polyline points="0,0 75,50 0,100"></polyline></svg></div></div><ul class="cld-labels"><li class="cld-label">Min</li><li class="cld-label">Sen</li><li class="cld-label">Sel</li><li class="cld-label">Rab</li><li class="cld-label">Kam</li><li class="cld-label">Jum</li><li class="cld-label">Sab</li></ul><ul class="cld-days"><li class="cld-day prevMonth"><p class="cld-number">25</p></li><li class="cld-day prevMonth"><p class="cld-number">26</p></li><li class="cld-day prevMonth"><p class="cld-number">27</p></li><li class="cld-day prevMonth"><p class="cld-number">28</p></li><li class="cld-day prevMonth"><p class="cld-number">29</p></li><li class="cld-day prevMonth"><p class="cld-number">30</p></li><li class="cld-day currMonth"><p class="cld-number">1</p></li><li class="cld-day currMonth"><p class="cld-number">2</p></li><li class="cld-day currMonth"><p class="cld-number">3</p></li><li class="cld-day currMonth"><p class="cld-number eventday">4<span class="cld-title"><a href="#">Distribusi banpem Rumpot di Kab Trenggalek</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">5<span class="cld-title"><a href="#">Distribusi banpem Rumpot di Kab Trenggalek</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">6<span class="cld-title"><a href="#">Distribusi banpem Rumpot di Kab Trenggalek</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">7<span class="cld-title"><a href="#">Distribusi banpem Rumpot di Kab Trenggalek</a></span></p></li><li class="cld-day currMonth"><p class="cld-number">8</p></li><li class="cld-day currMonth"><p class="cld-number">9</p></li><li class="cld-day currMonth"><p class="cld-number">10</p></li><li class="cld-day currMonth"><p class="cld-number eventday">11<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Jombang</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">12<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Jombang</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">13<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Jombang</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">14<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Jombang</a></span></p></li><li class="cld-day currMonth"><p class="cld-number">15</p></li><li class="cld-day currMonth"><p class="cld-number">16</p></li><li class="cld-day currMonth"><p class="cld-number">17</p></li><li class="cld-day currMonth"><p class="cld-number eventday">18<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di Kab Nganjuk</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">19<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di Kab Nganjuk</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">20<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di Kab Nganjuk</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">21<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di Kab Nganjuk</a></span></p></li><li class="cld-day currMonth"><p class="cld-number">22</p></li><li class="cld-day currMonth"><p class="cld-number">23</p></li><li class="cld-day currMonth today"><p class="cld-number">24</p></li><li class="cld-day currMonth"><p class="cld-number eventday">25<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Kediri Tahap I</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">26<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Kediri Tahap I</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">27<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Kediri Tahap I</a></span></p></li><li class="cld-day currMonth"><p class="cld-number eventday">28<span class="cld-title"><a href="#">Distribusi Banpem Rumpot di kab Kediri Tahap I</a></span></p></li><li class="cld-day currMonth"><p class="cld-number">29</p></li><li class="cld-day currMonth"><p class="cld-number">30</p></li><li class="cld-day currMonth"><p class="cld-number">31</p></li><li class="cld-day nextMonth"><p class="cld-number">1</p></li><li class="cld-day nextMonth"><p class="cld-number">2</p></li><li class="cld-day nextMonth"><p class="cld-number">3</p></li><li class="cld-day nextMonth"><p class="cld-number">4</p></li><li class="cld-day nextMonth"><p class="cld-number">5</p></li></ul></div></div>
        </section>

        <section>
            <h4><svg class="svg-inline--fa fa-chart-line fa-w-16 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-line" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M496 384H64V80c0-8.84-7.16-16-16-16H16C7.16 64 0 71.16 0 80v336c0 17.67 14.33 32 32 32h464c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zM464 96H345.94c-21.38 0-32.09 25.85-16.97 40.97l32.4 32.4L288 242.75l-73.37-73.37c-12.5-12.5-32.76-12.5-45.25 0l-68.69 68.69c-6.25 6.25-6.25 16.38 0 22.63l22.62 22.62c6.25 6.25 16.38 6.25 22.63 0L192 237.25l73.37 73.37c12.5 12.5 32.76 12.5 45.25 0l96-96 32.4 32.4c15.12 15.12 40.97 4.41 40.97-16.97V112c.01-8.84-7.15-16-15.99-16z"></path></svg><!-- <i class="fas fa-fw fa-chart-line"></i> Font Awesome fontawesome.com --> Timeline Kegiatan</h4>
            <div class="swiper-container swiper-container-initialized swiper-container-horizontal">
                <div class="swiper-wrapper" style="transform: translate3d(-900px, 0px, 0px); transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="2" style="width: 300px;">
								<a data-fslightbox="timeline" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618198087.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618198087.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618198087.jpeg" alt="timeline">
								</a>
							</div>
			<div class="swiper-slide swiper-slide-duplicate-next" data-swiper-slide-index="0" style="width: 300px;">
								<a data-fslightbox="timeline" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618276655.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618276655.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618276655.jpeg" alt="timeline">
								</a>
							</div>
							<div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="1" style="width: 300px;">
								<a data-fslightbox="timeline" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617768033.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617768033.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617768033.jpeg" alt="timeline">
								</a>
							</div>
							<div class="swiper-slide swiper-slide-active" data-swiper-slide-index="2" style="width: 300px;">
								<a data-fslightbox="timeline" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618198087.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618198087.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618198087.jpeg" alt="timeline">
								</a>
							</div>
							<div class="swiper-slide swiper-slide-duplicate swiper-slide-next" data-swiper-slide-index="0" style="width: 300px;">
								<a data-fslightbox="timeline" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618276655.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618276655.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618276655.jpeg" alt="timeline">
								</a>
							</div></div>                <div class="swiper-scrollbar"><div class="swiper-scrollbar-drag" style="transform: translate3d(176.4px, 0px, 0px); transition-duration: 0ms; width: 58.8px;"></div></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span><span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
        </section>

        <section>
            <h4><svg class="svg-inline--fa fa-chart-bar fa-w-16 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-bar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M332.8 320h38.4c6.4 0 12.8-6.4 12.8-12.8V172.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v134.4c0 6.4 6.4 12.8 12.8 12.8zm96 0h38.4c6.4 0 12.8-6.4 12.8-12.8V76.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v230.4c0 6.4 6.4 12.8 12.8 12.8zm-288 0h38.4c6.4 0 12.8-6.4 12.8-12.8v-70.4c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v70.4c0 6.4 6.4 12.8 12.8 12.8zm96 0h38.4c6.4 0 12.8-6.4 12.8-12.8V108.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v198.4c0 6.4 6.4 12.8 12.8 12.8zM496 384H64V80c0-8.84-7.16-16-16-16H16C7.16 64 0 71.16 0 80v336c0 17.67 14.33 32 32 32h464c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16z"></path></svg><!-- <i class="fas fa-fw fa-chart-bar"></i> Font Awesome fontawesome.com --> Grafik</h4>
            <div class="swiper-container swiper-container-initialized swiper-container-horizontal">
                <div class="swiper-wrapper" style="transform: translate3d(-900px, 0px, 0px); transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="7" style="width: 300px;">
								<a data-fslightbox="grafik" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618199033.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618199033.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618199033.jpeg" alt="grafik">
								</a>
							</div>
			<div class="swiper-slide" data-swiper-slide-index="0" style="width: 300px;">
								<a data-fslightbox="grafik" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617781058.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617781058.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617781058.jpeg" alt="grafik">
								</a>
							</div>
							<div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="1" style="width: 300px;">
								<a data-fslightbox="grafik" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618144844.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618144844.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618144844.jpeg" alt="grafik">
								</a>
							</div>
							<div class="swiper-slide swiper-slide-active" data-swiper-slide-index="2" style="width: 300px;">
								<a data-fslightbox="grafik" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617867133.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617867133.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617867133.jpeg" alt="grafik">
								</a>
							</div>
							<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="3" style="width: 300px;">
								<a data-fslightbox="grafik" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617769830.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617769830.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617769830.jpeg" alt="grafik">
								</a>
							</div>
							<div class="swiper-slide" data-swiper-slide-index="4" style="width: 300px;">
								<a data-fslightbox="grafik" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617769189.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617769189.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617769189.jpeg" alt="grafik">
								</a>
							</div>
							<div class="swiper-slide" data-swiper-slide-index="5" style="width: 300px;">
								<a data-fslightbox="grafik" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618195075.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618195075.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618195075.jpeg" alt="grafik">
								</a>
							</div>
							<div class="swiper-slide" data-swiper-slide-index="6" style="width: 300px;">
								<a data-fslightbox="grafik" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618195507.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618195507.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618195507.jpeg" alt="grafik">
								</a>
							</div>
							<div class="swiper-slide" data-swiper-slide-index="7" style="width: 300px;">
								<a data-fslightbox="grafik" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618199033.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618199033.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1618199033.jpeg" alt="grafik">
								</a>
							</div>
							<div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="width: 300px;">
								<a data-fslightbox="grafik" href="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617781058.jpeg" data-type="image">
									<img src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617781058.jpeg" data-src="https://repo-betcipelang.ditjenpkh.pertanian.go.id/public/uploads/1617781058.jpeg" alt="grafik">
								</a>
							</div></div>                <div class="swiper-scrollbar"><div class="swiper-scrollbar-drag" style="transform: translate3d(88.2px, 0px, 0px); transition-duration: 0ms; width: 29.4px;"></div></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span><span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
        </section>

        <section>
            <h4>Whistleblower's System</h4>
            <a target="_blank" href="https://www.pertanian.go.id/wbs/">
                <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/wbs.png" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/wbs.png" alt="Whistleblower's System">
            </a>
        </section>

        <section>
            <h4>Tata Naskah Dinas</h4>
            <a target="_blank" href="https://tunak-online.com/login">
                <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/simas.png" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/simas.png" alt="Simas">
            </a>
            <a target="_blank" href="https://lpse.pertanian.go.id/eproc4">
                <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/lpse.png" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/lpse.png" alt="Simas">
            </a>
        </section>

        <section>
            <a target="_blank" href="https://sigap-upg.pertanian.go.id/">
                <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/sigap_protani.jpeg" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/sigap_protani.jpeg" alt="UPG Sigap">
            </a>
            <a target="_blank" href="https://dumas.pertanian.go.id/">
                <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/kaldu_emas.png" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/kaldu_emas.png" alt="Kaldu Emas">
            </a>
            <a target="_blank" href="./page-detail.php?id=55">
                <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/link_directory.png" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/link_directory.png" alt="Direktori">
            </a>
            <a target="_blank" href="https://betcipelang-ditjennak-ppid.pertanian.go.id/">
                <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/ppid_bet.png" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/ppid_bet.png" alt="PPID BET">
            </a>
            <a target="_blank" href="https://esakip.pertanian.go.id/">
                <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/e-sakip.jpeg" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/e-sakip.jpeg" alt="E-SAKIP">
            </a>
            <a target="_blank" href="https://linktr.ee/betcipelang">
                <img src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/logo-linktree.jpeg" data-src="https://betcipelang.ditjenpkh.pertanian.go.id/newsite/assets/img/link/logo-linktree.jpeg" alt="Link Tree">
            </a>
        </section>

    </aside>