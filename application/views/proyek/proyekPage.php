<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Proyek dan Lokasi</h1>
    
    <!-- Form Filter -->
    <form id="filterForm" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="text" id="filterNamaProyek" class="form-control" placeholder="Nama Proyek">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary" onclick="applyFilter()">Filter</button>
                <button type="button" class="btn btn-secondary" onclick="resetFilter()">Reset</button>
            </div>
        </div>
    </form>
    
    <button class="btn btn-primary mb-4" onclick="location.href='<?= site_url('proyek/tambahProyek'); ?>'">Tambah Proyek atau Lokasi Baru</button>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Proyek</th>
                <th>Client</th>
                <th>Pimpinan Proyek</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="data-list">
            <?php if (!empty($proyek)): ?>
                <?php foreach ($proyek as $project): ?>
                    <tr class="project-row" 
                        data-nama-proyek="<?= htmlspecialchars($project['namaProyek'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                        data-tgl-mulai="<?= htmlspecialchars($project['tglMulai'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                        data-tgl-selesai="<?= htmlspecialchars($project['tglSelesai'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        <td><?= htmlspecialchars($project['namaProyek'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($project['client'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($project['pimpinanProyek'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <?php if (!empty($project['tglMulai'])): ?>
                                <?= htmlspecialchars(date('d-m-Y', strtotime($project['tglMulai'])), ENT_QUOTES, 'UTF-8'); ?>
                            <?php else: ?>
                                <em>Belum tersedia</em>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($project['tglSelesai'])): ?>
                                <?= htmlspecialchars(date('d-m-Y', strtotime($project['tglSelesai'])), ENT_QUOTES, 'UTF-8'); ?>
                            <?php else: ?>
                                <em>Belum tersedia</em>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($project['keterangan'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <a href="<?= site_url('proyek/editProyek/'.$project['proyekId']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $project['proyekId']; ?>)">Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Tidak ada data proyek.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    const rows = document.querySelectorAll('.project-row');

    function applyFilter() {
        const namaProyek = document.getElementById('filterNamaProyek').value.toLowerCase();

        rows.forEach(row => {
            const rowNamaProyek = row.dataset.namaProyek.toLowerCase();

            const isNamaProyekMatch = rowNamaProyek.includes(namaProyek);

            if (isNamaProyekMatch) {
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
            window.location.href = `<?= site_url('proyek/deleteProyek/'); ?>${id}`;
        }
    }
</script>

</body>
</html>
