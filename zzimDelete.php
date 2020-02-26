<?PHP

$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",$con);

$code=$_GET[code];

mysql_query("delete from zzim where uid='$_COOKIE[UserID]' && code='$code'",$con);


echo("
	<script>
	window.alert('찜 취소 되었습니다.');
	</script>
");

// 삭제된 글보다 글 번호가 큰 게시물은 글 번호를 1씩 감소
$tmp = mysql_query("select id from zzim where uid='$_COOKIE[UserID]' order by id desc", $con);
$last = mysql_result($tmp, 0, "id");     // 가장 마지막 글 번호 추출

$i = $id + 1;       // 삭제된 글의 번호보다 1이 큰 글 번호부터 변경
while($i <= $last):
	mysql_query("update zzim set id=id-1 where uid='$_COOKIE[UserID]' && id=$i", $con);
	$i++;
endwhile;

// 글 삭제 결과를 보여주기 위한 글 목록 보기 프로그램 호출
echo("<meta http-equiv='Refresh' content='0; url=mypage.php'>");

mysql_close($con);

?>