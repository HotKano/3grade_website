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
        <td align='center'> <?php include("left.html"); ?> </td>
		</tr>

		<tr>
		<td align='center'> <iframe width='190' height='100%' frameborder=0 scrolling='no' src="w.php"></iframe> </td>
		</tr>

		<tr>
		<td align='center'> <?php include("count.php"); ?> </td>
		</tr>
		</table>

      </div>
	      
      <div id="jw-content">
		<table width='800' align='center'>
					<?PHP

					$con = mysql_connect("localhost","dpsw23","dbfak333");
					mysql_select_db("dpsw23",$con);

					$code=$_GET['code'];

					mysql_query("set session character_set_connection=utf8;");
					mysql_query("set session character_set_results=utf8;");
					mysql_query("set session character_set_client=utf8;");


					$result = mysql_query("select * from product where code='$code'", $con);




					$kind=mysql_result($result,0,"kind");
					$name=mysql_result($result,0,"name");
					$writer=mysql_result($result,0,"writer");
					$drawer=mysql_result($result,0,"drawer");
					$content=mysql_result($result,0,"content");
					$userfile=mysql_result($result,0,"userfile");
							
					echo ("
						<table align=center border=0 width=800>     
						<form method=post action=p-modify2.php?code=$code enctype='multipart/form-data'>
						<tr><td width=100 align=center>상품코드</td>
						<td width=550><b>$code</b></td></tr>
						<tr><td align=center>상품분류</td>
						<td><select name=kind>");

					switch($kind) {
						case 0:
							echo ("<option value=0 selected>읽어주는 책</option>
								<option value=1>보여주는 책</option>");
							break;
						case 1:
							echo ("<option value=0> 읽어주는 책</option>
								<option value=1 selected>보여주는 책</option>");
							break;
					}

					echo ("</select></td></tr>
						<tr><td align=center>상품이름</td><td><input type=text name=name size=70 value='$name'></td></tr>
						<tr><td align=center>상품설명</td><td><textarea name=content rows=15 cols=75>$content</textarea></td></tr>
						<tr><td align=center>글</td><td><input type=text name=writer size=15 value=$writer></td></tr>
						<tr><td align=center>그림</td><td><input type=text name=drawer size=15 value=$drawer></td></tr>
						<tr><td align=center>상품사진</td><td><input type=file size=30 name=file><-- $userfile</td></tr>
						<tr><td align=center colspan=2><input type=submit value=수정완료></tr>
						</form>
						</table>");

					mysql_close($con);

					?>
		</table>
      </div>

	  <div id="jw-footer">
			
			(재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
	  
	  </div>



	</div>


 
 


	

  </body>
</html>