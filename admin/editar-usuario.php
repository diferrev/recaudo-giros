<?php require_once("../procedures/conec.php")?>
<?php require_once("../functions.php")?>
<?php conectar();?>
<?php
	$documento = $_POST["documento"];
	$qusuario = "SELECT u.cod_cajero, CONCAT(c.nombres,' ',c.apellido1,' ',c.apellido2) AS nombresyapellidos, u.login, u.cod_rol, u.estado FROM usuarios u, cajeros c WHERE u.cod_cajero = c.documento AND u.cod_cajero = ".$documento;
	$usuario = ejecutarQuery($qusuario);
	$usuario = mysql_fetch_array($usuario);
	
	$qroles = "SELECT codigo,nombre FROM roles";
	$roles = ejecutarQuery($qroles);
?>
<h3 class="header_adminmodule">Editar usuario</h3>
<div id="alert" class="alert"></div>
<form class="form-horizontal" name="formActualizarUsuario" id="formActualizarUsuario">
	<div class="form-group">
		<label for="" class="col-md-3 col-sm-3 control-label">Cajero</label>
		<div class="col-md-3 col-sm-3">
			<input type="text" class="form-control" name="documento" id="documento" disabled="disabled" value="<?php echo $usuario[0];?>"/>
		</div>
		<div class="col-md-6 col-sm-6">
			<input type="text" class="form-control" name="nombresyapellidos" id="nombresyapellidos" disabled="disabled" value="<?php echo $usuario[1];?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-md-3 col-sm-3 control-label">Login</label>
		<div class="col-md-3 col-sm-3">
			<input type="text" class="form-control" name="login" id="login" value="<?php echo $usuario[2];?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-md-3 col-sm-3 control-label">Rol</label>
		<div class="col-md-6 col-sm-6">
			<select name="rol" id="rol" class="form-control">
				<option value="NULL">- Seleccione el rol -</option>
			<?php while($rol = mysql_fetch_array($roles)){?>
			<?php if($rol[0] == $usuario[3]){?>
				<option value="<?php echo $rol[0];?>" selected="selected"><?php echo $rol[0];?> - <?php echo $rol[1];?></option>
			<?php }else{?>
				<option value="<?php echo $rol[0];?>"><?php echo $rol[0];?> - <?php echo $rol[1];?></option>
			<?php }}?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-md-3 col-sm-3 control-label">Estado</label>
		<div class="col-md-6 col-sm-6">
			<select name="estado" id="estado" class="form-control">
			<?php if($usuario[4] == "A"){?>
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
			<input type="button" class="btn btn-sm btn-success" value="Actualizar" onclick="actualizarUsuario()">
			<input type="button" class="btn btn-sm btn-default" value="Cancelar" onclick="cargarContenido('#content-admin','admin/listado-usuarios.php')"/>
		</div>
	</div>
</form>