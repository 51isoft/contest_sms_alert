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
	$username=mysql_escape_string($_POST['user']);
	$password=sha1(md5($_POST['passwd']));
    if (!db_user_exist($username)) {
		echo "<script language='javascript'>";
		echo "alert('无此用户！');";
		echo "history.back(1);";
		echo "</script>";
	}
	else if (!db_user_match($username,$password)) {
		echo "<script language='javascript'>";
		echo "alert('密码错误！');";
		echo "history.back(1);";
		echo "</script>";
	}
	else {
		setcookie('user',$username,0);
		setcookie('password',$password,0);
		echo "<h1>登陆成功！</h1>";
		echo "<a href='home.php'>[前往我的页面]</a>";
	}
?>
</body>
</html>
