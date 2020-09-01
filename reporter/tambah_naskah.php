<?php 
require('template/header.php');

$kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Naskah</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Input Data Naskah Berita</h4>
            </div>
            <form method="POST" action="controller.php" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Judul Berita</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="text" class="form-control" name="judul" required="" placeholder="Masukkan Judul Berita" autocomplete="off">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tanggal" required="" value="<?= date('Y-m-d') ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="kategori">
                      <?php foreach ($kategori as $dta) { ?>
                      <option value="<?= $dta['nama_kategori'] ?>"><?= $dta['nama_kategori'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Konten (Optional)</label>
                  <div class="col-sm-10">
                    <input type="file" id="konten" class="form-control" name="konten">
                    <div class="text-danger cek-konten" hidden=""></div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Isi Berita</label>
                  <textarea name="isi_berita" id="editor" required=""></textarea> 
                </div>
              </div>
              <div class="card-footer" style="margin-top: -50px;">
                <button type="submit" name="submit_berita" class="btn btn-primary btn-lg"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  $(document).ready(function() {
    $('#kelola_naskah').addClass('active');
    $('#tambah_naskah').addClass('active');

    $('#konten').change(function() {
          var konten = $('#konten').prop('files')[0];

          if (konten.type == "audio/mpeg" || konten.type == "audio/ogg" || konten.type == "audio/wav" || konten.type == "audio/mp4") {
            $('.cek-konten').attr('hidden', '');
          } else {
            $('.cek-konten').removeAttr('hidden');
            $('.cek-konten').text('Format file tidak dibolehkan, pilih file berformat audio');
            $(this).val('');
            return;
          }
        });
  });
</script>
<?php 
require('template/footer.php');
?>