<?php require_once("../procedures/conec.php")?>
<?php require_once("../functions.php")?>
<?php conectar();?>
<?php
	$qcajeros = "SELECT c.documento, CONCAT(c.nombres,' ',c.apellido1,' ',c.apellido2) AS nombresyapellidos,cc.nombre FROM cajeros c, ccosto cc WHERE c.cod_ccosto = cc.codigo ORDER BY c.nombres";
	$cajeros = ejecutarQuery($qcajeros);
?>
<h3 class="header_adminmodule">Listado de cajeros</h3>
<div id="alert" class="alert"></div>
<table class="table table-hover table-condensed">
	<tr>
		<th>Documento</th>
		<th>Nombre y apellidos</th>
		<th>Centro de costo</th>
		<th></th>
	</tr>
<?php while($cajero = mysql_fetch_array($cajeros)){?>
	<tr>
		<td><?php echo $cajero[0];?></td>
		<td><?php echo $cajero[1];?></td>
		<td><?php echo $cajero[2];?></td>
		<td><a href="" onclick="editarCajero(<?php echo $cajero[0];?>)"><span class="glyphicon glyphicon-pencil"></span></a></td>
	</tr>
<?php } ?>
</table>