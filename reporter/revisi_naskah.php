<?php 
require('template/header.php');

$kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");

$berita_id = $_GET['berita_id'];
$result = mysqli_query($conn, "SELECT * FROM tb_berita WHERE id = '$berita_id'");
$dta = mysqli_fetch_assoc($result);

$result1 = mysqli_query($conn, "SELECT * FROM tb_revisi WHERE berita_id = '$berita_id'");
$rev = mysqli_fetch_assoc($result1);
$rev_id = $rev['id'];
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Revisi Naskah</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Revisi Naskah Berita</h4>
            </div>
            <form method="POST" action="controller.php" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Judul Berita</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id" value="<?= $dta['id'] ?>">
                    <input type="text" class="form-control" name="judul" value="<?= $dta['judul'] ?>" required="" placeholder="Masukkan Judul Berita" autocomplete="off">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="kategori" id="kategori">
                      <?php foreach ($kategori as $ktg) { 
                        $select = '';
                        if ($ktg['nama_kategori'] == $dta['kategori']) $select = 'selected' ?>
                          <option value="<?= $ktg['nama_kategori'] ?>" <?= $select ?>><?= $ktg['nama_kategori'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Catatan Editor</label>
                  <div class="col-sm-10">
                    <?php 
                      if ($rev['catatan_editor'] == "") $catatan = 'disabled';
                      else $catatan = '';
                    ?>
                    <a href="#" class="btn btn-icon icon-left btn-primary btn-sm <?= $catatan ?>" data-toggle="modal" data-target="#modal-catatan" data-toggle1="tooltip" title="" data-original-title="Lihat Catatan Editor"><i class="fa fa-list-alt"></i> Lihat Catatan Editor</a>
                  </div>
                </div>
                <div class="form-group">
                  <label>Revisi Brita</label>
                  <textarea name="berita_revisi" id="editor" required=""><?= $rev['berita_revisi'] ?></textarea> 
                </div>
              </div>
              <div class="card-footer" style="margin-top: -50px;">
                <button type="submit" name="submit_revisi_berita" class="btn btn-primary btn-lg"><i class="fa fa-save"></i>&nbsp;&nbsp;Revisi Naskah</button>
                <a href="naskah_koreksi.php" role="button"class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</a>
              </div>
            </form>
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
<script>
  $(document).ready(function() {
    $('#revisi_naskah').addClass('active');
    $('#naskah_koreksi').addClass('active');
  });
</script>
<?php 
require('template/footer.php');
?>