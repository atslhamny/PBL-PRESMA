<?php
require_once __DIR__ . '/./lib/Connection.php';

// Cek apakah parameter id ada
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Query untuk mendapatkan detail kompetisi dan informasi terkait
    $query = "
    SELECT 
        k.judul_kompetisi, 
        k.judul_kompetisi_en,
        k.gelar, 
        k.tanggal_mulai, 
        k.tanggal_akhir, 
        k.tempat_kompetisi, 
        k.status, 
        k.catatan, 
        jk.jenis_kompetisi AS kategori,   -- Ganti kategori dengan jenis_kompetisi
        k.jumlah_pt,
        m.nama AS nama_mahasiswa,
        m.nim,
        p.nama_prodi,
        j.nama_jurusan,
        m.tahun_masuk,
        d.nama AS nama_dosen
    FROM kompetisi k
    JOIN jenis_kompetisi jk ON k.id_jenis_kompetisi = jk.id
    JOIN mhs_kompetisi mk ON k.id = mk.id_kompetisi
    JOIN mahasiswa m ON mk.id_mahasiswa = m.id
    JOIN prodi p ON m.prodi_id = p.id
    JOIN jurusan j ON p.jurusan_id = j.id
    JOIN dosen d on k.id_dosen = d.id
    WHERE k.id = ?
";


    $params = [$id];
    $stmt = sqlsrv_query($db, $query, $params);

    // Mengecek apakah query berhasil dan data ditemukan
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Debugging error jika query gagal
    }

    if (!sqlsrv_has_rows($stmt)) {
        die("Kompetisi tidak ditemukan.");
    }

    // Mengambil data hasil query
    $detail = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
} else {
    die("ID tidak valid.");
}
?>

<section class="content-header">
    <h2>Detail Kompetisi</h2>
</section>

<section class="content">
    <div class="card">
        <div class="card-body">
            <h4>Judul Kompetisi: <?= htmlspecialchars($detail['judul_kompetisi']) ?></h4>
            <p><b>Judul Kompetisi (EN):</b> <?= htmlspecialchars($detail['judul_kompetisi_en']) ?></p>
            <p><b>Tanggal Mulai:</b> <?= date_format($detail['tanggal_mulai'], 'd-m-Y') ?></p>
            <p><b>Tanggal Akhir:</b> <?= date_format($detail['tanggal_akhir'], 'd-m-Y') ?></p>
            <p><b>Tempat Kompetisi:</b> <?= htmlspecialchars($detail['tempat_kompetisi']) ?></p>
            <p><b>Status:</b> <?= htmlspecialchars($detail['status']) ?></p>
            <p><b>Catatan:</b> <?= htmlspecialchars($detail['catatan']) ?></p>
            <p><b>Kategori:</b> <?= htmlspecialchars($detail['kategori']) ?></p>
            <p><b>Jumlah Partisipasi:</b> <?= htmlspecialchars($detail['jumlah_pt']) ?></p>
            <p><b>Nama Mahasiswa:</b> <?= htmlspecialchars($detail['nama_mahasiswa']) ?></p>
            <p><b>NIM:</b> <?= htmlspecialchars($detail['nim']) ?></p>
            <p><b>Program Studi:</b> <?= htmlspecialchars($detail['nama_prodi']) ?></p>
            <p><b>Jurusan:</b> <?= htmlspecialchars($detail['nama_jurusan']) ?></p>
            <p><b>Tahun Masuk:</b> <?= htmlspecialchars($detail['tahun_masuk']) ?></p>
            <p><b>Nama Dosen:</b> <?= htmlspecialchars($detail['nama_dosen']) ?></p>
            <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</section>