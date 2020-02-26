<?PHP

$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",$con);

		mysql_query("set session character_set_connection=utf8;");
		mysql_query("set session character_set_results=utf8;");
		mysql_query("set session character_set_client=utf8;");

$uname = $_POST[uname];
$email = $_POST[email];

$result = mysql_query("select * from member where uname='$uname' and   email='$email'", $con);
$total = mysql_num_rows($result);

if (!$total)   {
   echo("<script>
      window.alert('입력하신 이름과 이메일 주소를 동시에 만족하는 사용자 아이디가 없습니다')
      history.go(-1)
      </script>
   ");
   exit;
} else {
	$uid = mysql_result($result, 0, "uid");
    echo("<script>
        window.alert('귀하의 아이디는 $uid 입니다')
        </script>
   ");
}

mysql_close($con);	
echo   ("<meta http-equiv='Refresh' content='0; url=layout2.html'>");

?>
