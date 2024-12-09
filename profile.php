<!-- profile -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PresMa - Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">

    <!-- Optional: Tambahkan CSS lokal jika ada -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <style>
        body {
            padding: 40px;
            background-color: #1E6892;
        }

        .login-box {
            width: 100%;
            height: 100%;
        }

        .card-header {
            padding: 15px;
        }

        .profile-image img {
            width: 150px;
            height: 150px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning.text-white {
            color: white !important;
        }
    </style>
</head>

<!-- <body class="hold-transition login-page"> -->
    <body class="hold-transition">
    <div class="login-box">
        <div class="card card-warning">
            <div class="card-header text-center">
                <h3 class="card-title">Profil Mahasiswa</h3>
            </div>

            <!-- Form Start -->
            <form>
                <div class="card-body">
                    <div class="card-body d-flex align-items-center">
                        <div class="profile-image">
                            <img src="img/profil.png" id="profileImage" class="img-thumbnail" alt="Profile">
                        </div>
                        <div class="form-group ml-4" style="width: 100%;">
                            <label for="exampleInputFile">Ubah Foto Profil</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" accept="image/*" onchange="previewImage(event)">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <!-- Nama Lengkap -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="namaLengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="namaLengkap" placeholder="Masukkan Nama Lengkap">
                                </div>
                            </div>
                            <!-- NIM -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control" id="nim" placeholder="Masukkan NIM">
                                </div>
                            </div>
                            <!-- Jurusan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <input type="text" class="form-control" id="jurusan" value="Teknologi Informasi" disabled>
                                </div>
                            </div>
                            <!-- Prodi -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prodi">Prodi</label>
                                    <select class="form-control" id="prodi">
                                        <option selected>Pilih Prodi</option>
                                        <option>Sistem Informasi Bisnis</option>
                                        <option>Teknik Informatika</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tahun Masuk</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="2023/2024" disabled>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="changePassword">Change Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Confirm Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-12">
                            <a href="index.php" class="btn btn-warning btn-block text-white">
                                <i class="fas fa-undo"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('exampleInputPassword1');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="adminlte/dist/js/adminlte.min.js"></script>
</body>

</html>
