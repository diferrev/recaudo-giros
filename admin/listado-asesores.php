<?php require_once("../procedures/conec.php")?>
<?php require_once("../functions.php")?>
<?php conectar();?>
<?php
$rowsToShow = 15;
if(isset($_GET["pag"])){
	$rowsToBegin = ($_GET["pag"]-1)*$rowsToShow;
	$PageActive = $_GET["pag"];
}else{
	$rowsToBegin = 0;
	$PageActive = 1;
}
?>
<table class="table table-striped">
	<tr>
		<th>Documento</th>
		<th>Nombre y apellidos</th>
		<th>Estado</th>
		<th></th>
	</tr>
<?php
	$qasesores = "SELECT a.documento, CONCAT(a.nombres,' ',a.apellido1,' ',a.apellido2) AS nombresyapellidos, a.estado FROM asesores a ORDER BY a.nombres LIMIT $rowsToBegin, $rowsToShow";
	$asesores = ejecutarQuery($qasesores); 
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
<?php
$cantRows = mysql_num_rows(ejecutarQuery("SELECT * FROM asesores"));
$PrevPage = $PageActive - 1;
$NextPage = $PageActive + 1;
$LastPage = $cantRows/$rowsToShow;

$Res = $cantRows%$rowsToShow;
if($Res > 0) $LastPage = floor($LastPage) + 1;
?>
<ul class="pagination">
	<li><a onclick="Page('1')">&laquo;</a></li>
<?php if($PageActive > 1){?>
	<li><a onclick="Page('<?php echo $PrevPage;?>')">Anterior</a></li>
<?php }?>
<?php if($PageActive < $LastPage){?>
	<li><a onclick="Page('<?php echo $NextPage;?>')">Siguiente</a></li>
<?php }?>
	<li><a onclick="Page('<?php echo $LastPage;?>')">&raquo;</a></li>
</ul>