<?php
	require "conn.php";
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<META HTTP-EQUIV="pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
	<title>北京师范大学ACM/ICPC比赛短信提醒平台</title>
</head>
<body>
	<form id="loginform" action="login.php" method="post">
		<table style="width:400px">
			<tr>
				<th colspan="2">比赛短信提醒平台登陆</th>
			</tr>
			<tr>
				<th style="width:170px">用户名：</th><td><input type="text" name="user"></td>
			</tr>
            <tr>
                <th>密码：</th><td><input type="password" name="passwd"></td>
            </tr>
            <tr>
                <th colspan="2"><input type="Submit" value="登陆"><input type="Reset" value="重置"><a href="register.php">注册</a></th>
            </tr>
		</table>
	</form>
<body>
</html>
