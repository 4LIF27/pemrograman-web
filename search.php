<?php
require_once "assets/dbmain/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="berita terikini">
  <meta name="author" content="Riski Darmawan">
  <link href="assets/img/logos.png" rel="icon">
  <title>BeritaKini - Home</title>
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/beritakini.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="assets/img/logo_berita.png">
        </div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#berita"
          aria-expanded="true" aria-controls="berita">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Berita Terkini</span>
        </a>
        <div id="berita" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Berita</h6>
            <?php
                $gets = mysqli_query(conn(), "SELECT * FROM kategori");
                while ($z = mysqli_fetch_assoc($gets)) {
                ?>
                    <a class="collapse-item text-capitalize" href="index.php?filter=<?= $z["id_kategori"] ?>"><?= $z["kategori"] ?></a>
                <?php
                }
            ?>
          </div>
        </div>
      </li>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="navbar-search" action="search.php" method="get">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-1 small" name="vsearch" placeholder="Cari judul berita/Artikel"
                      aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;" required>
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="/admin/login/">
                <img class="img-profile rounded-circle" src="assets/img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">Login Admin</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Berita Terkini</h1>
          </div>

          <div class="row mb-3">
            <?php
              if (isset($_GET["vsearch"])) {
                $filter = mysqli_escape_string(conn(), $_GET["vsearch"]);
                $berita = mysqli_query(conn(), "SELECT * FROM `berita` WHERE `judul` LIKE '%$filter%'");
                if (mysqli_num_rows($berita) == 0) {
                  ?>
                  <div class="text-centers">
                    <div class="alert alert-warning">
                      <strong>Maaf sepertinya halaman yang anda akses belum ada ditambahkan oleh admin / konten saat ini tidak tersedia. coba lagi dihari lain</strong>
                    </div>
                  </div>
                  <?php
                } else {
                  while ($z = mysqli_fetch_assoc($berita)) {
                    ?>
                    <div class="col-xl-3 col-md-6 mb-4">
                      <a href="read.php?idberita=<?= $z["id_berita"] ?>" class="text-decoration-none text-secondary">
                        <div class="card rounded">
                          <img src="../assets/<?= $z["gambar"] ?>" alt="" class="card-img-top w-100 h-75 text-centers">
                          <div class="card-body">
                            <div class="text-lg font-weight-bold text-capitalize mb-1"><?= $z["judul"] ?></div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <?php
                  }
                }
              } else {
                ?>
                <div class="text-centers">
                    <div class="alert alert-warning">
                        <strong>Maaf sepertinya halaman yang anda akses belum ada ditambahkan oleh admin / konten saat ini tidak tersedia. coba lagi dihari lain</strong>
                    </div>
                </div>
                <?php
              }
            ?>
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

  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="assets/js/beritakini.min.js"></script>
</body>

</html>