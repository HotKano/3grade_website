<?PHP

$kind = $_POST[kind];
$code = $_GET[code];
$name = $_POST[name];
$content = $_POST[content];
$writer = $_POST[writer];
$drawer = $_POST[drawer];


if (!$name){
	echo("
		<script>
		window.alert('상품명이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$writer){
	echo("
		<script>
		window.alert('작가가 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",$con);

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");
	
// 기존 상품 이미지를 그대로 사용하는 경우
if (!$_FILES['file']['name']){
	$result = mysql_query("update product set kind=$kind, name='$name', content='$content', writer='$writer', drawer='$drawer' where code='$code'", $con);
	
} else {

     // 기존 상품 이미지 파일을 삭제
	$tmp = mysql_query("select userfile from product where code='$code'", $con);
	$fname = mysql_result($tmp, 0, "userfile");
    $savedir = "./save";
	unlink("$savedir/$fname");
	
    // 새로이 첨부한 이미지 파일을 저장	
    $temp = $_FILES['file']['name'];
    if (file_exists("$savedir/$temp")) {
         echo (" 
             <script>
             window.alert('동일한 화일 이름이 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
			$dir = "./save/";
			$file_hash = $_FILES['file']['name'];
			$upfile = $dir.$file_hash;
		 
			if(is_uploaded_file($_FILES['file']['tmp_name']))
			{
					if(!move_uploaded_file($_FILES['file']['tmp_name'], $upfile))
					{
							echo "upload error";
							exit;
					}
			}
			
			@ $db = new mysqli('localhost', 'dpsw23', 'dbfak333', 'dpsw23');
			if(mysqli_connect_errno())
			{
				echo "DB error";
				exit;
			}
         @unlink($_FILES['file']['name']);
    }
	$result = mysql_query("update product set kind=$kind, name='$name', content='$content', writer='$writer', drawer='$drawer', userfile='$temp' where code='$code'", $con);
}

if (!$result) {
	echo("
      <script>
      window.alert('상품 수정에 실패했습니다')
      </script>
    ");
    exit;
} else {
	echo("
      <script>
      window.alert('상품 수정이 완료되었습니다')
      </script>
   ");
} 

mysql_close($con);		//데이터베이스 연결해제

echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>
