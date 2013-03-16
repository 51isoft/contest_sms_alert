<?php
	require 'conn.php';
	require 'PHPFetion.php';
//	include('pafetion1.5.php');
function sendsms($mobile,$content)
{
 $user_id = '0000'; // sms9平台用户id
 $pass = 'password'; // 用户密码
 $channelid = '0000'; // 发送频道id
 
 if(!$mobile || !$content || !$user_id || !$pass || !$channelid) return false;
 
 if(is_array($mobile)) $mobile = implode(",",$mobile);
 
 $content = iconv("utf-8","gbk//ignore",$content);
 $content = urlencode($content);
 
 $api = "http://admin.sms9.net/houtai/sms.php?cpid={$user_id}&password={$pass}&channelid={$channelid}&tele={$mobile}&msg={$content}";
 $res = file_get_contents($api);
 return strpos($res,'success') === false ? $res : true;
}


function fetionsend($mobile,$content) {
    $ret = file_get_contents('http://quanapi.sinaapp.com/fetion.php?u=13800138000&p=000000&to='.$mobile.'&m='.urlencode($content));
    $retArray = json_decode($ret, true);
    if ($retArray["result"]==0) return true;
    return false;
}


	$sql="select queue.*,user.from,user.to from queue,user where sent=0 and unix_timestamp(time) +60*60 > unix_timestamp(now()) and  unix_timestamp(time) < unix_timestamp(now())+5*60 and user.user=queue.user";
	$res=mysql_query($sql);
	$cuh=date("H",time());
	while ($row=mysql_fetch_array($res)) {
		$from=$row['from'];
		$to=$row['to'];
		if ($from<$to) {
			if ($cuh<$from||$cuh>=$to) continue;
		}
		else {
            if ($cuh>=$to&&$cuh<$from) continue;
        }
		$phone=$row['phone'];
		$msg=$row['message'];
		$id=$row['id'];
		echo "id: $id, phone: $phone  ";
		$usql="update queue set sent=1 where id=$id";
	    if ($row['fetion']==1) {
            //$fetion->send($phone, $msg);
            /*if ($needlogin) {
                $fection->login();i
                $needlogin=false;
            }*/
            //$fection->send($phone, $msg);
			if (fetionsend($phone,$msg)===true) {
				mysql_query($usql);
				echo "Sent.\n";
			}
			//else echo "Failed.\n";
		}
		else {
			if (sendsms($phone,$msg)===true) {
				mysql_query($usql);
				echo "Sent.\n";
			}
			else echo "Failed.\n";
		}
	}
//	$fection->logout();
?>
