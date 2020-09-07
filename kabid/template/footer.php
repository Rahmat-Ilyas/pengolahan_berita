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
              <label class="col-3">Nama</label>
              <div class="col-9">
                <input id="nama" type="text" class="form-control" name="nama" autofocus required autocomplete="off" value="<?= $dta['nama'] ?>">
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
                <div class="text-info mt-3">
                  Note: Masukkan password baru untuk mengupdate data
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer bg-whitesmoke br">
            <input type="hidden" name="id" value="<?= $dta['id'] ?>">
            <button type="submit" name="edit_profile" value="edit_profile" class="btn btn-primary btn-submit">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer class="main-footer">
    <div class="footer-left">
      Copyright &copy; Karpten (KRP) 2020
    </div>
    <div class="footer-right">

    </div>
  </footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="../assets/modules/popper.js"></script>
<script src="../assets/modules/tooltip.js"></script>
<script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="../assets/modules/moment.min.js"></script>
<script src="../assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="../assets/modules/jquery.sparkline.min.js"></script>
<script src="../assets/modules/chart.min.js"></script>
<script src="../assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
<script src="../assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
<script src="../assets/modules/summernote/summernote-bs4.js"></script>
<!-- <script src="../assets/modules/summernote-0.8.18-dist/summernote-bs4.min.js"></script>
<script src="../assets/modules/texteditor/editor.js"></script>
<script src="../assets/modules/wysiwyg-editor-bootstrap/src/js/wysiwyg.js"></script>
<script src="../assets/modules/wysiwyg-editor-bootstrap/src/js/highlight.js"></script> -->
<script src="../assets/modules/richtext-editor/js/froala_editor.min.js"></script>
<script src="../assets/modules/richtext-editor/js/froala_editor.pkgd.min.js"></script>
<script src="../assets/modules/datatables/datatables.min.js"></script>
<script src="../assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="../assets/modules/jquery-ui/jquery-ui.min.js"></script>

<!-- Page Specific JS File -->
<script src="../assets/js/page/index.js"></script>
<script src="../assets/js/page/modules-datatables.js"></script>
<script src="../assets/modules/sweetalert/sweetalert.min.js"></script>

<!-- Template JS File -->
<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/custom.js"></script>
<script src="../assets/js/jquery.PrintArea.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    FroalaEditor('#editor', {
      height: 480
    });

    $(document).on('click', '#set_print', function(e) {
      e.preventDefault();
      var id = $(this).attr('data-id');
      var editor_id = "<?= $id ?>";
      $.ajax({
        url     : 'controller.php',
        method  : "POST",
        data    : { req: 'set_print', berita_id: id, editor_id: editor_id },
        success : function(data) {
          $.each(data, function(key, val) {
            $('#'+key).text(val);
            if (key == 'isi_berita') $('#isi_berita').html(val);
          });

          $('.print').printArea();
        }
      });
    });

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
  });
</script>
</body>
</html>