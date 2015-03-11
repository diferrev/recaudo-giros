<?php require_once("../procedures/conec.php")?>
<?php require_once("../functions.php")?>
<?php conectar();?>
<?php
	$documento = $_POST["documento"];
	$qcajero = "SELECT c.documento, c.nombres, c.apellido1, c.apellido2, c.cod_ccosto FROM cajeros c WHERE c.documento = ".$documento;
	$cajero = ejecutarQuery($qcajero);
	$cajero = mysql_fetch_array($cajero);
	
	$qcentros = "SELECT codigo, nombre FROM ccosto;";
	$centros = ejecutarQuery($qcentros);
?>
<h3 class="header_adminmodule">Editar cajero</h3>
<div id="alert" class="alert"></div>
<form class="form-horizontal" name="formActualizarCajero" id="formActualizarCajero">
	<div class="form-group">
		<label for="documento" class="col-md-3 col-sm-3 control-label">Documento</label>
		<div class="col-md-4 col-sm-4">
			<input type="text" name="documento" id="documento" class="form-control" value="<?php echo $cajero[0];?>" disabled="disabled"/>
		</div>
	</div>
	<div class="form-group">
		<label for="nombrescajero" class="col-md-3 col-sm-3 control-label">Nombres</label>
		<div class="col-md-8 col-sm-8">
			<input type="text" name="nombrecajero" id="nombrecajero" class="form-control" value="<?php echo $cajero[1];?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="apellidos" class="col-md-3 col-sm-3 control-label">Apellidos</label>
		<div class="col-md-4 col-sm-4">
			<input type="text" name="apellido1cajero" id="apellido1cajero" class="form-control" value="<?php echo $cajero[2];?>"/>
		</div>
		<div class="col-md-4 col-sm-4">
			<input type="text" name="apellido2cajero" id="apellido2cajero" class="form-control" value="<?php echo $cajero[3];?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="centrodecosto" class="col-md-3 col-sm-3 control-label">Centro de Costo</label>
		<div class="col-md-6 col-sm-6">
			<select name="centrodecosto" id="centrodecosto" class="form-control">
				<option value="NULL">- Seleccione centro de costo -</option>
			<?php while($centro = mysql_fetch_array($centros)){?>
			<?php if($centro[0] == $cajero[4]){?>
				<option value="<?php echo $centro[0];?>" selected="selected"><?php echo $centro[0];?> - <?php echo $centro[1];?></option>
			<?php }else{?>
				<option value="<?php echo $centro[0];?>"><?php echo $centro[0];?> - <?php echo $centro[1];?></option>
			<?php }}?>	
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
			<input type="button" class="btn btn-sm btn-success" value="Actualizar" name="actualizarcajero" id="actualizarcajero" onclick="actualizarCajero()">
			<input type="button" class="btn btn-sm btn-default" value="Cancelar" name="cancelar" id="cancelar" onclick="cargarContenido('#content-admin','admin/listado-cajeros.php')"/>
		</div>
	</div>
</form>