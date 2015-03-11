<?php
include("../conec.php");
conectar();
session_start();

$cedulacajero = $_POST["cedulacajero"];
$nombrescajero = $_POST["nombrescajero"];
$apellido1cajero = $_POST["apellido1cajero"];
$apellido2cajero = $_POST["apellido2cajero"];
$centrodecosto = $_POST["centrodecosto"];

$query = "UPDATE cajeros SET nombres='".$nombrescajero."', apellido1='".$apellido1cajero."', apellido2='".$apellido2cajero."', cod_ccosto=".$centrodecosto." WHERE documento=".$cedulacajero;
$result = mysql_query($query);

if(!$result){
	echo mysql_error();
}else{
	echo "OK";
}
?>