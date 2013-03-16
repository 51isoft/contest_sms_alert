<?php
	require "conn.php";
	$user=$_GET['user'];
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<META HTTP-EQUIV="pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
	<title>北京师范大学ACM/ICPC比赛短信提醒平台短信管理</title>
	<style type="text/css"> 
* {
    font-size: 0.9em;
}
table {
	border-collapse:collapse;
}
td,th {
	border:1px solid;
}
	</style>
</head>
<body>
<?php
	if (!db_user_match($nowuser,$nowpass)||$nowuser!=$user) {
		echo "<h1>无权修改！</h1>";
		die();
	}
	$sql="select * from queue where user='$user' and sent=0 order by time";
	$res=mysql_query($sql);
	$num=mysql_num_rows($res);
?>
	<form action="list_manage.php?user=<?php echo $user; ?>" method="post">
		<table style="width:1000px;">
			<thead>
				<tr>
					<th style="width:650px">信息内容</th>
                    <th style="width:110px">接收号码</th>
                    <th style="width:180px">预计发送时间</th>
                    <th style="width:60px">删除？</th>
					<th style="display:none">ID</th>
				</tr>
			</thead>
			<tbody>
<?php
	$i=0;
	while ($row=mysql_fetch_array($res)) {
		echo "<tr>\n";
		echo "<td>".$row['message']."</td>\n";
        echo "<td>".$row['phone']."</td>\n";
        echo "<td>".$row['time']."</td>\n";
		echo "<td><input type='checkbox' name='check_$i'></td>\n";
        echo "<td style='display:none'>"."<input type='text' value='".$row['id']."' name='id_$i'>"."</td>\n";
		echo "</tr>\n";
		$i++;
	}
?>
			</tbody>
		</table>
		共计：<?php echo $num; ?>条 <input type='text' value='<?php echo $num; ?>' name='total' style="display:none">
		<input type="submit" value="提交">
	</form>
<body>
</html>
