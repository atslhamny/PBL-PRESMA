<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Form Kompetisi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-primary text-white">
    <div class="container bg-light text-dark rounded p-4 mt-5" style="max-width: 900px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2);">
        <h1 class="text-center mb-4">Hasil Form Kompetisi</h1>

        <form>
            <!-- Program Studi -->
            <div class="form-group">
                <label for="prodi"><b>Program Studi</b></label>
                <input type="text" class="form-control" id="prodi" value="Sistem Informasi Bisnis" disabled>
            </div><br>

            <!-- Jenis Kompetisi -->
            <div class="form-group">
                <label for="jenis_kompetisi"><b>Jenis Kompetisi</b></label>
                <input type="text" class="form-control" id="jenis_kompetisi" value="Olimpiade" disabled>
            </div><br>

            <!-- Tingkat Kompetisi -->
            <div class="form-group">
                <label for="tingkat_kompetisi"><b>Tingkat Kompetisi</b></label>
                <input type="text" class="form-control" id="tingkat_kompetisi" value="Nasional" disabled>
            </div><br>

            <!-- Judul Kompetisi -->
            <div class="form-group">
                <label for="judul_kompetisi"><b>Judul Kompetisi</b></label>
                <input type="text" class="form-control" id="judul_kompetisi" value="Nasional" disabled>
            </div><br>

            <!-- Judul Kompetisi (English) -->
            <div class="form-group">
                <label for="judul_kompetisi_en"><b>Judul Kompetisi (English)</b></label>
                <input type="text" class="form-control" id="judul_kompetisi_en" value="Technology Olympics 2024" disabled>
            </div><br>

            <!-- Tempat Kompetisi -->
            <div class="form-group">
                <label for="tempat_kompetisi"><b>Tempat Kompetisi</b></label>
                <input type="text" class="form-control" id="tempat_kompetisi" value="Jakarta" disabled>
            </div><br>

            <!-- Tempat Kompetisi (English) -->
            <div class="form-group">
                <label for="tempat_kompetisi_en"><b>Tempat Kompetisi (English)</b></label>
                <input type="text" class="form-control" id="tempat_kompetisi_en" value="Jakarta" disabled>
            </div><br>

            <!-- URL Kompetisi -->
            <div class="form-group">
                <label for="url_kompetisi"><b>URL Kompetisi</b></label>
                <input type="text" class="form-control" id="url_kompetisi" value="https://www.olimpiadeteknologi.com" disabled>
            </div><br>

            <!-- Tanggal Mulai -->
            <div class="form-group">
                <label for="tanggal_mulai"><b>Tanggal Mulai</b></label>
                <input type="text" class="form-control" id="tanggal_mulai" value="2024-03-01" disabled>
            </div><br>

            <!-- Tanggal Selesai -->
            <div class="form-group">
                <label for="tanggal_selesai"><b>Tanggal Selesai</b></label>
                <input type="text" class="form-control" id="tanggal_selesai" value="2024-03-03" disabled>
            </div><br>

            <!-- Jumlah PT -->
            <div class="form-group">
                <label for="jumlah_pt"><b>Jumlah PT</b></label>
                <input type="text" class="form-control" id="jumlah_pt" value="10" disabled>
            </div><br>

            <!-- Jumlah Peserta -->
            <div class="form-group">
                <label for="jumlah_peserta"><b>Jumlah Peserta</b></label>
                <input type="text" class="form-control" id="jumlah_peserta" value="100" disabled>
            </div><br>

            <!-- No Surat Tugas -->
            <div class="form-group">
                <label for="no_surat_tugas"><b>Nomor Surat Tugas</b></label>
                <input type="text" class="form-control" id="no_surat_tugas" value="ST-1234/2024" disabled>
            </div><br>

            <!-- Tanggal Surat Tugas -->
            <div class="form-group">
                <label for="tanggal_surat_tugas"><b>Tanggal Surat Tugas</b></label>
                <input type="text" class="form-control" id="tanggal_surat_tugas" value="2024-02-01" disabled>
            </div><br>

            <!-- File Surat Tugas -->
            <div class="form-group">
                <label for="file_surat_tugas"><b>File Surat Tugas</b></label>
                <input type="text" class="form-control" id="file_surat_tugas" value="surat_tugas.pdf" disabled>
            </div><br>

            <!-- File Sertifikat -->
            <div class="form-group">
                <label for="file_sertifikat"><b>File Sertifikat</b></label>
                <input type="text" class="form-control" id="file_sertifikat" value="sertifikat_kompetisi.pdf" disabled>
            </div><br>

            <!-- Foto Kegiatan -->
            <div class="form-group">
                <label for="foto_kegiatan"><b>Foto Kegiatan</b></label>
                <input type="text" class="form-control" id="foto_kegiatan" value="foto_kegiatan.jpg" disabled>
            </div><br>

            <!-- Data Mahasiswa -->
            <div class="form-group">
                <label for="data_mahasiswa"><b>Data Mahasiswa</b></label>
                <input type="text" class="form-control" id="data_mahasiswa" value="Andi (Anggota), Budi (Ketua)" disabled>
            </div><br>

            <!-- Data Pembimbing -->
            <div class="form-group">
                <label for="data_pembimbing"><b>Data Pembimbing</b></label>
                <input type="text" class="form-control" id="data_pembimbing" value="Dr. Rahmat (Pembimbing Utama)" disabled>
            </div><br>

            <div class="row">
                <div class="col-md-2">
                    <a href="index.php?page=prestasi" class="btn btn-success btn-sm w-100">Verifikasi</a>
                </div>
                <div class="col-md-2">
                    <a href="index.php" class="btn btn-danger btn-sm w-100">Tolak</a>
                </div>
            </div>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>