<?php 

function plugins() { ?>
	<link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/components.css">
	<script src="../assets/modules/jquery.min.js"></script>
	<script src="../assets/modules/sweetalert/sweetalert.min.js"></script>
<?php }

require('../config.php');

// KOREKSI NASKAH
if (isset($_POST['koreksi_berita'])) {
	$submit = $_POST['submit'];
	$berita_id = $_POST['berita_id'];
	$editor_id = $_POST['editor_id'];
	$berita_revisi = $_POST['berita_revisi'];
	$catatan_editor = $_POST['catatan_editor'];

	if ($submit == 'koreksi') {
		$update = "UPDATE tb_berita SET status = 'correction' WHERE id = '$berita_id'";
	}
	else if ($submit == 'koreksi_acc') {
		$update = "UPDATE tb_berita SET status = 'done', berita_final = '$berita_revisi' WHERE id = '$berita_id'";
	}
	mysqli_query($conn, $update);

	$query= "INSERT INTO tb_revisi VALUES (NULL, '$berita_id', '$editor_id', '$berita_revisi', '$catatan_editor')";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Naskah Dikoreksi',
					text: 'Naskah telah berhasil dikoreksi',
					icon: 'success'
				}).then((data) => {
					location.href = 'naskah_dikoreksi.php';
				});
			});
		</script>
	<?php }
}

// KOREKSI NASKAH REVISI
if (isset($_POST['koreksi_berita_revisi'])) {
	$submit = $_POST['submit'];
	$rev_id = $_POST['rev_id'];
	$berita_id = $_POST['berita_id'];
	$berita_revisi = $_POST['berita_revisi'];
	$catatan_editor = $_POST['catatan_editor'];

	if ($submit == 'koreksi') {
		$update = "UPDATE tb_berita SET status = 'correction' WHERE id = '$berita_id'";
	}
	else if ($submit == 'koreksi_acc') {
		$update = "UPDATE tb_berita SET status = 'done', berita_final = '$berita_revisi' WHERE id = '$berita_id'";
	}
	mysqli_query($conn, $update);

	$query = "UPDATE tb_revisi SET berita_revisi = '$berita_revisi', catatan_editor = '$catatan_editor' WHERE id = '$rev_id'";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Naskah Dikoreksi',
					text: 'Naskah telah berhasil dikoreksi kembali',
					icon: 'success'
				}).then((data) => {
					location.href = 'naskah_dikoreksi.php';
				});
			});
		</script>
	<?php }
}

// ACCEPT NASKAH
if (isset($_GET['accept']) && $_GET['accept'] == 'true') {
	$from = $_GET['from'];
	$berita_id = $_GET['berita_id'];

	if ($from == 'naskah_baru' && isset($_GET['editor_id'])) {
		$editor_id = $_GET['editor_id'];
		$result = mysqli_query($conn, "SELECT * FROM tb_berita WHERE id = '$berita_id'");
		$dta = mysqli_fetch_assoc($result);
		$berita_created = $dta['berita_created'];

		$query= "INSERT INTO tb_revisi VALUES (NULL, '$berita_id', '$editor_id', '$berita_created', '')";
		mysqli_query($conn, $query);

	}
	$koreksi = mysqli_query($conn, "SELECT * FROM tb_revisi WHERE berita_id = '$berita_id'");
	$kor = mysqli_fetch_assoc($koreksi);
	$berita_revisi = $kor['berita_revisi'];

	$query = "UPDATE tb_berita SET status = 'done', berita_final = '$berita_revisi' WHERE id = '$berita_id'";

	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Diaccept',
					text: 'Naskah telah berhasil diaccept, tunggu persetujuan Kepala Bidang',
					icon: 'success'
				}).then((data) => {
					location.href = '<?= $from ?>'+'.php';
				});
			});
		</script>
	<?php }
}

// ARSIP NASKAH 
if (isset($_GET['arsip'])) {
	$berita_id = $_GET['berita_id'];
	$from = $_GET['from'];
	$result = mysqli_query($conn, "SELECT * FROM tb_berita WHERE id = '$berita_id'");
	$dta = mysqli_fetch_assoc($result);
	$status = $dta['status'].'_';
	
	$query = "UPDATE tb_berita SET status = '$status' WHERE id = '$berita_id'";

	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Diarsip',
					text: 'Naskah telah berhasil diarsip, silahkan lihat di menu arsip',
					icon: 'success'
				}).then((data) => {
					location.href = '<?= $from ?>'+'.php';
				});
			});
		</script>
	<?php }
}

// SET PRINT 
if (isset($_POST['req']) && $_POST['req'] == 'set_print') {
	header('Content-type: application/json');
	$berita_id = $_POST['berita_id'];
	$editor_id = $_POST['editor_id'];

	$berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE id = '$berita_id'");
	$brt = mysqli_fetch_assoc($berita);

	$editor = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$editor_id'");
	$edt = mysqli_fetch_assoc($editor);

	$reporter_id = $brt['user_id'];
	$reporter = mysqli_query($conn, "SELECT * FROM tb_users WHERE id = '$reporter_id'");
	$rep = mysqli_fetch_assoc($reporter);

	$data = [];
	$data['judul'] = $brt['judul'];
	$data['isi_berita'] = $brt['berita_final'];
	$data['kategori'] = $brt['kategori'];
	$data['tanggal'] = date('d F Y', strtotime($brt['tanggal']));
	$data['editor_berita'] = $edt['nama'];
	$data['reporter'] = $rep['nama'];

	echo json_encode($data);
}

if (isset($_POST['req'])) {
	header('Content-type: application/json');
	if($_POST['req'] == 'cek_username_update') {
		$username = $_POST['username'];
		$this_username = $_POST['this_username'];
		$result = mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$username' AND username != '$this_username'");
		$get = mysqli_fetch_assoc($result);

		if ($get) echo json_encode(true);
		else echo json_encode(false);
	}
}

// UPDATE PROFILE 
if (isset($_POST['edit_profile'])) {
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_hp = $_POST['no_hp'];
	$username = $_POST['username'];

    // SET FOTO 
	if ($_FILES['foto']['name'] != '') {
		$foto = $_FILES['foto']['name'];
		$ext = pathinfo($foto, PATHINFO_EXTENSION);
		$nama_foto = "image_".time().".".$ext;
		$file_tmp = $_FILES['foto']['tmp_name'];
		// HAPUS OLD FOTO
		$target = "../assets/img/avatar/".$_POST['foto_now'];
		if (file_exists($target) && $_POST['foto_now'] != 'default.png') unlink($target);
		// UPLOAD NEW FOTO
		move_uploaded_file($file_tmp, '../assets/img/avatar/'.$nama_foto);
	} else {
		$nama_foto = $_POST['foto_now'];
	}

	if ($_POST['password'] != '') {
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$query = "UPDATE tb_users SET nama = '$nama', alamat = '$alamat', no_hp = '$no_hp', foto = '$nama_foto', username = '$username', password = '$password' WHERE id = '$id'";
	} else {
		$query = "UPDATE tb_users SET nama = '$nama', alamat = '$alamat', no_hp = '$no_hp', foto = '$nama_foto', username = '$username' WHERE id = '$id'";
	}

	// EDIT PROFILE
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Diupdate',
					text: 'Data profile berhasil diupdate',
					icon: 'success'
				}).then((data) => {
					location.href = 'profile.php';
				});
			});
		</script>
	<?php }
}
?>