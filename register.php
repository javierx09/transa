<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
		include_once 'dbconnect.php';

		$error = false;

		if ( isset($_POST['btn-signup']) ) {

			// clean user inputs to prevent sql injections
			$name = trim($_POST['name']);
			$name = strip_tags($name);
			$name = htmlspecialchars($name);

			$email = trim($_POST['email']);
			$email = strip_tags($email);
			$email = htmlspecialchars($email);

			$pass = trim($_POST['pass']);
			$pass = strip_tags($pass);
			$pass = htmlspecialchars($pass);

			$tipo = trim($_POST['tipo']);
			$tipo = strip_tags($tipo);
			$tipo = htmlspecialchars($tipo);

			// basic name validation
			if (empty($name)) {
				$error = true;
				$nameError = "Please enter your full name.";
			} else if (strlen($name) < 3) {
				$error = true;
				$nameError = "Name must have atleat 3 characters.";
			} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
				$error = true;
				$nameError = "Name must contain alphabets and space.";
			}

			//basic email validation
			if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
				$error = false;
				$emailError = "Please enter valid email address.";
			} else {
				// check email exist or not
				$query = "SELECT userEmail FROM users WHERE userEmail='$email'";
				$result = mysql_query($query);
				$count = mysql_num_rows($result);
				if($count!=0){
					$error = true;
					$emailError = "Provided Email is already in use.";
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

				$query = "INSERT INTO users(userName,userEmail,userPass,TIPO) VALUES('$name','$email','$password','$tipo')";
				$res = mysql_query($query);

				if ($res) {
					$errTyp = "success";
					$errMSG = "Successfully registered, you may login now";
					unset($name);
					unset($email);
					unset($pass);
				} else {
					$errTyp = "danger";
					$errMSG = "Something went wrong, try again later...";
				}

			}


		}
	?>
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Coding Cage - Login & Registration System</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>

	<div class="container">

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
	            	<input type="email" name="email" class="form-control" placeholder="Ingresar RUT sin puntos ni guión" maxlength="40" value="<?php echo $email ?>" pattern="[1-9]{9}"/>
	                </div>
									<span class="text-danger"><?php echo $mailError; ?></span>
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
