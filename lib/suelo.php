<?php
$ar=fopen("suelo.txt","a+") or die ("Error al crear el archivo");
$fecha = fopen("fechassuelo.txt","a+") or die ("Error al crear el archivo");

$time = time();
$time = $time - 18000;
$fe = date("d-m-Y (H:i:s)", $time);

$f = $_GET["datos1"];
fwrite($ar,$f);
fwrite($ar,"\r\n");

fwrite($fecha,$fe);
fwrite($fecha,"\r\n");
?>