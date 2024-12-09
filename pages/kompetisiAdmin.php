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
        <div class="card-header">
            <div class="deskripsi">
                <h4><b>Daftar Kompetisi</b></h4>
                <p>
                    Kompetisi mahasiswa Politeknik Negeri Malang adalah ajang pengembangan keterampilan dan
                    kreativitas yang bertujuan meningkatkan daya saing mahasiswa di berbagai bidang. Kompetisi ini
                    mempersiapkan mahasiswa menjadi individu yang unggul, inovatif, dan siap berkontribusi di dunia
                    industri.
                </p>
            </div>
            <div class="card-tools">
                <a href="index.php?page=input" class="btn btn-md-right btn-primary text-white">Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>
<div class="modal fade" id="form-data" style="display: none;" aria-hidden="true">
    <form action="action/kategoriAction.php?act=save" method="post" id="form-tambah">
        <!-- Ukuran Modal
        modal-sm : Modal ukuran kecil
        modal-md : Modal ukuran sedang
        modal-lg : Modal ukuran besar
        modal-xl : Modal ukuran sangat besar
        penerapan setelah class modal-dialog seperti di bawah
        -->
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Kategori</label>
                        <input type="text" class="form-control" name="kategori_kode"
                            id="kategori_kode">
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" class="form-control" name="kategori_nama"
                            id="kategori_nama">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" datadismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function tambahData() {
        $('#form-data').modal('show');
        $('#form-tambah').attr('action', 'action/kategoriAction.php?act=save');
        $('#kategori_kode').val('');
        $('#kategori_nama').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/kategoriAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/kategoriAction.php?act=update&id=' + id);
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
                            tabelData.ajax.reload(); // reload data tabel
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        });
    });
</script>