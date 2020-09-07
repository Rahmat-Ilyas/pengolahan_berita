<?php 
require('template/header.php');

$berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE user_id = '$id' AND (status = 'refuse' OR status = 'refuse_')");
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Naskah Ditolak</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Naskah Yang Ditolak</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>                                 
                    <tr>
                      <th style="max-width: 200px;">Judul Berita</th>
                      <th>Editor</th>
                      <th>Kategori</th>
                      <th>Tanggal Dibuat</th>
                      <th>Hasil Akhir Berita</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($berita as $dta) {
                      $berita_id = $dta['id'];
                      $revisi = mysqli_query($conn, "SELECT * FROM tb_revisi WHERE berita_id = '$berita_id'");
                      $rev = mysqli_fetch_assoc($revisi);

                      $editor_id = $rev['editor_id'];
                      $editor = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$editor_id'");
                      $usr = mysqli_fetch_assoc($editor); ?>                                 
                      <tr>
                        <td><?= $dta['judul'] ?></td>
                        <td class="text-center">
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
                          <a href="#" class="btn btn-icon icon-left btn-info btn-sm"data-toggle="modal" data-target="#modal-alasan<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Lihat Alasan Penolakan"><i class="fa fa-info-circle"></i> Alasan</a>
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
  $usr = mysqli_fetch_assoc($editor); 

  $keterangan = mysqli_query($conn, "SELECT * FROM tb_keterangan WHERE berita_id = '$berita_id'");
  $ket = mysqli_fetch_assoc($keterangan); ?>   

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

  <!-- MODAL ALASAN -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-alasan<?= $dtam['id'] ?>">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Alasan Penolakan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body border m-4">
          <h6><u>Alasan Penolakan</u></h6>
          <?= $ket['keterangan'] ?>
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
    $('#data_naskah').addClass('active');
    $('#naskah_ditolak').addClass('active');

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