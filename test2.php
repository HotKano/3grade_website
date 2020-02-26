<?PHP

				$con = mysql_connect("localhost","dpsw23","dbfak333");
				mysql_select_db("dpsw23",$con);


				mysql_query("set session character_set_connection=utf8;");
				mysql_query("set session character_set_results=utf8;");
				mysql_query("set session character_set_client=utf8;");

				$code = $_GET[code];

				echo $code;

				$result = mysql_query("select * from zzim where uid='$_COOKIE[UserID]'", $con);

				$total = mysql_num_rows($result);

				echo("	<table align=center border=0 width=690>
					<tr><td align=center colspan=2><font size=3><b>[찜 리스트]</b></td></tr>
					</table>");
				
				
				echo ("<table align=center border=1 width=690 bgcolor=white>
					<tr><td align=center bgcolor=#eeeeee><font size=2>도서 코드</td>
					<td colspan=2 align=center bgcolor=#eeeeee><font size=2>도서 명</td>
					<td align=center bgcolor=#eeeeee><font size=2>날짜</td></tr>");
											
				if (!$total) {

				  echo("<tr><td colspan=6 align=center>아직 찜한 책이 없습니다</td></tr>");

				} else {

					$counter = 0;

					while ($counter < $total) :

						$code=mysql_result($result,$counter,"code");
						$name=mysql_result($result,$counter,"name");
						$userfile=mysql_result($result,$counter,"userfile");
						$date=mysql_result($result,$counter,"date");
				

						echo ("
						   <tr><td width=100 align=center><font size=2>$code</td>
							 <td align=center width=30><img src=./save/$userfile width=40 height=40 border=0></td>
							   <td width=350 align=left><a href=p-show.php?code=$code><font size=2>$name</a></td>
							   <td width=70 align=center><font size=2>$date</td></tr>");

						$counter++;
					endwhile;
				}

				echo ("</table>");
						 
				mysql_close($con);

				?>