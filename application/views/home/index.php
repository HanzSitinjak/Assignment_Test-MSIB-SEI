<?php $this->load->view('components/navbar'); ?>

<div class="content-wrapper">
    <div class="container">
            <h1>Welcome, Visitor</h1>
            <p>Terima kasih telah memilih layanan kami. Kami sangat menghargai kepercayaan Anda dalam menggunakan solusi kami untuk mempermudah aktivitas sehari-hari Anda. Kami berkomitmen untuk terus memberikan pengalaman yang lebih baik dan efisien, serta mendukung Anda dalam mencapai tujuan Anda dengan lebih mudah. Jika Anda memiliki saran atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
            <div class="buttons">
                <div class="button-container">
                    <a href="<?= base_url('daftarProyek'); ?>" class="button-link">Lihat Proyek</a>
                </div>
                <div class="button-container">
                    <div class="dropdown">
                        Kelola Data
                        <div class="dropdown-content">
                            <a href="<?= site_url('proyek'); ?>">Data Proyek</a>
                            <a href="<?= site_url('lokasi'); ?>">Data Lokasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="circle">
            <img src="public/assets/hero_img1.png" alt="Deskripsi Gambar">
        </div>
</div>

<?php $this->load->view('components/footer'); ?>
