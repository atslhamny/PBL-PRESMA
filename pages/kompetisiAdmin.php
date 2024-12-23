<?php
require_once __DIR__ . '/../lib/Connection.php';

// Query untuk mengambil data dari database
$query = "
SELECT 
    k.id, 
    m.nama, 
    k.judul_kompetisi, 
    k.catatan,
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

<!-- kategori mahasiswa -->

<section class="content-header">
    <div class="card">
        <div class="col-sm-12" style="padding: 10px;">
            <ol class="breadcrumb float-sm-left" style="padding: 0; margin: 0;">
                <li class="breadcrumb-item">
                    <span class="fas fa-home" style="margin-right: 5px;"></span>
                    <a href="#" style="text-decoration: none; color: inherit;">PresMa Polinema</a>
                </li>
                <li class="breadcrumb-item active">Kompetisi Mahasiswa</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header" style="background-color: white;">
            <div class="deskripsi">
                <h4><b>Daftar Kompetisi</b></h4>
                <p>
                    Kompetisi mahasiswa Politeknik Negeri Malang adalah ajang pengembangan keterampilan dan
                    kreativitas yang bertujuan meningkatkan daya saing mahasiswa di berbagai bidang. Kompetisi ini
                    mempersiapkan mahasiswa menjadi individu yang unggul, inovatif, dan siap berkontribusi di dunia
                    industri.
                </p>

            </div>
        </div>

        <!-- Tabel Kompetisi -->
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th>Judul Kompetisi</th>
                        <th>Keterangan</th>
                        <th>Tahun</th>
                        <th style="text-align: center;">Detail</th>
                        <th style="text-align: center;">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        echo "
        <tr>
            <td style='text-align: center;'>$no</td>
            <td>{$row['judul_kompetisi']}</td>
            <td>{$row['catatan']}</td>
            <td>{$row['tahun']}</td>
            <td style='text-align: center;'>
                <a href='index.php?page=detail&id={$row['id']}' class='btn btn-primary btn-sm'>
                    <i class='fa fa-edit'></i>
                </a>
            </td>
            <td style='text-align: center;'>
                <button type='button' class='btn btn-danger btn-sm' onclick='deleteRow({$row['id']})'>
                    <i class='fa fa-trash'></i>
                </button>
            </td>
        </tr>
        ";
                        $no++;
                    }

                    // Jika tidak ada data
                    if ($no === 1) {
                        echo "<tr><td colspan='7' style='text-align: center;'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>

            </table>
        </div>

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