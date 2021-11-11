<?php
$ar=fopen("nivel.txt","a+") or die ("Error al crear el archivo");

$f = $_GET["datos1"];
fwrite($ar,$f);
fwrite($ar,"\r\n");
?>