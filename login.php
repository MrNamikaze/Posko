<?php 
$usr = 0;
require_once("koneksi.php");
session_start();
$nilai = isset ($_SESSION["user"]) ? $_SESSION["user"]:'';
if($nilai){
    header("Location: index.php");
}
else{
    if(isset($_POST['login'])){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $sql = "SELECT * FROM user WHERE email=:email";
        $stmt = $db->prepare($sql);
        
        // bind parameter ke query
        $params = array(
            ":email" => $email
        );

        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // jika user terdaftar
        if($user){
            // verifikasi password
            if(password_verify($password, $user["password"])){
                // buat Session
                session_start();
                $_SESSION["user"] = $user;
                // login sukses, alihkan ke halaman timeline
                header("Location: index.php");
            }
            else{
                $usr = 2;
            }
        }
        else{
            $usr = 1;
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

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-4">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat datang pada website</h1>
                                        <h1 class="h4 text-gray-900 mb-4">Posko Bencana</h1>
                                        <img src="img/Terbakar.png" style="width: 300px; height: 250px">
                                    </div>
                                    <br>
                                    <!-- jika user tidak ada -->
                                    <?php if($usr=='1'):?>
                                    <div class="alert alert-danger" role="alert">
                                      Email tidak terdaftar!!
                                    </div>
                                    <?php endif;?>
                                    <?php if($usr=='2'):?>
                                    <div class="alert alert-danger" role="alert">
                                      Password salah!!
                                    </div>
                                    <?php endif;?>
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" name="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password">
                                        </div>
                                        <input type="submit" name="login" class="btn btn-primary btn-user btn-block" value="Submit">
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>