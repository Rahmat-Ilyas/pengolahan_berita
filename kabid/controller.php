<?php 

function plugins() { ?>
	<link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/components.css">
	<script src="../assets/modules/jquery.min.js"></script>
	<script src="../assets/modules/sweetalert/sweetalert.min.js"></script>
<?php }

require('../config.php');

// CEK USERNAME
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

if (isset($_GET['proses']) && $_GET['proses'] == 'verify') {
	$id = $_GET['berita_id'];

	$update = "UPDATE tb_berita SET status = 'verify' WHERE id = '$id'";
	mysqli_query($conn, $update);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Naskah Telah Diproses',
					text: 'Naskah telah berhasil disetujui',
					icon: 'success'
				}).then((data) => {
					location.href = 'menunggu_diproses.php';
				});
			});
		</script>
	<?php }
}

if (isset($_POST['proses']) && $_POST['proses'] == 'refuse') {
	$id = $_POST['berita_id'];
	$keterangan = $_POST['keterangan'];

	mysqli_query($conn, "INSERT INTO tb_keterangan VALUES (NULL, '$id', '$keterangan')");
	$update = "UPDATE tb_berita SET status = 'refuse' WHERE id = '$id'";
	mysqli_query($conn, $update);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Naskah Telah Diproses',
					text: 'Naskah ini telah ditolak',
					icon: 'success'
				}).then((data) => {
					location.href = 'menunggu_diproses.php';
				});
			});
		</script>
	<?php }
}

if (isset($_GET['set_reporter'])) {
	$id = $_GET['reporter_id'];
	$status = $_GET['set_reporter'];

	if ($status == 'active') $ket = 'diaktifkan';
	else $ket = 'dinonaktifkan';

	$update = "UPDATE tb_users SET status = '$status' WHERE id = '$id'";
	mysqli_query($conn, $update);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Diproses',
					text: 'Reporter berhasil <?= $ket ?>',
					icon: 'success'
				}).then((data) => {
					location.href = 'data_reporter.php';
				});
			});
		</script>
	<?php }
}

if (isset($_GET['set_editor'])) {
	$id = $_GET['editor_id'];
	$status = $_GET['set_editor'];

	if ($status == 'active') $ket = 'diaktifkan';
	else $ket = 'dinonaktifkan';

	$update = "UPDATE tb_users SET status = '$status' WHERE id = '$id'";
	mysqli_query($conn, $update);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Diproses',
					text: 'Editor berhasil <?= $ket ?>',
					icon: 'success'
				}).then((data) => {
					location.href = 'data_editor.php';
				});
			});
		</script>
	<?php }
}

if (isset($_POST['tambah_editor'])) {
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_hp = $_POST['no_hp'];
	$jabatan = 'editor';
	$foto = 'default.png';
	$username = $_POST['username'];
	$password = password_hash('admin123', PASSWORD_DEFAULT);
	$status = $_POST['status'];

	$query = "INSERT INTO tb_users VALUES (NULL, '$nama', '$alamat', '$no_hp', '$jabatan', '$foto', '$username', '$password', '$status')";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Diproses',
					text: 'Data editor berhasil ditambahkan',
					icon: 'success'
				}).then((data) => {
					location.href = 'data_editor.php';
				});
			});
		</script>
	<?php }
}

if (isset($_POST['tambah_kategori'])) {
	$nama_kategori = $_POST['nama_kategori'];
	$keterangan = $_POST['keterangan'];

	$query = "INSERT INTO tb_kategori VALUES (NULL, '$nama_kategori', '$keterangan')";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Ditambah',
					text: 'Data kategori berhasil ditambahkan',
					icon: 'success'
				}).then((data) => {
					location.href = 'kategori_berita.php';
				});
			});
		</script>
	<?php }
}

if (isset($_POST['edit_kategori'])) {
	$id = $_POST['id'];
	$nama_kategori = $_POST['nama_kategori'];
	$keterangan = $_POST['keterangan'];

	$query = "UPDATE tb_kategori SET nama_kategori = '$nama_kategori', keterangan = '$keterangan' WHERE id = '$id'";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Diedit',
					text: 'Data kategori berhasil diedit',
					icon: 'success'
				}).then((data) => {
					location.href = 'kategori_berita.php';
				});
			});
		</script>
	<?php }
}

if (isset($_GET['hapus_kategori'])) {
	$id = $_GET['kategori_id'];

	$query = "DELETE FROM tb_kategori WHERE id = '$id'";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Dihapus',
					text: 'Data kategori berhasil dihapus',
					icon: 'success'
				}).then((data) => {
					location.href = 'kategori_berita.php';
				});
			});
		</script>
	<?php }
}

// UPDATE PROFILE 
if (isset($_POST['edit_profile'])) {
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];

	if ($_POST['password'] != '') {
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$query = "UPDATE tb_users SET nama = '$nama', username = '$username', password = '$password' WHERE id = '$id'";
	} else {
		$query = "UPDATE tb_users SET nama = '$nama', username = '$username' WHERE id = '$id'";
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
					location.href = 'index.php';
				});
			});
		</script>
	<?php }
}
?>