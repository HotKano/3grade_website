<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/style2.css" />

  </head>

      <style>

	  body{
	  	height: auto;
		background-image: url("./images/bg.png");
		background-size: cover;
		background-repeat: no-repeat;
		
		
		}

		</style>
 

  <body style="overflow-x:hidden; overflow-y:auto;">

	<div id="jw-container">
      
		<table align='center' cellpadding="0" cellspacing="0">
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
					<table border='0' width='900'>
					<tr height='600'>
					<td width='720' align='center' valign='top'>

					<center><font size=3><b>사용자 ID 찾기</b></center>
					<table align=center border=0 width=400>
					<form method=post action=findid.php onsubmit="if(!this.uname.value ||   !this.email.value) return false;">
					<tr><td align=right><font size=2>이름(실명)</td>
					<td align=left><input type=text   size=20 name=uname></td></tr>
					<tr><td align=right><font size=2>이메일주소</td>
					<td align=left><input type=text   size=40 name=email></td></tr>
					<tr><td align=center colspan=2><input type=submit value='아이디 확인'></tr>
					</form>
					</table>
					<br><br>
					<center><font size=3><b>사용자 비밀번호 찾기</b></center>
					<table align=center border=0 width=400>
					<form method=post action=findpw.php onsubmit="if(!this.uid.value ||   !this.uname.value || !this.email.value) return false;">
					<tr><td align=right><font size=2>사용자ID</td>
					<td align=left><input type=text size=20 name=uid></td></tr>
					<tr><td align=right><font size=2>이름(실명)</td>
					<td align=left><input type=text size=20 name=uname></td></tr>
					<tr><td   align=right><font style='font-size:10pt; font-family:Tahoma;'>이메일주소</td>
					<td align=left><input type=text size=40 name=email></td></tr>
					<tr><td align=center colspan=2><input type=submit value='비밀번호 확인'></tr>
					</form> 
					</table>
					</td></tr>
					</table>

      </div>

 

      <div id="jw-footer">
       (재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
      </div>

    </div>

  </body>
</html>