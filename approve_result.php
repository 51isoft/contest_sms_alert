<?php
	require "conn.php";
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<META HTTP-EQUIV="pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
	<title>北京师范大学ACM/ICPC比赛短信提醒平台注册结果</title>
</head>
<body>
<?php
    if (!db_user_isroot($nowuser,$nowpass)||!db_user_match($nowuser,$nowpass)) {
        echo "<h1>无权查看此页</h1>";
        die();
    }
	$num=$_POST['num'];
	for ($i=0;$i<$num;$i++) {
		$sql="update user set ";
		if ($_POST["fetion_$i"])  $sql.="fetion=1 ";
		else $sql.="fetion=0 ";
		if ($_POST["check_$i"])  $sql.=",status=1 ";
        else $sql.=",status=0 ";
		$sql.="where user='".$_POST["name_$i"]."'";
		mysql_query($sql);
	}
	echo "<h1>修改成功！</h1>\n<a href='approve.php'>返回</a>\n";
?> 
<body>
</html>
