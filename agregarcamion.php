<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
		include_once 'dbconnect.php';

		$error = false;

		if ( isset($_POST['btn-crearcamion']) ) {
			$patente = trim($_POST['patente']);
			$patente = strip_tags($patente);
			$patente = htmlspecialchars($patente);

			$ano = trim($_POST['ano']);
			$ano = strip_tags($ano);
			$ano = htmlspecialchars($ano);

			$descripcion = strip_tags($_POST['descripcion']);
			$descripcion = htmlspecialchars($descripcion);


			// basic name validation
			if (empty($patente)) {
				$error = true;
				$patenteError = "Por favor ingrese una patente";
			} else if (strlen($patente) < 6) {
				$error = true;
				$patenteError = "La patente debe contener al menos 6 caracteres ";
			} else if (!preg_match("/^[a-zA-Z0-9]+$/",$patente)) {
				$error = true;
				$patenteError = "intente de nuevo";
			}

			//basic id validation
			if ( !filter_var($patente,FILTER_VALIDATE_EMAIL) ) {
			  //$error = false;
			  //$emailError = "Please enter valid email address.";
				// check email exist or not
				$query = "SELECT patente FROM camiones WHERE patente='$patente'";
				$result = mysql_query($query);
				$count = mysql_num_rows($result);
				if($count!=0){
					$error = true;
					$patenteError = "Ya hay un camión con esta patente en el sistema";
				}
			}
			// password validation
			if (empty($ano)){
				$error = true;
				$ano = "Por favor ingresa el ano del camión";
			} else if(strlen($ano) < 4) {
				$error = true;
				$anoError = "el ano debe ser de cuatro digitos, por ejemplo: 2010";
			}



			if( !$error ) {

				$query = "INSERT INTO camiones(patente,ano,descripcion) VALUES('$patente','$ano','$descripcion')";
				$res = mysql_query($query);
				if ($res) {
					$errTyp = "success";
					$errMSG = "camión creado de forma correcta!";
					unset($patente);
					unset($ano);
					unset($descripcion);
				} else {
					$errTyp = "danger";
					$errMSG = "Hubo un problema, intente de nuevo...".mysql_error();
				}
			}


		}

	?>
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Registro de camiones</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>

	<div class="container">

		<div id="login-form">
	    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

	    	<div class="col-md-12">

	        	<div class="form-group">
	            	<h2 class="">REGISTRAR CAMIÓN.</h2>
	            </div>

	        	<div class="form-group">
	            	<hr />
	            </div>

	            <?php
				if ( isset($errMSG) ) {

					?>
					<div class="form-group">
	            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
					<span class="glyphicon glyphicon-info-sign"></span><?php echo $errMSG; ?>
	                </div>
	            	</div>
	                <?php
				}
				?>

	            <div class="form-group">
	            	<div class="input-group">
	                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
	            	<input type="text" name="patente" class="form-control" placeholder="Ingresa Patente" pattern="[0-9a-zA-Z]{6,15}" maxlength="14" title="Debe ingresar patente sin espacios ni guiones" />
	                </div>
	                <span class="text-danger"><?php echo $patenteError; ?></span>
	            </div>

	            <div class="form-group">
	            	<div class="input-group">
	                <span class="input-group-addon"><span class="glyphicon glyphicon-flash"></span></span>
	            	<input type="text" name="ano" class="form-control" placeholder="Ingresar ano del vehículo" maxlength="4" pattern="[0-9]{4}" title="Debe ingresar el ano del camion, ejemplo: 1998"/>
	                </div>
									<span class="text-danger"><?php echo $anoError; ?></span>
	            </div>

	            <div class="form-group">
	            	<div class="input-group">
	                <span class="input-group-addon"><span class="glyphicon glyphicon-comment"></span></span>
	            	<input type="text" name="descripcion" class="form-control" placeholder="si desea, escriba una descripción" maxlength="59" />
	                </div>
	                <span class="text-danger"><?php echo $descripcionError; ?></span>
	            </div>

	            <div class="form-group">
	            	<hr />
	            </div>

	            <div class="form-group">
	            	<button type="submit" class="btn btn-block btn-primary" name="btn-crearcamion">Crear Camión!</button>
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
