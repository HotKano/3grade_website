<?PHP

// $con = mysql_connect("localhost","shoproot","pw4shoproot");
// mysql_select_db("shopmall", $con);
	
// mysql_query("delete from shoppingbag where id='$UserID'", $con);
// mysql_close($con);
	
 SetCookie("UserID", "", time());
 SetCookie("UserName", "", time());

 SetCookie("Session", "", time());
	 
echo ("<meta http-equiv='Refresh' content='0; url=layout2.html'>");

?>
