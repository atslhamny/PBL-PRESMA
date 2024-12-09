<?php
require_once __DIR__ . '/../lib/Connection.php';

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
            <!-- <br> -->
            <p>Mahasiswa Politeknik Negeri Malang disiapkan untuk dapat bekerja maupun menjadi wirausaha yang sukses. Untuk itu, aktif dalam berbagai kegiatan lomba merupakan salah satu cara untuk mengasah kemampuan dan bakat para mahasiswa. Berikut beberapa prestasi yang telah diraih para mahasiswa dalam dekade terakhir</p>

            <!-- <div class="card-tools">
                <button type="button" class="btn btn-md btn-primary" onclick="tambahData()">
                    Tambah Prestasi
                </button>
            </div> -->

        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul Kompetisi</th>
                        <th>Tahun</th>
                        <th>Peringkat</th>
                        <th>Tingkat</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
</section>



<script>
    function tambahData() {
        $('#form-data').modal('show');
        $('#form-tambah').attr('action', 'action/prestasiAction.php?act=save');
        $('#buku_kode').val('');
        $('#buku_nama').val('');
        $('#kategori_id').val('');
        $('#jumlah').val('');
        $('#deskripsi').val('');
        $('#gambar').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/prestasiAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action', 'action/prestasiAction.php?act=update&id=' + id);
                $('#buku_kode').val(data.buku_kode);
                $('#buku_nama').val(data.buku_nama);
                $('#kategori_id').val(data.kategori_id).trigger('change');
                $('#jumlah').val(data.jumlah);
                $('#deskripsi').val(data.deskripsi || '');
                $('#gambar').val(data.gambar);
            }
        });
    }


    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/prestasiAction.php?act=delete&id=' + id,
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
            ajax: 'action/prestasiAction.php?act=load',
        });
        $('#form-tambah').validate({
            rules: {
                buku_kode: {
                    required: true
                },
                buku_nama: {
                    required: true
                },
                kategori_id: {
                    required: true
                },
                jumlah: {
                    required: true,
                    number: true,
                    min: 1
                },
                deskripsi: {
                    required: true
                },
                gambar: {
                    url: true
                },
            },
            messages: {
                kategori_id: {
                    required: "Kategori harus dipilih."
                },
                deskripsi: {
                    required: "Deskripsi tidak boleh kosong."
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                $.ajax({
                    url: $(form).attr('action'),
                    method: 'post',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
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