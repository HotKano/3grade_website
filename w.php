<?php

if(!$_GET[area])
$area = 12562;
else
$area = $_GET[area];

if($area == 12562)
$area_name = "여수";
else if($area == 12552)
$area_name = "광주";
else if($area == 12514)
$area_name = "서울";


echo ("

<table cellpadding=0 cellspacing=0 width=190 height=160 style='border:solid 0px #D4CD11;font-family:Times New Roman;font-size:12px;background-color:#D4CD11'>
<tr>
<td><table width=190 cellpadding=0 cellspacing=0><tr><td width=8 height=20 background='http://rp5.ru/informer/htmlinfa/topshl.png'  bgcolor=#D4CD11> </td>

<td width=* align=center background='http://rp5.ru/informer/htmlinfa/topsh.png' bgcolor=#D4CD11><a style='color:black; font-family:Times New Roman;font-size: 12px;' href='http://rp5.ru/$area/ko' target='_blank'><b> $area_name </b></a> 

<select name='area' onchange='location.href=this.value'>
    <option value=''> 지역 별 날씨 </option>
    <option value='w.php?area=12562'>여수</option>
    <option value='w.php?area=12552'>광주</option>
    <option value='w.php?area=12514'>서울</option>
</select>

</td>

<td width=8 height=30 background='http://rp5.ru/informer/htmlinfa/topshr.png' bgcolor=#D4CD11> </td></tr></table></td></tr><tr><td valign=top style='padding:0;'><iframe src='http://rp5.ru/htmla.php?id=$area&lang=ko&um=00000&bg=%232098fe&ft=%23ffffff&fc=%23209dfe&c=%23000000&f=Times New Roman&s=12&sc=4' width=190 height=200 frameborder=0 scrolling='no' style='margin:0;'></iframe></td></tr></table>

");

?>




