<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Memastikan sesi telah dimulai
}

require_once __DIR__ . '/lib/Connection.php';

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    die('Anda harus login untuk melihat data mahasiswa.');
}

// Mendapatkan user_id dari sesi
$userId = $_SESSION['user_id'];

// Query untuk mengambil data mahasiswa berdasarkan user_id
$query = "
    SELECT m.*, p.nama_prodi, j.nama_jurusan
    FROM mahasiswa m
    JOIN prodi p ON m.prodi_id = p.id
    JOIN jurusan j ON m.jurusan_id = j.id
    WHERE m.user_id = ?
";
$stmt = sqlsrv_query($db, $query, array($userId));

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$mahasiswa = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

// Jika data mahasiswa tidak ditemukan, beri pesan error
if ($mahasiswa === null) {
    die('Data mahasiswa tidak ditemukan.');
}

// Jika form disubmit, proses update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi_id = $_POST['prodi_id'];
    $jurusan_id = $_POST['jurusan_id'];
    $tahun_masuk = $_POST['tahun_masuk'];

    // // Foto baru (jika diupload)
    // $foto = $mahasiswa['foto']; // Tetap menggunakan foto lama jika tidak ada upload baru
    // if ($_FILES['foto']['name']) {
    //     $foto = 'upload/' . basename($_FILES['foto']['name']);
    //     move_uploaded_file($_FILES['foto']['tmp_name'], $foto); // Upload file foto
    // }

    function uploadFile($inputName, $prefix)
    {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == UPLOAD_ERR_OK) {
            $targetDir = "upload/";
            $randomString = bin2hex(random_bytes(8)); // Membuat nama random
            $fileExtension = pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION);
            $fileName = $prefix . "_" . $randomString . "." . $fileExtension;
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetFile)) {
                return $fileName; // Mengembalikan nama file yang telah disimpan
            } else {
                die("Error saat mengunggah file: " . $_FILES[$inputName]['name']);
            }
        }
        return null;
    }

    $foto = uploadFile('foto', 'foto');


    // Query untuk update data mahasiswa
    $queryUpdate = "
        UPDATE mahasiswa
        SET nama = ?, nim = ?, prodi_id = ?, jurusan_id = ?, tahun_masuk = ?, foto = ?
        WHERE user_id = ?
    ";

    $params = array($nama, $nim, $prodi_id, $jurusan_id, $tahun_masuk, $foto, $userId);
    $stmtUpdate = sqlsrv_prepare($db, $queryUpdate, $params);

    if ($stmtUpdate === false || !sqlsrv_execute($stmtUpdate)) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Profil berhasil diperbarui!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Mahasiswa</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <style>
        body {
            padding: 40px;
            background-color: #1E6892;
        }

        .login-box {
            width: 100%;
            height: 100%;
        }

        .card-header {
            padding: 15px;
        }

        .profile-image img {
            width: 150px;
            height: 150px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning.text-white {
            color: white !important;
        }
    </style>
</head>

<body class="hold-transition">
    <div class="login-box">
        <div class="card card-warning">
            <div class="card-header text-center">
                <h3 class="card-title">Profil Mahasiswa</h3>
            </div>

            <!-- Form Start -->
            <form action="index.php?page=dashboard" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="card-body d-flex align-items-center">
                        <div class="profile-image">
                            <img src="<?= isset($mahasiswa['foto']) ? $mahasiswa['foto'] : 'default.jpg' ?>" id="foto" name="foto" class="img-thumbnail" alt="Profile">
                        </div>
                        <div class="form-group ml-4" style="width: 100%;">
                            <label for="foto">Ubah Foto Profil</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto" accept=".jpg,.jpeg,.png" onchange="previewImage(event)">
                                    <label class="custom-file-label" for="foto">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <!-- Nama Lengkap -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="namaLengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="namaLengkap" name="nama" value="<?= isset($mahasiswa['nama']) ? $mahasiswa['nama'] : '' ?>" required>
                                </div>
                            </div>
                            <!-- NIM -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim" value="<?= isset($mahasiswa['nim']) ? $mahasiswa['nim'] : '' ?>" required>
                                </div>
                            </div>
                            <!-- Jurusan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <select class="form-control" id="jurusan" name="jurusan_id" required>
                                        <?php
                                        // Query untuk mengambil data jurusan
                                        $queryJurusan = "SELECT * FROM jurusan";
                                        $stmtJurusan = sqlsrv_query($db, $queryJurusan);
                                        while ($row = sqlsrv_fetch_array($stmtJurusan, SQLSRV_FETCH_ASSOC)) {
                                            $selected = (isset($mahasiswa['jurusan_id']) && $mahasiswa['jurusan_id'] == $row['id']) ? 'selected' : '';
                                            echo "<option value='{$row['id']}' {$selected}>{$row['nama_jurusan']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Prodi -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prodi">Prodi</label>
                                    <select class="form-control" id="prodi" name="prodi_id" required>
                                        <?php
                                        // Query untuk mengambil data program studi
                                        $queryProdi = "SELECT * FROM prodi";
                                        $stmtProdi = sqlsrv_query($db, $queryProdi);
                                        while ($row = sqlsrv_fetch_array($stmtProdi, SQLSRV_FETCH_ASSOC)) {
                                            $selected = (isset($mahasiswa['prodi_id']) && $mahasiswa['prodi_id'] == $row['id']) ? 'selected' : '';
                                            echo "<option value='{$row['id']}' {$selected}>{$row['nama_prodi']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun_masuk">Tahun Masuk</label>
                                    <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk" value="<?= isset($mahasiswa['tahun_masuk']) ? $mahasiswa['tahun_masuk'] : '' ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Update Profil</button>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-12">
                            <a href="index.php" class="btn btn-warning btn-block text-white">
                                <i class="fas fa-undo"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('foto');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="adminlte/dist/js/adminlte.min.js"></script>
</body>

</html>