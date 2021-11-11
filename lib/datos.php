<?php
$ar = fopen("datos.txt","a+") or die ("Error al crear el archivo");
$fecha = fopen("fechas.txt","a+") or die ("Error al crear el archivo");

$f = $_GET["datos1"];
$c = $_GET["datos2"];

$time = time();
$time = $time - 18000;
$fe = date("d-m-Y (H:i:s)", $time);

fwrite($ar,$f);
fwrite($ar,"\t::\t");
fwrite($ar,$c);
fwrite($ar,"\r\n");

fwrite($fecha,$fe);
fwrite($fecha,"\r\n");

?>