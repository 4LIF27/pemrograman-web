<?php
require_once "../../assets/dbmain/connect.php";
if (!isset($_SESSION["login"])) {
  header("Location: ../../admin/login"); die();
}
error_reporting(0);

$email = $_SESSION["login"];
$searchs = mysqli_query(conn(), "SELECT * FROM user WHERE email = '$email'");
$fetch = mysqli_fetch_assoc($searchs);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="../../assets/img/logos.png" rel="icon">
  <title>BeritaKini - Admin Tambah Berita</title>
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../../assets/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
  <link href="../../assets/css/beritakini.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?= navigasi_admin(); ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="../../assets/img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?= $fetch["name"]; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Berita</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
          </div>

          <div class="row mb-3">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Berita</h6>
                    </div>
                    <div class="card-body container"> 
                        <?php
                          if (isset($_POST["submit"])) {
                            $judul = $_POST["judul"];
                            $penulis = $_POST["penulis"];
                            $kategori = $_POST["kategori"];
                            $content = $_POST["content"];
                            $id = uniqid();
                            // $dts = CURDATE();

                            if ($_FILES["thumb"]["tmp_name"] != ""){
                              $tmp = $_FILES["thumb"]["tmp_name"];
                              $ext = $_FILES["thumb"]["name"];
                              $size = $_FILES["thumb"]["size"];
                              $error = $_FILES["thumb"]["error"];
                              $throw = null;

                              if ($error !== 4){
                                $search_ext = strtolower(end(explode(".", $ext)));
                                if ($size > 9000000){
                                  $throw = "Minimal gambar berukuran 2mb";
                                } else {
                                  if (in_array($search_ext, array("png", "jpg", "jpeg"))){
                                    move_uploaded_file($tmp, "../../assets/dbimg/$id.$search_ext");
                                  } else {
                                    $throw = "extensi gambar tidak valid";
                                  }
                                }
                              } else {
                                $throw = "file gambar error";
                              }
                            }

                            if ($throw != null) {
                              ?>
                              <div class="alert alert-warning mb-3">
                                <strong>WAIT!</strong> <?= $throw ?>
                              </div>
                              <?php
                            } else {
                              $syntax = "INSERT INTO berita (`id_berita`, `tgl_berita`, `judul`, `penulis`, `gambar`, `berita`, `id_kategori`) VALUES ('$id', CURDATE(), '$judul', '$penulis', 'dbimg/$id.$search_ext', '$content', '$kategori')";
                              if (mysqli_query(conn(), $syntax)) {
                                ?>
                                <div class="alert alert-success mb-3">
                                  <strong>SUCCESS!</strong> Berhasil menambahkan content
                                </div>
                                <?php
                              } else {
                                ?>
                                <div class="alert alert-warning mb-3">
                                  <strong>WAIT!</strong> Gagal menambahkan content
                                </div>
                                <?php
                              }
                            }
                          }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="mb-3 row">
                                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="judul" id="judul" placeholder="judul berita" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3 row">
                                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="penulis" name="penulis" placeholder="nama penulis" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3 row">
                                    <label for="thumb" class="col-sm-2 col-form-label">Thumbnail</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="thumb" name="thumb" required>
                                            <label class="custom-file-label" for="thumb">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3 row">
                                    <label for="ktg" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select class="select2-single-placeholder form-control h-100" name="kategori" id="ktg" required>
                                          <?php
                                            $gets = mysqli_query(conn(), "SELECT * FROM kategori");
                                            while ($z = mysqli_fetch_assoc($gets)) {
                                              ?>
                                              <option value="<?= $z["id_kategori"] ?>"><?= $z["kategori"] ?></option>
                                              <?php
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3 row">
                                    <label for="content" class="col-sm-2 col-form-label">Masukan Content (html juga bisa)</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="content" name="content" rows="8" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary" name="submit" type="submit">Tambahkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
          <!--Row-->

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Peringatan !!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Apakah anda yakin untuk logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batalkan</button>
                  <a href="../logout.php" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b>Riski Darmawan</b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../../assets/vendor/select2/dist/js/select2.min.js"></script>
  <script src="../../assets/js/beritakini.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.select2-single').select2();

      // Select2 Single  with Placeholder
      $('.select2-single-placeholder').select2({
        placeholder: "Select a Province",
        allowClear: true
      });      

      // Select2 Multiple
      $('.select2-multiple').select2();
    });
  </script>
</body>

</html>