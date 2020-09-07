<?php

function plugins() { ?>
	<link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/components.css">
	<script src="../assets/modules/jquery.min.js"></script>
	<script src="../assets/modules/sweetalert/sweetalert.min.js"></script>
<?php }

require('../config.php');

// CEK USERNAME & FOTO
if (isset($_POST['req'])) {
	header('Content-type: application/json');
	if($_POST['req'] == 'cek_username') {
		$username = $_POST['username'];
		$result = mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$username'");
		$get = mysqli_fetch_assoc($result);

		if ($get) echo json_encode(true);
		else echo json_encode(false);
	} else if($_POST['req'] == 'cek_username_update') {
		$username = $_POST['username'];
		$this_username = $_POST['this_username'];
		$result = mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$username' AND username != '$this_username'");
		$get = mysqli_fetch_assoc($result);

		if ($get) echo json_encode(true);
		else echo json_encode(false);
	}
}

// REGIST REPORTER
if (isset($_POST['regist_reporter'])) {
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_hp = $_POST['no_hp'];
	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // SET FOTO 
	$foto = $_FILES['foto']['name'];
	$ext = pathinfo($foto, PATHINFO_EXTENSION);
	$nama_foto = "image_".time().".".$ext;
	$file_tmp = $_FILES['foto']['tmp_name'];

    // TAMBAH DATA 
	$query= "INSERT INTO tb_users VALUES (NULL, '$nama', '$alamat', '$no_hp', 'reporter', '$nama_foto', '$username', '$password', 'waiting')";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		move_uploaded_file($file_tmp, '../assets/img/avatar/'.$nama_foto);
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Registrasi Berhasil',
					text: 'Data reporter baru berhasil di tambah',
					icon: 'success'
				}).then((data) => {
					location.href = '../login.php';
				});
			});
		</script>
	<?php }
}

// SUBMIT BERITA
if (isset($_POST['submit_berita'])) {
	$user_id = $_POST['id'];
	$judul = $_POST['judul'];
	$kategori = $_POST['kategori'];
	$isi_berita = $_POST['isi_berita'];
	$tanggal = $_POST['tanggal'];

	// SET KONTEN
	if ($_FILES['konten']['tmp_name'] != '') {
		$file_tmp = $_FILES['konten']['tmp_name'];
		$get_ext = $_FILES['konten']['name'];
		$ext = pathinfo($get_ext, PATHINFO_EXTENSION);
		$konten = 'konten_file_'.$user_id.'_'.time().'.'.$ext;
		move_uploaded_file($file_tmp, '../assets/konten/'.$konten);
	} else $konten = NULL;

	// TAMBAH DATA 
	$query= "INSERT INTO tb_berita VALUES (NULL, '$user_id', '$judul', '$kategori', '$isi_berita', NULL, '$tanggal', '$konten', 'waiting')";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) { 
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Dibuat',
					text: 'Naskah/berit baru berhasil di tambah, tunggu proses koreksi',
					icon: 'success'
				}).then((data) => {
					location.href = 'naskah_dibuat.php';
				});
			});
		</script>
	<?php }
}

// REVISI BERITA
if (isset($_POST['submit_revisi_berita'])) {
	$id = $_POST['id'];
	$judul = $_POST['judul'];
	$kategori = $_POST['kategori'];
	$berita_revisi = $_POST['berita_revisi'];
	
	$berita = "UPDATE tb_berita SET judul = '$judul', kategori = '$kategori', status = 'revisi' WHERE id = '$id'";
	mysqli_query($conn, $berita);

	$revisi = "UPDATE tb_revisi SET berita_revisi = '$berita_revisi' WHERE berita_id = '$id'";
	mysqli_query($conn, $revisi);

	if (mysqli_affected_rows($conn) > 0) { 
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Direvisi',
					text: 'Naskah/berit berhasil direvisi, tunggu proses koreksi kembali',
					icon: 'success'
				}).then((data) => {
					location.href = 'naskah_koreksi.php';
				});
			});
		</script>
	<?php }
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