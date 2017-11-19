<?php
	include_once('dbconnect.php');

	if( isset($_GET['edit1']) )
	{
		$id = $_GET['edit1'];
		$res= mysql_query("SELECT * FROM users WHERE userId='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="edit.php" method="POST">
		Name: <input type="text" name="newsomething" value="<?php echo $row[0]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="userId">
		<input type="submit" value=" Update "/>
		</form>

					<?php

	}

	if( isset($_GET['edit2']) )
	{
		$id = $_GET['edit2'];
		$res= mysql_query("SELECT * FROM users WHERE userName='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="edit.php" method="POST">
		Name: <input type="text" name="newsomething" value="<?php echo $row[1]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="userName">
		<input type="submit" value=" Update "/>
		</form>
				<?php
	}

	if( isset($_GET['edit3']) )

	{
		$id = $_GET['edit3'];
		$res= mysql_query("SELECT * FROM users WHERE TIPO='$id'");
		$row= mysql_fetch_array($res);
		?>
		<form action="edit.php" method="POST">
		Name: <input type="text" name="newsomething" value="<?php echo $row[2]; ?>"><br />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="tipo" value="TIPO">
		<input type="submit" value=" Update "/>
		</form>
			<?php
	}

	if(isset($_POST['newsomething']))
	{
		$newName = $_POST['newsomething'];
		$id  	 = $_POST['id'];
		$tipo  = $_POST['tipo'];
		$sql     = "UPDATE users SET '$tipo'='$newsomething' WHERE '$userId'='$id'";
		$res 	 = mysql_query($sql)
                                    or die("Could not update".mysql_error());
		echo "<meta http-equiv='refresh' content='0;url=users.php'>";
	}

?>
