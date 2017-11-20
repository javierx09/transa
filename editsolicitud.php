<?php
	ob_start();
	session_start();
	include_once('dbconnect.php');
	if(isset($_SESSION['user'])!=""){
		include_once 'dbconnect.php';

	if( isset($_GET['edit1']) )
	{
		$id = $_GET['edit1'];
		$res= mysql_query("SELECT * FROM solicitudes WHERE id='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="editsolicitud.php" method="POST">
		Nombre: <input type="text" name="newsomething" value="<?php echo $row[1]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="nombre">
		<input type="submit" value=" Actualizar "/>
		</form>

					<?php

	}

	if( isset($_GET['edit2']) )
	{
		$id = $_GET['edit2'];
		$res= mysql_query("SELECT * FROM solicitudes WHERE id='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="editsolicitud.php" method="POST">
		Cantidad: <input type="text" name="newsomething" value="<?php echo $row[1]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="fecha">
		<input type="submit" value=" Actualizar "/>
		</form>
				<?php
	}

	if( isset($_GET['edit3']) )

	{
		$id = $_GET['edit3'];
		$res= mysql_query("SELECT * FROM solicitudes WHERE id='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="editsolicitud.php" method="POST">
		Valor Unitario: <input type="text" name="newsomething" value="<?php echo $row[2]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="cantidad">
		<input type="submit" value=" Actualizar "/>
		</form>
				<?php
	}

	if( isset($_GET['edit4']) )

	{
		$id = $_GET['edit4'];
		$res= mysql_query("DELETE FROM solicitudes WHERE id='$id'")or die("Could not update".mysql_error()); echo "<meta http-equiv='refresh' content='0;url=solicitudes.php'>";
	}
	if(isset($_POST['newsomething']))
	{
		$newsomething = $_POST['newsomething'];
		$id  	 = $_POST['id'];
		$tipo  = $_POST['tipo'];
		$sql     ="UPDATE solicitudes SET $tipo='$newsomething' WHERE id='$id';";
		$res 	 = mysql_query($sql)
                                    or die("Could not update".mysql_error());
		echo "<meta http-equiv='refresh' content='0;url=solicitudes.php'>";
	}

}else{
header("Location: home.php");
}
?>
