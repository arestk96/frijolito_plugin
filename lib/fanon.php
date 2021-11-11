<?php
$ar=fopen("fan.txt","w") or die ("Error al crear el archivo");

fwrite($ar,"1");
echo "Se creo correctamente";
echo "<meta http-equiv='refresh' content='0;url=/frijolito/invernadero/#controles'>";
?>
