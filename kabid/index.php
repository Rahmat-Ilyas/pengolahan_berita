<?php
require('template/header.php');

// CEK NASKAH BARU 
$get_naskah = mysqli_query($conn, "SELECT * FROM tb_berita WHERE status = 'verify' OR status = 'verify_' OR status = 'refuse' OR status = 'refuse_'");
$naskah_proses = mysqli_num_rows($get_naskah);

// MENUNGGU PERSETUJUAN
$get_naskah = mysqli_query($conn, "SELECT * FROM tb_berita WHERE status = 'done'");
$naskah_waiting = mysqli_num_rows($get_naskah);

// TOTAL REPORTER
$get_users = mysqli_query($conn, "SELECT * FROM tb_users WHERE jabatan = 'reporter'");
$total_reporter = mysqli_num_rows($get_users);

// TOTAL EDITOR
$get_users = mysqli_query($conn, "SELECT * FROM tb_users WHERE jabatan = 'editor'");
$total_editor = mysqli_num_rows($get_users);
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
              <h4>Total Naskah Diproses</h4>
            </div>
            <div class="card-body">
              <?= $naskah_proses ?>
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
          <div class="card-icon bg-danger">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Reporter</h4>
            </div>
            <div class="card-body">
              <?= $total_reporter ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total &nbsp;&nbsp; Editor</h4>
            </div>
            <div class="card-body">
              <?= $total_editor ?>
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
              <p class="lead">Selamat datang di Halaman Kepala Bidang. Semoga harimu menyenagkan.</p>
              <div class="mt-4">
                <a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left" data-toggle="modal" data-target="#modal-edit"><i class="far fa-user"></i> Setup Account</a>
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