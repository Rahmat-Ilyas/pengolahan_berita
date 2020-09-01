<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Registrasi Reporter</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../assets/modules/jquery-selectric/selectric.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA --></head>

  <body>
    <div id="app">
      <section class="section">
        <div class="container mt-5">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="login-brand">
                <img src="../assets/img/logo.png" alt="logo" width="100" class="shadow-light rounded-circle">
              </div>

              <div class="card card-primary">
                <div class="card-header"><h4>Registrasi Reporter</h4></div>

                <div class="card-body">
                  <form method="POST" action="controller.php" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Nama Lengkap</label>
                      <input id="nama" type="text" class="form-control" name="nama" autofocus required autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Alamat</label>
                      <textarea id="alamat" type="text" class="form-control" name="alamat" required autocomplete="off"></textarea>
                    </div>

                    <div class="form-group">
                      <label>Telepon</label>
                      <input id="no_hp" type="number" class="form-control" name="no_hp" required autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Username</label>
                      <input id="username" type="text" class="form-control" name="username" required autocomplete="off">
                      <div class="text-danger cek-username" hidden="">
                        Username sudah terdaftar
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Password</label>
                      <input id="password" type="password" class="form-control" name="password" required autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Foto</label>
                      <input id="foto" type="file" class="form-control" name="foto" required autocomplete="off">
                      <div class="text-danger cek-foto" hidden=""></div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg btn-block btn-submit" name="regist_reporter">
                        Daftar
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="mt-0 text-muted text-center">
                Sudah punya akun? Login <a href="../login.php">disini</a>
              </div>
              <div class="simple-footer">
                Copyright &copy; Karpten (KRP) 2020
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- General JS Scripts -->
    <script src="../assets/modules/jquery.min.js"></script>
    <script src="../assets/modules/popper.js"></script>
    <script src="../assets/modules/tooltip.js"></script>
    <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="../assets/modules/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="../assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="../assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="../assets/modules/sweetalert/sweetalert.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="../assets/js/page/auth-register.js"></script>

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script>
      $(document).ready(function() {
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
  </body>
  </html>