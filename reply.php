<?php



$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",$con);

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");
mysql_query("ALTER TABLE reply ORDER BY reid");

$id = $_GET[id];
$rewriter = $_COOKIE[UserName];
$board=$_GET[board];

$reply_result=mysql_query("select *from reply where id=$id",$con);
$total = mysql_num_rows($reply_result);

echo "<table bgcolor=white border=0>";

for($i =0; $i<$total; $i++){
	echo "<tr height='100'>";

	$rewriter=mysql_result($reply_result,$i,"rewriter");
	$content=mysql_result($reply_result,$i,"content");
	$date=mysql_result($reply_result,$i,"date");
	$reid=mysql_result($reply_result,$i,"reid");

	echo "<td width='200' height='100' align=center> <b> $rewriter </b> </td>";
	echo "<td width='500' height='100'> $content </td>";
	echo "<td width='100' height='100'> $date </td>";

	
	
	if($_COOKIE[UserName] == $rewriter || $_COOKIE[UserID]=='admin')
	echo "<td width='100'> <a href=reply_delete.php?board=$board&reid=$reid&id=$id> [삭제]</a> </td>";
	
	echo "</tr>";
	echo "<tr> <td td colspan=5> <hr size=0   color=#eeeeee width=100%> </td> </tr>";
	
}

echo "</table>";


/*
echo("
<table>

<tr>
	<td>$id</td> 
	<td><textarea name=test row=12 cols=60 style='resize:none;'></textarea></td> 
	<td><input type = submit value=test id=testzone></td> 

</tr>

</table>
");
*/




















?>