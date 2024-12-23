<?php
// Menambahkan pengecekan jika form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses penyimpanan berita disini, misalnya dengan upload gambar dan simpan ke database
    // Redirect setelah upload
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <!-- Tambahkan link untuk AdminLTE dan custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Main content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tambah Berita</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Berita</h3>
                        </div>
                        <div class="card-body">
                            <!-- Form tambah berita -->
                            <form id="formTambahBerita" enctype="multipart/form-data" method="POST">
                                <div class="form-group">
                                    <label for="gambar">Masukkan Gambar Berita</label>
                                    <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*" required>
                                </div>
                                <div class="form-group">
                                    <label for="judul">Masukkan Judul</label>
                                    <input type="text" id="judul" name="judul" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Masukkan Deskripsi</label>
                                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="6" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="url">Masukkan URL</label>
                                    <input type="url" id="url" name="url" class="form-control" required>
                                </div>
                                <div class="form-actions text-right">
                                    <button type="submit" class="btn btn-success">Upload</button>
                                    <a href="../index.php" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- AdminLTE JS dan dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>