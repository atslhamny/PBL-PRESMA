<?php
require_once __DIR__ . '/../lib/Connection.php';

// Query untuk mengambil data prestasi
$query = "
SELECT 
    k.id, 
    m.nama, 
    k.judul_kompetisi, 
    t.tingkat_kompetisi,
    YEAR(k.tanggal_mulai) AS tahun
FROM kompetisi k
JOIN mhs_kompetisi mk ON k.id = mk.id_kompetisi
JOIN mahasiswa m ON mk.id_mahasiswa = m.id
JOIN tingkat_kompetisi t ON k.id_tingkat_kompetisi = t.id
ORDER BY k.tanggal_mulai DESC
";

$stmt = sqlsrv_query($db, $query);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Mahasiswa</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- DataTables Responsive CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <!-- Bootstrap (Opsional, jika dibutuhkan) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <section class="content-header">
        <div class="card">
            <div class="col-sm-12" style="padding: 10px;">
                <ol class="breadcrumb float-sm-left" style="padding: 0; margin: 0;">
                    <li class="breadcrumb-item">
                        <span class="fas fa-home" style="margin-right: 5px;"></span>
                        <a href="#" style="text-decoration: none; color: inherit;">PresMa Polinema</a>
                    </li>
                    <li class="breadcrumb-item active">Prestasi Mahasiswa</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="card">
            <div class="card-header" style="background-color: white;">
                <h4><b>Daftar Prestasi</b></h4>
                <p>Mahasiswa Politeknik Negeri Malang disiapkan untuk dapat bekerja maupun menjadi wirausaha yang sukses. Untuk itu, aktif dalam berbagai kegiatan lomba merupakan salah satu cara untuk mengasah kemampuan dan bakat para mahasiswa. Berikut beberapa prestasi yang telah diraih para mahasiswa dalam dekade terakhir:</p>
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
                            <th>Tingkat Kompetisi</th>
                            <th>Aksi</th>
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
                            <td>Juara 1</td>
                            <td>{$row['tingkat_kompetisi']}</td>
                            <td style='text-align: center;'>
                                <button type='button' class='btn btn-danger btn-sm' onclick='deleteRow({$row['id']})'>
                                    <i class='fa fa-trash'></i>
                                </button>
                            </td>

                          </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap JS (Opsional, jika digunakan) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <!-- DataTables Initialization -->
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