<?php
$archivo = fopen ("fechas.txt", "r");

$num_lineas = 0;

while (!feof ($archivo)) {
    if ($linea = fgets($archivo)){
       $num_lineas++;
    }
}
fclose ($archivo);

$fechas = fopen("fechas.txt","r");
$temp1 = fopen ("datos.txt", "r");
$temp2 = fopen ("datos2.txt", "r");

echo "<center>";
echo "<table border='2'>";
echo "<th>Fechas</th>";
echo "<th> Sensor 1 Temperatura y Humedad</th>";
echo "<th> Sensor 2 Temperatura y Humedad</th>";
echo "<tr>";

for($i=1;$i<=$num_lineas;$i++)
{
	$lf = fgets($fechas);
	$tmp1 = fgets($temp1);
	$tmp2 = fgets($temp2);

	echo "<tr>";

	echo "<td>";
	echo $lf;
	echo "</td>";

	echo "<td>";
	echo $tmp1;
	echo "</td>";

	echo "<td>";
	echo $tmp2;
	echo "</td>";

	echo "</tr>";
}
echo "</table>";
echo "</center>";

if($num_lineas >= 250){
	unlink("datos.txt");
	unlink("datos2.txt");
	unlink("fechas.txt");
}

echo "<meta http-equiv='refresh' content='0;url=/frijolito/wp-content/plugins/frijolito-plugin/lib/tabla.php'>";
?>
