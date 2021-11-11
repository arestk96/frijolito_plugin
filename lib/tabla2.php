<?php
$archivo = fopen ("fechassuelo.txt", "r");

$num_lineas = 0;

while (!feof ($archivo)) {
    if ($linea = fgets($archivo)){
       $num_lineas++;
    }
}
fclose ($archivo);

$fechas = fopen("fechassuelo.txt","r");
$temp1 = fopen ("suelo.txt", "r");
$temp2 = fopen ("nivel.txt", "r");

echo "<center>";
echo "<table border='2'>";
echo "<th>Fechas</th>";
echo "<th> Humedad Suelo Valor Analogo </th>";
echo "<th> Nivel del Agua Tanque % </th>";
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
	if($tmp2 >= 40.00 ){
	echo "Llenar Contenedor de Agua";
	}elseif ($tmp2 <= 40.00 ){
	echo "Contenedor con Agua";
	}
	//echo $tmp2;
	echo "</td>";

	echo "</tr>";
}
echo "</table>";
echo "</center>";

if($num_lineas >= 250){
	unlink("fechassuelo.txt");
	unlink("suelo.txt");
	unlink("nivel.txt");
}

echo "<meta http-equiv='refresh' content='0;url=/frijolito/wp-content/plugins/frijolito-plugin/lib/tabla2.php'>";
?>
