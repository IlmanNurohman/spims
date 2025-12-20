<?php
require '../config/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'piket') {
    die('Akses ditolak');
}

$user_id = $_SESSION['user_id']; 

$cekPiket = mysqli_query($conn, "
    SELECT id 
    FROM jadwal_piket
    WHERE user_id = '$user_id'
    AND tanggal_piket = CURDATE()
");

$petugasAktif = mysqli_num_rows($cekPiket) > 0;

$query = mysqli_query($conn, "
    SELECT izin.*, siswa.nama, kelas.nama_kelas
    FROM izin
    JOIN siswa ON izin.siswa_id = siswa.id
    JOIN kelas ON siswa.kelas_id = kelas.id
    WHERE izin.status = 'menunggu'
    ORDER BY izin.waktu_pengajuan DESC
");
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Spims</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
    /* Custom file input: browse di kiri */
    .custom-file-left .custom-file-label {
        padding-left: 100px;
    }

    .custom-file-left .custom-file-label::after {
        left: 0;
        right: auto;
        border-right: 1px solid #ced4da;
        border-left: 0;
        border-radius: .25rem 0 0 .25rem;
    }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="../assets/img/logoizin.png" alt="Logo"
                        style="width:40px; height:40px; object-fit:contain;">
                </div>

                <div class="sidebar-brand-text">SPIMS <br> MAN 1 GARUT</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="indexkelas.php">
                    <i class="fas fa-layer-group"></i>

                    <span>Pengajuan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="jadwal_piket.php">
                    <i class="fas fa-calendar-alt"></i>

                    <span>Jadwal Piket</span>
                </a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Petugas Piket</span>
                                <i class="fas fa-user fa-sm fa-fw"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Pengajuan</h1> <br>

                    </div>


                    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                    <div class="alert alert-success">
                        Pengajuan izin berhasil dikirim.
                    </div>
                    <?php endif; ?>
                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan</h6>
                                </div>


                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Kelas</th>
                                                    <th>Jenis Izin</th>
                                                    <th>Keterangan</th>
                                                    <th>Waktu</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php if (mysqli_num_rows($query) > 0):
                                                    $no = 1;
                                                    while ($row = mysqli_fetch_assoc($query)): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                                    <td><?= htmlspecialchars($row['nama_kelas']) ?></td>
                                                    <td><?= htmlspecialchars($row['jenis_izin']) ?></td>
                                                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                                    <td><?= date('d-m-Y H:i', strtotime($row['waktu_pengajuan'])) ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($petugasAktif): ?>
                                                        <button type="button"
                                                            class="btn btn-sm btn-primary btn-validasi"
                                                            data-id="<?= $row['id'] ?>"
                                                            data-nama="<?= htmlspecialchars($row['nama']) ?>"
                                                            data-jenis="<?= htmlspecialchars($row['jenis_izin']) ?>"
                                                            data-keterangan="<?= htmlspecialchars($row['keterangan']) ?>"
                                                            data-foto="<?= $row['foto'] ?>">
                                                            Validasi
                                                        </button>
                                                        <?php else: ?>
                                                        <span class="badge badge-secondary">Tidak Bertugas</span>
                                                        <?php endif; ?>
                                                    </td>

                                                </tr>
                                                <?php endwhile;
                                                else: ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak ada pengajuan</td>
                                                </tr>
                                                <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Silahkan Klik "Logout" Untuk Keluar Dan Mengakhiri Sesion.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../auth/logout.php">Logout</a>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal Ajukan Izin -->
    <div class="modal fade" id="modalValidasi" tabindex="-1" role="dialog" aria-labelledby="modalValidasiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalValidasiLabel">Validasi Izin Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="proses_validasi.php" method="post">
                    <div class="modal-body">
                        <div class="bg-light border rounded p-3">

                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <th width="150px">Nama Siswa</th>
                                    <td>: <b id="modalNama"></b></td>
                                </tr>
                                <tr>
                                    <th>Jenis Izin</th>
                                    <td>: <span id="modalJenis"></span></td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>: <span id="modalKeterangan"></span></td>
                                </tr>
                                <tr>
                                    <th>Foto</th>
                                    <td>:
                                        <button type="button" id="btnLihatFoto" class="btn btn-sm btn-info"
                                            data-toggle="modal" data-target="#modalFoto" style="display:none;">
                                            Lihat Foto
                                        </button>
                                        <span id="noFoto" class="text-muted">Tidak ada foto</span>
                                    </td>
                                </tr>

                            </table>

                            <input type="hidden" name="id" id="modalId">

                        </div>

                        <hr>

                        <div class="form-group">
                            <label>Tentukan Status</label>
                            <select name="status" class="form-control" required>
                                <option value="">-- Pilih Keputusan --</option>
                                <option value="disetujui" class="text-success">Setujui</option>
                                <option value="ditolak" class="text-danger">Tolak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Catatan / Alasan</label>
                            <textarea name="catatan" class="form-control" rows="3"
                                placeholder="Contoh: Silakan beristirahat atau Alasan ditolak karena..."
                                required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Validasi</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Foto Bukti Izin</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center">
                    <img id="fotoIzin" src="" class="img-fluid rounded" alt="Foto izin">
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

    <!-- Page level plugins -->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/chart-area-demo.js"></script>
    <script src="../assets/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

    <script>
    let currentData = {};

    $('#dataTable').on('click', '.btn-validasi', function() {
        currentData = {
            id: $(this).data('id'),
            nama: $(this).data('nama'),
            jenis: $(this).data('jenis'),
            keterangan: $(this).data('keterangan'),
            foto: $(this).data('foto')
        };

        $('#modalValidasi').modal('show');
    });

    $('#modalValidasi').on('show.bs.modal', function() {
        $('#modalId').val(currentData.id);
        $('#modalNama').text(currentData.nama);
        $('#modalJenis').text(currentData.jenis);
        $('#modalKeterangan').text(currentData.keterangan);

        if (currentData.foto) {
            $('#btnLihatFoto').show();
            $('#noFoto').hide();
            $('#fotoIzin').attr('src', '../uploads/izin/' + currentData.foto);
        } else {
            $('#btnLihatFoto').hide();
            $('#noFoto').show();
            $('#fotoIzin').attr('src', '');
        }
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const alertBox = document.querySelector('.alert');

        if (alertBox) {
            setTimeout(() => {
                // efek fade out
                alertBox.classList.remove('show');
                alertBox.classList.add('fade');

                setTimeout(() => {
                    alertBox.remove();
                }, 500);
            }, 3000); // 3 detik
        }
    });
    </script>

</body>

</html>