<?php require_once("../procedures/conec.php")?>
<?php require_once("../functions.php")?>
<?php conectar();?>
<?php
	$documento = $_POST["documento"];
	$qasesor = "SELECT a.documento, a.nombres, a.apellido1, a.apellido2, a.estado FROM asesores a WHERE a.documento = ".$documento;
	$asesor = ejecutarQuery($qasesor);
	$asesor = mysql_fetch_array($asesor);
	
?>
<h3 class="header_adminmodule">Editar asesor</h3>
<div id="alert" class="alert"></div>
<form class="form-horizontal" name="formActualizarAsesor" id="formActualizarAsesor">
	<div class="form-group">
		<label for="documento" class="col-md-3 col-sm-3 control-label">Documento</label>
		<div class="col-md-4 col-sm-4">
			<input type="text" name="documento" id="documento" class="form-control" value="<?php echo $asesor[0];?>" disabled="disabled"/>
		</div>
	</div>
	<div class="form-group">
		<label for="nombrescajero" class="col-md-3 col-sm-3 control-label">Nombres</label>
		<div class="col-md-8 col-sm-8">
			<input type="text" name="nombreasesor" id="nombreasesor" class="form-control" value="<?php echo $asesor[1];?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="apellidos" class="col-md-3 col-sm-3 control-label">Apellidos</label>
		<div class="col-md-4 col-sm-4">
			<input type="text" name="apellido1asesor" id="apellido1asesor" class="form-control" value="<?php echo $asesor[2];?>"/>
		</div>
		<div class="col-md-4 col-sm-4">
			<input type="text" name="apellido2asesor" id="apellido2asesor" class="form-control" value="<?php echo $asesor[3];?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-md-3 col-sm-3 control-label">Estado</label>
		<div class="col-md-6 col-sm-6">
			<select name="estado" id="estado" class="form-control">
			<?php if($asesor[4] == "A"){?>
				<option value="A" selected="selected">ACTIVO</option>
				<option value="I">INACTIVO</option>
			<?php }else{?>
				<option value="A">ACTIVO</option>
				<option value="I" selected="selected">INACTIVO</option>
			<?php }?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
			<input type="button" class="btn btn-sm btn-success" value="Actualizar" name="actualizarcajero" id="actualizarasesor" onclick="actualizarAsesor()">
			<input type="button" class="btn btn-sm btn-default" value="Cancelar" name="cancelar" id="cancelar" onclick="cargarContenido('#content-admin','admin/listado-asesores.php')"/>
		</div>
	</div>
</form>