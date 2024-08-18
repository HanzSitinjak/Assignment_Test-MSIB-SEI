<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }


    public function index() {
        $api_url = 'http://localhost:8081/lokasi';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $data['lokasi'] = json_decode($response, true);
        $this->load->view('lokasi/lokasiPage', $data);
    }

    public function tambahLokasi() {
        $this->load->view('lokasi/addLokasi');
    }

    public function simpanLokasi() {
        $namaLokasi = $this->input->post('namaLokasi');
        $negara = $this->input->post('negara');
        $provinsi = $this->input->post('provinsi');
        $kota = $this->input->post('kota');
        
        $api_url = 'http://localhost:8081/lokasi';
        
        $data = array(
            'namaLokasi' => $namaLokasi,
            'negara' => $negara,
            'provinsi' => $provinsi,
            'kota' => $kota
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 201) {
            redirect('lokasi');
        } else {
            $data['error'] = 'Gagal menambahkan data. Silakan coba lagi.';
            $this->load->view('lokasi/addLokasi', $data);
        }
    }

    public function editLokasi($id) {
        $api_url = 'http://localhost:8081/lokasi/' . $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $data['lokasi'] = json_decode($response, true);
        
        if ($data['lokasi'] == null) {
            show_404();
        }

        $this->load->view('lokasi/editLokasi', $data);
    }

    public function updateLokasi($id) {
        $namaLokasi = $this->input->post('namaLokasi');
        $negara = $this->input->post('negara');
        $provinsi = $this->input->post('provinsi');
        $kota = $this->input->post('kota');

        $api_url = 'http://localhost:8081/lokasi/' . $id;

        $data = array(
            'namaLokasi' => $namaLokasi,
            'negara' => $negara,
            'provinsi' => $provinsi,
            'kota' => $kota
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 200) {
            $this->session->set_flashdata('message', 'Data berhasil Diubah');
            redirect('lokasi');
        } else {
            $data['error'] = 'Gagal mengedit data. Silakan coba lagi.';
            $this->load->view('lokasi/editLokasi', $data);
        }
    }

    public function deleteLokasi($id) {
        $api_url = 'http://localhost:8081/lokasi/' . $id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 200) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Gagal menghapus data. Silakan coba lagi.');
        }
        redirect('lokasi');
    }
}
