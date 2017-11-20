<?php
	ob_start();
	session_start();
	include_once('dbconnect.php');
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
		include_once 'dbconnect.php';

	if( isset($_GET['edit1']) )
	{
		$id = $_GET['edit1'];
		$res= mysql_query("SELECT * FROM camiones WHERE patente='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="editcamion.php" method="POST">
		Patente: <input type="text" name="newsomething" value="<?php echo $row[0]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="patente">
		<input type="submit" value=" Update "/>
		</form>

					<?php

	}

	if( isset($_GET['edit2']) )
	{
		$id = $_GET['edit2'];
		$res= mysql_query("SELECT * FROM camiones WHERE patente='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="editcamion.php" method="POST">
		año: <input type="text" name="newsomething" value="<?php echo $row[1]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="ano">
		<input type="submit" value=" Update "/>
		</form>
				<?php
	}

	if( isset($_GET['edit3']) )

	{
		$id = $_GET['edit3'];
		$res= mysql_query("SELECT * FROM camiones WHERE patente='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="editcamion.php" method="POST">
		Descripcion: <input type="text" name="newsomething" value="<?php echo $row[2]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="descripcion">
		<input type="submit" value=" Update "/>
		</form>
			<?php
	}
	if( isset($_GET['edit4']) )

	{
		$id = $_GET['edit4'];
		$res= mysql_query("DELETE FROM camiones WHERE patente='$id'")or die("Could not update".mysql_error()); echo "<meta http-equiv='refresh' content='0;url=camiones.php'>";
	}
	if(isset($_POST['newsomething']))
	{
		$newsomething = $_POST['newsomething'];
		$id  	 = $_POST['id'];
		$tipo  = $_POST['tipo'];
		$sql     ="UPDATE camiones SET $tipo='$newsomething' WHERE patente='$id';";
		$res 	 = mysql_query($sql)
                                    or die("Could not update".mysql_error());
		echo "<meta http-equiv='refresh' content='0;url=users.php'>";
	}
}else{
	header("Location: home.php");
}
?>
