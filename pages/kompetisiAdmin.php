<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Memastikan sesi telah dimulai
}

require_once __DIR__ . '/../lib/Connection.php';

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    die('Anda harus login untuk melihat data kompetisi.');
}

// Mendapatkan user_id dari sesi
$userId = $_SESSION['user_id'];

// Query untuk memeriksa apakah pengguna adalah admin
$queryRole = "
SELECT role_id 
FROM [user] 
WHERE id = ?
";

$stmtRole = sqlsrv_prepare($db, $queryRole, array($userId));
if ($stmtRole === false || !sqlsrv_execute($stmtRole)) {
    die(print_r(sqlsrv_errors(), true));
}

$userRole = sqlsrv_fetch_array($stmtRole, SQLSRV_FETCH_ASSOC);

// Cek apakah role_id = 1 (Admin)
if ($userRole['role_id'] != 1) {
    die('Akses ditolak! Hanya admin yang dapat melihat data ini.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Validasi input status
    if (!in_array($status, ['Diterima', 'Ditolak'], true)) {
        die('Status tidak valid.');
    }

    // Query untuk memperbarui status
    $queryUpdate = "UPDATE kompetisi SET status = ? WHERE id = ?";
    $params = [$status, $id];

    $stmtUpdate = sqlsrv_prepare($db, $queryUpdate, $params);
    if ($stmtUpdate === false || !sqlsrv_execute($stmtUpdate)) {
        die("Error in updating status: " . print_r(sqlsrv_errors(), true));
    }
}

// Query untuk mengambil semua data kompetisi mahasiswa
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
ORDER BY k.tanggal_mulai DESC
";

// Menyiapkan dan mengeksekusi query
$stmt = sqlsrv_prepare($db, $query);
if ($stmt === false || !sqlsrv_execute($stmt)) {
    die(print_r(sqlsrv_errors(), true));
}

// Menyimpan hasil query dalam array
$dataKompetisi = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $dataKompetisi[] = $row;
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
                    <li class="breadcrumb-item active">Menu Kompetisi Admin</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header" style="background-color: white;">
                <h4><b>Daftar Kompetisi Diajukan</b></h4>
                <a href="#" id="export-pdf" class="btn btn-danger" style="margin-right: 5px;">Export PDF</a>
                <a href="#" id="export-excel" class="btn btn-success">Export Excel</a>
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
                        if (!empty($dataKompetisi)) {
                            $no = 1;
                            foreach ($dataKompetisi as $row) {
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
                <td>
                <a href='index.php?page=edit_kompetisi_admin&id={$row['id']}' class='btn btn-info btn-sm'>
        <i class='fas fa-info-circle'></i> Detail </a>
                    <form method='POST' style='display: inline;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit' name='status' value='Diterima' class='btn btn-success btn-sm'>
                            <i class='fas fa-check-circle'></i> Diterima
                        </button>
                    </form>
                    <form method='POST' style='display: inline;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit' name='status' value='Ditolak' class='btn btn-danger btn-sm'>
                            <i class='fas fa-times-circle'></i> Ditolak
                        </button>
                    </form>
                </td>
            </tr>";
                                $no++;
                            }
                        } else {
                            echo '<tr><td colspan="8" style="text-align: center;">Tidak ada data kompetisi yang ditemukan.</td></tr>';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
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


        document.getElementById('export-pdf').addEventListener('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            // Ambil data dari tabel
            const table = document.getElementById('table-data');
            const rows = table.querySelectorAll('tbody tr');
            const data = [];

            rows.forEach(row => {
                const rowData = [];
                row.querySelectorAll('td').forEach(cell => {
                    rowData.push(cell.innerText);
                });
                data.push(rowData);
            });

            // Definisikan kolom
            const columns = [{
                    header: 'No',
                    dataKey: 'no'
                },
                {
                    header: 'Nama Mahasiswa',
                    dataKey: 'nama'
                },
                {
                    header: 'Judul Kompetisi',
                    dataKey: 'judul_kompetisi'
                },
                {
                    header: 'Tahun',
                    dataKey: 'tahun'
                },
                {
                    header: 'Peringkat',
                    dataKey: 'peringkat'
                },
                {
                    header: 'Catatan',
                    dataKey: 'catatan'
                },
                {
                    header: 'Status',
                    dataKey: 'status'
                }
            ];

            // Gunakan autoTable dengan data dan kolom
            doc.autoTable({
                head: [columns.map(col => col.header)],
                body: data
            });

            doc.save('daftar_kompetisi.pdf');

            // Tambahkan penundaan sebelum pengalihan
            setTimeout(function() {
                window.location.href = 'index.php?page=kompetisi_admin';
            }, 1000);
        });

        document.getElementById('export-excel').addEventListener('click', function() {
            var wb = XLSX.utils.table_to_book(document.getElementById('table-data'), {
                sheet: "Sheet JS"
            });
            XLSX.writeFile(wb, 'daftar_kompetisi.xlsx');

            // Tambahkan penundaan sebelum pengalihan
            setTimeout(function() {
                window.location.href = 'index.php?page=kompetisi_admin';
            }, 1000);
        });
    </script>
</body>

</html>