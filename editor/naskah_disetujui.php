<?php
require('template/header.php');

$revisi = mysqli_query($conn, "SELECT * FROM tb_revisi WHERE editor_id = '$id'");
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Naskah Disetujui</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Naskah Yang Disetujui</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th style="max-width: 200px;">Judul Berita</th>
                      <th>Reporter</th>
                      <th>Kategori</th>
                      <th>Tanggal Dibuat</th>
                      <th>Hasil Akhir Berita</th>
                      <th style="width: 120px;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($revisi as $rev) {
                      $berita_id = $rev['berita_id'];
                      $berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE id = '$berita_id' AND status = 'verify'");
                      $dta = mysqli_fetch_assoc($berita);

                      if ($dta) {
                        $user_id = $dta['user_id'];
                        $reporter = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$user_id'");
                        $usr = mysqli_fetch_assoc($reporter); ?>
                        <tr>
                          <td><?= $dta['judul'] ?></td>
                          <td>
                            <a href="#" data-toggle="modal" data-target="#modal-reporter<?= $dta['id'] ?>">
                              <img alt="image" src="../assets/img/avatar/<?= $usr['foto'] ?>" class="rounded-circle" data-toggle="tooltip" title="" data-original-title="<?= $usr['nama'] ?>" width="35">
                            </a>
                          </td>
                          <td><?= $dta['kategori'] ?></td>
                          <td><?= date('d/m/Y', strtotime($dta['tanggal'])) ?></td>
                          <td>
                            <a href="#" class="btn btn-icon icon-left btn-primary btn-sm" data-toggle="modal" data-target="#modal-berita<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Lihat Hasil Akhir Naskah"><i class="far fa-eye"></i> Lihat Naskah</a>
                          </td>
                          <td>
                            <a href="#" class="btn btn-icon icon-left btn-info btn-sm" id="set_print" data-toggle1="tooltip" title="" data-original-title="Print Naskah" data-id="<?= $dta['id'] ?>"><i class="fa fa-print"></i> Print</a>
                            <a href="controller.php?arsip=true&from=naskah_disetujui&berita_id=<?= $dta['id'] ?>" class="btn btn-icon icon-left btn-warning btn-sm" data-toggle1="tooltip" title="" data-original-title="Arsip Naskah"><i class="fa fa-archive"></i> Arsip</a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>

              <!-- PRINT AREA -->
              <div class="container print" hidden="" style="font-size: 20px">
                <div class="row">
                  <div class="col-md-2" style="width: 15%;">
                    <img src="../assets/img/logo.png" alt="Logo TV Syiar" height="100">
                  </div>
                  <div class="col-md-8" style="width: 70%;">
                    <h4 id="judul" class="mb-3"></h4>
                    <div class="row">
                      <div class="col-6">
                        <span><b>Reporter:</b> <span id="reporter"></span></span><br>
                        <span><b>Desk Editor:</b> <span id="editor_berita"></span></span>
                      </div>
                      <div class="col-6">
                        <span><b>Tanggal Dibuat:</b> <span id="tanggal"></span></span><br>
                        <span><b>Kategori:</b> <span id="kategori"></span></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2" style="width: 15%;">
                    <img src="../assets/img/uin.png" alt="Logo UIN" height="120">
                  </div>
                </div>
                <hr>
                <div id="isi_berita"></div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php foreach ($revisi as $revs) {
  $berita_id = $revs['berita_id'];
  $berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE id = '$berita_id' AND status = 'verify'");
  $dtam = mysqli_fetch_assoc($berita);

  if ($dtam) {
    $user_id = $dtam['user_id'];
    $reporter = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$user_id'");
    $usr = mysqli_fetch_assoc($reporter); ?>

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
            <?= $dtam['berita_final'] ?>
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
<?php }
} ?>
<script>
  $(document).ready(function() {
    $('[data-toggle1="tooltip"]').tooltip();
    $('#data_naskah').addClass('active');
    $('#naskah_disetujui').addClass('active');
  });
</script>
<?php
require('template/footer.php');
?>