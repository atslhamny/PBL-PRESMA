<?php
// Memulai session
// session_start();

// // Pastikan Anda sudah terhubung dengan database
require_once __DIR__ . '/../lib/Connection.php';

// Ambil user_id dari sesi
$userId = $_SESSION['user_id'] ?? null;

if ($userId) {
    // Query untuk mengambil foto berdasarkan user_id
    $query = "SELECT foto FROM mahasiswa WHERE user_id = ?";
    $stmt = sqlsrv_query($db, $query, array($userId));

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Ambil foto jika ditemukan
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $foto = $row['foto'] ?? 'img/user.png'; // Jika foto tidak ada, gunakan foto default
} else {
    // Jika user_id tidak ditemukan di sesi, gunakan foto default
    $foto = 'img/user.png';
}
?>


<!-- sidebar -->
<div class="sidebar" style="background-color: #1E6892;">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="<?= $foto ?>" alt="User Image" style="border-radius: 50%; width: 35px; height: 35px; object-fit: cover;">
        </div>

        <div class="info">
            <a href="profile.php" class="d-block">
                <?php
                // Tampilkan username dari sesi atau 'Guest' jika belum login
                echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';
                ?>
            </a>
        </div>
    </div>


    <!-- SidebarSearch Form -->
    <div class="form-inline" style="padding: 9px;">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar-light" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-light">
                    <i class="fas fa-search fa-fw" style="color: #000;"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <?php
    if ($_SESSION['role_id'] == 1) {
        include('pages/admin.php');
    }

    if ($_SESSION['role_id'] == 2) {
        include('pages/user.php');
    }


    ?>
</div>