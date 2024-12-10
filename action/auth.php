auth.php

<?php
include('../lib/Session.php');  // Memasukkan file Session.php yang berisi kelas Session
$session = new Session();  // Membuat objek session

// Mulai sesi
session_start();

// Cek aksi di URL
if (isset($_GET['act'])) {
    $action = $_GET['act'];

    try {
        // Database configuration
        $host = 'TOKOPEDIA'; // Ganti dengan nama server Anda
        $dbname = 'presma_fix'; // Ganti dengan nama database Anda
        $username = ''; // Ganti dengan username SQL Server Anda
        $password = ''; // Ganti dengan password SQL Server Anda

        // Membuat koneksi ke database
        $db = new PDO("sqlsrv:Server=$host;Database=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($action === 'login') {
            // Proses login
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usernameInput = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                $passwordInput = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

                // Query untuk mencari user berdasarkan username
                $stmt = $db->prepare("SELECT password FROM users WHERE username = :username");
                $stmt->bindParam(':username', $usernameInput);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Cek apakah user ditemukan
                if ($row) {
                    // Cek apakah password yang dimasukkan sesuai dengan password yang ada di database
                    if ($passwordInput === $row['password']) {  // Menggunakan password biasa (bukan hash)
                        $session->set('is_login', true);
                        $session->set('username', $usernameInput);
                        header('Location: ../index.php'); // Redirect ke index.php setelah login sukses
                        exit();
                    } else {
                        // Jika password tidak cocok
                        $session->setFlash('status', false);
                        $session->setFlash('message', 'Username atau Password salah!');
                        header('Location: ../login.php'); // Redirect ke login jika gagal
                        exit();
                    }
                } else {
                    // Jika user tidak ditemukan
                    $session->setFlash('status', false);
                    $session->setFlash('message', 'Username atau Password salah!');
                    header('Location: ../login.php'); // Redirect ke login jika user tidak ditemukan
                    exit();
                }
            }
        } elseif ($action === 'logout') {
            // Proses logout
            session_destroy();  // Hapus semua sesi
            header('Location: ../login.php');  // Redirect ke halaman login setelah logout
            exit();  // Hentikan eksekusi skrip
        }
    } catch (PDOException $e) {
        // Tangani error koneksi database
        error_log("Database connection error: " . $e->getMessage());
        die("Koneksi gagal. Silakan coba lagi nanti.");
    }
} else {
    // Jika 'act' tidak ada dalam URL, redirect ke login
    header('Location: ../login.php');
    exit();
}
?>