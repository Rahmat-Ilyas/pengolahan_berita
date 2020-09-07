<?php
require('template/header.php');

// CEK NASKAH DIBUAT 
$getNaskah_dibuat = mysqli_query($conn, "SELECT * FROM tb_berita WHERE user_id = '$id'");
$naskah_dibuat = mysqli_num_rows($getNaskah_dibuat);

// CEK NASKAH KOREKSI 
$getNaskah_koreksi = mysqli_query($conn, "SELECT * FROM tb_berita WHERE user_id = '$id' AND (status = 'correction' OR status = 'revisi')");
$naskah_koreksi = mysqli_num_rows($getNaskah_koreksi);

// CEK NASKAH WAITING 
$getNaskah_waiting = mysqli_query($conn, "SELECT * FROM tb_berita WHERE user_id = '$id' AND status = 'done'");
$naskah_waiting = mysqli_num_rows($getNaskah_waiting);

// CEK NASKAH VERIFY 
$getNaskah_verify = mysqli_query($conn, "SELECT * FROM tb_berita WHERE user_id = '$id' AND (status = 'verify' OR status = 'verify_')");
$naskah_verify = mysqli_num_rows($getNaskah_verify);
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-newspaper"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Naskah Dibuat</h4>
            </div>
            <div class="card-body">
              <?= $naskah_dibuat ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-columns"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Naskah Direvisi</h4>
            </div>
            <div class="card-body">
              <?= $naskah_koreksi ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Menunggu Persetujuan</h4>
            </div>
            <div class="card-body">
              <?= $naskah_waiting ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-check"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Naskah Disetujui</h4>
            </div>
            <div class="card-body">
              <?= $naskah_verify ?>
            </div>
          </div>
        </div>
      </div>                  
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12 mb-4">
          <div class="hero bg-primary text-white">
            <div class="hero-inner">
              <h2>Selamat Datang <?= $nama ?></h2>
              <p class="lead">Selamat datang di Halaman Reporter. Semoga harimu menyenagkan.</p>
              <div class="mt-4">
                <a href="profile.php" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Setup Account</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  $(document).ready(function() {
    $('#dashboard').addClass('active');
  });
</script>
<?php 
require('template/footer.php');
?>