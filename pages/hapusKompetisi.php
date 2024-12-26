<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Hanya panggil session_start jika sesi belum dimulai
}
require_once __DIR__ . '/../lib/Connection.php';

// Memeriksa apakah pengguna sudah login dengan memeriksa session 'user_id'
if (!isset($_SESSION['user_id'])) {
    die('Anda harus login untuk melihat data kompetisi.');
}
$query = "DELETE from kompetisi where id='$_REQUEST[id]'";
$stmt = sqlsrv_prepare($db, $query);
if ($stmt === false || !sqlsrv_execute($stmt)) {
    die("Error in inserting data: " . print_r(sqlsrv_errors(), true));
}
echo "<script>alert('Data berhasil dihapus!');self.location='index.php?page=kompetisi'</script>";
///////////////////////////////////////////////////////////////
