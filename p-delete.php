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
        <td align='center'> <?php include("adminSideMenu.html"); ?> </td>
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
			<?PHP

				$code = $_GET[code];
				$name = $_GET[name];

				$con = mysql_connect("localhost","dpsw23","dbfak333");
				mysql_select_db("dpsw23", $con);

								mysql_query("set session character_set_connection=utf8;");
								mysql_query("set session character_set_results=utf8;");
								mysql_query("set session character_set_client=utf8;");

				$result = mysql_query("select * from product where code='$code'", $con);

				$name=mysql_result($result,0,"name");
						
				echo ("
					<table border=0 width=650 align=center bgcolor=white>
					<tr><td width=100 align=center bgcolor=#eeeeee>도서 코드</td>
					 <td width=550><b>$code</b></td></tr>
					<tr><td align=center bgcolor=#eeeeee>도서 이름</td><td><b>$name</b></td></tr>
					<tr><td colspan=2 height=50 align=center valign=center>삭제하시겠습니까?</td></tr> 
					<tr><td colspan=2 align=center><form method=post action=p-delete2.php?code=$code><input type=submit value='삭제 확인'></form></td></tr>
					<tr><td colspan=2 align=center>[<a href=p-adminlist.php>돌아가기</a>]</td></tr>
					</table>");
					
				mysql_close($con);

				?>
      </div>



      <div id="jw-footer">
	  
       (재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
	  
      </div>


 </div>




 
 


	

  </body>
</html>