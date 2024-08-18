<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Proyek</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Tambah Proyek</h1>
    
    <form action="<?= site_url('proyek/simpanProyek'); ?>" method="POST">
        <div class="mb-3">
            <label for="namaProyek" class="form-label">Nama Proyek</label>
            <input type="text" class="form-control" id="namaProyek" name="namaProyek" required>
        </div>
        <div class="mb-3">
            <label for="client" class="form-label">Client</label>
            <input type="text" class="form-control" id="client" name="client" required>
        </div>
        <div class="mb-3">
            <label for="lokasiId" class="form-label">Lokasi</label>
            <select name="lokasiId" class="form-control" id="lokasiId" required>
                <option value="">Pilih Lokasi</option>
                <?php foreach ($lokasi as $loc): ?>
                    <option value="<?= htmlspecialchars($loc['lokasiId'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?= htmlspecialchars($loc['lokasiId'] . ' - ' . $loc['namaLokasi'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="tglMulai" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" id="tglMulai" name="tglMulai" required>
        </div>
        <div class="mb-3">
            <label for="tglSelesai" class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" id="tglSelesai" name="tglSelesai" required>
        </div>
        <div class="mb-3">
            <label for="pimpinanProyek" class="form-label">Pimpinan Proyek</label>
            <input type="text" class="form-control" id="pimpinanProyek" name="pimpinanProyek" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>
