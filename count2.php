<?PHP
//����Ÿ���̽��� ����

$con = mysql_connect("localhost", "dpsw23", "dbfak333");
mysql_select_db("dpsw23", $con);

$result = mysql_query ("select *from counter", $con);
$total = mysql_num_rows ($result);

$today = date ("Ymd");
$today = "test";



if ($total ==0) { //ī���� ���� ���� ���ڵ尡 �������� �ʴ� ���
	$todaycount = 0;
	$totalcount = 0;
	$lastlogin = $today;
	
	mysql_query("insert into counter values ($todaycount, $totalcount, '$lastlogin')", $con);

}else { //�� �ʵ忡 �ش��ϴ� �����͸� �̾� ���� ����
	$todaycount = mysql_result($result, 0, "today");
	$totalcount = mysql_result($result, 0, "total");
	$lastlogin = mysql_result($result, 0, "lastlogin");
	
}

if ($lastlogin == $today){

    if (!$_COOKIE[counter_cookie]) { //���ο� �湮���� ���

        if ($lastlogin == $today) $todaycount = $todaycount +1;
        else $todaycount =1;

        $totalcount = $totalcount +1;

        mysql_query ("update counter set today = $todaycount, total = $totalcount, lastlogin = '$today'", $con);
        
        echo "test";

    } else {
        echo "test2";
    }


} else {

    if ($lastlogin == $today) $todaycount = $todaycount +1;
    else $todaycount = 1;

    $totalcount = $totalcount +1;

    mysql_query ("update counter set today = $todaycount, total = $totalcount, lastlogin = '$today'", $con);

}

//���� �湮�� ���� ��ü �湮�� ���� ȭ�� ���÷���

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