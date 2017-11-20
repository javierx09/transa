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

			$id = trim($_POST['id']);
			$id = strip_tags($id);
			$id = htmlspecialchars($id);

			$pass = trim($_POST['pass']);
			$pass = strip_tags($pass);
			$pass = htmlspecialchars($pass);

			$tipo = trim($_POST['tipo']);
			$tipo = strip_tags($tipo);
			$tipo = htmlspecialchars($tipo);

			// basic name validation
			if (empty($name)) {
				$error = true;
				$nameError = "Por favor ingrese su nombre";
			} else if (strlen($name) < 3) {
				$error = true;
				$nameError = "Su nombre debe tener al menos 3 letras.";
			} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
				$error = true;
				$nameError = "intente de nuevo";
			}

			//basic id validation
			if ( !filter_var($id,FILTER_VALIDATE_EMAIL) ) {
			  //$error = false;
			  //$emailError = "Please enter valid email address.";
				// check email exist or not
				$query = "SELECT userId FROM users WHERE userId='$id'";
				$result = mysql_query($query);
				$count = mysql_num_rows($result);
				if($count!=0){
					$error = true;
					$idError = "Ya hay una cuenta con este rut en el sistema!";
				}
			}
			// password validation
			if (empty($pass)){
				$error = true;
				$passError = "Please enter password.";
			} else if(strlen($pass) < 6) {
				$error = true;
				$passError = "Password must have atleast 6 characters.";
			}

			// password encrypt using SHA256();
			$password = hash('sha256', $pass);

			// if there's no error, continue to signup
			if( !$error ) {

				$query = "INSERT INTO users(userName,userId,userPass,TIPO) VALUES('$name','$id','$password','$tipo')";
				$res = mysql_query($query);

				if ($res) {
					$errTyp = "success";
					$errMSG = "Usuario creado de forma correcta!";
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

		<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<?php
								if(isset($_SESSION['user'])!="") {
									if(($_SESSION['tipo'])==2){
									echo '<li class"dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestionar Usuarios</a>
														<ul class="dropdown-menu">
															<li><a href="register.php">Registrar Usuario</a></li>
															<li><a href="users.php">ver usuarios</a></li>
															</ul
												</li>
												<li class"dropdown">
																<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestionar Camiones</a>
																	<ul class="dropdown-menu">
																		<li><a href="agregarcamion.php">Agregar Camion</a></li>
																		<li><a href="camiones.php">Ver Camiones</a></li>
																		</ul
															</li>
												<li class"dropdown">
																<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestionar Finanzas</a>
																	<ul class="dropdown-menu">
																		 <li><a href="Finanzas_funcion1.php">Finanzas_funcion</a></li>
																		 <li><a href="Finanzas_funcion2.php">Finanzas_funcion2</a></li>
																	</ul
															</li>';

										}
										echo '<li class"dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestionar Bodega</a>
															<ul class="dropdown-menu">
																<li><a href="agregaritem.php">Agregar Item</a></li>
																<li><a href="items.php">Ver Items</a></li>
																<li><a href="crearsolicitudrepuesto.php">Crear Solicitud Repuesto</a></li>
																</ul
													</li>';
										echo '<li><a href="mantencion.php">Realizar Mantención</a></li>';

								}
							?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-user"></span>&nbsp;Hola! <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Salir del sistema</a></li>
								</ul>
							</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</nav>
		<div class="container">
			<div class="page-header"></div>

		<div id="login-form">
	    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

	    	<div class="col-md-12">

	        	<div class="form-group">
	            	<h2 class="">REGISTRAR USUARIO.</h2>
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
	            	<input type="text" name="name" class="form-control" placeholder="Ingresar nombre" maxlength="50" value="<?php echo $name ?>" />
	                </div>
	                <span class="text-danger"><?php echo $nameError; ?></span>
	            </div>

	            <div class="form-group">
	            	<div class="input-group">
	                <span class="input-group-addon"><span class="glyphicon glyphicon-flash"></span></span>
	            	<input type="text" name="id" class="form-control" placeholder="Ingresar RUT sin puntos ni guión" maxlength="40" pattern="[0-9kK]{9}" title="Debe ingresar SU rut sin puntos ni guión"/>
	                </div>
									<span class="text-danger"><?php echo $idError; ?></span>
	            </div>

	            <div class="form-group">
	            	<div class="input-group">
	                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
	            	<input type="password" name="pass" class="form-control" placeholder="Ingresar contraseña" maxlength="15" />
	                </div>
	                <span class="text-danger"><?php echo $passError; ?></span>
	            </div>

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
								<select class="form-control" name="tipo">
									<option value="1">SUPERVISOR</option>
									<option value="2">ADMINISTRADOR</option>
								</select>
								</div>
							</div>

	            <div class="form-group">
	            	<hr />
	            </div>

	            <div class="form-group">
	            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Registrar Usuario</button>
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
