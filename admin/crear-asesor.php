<?php require_once("../procedures/conec.php")?>
<?php require_once("../functions.php")?>
<?php conectar();?>

<h3 class="header_adminmodule">Crear nuevo asesor</h3>
<div id="alert" class="alert"></div>
<form class="form-horizontal" name="formCrearAsesor" id="formCrearAsesor">
	<div class="form-group">
		<label for="documento" class="col-md-3 col-sm-3 control-label">Documento</label>
		<div class="col-md-4 col-sm-4">
			<input type="text" name="documento" id="documento" class="form-control" placeholder="Número de documento"/>
		</div>
	</div>
	<div class="form-group">
		<label for="nombrescajero" class="col-md-3 col-sm-3 control-label">Nombres</label>
		<div class="col-md-8 col-sm-8">
			<input type="text" name="nombreasesor" id="nombreasesor" class="form-control" placeholder="Nombres completos"/>
		</div>
	</div>
	<div class="form-group">
		<label for="apellidos" class="col-md-3 col-sm-3 control-label">Apellidos</label>
		<div class="col-md-4 col-sm-4">
			<input type="text" name="apellido1asesor" id="apellido1asesor" class="form-control" placeholder="Primer apellido"/>
		</div>
		<div class="col-md-4 col-sm-4">
			<input type="text" name="apellido2asesor" id="apellido2asesor" class="form-control" placeholder="Segundo apellido"/>
		</div>
	</div>
	<div class="form-group">
		<label for="estado" class="col-md-3 col-sm-3 control-label">Estado</label>
		<div class="col-md-4 col-sm-4">
			<select name="estado" id="estado" class="form-control">
				<option value="A">ACTIVO</option>
				<option value="I">INACTIVO</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
			<input type="button" class="btn btn-sm btn-success" value="Crear" name="crearasesor" id="crearasesor" onclick="crearAsesor()">
			<input type="button" class="btn btn-sm btn-default" value="Cancelar" name="cancelar" id="cancelar" onclick="cargarContenido('#content-admin','admin/listado-asesores.php')"/>
		</div>
	</div>
</form>