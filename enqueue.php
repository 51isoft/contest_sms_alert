<?php
	function get_week($str) {
		if ($str=="MON") return "一";
        if ($str=="TUE") return "二";
        if ($str=="WED") return "三";
        if ($str=="THU") return "四";
        if ($str=="FRI") return "五";
        if ($str=="SAT") return "六";
        if ($str=="SUN") return "日";
	}
	require "conn.php";
/*	$stime=strtotime("2013-12-16 12:00:00");
	echo intval(date("H",$stime));
	$stime-=60*60;
	echo intval(date("H",$stime));
	die();*/
	$sql="select * from info where start>now()";
	$res=mysql_query($sql);
	while ($row=mysql_fetch_array($res)) {
		$getusql="select distinct(uoj.user),user.hours,user.phone,user.fetion,user.`from`,user.`to` from uoj,utype,user where oj='".$row['oj']."' and `type`='".$row['type']."' and uoj.user=utype.user and uoj.user=user.user and user.status=1";
//		echo $getusql;
		$getures=mysql_query($getusql);
		while ($urow=mysql_fetch_array($getures)) {
			if (mysql_num_rows(mysql_query("select * from fetched where user='".$urow[0]."' and id=".$row['id']." and version=".$row['version']))==0) {
				$isql="insert into fetched (user,id,version) values ('".$urow[0]."',".$row['id'].",".$row['version'].") ";
				mysql_query($isql);
				if ($row['version']==0) $content=$row['oj']."上的比赛：".$row['title']."（".$row['type']."）将于".$row['start']."（周".get_week($row['dow'])."）举行。";
				else $content=$row['oj']."上的比赛：".$row['title']."（".$row['type']."）调整于".$row['start']."（周".get_week($row['dow'])."）举行。";
				$content=mysql_real_escape_string($content);
				$stime=strtotime($row['start'])-$urow[1]*60*60;
				$from=$urow[4];$to=$urow[5];
				while (true) {
					$cuh=intval(date("H",$stime));
					if ($from<$to) {
						if ($cuh>=$from&&$cuh<$to) break;
					}
					else {
						if ($cuh>=$from||$cuh<$to) break;
					}
					$stime-=60*60;
				}
				$stime=date("Y-m-d H:i:s",$stime);
				$isql="insert into queue (user,message,time,phone,fetion) values ('".$urow[0]."','$content','$stime','".$urow[2]."','".$urow[3]."') ";
				echo $isql."\n";
                mysql_query($isql);
			}
		}
	}
?> 

