<?php 
require('../config.php');

if (!isset($_SESSION['login_kabid'])) {
  header("location: ../login.php");
}

$get_id = $_SESSION['get_id'];
$result = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$get_id'");
$get = mysqli_fetch_assoc($result);
$nama = $get['nama'];
$foto = $get['foto'];
$id = $get['id'];

// CEK NASKAH BARU 
$get_proses = mysqli_query($conn, "SELECT * FROM tb_berita WHERE status = 'done'");
$menunggu_diproses = mysqli_num_rows($get_proses);

// CEK USER BARU 
$get_user_verify = mysqli_query($conn, "SELECT * FROM tb_users WHERE status = 'waiting'");
$user_verify = mysqli_num_rows($get_user_verify);

$user = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$id'");
$dta = mysqli_fetch_assoc($user);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Halaman Kepala Bidang- TV Syiar</title>

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
                <a href="#" class="dropdown-item has-icon" data-toggle="modal" data-target="#modal-edit">
                  <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="../config.php?logout=true&for=login_kabid" class="dropdown-item has-icon text-danger">
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
                <p style="margin-bottom: -10px; margin-top: -20px;">Kepala Bidang</p>
                <hr>
              </div>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
              <a href="index.html">TVS</a>
            </div>
            
            <ul class="sidebar-menu mt-3">
              <li class="menu-header">Menu Utama</li>
              <li id="dashboard"><a class="nav-link" href="index.php"><i class="fa fa-desktop"></i> <span>Dashboard</span></a></li>   
              <li class="dropdown" id="proses_naskah">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                  <?php if ($menunggu_diproses >= 1) { ?>
                    <span class="beep" style="width: 40px;">
                      <i class="fa fa-newspaper" style="margin-left: -2px;"></i>
                    </span>
                  <?php } else { ?>
                    <i class="fa fa-newspaper"></i>
                  <?php } ?>
                  <span>Proses Naskah</span>
                </a>
                <ul class="dropdown-menu">
                  <li id="menunggu_diproses">
                    <a class="nav-link" href="menunggu_diproses.php">Menunggu Diproses 
                      <?php if ($menunggu_diproses >= 1) { ?>
                        <span class="badge badge-danger text-center mb-3" style="width: 14px; padding: 2px; font-size: 10px;"><b><?= $menunggu_diproses ?></b></span>
                      <?php } ?>
                    </a>
                  </li>
                  <li id="selesai_diproses">
                    <a class="nav-link" href="selesai_diproses.php">Selesai Diproses</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown" id="repoter_editor">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                  <?php if ($user_verify >= 1) { ?>
                    <span class="beep" style="width: 40px;">
                      <i class="fa fa-users" style="margin-left: -2px;"></i>
                    </span>
                  <?php } else { ?>
                    <i class="fa fa-users"></i>
                  <?php } ?>
                  <span>Reporter & Editor</span>
                </a>
                <ul class="dropdown-menu">
                  <li id="data_reporter">
                    <a class="nav-link" href="data_reporter.php">Data Reporter
                      <?php if ($user_verify >= 1) { ?>
                        <span class="badge badge-danger text-center mb-3" style="width: 14px; padding: 2px; font-size: 10px;"><b><?= $user_verify ?></b></span>
                      <?php } ?>
                    </a>
                  </li>
                  <li id="data_editor">
                    <a class="nav-link" href="data_editor.php">Data Editor</a>
                  </li>
                </ul>
              </li>
              <li id="kategori_berita"><a class="nav-link" href="kategori_berita.php"><i class="fa fa-list"></i> <span>Kategori Berita</span></a></li>   
            </aside>
          </div>