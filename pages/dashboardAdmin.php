<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Hanya panggil session_start jika sesi belum dimulai
}
require_once __DIR__ . '/../lib/Connection.php';

$queryStatusCounts = "
SELECT 
    status, 
    COUNT(*) AS jumlah 
FROM kompetisi 
GROUP BY status
";

$stmtStatusCounts = sqlsrv_query($db, $queryStatusCounts);
if ($stmtStatusCounts === false) {
    die(print_r(sqlsrv_errors(), true));
}

$statusCounts = [
    'Pending' => 0,
    'Diterima' => 0,
    'Ditolak' => 0,
];

while ($row = sqlsrv_fetch_array($stmtStatusCounts, SQLSRV_FETCH_ASSOC)) {
    $statusCounts[$row['status']] = $row['jumlah'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .small-box {
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 14px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .small-box .icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 40px;
            color: rgba(0, 0, 0, 0.1);
        }

        .small-box-footer {
            display: block;
            padding: 10px 0;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
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

    <section class="content">
        <div class="card-dash">
            <div class="card-header">
                <h3 class="card-title"><b>Dashboard Admin</b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="row" style="justify-content: center; padding:15px;">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $statusCounts['Pending'] ?></h3>
                            <p>Pending</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <a href="index.php?page=kompetisi&status=Pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $statusCounts['Diterima'] ?></h3>
                            <p>Diterima</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="index.php?page=kompetisi&status=Diterima" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $statusCounts['Ditolak'] ?></h3>
                            <p>Ditolak</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <a href="index.php?page=kompetisi&status=Ditolak" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>