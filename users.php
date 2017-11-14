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
		<div class="container">
			<div class="row">
		        <div class="col-md-6">
		    		<h2>Custom search field</h2>
		            <div id="custom-search-input">
		                <div class="input-group col-md-12">
		                    <input type="text" class="form-control input-lg" placeholder="Buscar" />
		                    <span class="input-group-btn">
		                        <button class="btn btn-info btn-lg" type="button">
		                            <i class="glyphicon glyphicon-search"></i>
		                        </button>
		                    </span>
		                </div>
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
