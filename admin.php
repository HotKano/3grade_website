<?PHP

if ($_COOKIE[UserID] != 'admin') {
	echo ("<script>
		window.alert('관리자만 접근 가능한 기능입니다')
		history.go(-1)
		</script>");
    exit;
} 

$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",   $con);

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");

	
$result = mysql_query("select * from member order by uname", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=0 width=690>
    <tr><td align=center><font size=3><b>[회원 목록 조회]</b></td></tr>
	<tr><td align=right><font size=2><a href=admin.html> <button>목록</button> </a></td>
	</tr></table> ");
	   
$i = 0;	

echo ("
	<table border=1 width=690 bgcolor=white>
	<tr height=35>
	<td align=center width=60 bgcolor=#eeeeee><font size=2><b>ID</b></td>
	<td align=center width=60 bgcolor=#eeeeee><font   size=2><b>이름</b></td>
	<td align=center width=400 bgcolor=#eeeeee><font size=2><b>주소</b></td>
	<td align=center width=100 bgcolor=#eeeeee><font size=2><b>전화번호</b></td>
	<td align=center width=100 bgcolor=#eeeeee><font size=2><b>이메일</b></td>
	<td align=center width=40 bgcolor=#eeeeee><font size=2><b>승인상태</b></td>
	<td align=center width=40 bgcolor=#eeeeee><font size=2><b>탈퇴처리</b></td></tr>
");	

while($i < $total):
	$uid = mysql_result($result, $i, "UID");
	$uname = mysql_result($result, $i, "UNAME");
	$zip = mysql_result($result, $i, "ZIPCODE");
	$addr1 = mysql_result($result, $i, "ADDR1");
	$addr2 = mysql_result($result, $i, "ADDR2");
	$mphone = mysql_result($result, $i, "MPHONE");
	$email = mysql_result($result, $i, "EMAIL");
	$approved = mysql_result($result, $i, "APPROVED");

	$address = "(" . $zip .   ")" . "&nbsp;" . $addr1 . "&nbsp;" .   $addr2;
	
    echo ("<tr height=30><td align=center><font size=2>$uid</td>
		<td align=center><font size=2>$uname</td>
		<td><font size=2>$address</td>
		<td align=center><font size=2>$mphone</td>
		<td align=center><font size=2>$email</td>");
		
	if ($approved == 0) {
		echo ("<td align=center><a href=memberchange.php?uid=$uid><font size=2 color=red>대기</a></td>");
	} else {
		echo ("<td align=center><a href=memberchange.php?uid=$uid><font size=2 color=blue>완료</a></td>");
	}

	echo "<td align=center><a href=memberOut.php?user=$uid><font size=2 color=red>탈퇴처리</td></tr>";
	      
	$i++;
endwhile;



echo ("</table>");
mysql_close($con);

?>