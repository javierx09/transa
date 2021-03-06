<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';

	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['user'])!="" ) {
		header("Location: home.php");
		exit;
	}

	$error = false;

	if( isset($_POST['btn-login']) ) {

		// prevent sql injections/ clear user invalid inputs
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);

		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs

		if(empty($id)){
			$error = true;
			$idError = "Por favor ingresa tu Rut .";
		}

		if(empty($pass)){
			$error = true;
			$passError = "Por favor Ingresa tu contraseña.";
		}

		// if there's no error, continue to login
		if (!$error) {

			$password = hash('sha256', $pass); // password hashing using SHA256

			$res=mysql_query("SELECT userId, userName, userPass, TIPO FROM users WHERE userId='$id'");
			$row=mysql_fetch_array($res);
			$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

			if( $count == 1 && $row['userPass']==$password ) {
				$_SESSION['user'] = $row['userId'];
				$_SESSION['tipo'] = $row['TIPO'];
				header("Location: home.php");
			} else {
				$errMSG = "Rut o contraseña incorrectos, intenta de nuevo...";
			}

		}

	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login System</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

    	<div class="col-md-12">

        	<div class="form-group">
            	<h2 class="">Sign In.</h2>
            </div>

        	<div class="form-group">
            	<hr />
            </div>

            <?php
			if ( isset($errMSG) ) {
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>

            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-flash"></span></span>
            	<input type="text" name="id" class="form-control" placeholder="Ingrese RUT sin puntos ni guión" value="<?php echo $email; ?>" maxlength="40" pattern="[0-9kK]{9}" title="Debe ingresar SU rut sin puntos ni guión"/>
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>

            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Tu contraseña" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>

            <div class="form-group">
            	<hr />
            </div>

            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
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
<?php ob_end_flush(); ?>
