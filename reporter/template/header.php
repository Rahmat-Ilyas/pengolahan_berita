<?php 
require('../config.php');

if (!isset($_SESSION['login_reporter'])) {
  header("location: ../login.php");
}

$get_id = $_SESSION['get_id'];
$result = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$get_id'");
$get = mysqli_fetch_assoc($result);
$nama = $get['nama'];
$foto = $get['foto'];
$id = $get['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Halaman Reporter- TV Syiar</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../assets/modules/owlcarousel2/dist/../assets/owl.carousel.min.css">
  <link rel="stylesheet" href="../assets/modules/owlcarousel2/dist/../assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="../assets/modules/summernote/summernote-bs4.css">
  <!-- <link href="../assets/modules/summernote-0.8.18-dist/summernote-bs4.min.css" rel="stylesheet">
  <link href="../assets/modules/texteditor/editor.css" rel="stylesheet">
  <link href="../assets/modules/wysiwyg-editor-bootstrap/src/css/wysiwyg.min.css" rel="stylesheet">
  <link href="../assets/modules/wysiwyg-editor-bootstrap/src/css/highlight.min.css" rel="stylesheet"> -->
  <link href="../assets/modules/richtext-editor/css/froala_editor.min.css" rel="stylesheet">
  <link href="../assets/modules/richtext-editor/css/froala_editor.pkgd.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <script src="../assets/modules/jquery.min.js"></script>
  <!-- /END GA --></head>

  <body>
    <div id="app">
      <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
          <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
              <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
              <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
            </ul>
          </form>
          <ul class="navbar-nav navbar-right">
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="../assets/img/avatar/<?= $foto ?>" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block"><?= $nama ?></div></a>
              <div class="dropdown-menu dropdown-menu-right">
                <a href="features-profile.html" class="dropdown-item has-icon">
                  <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="../config.php?logout=true&for=login_reporter" class="dropdown-item has-icon text-danger">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <div class="main-sidebar sidebar-style-2">
          <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="index.php">
                <img src="../assets/img/logo.png" alt="logo" width="70" class="mt-2 shadow-light rounded-circle">
              </a>
              <div class="text-left pl-3">
                <hr style="margin-bottom: -5px;">
                <b style="font-size: 15px;"><?= $nama ?></b>
                <p style="margin-bottom: -10px; margin-top: -20px;">Reporter</p>
                <hr>
              </div>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
              <a href="index.html">TVS</a>
            </div>
            
            <ul class="sidebar-menu mt-3">
              <li class="menu-header">Menu Utama</li>
              <li id="dashboard"><a class="nav-link" href="index.php"><i class="fa fa-desktop"></i> <span>Dashboard</span></a></li>   
              <li class="dropdown" id="kelola_naskah">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-newspaper"></i> <span>Kelola Naskah</span></a>
                <ul class="dropdown-menu">
                  <li id="tambah_naskah"><a class="nav-link" href="tambah_naskah.php">Tambah Naskah</a></li>
                  <li id="naskah_dibuat"><a class="nav-link" href="naskah_dibuat.php">Naskah Dibuat</a></li>
                </ul>
              </li>
              <li class="dropdown" id="revisi_naskah">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-columns"></i> <span>Revisi Naskah</span></a>
                <ul class="dropdown-menu">
                  <li id="naskah_direvisi"><a class="nav-link" href="thiss">Naskah Direvisi</a></li>
                  <li id="selesai_direvisi"><a class="nav-link" href="thiss">Selesai Direvisi</a></li>
                </ul>
              </li>
              <li class="dropdown" id="data_naskah">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-file"></i> <span>Data Naskah</span></a>
                <ul class="dropdown-menu">
                  <li id="naskah_disetujui"><a class="nav-link" href="thiss">Naskah Disetujui</a></li>
                  <li id="naskah_ditolak"><a class="nav-link" href="thiss">Naskah Ditolak</a></li>
                  <li id="arsip_naskah"><a class="nav-link" href="thiss">Arsip Naskah</a></li>
                </ul>
              </li>
            </aside>
          </div>