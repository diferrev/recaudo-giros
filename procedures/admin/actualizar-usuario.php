<?php
include("../conec.php");
conectar();
session_start();

$documento = $_POST["documento"];
$login = $_POST["login"];
$rol = $_POST["rol"];
$estado = $_POST["estado"];
$fechamodif = date("Y-m-d H:i:s");


$query = "UPDATE usuarios SET login='".$login."',cod_rol=".$rol.",estado='".$estado."',fechamodif='".$fechamodif."' WHERE login='".$login."'";
$result = mysql_query($query);

if(!$result){
	echo mysql_error();
}else{
	echo "OK";
}
?>