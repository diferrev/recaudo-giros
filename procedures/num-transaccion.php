<?php

include("conec.php");
conectar();
	
$fechaactual = "2013-02-14";
$cedulacolocador = $_POST["cedulacolocador"];
$puntodeventa = $_POST["puntodeventa"];
$transaccion = $_POST["transaccion"];

$query = "select case when num_trans=0 then num_trans+1 else num_trans+1 end as num_registro from (select count(*) as num_trans from registros where fecha = '".$fechaactual."' and cod_asesor = ".$cedulacolocador." and cod_punto = ".$puntodeventa." and cod_trans = ".$transaccion.") as temporal";

$result = mysql_query($query) or die ("Problema con la consulta ".mysql_error());

$row = mysql_fetch_array($result);

$numregistro = $row["num_registro"];

echo $numregistro;
	
;?>