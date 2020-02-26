<?php


$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",$con);

$user = $_GET[user];

		mysql_query("set session character_set_connection=utf8;");
		mysql_query("set session character_set_results=utf8;");
		mysql_query("set session character_set_client=utf8;");

		
mysql_query("delete from member where uid='$user'",$con);

echo("
	<script>
	window.alert('회원 탈퇴 처리가 완료되었습니다.');
	</script>
");



echo("<meta http-equiv='Refresh' content='0; url=admin.html'>");

mysql_close($con);

?>