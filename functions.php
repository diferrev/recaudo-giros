<?php 
function ejecutarQuery($q)
{
	conectar();
	$result = mysql_query($q) or die ("No se pudo ejecutar la consulta ".mysql_error());
	return $result;
}
?>