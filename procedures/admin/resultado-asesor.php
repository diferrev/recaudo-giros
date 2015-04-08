<?php require_once("../conec.php")?>
<?php conectar();?>
<?php $documento = $_POST["documento"];?>
<table class="table table-striped">
	<tr>
		<th>Documento</th>
		<th>Nombre y apellidos</th>
		<th>Estado</th>
		<th></th>
	</tr>
<?php
	$qasesores = "SELECT a.documento, CONCAT(a.nombres,' ',a.apellido1,' ',a.apellido2) AS nombresyapellidos, a.estado FROM asesores a WHERE a.documento = ".$documento." ORDER BY a.nombres";
	$asesores = mysql_query($qasesores); 
	while($asesor = mysql_fetch_array($asesores)){?>
	<tr>
		<td><?php echo $asesor[0];?></td>
		<td><?php echo $asesor[1];?></td>
		<td><?php echo $asesor[2];?></td>
		<td><a href="" onclick="editarAsesor(<?php echo $asesor[0];?>)"><span class="glyphicon glyphicon-pencil"></span></a></td>
	</tr>
	<?php 
	} ?>
</table>