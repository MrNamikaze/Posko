<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: login.php");
}
else{
    require_once("koneksi.php");
    $sql3 = "SELECT * FROM user WHERE id = ".$_SESSION["user"]["id"];
    $row3 = $db->prepare($sql3);
    $row3->execute();
    $hasil3 = $row3->fetch();
    if(isset($_POST['login'])){
        $filter_patient = filter_input(INPUT_POST, 'filter_patient', FILTER_SANITIZE_STRING);
        $filter_hospital = filter_input(INPUT_POST, 'filter_hospital', FILTER_SANITIZE_STRING);
        $filter_date_before = filter_input(INPUT_POST, 'filter_date_before', FILTER_SANITIZE_STRING);
        $filter_date_after = filter_input(INPUT_POST, 'filter_date_after', FILTER_SANITIZE_STRING);
        $data[] = $filter_patient;
        $data[] = $filter_hospital;
        $data[] = $filter_date_before;
        $data[] = $filter_date_after;
        $data[] = $_SESSION["user"]["id"];
        $sql = "UPDATE user SET filter_patient=?, filter_hospital=?, filter_date_before=?, filter_date_after=? WHERE id=?";
        $stmt = $db->prepare($sql);

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($data);
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved){
            header("Location: profile.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profile</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style type="text/css">
        .box1{
        width:150px;
        height:150px;
        background:LightSkyBlue;
        color: white;
        border:solid 3px black;
        }
        .box2{
        width:150px;
        height:150px;
        background:red;
        color: white;
        border:solid 3px black;
        }
        .color{
          color: black;
        }
        body {
        background: url('img/pesawat.jpeg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
      }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require "sidebar.php";?>
        <!-- End of Sidebar -->

            <!-- Main Content -->
            <div id="content" style="width: 100%">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-danger">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    Syahrul
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="img/">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="view_image.php">
                                    <i class="fas fa-image fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Image
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
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
                        <h1 class="color h3 mb-0">Profile</h1>
                    </div>
                    <br>
                    <form class="user" action="" method="POST">
                    <div class="row">
                        
                        <div class="col-xl-6 col-md-12 mb-2">
                            <input type="number" class="form-control form-control-user" id="email" name="filter_patient" aria-describedby="emailHelp" placeholder="Limit Patient" value="<?= $hasil3['filter_patient']?>">
                        </div>
                        <div class="col-xl-6 col-md-12 mb-2">
                            <input type="number" class="form-control form-control-user" id="email" name="filter_hospital" aria-describedby="emailHelp" placeholder="Limit Hospital" value="<?= $hasil3['filter_hospital']?>">
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-xl-6 col-md-12 mb-2">
                            <input type="date" class="form-control form-control-user" id="email" name="filter_date_before" aria-describedby="emailHelp" placeholder="Date Before" value="<?= $hasil3['filter_date_before']?>">
                        </div>
                        <div class="col-xl-6 col-md-12 mb-2">
                            <input type="date" class="form-control form-control-user" id="email" name="filter_date_after" aria-describedby="emailHelp" placeholder="Date After" value="<?= $hasil3['filter_date_after']?>">
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="login" class="btn btn-primary btn-user btn-block" value="Submit">
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Anda yakin mau logout?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
    <!-- Page level custom scripts -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
</body>

</html>