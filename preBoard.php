<?php

$con = mysql_connect("localhost","dpsw23","dbfak333");
mysql_select_db("dpsw23",$con);

$board = "notice";



// 한글 변환
mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");

	echo("<html>");
	echo("<pre>");


	echo("<body>");
	echo("<table>");
	echo ("<table width='400' height='auto'  border='2' rules='none' bgcolor=white style='table-layout:fixed'>
	<tr>
	<td width='250' align='center' colspan='2' bgcolor=#95f3c3> <a href=show.php?board=notice> <b> 공지사항 </b> </a> </td></tr>
	");

  $cpage = $_GET[cpage];
  $pblock = $_GET[pblock];
  $nblock = $_GET[nblock];
  $pstartpage = $_GET[pstartpage];

$result = mysql_query("select *from $board order by id desc", $con);
$total = mysql_num_rows($result);



if (!$total){
  echo("
    <tr><td width='250' colspan=5 align=center bgcolor=#D0F5A9>아직 등록된 글이 없습니다.</td></tr></table>
  ");
} else {
  if ($cpage=='') $cpage=1; // $cpage -  현재 페이지 번호
  $pagesize = 5;              // $pagesize - 한 페이지에 출력할 목록 개수

  $totalpage = (int)($total/$pagesize);
  if (($total%$pagesize)!=0) $totalpage = $totalpage + 1;

  $counter=0;

  while($counter<$pagesize):
    $newcounter=($cpage-1)*$pagesize+$counter; // 실제 결과 레코드 카운터
    if ($newcounter == $total) break; 

	$id=mysql_result($result,$newcounter,"id");
    $topic=mysql_result($result,$newcounter,"topic");
    $wdate=mysql_result($result,$newcounter,"wdate");

	if(strlen($topic)>20)
	$topic = mb_substr($topic, 0, 20, 'UTF-8')."…";
	
    echo("
      <tr bgcolor=#D0F5A9>
      <td width='200' align=left> ⊙ <a href=content.php?board=$board&id=$id target='_top'>$topic &nbsp;&nbsp;</a></td>
	  <td width='200' align=right> &nbsp;&nbsp;&nbsp; $wdate </td>
      </tr>
    ");

    $counter = $counter + 1;
  endwhile;
 echo("</table>");

echo("</pre>");

echo("</body>");
echo("</html>");
}
?>
