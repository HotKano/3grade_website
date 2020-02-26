<?PHP
$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",$con);
	

		mysql_query("set session character_set_connection=utf8;");
		mysql_query("set session character_set_results=utf8;");
		mysql_query("set session character_set_client=utf8;");


$result = mysql_query("select * from member where uid='$_POST[uid]'", $con);
$total = mysql_num_rows($result);

if (!$total){
	echo("<script>
		window.alert('아이디가 존재하지 않습니다')
		history.go(-1)
		</script> ");
	 exit;
} else {

	$pass = mysql_result($result, 0, "upass");
	$uname = mysql_result($result, 0, "uname");
	$approved = mysql_result($result, 0, "approved");

	if ($approved == 0) {
		echo("<script>
				window.alert('관리자의 회원 승인이 완료되지 않았습니다')
				history.go(-1)
				</script> ");
		exit;
	} 
	if ($pass != $_POST[upass]) {
		echo("<script>
			window.alert('비밀번호가 맞지 않습니다')
			history.go(-1)
			</script> ");
		exit;
	} else {

	
		

		SetCookie("UserID", "$_POST[uid]", 0);
		SetCookie("UserName", "$uname", 0);
		 
		 //$session = md5(uniqid(rand()));
		 //SetCookie("Session", $session, 0);
				
		 //mysql_query("delete from shoppingbag where id='$uid'", $con);
			 
		echo ("<meta http-equiv='Refresh' content='0; url=layout2.html'>"); 
	}
}
mysql_close($con);
?>