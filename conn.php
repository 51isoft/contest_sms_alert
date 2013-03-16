<?php
	function db_connect() {
		$con = mysql_connect("127.0.0.1","user","pass");
		mysql_query('SET NAMES "utf8"',$con);
		if (!$con) 	return false;
		$sql = mysql_select_db("contest_sms",$con);
		if (!$sql) return false;
	}
    function db_user_exist($username) {
        $result = mysql_query("select user from user where user = '$username'");
        $row = @mysql_num_rows($result);
        if ($row==1) return true;
        else return false;
    }
    function db_user_isroot($username) {
        if (!db_user_exist($username)) return false;
        $result = mysql_query("select isroot from user where user = '$username'");
        $row = mysql_fetch_array($result);
        if ($row[0]==1) return true;
        else return false;
    }
    function db_user_match($user, $password) {
        //if ($user==""||$password="") return false;
        $result = mysql_query("select * from user where user = '$user' and passwd='$password'");
        $row = @mysql_num_rows($result);
        if ($row == 1) return true;
        else return false;
    }
	db_connect();
    if (!$_COOKIE["user"]||!$_COOKIE["password"]) {
        $nowuser="";
        $nowpass="";
    }
    else {
        $nowuser=$_COOKIE["user"];
        $nowpass=$_COOKIE["password"];
    }
?>
