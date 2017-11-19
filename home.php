<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
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
																	<li><a href="eliminarcamion.php">Eliminar Camion</a></li>
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
															<li><a href="crearitems.php">Crear Item</a></li>
															<li><a href="modificaritem.php">Modificar Item</a></li>
															<li><a href="crearsolicitudrepuesto.php">Crear Solicitud Repuesto</a></li>
															</ul
												</li>';

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
	<div id="wrapper">

	<div class="container">

    	<div class="page-header">
    	<h3>Noticias Recientes! (aqui se podría colocar alguna notificacion por si algun item no tiene stock)</h3>
    	</div>

        <div class="row">
        <div class="col-lg-12">
        <h1>oliwi</h1>
        </div>
        </div>

    </div>

    </div>

    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>
