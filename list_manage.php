<?php
	require "conn.php";
    $user=$_GET['user'];
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<META HTTP-EQUIV="pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
	<title>北京师范大学ACM/ICPC比赛短信提醒平台信息短信管理结果</title>
</head>
<body>
<?php
    if (!db_user_match($nowuser,$nowpass)||$nowuser!=$user) {
        echo "<h1>无权修改！</h1>";
        die();
    }
	$num=$_POST['total'];
	for ($i=0;$i<$num;$i++) {
		if ($_POST["check_$i"]) {
			$id=$_POST["id_$i"];
			$sql="update queue set sent=1 where id='$id'";
			mysql_query($sql);
		}
	}
?>
	<h1>修改完成！</h1>
<body>
</html>
