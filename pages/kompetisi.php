<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Hanya panggil session_start jika sesi belum dimulai
}
require_once __DIR__ . '/../lib/Connection.php';

// Memeriksa apakah pengguna sudah login dengan memeriksa session 'user_id'
if (!isset($_SESSION['user_id'])) {
    die('Anda harus login untuk melihat data kompetisi.');
}
// Mendapatkan user_id dari sesi
$userId = $_SESSION['user_id'];

// Query untuk mencari ID mahasiswa berdasarkan user_id yang sedang login
$queryMahasiswa = "
SELECT id 
FROM mahasiswa 
WHERE user_id = ?
";

// Menyiapkan dan mengeksekusi query untuk mendapatkan ID mahasiswa
$stmtMahasiswa = sqlsrv_prepare($db, $queryMahasiswa, array($userId));
if ($stmtMahasiswa === false || !sqlsrv_execute($stmtMahasiswa)) {
    die(print_r(sqlsrv_errors(), true));
}

// Mengambil ID mahasiswa dari hasil query
$mahasiswa = sqlsrv_fetch_array($stmtMahasiswa, SQLSRV_FETCH_ASSOC);
if (!$mahasiswa) {
    die('Data mahasiswa tidak ditemukan.');
}

$mahasiswaId = $mahasiswa['id'];  // Menyimpan ID mahasiswa

// Query untuk mengambil data kompetisi berdasarkan ID mahasiswa
$query = "
SELECT 
    k.id, 
    m.nama, 
    k.judul_kompetisi, 
    k.catatan,
    k.status,
	t.tingkat_kompetisi,
    YEAR(k.tanggal_mulai) AS tahun
FROM kompetisi k
JOIN mahasiswa m ON k.id_mahasiswa = m.id
JOIN tingkat_kompetisi t ON k.id_tingkat_kompetisi = t.id
WHERE k.id_mahasiswa = ?

ORDER BY k.tanggal_mulai DESC
";

// Menyiapkan dan mengeksekusi query untuk mengambil data kompetisi
$stmt = sqlsrv_prepare($db, $query, array($mahasiswaId));
if ($stmt === false || !sqlsrv_execute($stmt)) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <section class="content-header">
        <div class="card">
            <div class="col-sm-12" style="padding: 10px;">
                <ol class="breadcrumb float-sm-left" style="padding: 0; margin: 0;">
                    <li class="breadcrumb-item">
                        <span class="fas fa-home" style="margin-right: 5px;"></span>
                        <a href="index.php" style="text-decoration: none; color: inherit;">PresMa Polinema</a>
                    </li>
                    <li class="breadcrumb-item active">Menu Kompetisi</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header" style="background-color: white;">
                <h4><b>Daftar Kompetisi</b></h4>
                <p>Berikut adalah data kompetisi yang sudah Anda kirimkan</p>
                <a href="index.php?page=tambah"><button type="button" class="btn btn-md btn-primary" style="float: right;">Tambah Data</button></a>
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered table-striped" id="table-data">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Judul Kompetisi</th>
                            <th>Tahun</th>
                            <th>Peringkat</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            echo "<tr>
                            <td style='text-align: center;'>{$no}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['judul_kompetisi']}</td>
                            <td>{$row['tahun']}</td>
                            <td>{$row['tingkat_kompetisi']}</td>
                            <td>{$row['catatan']}</td>
                            <td>";
                            switch ($row['status']) {
                                case 'Pending':
                                    echo "<span class='text-warning'><i class='fas fa-hourglass-half'></i> Pending</span>";
                                    break;
                                case 'Diterima':
                                    echo "<span class='text-success'><i class='fas fa-check-circle'></i> Diterima</span>";
                                    break;
                                case 'Ditolak':
                                    echo "<span class='text-danger'><i class='fas fa-times-circle'></i> Ditolak</span>";
                                    break;
                                default:
                                    echo "<span class='text-muted'><i class='fas fa-question-circle'></i> Tidak Diketahui</span>";
                                    break;
                            }
                            echo "</td>
                            <td><a href='index.php?page=edit_kompetisi&id={$row['id']}'>Edit</a>&nbsp;<a href='index.php?page=hapus_kompetisi&id={$row['id']}'>Hapus</a></td>                            
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-data').DataTable({
                responsive: true,
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
</body>

</html>