<?php

include("conec.php");
conectar();
	
$fecha = date("Y-m-d");
$fechayhora = date("Y-m-d H:i:s");

$fechayhorapc = $_POST["fechayhorapc"];
$cedulacajero = $_POST["cedulacajero"];
$cedulacolocador = $_POST["cedulacolocador"];
$puntodeventa = $_POST["puntodeventa"];
$transaccion = $_POST["transaccion"];
$consecutivo = $_POST["consecutivo"];
$valor = $_POST["valor"];
$observaciones = $_POST["observaciones"];

$query = "INSERT INTO registros (fecha,cod_asesor,cod_punto,cod_trans,num_mvto,valor,cod_cajero,observaciones,fechayhora,fechayhorapc) VALUES ('".$fecha."',".$cedulacolocador.",".$puntodeventa.",".$transaccion.",".$consecutivo.",".$valor.",".$cedulacajero.",'".$observaciones."','".$fechayhora."','".$fechayhorapc."')";

$result = mysql_query($query);

$error = mysql_error();

if(!$result){
	echo "ERROR: ".$error;
}else{
	echo "OK";
}

;?>