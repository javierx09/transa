<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
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
	<title>Buscar Usuario</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<script src="assets/jquery-1.11.3-jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="get-text.js"></script>
	</head>
	<body>
							<?php
							if(isset($_POST['mantenciones']))
							{
									$valueToSearch = trim($_POST['mantenciones']);
									$valueToSearch = strip_tags($valueToSearch);
									$valueToSearch = htmlspecialchars($valueToSearch);
									// search in all table columns
									// using concat mysql function
									$query = "SELECT * FROM mantenciones WHERE id='$mantenciones'";
									$search_result = filterTable($query);
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
													<th>Fecha</th>
													<th>Cantidad De Items</th>
													<th>Trabajador</th>
											</tr>

											<?php while($row = mysql_fetch_array($search_result)):?>
											<tr>
													<td><?php echo "$row[fecha]";?></td>
													<td><?php echo "$row[cantidaditems]";?></td>
													<td><?php echo "$row[trabajador]";?></td>
											</tr>

											<?php endwhile;?>
									</table>
									</body>
									</html>
									<?php


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
