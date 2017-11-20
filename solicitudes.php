<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user'])!=""){
		include_once 'dbconnect.php';

		function filterTable($query)
		{
		    $filter_Result = mysql_query($query) or die("Error en: $query: " . mysql_error());;
		    return $filter_Result;
		}



	// function to connect and execute the query

	?>

	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Ver Solicitudes</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<script src="assets/jquery-1.11.3-jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="get-text.js"></script>
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
																<li><a href="solicitudes.php">Ver solicitudes de repuesto</a></li>
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
				<div id="list-form">
	        <form action="solicitudes.php" method="POST">
							<div class="form-group">
									<h2 class="">BUSCAR SOLICITUDES.</h2>
								</div>
	            <input type="text" name="valueToSearch" class="search_1" placeholder="Nombre de item"><br><br>
	            <input type="submit" name="search" class="btn btn-default" value="Filtrar"><br><br>
							<?php
							if(isset($_POST['search']))
							{
									$valueToSearch = trim($_POST['valueToSearch']);
									$valueToSearch = strip_tags($valueToSearch);
									$valueToSearch = htmlspecialchars($valueToSearch);
									// search in all table columns
									// using concat mysql function
									$query = "SELECT * FROM solicitudes WHERE CONCAT(id) LIKE '%".$valueToSearch."%'";
									$search_result = filterTable($query);
									$count = mysql_num_rows($search_result);
									if($count!=0){
									?>
									<html>
									<head>
									<style>
									table {
    								border-collapse: collapse;
    								width: 100%;
									}

									th, td {
    								padding: 8px;
    								text-align: left;
    								border-bottom: 1px solid #ddd;
									}

									tr:hover{background-color:#f5f5f5}
									</style>
										<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
										<title>Administrador de usuarios</title>
										<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
										<link rel="stylesheet" href="style.css" type="text/css" />
									</head>
									<body>
									<table id="employee_grid" class="table table-condensed table-hover table-striped bootgrid-table" width="60%" cellspacing="0">
											<tr>
													<th>id</th>
													<th>fecha</th>
													<th>cantidad</th>
													<th>eliminar</th>
											</tr>

											<?php while($row = mysql_fetch_array($search_result)):?>
											<tr>
												  <td><?php echo "$row[id]";?></td>
													<td><?php echo "$row[fecha] <a href='editsolicitud.php?edit2=$row[id]' class='btn btn-default'> editar </a>";?></td>
													<td><?php echo "$row[cantidad] <a href='editsolicitud.php?edit3=$row[id]' class='btn btn-default'> editar </a>";?></td>
													<td><?php echo "<a href='editsolicitud.php?edit4=$row[id]' class='btn btn-default'> Eliminar solicitud</a>";?></td>

											</tr>

											<?php endwhile;?>
									</table>
									</body>
									</html>
									<?php
								}

							}else {
									$query = "SELECT * FROM users";
									$search_result = filterTable($query);
							}



							 ?>




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
