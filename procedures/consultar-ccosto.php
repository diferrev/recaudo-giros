<?php 

include("conec.php");
conectar();

$puntodeventa = $_POST["puntodeventa"];

$query = "SELECT c.codigo, c.nombre FROM sucursal s INNER JOIN ccosto c ON s.cod_ccosto = c.codigo WHERE s.codigo = ".$puntodeventa;

$result = mysql_query($query) or die ("Problema con la consulta ".mysql_error());

$row = mysql_fetch_array($result);

$codigoccosto = $row[0];
$nombreccosto = $row[1];

echo $codigoccosto." - ".$nombreccosto;

?>