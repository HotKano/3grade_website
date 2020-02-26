<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./css/style2.css" />
 </head>

  <body style="overflow-x:hidden; overflow-y:auto;">


<td align = 'center'>
 

	<div id="jw-container">
      
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td align='center'> <?php include("menu.html"); ?> </td>
		</tr>
		</table>
    	 
	 <div id="jw-sidebar">
		<table align ='center'>

		<tr>
		<td align='center'> <iframe width='190' height='100%' frameborder=0 scrolling='no' src="w.php"></iframe> </td>
		</tr>

		<tr>
		<td align='center'> <?php include("count.php"); ?> </td>
		</tr>
		</table>

      </div>
	      
      <div id="jw-content" align='center'>

				<?PHP

					if(!$_COOKIE[UserID]){

							echo("<script>
									window.alert('로그인 이후 사용 가능한 메뉴입니다.')
									history.go(-1)
									</script> ");
							exit;




					}



					$con = mysql_connect("localhost","dpsw23","dbfak333");
					mysql_select_db("dpsw23",   $con);

							mysql_query("set session character_set_connection=utf8;");
							mysql_query("set session character_set_results=utf8;");
							mysql_query("set session character_set_client=utf8;");



					$result = mysql_query("select * from member where uid='$_COOKIE[UserID]'", $con);
						
					$uid = mysql_result($result, 0,   "UID");
					$uname = mysql_result($result, 0,   "UNAME");
					$email = mysql_result($result, 0,   "EMAIL");
					$zip = mysql_result($result, 0,   "ZIPCODE");
					$addr1 = mysql_result($result, 0,   "ADDR1");
					$addr2 = mysql_result($result, 0,   "ADDR2");
					$mphone = mysql_result($result, 0,   "MPHONE");

					?>
					<table width=690 border=0>
					<tr><td align=center><b>[ 회원 정보 ]</b></td></tr>
					<tr><td align=right colspan='2'><a href=umodify.php><button>회원정보수정</button></a>
					<button onclick="function()" id="next">탈퇴하기</button>  </td></tr>
					</table>

					<table border=1 width=690 bgcolor=white>
					<tr><td width=100 bgcolor='#eeeeee' align=center><font size=2>이름</td>
					<td width=120><font size=2><? echo $uname; ?></td></tr>
					<tr><td width=80 bgcolor='#eeeeee' align=center><font size=2>휴대전화</td>
					<td width=140><font size=2><? echo $mphone; ?></td></tr>
					<tr><td width=80 bgcolor='#eeeeee' align=center><font size=2>이메일</td>
					<td width=170><font size=2><? echo $email; ?></td></tr>
					<tr><td bgcolor='#eeeeee' align=center><font size=2>주소</td>
					<td colspan=5><font   size=2><? echo $zip . " " . $addr1 . " " . $addr2;   ?></td></tr>
					</table>
					<br><br>
					<?
									$con = mysql_connect("localhost","dpsw23","dbfak333");
									mysql_select_db("dpsw23",$con);


									mysql_query("set session character_set_connection=utf8;");
									mysql_query("set session character_set_results=utf8;");
									mysql_query("set session character_set_client=utf8;");

									$code = $_GET[code];

									echo $code;

									$result = mysql_query("select * from zzim where uid='$_COOKIE[UserID]' order by id desc", $con);

									$total = mysql_num_rows($result);

									echo("	<table align=center border=0 width=690>
										<tr><td align=center colspan=2><font size=3><b>[ 찜 리스트 ]</b></td></tr>
										</table>");
									
									
									echo ("<table align=center border=1 width=690 bgcolor=white>
										<tr><td align=center bgcolor=#eeeeee><font size=2>도서 코드</td>
										<td colspan=2 align=center bgcolor=#eeeeee><font size=2>도서 명</td>
										<td align=center bgcolor=#eeeeee><font size=2>날짜</td>
										<td align=center bgcolor=#eeeeee><font size=2>취소</td></tr>");
																
									if (!$total) {

									  echo("<tr><td colspan=6 align=center>아직 찜한 책이 없습니다</td></tr>");

									} else {

										$counter = 0;

										while ($counter < $total) :

											$code=mysql_result($result,$counter,"code");
											$name=mysql_result($result,$counter,"name");
											$userfile=mysql_result($result,$counter,"userfile");
											$date=mysql_result($result,$counter,"date");
											$id=mysql_result($result,$counter,"id");
											$kind=mysql_result($result,$counter,"kind");
									

											echo ("
											   <tr><td width=100 align=center><font size=2>$code</td>
												 <td align=center width=30><img src=./save/$userfile width=40 height=40 border=0></td>
												   <td width=350 align=left><a href=p-show.php?code=$code&kind=$kind><font size=2 color=blue>$name</a></td>
												   <td width=70 align=center><font size=2>$date</td>
												   <td align=center> <a href=./zzimDelete.php?code=$code&id=$id><font size=2 color=blue>찜 취소</a></font> </td></tr>");

											$counter++;
										endwhile;
									}

									echo ("</table>");
											 
									mysql_close($con);

					?>

					<script>

					var x=document.getElementById("next");
					x.onclick=function() {
						var y=window.confirm("정말로 탈퇴하시겠습니까?");
						if(!y) {
							
							return true;
						} else {

							 location.href="memberDelete.php";

						}
					}




					</script>




      </div>

 

      <div id="jw-footer">
       (재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
      </div>

    </div>

	</td>

	

  </body>
</html>