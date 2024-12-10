<?php
require_once __DIR__ . '/../lib/Connection.php';

// // Ambil data kategori jika diperlukan (untuk kategori kompetisi, dll)
// $kategori = getKategori(); // Gantilah sesuai kebutuhan
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Kompetisi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Kompetisi</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Kompetisi</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-md btn-primary" onclick="tambahData()">
                    Tambah Kompetisi
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Kompetisi</th>
                        <th>Tingkat Kompetisi</th>
                        <th>Judul Kompetisi</th>
                        <th>URL Kompetisi</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                        <th>Jumlah Peserta</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Form -->
<div class="modal fade" id="form-data" style="display: none;" aria-hidden="true">
    <form action="action/KompetisiAction.php?act=save" method="post" id="form-tambah" enctype="multipart/form-data">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kompetisi</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis Kompetisi</label>
                        <select id="jenis_kompetisi" name="jenis_kompetisi" class="form-control">
                            <option value="Lomba Ilmiah">Lomba Ilmiah</option>
                            <option value="Hackathon">Hackathon</option>
                            <option value="Olimpiade">Olimpiade</option>
                            <option value="Debat">Debat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tingkat Kompetisi</label>
                        <select id="tingkat_kompetisi" name="tingkat_kompetisi" class="form-control">
                            <option value="Lokal">Lokal</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Judul Kompetisi</label>
                        <input type="text" class="form-control" name="judul_kompetisi" id="judul_kompetisi">
                    </div>
                    <div class="form-group">
                        <label>URL Kompetisi</label>
                        <input type="text" class="form-control" name="url_kompetisi" id="url_kompetisi">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Peserta</label>
                        <input type="number" class="form-control" name="jumlah_peserta" id="jumlah_peserta">
                    </div>
                    <div class="form-group">
                        <label>File Surat Tugas</label>
                        <input type="file" class="form-control" name="file_surat_tugas" id="file_surat_tugas" accept=".pdf, .docx, .pptx">
                    </div>
                    <div class="form-group">
                        <label>File Sertifikat</label>
                        <input type="file" class="form-control" name="file_sertifikat" id="file_sertifikat" accept=".pdf, .docx, .pptx">
                    </div>
                    <div class="form-group">
                        <label>Foto Kegiatan</label>
                        <input type="file" class="form-control" name="foto_kegiatan" id="foto_kegiatan" accept="image/jpeg, image/jpg, image/png" onchange="previewImage('foto_kegiatan', 'preview-foto-kegiatan')">
                        <img id="preview-foto-kegiatan" style="display:none;" alt="Image Preview" width="150">
                    </div>
                    <div class="form-group">
                        <label>File Poster</label>
                        <input type="file" class="form-control" name="file_poster" id="file_poster" accept=".pdf, .docx, .pptx">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Function to preview image files (only jpg, png, jpeg)
    function previewImage(inputId, previewId) {
        const file = document.getElementById(inputId).files[0];
        const preview = document.getElementById(previewId);
        const validExtensions = ['image/jpeg', 'image/jpg', 'image/png']; // Valid image file types

        // Check if file is an image and is of the correct type
        if (file && validExtensions.includes(file.type)) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.style.display = 'block';
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none'; // Hide preview if file type is invalid
            alert("Please upload a valid image file (jpg, jpeg, png).");
        }
    }

    // Function to preview non-image files (like PDFs, DOCX, PPTX)
    function previewFile(inputId, previewId) {
        const file = document.getElementById(inputId).files[0];
        const preview = document.getElementById(previewId);

        if (file) {
            // Check file type and allow only PDF, DOCX, and PPTX as example
            const validExtensions = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'];

            if (validExtensions.includes(file.type)) {
                preview.textContent = file.name; // Show file name for non-image files
            } else {
                preview.textContent = ''; // Clear preview if invalid file type
                alert("Invalid file type. Only PDF, DOCX, or PPTX files are allowed.");
            }
        } else {
            preview.textContent = ''; // Clear preview if no file is selected
        }
    }

    function tambahData() {
        $('#form-data').modal('show');
        $('#form-tambah').attr('action', 'action/KompetisiAction.php?act=save');
        // Reset form and preview areas
        $('#form-tambah')[0].reset();
        $('#preview-foto-kegiatan').hide();
        $('#preview-poster').hide();
        $('#preview-surat-tugas').text('');
        $('#preview-sertifikat').text('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/KompetisiAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action', 'action/KompetisiAction.php?act=update&id=' + id);
                $('#jenis_kompetisi').val(data.jenis_kompetisi);
                $('#tingkat_kompetisi').val(data.tingkat_kompetisi);
                $('#judul_kompetisi').val(data.judul_kompetisi);
                $('#url_kompetisi').val(data.url_kompetisi);
                $('#tanggal_mulai').val(data.tanggal_mulai);
                $('#tanggal_akhir').val(data.tanggal_akhir);
                $('#jumlah_peserta').val(data.jumlah_peserta);
                // You can set file previews based on the current data, if needed
            }
        });
    }

    $(document).ready(function() {
        $('#table-data').DataTable({
            ajax: 'action/KompetisiAction.php?act=load',
        });
    });
</script>