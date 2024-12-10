<?php
require_once __DIR__ . '/../lib/Connection.php';

// Mendapatkan data kategori (jika diperlukan, bisa disesuaikan dengan konteks).
$kategori = getKategori();
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
            <p>
                Mahasiswa Politeknik Negeri Malang disiapkan untuk dapat bekerja maupun menjadi wirausaha yang sukses.
                Untuk itu, aktif dalam berbagai kegiatan lomba merupakan salah satu cara untuk mengasah kemampuan
                dan bakat para mahasiswa. Berikut beberapa prestasi yang telah diraih para mahasiswa dalam dekade terakhir.
            </p>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul Kompetisi</th>
                        <th>Tahun</th>
                        <th>Peringkat</th>
                        <th>Tingkat</th>
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
<div class="modal fade" id="form-data" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-tambah" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Prestasi Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Judul Kompetisi</label>
                        <input type="text" name="judul_kompetisi" id="judul_kompetisi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Peringkat</label>
                        <input type="text" name="peringkat" id="peringkat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tingkat</label>
                        <input type="text" name="tingkat" id="tingkat" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var tabelData;

    $(document).ready(function() {
        tabelData = $('#table-data').DataTable({
            ajax: 'action/prestasiAdminAction.php?act=load',
            columns: [{
                    data: 'no'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'judul_kompetisi'
                },
                {
                    data: 'tahun'
                },
                {
                    data: 'peringkat'
                },
                {
                    data: 'tingkat'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-sm btn-warning" onclick="editData(${data.id})">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteData(${data.id})">Hapus</button>
                        `;
                    }
                }
            ]
        });

        $('#form-tambah').validate({
            submitHandler: function(form) {
                $.ajax({
                    url: $(form).attr('action'),
                    method: 'post',
                    data: $(form).serialize(),
                    success: function(response) {
                        const result = JSON.parse(response);
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

    function tambahData() {
        $('#form-data').modal('show');
        $('#form-tambah').attr('action', 'action/prestasiAdminAction.php?act=save');
        $('#nama, #judul_kompetisi, #tahun, #peringkat, #tingkat').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/prestasiAdminAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                const data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action', 'action/prestasiAdminAction.php?act=update&id=' + id);
                $('#nama').val(data.nama);
                $('#judul_kompetisi').val(data.judul_kompetisi);
                $('#tahun').val(data.tahun);
                $('#peringkat').val(data.peringkat);
                $('#tingkat').val(data.tingkat);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: 'action/prestasiAdminAction.php?act=delete&id=' + id,
                method: 'post',
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.status) {
                        tabelData.ajax.reload();
                    } else {
                        alert(result.message);
                    }
                }
            });
        }
    }
</script>