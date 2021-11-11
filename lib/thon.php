<?php
$ar=fopen("th.txt","w") or die ("Error al crear el archivo");
$motor=fopen("motor.txt","w") or die ("Error al crear el archivo");

$ok = fgets($motor);

if($ok == 1){
	fwrite($ar,"0");
}elseif($ok == "0"){
	fwrite($ar,"1");
}

echo "Se creo correctamente";
echo "<meta http-equiv='refresh' content='0;url=/frijolito/invernadero/#controles'>";
?>
