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
	        <title>PHP HTML TABLE DATA SEARCH</title>
	        <style>
	            table,tr,th,td
	            {
	                border: 1px solid black;
	            }
	        </style>
	    </head>
	    <body>

	        <form action="users.php" method="post">
	            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
	            <input type="submit" name="search" value="Filter"><br><br>
							<?php
							if(isset($_POST['search']))
							{
									$valueToSearch = $_POST['valueToSearch'];
									// search in all table columns
									// using concat mysql function
									$query = "SELECT * FROM users WHERE CONCAT(userId, userName, userEmail, TIPO) LIKE '%".$valueToSearch."%'";
									$search_result = filterTable($query);
									$count = mysql_num_rows($search_result);
									if(($count)!=0){
									?>
									<html>
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


	        </form>

	    </body>
	</html>
	<?php ob_end_flush();
	}else{
		header("Location: home.php");
	}
	 ?>
