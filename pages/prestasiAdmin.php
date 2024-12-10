<section class="content">
    <div class="card">
        <div class="card-header">
            <h4><b>Daftar Prestasi</b></h4>
            <!-- <br> -->
            <p>Mahasiswa Politeknik Negeri Malang disiapkan untuk dapat bekerja maupun menjadi wirausaha yang sukses. Untuk itu, aktif dalam berbagai kegiatan lomba merupakan salah satu cara untuk mengasah kemampuan dan bakat para mahasiswa. Berikut beberapa prestasi yang telah diraih para mahasiswa dalam dekade terakhir</p>
        </div>

        <!-- tabel -->
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">
                <thead>
                    <tr>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Nama</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Judul Kompetisi</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Tahun</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Peringkat</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Tingkat</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Aksi</th>
                    </tr>
                </thead>
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">1</td>
                    <td>Atsila</td>
                    <td>Bussiness Plan</td>
                    <td>2024</td>
                    <td>Juara 1</td>
                    <td>Nasional</td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger btn-sm" onclick="deleteRecord(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr class="even">
                    <td class="dtr-control sorting_1" tabindex="0">2</td>
                    <td>Rheina</td>
                    <td>Bussiness Plan</td>
                    <td>2024</td>
                    <td>Juara 1</td>
                    <td>Nasional</td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger btn-sm" onclick="deleteRecord(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">3</td>
                    <td>Afgan</td>
                    <td>Bussiness Plan</td>
                    <td>2024</td>
                    <td>Juara 1</td>
                    <td>Nasional</td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger btn-sm" onclick="deleteRecord(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">3</td>
                    <td>Bimantara</td>
                    <td>Bussiness Plan</td>
                    <td>2024</td>
                    <td>Juara 1</td>
                    <td>Nasional</td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger btn-sm" onclick="deleteRecord(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">3</td>
                    <td>Puput</td>
                    <td>Bussiness Plan</td>
                    <td>2024</td>
                    <td>Juara 1</td>
                    <td>Nasional</td>
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