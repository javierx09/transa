<?php
	ob_start();
	session_start();
	include_once('dbconnect.php');
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
		include_once 'dbconnect.php';

	if( isset($_GET['edit1']) )
	{
		$id = $_GET['edit1'];
		$res= mysql_query("SELECT * FROM users WHERE userId='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="edit.php" method="POST">
		Rut: <input type="text" name="newsomething" value="<?php echo $row[0]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="userId">
		<input type="submit" value=" Actualizar "/>
		</form>

					<?php

	}

	if( isset($_GET['edit2']) )
	{
		$id = $_GET['edit2'];
		$res= mysql_query("SELECT * FROM users WHERE userId='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="edit.php" method="POST">
		Name: <input type="text" name="newsomething" value="<?php echo $row[1]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="userName">
		<input type="submit" value=" Actualizar "/>
		</form>
				<?php
	}

	if( isset($_GET['edit3']) )

	{
		$id = $_GET['edit3'];
		$res= mysql_query("SELECT * FROM users WHERE userId='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="edit.php" method="POST">
		Tipo: <select class="form-control" name="newsomething">
						<option value="1">SUPERVISOR</option>
						<option value="2">ADMINISTRADOR</option>
					</select>
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="TIPO">
		<input type="submit" value=" Actualizar "/>
		</form>
			<?php
	}
	if( isset($_GET['edit4']) )

	{
		$id = $_GET['edit4'];
		$res= mysql_query("DELETE FROM users WHERE userId='$id'")or die("Could not update".mysql_error()); echo "<meta http-equiv='refresh' content='0;url=users.php'>";
	}
	if(isset($_POST['newsomething']))
	{
		$newsomething = $_POST['newsomething'];
		$id  	 = $_POST['id'];
		$tipo  = $_POST['tipo'];
		$sql     ="UPDATE users SET $tipo='$newsomething' WHERE userId='$id';";
		$res 	 = mysql_query($sql)
                                    or die("Could not update".mysql_error());
		echo "<meta http-equiv='refresh' content='0;url=users.php'>";
	}
}else{
	header("Location: home.php");
}
?>
