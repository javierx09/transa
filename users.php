<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
		include_once 'dbconnect.php';

		$error = false;

	?>
	<input type="busqueda" name="search" placeholder="Search..">

	<?php ob_end_flush();
	}else{
		header("Location: home.php");
	}
	 ?>
