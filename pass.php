<?PHP include ("top.html"); ?>

<table border='1' width='900'>
<tr height='600'>
<td width='180' valign='top'><?PHP include ("left.html"); ?></td>
<td width='720' align='center' valign='top'>

<?PHP

$board = $_GET[board];
$id = $_GET[id];
$mode = $_GET[mode];

echo("
<HTML html>
<body>
   <form method='post'   action='pass2.php?board=$board&id=$id&mode=$mode'>
   <table border='0' width='400' align='center'>
   <tr><td align='center'>암호를 입력하세요</td></tr>
   <tr><td align='center'>암호: <input type='password' size='15' name='pass'>
   <input type='submit' value='입력'></td></tr>
   </form>
   </table>
</body>
</HTML>
");
?>


</td></tr>
</table>
<?PHP include ("bottom.html");   ?>
