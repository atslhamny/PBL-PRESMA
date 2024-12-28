<?php
include('lib/Session.php');
$session = new Session();

// Pemeriksaan login
if (!$session->get('is_login')) {
  header('Location: login.php');
  exit();
}

// Ambil role_id dari sesi user
$role_id = $session->get('role_id');

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
  <title>Index</title>

  <!-- Tambahan CSS dan JS tetap dipertahankan -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include('layouts/header.php'); ?>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1E6892;">
      <a href="#" class="brand-link">
        <img src="img/logojti.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
        <span class="brand-text font-weight-light"><b>Presma Polinema</b></span>
      </a>
      <?php include('layouts/sidebar.php'); ?>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <?php
      // Ambil role_id dari sesi user
      $role_id = $session->get('role_id');

      // Ambil parameter halaman dari URL
      $page = strtolower($_GET['page'] ?? 'dashboard'); // Default 'dashboard'

      // Role admin (role == 1)
      if ($role_id == 1) {
        switch ($page) {
          case 'dashboard_admin':
            include("pages/dashboardAdmin.php");
            break;
          case 'kompetisi_admin':
            include("pages/kompetisiAdmin.php");
            break;
          case 'edit_kompetisi_admin':
            include("pages/editKompetisiAdmin.php");
            break;
          default:
            include("404.php");
            break;
        }
      }
      // Role mahasiswa (role == 2)
      elseif ($role_id == 2) {
        switch ($page) {
          case 'dashboard':
            include("pages/dashboard.php");
            break;
          case 'kompetisi':
            include("pages/kompetisi.php");
            break;
          case 'tambah':
            include('pages/tambahKompetisi.php');
            break;
          case 'edit_kompetisi':
            include('pages/editKompetisi.php');
            break;
          case 'hapus_kompetisi':
            include('pages/hapusKompetisi.php');
            break;
          case 'detail':
            include('pages/detailKompetisi.php');
            break;
          case 'prestasi':
            include("pages/prestasi.php");
            break;
          default:
            include("404.php");
            break;
        }
      }
      // Jika role_id tidak valid
      else {
        include("404.php");
      }
      ?>
    </div>

    <!-- Footer -->
    <?php include('layouts/footer.php'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark"></aside>
  </div>

  <!-- Script tambahan -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

  <!-- Cegah Navigasi Back -->
  <script>
    history.pushState(null, null, location.href);
    window.onpopstate = function() {
      history.go(1);
    };
  </script>
</body>

</html>