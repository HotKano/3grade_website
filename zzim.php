<?PHP

				if(!$_COOKIE[UserID]){
					
					echo (
				"<script> 
				window.alert('로그인 이 후 사용가능 하신 메뉴입니다.') 
				history.go(-1)
				</script>");
				exit;


				}



				$con = mysql_connect("localhost","dpsw23","dbfak333");
				mysql_select_db("dpsw23",$con);


				mysql_query("set session character_set_connection=utf8;");
				mysql_query("set session character_set_results=utf8;");
				mysql_query("set session character_set_client=utf8;");

				$code = $_GET[code];
				$kind = $_GET[kind];

				$result = mysql_query("select * from zzim where uid='$_COOKIE[UserID]' AND code='$code'", $con);
				$total = mysql_num_rows($result);

				if($total){

				echo("<script> 
				window.alert('이미 찜이 된 도서입니다.');
				history.go(-1);			
				</script>");
				exit;

				} 
				
				$result = mysql_query("select * from zzim where uid='$_COOKIE[UserID]'", $con);
				$total = mysql_num_rows($result);
				
				if(!$total) {

					$id = 1;
			
				} else {

					$id = $total + 1;
			
				}

				$result = mysql_query("select * from product where code='$code'", $con);

				

				$code=mysql_result($result,0,"code");
				$name=mysql_result($result,0,"name");
				$userfile=mysql_result($result,0,"userfile");
				$wdate = date("Y-m-d");

				mysql_query("insert into zzim(id, kind, uid, userfile, code, name, date) values($id, $kind, '$_COOKIE[UserID]','$userfile','$code','$name','$wdate')", $con);

				mysql_close($con);	// 데이터베이스 연결해제

				//show.php 프로그램을 호출하면서 테이블 이름을 전달
		
				echo("<script> 
				window.alert('찜 되었습니다!');
						
				</script>");
				



				echo("<meta http-equiv='Refresh' content='0; url=p-show.php?code=$code&kind=$kind'>");



?>