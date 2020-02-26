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
        <td align='center'> <?php include("sideMenu.html"); ?> </td>
		</tr>

		<tr>
		<td align='center'> <iframe width='190' height='100%' frameborder=0 scrolling='no' src="w.php"></iframe> </td>
		</tr>

		<tr>
		<td align='center'> <?php include("count.php"); ?> </td>
		</tr>
		</table>

      </div>
	      
      <div id="jw-content" align=center>
				<table  border='0' width='600'>
				<?PHP
				$con = mysql_connect("localhost","dpsw23","dbfak333");
				mysql_select_db("dpsw23",$con);

				// 한글 변환
						mysql_query("set session character_set_connection=utf8;");
						mysql_query("set session character_set_results=utf8;");
						mysql_query("set session character_set_client=utf8;");

				$code = $_GET[code];
				$kind = $_GET[kind];

				$result = mysql_query("select * from product where code='$code'", $con);
				$total = mysql_num_rows($result);

				$name=mysql_result($result,0,"name");
				$content=mysql_result($result,0,"content");
				$content=nl2br($content);

				$writer=mysql_result($result,0,"writer");
				$drawer=mysql_result($result,0,"drawer");
				$userfile=mysql_result($result,0,"userfile");

				// 상품의 조회수를 읽어와서 1 증가시킨 다음 업데이트 쿼리를 적용
				$hit=mysql_result($result,0,"hit");
				$hit++;
				mysql_query("update product set hit=$hit where code='$code'", $con);

				echo ("
					<table width=800 border=0>
					<tr><td width=250 align=center>
					<a href=# onclick=\"window.open('./save/$userfile', '_new', 'width=450, height=450')\"><img src='./save/$userfile' width=150 border=0></a></td>
					<td width=600 valign=top>
					<table border=0 width=100%>
					  <tr><td width=80 align=center bgcolor=#eeeeee>도서 코드 : </td>
					  <td width=320 align=left bgcolor=white>&nbsp;&nbsp;$code</td></tr>
					  <tr><td align=center bgcolor=#eeeeee>도서 이름 : </td>
					  <td align=left bgcolor=white>&nbsp;&nbsp;$name</td></tr>
					  <tr><td align=center bgcolor=#eeeeee>글 : </td>
					  <td align=left bgcolor=white>&nbsp;&nbsp;$writer&nbsp;</td></tr>
					  <tr><td align=center bgcolor=#eeeeee>그림 : </td>
					  <td align=left bgcolor=white>&nbsp;&nbsp;$drawer&nbsp;</td></tr>
					 


					
					</td>
					</table>
					</tr>
						
					<br>
					<table width=800 border=0>
						
						<tr><td><hr size=1></td></tr>
						<tr><td align=center  bgcolor=#eeeeee>[도서 줄거리 및 설명]</td></tr>
						<tr><td align=left bgcolor=white>$content</td></tr>
						<tr><td colspan='3' align='center'>
						<a href='./zzim.php?code=$code&kind=$kind'> <button> 찜하기 </button> </a>
						<a href='../f/$code.html' target='_blank'><button>읽기</button></a>
						<a href=./p-list.php?kind=$kind> <button> 도서 목록 </button> </a>  </td>
						</tr>
						
					</table>
					</table>
				");
							 
				mysql_close($con);

				?>
      </div>

 

      <div id="jw-footer">
       (재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
      </div>

    </div>

	</td>

	

  </body>
</html>