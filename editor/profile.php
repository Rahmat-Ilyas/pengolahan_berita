<?php
require('template/header.php');

$user = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$id'");
$dta = mysqli_fetch_assoc($user);
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Profile</h1>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card author-box card-primary">
          <div class="card-body">
            <div class="author-box-left">
              <img alt="image" src="../assets/img/avatar/<?= $dta['foto'] ?>" class="rounded-circle author-box-picture">
              <div class="clearfix"></div>
              <a href="#" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modal-edit">Edit Profile</a>
            </div>
            <div class="author-box-details">
              <div class="author-box-name">
                <a href="#"><?= $dta['nama'] ?></a>
              </div>
              <div class="author-box-job">Reporter</div>
              <div class="author-box-description">
                <p>
                  <b>Alamat:</b> <?= $dta['alamat'] ?><br>
                  <b>Telepon:</b> <?= $dta['no_hp'] ?><br>
                  <b>Username:</b> <?= $dta['username'] ?><br>
                </p>
              </div>
            </div>
          </div>
        </div>        
      </div>
    </section>
  </div>

  <!-- MODAL EDIT PROFIL -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST" action="controller.php" enctype="multipart/form-data">
          <div class="modal-body" style="margin-bottom: -20px;">
            <div class="form-group row">
              <label class="col-3">Nama Lengkap</label>
              <div class="col-9">
                <input id="nama" type="text" class="form-control" name="nama" autofocus required autocomplete="off" value="<?= $dta['nama'] ?>">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Alamat</label>
              <div class="col-9">
                <textarea id="alamat" type="text" class="form-control" name="alamat" required autocomplete="off"><?= $dta['alamat'] ?></textarea>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Telepon</label>
              <div class="col-9">
                <input id="no_hp" type="number" class="form-control" name="no_hp" required autocomplete="off" value="<?= $dta['no_hp'] ?>">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Username</label>
              <div class="col-9">
                <input id="username" type="text" class="form-control" name="username" required autocomplete="off" value="<?= $dta['username'] ?>">
                <div class="text-danger cek-username" hidden="">
                  Username sudah terdaftar
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Password</label>
              <div class="col-9">
                <input id="password" type="text" class="form-control" name="password" autocomplete="off">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Foto</label>
              <div class="col-9">
                <input id="foto" type="file" class="form-control" name="foto" autocomplete="off">
                <div class="text-danger cek-foto" hidden=""></div>
                <div class="text-info mt-3">
                  Note: Masukkan password atau foto baru untuk mengupdate data
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer bg-whitesmoke br">
            <input type="hidden" name="id" value="<?= $dta['id'] ?>">
            <input type="hidden" name="foto_now" value="<?= $dta['foto'] ?>">
            <button type="submit" name="edit_profile" value="edit_profile" class="btn btn-primary btn-submit">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#username').on('keyup blur', function() {
        var username = $('#username').val();
        var this_username = "<?= $dta['username'] ?>";
        $.ajax({
          url     : 'controller.php',
          method  : "POST",
          data    : { req: 'cek_username_update', username: username, this_username: this_username },
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

      $('#foto').change(function() {
        var foto = $('#foto').prop('files')[0];

        if (foto.type == "image/jpeg" || foto.type == "image/png") {
          $('.cek-foto').attr('hidden', '');
        } else {
          $('.cek-foto').removeAttr('hidden');
          $('.cek-foto').text('Format file tidak dibolehkan, pilih file lain');
          $(this).val('');
          return;
        }

        if (foto.size > 1000000) {
          $('.cek-foto').removeAttr('hidden');
          $('.cek-foto').text('Ukuran file minimal 1 Mb, pilih file lain');
          $(this).val('');
        }
      });
    });
  </script>
  <?php 
  require('template/footer.php');
  ?>