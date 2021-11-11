<?php
$ar = fopen("datos2.txt","a+") or die ("Error al crear el archivo");

$f = $_GET["datos1"];
$c = $_GET["datos2"];

fwrite($ar,$f);
fwrite($ar,"\t::\t");
fwrite($ar,$c);
fwrite($ar,"\r\n");
?>