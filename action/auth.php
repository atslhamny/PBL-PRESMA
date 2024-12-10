
<?php
include('../lib/Session.php');
include('../lib/Connection.php');

$session = new Session();
$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    include('../model/UserModel.php');
  
    if ($data) {
        // Jika password sesuai
        if (password_verify($password, $data['password'])) {
            $session->set('is_login', true);
            $session->set('username', $data['username']);
            $session->set('role_id', $data['role_id']); // role_id menentukan peran
            $session->commit();

            // Redirect berdasarkan role_id
            if ($data['role_id'] == 1) {
                header('Location: ../pages/dashboardAdmin.php', false);
                exit();
            } elseif ($data['role_id'] == 2) {
                header('Location: ../pages/dashboard.php', false);
                exit();
            } else {
                // Default redirect jika role_id tidak dikenal
                echo "role_id tidak dikenal";
            }
        } else {
            // Password salah
            $session->setFlash('status', false);
            $session->setFlash('message', 'Username atau password salah.');
            $session->commit();
            header('Location: ../login.php', false);
        }
    } else {
        // Username tidak ditemukan
        $session->setFlash('status', false);
        $session->setFlash('message', 'Username tidak ditemukan.');
        $session->commit();
        header('Location: ../login.php', false);
    }
} else if ($act == 'logout') {
    $session->deleteAll();
    header('Location: ../landingPage.php', false);
}
