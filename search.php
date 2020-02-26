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

				$board = $_GET[board];
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


				$result=mysql_query("select *from $board where $field like '%$key%' order by id desc",$con);

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
				  <table align='center' border=0 width=700>
				  <tr><td align=center colspan=2><h1>$title</h1></td><tr>
				  <tr><td>검색어:$key , 찾은 개수:$total 개</td>
				  <td align=right><a href=show.php?board=$board>[전체목록]</a></td></tr>
				  </table>
				");

				echo("
				  <table id=ttest align='center' border=0 width=700 bgcolor=white>
				  <tr><td align=center   width=50 bgcolor=#95f3c3><b>번호</b></td>
				  <td align=center width=100 bgcolor=#95f3c3><b>글쓴이</b></td>
				  <td align=center width=400 bgcolor=#95f3c3><b>제목</b></td>
				  <td align=center width=150 bgcolor=#95f3c3><b>날짜</b></td>
				  <td align=center width=50 bgcolor=#95f3c3><b>조회</b></td>
				  </tr>
				");

				if (!$total){
				  echo("<tr><td colspan=5 align=center>검색된 글이 없습니다.</td></tr> </table>");
				} else {
				  $counter=0;

				  while($counter<$total):
					$id=mysql_result($result,$counter,"id");
					$writer=mysql_result($result,$counter,"writer");
					$topic=mysql_result($result,$counter,"topic");
					$hit=mysql_result($result,$counter,"hit");
					$wdate=mysql_result($result,$counter,"wdate");
					$space=mysql_result($result,$counter,"space");

					$t="";

					if ($space>0) {
					   for ($i=0 ;   $i<=$space ; $i++)
					 $t=$t .  "&nbsp;"; // $space > 0 인 경우 제목 앞에 공백 추가
					}

					echo("
					  <tr><td align=center>$id</td>
					  <td align=center>$writer</td>
					  <td align=left>$t<a href=content.php?board=$board&id=$id>$topic</a></td>
					  <td align=center>$wdate</td><td align=center>$hit</td>
					  </tr>
					");

					$counter = $counter + 1;

				  endwhile;

				  echo("</table>");
				}

				mysql_close($con);

				?>
      </div>

 

      <div id="jw-footer">
       (재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
      </div>

    </div>


  </body>
</html>


