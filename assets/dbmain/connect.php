<?php
session_start();
define("DATABASE", "beritakini");
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");

function conn() {
    $conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    if (!$conn) {
        echo "gagal koneksi"; die();
    }
    return $conn;
}


function loc_now_admin(){
    $url = $_SERVER["HTTP_HOST"];
    if (empty($_SERVER["REQUEST_SCHEME"])){
        $ssl = "http://";
    }else{
        $ssl = $_SERVER["REQUEST_SCHEME"]."://";
    }
    $run = $ssl.$url."/admin/";
    return $run;
}

function loc_now(){
    $url = $_SERVER["HTTP_HOST"];
    if (empty($_SERVER["REQUEST_SCHEME"])){
        $ssl = "http://";
    }else{
        $ssl = $_SERVER["REQUEST_SCHEME"]."://";
    }
    $run = $ssl.$url."/";
    return $run;
}

function navigasi_admin() {
    return '
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="'.loc_now().'assets/img/logo_berita.png">
      </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="'.loc_now_admin().'">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <li class="nav-item mb-2">
      <a class="nav-link" href="'.loc_now_admin().'/tambah">
        <i class="fas fa-fw fa-plus-circle"></i>
        <span>Tambahkan Berita</span>
      </a>
    </li>
    <div class="version" id="version-beritakini"></div>
  </ul>
    ';
}
?>