<script   language='JavaScript'>
	function   okzip(zip, address) {
		opener.document.comma.zip.value = zip;
		opener.document.comma.addr1.value =   address;
		opener.comma.addr2.value='';
		opener.comma.addr2.focus();
		self.close();
	}
</script>

<?PHP
$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",   $con);
	
mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");

$result = mysql_query("select * from zipcode where dong like '%$_POST[key]%'", $con);
$total = mysql_num_rows($result);
	  	
$i = 0;
	
echo ("
	<center>
	<font size=2>[<b>$_POST[key]</b>]으로 검색한 결과입니다. 우편번호를 선택하세요
	<table border=1 align=center width=420 height=130 cellpadding=3 cellspacing=0>
");
	
while($i <   $total):
	$zip = mysql_result($result, $i, "ZIPCODE");
	$sido = mysql_result($result, $i, "SIDO");
	$gugun = mysql_result($result, $i, "GUGUN");
	$dong = mysql_result($result, $i, "DONG");
	$bunji = mysql_result($result, $i, "BUNJI");

	$address = $sido . " " . $gugun   . " " .  $dong;

	echo ("<tr><td><font size=2>&nbsp;<a href=\"javascript: okzip('$zip',   '$address')\">$zip</a>&nbsp;&nbsp;&nbsp;&nbsp;$sido   $gugun $dong $bunji </td></tr>");
			  
	$i++;
endwhile;

echo ("</table>");
mysql_close($con);

?>
