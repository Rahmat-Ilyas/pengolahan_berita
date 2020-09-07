<?php 
require('template/header.php');

$reporter = mysqli_query($conn, "SELECT * FROM tb_kategori");
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
              <a href="#" class="btn btn-icon btn-primary mb-4" data-toggle="modal" data-target="#modal-tambah" data-toggle1="tooltip" title="" data-original-title="Tambah Editor"><i class="fa fa-user-plus"></i> Tambah Kategori</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>                                 
                    <tr>
                      <th>No</th>
                      <th>Nama Kategori</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; foreach($reporter as $dta) { 
                      if ($dta['keterangan'] == '') 
                        $dta['keterangan'] = '-'; ?>              
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $dta['nama_kategori'] ?></td>
                        <td><?= $dta['keterangan'] ?></td>
                        <td style="width: 200px;">
                          <a href="#" class="btn btn-icon btn-sm btn-success" data-toggle="modal" data-target="#modal-edit<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Edit Kategori"><i class="fa fa-edit"></i> Edit</a>
                          <a href="#" class="btn btn-icon btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $dta['id'] ?>" data-toggle1="tooltip" title="" data-original-title="Hapus Kategori"><i class="fa fa-trash"></i> Hapus</a>
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

  <!-- MODAL TAMBAH KATEGORI -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-tambah">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST" action="controller.php">
          <div class="modal-body" style="margin-bottom: -20px;">
            <div class="form-group row">
              <label class="col-3">Nama Kategori</label>
              <div class="col-9">
                <input id="nama" type="text" class="form-control" name="nama_kategori" autofocus required autocomplete="off">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Keterangan</label>
              <div class="col-9">
                <input id="no_hp" type="text" class="form-control" name="keterangan" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="submit" name="tambah_kategori" value="tambah_kategori" class="btn btn-primary btn-submit">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php foreach($reporter as $dta) { ?>
    <!-- MODAL EDIT KATEGORI -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-edit<?= $dta['id'] ?>">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="controller.php">
            <div class="modal-body" style="margin-bottom: -20px;">
              <div class="form-group row">
                <label class="col-3">Nama Kategori</label>
                <div class="col-9">
                  <input id="nama" type="text" class="form-control" name="nama_kategori" value="<?= $dta['nama_kategori'] ?>" required autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-3">Keterangan</label>
                <div class="col-9">
                  <input id="no_hp" type="text" class="form-control" name="keterangan" value="<?= $dta['keterangan'] ?>" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <input type="hidden" name="id" value="<?= $dta['id'] ?>">
              <button type="submit" name="edit_kategori" value="edit_kategori" class="btn btn-primary btn-submit">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- MODAL HAPUS -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-hapus<?= $dta['id'] ?>">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Hapus Kategori?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Klik "Hapus" untuk melanjutkan menghapus kategori ini
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <a href="controller.php?hapus_kategori=true&kategori_id=<?= $dta['id'] ?>" role="button" class="btn btn-danger btn-shadow">Hapus</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <script>
    $(document).ready(function() {
      $('[data-toggle1="tooltip"]').tooltip();
      $('#kategori_berita').addClass('active');
    });
  </script>
  <?php 
  require('template/footer.php');
  ?>