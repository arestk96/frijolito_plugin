<?php
$ar=fopen("motor.txt","w") or die ("Error al crear el archivo");
$temp = fopen("th.txt","w") or die ("Error al crear el archivo");


fwrite($ar,"1");
fwrite($temp,"0");
echo "Se creo correctamente";
echo "<meta http-equiv='refresh' content='0;url=/frijolito/invernadero/#controles'>";
?>
