<?php
require_once "../assets/dbmain/connect.php";
if (!isset($_SESSION["login"])) {
  header("Location: /login"); die();
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    mysqli_query(conn(), "DELETE FROM berita WHERE id_berita = '$id'");
    header("Location: ./"); die();
}
?>