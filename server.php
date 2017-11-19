<?php
	ob_start();
	session_start();
	  //include connection file
	  include_once("dbconnect.php");

	  //define index of column
	  $columns = array(
	    0 =>'Rut',
	    1 => 'Nombre',
	    2 => 'Tipo'
	  );
	  $error = true;
	  $colVal = '';
	  $colIndex = $rowId = 0;

	  $msg = array('status' => !$error, 'msg' => 'Failed! updation in mysql');

	  if(isset($_POST)){
	    if(isset($_POST['val']) && !empty($_POST['val']) && $error) {
	      $colVal = $_POST['val'];
	      $error = false;

	    } else {
	      $error = true;
	    }
	    if(isset($_POST['index']) && $_POST['index'] >= 0 &&  $error) {
	      $colIndex = $_POST['index'];
	      $error = false;
	    } else {
	      $error = true;
	    }
	    if(isset($_POST['id']) && $_POST['id'] > 0 && $error) {
	      $rowId = $_POST['id'];
	      $error = false;
	    } else {
	      $error = true;
	    }

	    if(!$error) {
	        $sql = "UPDATE users SET ".$columns[$colIndex]." = '".$colVal."' WHERE id='".$rowId."'";
	        $status = mysql_query($sql) or die("database error:". mysql_error());
	        $msg = array('status' => !$error, 'msg' => 'Success! updation in mysql');
	    }
	  }

	  // send data as json format
	  echo json_encode($msg);

	?>
