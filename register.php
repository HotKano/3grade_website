<?PHP

$uname = $_POST[uname];

if (!$_POST[uid]) {
	echo ("<script>
		window.alert('사용자 ID를 입력하세요');
		history.go(-1);
		</script>");
	exit;
}
if (!$_POST[upass1]) {
	echo ("<script>
		window.alert('비밀번호를 입력해 주세요');
		history.go(-1);
		</script>");
	exit;
}
if ($_POST[upass1] != $_POST[upass2]) {
	echo ("<script>
		window.alert('비밀번호와 비밀번호 확인이 일치하지 않습니다');
		history.go(-1);
		</script>");
	exit;
}
if (!$_POST[uname]) {
	echo ("<script>
		window.alert('이름을 입력해 주세요');
		history.go(-1);
		</script>");
	exit;
}

if(mb_strlen($uname, 'UTF-8')>5){

	echo ("<script>
		window.alert('이름은 최대 4글자까지 가능합니다.');
		history.go(-1);
		</script>");
		exit;
}
	
$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23", $con);

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");
	
$result = mysql_query("insert into member(uid, upass,uname, mphone, email, zipcode, addr1, addr2, approved) values ('$_POST[uid]', '$_POST[upass1]', '$_POST[uname]', '$_POST[mphone]', '$_POST[email]', '$_POST[zip]', '$_POST[addr1]', '$_POST[addr2]', 0)", $con);
	
if ($result) {
    echo ("<script>
		window.alert('COMMA Online Bookstore 회원 가입을 축하드립니다.\\n관리자의 승인을 거쳐야 로그인이 가능합니다');
		history.go(1);
		</script>
   ");
} else {
    echo ("<script>
		window.alert('회원가입에 실패했습니다. 다시 한 번 시도해 주세요');
		history.go(-1);
		</script>
	");	   
}
	
mysql_close($con);
echo   ("<meta http-equiv='Refresh' content='0; url=index.html'>");
	
?>
