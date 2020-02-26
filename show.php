<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/style2.css" />

	<style>

	</style>

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
		<table>
		<td width='1000' align='center'>
			<table border='0' width='800' height='600'>
			<td width='720' align='center' valign='top'>

			<?PHP
			 
			$con = mysql_connect("localhost","dpsw23","dbfak333");
			mysql_select_db("dpsw23", $con);

			// 한글 변환
			mysql_query("set session character_set_connection=utf8;");
			mysql_query("set session character_set_results=utf8;");
			mysql_query("set session character_set_client=utf8;");

			  $board = $_GET[board];
			  $cblock = $_GET[cblock];
			  $cpage = $_GET[cpage];
			  $pblock = $_POST[pblock];
			  $nblock = $_GET[nblock];
			  $pstartpage = $_GET[pstartpage];
			  $startpage = $_POST[startpage];
			 		  

			$result = mysql_query("select *from $board order by id desc", $con);
			$total = mysql_num_rows($result);


				switch($board){

				case 'notice' : $title = "공 지 사 항"; break;
				case 'customer' : $title = "자 유 게 시 판"; break;

				default : echo (
				"<script> 
				window.alert('잘못된 경로로 진입하셨습니다.') 
				history.go(-1)
				</script>");

				}

			echo("
			  <table border=0 width=700>
			  <tr><td colspan=2 align=center><h1>$title</h1></td></tr>
			  <tr>");
			  
				  	  echo("
			  </tr>
			  </table>
			  <table id=ttest border=0 width=700 bgcolor=white>
			  <tr><td align=center width=50 bgcolor=#95f3c3><b>번호</b></td>
			  <td align=center width=100 bgcolor=#95f3c3><b>글쓴이</b></td>
			  <td align=center width=400 bgcolor=#95f3c3><b>제목</b></td>
			  <td align=center width=150 bgcolor=#95f3c3><b>날짜</b></td>
			  <td align=center width=50 bgcolor=#95f3c3><b>조회</b></td>
			  </tr>
			");
			

			 
			if (!$total){
			  echo("
				<tr><td colspan=5 align=center>아직 등록된 글이 없습니다.</td></tr>
				<table border=0 width=700>
				<tr>
				<td align=center bgcolor=#95f3c3>

			  <form method=post action=search.php?board=$board>

			  <select name=field>
			  <option value=writer>글쓴이</option>
			  <option value=topic>제목</option>
			  <option value=content>내용</option>
			  </select>

			  검색어<input type=text name=key size=13>
			  <input type=submit value=찾기>
			  </td>
			  </form>

	
			  <td align=right bgcolor=#95f3c3><a href=input.php?board=$board><button style='width:100%'>글쓰기</button></a></td>
			  
			  
			  </tr></table>
			  ");
			} else {
			  if ($cpage=='') $cpage=1; // $cpage -  현재 페이지 번호
			  $pagesize = 10;              // $pagesize - 한 페이지에 출력할 목록 개수

			  $totalpage = (int)($total/$pagesize);
			  if (($total%$pagesize)!=0) $totalpage = $totalpage + 1;

			  $counter=0;

			  while($counter<$pagesize):
				$newcounter=($cpage-1)*$pagesize+$counter; // 실제 결과 레코드 카운터
				if ($newcounter == $total) break; 

				$id=mysql_result($result,$newcounter,"id");
				$writer=mysql_result($result,$newcounter,"writer");
				$topic=mysql_result($result,$newcounter,"topic");
				$hit=mysql_result($result,$newcounter,"hit");
				$wdate=mysql_result($result,$newcounter,"wdate");
				$space=mysql_result($result,$newcounter,"space");

				$t="";
				if ($space>0) {
				  for ($i=0 ; $i<=$space ; $i++)
				$t = $t . "&nbsp;";     // 답변 글의 경우 제목 앞 부분에 공백을 채움
				}

				if(mb_strlen($topic)>60)
				$topic = mb_substr($topic, 0, 20, 'UTF-8')."…";
				
				if($board == 'customer'){
				$result2 = mysql_query("select *from reply where id=$id", $con);
				$total2 = mysql_num_rows($result2);


				echo("
				  <tr><td align=center>$id</td>
				  <td align=center>$writer</td>
				  <td align=left>$t<a href=content.php?board=$board&id=$id>$topic&nbsp[$total2]</a></td>
				  <td align=center>$wdate</td><td align=center>$hit</td>
				  </tr>
				");
				} else {

					echo("
				  <tr><td align=center>$id</td>
				  <td align=center>$writer</td>
				  <td align=left>$t<a href=content.php?board=$board&id=$id>$topic</a></td>
				  <td align=center>$wdate</td><td align=center>$hit</td>
				  </tr>
				");

				}

				$counter = $counter + 1;
			  endwhile;
			  echo("</table>");

			  echo ("<table border=0 width=700>
				<tr><td align=center bgcolor=#95f3c3>");
					   
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
				echo ("[<a href=show.php?board=$board&cblock=$pblock&cpage=$pstartpage>이전블록</a>] ");

			  // 현재 블록에 속한 페이지 번호를 출력	
			  $i =   $startpage;
			  while($i < $nstartpage):
				if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함
				echo ("[<a href=show.php?board=$board&cblock=$cblock&cpage=$i>$i</a>]");
				$i = $i + 1;
			  endwhile;
				 
			  // 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
			  if ($nstartpage <= $totalpage)   
				echo ("[<a href=show.php?board=$board&cblock=$nblock&cpage=$nstartpage>다음블록</a>] ");

			  echo ("</td>
			 
			  <td align=center bgcolor=#95f3c3>

			  <form method=post action=search.php?board=$board>

			  <select name=field>
			  <option value=writer>글쓴이</option>
			  <option value=topic>제목</option>
			  <option value=content>내용</option>
			  </select>

			  검색어<input type=text name=key size=13>
			  <input type=submit value=찾기>
			  </td>
			  </form> ");

			  if($board=='notice' && $_COOKIE[UserID]=='admin')
			
			  echo "<td align=right bgcolor=#95f3c3><a href=input.php?board=$board><button style='width:100%'>글쓰기</button></a></td>";

			  else if ($board=='customer')

				  echo "<td align=right bgcolor=#95f3c3><a href=input.php?board=$board><button style='width:100%'>글쓰기</button></a></td>";
			  
			  echo("
			  </tr></table>");
			}
				
			mysql_close($con);

			?>

			</td></tr>
			</table>
			</table>



		</td>
		</table>
      </div>

 

      <div id="jw-footer">
       (재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
      </div>

    </div>


  </body>
</html>