<?php require_once("procedures/conec.php");?>
<?php require_once("functions.php");?>
<?php session_start();?>
<form class="form-horizontal" action="" id="formCambiaPasswd" name="formCambiaPasswd">
	<p class="col-md-12 text-center">Cambiar contraseña</p>
	<div class="alert col-md-12 " id="alert"></div>
	<div class="form-group">
		<label for="pwdactual" class="col-sm-4 control-label">Contraseña actual</label>
		<div class="col-sm-8">
			<input class="form-control" type="password" name="pwdactual" id="pwdactual"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Contraseña nueva</label>
		<div class="col-sm-8">
			<input class="form-control" type="password" name="pwdnuevo1" id="pwdnuevo1"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Confirmar contraseña nueva</label>
		<div class="col-sm-8">
			<input class="form-control" type="password" name="pwdnuevo2" id="pwdnuevo2"/>
		</div>
	</div>
	<input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username'];?>"/>
	<div class="form-group">
		<div class="col-sm-8 col-sm-offset-4">
			<input type="button" class="btn btn-sm btn-primary" value="Cambiar contraseña" id="cambiar" onclick="cambiarPwd()"/>		
		</div>
	</div>
</form>