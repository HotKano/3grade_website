<?php
$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",$con);

//한글변환
mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");


if (!$_COOKIE[UserID]){
	echo("
		<script>
		window.alert('로그인 후 댓글을 작성해주세요.')
		history.go(-1)
		</script>
	");
	exit;
}


$rewriter = $_COOKIE[UserName];
$id=$_GET[id];
$board=$_GET[board];
$content=$_POST[content];
$wdate = date("Y-m-d");	//   글 쓴 날짜 저장

$result=mysql_query("select reid from reply where id=$id",$con);
$total=mysql_num_rows($result);

// 댓글에 대한 id부여
if (!$total){
	$reid = 1;
} else {
	$reid = $total + 1;
}


// 테이블에 입력 글 내용을 저장
mysql_query("insert into reply(reid,rewriter,date,content,id) values($reid, '$rewriter', '$wdate', '$content' , $id)", $con);

mysql_close($con);

echo("<meta http-equiv='Refresh' content='0; url=content.php?board=$board&id=$id'>");



?>