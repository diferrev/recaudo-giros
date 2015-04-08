<?php
include("../conec.php");
conectar();
session_start();

$cedulaasesor = $_POST["cedulaasesor"];
$nombresasesor = $_POST["nombresasesor"];
$apellido1asesor = $_POST["apellido1asesor"];
$apellido2asesor = $_POST["apellido2asesor"];
$estado = $_POST["estado"];

$query = "INSERT INTO asesores (documento,nombres,apellido1,apellido2,estado)
VALUES (".$cedulaasesor.",'".$nombresasesor."','".$apellido1asesor."','".$apellido2asesor."','".$estado."')";
$result = mysql_query($query);

if(!$result){
	echo mysql_error();
}else{
	echo "OK";
}
?>