<?php
	require "conn.php";
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<META HTTP-EQUIV="pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
	<title>北京师范大学ACM/ICPC比赛短信提醒平台审核页面</title>
</head>
<body>
<?php
	if (!db_user_isroot($nowuser,$nowpass)||!db_user_match($nowuser,$nowpass)) {
		echo "<h1>无权查看此页</h1>";
		die();
	}
?>
	<form action="approve_result.php" method="post">
<?php
	$sql="select * from user";
	//echo $sql;
	$res=mysql_query($sql);
	$num=mysql_num_rows($res);
	echo "<input name='num' type='text' value='$num' style='display:none'>\n";
	$i=0;
	while ($row=mysql_fetch_array($res)) {
		echo "用户名: ".$row['user']." 电话: ".$row['phone'];
		if ($row['status']==0) echo " 通过：<input type='checkbox' name='check_$i'>";
		else echo " 通过：<input type='checkbox' checked='checked' name='check_$i'>";
		if ($row['fetion']==0) echo " 飞信：<input type='checkbox' name='fetion_$i'>";
		else echo " 飞信：<input type='checkbox' checked='checked' name='fetion_$i'>";
		echo " <input name='name_$i' type='text' value='".$row['user']."' style='display:none'> <br />\n";
		$i++;
	}
?> 
	<input type="submit" value="审批">
	</form>
	<a href="logout.php">注销</a>
<body>
</html>
