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
                    <input type="text" name="busqueda" class="form-control input-lg" placeholder="Buscar" />
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-lg" name="btn-buscar">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
	</div>
</div>
<?php
if ( isset($_POST['btn-buscar']) ) {

	$error = false;
	$buscar = trim($_POST['busqueda']);
	$buscar = strip_tags($buscar);
	$buscar = htmlspecialchars($buscar);
	$query = "SELECT * FROM users WHERE userEmail='$buscar'";
	$result = mysql_query($query);
	$res = mysql_query($query);
	echo '<table>';
for ($i = 0; $i < $max; $i++)
{
	echo "<PRE>";
	print_r($res);
	echo "</PRE>";
}
echo '</table>';

}
?>

</body>
</html>
	<?php ob_end_flush();
	}else{
		header("Location: home.php");
	}
	 ?>
