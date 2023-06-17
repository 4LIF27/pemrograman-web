<?php
require_once "../../assets/dbmain/connect.php";
if (isset($_SESSION["login"])) {
  header("Location: ../"); die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="assets/img/logos.png" rel="icon">
  <title>BeritaKini - Register</title>
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../../assets/css/beritakini.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Register Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Registrasi akun</h1>
                  </div>
                  <div class="row justify-content-between">
                    <div class="col-md-5 col-lg-5">
                      <img src="../../assets/img/logo.jpg" alt="logo" class="img-fluid">
                    </div>
                    <div class="col-md-6 col-lg-6">
                      <?php
                        if (isset($_POST["submit"])) {
                          $name = mysqli_escape_string(conn(), $_POST["nama"]);
                          $email = mysqli_escape_string(conn(), $_POST["email"]);
                          $pwd = md5($_POST["pwd"]);

                          // fetch array 
                          $searchs = mysqli_query(conn(), "SELECT * FROM user WHERE email = '$email'");
                          if (mysqli_num_rows($searchs) != 0) {
                            ?>
                            <div class="alert alert-warning mb-3">
                              <strong>WAIT!</strong> Email sudah tersedia harap gunakan email yang belum terdaftar
                            </div>
                            <?php
                          } else {
                            $tambah = mysqli_query(conn(), "INSERT INTO user (`name`, `email`, `password`) value ('$name', '$email', '$pwd')");
                            if ($tambah) {
                              ?>
                              <div class="alert alert-success mb-3">
                                <strong>SUCCESS!</strong>. Akun berhasil terdaftar
                              </div>
                              <?php
                            } else {
                              ?>
                              <div class="alert alert-warning mb-3">
                                <strong>WAIT!</strong> Email sudah tersedia harap gunakan email yang belum terdaftar
                              </div>
                              <?php
                            }
                          }
                        }
                      ?>
                      <form action="" method="post">
                        <div class="form-group">
                          <label for="name">Masukan Nama</label>
                          <input type="text" class="form-control" id="name" name="nama" placeholder="Masukan nama" required>
                        </div>
                        <div class="form-group">
                          <label for="email">Email Address</label>
                          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                            placeholder="email@example.com" required>
                        </div>
                        <div class="form-group">
                          <label for="pwd">Password</label>
                          <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="submit">Registrasi</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="../login">Klik disini jika sudah punya akun</a>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Register Content -->
  <script src="../../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../../assets/js/beritakini.min.js"></script>
</body>

</html>