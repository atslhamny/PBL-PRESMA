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
$peran_map = [
    1 => 'Ketua',
    2 => 'Anggota',
    3 => 'Personal',
];



$peran_dosen_map = [
    1 => 'Melakukan pembinaan kegiatan mahasiswa di bidang akademik (PA) dan kemahasiswaan (BEM, Maperwa, dan lain-lain)',
    2 => 'Membimbing mahasiswa menghasilkan produk saintifik bereputasi dan mendapat pengakuan tingkat Internasional',
    3 => 'Membimbing mahasiswa menghasilkan produk saintifik bereputasi dan mendapat pengakuan tingkat Nasional',
    4 => 'Membimbing mahasiswa menghasilkan produk saintifik bereputasi dan mendapat pengakuan tingkat Regional'
];
if (isset($_REQUEST['simpan'])) {
    $id_jenis_kompetisi = $_REQUEST['id_jenis_kompetisi'];
    $id_tingkat_kompetisi = $_REQUEST['id_tingkat_kompetisi'];
    $id_prodi = $_REQUEST['id_prodi'];
    $judul_kompetisi = $_REQUEST['judul_kompetisi'];
    $judul_kompetisi_en = $_REQUEST['judul_kompetisi_en'];
    $tempat_kompetisi = $_REQUEST['tempat_kompetisi'];
    $tempat_kompetisi_en = $_REQUEST['tempat_kompetisi_en'];
    $url_kompetisi = $_REQUEST['url_kompetisi'];
    $tanggal_mulai = $_REQUEST['tanggal_mulai'];
    $tanggal_akhir = $_REQUEST['tanggal_akhir'];
    $jumlah_pt = $_REQUEST['jumlah_pt'];
    $jumlah_peserta = $_REQUEST['jumlah_peserta'];
    $no_surat_tugas = $_REQUEST['no_surat_tugas'];
    $tanggal_surat_tugas = $_REQUEST['tanggal_surat_tugas'];
    $id_mahasiswa = $_REQUEST['id_mahasiswa'];
    $peran_mahasiswa = $_REQUEST['peran_mahasiswa'];
    $id_dosen = $_REQUEST['id_dosen'];
    $peran_dosen = $_REQUEST['peran_dosen'];
    $catatan = $_REQUEST['catatan'];
    $status = "";
    $validasi = 0;



    // Check if the selected value exists in the map and convert to integer
    if (isset($peran_map[$peran_mahasiswa])) {
        $peran_mahasiswa_int = $peran_map[$peran_mahasiswa];
    } else {
        $peran_mahasiswa_int = null; // Handle the case where the value is not found
    }



    // Convert the selected role to an integer
    if (isset($peran_dosen_map[$peran_dosen])) {
        $peran_dosen_int = $peran_dosen_map[$peran_dosen];
    } else {
        $peran_dosen_int = null; // Handle the case where the value is not found
    }

    ///////////////////////////////////////////////////////////////
    // Fungsi untuk mengunggah file
    function uploadFile($inputName, $prefix)
    {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == UPLOAD_ERR_OK) {
            $targetDir = "upload/";
            $randomString = bin2hex(random_bytes(8)); // Membuat nama random
            $fileExtension = pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION);
            $fileName = $prefix . "_" . $randomString . "." . $fileExtension;
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetFile)) {
                return $fileName; // Mengembalikan nama file yang telah disimpan
            } else {
                die("Error saat mengunggah file: " . $_FILES[$inputName]['name']);
            }
        }
        return null; // Jika tidak ada file yang diunggah
    }

    // Mengunggah file
    $file_surat_tugas = uploadFile('file_surat_tugas', 'file_surat_tugas');
    $foto_kegiatan = uploadFile('foto_kegiatan', 'foto_kegiatan');
    $file_poster = uploadFile('file_poster', 'file_poster');
    $file_sertifikat = uploadFile('file_sertifikat', 'file_sertifikat');

    // Query untuk menyimpan data ke tabel kompetisi
    $query = "INSERT INTO kompetisi (
    id_prodi, id_jenis_kompetisi, id_tingkat_kompetisi, judul_kompetisi, 
    judul_kompetisi_en, tempat_kompetisi, tempat_kompetisi_en, url_kompetisi, 
    tanggal_mulai, tanggal_akhir, jumlah_pt, jumlah_peserta, no_surat_tugas, 
    tanggal_surat_tugas, file_surat_tugas, foto_kegiatan, file_poster, 
    id_mahasiswa, peran_mahasiswa, file_sertifikat, id_dosen, 
    peran_dosen, catatan, status, validasi
) VALUES (
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)";



    // Menyiapkan dan mengeksekusi query
    $params = [
        $id_prodi,
        $id_jenis_kompetisi,
        $id_tingkat_kompetisi,
        $judul_kompetisi,
        $judul_kompetisi_en,
        $tempat_kompetisi,
        $tempat_kompetisi_en,
        $url_kompetisi,
        $tanggal_mulai,
        $tanggal_akhir,
        $jumlah_pt,
        $jumlah_peserta,
        $no_surat_tugas,
        $tanggal_surat_tugas,
        $file_surat_tugas,
        $foto_kegiatan,
        $file_poster,
        $id_mahasiswa,
        $peran_mahasiswa_int, // Insert the integer value for peran_mahasiswa
        $file_sertifikat,
        $id_dosen,
        $peran_dosen_int,
        $validasi,
        $catatan,
        $status
    ];

    $stmt = sqlsrv_prepare($db, $query, $params);
    if ($stmt === false || !sqlsrv_execute($stmt)) {
        die("Error in inserting data: " . print_r(sqlsrv_errors(), true));
    }
    echo "Data berhasil disimpan!";
    ///////////////////////////////////////////////////////////////
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kompetisi</title>
</head>

