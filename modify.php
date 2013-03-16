<?php
	require "conn.php";
	$user=$_GET['user'];
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<META HTTP-EQUIV="pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
	<title>北京师范大学ACM/ICPC比赛短信提醒平台修改信息</title>
</head>
<body>
<?php
	if (!db_user_match($nowuser,$nowpass)||$nowuser!=$user) {
		echo "<h1>无权修改！</h1>";
		die();
	}
	$sql="select * from user where user='$user'";
	$res=mysql_query($sql);
	$row=mysql_fetch_array($res);
?>
	<form id="modform" action="modify_result.php?user=<?php echo $user; ?>" method="post">
		<table style="width:1000px">
			<tr>
				<th colspan="2">请填写信息</th>
			</tr>
			<tr>
				<th style="width:170px">用户名：</th><td><?php echo $user; ?></td>
			</tr>
<!--            <tr>
                <th>密码：</th><td><input type="password" name="passwd"></td>
            </tr>
            <tr>
                <th>确认密码：</th><td><input type="password" name="repasswd"></td>
            </tr>-->
            <tr>
                <th>手机：</th><td><? echo $row['phone']; ?></td>
            </tr>
			<tr>
				<th>关注OJ：</th>
				<td>
<?php
    $ojlist=mysql_query("select distinct(oj) from info");
    while ($row=mysql_fetch_array($ojlist)) {
        $oj=$row[0];
		$num=mysql_num_rows(mysql_query("select * from uoj where oj='$oj' and user='$user'"));
		if ($num==0) echo "<input type='checkbox' name='oj_$oj'>$oj \n";
		else echo "<input type='checkbox' checked='checked' name='oj_$oj'>$oj \n";
	}
?>
				</td>
			</tr>
			<tr>
				<th>关注类型：</th>
				<td>
<?php
    $typelist=mysql_query("select distinct(type) from info");
    while ($row=mysql_fetch_array($typelist)) {
        $type=$row[0];
        $num=mysql_num_rows(mysql_query("select * from utype where `type`='$type' and user='$user'"));
		if ($num==0) echo "<input type='checkbox' name='type_$type'>$type \n";
		else echo "<input type='checkbox' checked='checked' name='type_$type'>$type \n";
    }
?> 
				</td>
			</tr>
            <tr>
                <th>比赛前：</th><td><input type="text" name="hours" style="width:50px" value='5'>小时提醒（1-7*24小时）</td>
            </tr>
            <tr>
                <th>最早：</th><td><input type="text" name="from" style="width:50px" value='12'>点提醒（0-23）</td>
            </tr>
            <tr>
                <th>最晚：</th><td><input type="text" name="to" style="width:50px" value='24'>点提醒（1-24）</td>
            </tr>
			<tr>
				<th colspan='2'>（如果最早时间晚于最晚，则认定为跨0点。如果提前的时间落不到该区间，则会提前到最晚的合适时间。）</th>
			</tr>
            <tr>
                <th colspan="2"><input type="Submit" value="修改"><input type="Reset" value="重置"></th>
            </tr>
		</table>
	</form>
<body>
</html>
