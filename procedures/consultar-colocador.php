<?php 
include("conec.php");
conectar();

$cedulacolocador = $_POST["cedulacolocador"];

$query = "SELECT a.nombres,a.apellido1,a.apellido2 FROM asesores a WHERE a.documento = ".$cedulacolocador;

$result = mysql_query($query) or die ("Problema con la consulta ".mysql_error());

$row = mysql_fetch_array($result);

$nombres = $row[0];
$apellido1 = $row[1];
$apellido2 = $row[2];

echo $nombres." ".$apellido1." ".$apellido1;

?>