<?php 
require('template/header.php');

$reporter = mysqli_query($conn, "SELECT * FROM tb_users WHERE jabatan = 'reporter' ORDER BY status DESC");
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Menunggu Diproses</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Naskah Menunggu Diproses</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>                                 
                    <tr>
                      <th>Foto</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Telepon</th>
                      <th>Username</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; foreach($reporter as $dta) { 
                      if ($dta['status'] == 'active') {
                        $caption = 'Aktif';
                        $color = 'badge-success';
                        $button = 'nonaktif';
                      } else if ($dta['status'] == 'nonactive') {
                        $caption = 'Nonaktif';
                        $color = 'badge-warning';
                        $button = 'aktif';
                      } else if ($dta['status'] == 'waiting') {
                        $caption = 'Baru';
                        $color = 'badge-info';
                        $button = 'aktif';
                      } ?>                     
                      <tr>
                        <td>
                          <img alt="image" src="../assets/img/avatar/<?= $dta['foto'] ?>" class="rounded-circle" width="35">
                        </td>
                        <td><?= $dta['nama'] ?></td>
                        <td><?= $dta['alamat'] ?></td>
                        <td><?= $dta['no_hp'] ?></td>
                        <td><?= $dta['username'] ?></td>
                        <td>
                          <div class="badge <?= $color ?> col-12"><?= $caption ?></div>
                        </td>
                        <td style="min-width: 80px; max-width: 80px;">
                          <?php if ($button == 'aktif') { ?>
                            <a href="controller.php?set_reporter=active&reporter_id=<?= $dta['id'] ?>" class="btn btn-icon btn-sm btn-success btn-block" data-toggle1="tooltip" title="" data-original-title="Aktifkan"><i class="fa fa-user-check"></i> Aktifkan</a>
                          <?php } else { ?>
                            <a href="controller.php?set_reporter=nonactive&reporter_id=<?= $dta['id'] ?>" class="btn btn-icon btn-sm btn-danger btn-block" data-toggle1="tooltip" title="" data-original-title="Nonaktifkan"><i class="fa fa-user-times"></i> Nonaktifkan</a>
                          <?php } ?>
                        </td>
                      </tr>
                      <?php $i = $i + 1; } ?>
                    </tbody>
                  </table>
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
      $('[data-toggle1="tooltip"]').tooltip();
      $('#repoter_editor').addClass('active');
      $('#data_reporter').addClass('active');
    });
  </script>
  <?php 
  require('template/footer.php');
  ?>