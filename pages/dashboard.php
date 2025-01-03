<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Hanya panggil session_start jika sesi belum dimulai
}
require_once __DIR__ . '/../lib/Connection.php';

if (!isset($_SESSION['user_id'])) {
    die('Anda harus login untuk melihat data kompetisi.');
}

// Mendapatkan user_id dari sesi
$userId = $_SESSION['user_id'];

$queryTingkatKompetisi = "
SELECT 
    t.tingkat_kompetisi, 
    COUNT(k.id) AS total
FROM kompetisi k
JOIN tingkat_kompetisi t ON k.id_tingkat_kompetisi = t.id
WHERE k.id_mahasiswa = ?
GROUP BY t.tingkat_kompetisi
";

// Prepare and execute the statement
$stmtTingkat = sqlsrv_prepare($db, $queryTingkatKompetisi, array($userId));
if ($stmtTingkat === false) {
    die("Error preparing statement: " . print_r(sqlsrv_errors(), true));
}
if (!sqlsrv_execute($stmtTingkat)) {
    die("Error executing statement: " . print_r(sqlsrv_errors(), true));
}

// Fetch the results into an associative array
$tingkatData = [];
while ($row = sqlsrv_fetch_array($stmtTingkat, SQLSRV_FETCH_ASSOC)) {
    $tingkatData[$row['tingkat_kompetisi']] = $row['total'];
}

// Pastikan semua tingkat kompetisi ada (beri nilai default 0 jika tidak ada data)
$allTingkat = ['Nasional', 'Internasional', 'Kab/Kota'];
foreach ($allTingkat as $tingkat) {
    if (!isset($tingkatData[$tingkat])) {
        $tingkatData[$tingkat] = 0;
    }
}
?>

<!-- dashboard mahasiswa -->
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

<!-- Dashboard mahasiswa -->
<section class="content-header">
    <div class="card">
        <div class="col-sm-12" style="padding: 10px;">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item">
                    <span class="fas fa-home" style="margin-right: 5px;"></span>
                    <a href="index.php">PresMa Polinema</a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
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
            <!-- <h4><b style="color: #03618D;">Selamat Datang Rheina Putri,</b> Anda login sebagai Mahasiswa</h4> -->
        </div>
        <div class="row" style="justify-content: center; padding: 15px;">
            <div class="col-lg-4 col-6">
                <!-- Tingkat Nasional -->
                <div class="small-box bg-lightblue" style="border-radius: 20px;">
                    <div class="inner" style="padding: 14px;">
                        <h3><?= $tingkatData['Nasional'] ?? 0; ?></h3>
                        <p>Kompetisi Tingkat Nasional</p>
                    </div>
                    <div class="icon" style="padding: 5px;">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <a href="index.php?page=kompetisi" class="small-box-footer" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <!-- Tingkat Internasional -->
                <div class="small-box bg-maroon" style="border-radius: 20px;">
                    <div class="inner" style="padding: 14px;">
                        <h3><?= $tingkatData['Internasional'] ?? 0; ?></h3>
                        <p>Kompetisi Tingkat Internasional</p>
                    </div>
                    <div class="icon" style="padding: 5px;">
                        <i class="fas fa-globe"></i>
                    </div>
                    <a href="index.php?page=kompetisi" class="small-box-footer" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <!-- Tingkat Regional -->
                <div class="small-box bg-warning" style="border-radius: 20px;">
                    <div class="inner" style="padding: 14px;">
                        <h3><?= $tingkatData['Kab/Kota'] ?? 0; ?></h3>
                        <p>Kompetisi Tingkat Regional</p>
                    </div>
                    <div class="icon" style="padding: 5px;">
                        <i class="fas fa-map"></i>
                    </div>
                    <a href="index.php?page=kompetisi" class="small-box-footer" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $('#table-data').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            pageLength: 10,
            language: {
                paginate: {
                    previous: "Previous",
                    next: "Next"
                },
                lengthMenu: "Show _MENU_ entries",
                search: "Search:"
            }
        });
    });
</script>