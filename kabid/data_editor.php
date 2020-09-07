<?php 
require('template/header.php');

$editor = mysqli_query($conn, "SELECT * FROM tb_users WHERE jabatan = 'editor' ORDER BY status DESC");
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
              <a href="#" class="btn btn-icon btn-primary mb-4" data-toggle="modal" data-target="#modal-tambah" data-toggle1="tooltip" title="" data-original-title="Tambah Editor"><i class="fa fa-user-plus"></i> Tambah Editor</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>                                 
                    <tr>
                      <th>Foto</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Telepon</th>
                      <th>Username</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; foreach($editor as $dta) { 
                      if ($dta['status'] == 'active') {
                        $caption = 'Aktif';
                        $color = 'badge-success';
                        $button = 'nonaktif';
                      } else if ($dta['status'] == 'nonactive') {
                        $caption = 'Nonaktif';
                        $color = 'badge-warning';
                        $button = 'aktif';
                      } ?>                     
                      <tr>
                        <td>
                          <img alt="image" src="../assets/img/avatar/<?= $dta['foto'] ?>" class="rounded-circle" width="35">
                        </td>
                        <td><?= $dta['nama'] ?></td>
                        <td><?= $dta['alamat'] ?></td>
                        <td><?= $dta['no_hp'] ?></td>
                        <td><?= $dta['username'] ?></td>
                        <td>
                          <div class="badge <?= $color ?> col-12"><?= $caption ?></div>
                        </td>
                        <td style="min-width: 80px; max-width: 80px;">
                          <?php if ($button == 'aktif') { ?>
                            <a href="controller.php?set_editor=active&editor_id=<?= $dta['id'] ?>" class="btn btn-icon btn-sm btn-success btn-block" data-toggle1="tooltip" title="" data-original-title="Aktifkan"><i class="fa fa-user-check"></i> Aktifkan</a>
                          <?php } else { ?>
                            <a href="controller.php?set_editor=nonactive&editor_id=<?= $dta['id'] ?>" class="btn btn-icon btn-sm btn-danger btn-block" data-toggle1="tooltip" title="" data-original-title="Nonaktifkan"><i class="fa fa-user-times"></i> Nonaktifkan</a>
                          <?php } ?>
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

  <!-- MODAL TAMBAH EDITOR -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-tambah">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Editor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST" action="controller.php">
          <div class="modal-body" style="margin-bottom: -20px;">
            <div class="form-group row">
              <label class="col-3">Nama Lengkap</label>
              <div class="col-9">
                <input id="nama" type="text" class="form-control" name="nama" autofocus required autocomplete="off">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Alamat</label>
              <div class="col-9">
                <textarea id="alamat" type="text" class="form-control" name="alamat" required autocomplete="off"></textarea>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Telepon</label>
              <div class="col-9">
                <input id="no_hp" type="number" class="form-control" name="no_hp" required autocomplete="off">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Username</label>
              <div class="col-9">
                <input id="username" type="text" class="form-control" name="username" required autocomplete="off">
                <div class="text-danger cek-username" hidden="">
                  Username sudah terdaftar
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Status</label>
              <div class="col-9">
                <select class="form-control" name="status">
                  <option value="active">Aktif</option>
                  <option value="nonactive">Nonaktif</option>
                </select>
                <div class="text-info mt-3">
                  Note: Password default adalah "admin123".
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="submit" name="tambah_editor" value="tambah_editor" class="btn btn-primary btn-submit">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('[data-toggle1="tooltip"]').tooltip();
      $('#repoter_editor').addClass('active');
      $('#data_editor').addClass('active');

      $('#username').on('keyup blur', function() {
        var username = $('#username').val();
        $.ajax({
          url     : 'controller.php',
          method  : "POST",
          data    : { req: 'cek_username', username: username },
          success : function(data) {
            if (data == true) {
              $('.cek-username').removeAttr('hidden');
              $('.btn-submit').attr('disabled', 'true');
              $('.btn-submit').addClass('disabled');
            } else {
              $('.cek-username').attr('hidden', 'true');
              $('.btn-submit').removeAttr('disabled');
              $('.btn-submit').removeClass('disabled');
            }
          }
        });
      });
    });
  </script>
  <?php 
  require('template/footer.php');
  ?>