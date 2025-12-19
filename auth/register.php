<?php
require '../config/config.php';
?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    .select-user {
        border-radius: 20rem;
        height: calc(1.5em + 1.75rem + 2px);
        padding: 0.75rem 1rem;
        font-size: 0.85rem;
        color: #6e707e;
    }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="proses_register.php" method="POST" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control form-control-user"
                                            placeholder="Masukkan username" required>

                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control form-control-user"
                                            placeholder="Masukkan Nama Lengkap" required>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-label">Kelas</label>

                                        <select name="kelas_id" required class="form-control select-user">
                                            <option value="">Pilih Kelas</option>
                                            <?php
        $kelas = mysqli_query($conn, "SELECT * FROM kelas");
        while ($k = mysqli_fetch_assoc($kelas)) {
            echo "<option value='{$k['id']}'>{$k['nama_kelas']}</option>";
        }
        ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control form-control-user"
                                            placeholder="Masukkan password" required>
                                    </div>
                                </div>
                                <input type="hidden" name="role" value="siswa">

                                <button type="submit" name="register" class="btn btn-primary btn-user btn-block"">
                                    Daftar
                                </button>
                                    <hr>
                                    <a href=" index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                    </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>