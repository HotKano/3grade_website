﻿<!doctype html>
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
	      
      <div id="jw-content">
	  	<?PHP	

				$con = mysql_connect("localhost","dpsw23","dbfak333");
				mysql_select_db("dpsw23",$con);

				// 한글 변환
				mysql_query("set session character_set_connection=utf8;");
				mysql_query("set session character_set_results=utf8;");
				mysql_query("set session character_set_client=utf8;");

							  $cblock = $_GET[cblock];
							  $cpage = $_GET[cpage];
							  $pblock = $_POST[pblock];
							  $nblock = $_GET[nblock];
							  $pstartpage = $_GET[pstartpage];
							  $startpage = $_POST[startpage];
							  $kind = $_GET['kind'];
							  $field = $_POST[field];
							  $key = $_POST['key'];

								if (!$key) {
								  echo("<script>
								   window.alert('검색어를 입력하세요');
								   history.go(-1);
								  </script>");
								  exit;
								}


				$con = mysql_connect("localhost","dpsw23","dbfak333");
				mysql_select_db("dpsw23", $con);

							// 한글 변환
							mysql_query("set session character_set_connection=utf8;");
							mysql_query("set session character_set_results=utf8;");
							mysql_query("set session character_set_client=utf8;");


				$result=mysql_query("select *from product where $field like '%$key%' && kind=$kind order by id desc",$con);

				$total = mysql_num_rows($result);

				echo("
				  <table align='center' border=0 width=800>
				  <tr><td align=left><b>검색어:$key , 찾은 개수:$total 개</b></td>
				  <td align=right><a href=p-list.php?kind=$kind> <font color=blue> [전체목록]</a></font></td></tr>
				  </table>
				");
			
					
				echo   ("<table border=0 align=center width=800 height=600 background='images/bookHolder.jpg'><tr>");



				if (!$total){
					echo ("<td align=center><font color=red>검색 결과가 없습니다.</td>");
				}	else {
							  if ($cpage=='') $cpage=1; // $cpage -  현재 페이지 번호
							  $pagesize = 9;              // $pagesize - 한 페이지에 출력할 목록 개수

							  $totalpage = (int)($total/$pagesize);
							  if (($total%$pagesize)!=0) $totalpage = $totalpage + 1;

							  $counter=0;

							  while($counter<$pagesize && $counter < 15):
								$newcounter=($cpage-1)*$pagesize+$counter; // 실제 결과 레코드 카운터
								if ($newcounter == $total) break; 

						if ($newcounter > 0 && ($newcounter % 3) == 0) echo ("</tr><tr><td colspan=3></td></tr><tr>");

						$code=mysql_result($result,$newcounter,"code");
						$name=mysql_result($result,$newcounter,"name");
						$userfile=mysql_result($result,$newcounter,"userfile");
						$writer=mysql_result($result,$newcounter,"writer");

						echo ("<td width=135  align=center><a href=p-show.php?code=$code&kind=$kind> <img src='./save/$userfile' width=100 height=100 border=0><br><font color=blue style='text- decoration:none;   font-size:10pt;'>$name</a></font><br>");
						echo ("<font color=black   size=2>$writer&nbsp;지음</font><br><img src='./images/bookHolderBar.png' width=100 border=0> </td>");

						$counter = $counter + 1;
					endwhile;
				}
				echo ("</tr> <td colspan='3' align='center' width=300>

			  <form method=post action=p-search.php?kind=$kind>

			  <select name=field>
			  <option value=name>제목</option>
			  <option value=writer>글쓴이</option>
			  <option value=content>내용</option>
			  </select>

			  검색어<input type=text name=key size=13>
			  <input type=submit value=찾기>
			  </td>
			  </form> </table>");

							 

							  echo ("<table border=0 align=center width=800>
								<tr ><td width=800 align=center bgcolor=#95f3c3>");
									   
							  // 화면 하단에 페이지 번호 출력
							  if ($cblock=='') $cblock=1; // $cblock - 현재 페이지 블록값
							  $blocksize = 5;             // $blocksize - 화면상에 출력할 페이지 번호 개수

							  $pblock = $cblock - 1;  // 이전 블록은 현재 블록 - 1
							  $nblock = $cblock + 1;  // 다음 블록은 현재 블록 + 1
									
							  // 현재 블록의 첫 페이지 번호
							  $startpage = ($cblock - 1) * $blocksize + 1;	

							  $pstartpage = $startpage - 1;  // 이전 블록의 마지막 페이지 번호
							  $nstartpage = $startpage + $blocksize;  // 다음 블록의 첫 페이지 번호



							  if ($pblock > 0) // 이전 블록이 존재하면 [이전블록] 버튼을 활성화
								echo ("[<a href=p-list.php?kind=$kind&cblock=$pblock&cpage=$pstartpage>이전블록</a>] ");

							  // 현재 블록에 속한 페이지 번호를 출력	
							  $i =   $startpage;
							  while($i < $nstartpage):
								if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함
								echo ("<a href=p-list.php?kind=$kind&cblock=$cblock&cpage=$i><font color=blue>[$i]</a></font>");
								$i = $i + 1;
							  endwhile;
								 
							  // 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
							  if ($nstartpage <= $totalpage)   
								echo ("[<a href=p-list.php?kind=$kind&cblock=$nblock&cpage=$nstartpage>다음블록</a>] ");

								echo ("</td>");



									echo("</tr>");

								echo("</table>");

					

				mysql_close($con);

?>

      </div>

	  <div id="jw-footer">
			
			(재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
	  
	  </div>



	</div>


 
 


	

  </body>
</html>