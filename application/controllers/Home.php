<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {

        $data['judul'] = 'Halaman Home';
        $this->load->view('components/header', $data);
        $this->load->view('components/footer');
        $this->load->view('home/index');
    }

    public function daftarProyek() {
        // URL API
        $api_url = 'http://localhost:8081/proyek-lokasi';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $data['projects'] = json_decode($response, true);
        $this->load->view('home/daftarProyek', $data);
    }  
}
