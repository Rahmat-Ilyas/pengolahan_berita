<?php 
require('template/header.php');

$berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE status = 'waiting'");
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
              <h4>Naskah Baru Masuk</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>                                 
                    <tr>
                      <th style="max-width: 180px;">Judul Berita</th>
                      <th>Reporter</th>
                      <th>Kategori</th>
                      <th>Tanggal Dibuat</th>
                      <th>Konten</th>
                      <th>Isi Berita</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($berita as $dta) {
                      $user_id = $dta['user_id'];
                      $reporter = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$user_id'");
                      $usr = mysqli_fetch_assoc($reporter); ?>                                 
                      <tr>
                        <td><?= $dta['judul'] ?></td>
                        <td class="text-center">
                          <a href="#" data-toggle="modal" data-target="#modal-reporter<?= $dta['id'] ?>">
                            <img alt="image" src="../assets/img/avatar/<?= $usr['foto'] ?>" class="rounded-circle" data-toggle="tooltip" title="" data-original-title="<?= $usr['nama'] ?>" width="35">
                          </a>
                        </td>
                        <td><?= $dta['kategori'] ?></td>
                        <td><?= date('d/m/Y', strtotime($dta['tanggal'])) ?></td>
                        <td class="text-center">
                          <?php if ($dta['konten'] != null) { ?>
                            <a href="#" class="btn btn-icon icon-left btn-light btn-sm" data-toggle="modal" data-target="#modal-konten<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Lihat Konten"><i class="far fa-file"></i></a>
                          <?php } else { ?>
                            <a href="#" class="btn btn-icon icon-left btn-light btn-sm disabled" data-toggle1="tooltip" title="" data-original-title="Lihat Konten"><i class="far fa-file"></i></a>
                          <?php } ?>
                        </td>
                        <td class="text-center">
                          <a href="#" class="btn btn-icon icon-left btn-primary btn-sm" data-toggle="modal" data-target="#modal-berita<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Lihat Isi Berita"><i class="far fa-eye"></i></a>
                        </td>
                        <td style="min-width: 140px; max-width: 140px;" class="text-center">
                          <a href="koreksi_berita.php?berita_id=<?= $dta['id'] ?>" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-keyboard"></i> Koreksi</a>
                          <a href="controller.php?accept=true&from=naskah_baru&berita_id=<?= $dta['id'] ?>&editor_id=<?= $id ?>" class="btn btn-icon btn-sm btn-success"><i class="fas fa-check"></i> Accept</a>
                        </td>
                      </tr>
                    <?php } ?>
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

<?php foreach($berita as $dtam) { 
  $user_id = $dtam['user_id'];
  $reporter = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$user_id'");
  $usr = mysqli_fetch_assoc($reporter); ?>   
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

    <!-- MODAL REPORTER -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-reporter<?= $dtam['id'] ?>">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Reporter</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card author-box card-primary m-0">
              <div class="card-body">
                <div class="author-box-left">
                  <img alt="image" src="../assets/img/avatar/<?= $usr['foto'] ?>" class="rounded-circle author-box-picture">
                </div>
                <div class="author-box-details">
                  <div class="author-box-name">
                    <a href="#"><?= $usr['nama'] ?></a>
                  </div>
                  <div class="author-box-job">Reporter</div>
                  <hr>
                  <div class="author-box-description">
                    <p>
                      Telepon: <?= $usr['no_hp'] ?> <br>
                      Alamat: <?= $usr['alamat'] ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
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
      $('[data-toggle1="tooltip"]').tooltip();
      $('#kelola_naskah').addClass('active');
      $('#naskah_baru').addClass('active');

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