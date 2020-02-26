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
			<table border='0' width='800' align='center'>
				<tr>
				<td width='720' valign='top'>

				<?PHP

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
				window.alert('게시물 작성은 회원가입 후 가능하십니다.') 
				history.go(-1)
				</script>");


				}

				if($board=='notice' && $_COOKIE[UserID]!='admin'){
					
					echo (
				"<script> 
				window.alert('공지사항 작성은 관리자만 가능하십니다.') 
				history.go(-1)
				</script>");


				}

				echo("
				<HTML html>
				<head>
				<title>게시판</title>
				</head>

				<body>
				  <center><h1>	$title	</h1></center>
				  
				  <table width='700' align='center' border='0'>
				  <form method='post' action='process.php?board=$board'>
				  <tr><td width='100' align='right'>이름 </td>
					<td width='600'>$_COOKIE[UserName]</td>
				  </tr><tr><td align='right'>제목 </td>
					<td><input type='text' name='topic' size='60'></td>
				  </tr><tr><td align='right'>내용 </td>
					<td><textarea name='content' rows='12' cols='60' style='resize:none;'></textarea></td>
				  
				  <tr>
					<td align='center' colspan='3'>
					<input type='submit' value='등록하기'>
					<input type='reset' value='지우기'>
					</form>

					<a href=show.php?board=$board><button> 목록 </button></a>
					</td>
					
					
				  </tr>
				  
				  </table>
				  
				 </body>
				</HTML>
				");
				?>


				</td></tr>
				</table>
      </div>

 

      <div id="jw-footer">
       (재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
      </div>

    </div>

	</td>
	

  </body>
</html>