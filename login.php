<?php
require('config.php');

if (isset($_COOKIE['login_reporter'])) $_SESSION['login_reporter'] = $_COOKIE['login_reporter'];
else if (isset($_COOKIE['login_editor'])) $_SESSION['login_editor'] = $_COOKIE['login_editor'];
else if (isset($_COOKIE['login_kabid'])) $_SESSION['login_kabid'] = $_COOKIE['login_kabid'];

if (isset($_COOKIE['get_id'])) $_SESSION['get_id'] = $_COOKIE['get_id'];

if (isset($_SESSION['login_reporter'])) header("location: reporter/");
else if (isset($_SESSION['login_editor'])) header("location: editor/");
else if (isset($_SESSION['login_kabid'])) header("location: kabid/");

$password = null;
$username = null;
$err_user = false;
$err_pass = false;
$err_stss = false;

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$username'");
  $get = mysqli_fetch_assoc($result);

  if ($get) {
    $get_password = $get['password'];
    $get_id = $get['id'];
    $jabatan = $get['jabatan'];
    $status = $get['status'];

    if (password_verify($password, $get_password)) {
      $_SESSION['get_id'] = $get_id;
      setcookie('get_id', $get_id, time()+172800);

      if ($jabatan == 'reporter') {
        if ($status != 'active') $err_stss = true;
        else {
          $_SESSION['login_reporter'] = $get_password;
          if (isset($_POST['remember'])) {
            setcookie('login_reporter', $get_password, time()+172800);
          }
          header("location: reporter/");
          exit();
        }
      } else if ($jabatan == 'editor') {
        if ($status != 'active') $err_stss = true;
        else {
          $_SESSION['login_editor'] = $get_password;
          if (isset($_POST['remember'])) {
            setcookie('login_editor', $get_password, time()+172800);
          }
          header("location: editor/");
          exit();
        }
      } else if ($jabatan == 'kabid') {
        $_SESSION['login_kabid'] = $get_password;
        if (isset($_POST['remember'])) {
          setcookie('login_kabid', $get_password, time()+172800);
        }
        header("location: editor/");
        exit();
      }
    } else $err_pass = true;
  } else $err_user = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login TV Syiar</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
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
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
              <div class="login-brand">
                <img src="assets/img/logo.png" alt="logo" width="100" class="shadow-light rounded-circle">
              </div>

              <div class="card card-primary">
                <div class="card-header"><h4>Login TV Syiar</h4></div>

                <div class="card-body">
                  <form method="POST" class="needs-validation">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus value="<?= $username ? $username : '' ?>">
                      <div class="invalid-feedback">
                        Masukkan username
                      </div>
                      <?php if ($err_user == true) { ?>
                        <div class="text-danger">
                          Username tidak ditemukan
                        </div>
                      <?php } ?>
                    </div>

                    <div class="form-group">
                      <div class="d-block">
                       <label for="password" class="control-label">Password</label>
                       <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                     </div>
                     <div class="invalid-feedback">
                      Masukkan password
                    </div>
                    <?php if ($err_pass == true) { ?>
                      <div class="text-danger">
                        Password tidak sesuai
                      </div>
                    <?php } ?>

                    <?php if ($err_stss == true) { ?>
                      <div class="text-danger">
                        Akun belum diverifikasi atau sedang dinonaktifkan
                      </div>
                    <?php } ?>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="login" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-0 text-muted text-center">
              Daftar reporterr? <a href="reporter/register.php">Klik disini</a>
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
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>