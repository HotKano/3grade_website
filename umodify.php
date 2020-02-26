<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/style2.css" />
	

  </head>

  <body style="overflow-x:hidden; overflow-y:auto;">

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
	      
      <div id="jw-content">

				<?PHP

				$con = mysql_connect("localhost","dpsw23","dbfak333");
				mysql_select_db("dpsw23",   $con);

						mysql_query("set session character_set_connection=utf8;");
						mysql_query("set session character_set_results=utf8;");
						mysql_query("set session character_set_client=utf8;");
					
				$result = mysql_query("select * from member where uid='$_COOKIE[UserID]'", $con);
					
				$uname = mysql_result($result, 0, "uname");
				$email = mysql_result($result, 0, "email");
				$zip = mysql_result($result, 0, "zipcode");
				$addr1 = mysql_result($result, 0,  "addr1");
				$addr2 = mysql_result($result, 0,  "addr2");
				$mphone = mysql_result($result, 0, "mphone");
					
				echo ("
					<script language='Javascript'>
					function go_zip(){
						window.open('zipcode.php','ZIP','width=470, height=180, scrollbars=yes');
					}
					</script>

					
					<table width=670 border=0 cellpadding=0 cellspacing=5 align=center>
					<tr><td height=40 align=center><b>[회원정보 수정 폼]</b></td></tr>
					</table>
					<table border=1 width=670 align=center>
					<tr><td>
						<form action=register2.php method=post name=comma>
						<table width=670 border=0 align=center>
							<tr><td width=5% align=right>*</td>
							<td width=15% height=30><font size=2>회원 ID</td>
							<td width=80%><font   size=2><b>$_COOKIE[UserID]</b></td></tr>
							<tr><td align=right>*</td>
							<td height=30><font size=2>비밀번호</font></td>
							<td><input type=password   maxlength=15 style='height:20;' size=20 name=upass1></td></tr>
							<tr><td   align=right>*</td>
							<td height=30><font size=2>비밀번호확인</font></td>
							<td><input type=password   maxlength=15 style='height:20;' size=20 name=upass2></td></tr>
							<tr><td align=right>*</td>
							<td height=30><font size=2>이 름</font></td>
							<td><input type=text size=10   name=uname value=$uname></td></tr>
							<tr><td align=right>*</td>
							<td height=30><font size=2>휴대전화</font></td>
							<td><input type=text size=20 name=mphone value=$mphone></td> </tr>
							<tr><td align=right>*</td>
							<td height=30><font size=2>이메일</td>
							<td><input type=text size=30 name=email value=$email></td></tr>
							<tr><td align=right>*</td>
							<td height=30><font size=2>집주소</td>
							<td><input type=text size=7   name=zip value=$zip readonly=readonly> <font size=2>[<a   href='javascript:go_zip()'>우편번호검색</a>]</font><br>
							<input type=text size=50 name=addr1 value='$addr1' readonly=readonly><br><input type=text size=35 name=addr2 value='$addr2'> 
							</td></tr>
						</table>
					</td></tr>
					</table>
				  
					<table width=670 border=0 cellpadding=0 cellspacing=5 align=center>
					<tr><td colspan='2' height=40 align=center><input type=submit value='회원정보수정'></form>
					<a href='./mypage.php'><button> 취소 </button></a> </td></tr>
					</table>
					
				");

				?>




      </div>

	  <div id="jw-footer">
			
			(재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
	  
	  </div>



	</div>


 
 


	

  </body>
</html>