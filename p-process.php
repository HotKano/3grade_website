<?php


$kind = $_POST[kind];
$code = $_POST[code];
$name = $_POST[name];
$content = $_POST[content];
$writer = $_POST[writer];
$drawer = $_POST[drawer];
$hit = $_POST[hit];

if (!$code){
	echo("
		<script>
		window.alert('상품코드명이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

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
		window.alert('글쓴이가 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}
 
    if(!$_FILES['file']['name'])
    {
        echo "<script>alert('업로드 할 파일이 입력되지 않았습니다.');";
        echo "history.back();</script>";
        exit;
    }
    
    if(strlen($_FILES['file']['name']) > 255)
    {
        echo "<script>alert('파일 이름이 너무 깁니다.');";
        echo "history.back();</script>";
        exit;
    }
    
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
	
	$query1 = "set session character_set_connection=utf8;";
	$query2 = "set session character_set_results=utf8;";
	$query3 = "set session character_set_client=utf8;";

	$db -> query($query1);
	$db -> query($query2);
	$db -> query($query3);

	$sql = "select id from product";

	$result=mysqli_query($db,$sql);
	$rowcount = mysqli_num_rows($result);

	if(!$rowcount){
		$id=1;
	} else {
		$id = $rowcount + 1;
	}
    
    $query = "insert into product(id, kind, code, name, content, writer, drawer, userfile, hit) values ($id, $kind, '$code', '$name', '$content', '$writer', '$drawer', '$file_hash', 0)";
    $result = $db->query($query);
    if(!$result)
    {
        echo "DB upload error";
        exit;
    }
    
    $db->close();
    
    echo "<script>alert('업로드 성공');</script>";

    echo("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");
    
?>