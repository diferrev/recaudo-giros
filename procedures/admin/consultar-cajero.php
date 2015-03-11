<?php
include("../conec.php");
conectar();

$documento = $_POST["documento"];
$query = "SELECT nombres,apellido1,apellido2 FROM cajeros WHERE documento = ".$documento;
$result = mysql_query($query) or die ("Problema con la consulta ".mysql_error());
$numrows = mysql_num_rows($result);

if($numrows == false){
	echo "NULL";
}
else{
	$row = mysql_fetch_array($result);
	$nombres = $row[0];
	$apellido1 = $row[1];
	$apellido2 = $row[2];
	echo $nombres." ".$apellido1." ".$apellido2;
}
?>