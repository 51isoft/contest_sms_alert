<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <META HTTP-EQUIV="pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
    <title>北京师范大学ACM/ICPC比赛短信提醒平台</title>
</head>
<body>
<?php
	include("conn.php");
    if (!db_user_match($nowuser,$nowpass)) {
        echo "<h1>无权访问！</h1>";
        die();
    }
	echo "<h2>Hello, $nowuser!</h2>";
	if (db_user_isroot($nowuser)) {
		echo "<a href='approve.php' target='_blank'>[审核页面]</a> ";
	}
	echo "<a href='modify.php?user=$nowuser' target='_blank'>[修改订阅]</a> ";
    echo "<a href='list.php?user=$nowuser' target='_blank'>[管理未发送短信列表]</a> ";
	echo "<a href='logout.php'>[注销]</a> ";
?>
</body>
</html>
