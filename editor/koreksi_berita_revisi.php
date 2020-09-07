<?php 
require('template/header.php');

$berita_id = $_GET['berita_id'];
$result = mysqli_query($conn, "SELECT * FROM tb_berita WHERE id = '$berita_id'");
$dta = mysqli_fetch_assoc($result);

$result1 = mysqli_query($conn, "SELECT * FROM tb_revisi WHERE berita_id = '$berita_id'");
$rev = mysqli_fetch_assoc($result1);
$rev_id = $rev['id'];

?>
<!-- Main Content -->
<form method="POST" action="controller.php" enctype="multipart/form-data">
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Koreksi Naskah</h1>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4><?= $dta['judul'] ?></h4>
              </div>
              <div class="card-body">
                <a href="#" role="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#modal-catatan"><i class="fa fa-edit"></i>&nbsp;&nbsp;Tambah Catatan</a>
                <div class="form-group">
                  <input type="hidden" name="rev_id" value="<?= $rev_id ?>">
                  <input type="hidden" name="berita_id" value="<?= $berita_id ?>">
                  <input type="hidden" name="koreksi_berita_revisi" value="true">
                  <textarea name="berita_revisi" id="editor" required=""><?= $rev['berita_revisi'] ?></textarea>
                </div>
              </div>
              <div class="card-footer" style="margin-top: -50px;">
                <button type="button" class="btn btn-primary btn-lg" id="korksi"><i class="fa fa-save"></i>&nbsp;&nbsp;Koreksi Naskah</button>
                <a href="naskah_dikoreksi.php" role="button"class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- MODAL CATATAN -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-catatan">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Catatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <textarea id="catatat" name="catatan_editor"><?= $rev['catatan_editor'] ?></textarea>
        </div>
        <div class="modal-footer bg-whitesmoke" style="margin-top: -30px;">
          <button type="button" id="tambah" class="btn btn-primary">Tambahkan Catatan</button>
          <button type="button" id="batal" class="btn btn-danger" data-dismiss="modal">Hapus Catatan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL KOREKSI NASKAH 1 -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-koreksi1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Koreksi Naskah?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Klik "Lanjutkan" untuk memproses</p>
        </div>
        <div class="modal-footer bg-whitesmoke" style="margin-top: -30px;">
          <button type="submit" name="submit" value="koreksi" class="btn btn-primary">Lanjutkan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL KOREKSI NASKAH 2 -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-koreksi2">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Koreksi Naskah?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Klik "Lanjutkan" untuk memproses atau "Lanjutkan & Accept" untuk langsung mengaccept naskah</p>
        </div>
        <div class="modal-footer bg-whitesmoke" style="margin-top: -30px;">
          <button type="submit" name="submit" value="koreksi_acc" class="btn btn-success">Lanjutkan & Accept</button>
          <button type="submit" name="submit" value="koreksi" class="btn btn-primary">Lanjutkan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
  $(document).ready(function() {
    $('#kelola_naskah').addClass('active');
    $('#naskah_dikoreksi').addClass('active');

    FroalaEditor('#catatat', {
      toolbarButtons: {
        moreText: {
          buttons: ['bold', 'italic', 'underline', 'textColor', 'backgroundColor']
        },
        moreParagraph: {
          buttons: ['formatOL', 'formatUL', 'outdent', 'indent', 'alignLeft', 'alignCenter', 'alignRight', 'alignJustify']
        },
      }
    });

    $('#tambah').click(function() {
      swal({
        title: 'Berhasil Dibuat',
        text: 'Catatan sudah di tambah',
        icon: 'success'
      });

      $('#modal-catatan').modal('hide');
    });

    $('#batal').click(function() {
      var editor = new FroalaEditor('#catatat');
      editor.html.set('');
      $('#catatat').val('');
    });

    $('#korksi').click(function() {
      if ($('#catatat').val() == '') {
        $('#modal-koreksi2').modal('show');        
      } else {
        $('#modal-koreksi1').modal('show');
      }
    });
  });
</script>
<?php 
require('template/footer.php');
?>