<?PHP
//데이타베이스에 연결

$con = mysql_connect("localhost", "dpsw23", "dbfak333");
mysql_select_db("dpsw23", $con);

$result = mysql_query ("select *from counter", $con);
$total = mysql_num_rows ($result);

$today = date ("Ymd");



if ($total ==0) { //카운터 값을 담을 레코드가 존재하지 않는 경우
	$todaycount = 0;
	$totalcount = 0;
	$lastlogin = $today;
	
	mysql_query("insert into counter values ($todaycount, $totalcount, '$lastlogin')", $con);

}else { //각 필드에 해당하는 데이터를 뽑아 내는 과정
	$todaycount = mysql_result($result, 0, "today");
	$totalcount = mysql_result($result, 0, "total");
	$lastlogin = mysql_result($result, 0, "lastlogin");
	
}

if ($lastlogin == $today){

if (!$_COOKIE[counter_cookie]) { //새로운 방문자일 경우

if ($lastlogin == $today) $todaycount = $todaycount +1;
else $todaycount =1;

$totalcount = $totalcount +1;



mysql_query ("update counter set today = $todaycount, total = $totalcount, lastlogin = '$today'", $con);

} 


} else {

if ($lastlogin == $today) $todaycount = $todaycount +1;
else $todaycount =1;

$totalcount = $totalcount +1;

mysql_query ("update counter set today = $todaycount, total = $totalcount, lastlogin = '$today'", $con);

}

//오늘 방문자 수와 전체 방문자 수를 화면 디스플레이

echo("<head>
	<style>

		p {
			font-size : 10px;
			background-color: #808080;
			color : white;
			width: 195px;

		}

	</style>
	</head>");

echo ("<body>");
echo "<p> TODAY = $todaycount, TOTAL = $totalcount </p>";
echo ("</body>");

mysql_close ($con);

?>