<?php
	ob_start();
	session_start();
	include_once('dbconnect.php');
	if(isset($_SESSION['user'])!=""){
		include_once 'dbconnect.php';

	if( isset($_GET['edit1']) )
	{
		$id = $_GET['edit1'];
		$res= mysql_query("SELECT * FROM items WHERE id='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="edititems.php" method="POST">
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
		$res= mysql_query("SELECT * FROM items WHERE id='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="edititems.php" method="POST">
		Cantidad: <input type="text" name="newsomething" value="<?php echo $row[2]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="cantidad">
		<input type="submit" value=" Actualizar "/>
		</form>
				<?php
	}

	if( isset($_GET['edit3']) )

	{
		$id = $_GET['edit3'];
		$res= mysql_query("SELECT * FROM items WHERE id='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="edititems.php" method="POST">
		Valor Unitario: <input type="text" name="newsomething" value="<?php echo $row[3]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="valorunitario">
		<input type="submit" value=" Actualizar "/>
		</form>
				<?php
	}
	if( isset($_GET['edit5']) )

	{
		$id = $_GET['edit5'];
		$res= mysql_query("SELECT * FROM items WHERE id='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="edititems.php" method="POST">
		cantidad a solicitar: <input type="text" name="solicitud"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="submit" value=" Solicitar "/>
		</form>
				<?php
	}

	if( isset($_GET['edit4']) )

	{
		$id = $_GET['edit4'];
		$res= mysql_query("DELETE FROM items WHERE id='$id'")or die("Could not update".mysql_error()); echo "<meta http-equiv='refresh' content='0;url=items.php'>";
	}
	if(isset($_POST['newsomething']))
	{
		$newsomething = $_POST['newsomething'];
		$id  	 = $_POST['id'];
		$tipo  = $_POST['tipo'];
		$sql     ="UPDATE items SET $tipo='$newsomething' WHERE id='$id';";
		$res 	 = mysql_query($sql)
                                    or die("Could not update".mysql_error());
		echo "<meta http-equiv='refresh' content='0;url=items.php'>";
	}

if(isset($_POST['solicitud']))
{

	$solicitud = $_POST['solicitud'];
	$date = date("D M d, Y G:i");
	$id  	 = $_POST['id'];
	$sql     ="INSERT INTO solicitudes(id,fecha,cantidad) VALUES('$id','$date','$solicitud')";
	$res 	 = mysql_query($sql)
																	or die("Could not update".mysql_error());
	echo "<meta http-equiv='refresh' content='0;url=items.php'>";
}
}else{
header("Location: home.php");
}
?>
