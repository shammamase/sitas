<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Anggaran extends CI_Controller {
	public function index(){
		echo "ini index";
	}

    public function import_adk(){
        $this->load->view('anggaran/import_adk');
    }

    public function proses_adk(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the file was uploaded without errors
            if (isset($_FILES["filex"]) && $_FILES["filex"]["error"] == 0) {
                $targetDir = "asset/file_lainnya/file_adk/";
                $targetFile = $targetDir . basename($_FILES["filex"]["name"]);
                $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
        
                // Check if the file is a zip file
                /*
                if ($fileType == "zip") {
                    // Move the uploaded file to the specified directory
                    if (move_uploaded_file($_FILES["filex"]["tmp_name"], $targetFile)) {
                        echo "The file " . basename($_FILES["filex"]["name"]) . " telah di upload";
                    } else {
                        echo "Maaf, terjadi kesalahan saat mengunggah file Anda";
                    }
                } else {
                    echo "Harap Upload File Zip yang valid";
                }
                */

                if (move_uploaded_file($_FILES["filex"]["tmp_name"], $targetFile)) {
                    echo "The file " . basename($_FILES["filex"]["name"]) . " telah di upload";
                } else {
                    echo "Maaf, terjadi kesalahan saat mengunggah file Anda";
                }
            } else {
                echo "Terjadi kesalahan saat upload file";
            }
            print_r($_FILES);
        }
    }

    public function rubah_ekstensi(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $target_dir = "asset/file_lainnya/file_adk/";
            $target_file = $target_dir . basename($_FILES["filex"]["name"]);
            $uploadOk = 1;

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "File sudah ada.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            //$allowed_extensions = array("jpg", "jpeg", "png", "gif");
            $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);

            /*
            if (!in_array($file_extension, $allowed_extensions)) {
                echo "Hanya file dengan ekstensi JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
                $uploadOk = 0;
            }
            */

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "File tidak diupload.";
            } else {
                if (move_uploaded_file($_FILES["filex"]["tmp_name"], $target_file)) {
                    // File berhasil diupload, ubah ekstensi
                    $nama_file_awal = $target_file;
                    $ekstensi_baru = "png";

                    $nama_file_tanpa_ekstensi = pathinfo($nama_file_awal, PATHINFO_FILENAME);
                    $nama_file_baru = $nama_file_tanpa_ekstensi . '.' . $ekstensi_baru;

                    if (rename($nama_file_awal, $nama_file_baru)) {
                        echo 'File berhasil diupload dan ekstensi diubah dari ' . $file_extension . ' menjadi ' . $ekstensi_baru;
                    } else {
                        echo 'Gagal mengubah ekstensi file.';
                    }
                } else {
                    echo "Terjadi kesalahan saat mengupload file.";
                }
            }
        }

    }

    public function unzipx(){
        $file_zip = "asset/file_lainnya/file_adk/d_kpjm01809004508562.zip";
        $tempat_ekstrak = "asset/file_lainnya/hasil_unzip/";
        $zip = new ZipArchive;
        if ($zip->open($file_zip) === TRUE) {
            $zip->extractTo($tempat_ekstrak);
            $zip->close();
            echo 'File ZIP berhasil diekstrak.';
        } else {
            echo 'Gagal membuka file ZIP atau file ZIP rusak.';
        }
    }

    /*
    public function proses_adk(){
        $config['upload_path'] = './asset/file_lainnya/file_adk/';
        $config['allowed_types'] = 'zip|rar|s2313';
        $config['max_size'] = 10240;
        $this->load->library('upload',$config);

        if($this->upload->do_upload('filex')){
            //$data = array('upload_data' => $this->upload->data());
            $hasilth=$this->upload->data();
            $thm = $hasilth['file_name'];
            $rar = RarArchive::open($thm);
            if ($rar !== false) {
                $entries = $rar->getEntries();
                foreach ($entries as $entry) {
                    $entry->extract($hasilth['file_path']);
                }
                $rar->close();
                echo 'File RAR berhasil diekstrak.';
            } else {
                echo 'Gagal membuka file RAR atau file RAR rusak.';
            }
        } else {
            //$data = array('error' => $this->upload->display_errors());
            echo 'Gagal membuka file RAR atau file RAR rusak.';
        }
        //  print_r($data);
    }
    */
}