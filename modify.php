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
				<?PHP

		

				$con = mysql_connect("localhost","dpsw23","dbfak333");
				mysql_select_db("dpsw23",$con);

				$id = $_GET[id];
				$board = $_GET[board];

				switch($board){

				case 'notice' : $title = "공 지 사 항"; break;
				case 'customer' : $title = "자 유 게 시 판"; break;

				default : echo (
				"<script> 
				window.alert('잘못된 경로로 진입하셨습니다.') 
				history.go(-1)
				</script>");

				}

				if(!$_COOKIE[UserID]){
					
					echo (
				"<script> 
				window.alert('게시물 수정은 회원가입 후 가능하십니다.') 
				history.go(-1)
				</script>");


				}

				// 한글 변환
				mysql_query("set session character_set_connection=utf8;");
				mysql_query("set session character_set_results=utf8;");
				mysql_query("set session character_set_client=utf8;");

				$result=mysql_query("select *   from $board where id=$id",$con);

				// 수정하고자 하는 원본 게시물에서 수정 가능한 항목을 추출함
				$writer=mysql_result($result,0,"writer");
				$topic=mysql_result($result,0,"topic");
				$content=mysql_result($result,0,"content");


				echo("<center><h1>$title</h1></center>
					<form method=post action=mprocess.php?board=$board&id=$id>
					<table align='center' width=700 border=0>
					<tr>
					<td width=100 align=right>이름 </td>
					<td width=600> $writer </td>
					</tr>
					
					<tr>
					<td align=right>제목 </td>
					<td><input type=text name=topic size=60 value='$topic'></td>
					</tr>
					<tr>
					<td align=right>내용 </td>
					<td><textarea name=content rows=12 cols=60 style='resize:none;'>$content</textarea></td>
					</tr>
					
				 <tr>
					<td align='center' colspan='3'>
					<input type='submit' value='수정하기'>
					<input type='reset' value='지우기'>
					</form>

					<a href=show.php?board=$board><button> 목록 </button></a>
					</td>
					
					
				  </tr>
					</table>
					");

				mysql_close($con);

				?>
      </div>

 

      <div id="jw-footer">
	  
       (재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
	  
      </div>

    </div>


	

  </body>
</html>
