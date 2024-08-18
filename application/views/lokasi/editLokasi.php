<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Lokasi</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Edit Lokasi</h1>
    
    <?php if (isset($error)) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>

    <form id="editLokasiForm" method="POST" action="<?= site_url('lokasi/updateLokasi/' . $lokasi['lokasiId']); ?>">
        <div class="mb-3">
            <label for="namaLokasi" class="form-label">Nama Lokasi</label>
            <input type="text" class="form-control" id="namaLokasi" name="namaLokasi" value="<?= htmlspecialchars($lokasi['namaLokasi'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="negara" class="form-label">Negara</label>
            <input type="text" class="form-control" id="negara" name="negara" value="<?= htmlspecialchars($lokasi['negara'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="provinsi" class="form-label">Provinsi</label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?= htmlspecialchars($lokasi['provinsi'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="kota" class="form-label">Kota</label>
            <input type="text" class="form-control" id="kota" name="kota" value="<?= htmlspecialchars($lokasi['kota'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <button type="button" class="btn btn-primary" onclick="confirmUpdate()">Simpan Perubahan</button>
    </form>
</div>

<script>
    function confirmUpdate() {
        if (confirm('Apakah Anda yakin ingin mengubah data ini?')) {
            document.getElementById('editLokasiForm').submit();
        }
    }
</script>
</body>
</html>