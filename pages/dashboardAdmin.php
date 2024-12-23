<?php
// Memulai sesi untuk mengakses data pengguna yang sudah login
// session_start();

// Mengimpor koneksi database
require_once __DIR__ . '/../lib/Connection.php';

// Simulasi sesi login untuk pengujian
$_SESSION['username'] = 'admin1';
$_SESSION['role'] = 'Admin';

// Ambil data dari sesi
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

// Cek apakah username dan role ada
if (!empty($username) && !empty($role)) {
    // Query untuk mendapatkan nama pengguna berdasarkan role
    if ($role === 'Mahasiswa') {
        $query = "SELECT nama_mahasiswa AS nama FROM mahasiswa WHERE username = ?";
    } elseif ($role === 'Admin') {
        $query = "SELECT nama_admin AS nama FROM admin WHERE username = ?";
    } else {
        $nama = "User Tidak Diketahui";
    }

    if (isset($query)) {
        $stmt = sqlsrv_prepare($db, $query, [$username]);
        if (sqlsrv_execute($stmt)) {
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $nama = $result ? $result['nama'] : "User Tidak Ditemukan";
        } else {
            $nama = "Query Gagal Dijalankan";
        }
    }
} else {
    $nama = "User Tidak Login";
}
?>

<style>
    /* General styling */
    .breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
    }

    .breadcrumb a {
        text-decoration: none;
        color: inherit;
    }


    .info-box {
        display: flex;
        align-items: center;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 1px 5px rgba(0, 0, 0.5, 0.3);
    }

    .info-box-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .card {
        box-shadow: 0 6px 7px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .card-dash {
        box-shadow: 0 6px 7px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 20px;
        background-color: white;

    }

    .card img {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .chart-container {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        padding: 20px;
    }

    .chart-container .card {
        width: 48%;
    }

    .berita {
        padding: 20px;
    }

    .berita .card {
        width: 16rem;
        padding: 10px;
        box-shadow: 0 6px 7px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }

    .berita img {
        border-radius: 5px 5px 0 0;
    }

    .berita .card-title {
        font-size: 15px;
        margin-bottom: 5px;
    }

    .berita .card-text {
        font-size: 14px;
        color: #555;
    }

    .berita .btn {
        font-size: 14px;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="path_to_your_styles.css">
</head>

<body>
    <section class="content-header">
        <div class="card">
            <div class="col-sm-12" style="padding: 10px;">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">
                        <span class="fas fa-home" style="margin-right: 5px;"></span>
                        <a href="#">PresMa Polinema</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card-dash">
            <div class="card-header">
                <h3 class="card-title"><b>Dashboard</b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <h4><b style="color: #03618D;">Selamat Datang <?php echo htmlspecialchars($nama); ?>,</b> Anda login sebagai <?php echo htmlspecialchars($role); ?></h4>

            </div>

            <div class="row" style="justify-content: center; padding:15px;">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-lightblue" style="border-radius: 20px;">
                        <div class="inner" style="padding: 14px;">
                            <h3>150</h3>
                            <p>Kompetisi Mahasiswa</p>
                        </div>
                        <div class="icon" style="padding: 5px;">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <a href="index.php?page=kompetisi" class="small-box-footer" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-maroon" style="border-radius: 20px;">
                        <div class="inner" style="padding: 14px;">
                            <h3>150</h3>
                            <p>Mahasiswa Berprestasi</p>
                        </div>
                        <div class="icon" style="padding: 5px;">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <a href="index.php?page=prestasi" class="small-box-footer" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning" style="border-radius: 20px;">
                        <div class="inner" style="padding: 14px;">
                            <h3>150</h3>
                            <p>Prestasi Mahasiswa</p>
                        </div>
                        <div class="icon" style="padding: 5px;">
                            <i class="fas fa-medal"></i>
                        </div>
                        <a href="index.php?page=prestasi" class="small-box-footer" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- berita -->
            <div class="berita">
                <h3 class="berita-header">
                    <b>Berita Terbaru</b>
                    <a href="pages/tambahBerita.php" class="add-icon" style="color: #03618D;">
                        <i class="fas fa-plus"></i>
                    </a>
                </h3>

                <!-- box berita -->
                <div class="row" style="justify-content: center; padding: 15px;">
                    <div class="col-lg-4 col-md-6 col-12" style="padding: 10px;">
                        <div class="card" style="position: relative;">
                            <span style="position: absolute; top: 13px; right: 13px; cursor: pointer; color: #fff; padding: 5px; border-radius: 50%;" onclick="deleteCard(this)">
                                <i class="fas fa-trash"></i>
                            </span>

                            <img src="img/berita.jpg" alt="Berita image" class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title">Mahasiswa Polinema</h6>
                                <p class="card-text">Some quick example text to build on the card title.</p>
                                <a href="https://mbkm.polinema.ac.id/" class="btn btn-primary">Baca selengkapnya..</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12" style="padding: 10px;">
                        <div class="card" style="position: relative;">
                            <span style="position: absolute; top: 13px; right: 13px; cursor: pointer; color: #fff; padding: 5px; border-radius: 50%;" onclick="deleteCard(this)">
                                <i class="fas fa-trash"></i>
                            </span>

                            <img src="img/berita.jpg" alt="Berita image" class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title">Mahasiswa Polinema</h6>
                                <p class="card-text">Some quick example text to build on the card title.</p>
                                <a href="https://mbkm.polinema.ac.id/" class="btn btn-primary">Baca selengkapnya..</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12" style="padding: 10px;">
                        <div class="card" style="position: relative;">
                            <span style="position: absolute; top: 13px; right: 13px; cursor: pointer; color: #fff; padding: 5px; border-radius: 50%;" onclick="deleteCard(this)">
                                <i class="fas fa-trash"></i>
                            </span>

                            <img src="img/berita.jpg" alt="Berita image" class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title">Mahasiswa Polinema</h6>
                                <p class="card-text">Some quick example text to build on the card title.</p>
                                <a href="https://mbkm.polinema.ac.id/" class="btn btn-primary">Baca selengkapnya..</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        function deleteCard(button) {
            const card = button.closest('.card');
            card.parentNode.removeChild(card);
        }
    </script>
</body>

</html>