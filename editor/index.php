<?php
require('template/header.php');

// CEK NASKAH BARU 
$getNaskah_new = mysqli_query($conn, "SELECT * FROM tb_berita WHERE status = 'waiting'");
$naskah_new = mysqli_num_rows($getNaskah_new);

// CEK NASKAH DONE 
$naskah_done = 0;
foreach ($revisi as $rev) {
  $berita_id = $rev['berita_id'];
  $berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE id = '$berita_id' AND (status = 'done')");
  $dta = mysqli_fetch_assoc($berita);
  if ($dta) $naskah_done = $naskah_done + 1;
}

// CEK NASKAH VERIFY ALL
$naskah_verify_all = 0;
foreach ($revisi as $rev) {
  $berita_id = $rev['berita_id'];
  $berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE id = '$berita_id' AND (status = 'verify' OR status = 'verify_')");
  $dta = mysqli_fetch_assoc($berita);
  if ($dta) $naskah_verify_all = $naskah_verify_all + 1;
}
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
              <h4>Naskah Baru Mausk</h4>
            </div>
            <div class="card-body">
              <?= $naskah_new ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-undo"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Naskah Koreksi</h4>
            </div>
            <div class="card-body">
              <?= $naskah_revisi ?>
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
              <?= $naskah_done ?>
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
              <?= $naskah_verify_all ?>
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
              <p class="lead">Selamat datang di Halaman Editor. Semoga harimu menyenagkan.</p>
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