<?php
	$lastpage=$_SERVER['HTTP_REFERER'];
	include("conn.php");
	setcookie('user',"");
	setcookie('password',"");
	echo "<script language='javascript'>";
	echo "window.location='index.php';";
	echo "</script>";
?>
