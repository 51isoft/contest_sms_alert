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
	if (strlen($_POST['passwd'])>64||strlen($_POST['passwd'])<3) {
		echo "<h1>密码请在3-64位长度之间！</h1>";
		die();
	}
    if ($_POST['passwd']!=$_POST['repasswd']) {
        echo "<h1>两次密码不一致！</h1>";
        die();
    }
    $s = $_POST['user'];
    if (strlen($s)>64||strlen($s)<3) {
        echo "<h1>用户名请在3-64位长度之间！</h1>";
        die();
    }
    for ($i = 0; $i < strlen($s); $i++)
    if ( $s[$i] >= '0' && $s[$i] <= '9' || $s[$i] >= 'a' && $s[$i] <= 'z' || $s[$i] >= 'A' && $s[$i] <= 'Z'|| $s[i]=='-' || $s[i]=='_')
        continue;
    else break;
	if ($i != strlen($s) ) {
        echo "<h1>用户名不合法！</h1>";
        die();
    }
    if (db_user_exist($s) ) {
        echo "<h1>用户名已存在！</h1>";
        die();
    }
    $s = $_POST['phone'];
    if (strlen($s)!=11) {
        echo "<h1>电话号码不合法！</h1>";
        die();
    }
    for ($i = 0; $i < strlen($s); $i++)
    if ( $s[$i] >= '0' && $s[$i] <= '9')
        continue;
    else break;
	if ($i != strlen($s)) {
        echo "<h1>电话号码不合法！</h1>";
        die();
	}
    $s = $_POST['hours'];
    for ($i = 0; $i < strlen($s); $i++)
    if ( $s[$i] >= '0' && $s[$i] <= '9')
        continue;
    else break;
    if ($i != strlen($s)||intval($s)==0||intval($s)>24*7) {
        echo "<h1>提醒时间不合法！</h1>";
        die();
    }
    $s = $_POST['from'];
    for ($i = 0; $i < strlen($s); $i++)
    if ( $s[$i] >= '0' && $s[$i] <= '9')
        continue;
    else break;
    if ($i != strlen($s)||intval($s)>23||intval($s)<0) {
        echo "<h1>提醒时间不合法！</h1>";
        die();
    }
    $s = $_POST['to'];
    for ($i = 0; $i < strlen($s); $i++)
    if ( $s[$i] >= '0' && $s[$i] <= '9')
        continue;
    else break;
    if ($i != strlen($s)||intval($s)<1||intval($s)>24||$_POST['from']==$_POST['to']) {
        echo "<h1>提醒时间不合法！</h1>";
        die();
    }
	/*if ($_POST['verify']!="asdf1234fengsu") {
		echo "<h1>验证码错误！</h1>";
		die();
    }*/
	$sql="insert into user (user,passwd,phone,fetion,hours,`from`,`to`,status,isroot) values
	('".$_POST['user']."','".sha1(md5($_POST['passwd']))."','".$_POST['phone']."','0','".$_POST['hours']."','".$_POST['from']."','".$_POST['to']."','0','0')";
//	echo $sql;
    mysql_query($sql);
    $ojlist=mysql_query("select distinct(oj) from info");
    while ($row=mysql_fetch_array($ojlist)) {
        $oj=$row[0];
		if ($_POST["oj_".$oj]) {
			$sql="insert into uoj (user,oj) values ('".$_POST['user']."','$oj') ";
			mysql_query($sql);
		}
    }
    $typelist=mysql_query("select distinct(type) from info");
    while ($row=mysql_fetch_array($typelist)) {
        $type=$row[0];
        if ($_POST["type_".$type]) {
            $sql="insert into utype (user,type) values ('".$_POST['user']."','$type') ";
            mysql_query($sql);
        }
    }
	echo "<h1>注册成功，请等待审核。</h1>\n<a href='index.php'>点此返回主页</a>";
?> 
<body>
</html>
