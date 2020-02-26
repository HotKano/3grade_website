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

				$con = mysql_connect("localhost","dpsw23","dbfak333");
				mysql_select_db("dpsw23",$con);


				mysql_query("set session character_set_connection=utf8;");
				mysql_query("set session character_set_results=utf8;");
				mysql_query("set session character_set_client=utf8;");


				$result = mysql_query("select * from product order by name", $con);

				$total = mysql_num_rows($result);

				echo("	<table align=center border=0 width=690>
					<tr><td align=center colspan=2><font size=3><b>[전자책 목록]</b></td></tr>
					<tr><td algin=left><font size=2><a href=upload.html> <button>등록</button> </a> </td>
					<td align=right><font size=2><a href=p-adminlist.php> <button>목록</button> </a> </td>
					</tr></table>");
				
				
				echo ("<table align=center border=1 width=690 bgcolor=white>
					<tr><td align=center bgcolor=#eeeeee><font size=2><b>상품코드</b></td>
					<td colspan=2 align=center bgcolor=#eeeeee><font size=2><b>상품명</b></td>
					<td align=center bgcolor=#eeeeee><font size=2><b>글</b></td>
					<td align=center bgcolor=#eeeeee><font size=2><b>그림</b></td>
					<td align=center bgcolor=#eeeeee><font size=2><b>수정/삭제</b></td></tr> ");
											
				if (!$total) {

				  echo("<tr><td colspan=6 align=center>아직 등록된 상품이 없습니다</td></tr>");

				} else {

					$counter = 0;

					while ($counter < $total) :

						$code=mysql_result($result,$counter,"code");
						$name=mysql_result($result,$counter,"name");
						$userfile=mysql_result($result,$counter,"userfile");
						$writer=mysql_result($result,$counter,"writer");
						$drawer=mysql_result($result,$counter,"drawer");
						$kind=mysql_result($result,$counter,"kind");

						echo ("
						   <tr><td width=100 align=center><font size=2>$code</td>
							 <td align=center width=30><img src=./save/$userfile width=40 height=40 border=0></td>
							   <td width=350 align=left><a href=p-show.php?code=$code&kind=$kind><font size=2>$name</a></td>
							   <td align=center width=70><font size=2>$writer</td>
							   <td align=center width=70><font size=2>$drawer</td>
							   <td width=70 align=center><font size=2><a href=p-modify.php?code=$code><font color=blue>수정</font></a>/<a href=p-delete.php?code=$code><font color=red>삭제</font></a></td></tr>");

						$counter++;
					endwhile;
				}

				echo ("</table>");
						 
				mysql_close($con);

				?>
      </div>



      <div id="jw-footer">
	  
       (재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
	  
      </div>


 </div>




 
 


	

  </body>
</html>