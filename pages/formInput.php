<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                    <li class="breadcrumb-item active">Form Kompetisi Mahasiswa</li>
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
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Program Studi</label>
                                <div class="col-sm-5">
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Pilih Program Studi</option>
                                        <option>Teknik Informatika</option>
                                        <option>Sistem Informasi Bisnis</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis Kompetisi</label>
                                <div class="col-sm-5">
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Pilih Kompetisi</option>
                                        <option>Hackton</option>
                                        <option>Programer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Tingkat Kompetisi</label>
                                <div class="col-sm-5">
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Pilih Tingkat Kompetisi</option>
                                        <option>Nasional</option>
                                        <option>Internasional</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Judul Kompetisi</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" placeholder="Judul Kompetisi">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Judul Kompetisi (English)
                                </label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" placeholder="Competition English">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Tempat Kompetisi</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" placeholder="Judul Kompetisi">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Tempat Kompetisi (English)
                                </label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" placeholder="Competition Veneu">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">URL Kompetisi</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3"  class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="date">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="date">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah PT (Berpartisipasi)
                                </label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Peserta</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">No Surat Tugas</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal Surat Tugas</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="date">
                                </div>
                            </div>

                            <!DOCTYPE html>
                            <html lang="en">

                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Form Upload</title>
                                <!-- Bootstrap CSS -->
                                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
                                    rel="stylesheet">
                                <style>
                                .container {
                                    margin-top: 50px;
                                }

                                .form-label {
                                    font-weight: bold;
                                }

                                .form-group {
                                    display: flex;
                                    align-items: center;
                                    margin-bottom: 30px;
                                }

                                .form-group label {
                                    flex: 0 0 200px;
                                }

                                .form-control {
                                    max-width: 400px;
                                }

                                .custom-upload-label {
                                    background-color: #007bff;
                                    color: white;
                                    padding: 8px 12px;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    font-size: 14px;
                                    font-weight: bold;
                                }

                                .info-text {
                                    font-size: 12px;
                                    color: gray;
                                    margin-top: 5px;
                                }

                                .placeholder-image {
                                    width: 250px;
                                    height: 150px;
                                    background-color: #f0f0f0;
                                    display: inline-block;
                                    border: 1px solid #ddd;
                                    margin-left: 20px;
                                    text-align: center;
                                    line-height: 150px;
                                    color: #aaa;
                                    font-size: 14px;
                                }
                                </style>
                            </head>

                            <body>
                                <div class="container">
                                    <!-- File Surat Tugas -->
                                    <div class="form-group d-flex align-items-center justify-content-between">
                                        <label for="fileSuratTugas" class="form-label">File Surat Tugas</label>
                                        <div class="upload-container">
                                            <div class="d-flex">
                                                <label for="fileSuratTugas" class="custom-upload-label">Pilih
                                                    File</label>
                                                <input type="file" id="fileSuratTugas" class="form-control d-inline"
                                                    style="display: none;">
                                            </div>
                                            <div class="info-text mt-2">
                                                <small>Ukuran (Max: 5000Kb)</small>
                                                <small class="ms-5">Ekstensi (.jpg, .jpeg, .png, .pdf, .docx)</small>
                                            </div>
                                        </div>
                                        <div class="placeholder-image">
                                            <div class="image-container">
                                                IMAGE NOT AVAILABLE
                                            </div>
                                        </div>
                                    </div>


                                    <!-- File Sertifikat -->
                                    <div class="form-group d-flex align-items-center justify-content-between">
                                        <label for="fileSertifikat" class="form-label">File Sertifikat</label>
                                        <div class="upload-container">
                                            <div class="d-flex ">
                                                <label for="fileSertifikat" class="custom-upload-label">Pilih
                                                    File</label>
                                                <input type="file" id="fileSertifikat" class="form-control d-inline"
                                                    style="display: none;">
                                            </div>
                                            <div class="info-text mt-2">
                                                <small>Ukuran (Max: 5000Kb)</small>
                                                <small class="ms-5">Ekstensi (.jpg, .jpeg, .png, .pdf, .docx)</small>
                                            </div>
                                        </div>
                                        <div class="placeholder-image">
                                            <div class="image-container">
                                                IMAGE NOT AVAILABLE
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Foto Kegiatan -->
                                    <div class="form-group">
                                        <label for="fotoKegiatan" class="form-label">Foto Kegiatan</label>
                                        <div>
                                            <label for="fotoKegiatan" class="custom-upload-label">Pilih File</label>
                                            <input type="file" id="fotoKegiatan" class="form-control d-inline"
                                                style="display: none;">
                                            <small class="info-text d-block mt-2">Ukuran (Max: 5000Kb) Ekstensi (.jpg,
                                                .jpeg, .png, .pdf, .docx)</small>
                                            <div class="placeholder-image">IMAGE NOT AVAILABLE</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Bootstrap Bundle with Popper -->
                                <script
                                    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
                                </script>

                                <!DOCTYPE html>
                                <html lang="en">

                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <title>Form Data Mahasiswa dan Pembimbing</title>
                                    <!-- AdminLTE CSS -->
                                    <link rel="stylesheet"
                                        href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
                                    <!-- Bootstrap CSS -->
                                    <link rel="stylesheet"
                                        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                                    <!-- Font Awesome -->
                                    <link rel="stylesheet"
                                        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
                                </head>

                                <body class="hold-transition sidebar-mini">

                                    <div class="container mt-5">
                                        <div class="card card-primary">
                                            <div class="card-header bg-primary text-white">
                                                <h5 class="card-title">Data Mahasiswa</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Mahasiswa</th>
                                                            <th>Peran</th>
                                                            <th>Hapus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="mahasiswa-body">
                                                        <tr>
                                                            <td>1</td>
                                                            <td>
                                                                <select class="form-control" name="mahasiswa[]">
                                                                    <option>Pilih NIM Mahasiswa</option>
                                                                    <option>123456 - John Doe</option>
                                                                    <option>123457 - Jane Smith</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control" name="peran[]">
                                                                    <option>Pilih Peran</option>
                                                                    <option>Ketua</option>
                                                                    <option>Anggota</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    onclick="deleteRow(this)">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <button type="button" class="btn btn-success mt-3"
                                                    onclick="addMahasiswa()">
                                                    <i class="fa fa-plus"></i> Tambah Mahasiswa
                                                </button>
                                            </div>
                                        </div>

                                        <div class="card card-warning mt-4">
                                            <div class="card-header bg-warning text-white">
                                                <h5 class="card-title">Data Pembimbing</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Pembimbing</th>
                                                            <th>Peran Pembimbing</th>
                                                            <th>Hapus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="pembimbing-body">
                                                        <tr>
                                                            <td>1</td>
                                                            <td>
                                                                <select class="form-control" name="pembimbing[]">
                                                                    <option>Pilih Dosen</option>
                                                                    <option>Dr. A</option>
                                                                    <option>Dr. B</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control" name="peran_pembimbing[]">
                                                                    <option>Pilih Peran</option>
                                                                    <option>Pembimbing Utama</option>
                                                                    <option>Pembimbing Pendamping</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    onclick="deleteRow(this)">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <button type="button" class="btn btn-success mt-3"
                                                    onclick="addPembimbing()">
                                                    <i class="fa fa-plus"></i> Tambah Pembimbing
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                            <button class="btn btn-secondary"><i class="fa fa-arrow-left"></i>
                                                Kembali</button>
                                        </div>
                                    </div>

                                    <!-- Scripts -->
                                    <script>
                                    function deleteRow(button) {
                                        const row = button.parentNode.parentNode;
                                        row.parentNode.removeChild(row);
                                    }

                                    function addMahasiswa() {
                                        const tbody = document.getElementById('mahasiswa-body');
                                        const rowCount = tbody.rows.length + 1;
                                        const row = `
            <tr>
                <td>${rowCount}</td>
                <td>
                    <select class="form-control" name="mahasiswa[]">
                        <option>Pilih NIM Mahasiswa</option>
                        <option>123456 - John Doe</option>
                        <option>123457 - Jane Smith</option>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="peran[]">
                        <option>Pilih Peran</option>
                        <option>Ketua</option>
                        <option>Anggota</option>
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;
                                        tbody.insertAdjacentHTML('beforeend', row);
                                    }

                                    function addPembimbing() {
                                        const tbody = document.getElementById('pembimbing-body');
                                        const rowCount = tbody.rows.length + 1;
                                        const row = `
            <tr>
                <td>${rowCount}</td>
                <td>
                    <select class="form-control" name="pembimbing[]">
                        <option>Pilih Dosen</option>
                        <option>Dr. A</option>
                        <option>Dr. B</option>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="peran_pembimbing[]">
                        <option>Pilih Peran</option>
                        <option>Pembimbing Utama</option>
                        <option>Pembimbing Pendamping</option>
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;
                                        tbody.insertAdjacentHTML('beforeend', row);
                                    }
                                    </script>
                                </body>

                                </html>





                                <!-- /.card-body -->
                    </form>
                </div>
            </div>
        </div>
    </section>





    <script>
    function editData(id) {
        $.ajax({
            url: 'action/kategoriAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action', 'action/kategoriAction.php?act=update&id=' + id);
                $('#kategori_kode').val(data.kategori_kode);
                $('#kategori_nama').val(data.kategori_nama);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/kategoriAction.php?act=delete&id=' + id,
                method: 'post',
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status) {
                        tabelData.ajax.reload();
                    } else {
                        alert(result.message);
                    }
                }
            });
        }
    }

    var tabelData;
    $(document).ready(function() {
        tabelData = $('#table-data').DataTable({
            ajax: 'action/kategoriAction.php?act=load',
        });

        $('#form-tambah').validate({
            rules: {
                kategori_kode: {
                    required: true,
                    minlength: 3
                },
                kategori_nama: {
                    required: true,
                    minlength: 5
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                $.ajax({
                    url: $(form).attr('action'),
                    method: 'post',
                    data: $(form).serialize(),
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status) {
                            $('#form-data').modal('hide');
                            tabelData.ajax.reload();
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        });
    });
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