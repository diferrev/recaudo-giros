<?php
include("../conec.php");
conectar();
session_start();

$cedulacajero = $_POST["cedulacajero"];
$nombrescajero = $_POST["nombrescajero"];
$apellido1cajero = $_POST["apellido1cajero"];
$apellido2cajero = $_POST["apellido2cajero"];
$centrodecosto = $_POST["centrodecosto"];

$query = "INSERT INTO cajeros (documento,nombres,apellido1,apellido2,cod_ccosto)
VALUES (".$cedulacajero.",'".$nombrescajero."','".$apellido1cajero."','".$apellido2cajero."',".$centrodecosto.")";
$result = mysql_query($query);

if(!$result){
	echo mysql_error();
}else{
	echo "OK";
}
?>