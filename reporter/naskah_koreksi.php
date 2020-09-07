<?php 
require('template/header.php');

$berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE user_id = '$id' AND (status = 'correction' OR status = 'revisi')");
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Naskah Dikoreksi/Direvisi</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Naskah Dikoreksi/Direvisi</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>                                 
                    <tr>
                      <th style="max-width: 180px;">Judul Berita</th>
                      <th>Editor</th>
                      <th>Kategori</th>
                      <th>Tanggal Dibuat</th>
                      <th>Berita Asli</th>
                      <th>Koreksi / Revisi</th>
                      <th>Catatan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($berita as $dta) {
                      $berita_id = $dta['id'];
                      $revisi = mysqli_query($conn, "SELECT * FROM tb_revisi WHERE berita_id = '$berita_id'");
                      $rev = mysqli_fetch_assoc($revisi);

                      $editor_id = $rev['editor_id'];
                      $editor = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$editor_id'");
                      $usr = mysqli_fetch_assoc($editor);

                      if ($rev['catatan_editor'] == "") $catatan = 'disabled';
                      else $catatan = '';

                      if ($dta['status'] == 'correction') {
                        $caption = 'Dikoreksi';
                        $color = 'badge-info';
                        $action = '';
                      } else if ($dta['status'] == 'revisi') {
                        $caption = 'Direvisi';
                        $color = 'badge-warning';
                        $action = 'disabled';
                      } ?>                                 
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
                          <a href="#" class="btn btn-icon icon-left btn-primary btn-sm" data-toggle="modal" data-target="#modal-berita<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Lihat Berita Asli"><i class="far fa-eye"></i></a>
                        </td>
                        <td class="text-center">
                          <a href="#" class="btn btn-icon icon-left btn-success btn-sm" data-toggle="modal" data-target="#modal-koreksi<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Lihat Koreksi Berita"><i class="far fa-eye"></i></a>
                        </td>
                        <td class="text-center">
                          <a href="#" class="btn btn-icon icon-left btn-secondary btn-sm <?= $catatan ?>" data-toggle="modal" data-target="#modal-catatan<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Lihat Catatan Editor"><i class="fa fa-list-alt"></i></a>
                        </td>
                        <td>
                          <div class="badge <?= $color ?> col-12"><?= $caption ?></div>
                        </td>
                        <td class="text-center">
                          <a href="revisi_naskah.php?berita_id=<?= $dta['id'] ?>" class="btn btn-icon btn-sm btn-warning <?= $action ?>"><i class="fas fa-keyboard"></i> Revisi</a>
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
  $berita_id = $dtam['id'];
  $revisi = mysqli_query($conn, "SELECT * FROM tb_revisi WHERE berita_id = '$berita_id'");
  $rev = mysqli_fetch_assoc($revisi);

  $editor_id = $rev['editor_id'];
  $editor = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$editor_id'");
  $usr = mysqli_fetch_assoc($editor); ?>   

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

  <!-- MODAL KOREKSI -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-koreksi<?= $dtam['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Koreksi Berita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body border m-4">
          <h6><?= $dtam['judul'] ?></h6>
          <hr>
          <?= $rev['berita_revisi'] ?>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL CATATAN -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-catatan<?= $dtam['id'] ?>">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Catatan Editor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body border m-4">
          <h6><u>Catatan Editor</u></h6>
          <?= $rev['catatan_editor'] ?>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL EDITOR -->
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
    $('#revisi_naskah').addClass('active');
    $('#naskah_koreksi').addClass('active');

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