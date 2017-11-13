<?php
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );

	define('DBHOST', '168.232.167.26');
	define('DBUSER', 'TRANSATRANSA');
	define('DBPASS', 'udperritos');
	define('DBNAME', 'dbtransa');

	$conn = mysql_connect(DBHOST,DBUSER,DBPASS);
	$dbcon = mysql_select_db(DBNAME);

	if ( !$conn ) {
		die("Connection failed : " . mysql_error());
	}

	if ( !$dbcon ) {
		die("Database Connection failed : " . mysql_error());
	}
?>
