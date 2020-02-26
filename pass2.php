<?PHP include ("top.html"); ?>

<table border='1' width='900'>
<tr height='600'>
<td width='180' valign='top'><?PHP include ("left.html"); ?></td>
<td width='720' align='center' valign='top'>

<?PHP

$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",$con);

$board = $_GET[board];
$id = $_GET[id];
$mode = $_GET[mode];
$pass = $_POST[pass];

$result=mysql_query("select passwd from $board where id=$id",$con);
$passwd=mysql_result($result,0,"passwd");



echo $board;
echo $id;
echo $mode;
echo $pass;


if ($pass != $passwd) {            // 암호가 일치하지 않는 경우
	echo   ("<script>
		window.alert('입력 암호가 일치하지 않네요');
		history.go(-1);
		</script>");
	exit;		
} else {                  // 암호가 일치하는 경우
    switch ($mode) {
        case 0:          // 수정 프로그램 호출
            echo("<meta   http-equiv='Refresh' content='0; url=modify.php?board=$board&id=$id'>");
            break;
        case 1:          // 삭제 프로그램 호출
            echo("<meta   http-equiv='Refresh' content='0; url=delete.php?board=$board&id=$id'>");
            break;
    }   	   
}  

mysql_close($con);

?>

</td></tr>
</table>
<?PHP include ("bottom.html");   ?>
