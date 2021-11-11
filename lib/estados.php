<?php
$suelo = fopen("hs.txt","a+") or die ("Error al crear el archivo");
$temp = fopen("th.txt","a+") or die ("Error al crear el archivo");
$bomba = fopen("motor.txt","a+") or die ("Error al crear el archivo");
$fan = fopen("fan.txt","a+") or die ("Error al crear el archivo");

$vsuelo = fgets($suelo);
$vtemp = fgets($temp);
$vbomba = fgets($bomba);
$vfan = fgets($fan);

echo "<div style='text-align:center; font-size:18pt;'>";

if($vsuelo == 1){
	echo "<div style='margin: 10px 10px; border-radius: 33px 33px 33px 33px;
	-moz-border-radius: 33px 33px 33px 33px;
	-webkit-border-radius: 33px 33px 33px 33px;
	border: 3px solid #000000;'>";
	echo "Sensor Humedad de Suelo: ON";
	echo "<br>";
	echo "</div>";
}elseif($vsuelo == 0){
	echo "<div style='margin: 10px 10px; border-radius: 33px 33px 33px 33px;
	-moz-border-radius: 33px 33px 33px 33px;
	-webkit-border-radius: 33px 33px 33px 33px;
	border: 3px solid #000000;'>";
	echo "Sensor Humedad Suelo: OFF";
	echo "<br>";
	echo "</div>";
}
if($vtemp == 1){
	echo "<div style='margin: 10px 10px; border-radius: 33px 33px 33px 33px;
	-moz-border-radius: 33px 33px 33px 33px;
	-webkit-border-radius: 33px 33px 33px 33px;
	border: 3px solid #000000;'>";
	echo "Sensor Temperatura y Humedad: ON";
	echo "<br>";
	echo "</div>";
}elseif($vtemp == 0){
	echo "<div style='margin: 10px 10px; border-radius: 33px 33px 33px 33px;
	-moz-border-radius: 33px 33px 33px 33px;
	-webkit-border-radius: 33px 33px 33px 33px;
	border: 3px solid #000000;'>";
	echo "Sensor Temperatura y Humedad: OFF";
	echo "<br>";
	echo "</div>";
}
if($vbomba == 1){
	echo "<div style='margin: 10px 10px; border-radius: 33px 33px 33px 33px;
	-moz-border-radius: 33px 33px 33px 33px;
	-webkit-border-radius: 33px 33px 33px 33px;
	border: 3px solid #000000;'>";
	echo "Bomba: ON";
	echo "<br>";
	echo "</div>";
}elseif($vbomba == 0){
	echo "<div style='margin: 10px 10px; border-radius: 33px 33px 33px 33px;
	-moz-border-radius: 33px 33px 33px 33px;
	-webkit-border-radius: 33px 33px 33px 33px;
	border: 3px solid #000000;'>";
	echo "Bomba: OFF";
	echo "<br>";
	echo "</div>";
}
if($vfan == 1){
	echo "<div style='margin: 10px 10px; border-radius: 33px 33px 33px 33px;
	-moz-border-radius: 33px 33px 33px 33px;
	-webkit-border-radius: 33px 33px 33px 33px;
	border: 3px solid #000000;'>";
	echo "Fan: ON";
	echo "<br>";
	echo "</div>";
}elseif($vfan == 0){
	echo "<div style='margin: 10px 10px; border-radius: 33px 33px 33px 33px;
	-moz-border-radius: 33px 33px 33px 33px;
	-webkit-border-radius: 33px 33px 33px 33px;
	border: 3px solid #000000;'>";
	echo "Fan: OFF";
	echo "<br>";
	echo "</div>";
}

?>
