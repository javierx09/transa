<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
		include_once 'dbconnect.php';

		$error = false;

	?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>
		<div id="wrapper">

		<div class="container">

				<div class="page-header">
				<h3>Ingrese el nombre de la persona a la que quiere buscar</h3>
				</div>

					<div class="row">
					<div class="col-lg-12">
					<input type="busqueda" name="search" placeholder="Search..">
					</div>
					</div>

			</div>

			</div>

			<script src="assets/jquery-1.11.3-jquery.min.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>


	</body>
</html>

	<?php ob_end_flush();
	}else{
		header("Location: home.php");
	}
	 ?>
