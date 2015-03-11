<?php
include("../conec.php");
conectar();

$documento = $_POST["documento"];
$query = "SELECT * FROM usuarios WHERE cod_cajero = ".$documento;
$result = mysql_query($query) or die ("Problema con la consulta ".mysql_error());
$numrows = mysql_num_rows($result);

if($numrows > 0){
	echo "EXISTE";
}
else{
	echo "NO EXISTE";
}
?>