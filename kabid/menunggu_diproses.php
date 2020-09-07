<?php 
require('template/header.php');

$berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE status = 'done'");
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
                      <th style="max-width: 180px;">Judul Berita</th>
                      <th>Reporter</th>
                      <th>Editor</th>
                      <th>Kategori</th>
                      <th>Tanggal Dibuat</th>
                      <th>Isi Berita</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($berita as $dta) {
                      $user_id = $dta['user_id'];
                      $berita_id = $dta['id'];
                      $reporter = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$user_id'");
                      $usr = mysqli_fetch_assoc($reporter);

                      $revisi = mysqli_query($conn, "SELECT * FROM tb_revisi WHERE berita_id = '$berita_id'");
                      $rev = mysqli_fetch_assoc($revisi);
                      $editor_id = $rev['editor_id'];

                      $editor = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$editor_id'");
                      $edt = mysqli_fetch_assoc($editor); ?>                                 
                      <tr>
                        <td><?= $dta['judul'] ?></td>
                        <td>
                          <a href="#" data-toggle="modal" data-target="#modal-reporter<?= $dta['id'] ?>">
                            <img alt="image" src="../assets/img/avatar/<?= $usr['foto'] ?>" class="rounded-circle" data-toggle="tooltip" title="" data-original-title="<?= $usr['nama'] ?>" width="35">
                          </a>
                        </td>
                        <td>
                          <a href="#" data-toggle="modal" data-target="#modal-editor<?= $dta['id'] ?>">
                            <img alt="image" src="../assets/img/avatar/<?= $edt['foto'] ?>" class="rounded-circle" data-toggle="tooltip" title="" data-original-title="<?= $edt['nama'] ?>" width="35">
                          </a>
                        </td>
                        <td><?= $dta['kategori'] ?></td>
                        <td><?= date('d/m/Y', strtotime($dta['tanggal'])) ?></td>
                        <td>
                          <a href="#" class="btn btn-icon icon-left btn-primary btn-sm" data-toggle="modal" data-target="#modal-berita<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Lihat Isi Berita"><i class="far fa-eye"></i> Lihat</a>
                        </td>
                        <td style="min-width: 140px; max-width: 140px;">
                          <a href="#" class="btn btn-icon btn-sm btn-success" data-toggle="modal" data-target="#modal-acc<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Setujui Berita"><i class="fa fa-check"></i> Setujui</a>
                          <a href="#" class="btn btn-icon btn-sm btn-danger" data-toggle="modal" data-target="#modal-tolak<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Tolak Berita"><i class="fa fa-times"></i> Tolak</a>
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
  $berita_id = $dtam['id'];
  $reporter = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$user_id'");
  $usr = mysqli_fetch_assoc($reporter);

  $revisi = mysqli_query($conn, "SELECT * FROM tb_revisi WHERE berita_id = '$berita_id'");
  $rev = mysqli_fetch_assoc($revisi);
  $editor_id = $rev['editor_id'];

  $editor = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$editor_id'");
  $edt = mysqli_fetch_assoc($editor); ?>   

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

  <!-- MODAL EDITOR -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-editor<?= $dtam['id'] ?>">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Editor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card author-box card-primary m-0">
            <div class="card-body">
              <div class="author-box-left">
                <img alt="image" src="../assets/img/avatar/<?= $edt['foto'] ?>" class="rounded-circle author-box-picture">
              </div>
              <div class="author-box-details">
                <div class="author-box-name">
                  <a href="#"><?= $edt['nama'] ?></a>
                </div>
                <div class="author-box-job">Editor</div>
                <hr>
                <div class="author-box-description">
                  <p>
                    Telepon: <?= $edt['no_hp'] ?> <br>
                    Alamat: <?= $edt['alamat'] ?>
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

  <!-- MODAL SETUJUI -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-acc<?= $dtam['id'] ?>">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Setujui Naskah Berita?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Klik "Lanjutkan" untuk menyetujui naskah ini
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <a href="controller.php?proses=verify&berita_id=<?= $dtam['id'] ?>" role="button" class="btn btn-primary btn-shadow" id="btn-delete">Lanjutkan</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL TOLAK -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-tolak<?= $dtam['id'] ?>">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tolak Naskah Berita?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST" action="controller.php">
          <div class="modal-body px-5" style="margin-bottom: -20px;">
            <div class="form-group">
              <label>Alasan Penolakan</label>
              <textarea class="form-control" name="keterangan" required="" placeholder="Masukkan Alasan Penolakan" rows="5"></textarea>
            </div>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <input type="hidden" name="berita_id" value="<?= $dtam['id'] ?>">
            <button type="submit" name="proses" value="refuse" class="btn btn-danger">Tolak Naskah</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>
<script>
  $(document).ready(function() {
    $('[data-toggle1="tooltip"]').tooltip();
    $('#proses_naskah').addClass('active');
    $('#menunggu_diproses').addClass('active');
  });
</script>
<?php 
require('template/footer.php');
?>