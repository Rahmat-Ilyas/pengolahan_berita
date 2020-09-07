<?php 
require('../config.php');

$id = $_GET['berita_id'];

$berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE id = '$id'");
$dta = mysqli_fetch_assoc($berita);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $dta['judul'] ?></title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">
</head>
<body>
	<div class="container mt-2">
		<div class="print" hidden="" style="min-height: 600px;">
			<h2 class="mt-3"><?= $dta['judul'] ?></h2>
			<hr>
			<?= $dta['berita_final'] ?>
		</div>
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
	<script src="../assets/js/jquery.PrintArea.js"></script>
	<script>
		$('.print').printArea();
	</script>
</body>
</html>