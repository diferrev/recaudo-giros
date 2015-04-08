<?php require_once("../procedures/conec.php")?>
<?php require_once("../functions.php")?>
<h3 class="header_adminmodule">Consultar asesor</h3>
<div id="alert" class="alert"></div>
<form class="form-horizontal" name="formConsultarAsesor" id="formConsultarAsesor">
	<div class="form-group">
		<label for="documento" class="col-md-2 col-sm-2 control-label">Documento</label>
		<div class="col-md-5 col-sm-5">
			<input type="text" name="documento" id="documento" class="form-control" placeholder="Número de documento"/>
		</div>
		<div class="col-md-5 col-sm-5">
			<button class="btn btn-sm btn-primary" name="crearasesor" id="crearasesor" onclick="consultarAsesor()">Consultar</button>
		</div>
	</div>
</form>
<div id="resultado-asesor">

</div>