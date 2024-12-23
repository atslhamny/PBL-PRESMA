<?php
include('lib/Session.php');

$session = new Session();

// Jika pengguna sudah login, arahkan ke halaman utama
if ($session->get('is_login')) {
  header('Location: index.php');
  exit();
}

// Atur Cache-Control agar halaman ini tidak disimpan di browser
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PresMa - Login</title>

  <!-- CSS dipertahankan -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <style>
    body {
      background: url('img/background.png') no-repeat center center fixed;
      background-size: cover;
    }

    .login-box {
      margin: auto;
      width: 360px;
    }

    .card {
      border-radius: 20px;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header">
        <h3><b>Prestasi Mahasiswa</b></h3>
      </div>

      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <!-- Pesan Flash -->
        <?php if ($session->getFlash('status') === false): ?>
          <div class="alert alert-warning">
            <?= $session->getFlash('message') ?>
          </div>
        <?php endif; ?>

        <!-- Form Login -->
        <form action="action/auth.php" method="post" id="form-login">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="show-password">
                <label for="show-password">Show Password</label>
              </div>
            </div>

            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

  <!-- JavaScript untuk menampilkan/sembunyikan password -->
  <script>
    document.getElementById('show-password').addEventListener('change', function() {
      var passwordInput = document.getElementById('password');
      if (this.checked) {
        passwordInput.type = 'text'; // Tampilkan password
      } else {
        passwordInput.type = 'password'; // Sembunyikan password
      }
    });
  </script>
</body>

</html>