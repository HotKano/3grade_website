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
		<table width='800' border='0' align='center'>
		<tr height='600'>
		<td width='800' valign='top'>

		<table>
		<tr>
		<td>
		<?PHP

		$con = mysql_connect("localhost","dpsw23","dbfak333");
		mysql_select_db("dpsw23",   $con);

	
		mysql_query("set session character_set_connection=utf8;");
		mysql_query("set session character_set_results=utf8;");
		mysql_query("set session character_set_client=utf8;");

		$key = $_POST['key'];
		if(!$key)
		$key = $_GET['key'];

		$result = mysql_query("select * from Map", $con);
		$total = mysql_num_rows($result);
				
		$i = 0;
			
	echo("
			<table border=1 align=center width=420 height=300 cellpadding=3 cellspacing=0>
			<tr height=10>
			<td align=center width=250 bgcolor=#95f3c3> 이름 </td>
			<td align=center width=300 bgcolor=#95f3c3> 주소 </td>
			<td align=center width=200 bgcolor=#95f3c3> 연락처 </td>
			
			</tr>
			");




		echo ("

			
		");

		
			
		while($i <   $total):
			$name = mysql_result($result, $i, "name");
			$address = mysql_result($result, $i, "address");
			$phone = mysql_result($result, $i, "phone");
			$x = mysql_result($result, $i, "x");
			$y = mysql_result($result, $i, "y");

			echo ("<tr height=150 bgcolor=white>
			<td align=center width=250><a href='./map.php?z=$x&x=$y'> <font size=2 color=blue>$name</a></font></td>
			<td align=center width=300> <font size=2> $address </font>	</td>
			<td align=center  width=200> <font size=2> $phone </font> </td>
			</tr>");
					  
			$i++;
		endwhile;

		echo ("</table>");
		

		mysql_close($con);
		echo("
		</td> <td> ");

		if(!$_GET[z])
		$z = "34.77603808935294"; else $z = $_GET[z];

		if(!$_GET[x])
		$x = "127.6993920172035"; else $x = $_GET[x];

		echo("
				<!DOCTYPE html>
				<html>
				<head>
					<meta charset='utf-8'>
					<title></title>
					
				</head>
				<body>
				<div id='map' style='width:500px;height:350px;'></div>
				<p><em></em></p> 
				<p id='result'></p>

				<script type='text/javascript' src='//apis.daum.net/maps/maps3.js?apikey=e24c71e93e40f696a32b09e1df3b3300'></script>
				<script>
				var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
					mapOption = { 
						center: new daum.maps.LatLng($z, $x), // 지도의 중심좌표
						level: 3 // 지도의 확대 레벨
					};

				var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

				// 지도가 이동, 확대, 축소로 인해 중심좌표가 변경되면 마지막 파라미터로 넘어온 함수를 호출하도록 이벤트를 등록합니다
				daum.maps.event.addListener(map, 'center_changed', function() {        
					
					// 지도의  레벨을 얻어옵니다
					var level = map.getLevel();
					
					// 지도의 중심좌표를 얻어옵니다 
					var latlng = map.getCenter(); 
								
					
				});

				// 마커를 표시할 위치와 title 객체 배열입니다 
				var positions = [

					{
						title: '$name', 
						latlng: new daum.maps.LatLng($z, $x)
					},
					{
						title: '생태연못', 
						latlng: new daum.maps.LatLng(33.450936, 126.569477)
					},
					{
						title: '텃밭', 
						latlng: new daum.maps.LatLng(33.450879, 126.569940)
					},
					{
						title: '근린공원',
						latlng: new daum.maps.LatLng(33.451393, 126.570738)
					}
				];

				// 마커 이미지의 이미지 주소입니다
				var imageSrc = 'http://i1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png'; 
					
				for (var i = 0; i < positions.length; i ++) {
					
					// 마커 이미지의 이미지 크기 입니다
					var imageSize = new daum.maps.Size(24, 35); 
					
					// 마커 이미지를 생성합니다    
					var markerImage = new daum.maps.MarkerImage(imageSrc, imageSize); 
					
					// 마커를 생성합니다
					var marker = new daum.maps.Marker({
						map: map, // 마커를 표시할 지도
						position: positions[i].latlng, // 마커를 표시할 위치
						title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
						image : markerImage // 마커 이미지 
					});
				}
				</script>
				</body>
				</html>





		");

		echo ("</td> </tr>");





		?>

				</table>
		</table>
      </div>

	  <div id="jw-footer">
			
			(재) 아이마미 | 대표 : 김종우 | Tel 062-372-7243 | 010-4100-7243
	  
	  </div>



	</div>


 
 


	

  </body>
</html>