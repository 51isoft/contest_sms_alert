<?php
	require "conn.php";
    $user=$_GET['user'];
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<META HTTP-EQUIV="pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
	<title>北京师范大学ACM/ICPC比赛短信提醒平台信息修改结果</title>
</head>
<body>
<?php
/*	if (strlen($_POST['passwd'])>64||strlen($_POST['passwd'])<3) {
		echo "<h1>密码请在3-64位长度之间！</h1>";
		die();
	}
    if ($_POST['passwd']!=$_POST['repasswd']) {
        echo "<h1>两次密码不一致！</h1>";
        die();
    }*/
    if (!db_user_match($nowuser,$nowpass)||$nowuser!=$user) {
        echo "<h1>无权修改！</h1>";
        die();
    }
/*    $s = $_POST['phone'];
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
	}*/
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
	$sql="update user set set hours='".$_POST['hours']."',`from`='".$_POST['from']."',`to`='".$_POST['to']."',status='0' 
		where user='$user'";
//	echo $sql;
	mysql_query($sql);
    $ojlist=mysql_query("select distinct(oj) from info");
    while ($row=mysql_fetch_array($ojlist)) {
        $oj=$row[0];
		if ($_POST["oj_".$oj]) {
			$num=mysql_num_rows(mysql_query("select * from uoj where oj='$oj' and user='$user'"));
			if ($num==0) {
				$sql="insert into uoj (user,oj) values ('".$user."','$oj') ";
				mysql_query($sql);
			}
		}
		else {
			$sql="delete from uoj where user='$user' and oj='$oj'";
			mysql_query($sql);
		}
	}
    $typelist=mysql_query("select distinct(type) from info");
    while ($row=mysql_fetch_array($typelist)) {
        $type=$row[0];
        if ($_POST["type_".$type]) {
			$num=mysql_num_rows(mysql_query("select * from utype where `type`='$type' and user='$user'"));
            if ($num==0) {
				$sql="insert into utype (user,type) values ('".$user."','$type') ";
	            mysql_query($sql);
			}
        }
		else {
            $sql="delete from utype where user='$user' and `type`='$type'";
            mysql_query($sql);
		}
    }
	echo "<h1>注册成功</h1>\n<a href='index.php'>点此返回主页</a>";
?> 
<body>
</html>
