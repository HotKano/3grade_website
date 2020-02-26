<?PHP

$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",$con);

$id = $_GET[id];
$board = $_GET[board];
$reid = $_GET[reid];
$mode = $_GET[mode];

mysql_query("delete from reply where reid=$reid and id=$id",$con);

echo("
	<script>
	window.alert('댓글이 삭제 되었습니다.');
	</script>
");

$tmp = mysql_query("select reid from reply where id=$id order by reid desc", $con);
$last = mysql_result($tmp, 0, "reid");     // 가장 마지막 글 번호 추출

$i = $reid+1;      
while($i <= $last) : // 삭제된 글의 번호보다 1이 큰 글 번호부터 변경
mysql_query("update reply set reid=reid-1 where reid=$i and id=$id", $con);
$i++;
endwhile;

mysql_query("ALTER TABLE reply ORDER BY reid DESC");

mysql_close($con);

// 글 삭제 결과를 보여주기 위한 글 목록 보기 프로그램 호출
echo("<meta http-equiv='Refresh' content='0; url=content.php?board=$board&id=$id'>");

?>

</td></tr>
</table>
