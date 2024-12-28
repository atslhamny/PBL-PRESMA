<?php
require_once __DIR__ . '/../lib/Connection.php'; // Pastikan path file Connection.php benar

// Mendapatkan input dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk memverifikasi pengguna berdasarkan username dan password
$query = "SELECT * FROM [user] WHERE [username] = ? AND [password] = ?";

// Menyiapkan parameter untuk query
$params = array($username, $password);

// Eksekusi query
$stmt = sqlsrv_query($db, $query, $params);

// Periksa apakah query berhasil
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true)); // Tampilkan pesan error jika query gagal
}

// Mengecek apakah pengguna ditemukan
if (sqlsrv_has_rows($stmt)) {
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    // Set session jika login berhasil
    session_start();
    $_SESSION['is_login'] = true;
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['role_id'] = $row['role_id'];

    // Arahkan pengguna sesuai dengan role mereka
    if ($row['role_id'] == 1) {
        // Redirect ke halaman admin (pages/dashboardAdmin.php) tanpa 'action/'
        header('Location: ../index.php?page=dashboard_admin');
    } elseif ($row['role_id'] == 2) {
        // Redirect ke halaman mahasiswa (pages/dashboard.php) tanpa 'action/'
        header('Location: ../index.php?page=dashboard');
    } else {
        // Jika role tidak dikenali, logout dan arahkan ke halaman login
        header('Location: ../login.php');
    }
    exit();
} else {
    // Jika username dan password tidak cocok, kirimkan pesan error
    session_start();
    $_SESSION['status'] = false;
    $_SESSION['message'] = 'Username atau password salah!';
    header('Location: ../login.php');
    exit();
}
