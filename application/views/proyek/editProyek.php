<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Proyek</title>
</head>
<body>
    <div class="container">
        <h1>Edit Proyek</h1>

        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($this->session->flashdata('message'), ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <?php echo form_open('proyek/updateProyek/' . $proyek['proyekId']); ?>
        
        <div class="mb-3">
            <label for="namaProyek" class="form-label">Nama Proyek:</label>
            <input type="text" name="namaProyek" class="form-control" value="<?php echo htmlspecialchars($proyek['namaProyek'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo form_error('namaProyek'); ?>
        </div>

        <div class="mb-3">
            <label for="client" class="form-label">Client:</label>
            <input type="text" name="client" class="form-control" value="<?php echo htmlspecialchars($proyek['client'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo form_error('client'); ?>
        </div>

        <div class="mb-3">
            <label for="lokasiId" class="form-label">Lokasi ID:</label>
            <input type="text" name="lokasiId" class="form-control" value="<?php echo htmlspecialchars($proyek['lokasiId'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo form_error('lokasiId'); ?>
        </div>

        <div class="mb-3">
            <label for="tglMulai" class="form-label">Tanggal Mulai:</label>
            <input type="date" name="tglMulai" class="form-control" value="<?php echo htmlspecialchars($proyek['tglMulai'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo form_error('tglMulai'); ?>
        </div>

        <div class="mb-3">
            <label for="tglSelesai" class="form-label">Tanggal Selesai:</label>
            <input type="date" name="tglSelesai" class="form-control" value="<?php echo htmlspecialchars($proyek['tglSelesai'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo form_error('tglSelesai'); ?>
        </div>

        <div class="mb-3">
            <label for="pimpinanProyek" class="form-label">Pimpinan Proyek:</label>
            <input type="text" name="pimpinanProyek" class="form-control" value="<?php echo htmlspecialchars($proyek['pimpinanProyek'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo form_error('pimpinanProyek'); ?>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan:</label>
            <textarea name="keterangan" class="form-control"><?php echo htmlspecialchars($proyek['keterangan'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            <?php echo form_error('keterangan'); ?>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>

        <?php echo form_close(); ?>
    </div>
</body>
</html>
