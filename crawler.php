<?php
include('conn.php');
function status($oj,$title,$start,$dow,$type,$src) {
    $src=mysql_real_escape_string($src);
    $title=mysql_real_escape_string($title);
    $start=mysql_real_escape_string($start);
    $dow=mysql_real_escape_string($dow);
    $type=mysql_real_escape_string($type);
	$sql="select * from info where oj='$oj' and title='$title'";
	$res=mysql_query($sql);
	if (mysql_num_rows($res)==0) return 0;
	else {
		$row=mysql_fetch_array($res);
//		echo $title.$start.$row['start'].$type.$row['type']."<br>\n";
		if (/*$title!=$row['title']||*/trim($start)!=trim($row['start'])) return 1;
		else return 2;
	}
}
function insert($oj,$title,$start,$dow,$type,$src) {
	$src=mysql_real_escape_string($src);
    $title=mysql_real_escape_string($title);
    $start=mysql_real_escape_string($start);
    $dow=mysql_real_escape_string($dow);
    $type=mysql_real_escape_string($type);
	$sql="insert into info (oj,title,start,dow,type,src) values ('$oj','$title','$start','$dow','$type','$src') ";
    $res=mysql_query($sql);
}
function update($oj,$title,$start,$dow,$type,$src) {
    $src=mysql_real_escape_string($src);
    $title=mysql_real_escape_string($title);
    $start=mysql_real_escape_string($start);
    $dow=mysql_real_escape_string($dow);
    $type=mysql_real_escape_string($type);
    $sql="update info set title='$title', start='$start', dow='$dow', type='$type', version=version+1 where oj='$oj' and title='$title'";
//	echo $sql."<br>";
    $res=mysql_query($sql);
}


include('simple_html_dom.php');
$cnt[0]=$cnt[1]=0;
$resrow=json_decode(file_get_contents('http://contests.acmicpc.info/contests.json'),true);
$updt=array();
foreach ($resrow as $row) {
    $oj=$row['oj'];
	$title=$row['name'];
	$src=htmlspecialchars_decode($row['link']);
    if ($updt[$title]==true) continue;
    $start=$row['start_time'];
    $dow=$row['week'];
    $type=$row['access'];
	if ($type=="") $type="Public";
	echo $oj." ".$title." ".$start." ".$dow." ".$type." ".$src."<br />\n";
    $code=status($oj,$title,$start,$dow,$type,$src);
    $updt[$title]=true;
	$cnt[$code]++;
	if ($code==0) insert($oj,$title,$start,$dow,$type,$src);
	else if ($code==1) update($oj,$title,$start,$dow,$type,$src);
}
echo "Done. Updated $cnt[1], Added $cnt[0].";
?>
