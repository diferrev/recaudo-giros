<?php require_once("../procedures/conec.php")?>
<?php require_once("../functions.php")?>
<?php conectar();?>
<?php
	$qroles = "SELECT codigo,nombre FROM roles";
	$roles = ejecutarQuery($qroles);
?>
<h3 class="header_adminmodule">Crear nuevo usuario</h3>
<div id="alert" class="alert"></div>
<form class="form-horizontal" name="formCrearUsuario" id="formCrearUsuario">
	<div class="form-group">
		<label for="" class="col-md-3 col-sm-3 control-label">Cajero</label>
		<div class="col-md-3 col-sm-3">
			<input type="text" class="form-control" name="documento" id="documento" onkeyup="validaNumero(this)" onChange="consultarCajero()"/>
		</div>
		<div class="col-md-6 col-sm-6">
			<input type="text" class="form-control" name="nombresyapellidos" id="nombresyapellidos" disabled="disabled"/>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-md-3 col-sm-3 control-label">Login</label>
		<div class="col-md-3 col-sm-3">
			<input type="text" class="form-control" name="login" id="login" />
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-md-3 col-sm-3 control-label">Rol</label>
		<div class="col-md-6 col-sm-6">
			<select name="rol" id="rol" class="form-control">
				<option value="NULL">- Seleccione el rol -</option>
			<?php while($rol = mysql_fetch_array($roles)){?>
				<option value="<?php echo $rol[0];?>"><?php echo $rol[0];?> - <?php echo $rol[1];?></option>
			<?php }?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-md-3 col-sm-3 control-label">Estado</label>
		<div class="col-md-6 col-sm-6">
			<select name="estado" id="estado" class="form-control">
				<option value="A">ACTIVO</option>
				<option value="I">INACTIVO</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
			<input type="button" class="btn btn-sm btn-success" value="Crear" onclick="crearUsuario()">
			<input type="button" class="btn btn-sm btn-default" value="Cancelar" onclick="cargarContenido('#content-admin','admin/listado-usuarios.php')"/>
		</div>
	</div>
</form>