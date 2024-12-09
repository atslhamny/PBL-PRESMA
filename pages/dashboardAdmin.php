<!-- dashboard admin -->

<style>
    /* General styling */
    .breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
    }

    .breadcrumb a {
        text-decoration: none;
        color: inherit;
    }


    .info-box {
        display: flex;
        align-items: center;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 1px 5px rgba(0, 0, 0.5, 0.3);
    }

    .info-box-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .card {
        box-shadow: 0 6px 7px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .card-dash {
        box-shadow: 0 6px 7px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 20px;
        background-color: white;

    }

    .card img {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .chart-container {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        padding: 20px;
    }

    .chart-container .card {
        width: 48%;
    }

    .berita {
        padding: 20px;
    }

    .berita .card {
        width: 16rem;
        padding: 10px;
        box-shadow: 0 6px 7px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }

    .berita img {
        border-radius: 5px 5px 0 0;
    }

    .berita .card-title {
        font-size: 15px;
        margin-bottom: 5px;
    }

    .berita .card-text {
        font-size: 14px;
        color: #555;
    }

    .berita .btn {
        font-size: 14px;
    }
</style>

<!-- Dashboard mahasiswa -->
<section class="content-header">
    <div class="card">
        <div class="col-sm-12" style="padding: 10px;">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item">
                    <span class="fas fa-home" style="margin-right: 5px;"></span>
                    <a href="#">PresMa Polinema</a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card-dash">
        <div class="card-header">
            <h3 class="card-title"><b>Dashboard</b></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <h4><b style="color: #03618D;">Selamat Datang Rheina Putri,</b> Anda login sebagai Mahasiswa</h4>
        </div>

        <div class="row" style="justify-content: center; padding:15px;">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-lightblue" style="border-radius: 20px;">
                    <div class="inner" style="padding: 14px;">
                        <h3>150</h3>
                        <p>Kompetisi Mahasiswa</p>
                    </div>
                    <div class="icon" style="padding: 5px;">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <a href="kompetisi.php" class="small-box-footer" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-maroon" style="border-radius: 20px;">
                    <div class="inner" style="padding: 14px;">
                        <h3>150</h3>
                        <p>Mahasiswa Berprestasi</p>
                    </div>
                    <div class="icon" style="padding: 5px;">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <a href="pages/prestasi.php" class="small-box-footer" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning" style="border-radius: 20px;">
                    <div class="inner" style="padding: 14px;">
                        <h3>150</h3>
                        <p>Prestasi Mahasiswa</p>
                    </div>
                    <div class="icon" style="padding: 5px;">
                        <i class="fas fa-medal"></i>
                    </div>
                    <a href="pages/prestasi.php" class="small-box-footer" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <!-- Berita section -->
        <div class="berita">
            <h3 class="berita-header">
                <b>Berita Terbaru</b>
                <a href="" class="add-icon">
                    <i class="fas fa-plus"></i>
                </a>
            </h3>

            <div style="display: flex; gap: 25px;">
                <div class="card">
                    <!-- icon hapus -->
                    <span style="position: absolute; top: 13px; right: 13px; cursor: pointer; color: #fff; padding: 5px; border-radius: 50%;">
                        <i class="fas fa-trash"></i>
                    </span>

                    <img src="img/berita.jpg" alt="Berita image">
                    <div class="card-body">
                        <h6 class="card-title">Mahasiswa Polinema</h6>
                        <p class="card-text">Some quick example text to build on the card title.</p>
                        <a href="https://mbkm.polinema.ac.id/" class="btn btn-primary">Baca selengkapnya..</a>
                    </div>
                </div>
                <div class="card">
                    <!-- icon hapus -->
                    <span style="position: absolute; top: 13px; right: 13px; cursor: pointer; color: #fff; padding: 5px; border-radius: 50%;">
                        <i class="fas fa-trash"></i>
                    </span>
                    <img src="img/berita.jpg" alt="Berita image">
                    <div class="card-body">
                        <h6 class="card-title">Mahasiswa Polinema</h6>
                        <p class="card-text">Some quick example text to build on the card title.</p>
                        <a href="https://mbkm.polinema.ac.id/" class="btn btn-primary">Baca selengkapnya..</a>
                    </div>
                </div>
                <div class="card">
                    <!-- icon hapus -->
                    <span style="position: absolute; top: 13px; right: 13px; cursor: pointer; color: #fff; padding: 5px; border-radius: 50%;">
                        <i class="fas fa-trash"></i>
                    </span>
                    <img src="img/berita.jpg" alt="Berita image">
                    <div class="card-body">
                        <h6 class="card-title">Mahasiswa Polinema</h6>
                        <p class="card-text">Some quick example text to build on the card title.</p>
                        <a href="https://mbkm.polinema.ac.id/" class="btn btn-primary">Baca selengkapnya..</a>
                    </div>
                </div>
                <div class="card">
                    <!-- icon hapus -->
                    <span style="position: absolute; top: 13px; right: 13px; cursor: pointer; color: #fff; padding: 5px; border-radius: 50%;">
                        <i class="fas fa-trash"></i>
                    </span>
                    <img src="img/berita.jpg" alt="Berita image">
                    <div class="card-body">
                        <h6 class="card-title">Mahasiswa Polinema</h6>
                        <p class="card-text">Some quick example text to build on the card title.</p>
                        <a href="https://mbkm.polinema.ac.id/" class="btn btn-primary">Baca selengkapnya..</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('visitors-chart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                    label: 'This Week',
                    data: [100, 200, 300, 400, 500, 600, 700],
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    fill: true
                },
                {
                    label: 'Last Week',
                    data: [90, 180, 270, 350, 420, 550, 680],
                    borderColor: '#808080',
                    backgroundColor: 'rgba(128, 128, 128, 0.1)',
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    const ctxDonut = document.getElementById('donutChart').getContext('2d');
    new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
            datasets: [{
                data: [20, 15, 25, 30, 10],
                backgroundColor: ['#f56954', '#3c8dbc', '#f39c12', '#00a65a', '#605ca8']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>