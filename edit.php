<?php
 include_once('dbconnect.php');

 if( isset($_GET['edit']) )
 {
	 $id = $_GET['edit'];
	 $res= mysql_query("SELECT * FROM users WHERE userId='$id'");
	 $row= mysql_fetch_array($res);
 }

 if( isset($_POST['newName']) )
 {
	 $newName = $_POST['newName'];
	 $id  	 = $_POST['id'];
	 $sql     = "UPDATE users SET userName='$newName' WHERE userId='$id'";
	 $res 	 = mysql_query($sql)
																	 or die("Could not update".mysql_error());
	 echo "<meta http-equiv='refresh' content='0;url=index.php'>";
 }

?>
<form action="edit.php" method="POST">
Name: <input type="text" name="newName" value="<?php echo $row[1]; ?/>"><br />
<input type="hidden" name="id" value="<?php echo $row[0]; ?/>">
<input type="submit" value=" Update "/>
</form>
