<?

if(!$_COOKIE[UserName]){
	echo("
		<script>
		window.alert('이름이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",$con);


//한글변환
mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");

$board = $_GET[board];
$id = $_GET[id];
$writer = $_COOKIE[UserName];
$topic = $_POST[topic];
$content = $_POST[content];
$hit = $_POST[hit];
$wdate = $_POST[wdate];
$space = $_POST[space];

// 답변 글은 원본 글보다 깊이가 1 증가됨
$result=mysql_query("select space from $board where id=$id", $con);
$space=mysql_result($result, 0, "space");
$space=$space+1;

$wdate=date("Y-m-d"); // 단변 글을 쓴 날짜 저장

// 답변글이 추가되면 글의 개수가 하나 증가하므로 글 번호를 정리
$tmp = mysql_query("select id from $board", $con);
$total = mysql_num_rows($tmp);

while($total >= $id):
	mysql_query("update $board set id=id+1 where id=$total", $con);
	$total--;
endwhile;

// 원래 글 번호 위치에 답변 글을 삽입함
mysql_query("insert into   $board(id, writer, topic, content, hit, wdate, space) values ($id, '$writer', '$topic','$content', 0, '$wdate',   $space)", $con);

mysql_close($con);

echo("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");

?>
