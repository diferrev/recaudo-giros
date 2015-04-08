<?php
include("conec.php");
conectar();
session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$query1 = "SELECT login,passwd,cod_cajero FROM usuarios WHERE login='".$username."' AND passwd = sha2('".$password."',512)";
$result1 = mysql_query($query1);
$datosLogin = mysql_fetch_array($result1);

$cedula = $datosLogin["cod_cajero"];

if(!$result1){
	echo "ERROR";
}else{
	$query2 = "SELECT c.documento,c.nombres,c.apellido1,c.apellido2,c.cod_ccosto,u.cod_rol FROM cajeros c, usuarios u WHERE c.documento = u.cod_cajero AND documento =".$cedula;
	$result2 = mysql_query($query2);
	$datosCajero = mysql_fetch_array($result2);
	
	$_SESSION["documento"] = $datosCajero[0];
	$_SESSION["nombres"] = $datosCajero[1];
	$_SESSION["apellidos"] = $datosCajero[2]." ".$datosCajero[3];
	$_SESSION["centrodecosto"] = $datosCajero[4];
	$_SESSION["username"] = $username;
	$_SESSION["rol"] = $datosCajero[5];
	
	echo "OK;".$datosCajero[0].";".$datosCajero[1].";".$datosCajero[2].";".$datosCajero[3].";".$datosCajero[4].";".$username.";".$datosCajero[5];
}

;?>