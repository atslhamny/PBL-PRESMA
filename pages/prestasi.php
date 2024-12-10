<?php
require_once __DIR__ . '/../lib/Connection.php'; // Pastikan koneksi database sudah benar

// Query untuk mengambil data yang sesuai
$query = "
    SELECT 
        mk.id,
        mk.id_mahasiswa,
        mk.peran_mahasiswa,
        m.nama AS nama_mahasiswa,
        k.judul_kompetisi,
        YEAR(k.tanggal_akhir) AS tahun,
        tk.tingkat_kompetisi AS tingkat
    FROM 
        mhs_kompetisi mk
    LEFT JOIN mahasiswa m ON mk.id_mahasiswa = m.id
    LEFT JOIN kompetisi k ON mk.id_kompetisi = k.id
    LEFT JOIN tingkat_kompetisi tk ON k.id_tingkat_kompetisi = tk.id
    ORDER BY tahun DESC, m.nama ASC
"; // Pastikan tabel dan kolom sesuai dengan struktur database Anda

$result = sqlsrv_query($db, $query); // Menggunakan variabel $db dari Connection.php

if (!$result) {
    die(print_r(sqlsrv_errors(), true));
}
?>

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

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h4><b>Daftar Prestasi</b></h4>
            <p>Berikut adalah daftar prestasi mahasiswa yang telah terdaftar:</p>
        </div>

        <!-- Tabel -->
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul Kompetisi</th>
                        <th>Tahun</th>
                        <th>Tingkat</th>
                        <th>Peran Mahasiswa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_mahasiswa'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['judul_kompetisi'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['tahun'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['tingkat'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['peran_mahasiswa'] ?? '-') . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Tabel End -->
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#table-data').DataTable({
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