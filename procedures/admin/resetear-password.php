<?php
include("../conec.php");
conectar();
session_start();

$documento = $_POST["documento"];
$password = $_POST["password"];

$query = "UPDATE usuarios SET passwd = sha2('".$password."',512) WHERE cod_cajero=".$documento;
$result = mysql_query($query);

if(!$result){
	echo mysql_error();
}else{
	echo "OK";
}
?>