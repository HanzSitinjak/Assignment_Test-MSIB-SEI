<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('curl');
        $this->load->library('session'); 
    }

    public function index() {
        $api_url = 'http://localhost:8081/proyek';
        $response = $this->curl->simple_get($api_url);

        $data['proyek'] = json_decode($response, true);
        
        if ($data['proyek'] == null) {
            $data['proyek'] = [];
        }

        $this->load->view('proyek/proyekPage', $data);
    }

    public function tambahProyek() {
        $api_url = 'http://localhost:8081/lokasi';
        $response = $this->curl->simple_get($api_url);
    
        $data['lokasi'] = json_decode($response, true);
    
        $this->load->view('proyek/addProyek', $data);
    }

    public function simpanProyek() {
        $namaProyek = $this->input->post('namaProyek');
        $client = $this->input->post('client');
        $tglMulai = $this->input->post('tglMulai');
        $tglSelesai = $this->input->post('tglSelesai');
        $pimpinanProyek = $this->input->post('pimpinanProyek');
        $keterangan = $this->input->post('keterangan');
        $lokasiId = $this->input->post('lokasiId'); 

        // Format data untuk disimpan ke proyek, tambahkan lokasiId
        $dataProyek = array(
            'namaProyek' => $namaProyek,
            'client' => $client,
            'tglMulai' => $tglMulai . 'T00:00:00', 
            'tglSelesai' => $tglSelesai . 'T00:00:00', 
            'pimpinanProyek' => $pimpinanProyek,
            'keterangan' => $keterangan,
            'lokasiId' => $lokasiId,
        );

        // Simpan proyek ke endpoint /proyek
        $api_url_proyek = 'http://localhost:8081/proyek';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url_proyek);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataProyek));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 200 || $http_code == 201) {
            $proyek = json_decode($response, true);
            $proyekId = $proyek['id']; // Asumsi respons API mengembalikan ID proyek

            // Simpan proyek-lokasi ke endpoint /proyek-lokasi
            $dataProyekLokasi = array(
                'proyekId' => $proyekId,
                'lokasiId' => $lokasiId
            );

            $api_url_proyek_lokasi = 'http://localhost:8081/proyek-lokasi';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_url_proyek_lokasi);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataProyekLokasi));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
            }
            
            curl_close($ch);

            // Redirect ke halaman proyek dengan pesan sukses
            $this->session->set_flashdata('success', 'Data proyek berhasil ditambahkan.');
            redirect('proyek');
        } else {
            // Jika gagal, tampilkan pesan error
            $this->session->set_flashdata('error', 'Gagal menyimpan data proyek.');
            redirect('proyek/tambahProyek');
        }
    }

    public function editProyek($id) {
        $api_url = 'http://localhost:8081/proyek/' . $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $data['proyek'] = json_decode($response, true);
        
        // Periksa apakah $data['proyek'] valid
        if ($data['proyek'] === null || !isset($data['proyek']['proyekId'])) {
            show_404(); // Tampilkan halaman 404 jika tidak ada data
        } else {
            // Convert tanggal dari string ke format yang diinginkan
            if (isset($data['proyek']['tglMulai']) && $data['proyek']['tglMulai']) {
                $data['proyek']['tglMulai'] = (new DateTime($data['proyek']['tglMulai']))->format('d/m/Y');
            } else {
                $data['proyek']['tglMulai'] = ''; // Atur ke string kosong jika tidak ada
            }
            
            if (isset($data['proyek']['tglSelesai']) && $data['proyek']['tglSelesai']) {
                $data['proyek']['tglSelesai'] = (new DateTime($data['proyek']['tglSelesai']))->format('d/m/Y');
            } else {
                $data['proyek']['tglSelesai'] = ''; // Atur ke string kosong jika tidak ada
            }
        }
    
        $this->load->view('proyek/editProyek', $data);
    }
    
    public function updateProyek($id) {
        // Ambil data dari form
        $update_data = array(
            'namaProyek' => $this->input->post('namaProyek'),
            'client' => $this->input->post('client'),
            'lokasiId' => $this->input->post('lokasiId'),
            'tglMulai' => $this->input->post('tglMulai') . 'T00:00:00', // Format tanggal sesuai kebutuhan
            'tglSelesai' => $this->input->post('tglSelesai') . 'T00:00:00', // Format tanggal sesuai kebutuhan
            'pimpinanProyek' => $this->input->post('pimpinanProyek'),
            'keterangan' => $this->input->post('keterangan')
        );
        
        $api_url = 'http://localhost:8081/proyek/' . $id;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Menggunakan metode PUT
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($update_data)); // Mengirim data dalam format JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Mendapatkan kode status HTTP
        curl_close($ch);
        
        if ($http_code == 200) {
            // Jika berhasil
            $this->session->set_flashdata('message', 'Data berhasil Diubah');
            redirect('proyek'); // Redirect ke halaman proyek
        } else {
            // Jika gagal
            $data['error'] = 'Gagal mengedit data. Silakan coba lagi.';
            // Menampilkan kembali form edit dengan pesan error
            $this->load->view('proyek/editProyek', $data);
        }
    }
    

    public function deleteProyek($id) {
        $api_url = 'http://localhost:8081/proyek/' . $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 204) {
            $this->session->set_flashdata('success', 'Proyek berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus proyek.');
        }

        redirect('proyek');
    }
}
