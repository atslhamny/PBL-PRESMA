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
        <?php
        $status = $session->getFlash('status');
        if ($status === false) {
          $message = $session->getFlash('message');
          echo '<div class="alert alert-warning">' . $message . '<button type="button" class="close" data-dismiss="alert" arialabel="Close"><span aria-hidden="true">&times;</span></div>';
        }
        ?>

        <!-- Form Login -->
        <form action="action/auth.php" method="post" id="form-login">
          <div class="input-group mb-3">
            <label for="username" class="sr-only">Username</label>
            <input type="text" id="username" class="form-control" placeholder="Username" name="username" autocomplete="off" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" class="form-control" placeholder="Password" name="password" required autocomplete="off">
            <div class="input-group-append">
              <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                <i class="fas fa-eye" id="toggleIcon"></i>
              </button>
            </div>
          </div>

          <div class="row">

            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">LogIn</button>
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
    $(document).ready(function() {
      $('#form-login').validate({
        rules: {
          username: {
            required: true,
            minlength: 3,
            maxlength: 20
          },
          password: {
            required: true,
            minlength: 5,
            maxlength: 255
          }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.input-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });

    function togglePassword() {
      const passwordField = document.getElementById('password');
      const toggleIcon = document.getElementById('toggleIcon');

      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      }
    }
  </script>
</body>

</html>