<body>
    <!-- kategori mahasiswa -->
    <section class="content-header">
        <div class="card">
            <div class="col-sm-12" style="padding: 10px;">
                <ol class="breadcrumb float-sm-left" style="padding: 0; margin: 0;">
                    <li class="breadcrumb-item">
                        <span class="fas fa-home" style="margin-right: 5px;"></span>
                        <a href="#" style="text-decoration: none; color: inherit;">PresMa Polinema</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="container mt-5">
                <h4><b>Kompetisi Mahasiswa</b></h4><br>
                <div class="card card-primary">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Data Kompetisi</h3>
                    </div>

                    <form action="index.php?page=tambah" method="post" enctype='multipart/form-data'>
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="prodi" class="col-sm-3 col-form-label">Program Studi</label>
                                    <div class="col-sm-3">
                                        <!--  -->
                                        <?php
                                        $query = "SELECT * from prodi";
                                        // Menyiapkan dan mengeksekusi query untuk mengambil data kompetisi
                                        $stmt = sqlsrv_prepare($db, $query);
                                        if ($stmt === false || !sqlsrv_execute($stmt)) {
                                            die(print_r(sqlsrv_errors(), true));
                                        }
                                        echo "<select name=id_prodi class='form-control' required><option></option>";
                                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                            echo "<option value='$row[id]'>$row[nama_prodi]</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jenis_kompetisi" class="col-sm-3 col-form-label">Jenis Kompetisi</label>
                                    <div class="col-sm-3">
                                        <!--  -->
                                        <?php
                                        $query = "SELECT * from jenis_kompetisi";
                                        // Menyiapkan dan mengeksekusi query untuk mengambil data kompetisi
                                        $stmt = sqlsrv_prepare($db, $query);
                                        if ($stmt === false || !sqlsrv_execute($stmt)) {
                                            die(print_r(sqlsrv_errors(), true));
                                        }
                                        echo "<select name=id_jenis_kompetisi class='form-control' required><option></option>";
                                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                            echo "<option value='$row[id]'>$row[jenis_kompetisi]</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tingkat_kompetisi" class="col-sm-3 col-form-label">Tingkat Kompetisi</label>
                                    <div class="col-sm-3">
                                        <!--  -->
                                        <?php
                                        $query = "SELECT * from tingkat_kompetisi";
                                        // Menyiapkan dan mengeksekusi query untuk mengambil data kompetisi
                                        $stmt = sqlsrv_prepare($db, $query);
                                        if ($stmt === false || !sqlsrv_execute($stmt)) {
                                            die(print_r(sqlsrv_errors(), true));
                                        }
                                        echo "<select name=id_tingkat_kompetisi class='form-control' required><option></option>";
                                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                            echo "<option value='$row[id]'>$row[tingkat_kompetisi]</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="judul_kompetisi" class="col-sm-3 col-form-label">Judul Kompetisi</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" name=judul_kompetisi type="text" placeholder="Judul Kompetisi" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="judul_kompetisi_en" class="col-sm-3 col-form-label">Judul Kompetisi (English)</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" name='judul_kompetisi_en' type="text" placeholder="Competition English" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tempat_kompetisi" class="col-sm-3 col-form-label">Tempat Kompetisi</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" name='tempat_kompetisi' type="text" placeholder="Tempat Kompetisi" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tempat_kompetisi_en" class="col-sm-3 col-form-label">Tempat Kompetisi (English)
                                    </label>
                                    <div class="col-sm-7">
                                        <input class="form-control" name=tempat_kompetisi_en type="text" placeholder="Competition Veneu" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="url_kompetisi" class="col-sm-3 col-form-label">URL Kompetisi</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" name=url_kompetisi type="text" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tanggal_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-3">
                                        <input class="form-control" name='tanggal_mulai' type="date" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tanggal_akhir" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                                    <div class="col-sm-3">
                                        <input class="form-control" name='tanggal_akhir' type="date" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jumlah_pt" class="col-sm-3 col-form-label">Jumlah PT (Berpartisipasi)
                                    </label>
                                    <div class="col-sm-3">
                                        <input class="form-control" name='jumlah_pt' type="text" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jumlah_peserta" class="col-sm-3 col-form-label">Jumlah Peserta</label>
                                    <div class="col-sm-3">
                                        <input name=jumlah_peserta class="form-control" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_surat_tugas" class="col-sm-3 col-form-label">No Surat Tugas</label>
                                    <div class="col-sm-4">
                                        <input name='no_surat_tugas' class="form-control" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tanggal_surat_tugas" class="col-sm-3 col-form-label">Tanggal Surat Tugas</label>
                                    <div class="col-sm-3">
                                        <input name='tanggal_surat_tugas' class="form-control" type="date" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="file_surat_tugas">File Surat Tugas (Maksimal 1MB)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="file_surat_tugas" type="file" class="custom-file-input" id="file_surat_tugas" accept=".pdf,.docx,.doc" onchange="validateFileSize(this)" required>
                                            <label class="custom-file-label" for="file_surat_tugas">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="foto_kegiatan">Foto Kegiatan (Maksimal 1MB)</label>
                                    <br>
                                    <?php if (!empty($row0['foto_kegiatan'])): ?>
                                        <div id="existingPreview">
                                            <p>Preview Gambar Saat Ini:</p>
                                            <img src="upload/<?php echo htmlspecialchars($row0['foto_kegiatan']); ?>" alt="Foto Kegiatan" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                        </div>
                                    <?php endif; ?>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="foto_kegiatan" type="file" class="custom-file-input" id="foto_kegiatan" accept=".jpeg,.png,.jpg" onchange="previewImage(this); validateFileSize(this);">
                                            <label class="custom-file-label" for="foto_kegiatan">Choose file</label>
                                        </div>
                                    </div>
                                    <div id="imagePreviewFotoKegiatan" style="margin-top: 10px;"></div> <!-- Tempat untuk preview gambar baru -->
                                </div>
                                <!-- terakhir edit -->
                                <div class="form-group">
                                    <label for="file_poster">File Poster (Maksimal 1MB)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="file_poster" type="file" class="custom-file-input" id="file_poster" accept=".jpeg,.png,.jpg,.pdf" onchange="validateFileSize(this)">
                                            <label class="custom-file-label" for="file_poster">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Mahasiswa</h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- Input untuk Nama Mahasiswa -->
                                        <div class="form-group">
                                            <label for="id_mahasiswa">Nama Mahasiswa</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <?php
                                                $query = "SELECT * from mahasiswa";
                                                // Menyiapkan dan mengeksekusi query untuk mengambil data mahasiswa
                                                $stmt = sqlsrv_prepare($db, $query);
                                                if ($stmt === false || !sqlsrv_execute($stmt)) {
                                                    die(print_r(sqlsrv_errors(), true));
                                                }
                                                echo "<select name='id_mahasiswa' class='form-control' required><option></option>";
                                                while ($row = sqlsrv_fetch_array($stmt)) {
                                                    echo "<option value='$row[id]'>$row[nama]</option>";
                                                }
                                                echo "</select>";
                                                ?>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->

                                        <!-- Input untuk Peran Mahasiswa -->
                                        <div class="form-group">
                                            <label for="peran_mahasiswa">Peran Mahasiswa</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                                </div>
                                                <select name="peran_mahasiswa" class="form-control" required>
                                                    <option value="">Pilih Peran</option>
                                                    <?php
                                                    foreach ($peran_map as $k => $v) {
                                                        echo "<option value='$k'>$v</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="file_sertifikat">File Sertifikat</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name='file_sertifikat' type="file" class="custom-file-input" id="file_sertifikat" accept=".jpeg,.png,.jpg,.pdf">
                                                    <label class="custom-file-label" for="foto_kegiatan">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>

                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Pembimbing</h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- Input untuk Nama Pembimbing -->
                                        <div class="form-group">
                                            <label for="id_dosen">Nama Pembimbing</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></span>
                                                </div>
                                                <?php
                                                $query = "SELECT * from dosen";
                                                // Menyiapkan dan mengeksekusi query untuk mengambil data dosen
                                                $stmt = sqlsrv_prepare($db, $query);
                                                if ($stmt === false || !sqlsrv_execute($stmt)) {
                                                    die(print_r(sqlsrv_errors(), true));
                                                }
                                                echo "<select name='id_dosen' class='form-control' required><option>Pilih Pembimbing</option>";
                                                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                                    echo "<option value='{$row['id']}'>{$row['nama_dosen']}</option>";
                                                }
                                                echo "</select>";
                                                ?>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->

                                        <!-- Input untuk Peran Pembimbing -->
                                        <div class="form-group">
                                            <label for="peran_dosen">Peran Pembimbing</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                                </div>
                                                <select name="peran_dosen" class="form-control" required>
                                                    <option value="">Pilih Peran</option>
                                                    <?php
                                                    foreach ($peran_dosen_map as $k => $v) {
                                                        echo "<option value='$k'>$v</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.card-body -->


                                </div>

                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea class="form-control" id="catatan" name="" rows="3" placeholder="Enter ..." disabled=""></textarea>
                                </div>



                                <div class="form-group">
                                    <label for="save"></label>
                                    <div class="input-group">

                                        <input type=submit value='simpan' name=simpan class='btn btn-primary'>
                                    </div>
                                </div>
                        </form>

                        <script>
                            function validateFileSize(input) {
                                const file = input.files[0];
                                if (file) {
                                    const maxSize = 1 * 1024 * 1024; // 1MB in bytes
                                    if (file.size > maxSize) {
                                        alert("Ukuran file tidak boleh lebih dari 1MB.");
                                        input.value = ""; // Reset input jika ukuran file terlalu besar
                                    }
                                }
                            }

                            // Fungsi untuk menampilkan preview gambar baru
                            function previewImage(input) {
                                const file = input.files[0];
                                const fileId = input.id;
                                let previewContainer;

                                // Select the correct preview container based on the input field's ID
                                if (fileId === 'foto_kegiatan') {
                                    previewContainer = document.getElementById('imagePreviewFotoKegiatan');
                                } else if (fileId === 'file_sertifikat') {
                                    previewContainer = document.getElementById('imagePreviewSertifikat');
                                }

                                previewContainer.innerHTML = ""; // Reset preview sebelumnya

                                if (file && file.type.startsWith('image/')) {
                                    const reader = new FileReader();

                                    reader.onload = function(e) {
                                        const img = document.createElement('img');
                                        img.src = e.target.result; // Menggunakan data URL dari FileReader
                                        img.style.maxWidth = "200px";
                                        img.style.maxHeight = "200px";
                                        img.style.border = "1px solid #ddd";
                                        img.style.padding = "5px";

                                        previewContainer.appendChild(img);
                                    };

                                    reader.readAsDataURL(file); // Membaca file dan memuat preview
                                } else {
                                    previewContainer.innerHTML = "<p>Preview tidak tersedia untuk file ini.</p>";
                                }
                            }
                        </script>



                        </script>
                        <!-- Bootstrap Bundle with Popper -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                        <!-- Optional JavaScript for custom-file-input -->
                        <script>
                            document.querySelectorAll('.custom-file-input').forEach(input => {
                                input.addEventListener('change', event => {
                                    const fileName = event.target.files[0]?.name || "Choose file";
                                    event.target.nextElementSibling.innerText = fileName;
                                });
                            });
                        </script>
</body>

</html>