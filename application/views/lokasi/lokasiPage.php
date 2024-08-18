<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Daftar Lokasi</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Lokasi</h1>
    
    <form id="filterForm" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="text" id="filterNamaLokasi" class="form-control" placeholder="Nama Lokasi">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary" onclick="applyFilter()">Filter</button>
                <button type="button" class="btn btn-secondary" onclick="resetFilter()">Reset</button>
            </div>
        </div>
    </form>

    <div class="button-container">
        <a href="<?= site_url('lokasi/tambahLokasi'); ?>" class="btn btn-success">Tambah Lokasi</a>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Lokasi</th>
                <th>Negara</th>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Aksi</th> 
            </tr>
        </thead>
        <tbody id="data-list">
            <?php if (!empty($lokasi)): ?>
                <?php foreach ($lokasi as $loc): ?>
                    <tr class="location-row"
                        data-nama-lokasi="<?= htmlspecialchars($loc['namaLokasi'], ENT_QUOTES, 'UTF-8'); ?>"
                        data-negara="<?= htmlspecialchars($loc['negara'], ENT_QUOTES, 'UTF-8'); ?>"
                        data-provinsi="<?= htmlspecialchars($loc['provinsi'], ENT_QUOTES, 'UTF-8'); ?>"
                        data-kota="<?= htmlspecialchars($loc['kota'], ENT_QUOTES, 'UTF-8'); ?>">
                        <td><?= htmlspecialchars($loc['namaLokasi'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($loc['negara'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($loc['provinsi'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($loc['kota'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <a href="<?= site_url('lokasi/editLokasi/'.$loc['lokasiId']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $loc['lokasiId']; ?>)">Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data lokasi.</td> 
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    const rows = document.querySelectorAll('.location-row');

    function applyFilter() {
        const namaLokasi = document.getElementById('filterNamaLokasi').value.toLowerCase();

        rows.forEach(row => {
            const rowNamaLokasi = row.dataset.namaLokasi.toLowerCase();

            const isNamaLokasiMatch = rowNamaLokasi.includes(namaLokasi);

            if (isNamaLokasiMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function resetFilter() {
        document.getElementById('filterForm').reset();
        rows.forEach(row => row.style.display = '');
    }
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = `<?= site_url('lokasi/deleteLokasi/'); ?>${id}`;
        }
    }
</script>
</body>
</html>
