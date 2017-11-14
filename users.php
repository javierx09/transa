<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
		include_once 'dbconnect.php';


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
									<form>
                    <input type="text" name="busqueda" class="form-control input-lg" placeholder="Buscar" />
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-block btn-primary" name="btn-buscar">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
									</form>
                </div>
            </div>
        </div>
	</div>
</div>
<div class="container">
<?php
if ( isset($_POST['btn-buscar']) ) {

	$error = false;
	$buscar = trim($_POST['busqueda']);
	$buscar = strip_tags($buscar);
	$buscar = htmlspecialchars($buscar);
	$query = "SELECT * FROM users WHERE userEmail='$buscar'";
	$result = mysql_query($query);
	$res = mysql_query($query);
	$resultado = trim($res);
	$resultado = strip_tags($resultado);
	$resultado = htmlspecialchars($resultado);
	while($row = mysqli_fetch_array($res))
{

			echo '<div>
						<a href="users.php>"><img src="http://www.mysite.com/images/logo.jpg" width="50" height="50" alt="La mia pagina su Mysite"/></a>
            </div>';
}

}
?>
</div>
</body>
</html>
	<?php ob_end_flush();
	}else{
		header("Location: home.php");
	}
	 ?>
