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
		<input type="busqueda" name="search" placeholder="Search..">
	</body>
</html>

	<?php ob_end_flush();
	}else{
		header("Location: home.php");
	}
	 ?>
