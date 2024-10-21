<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: login.php");
}
else{
    $id = $_GET['id'];
    require_once("koneksi.php");
    $sql = "SELECT * FROM hospital WHERE id_hospital = '$id'";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetch();
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
    <title>Dashboard</title>

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
                    </div>
                    <br>
                    <div class="row" style="width: 50%;">
                        <div class="card-body" style="background-color: white;">
                            <h3 class="m-0 font-weight-bold text-primary">Lokasi</h3>
                            <br>
                            <div class="dropdown no-arrow">
                                <div class="row">
                                    <table>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>Team Name</td>
                                            <td><?= $hasil['name_hospital']?></td>
                                            <th>Active</th>
                                        </tr>
                                        <tr>
                                            <td><br></td>
                                            <td><br></td>
                                            <td><br></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td><?= $hasil['line_hospital']?></td>
                                            <th><?= $hasil['lastUpdated_hospital']?></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="row">
                        <h1>Daily Summary</h1>
                        <div class="col-xl-6">
                            <div class="card-body" style="background-color: white;">
                                <br>
                                <div class="dropdown no-arrow">
                                    <div class="row">
                                        <table>
                                            <?php
                                            $rooms = rand(10,30);
                                            ?>
                                            <tr>
                                                <th><h3>Remain Patient</h3></th>
                                                <th><h3><?php $pat = rand(1,$rooms); echo $pat?></h3></th>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <th><h3>Empty Bed</h3></th>
                                                <th><h3><?= $rooms-$pat?></h3></h3></th>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td>New</td>
                                                <td><?= rand(1,7)?></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td>Discharge</td>
                                                <td><?= rand(1,3)?></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td>Previous</td>
                                                <td><?= rand(5,13)?></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td>Live birth</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td>Total bed capacity</td>
                                                <td><?= $rooms?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6"><div id="map" style="height: 400px;"></div></div>
                    </div>
                    <div class="row">
                        
                    </div>
                    <br>
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
    <script type="text/javascript">
        // Your Mapbox access token
        mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FnYWdhMTU5IiwiYSI6ImNseW9lODZsMDAweGEya3NndGV3ODBpMGoifQ.F7yRGxKA9Ro7jrH9gDp9sA';

        // Initialize the map
        var map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v11', // style URL
            center: [-72.5001, 42.2449], // starting position [lng, lat]
            zoom: 9 // starting zoom
        });

        // Add navigation controls to the map
        map.addControl(new mapboxgl.NavigationControl());

        // Add markers to the map
        const marker1 = new mapboxgl.Marker()
        .setLngLat([-72.5001, 42.2449])
        .addTo(map);

        const marker2 = new mapboxgl.Marker()
        .setLngLat([-71.6836, 42.2092])
        .addTo(map);

        const marker3 = new mapboxgl.Marker()
        .setLngLat([-72.6497, 42.1255])
        .addTo(map);
    </script>

</body>

</html>