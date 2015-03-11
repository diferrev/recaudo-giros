<?php
include("../conec.php");
conectar();
session_start();

$documento = $_POST["documento"];
$login = $_POST["login"];
$rol = $_POST["rol"];
$estado = $_POST["estado"];
$fechamodif = date("Y-m-d H:i:s");
$password = $_POST["password"];

$query = "INSERT INTO usuarios (login,passwd,estado,cod_rol,fechamodif,cod_cajero)
VALUES ('".$login."',sha2('".$password."',512),'".$estado."',".$rol.",'".$fechamodif."',".$documento.")";
$result = mysql_query($query);

if(!$result){
	echo mysql_error();
}else{
	echo "OK";
}
?>