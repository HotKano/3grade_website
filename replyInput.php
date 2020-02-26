<?php

	$rewriter = $_COOKIE[UserName];
	$board=$_GET[board]; 
	$id=$_GET[id];
	

 echo ("<form method='post' action='replyProcess.php?board=$board&id=$id'>");
echo("<table>");
	echo("<tr>");
		
		echo("<td> <b>");
			echo("$rewriter");
		echo("</b> </td>");
		
		echo("<td>");
			echo("<td><textarea name=content row=12 cols=60 style='resize:none;' ></textarea></td>");
		echo("</td>");
	
		echo("<td>");
			echo("<input type=submit value='작성하기'>");
		echo("</td>");

	echo("</tr>");
echo("</table>");
echo ("</form>");

?>