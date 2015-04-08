<?php
include("../conec.php");
conectar();
session_start();

$cedulaasesor = $_POST["cedulaasesor"];
$nombresasesor = $_POST["nombresasesor"];
$apellido1asesor = $_POST["apellido1asesor"];
$apellido2asesor = $_POST["apellido2asesor"];
$estado = $_POST["estado"];

$query = "UPDATE asesores SET nombres='".$nombresasesor."', apellido1='".$apellido1asesor."', apellido2='".$apellido2asesor."', estado='".$estado."' WHERE documento=".$cedulaasesor;
$result = mysql_query($query);

if(!$result){
	echo mysql_error();
}else{
	echo "OK";
}
?>