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

    $sql = "SELECT * FROM patient LIMIT ".$hasil3['filter_patient'];
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetchAll();

    $sql2 = "SELECT * FROM hospital LIMIT ".$hasil3['filter_hospital'];
    $row2 = $db->prepare($sql2);
    $row2->execute();
    $hasil2 = $row2->fetchAll();
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
                        <h1 class="color h3 mb-0">Dashboard</h1>
                        <a href="export_excel.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Export Excel</a>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card-body">
                                <div class="card shadow mb-4">
                                    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card-body">
                                <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Total Pasien</h6>
                                            <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                    aria-labelledby="dropdownMenuLink">
                                                    <div class="dropdown-header">Dropdown Header:</div>
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="chart-pie pt-4 pb-2">
                                                <canvas id="myPieChart"></canvas>
                                            </div>
                                            <div class="mt-4 text-center small">
                                                <span class="mr-2">
                                                    <i class="fas fa-circle text-primary"></i> Laki-laki
                                                </span>
                                                <span class="mr-2">
                                                    <i class="fas fa-circle text-success"></i> Perempuan
                                                </span>
                                                <span class="mr-2">
                                                    <i class="fas fa-circle text-info"></i> Total = 50<p id="totalPatient"></p>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xl-6 col-md-12 mb-4">
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
                                                <?php foreach ($hasil2 as $a => $b): ?>
                                                    <tr>
                                                        <td><i class="fas fa-angle-up"></i></td>
                                                        <td><?= $b['name_hospital'];?></td>
                                                        <td><?= $b['active_hospital'];?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card-body">
                                <div class="card shadow mb-4">
                                        <div id="map" style="height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a=1; foreach ($hasil as $c => $d): ?>
                                <tr>
                                    <td><?php echo $a; $a++?></td>
                                    <td><?= $d['given_patient']?></td>
                                    <td><?= $d['family_patient']?></td>
                                    <td><?= $d['line_patient']?></td>
                                    <td><?= $d['city_patient']?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
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
        new DataTable('#example');
        // Your Mapbox access token
        mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FnYWdhMTU5IiwiYSI6ImNseW9lODZsMDAweGEya3NndGV3ODBpMGoifQ.F7yRGxKA9Ro7jrH9gDp9sA';

        // Initialize the map
        var map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v11', // style URL
            center: [-71.0826, 42.2416], // starting position [lng, lat]
            zoom: 9 // starting zoom
        });

        // Add navigation controls to the map

        addMarkerFromAddress();
        async function addMarkerFromAddress() {
            const c = [];
            <?php $a=0; foreach ($hasil2 as $a => $b){ ?>
                c[<?= $a?>] = "<?= $b['line_hospital'].', '.$b['city_hospital'].', '.$b['country_hospital'].', '.$b['postalCode_hospital']?>";
            <?php $a++;}?>
            for (var i = 0; i < c.length; i++) {
                const address = '58 TREMONT STREET, TAUNTON, US, 2780';
                const geocodingUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(c[i])}.json?access_token=${mapboxgl.accessToken}`;

                try {
                    const response = await fetch(geocodingUrl);
                    const data = await response.json();

                    if (data.features.length > 0) {
                        const { center, place_name } = data.features[0]; // Get coordinates and place name

                        // Create a marker and add it to the map
                        new mapboxgl.Marker({})
                            .setLngLat(center)
                            .setPopup(new mapboxgl.Popup().setText(place_name)) // Add a popup to the marker
                            .addTo(map);

                        // Center the map on the marker
                        if(i == 0){
                            map.flyTo({ center: center, zoom: 14 });
                        }
                    } else {
                        alert('Address not found!');
                    }
                } catch (error) {
                    console.error('Error fetching geocoding data:', error);
                }
            }
        }
        //
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: ["Laki-Laki", "Perempuan", "Perempuan Hamil"],
            datasets: [{
              data: [23, 17, 10],
              backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
              hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
              hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
          },
          options: {
            maintainAspectRatio: false,
            tooltips: {
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "#858796",
              borderColor: '#dddfeb',
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              caretPadding: 10,
            },
            legend: {
              display: false
            },
            cutoutPercentage: 80,
          },
        });
        //
        var xValues = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
        var yValues = [0, 17, 3, 8, 14, 9, 12];
        var barColors = ["red", "green","blue","orange","brown", "green", "green"];

        new Chart("myChart", {
          type: "bar",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            legend: {display: false},
            title: {
              display: true,
              text: "Weekly Patient"
            }
          }
        });
    </script>

</body>

</html>