<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
		include_once 'dbconnect.php';

		function filterTable($query)
		{
		    $filter_Result = mysqli_query($query);
		    return $filter_Result;
		}
	if(isset($_POST['search']))
	{
	    $valueToSearch = $_POST['valueToSearch'];
	    // search in all table columns
	    // using concat mysql function
	    $query = "SELECT * FROM 'users' WHERE CONCAT('id', 'userName', 'userEmail', 'TIPO') LIKE '%".$valueToSearch."%'";
	    $search_result = filterTable($query);

	}
	 else {
	    $query = "SELECT * FROM `users`";
	    $search_result = filterTable($query);
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

	        <form action="php_html_table_data_filter.php" method="post">
	            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
	            <input type="submit" name="search" value="Filter"><br><br>

	            <table>
	                <tr>
	                    <th>Id</th>
	                    <th>Nombre</th>
	                </tr>

	      <!-- populate table from mysql database -->
	                <?php while($row = mysqli_fetch_array($search_result)):?>
	                <tr>
	                    <td><?php echo $row['id'];?></td>
	                    <td><?php echo $row['fname'];?></td>
	                    <td><?php echo $row['lname'];?></td>
	                    <td><?php echo $row['age'];?></td>
	                </tr>
	                <?php endwhile;?>
	            </table>
	        </form>

	    </body>
	</html>
<?php
if ( isset($_POST['btn-buscar']) ) {

	$error = false;
	$buscar = trim($_POST['busqueda']);
	$buscar = strip_tags($buscar);
	$buscar = htmlspecialchars($buscar);
	$query = "SELECT * FROM users WHERE userEmail='$buscar'";
	$result = mysql_query($query);
	$res = mysql_query($query);
	$resultado = trim($res);
	$resultado = strip_tags($resultado);
	$resultado = htmlspecialchars($resultado);
	while($row = mysqli_fetch_array($res))
{

			echo '<div>
						<a href="users.php>"><img src="http://www.mysite.com/images/logo.jpg" width="50" height="50" alt="La mia pagina su Mysite"/></a>
            </div>';
}

}
?>
</div>
</body>
</html>
	<?php ob_end_flush();
	}else{
		header("Location: home.php");
	}
	 ?>
