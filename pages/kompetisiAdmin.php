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
            <!-- tabel -->
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">
                <thead>
                    <tr>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Judul Kompetisi</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Keterangan</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Edit/Detail</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Hapus</th>
                    </tr>
                </thead>
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">1</td>
                    <td>Bussiness Plan</td>
                    <td>Keterangan</td>
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-sm" onclick="showDetails(1)">
                            <i class="fas fa-clipboard-list"></i>
                        </button>
                    </td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger btn-sm" onclick="deleteRecord(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr class="even">
                    <td class="dtr-control sorting_1" tabindex="0">2</td>
                    <td>Bussiness Plan</td>
                    <td>Keterangan</td>
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-sm" onclick="showDetails(1)">
                            <i class="fas fa-clipboard-list"></i>
                        </button>
                    </td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger btn-sm" onclick="deleteRecord(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">3</td>
                    <td>Bussiness Plan</td>
                    <td>Keterangan</td>
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-sm" onclick="showDetails(1)">
                            <i class="fas fa-clipboard-list"></i>
                        </button>
                    </td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger btn-sm" onclick="deleteRecord(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">3</td>
                    <td>Bussiness Plan</td>
                    <td>Keterangan</td>
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-sm" onclick="showDetails(1)">
                            <i class="fas fa-clipboard-list"></i>
                        </button>
                    </td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger btn-sm" onclick="deleteRecord(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">3</td>
                    <td>Bussiness Plan</td>
                    <td>Keterangan</td>
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-sm" onclick="showDetails(1)">
                            <i class="fas fa-clipboard-list"></i>
                        </button>
                    </td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger btn-sm" onclick="deleteRecord(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- tutup tabel -->
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