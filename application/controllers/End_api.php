<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class End_api extends CI_Controller {
    public function __construct() {
        parent::__construct();
        set_cors(); // Mengatur header CORS
        header('Content-Type: application/json');
    }

    // Endpoint POST: Kirim Pesan
    public function send_message() {
        $tokenxy = "xasd091rew";
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            $this->output->set_status_header(405);
            echo json_encode(['status' => false, 'message' => 'Method Not Allowed']);
            return;
        }
        $no_hp = strip_tags($this->input->post('no_hp', TRUE));
        $pesan = strip_tags($this->input->post('pesan', TRUE));
        $token = strip_tags($this->input->post('token', TRUE));
        $no_wa = substr_replace($no_hp,"62",0,1);
        // Validasi input
        if (empty($no_hp) || empty($pesan)) {
            $this->output->set_status_header(400);
            echo json_encode(['status' => false, 'message' => 'Parameter nomor_hp dan pesan wajib diisi']);
            return;
        }
        // Simulasi pemrosesan (misalnya mengirim SMS)
        if($token == $tokenxy){
            $response = [
                'status' => true,
                'message' => 'Pesan berhasil dikirim',
                'data' => [
                    'nomor_hp' => $no_wa,
                    'pesan' => $pesan
                ]
            ];
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
            $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
        } else {
            echo json_encode(['status' => false, 'message' => 'Token salah !!!']);
        }
    }

    public function send_message_json() {
        $tokenxy = "xasd091rew";
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            $this->output->set_status_header(405);
            echo json_encode(['status' => false, 'message' => 'Method Not Allowed']);
            return;
        }
        $input = json_decode(file_get_contents('php://input'), true);
        $no_hp = $input['no_hp'];
        $pesan = $input['pesan'];
        $token = $input['token'];
        $no_wa = substr_replace($no_hp,"62",0,1);
        // Validasi input
        if (!isset($input['no_hp']) || !isset($input['pesan'])) {
            $this->output->set_status_header(400);
            echo json_encode(['status' => false, 'message' => 'Parameter nomor_hp dan pesan wajib diisi']);
            return;
        }
        // Simulasi pemrosesan (misalnya mengirim SMS)
        if($token == $tokenxy){
            $response = [
                'status' => true,
                'message' => 'Pesan berhasil dikirim',
                'data' => [
                    'nomor_hp' => $no_wa,
                    'pesan' => $pesan
                ]
            ];
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
            $this->model_sitas->kirim_wa_gateway($no_wa,$pesan);
        } else {
            echo json_encode(['status' => false, 'message' => 'Token salah !!!']);
        }
    }
}