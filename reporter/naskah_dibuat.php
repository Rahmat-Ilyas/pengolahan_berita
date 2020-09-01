<?php 
require('template/header.php');

$berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE status != 'finish' AND user_id = '$id'");
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Naskah Dibuat</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Naskah Yang Telah Dibuat</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>                                 
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th style="max-width: 180px;">Judul Berita</th>
                      <th>Kategori</th>
                      <th>Tanggal Dibuat</th>
                      <th>Konten</th>
                      <th>Isi Berita</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; foreach($berita as $dta) { 
                      if ($dta['status'] == 'waiting') {
                          $caption = 'Diproses';
                          $color = 'badge-info';
                       } 
                       else if ($dta['status'] == 'revisi') {
                          $caption = 'Direvisi';
                          $color = 'badge-warning'; 
                       } else if ($dta['status'] == 'done') {
                          $caption = 'Ditinjau';
                          $color = 'badge-secondary'; 
                       } else if ($dta['status'] == 'verify') {
                          $caption = 'Disetujui';
                          $color = 'badge-success'; 
                       } else if ($dta['status'] == 'refuse') {
                          $caption = 'Ditolak';
                          $color = 'badge-danger'; 
                       } ?>                                 
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $dta['judul'] ?></td>
                        <td><?= $dta['kategori'] ?></td>
                        <td><?= date('d/m/Y', strtotime($dta['tanggal'])) ?></td>
                        <td>
                          <?php if ($dta['konten'] != null) { ?>
                            <a href="#" class="btn btn-icon icon-left btn-light btn-sm" data-toggle="modal" data-target="#modal-konten<?= $dta['id'] ?>"><i class="far fa-file"></i> Lihat Konten</a>
                          <?php } else { ?>
                            <a href="#" class="btn btn-icon icon-left btn-light btn-sm disabled"><i class="far fa-file"></i> Lihat Konten</a>
                          <?php } ?>
                        </td>
                        <td>
                          <a href="#" class="btn btn-icon icon-left btn-primary btn-sm" data-toggle="modal" data-target="#modal-berita<?= $dta['id'] ?>"><i class="far fa-eye"></i> Lihat Naskah</a>
                        </td>
                        <td>
                          <div class="badge <?= $color ?> col-12"><?= $caption ?></div>
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

  <?php foreach($berita as $dtam) { ?>   
    <!-- MODAL KONTEN -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-konten<?= $dtam['id'] ?>">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Lihat Konten</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <audio class="mt-2 mb-0 col-md-12 audio" controls="">
                <source src="../assets/konten/<?= $dtam['konten'] ?>" type="">
                </audio>
              </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>

      <!-- MODAL BERITA -->
      <div class="modal fade" tabindex="-1" role="dialog" id="modal-berita<?= $dtam['id'] ?>">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Isi Berita</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body border m-4">
              <h6><?= $dtam['judul'] ?></h6>
              <hr>
              <?= $dtam['berita_created'] ?>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <script>
      $(document).ready(function() {
        $('#kelola_naskah').addClass('active');
        $('#naskah_dibuat').addClass('active');

        $('.modal').on('hidden.bs.modal', function() {
          var audio = $('.audio');
          $.each(audio, function(i, val) {
            val.pause();
          });
        });
      });
    </script>
    <?php 
    require('template/footer.php');
    ?>