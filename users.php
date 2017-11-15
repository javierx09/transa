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
	<title>Coding Cage - Login & Registration System</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>
		<div class="container">

	        <form action="users.php" class="searchbox_1" method="post">
						<div class="col-md-12">
	            <input type="text" name="valueToSearch" class="search_1" placeholder="Value To Search"><br><br>
	            <input type="submit" name="search" class="submit_1" value="Filter"><br><br>
							<?php
							if(isset($_POST['search']))
							{
									$valueToSearch = $_POST['valueToSearch'];
									// search in all table columns
									// using concat mysql function
									$query = "SELECT * FROM users WHERE CONCAT(userId, userName, userEmail, TIPO) LIKE '%".$valueToSearch."%'";
									$search_result = filterTable($query);
									$count = mysql_num_rows($search_result);
									if($count!=0){
									?>
									<html>
									<head>
									<style>
										table,tr,th,td
										{
											border: 1px solid black;
										}
									</style>
										<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
										<title>Coding Cage - Login & Registration System</title>
										<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
										<link rel="stylesheet" href="style.css" type="text/css" />
									</head>
									<body>
									<table>
											<tr>
													<th>Id</th>
													<th>Nombre</th>
													<th>Email</th>
													<th>Tipo</th>
											</tr>
						<!-- populate table from mysql database -->
											<?php while($row = mysql_fetch_array($search_result)):?>
											<tr>
													<td><?php echo $row['userId'];?></td>
													<td><?php echo $row['userName'];?></td>
													<td><?php echo $row['userEmail'];?></td>
													<td><?php if(($row['TIPO'])==2){echo 'Administrador';}else{echo 'Operario';}?></td>
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

						</div>


	        </form>
				</div>

	    </body>
	</html>
	<?php ob_end_flush();
	}else{
		header("Location: home.php");
	}
	 ?>
