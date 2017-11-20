<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
		include_once 'dbconnect.php';

		$error = false;

		if ( isset($_POST['btn-signup']) ) {
			$name = trim($_POST['name']);
			$name = strip_tags($name);
			$name = htmlspecialchars($name);

			$cantidad = trim($_POST['cantidad']);
			$cantidad = strip_tags($cantidad);
			$cantidad = htmlspecialchars($cantidad);

			$valorunitario = trim($_POST['valorunitario']);
			$valorunitario = strip_tags($valorunitario);
			$valorunitario = htmlspecialchars($valorunitario);

			// basic name validation
			if (empty($name)) {
				$error = true;
				$nameError = "Por favor ingrese el nombre";
			}

			//basic id validation
			if ( !filter_var($name,FILTER_VALIDATE_EMAIL) ) {
			  //$error = false;
			  //$emailError = "Please enter valid email address.";
				// check email exist or not
				$query = "SELECT * FROM items WHERE nombre='$name'";
				$result = mysql_query($query);
				$count = mysql_num_rows($result);
				if($count!=0){
					$error = true;
					$idError = "Ya hay un item con este nombre!";
				}
			}
			// password validation
			if (empty($valorunitario)){
				$error = true;
				$valorunitarioError = "Por favor ingrese un precio unitario";
			}

			// if there's no error, continue to signup
			if( !$error ) {

				$query = "INSERT INTO items(nombre,cantidad,valorunitario) VALUES('$name','$cantidad','$valorunitario')";
				$res = mysql_query($query);

				if ($res) {
					$errTyp = "success";
					$errMSG = "Item creado de forma correcta!";
					unset($name);
					unset($id);
					unset($pass);
					unset($tipo);
				} else {
					$errTyp = "danger";
					$errMSG = "Hubo un problema, intente de nuevo...";
				}
			}


		}

	?>
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sistema de registro</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>

	<div class="container">

		<div id="login-form">
	    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

	    	<div class="col-md-12">

	        	<div class="form-group">
	            	<h2 class="">Crear Item.</h2>
	            </div>

	        	<div class="form-group">
	            	<hr />
	            </div>

	            <?php
				if ( isset($errMSG) ) {

					?>
					<div class="form-group">
	            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
					<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
	                </div>
	            	</div>
	                <?php
				}
				?>

	            <div class="form-group">
	            	<div class="input-group">
	                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
	            	<input type="text" name="name" class="form-control" placeholder="Ingrese nombre del item" maxlength="50" value="<?php echo $name ?>" />
	                </div>
	                <span class="text-danger"><?php echo $nameError; ?></span>
	            </div>

	            <div class="form-group">
	            	<div class="input-group">
	                <span class="input-group-addon"><span class="glyphicon glyphicon-flash"></span></span>
	            	<input type="text" name="cantidad" class="form-control" placeholder="Ingrese Cantidad a agregar" maxlength="40" pattern="[0-9]{1,20}" title="No puede contener ninguna letra"/>
	                </div>
	            </div>

	            <div class="form-group">
	            	<div class="input-group">
	                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
	            	<input type="text" name="valorunitario" class="form-control" placeholder="Ingrese valor unitario sin puntos" maxlength="15" pattern="[0-9]{1,40}" title="No puede contener ningún punto ni coma"/>
	                </div>
	                <span class="text-danger"><?php echo $valorunitarioError; ?></span>
	            </div>


	            <div class="form-group">
	            	<hr />
	            </div>

	            <div class="form-group">
	            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Crear Item</button>
	            </div>


	            <div class="form-group">
	            	<hr />
	            </div>


	        </div>

	    </form>
	    </div>

	</div>

	</body>
	</html>

	<?php ob_end_flush();
	}else{
		header("Location: home.php");
	}
	 ?>
