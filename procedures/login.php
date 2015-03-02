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
	$query2 = "SELECT documento,nombres,apellido1,apellido2,cod_ccosto FROM cajeros WHERE documento =".$cedula;
	$result2 = mysql_query($query2);
	$datosCajero = mysql_fetch_array($result2);
	
	$_SESSION["documento"] = $datosCajero[0];
	$_SESSION["nombres"] = $datosCajero[1];
	$_SESSION["apellidos"] = $datosCajero[2]." ".$datosCajero[3];
	$_SESSION["centrodecosto"] = $datosCajero[4];
	$_SESSION["username"] = $username;
	
	
	echo "OK";
}

;?>