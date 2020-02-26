		<?PHP

				$code = $_GET[code];
				$name = $_GET[name];

				$con = mysql_connect("localhost","dpsw23","dbfak333");
				mysql_select_db("dpsw23",$con);

								mysql_query("set session character_set_connection=utf8;");
								mysql_query("set session character_set_results=utf8;");
								mysql_query("set session character_set_client=utf8;");


				$tmp = mysql_query("select userfile from product where code='$code'", $con);
				$fname = mysql_result($tmp, 0, "userfile");
				$savedir = "./save";
				$testzone = $savedir."/".$fname;

				
				@unlink($testzone);
					
				$result = mysql_query("delete from product where code='$code'", $con);

				if (!$result) {
				   echo("
					  <script>
					  window.alert('삭제에 실패했습니다')
					  history.go(-1)
					  </script>
				   ");
				   exit;
				} else {
				   echo("
					  <script>
					  window.alert('정상적으로 삭제되었습니다')
					  </script>
				   ");
				}

				mysql_close($con);

				echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

				?>