<?php require_once("header.php");?>

<section class="content">
	<div class="container">
		<form class="form-horizontal" action="">
			<div class="form-group">
				<label for="puntodeventa" class="col-sm-3 control-label">Punto de Venta</label>
				<div class="col-sm-9">
					<select class="form-control" name="puntodeventa" id="puntodeventa">
						<option value="2651">MEGALOCAL 1 C.NORTE</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="centrodecosto" class="col-sm-3 control-label">Centro de Costo</label>
				<div class="col-sm-9">
					<input type="text" readonly="readonly" class="form-control" name="centrodecosto" id="centrodecosto" value="1081 - CARTAGO">
				</div>
			</div>
			
			<div class="form-group">
				<label for="cedulaasesor" class="col-sm-3 control-label">Colocador</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="cedulaasesor" id="cedulaasesor">
				</div>
				<div class="col-sm-6">
					<input type="text" readonly="readonly" class="form-control" name="nombreasesor" id="nombreasesor" value="LUIS ALVARO RINCON ECHAVARRIA">
				</div>
			</div>
			
			<div class="form-group">
				<label for="transaccion" class="col-sm-3 control-label">Transacción</label>
				<div class="col-sm-9">
					<select class="form-control" name="transaccion" id="transaccion">
						<option value="1">1 - PUNTOS - RECAUDO DEL DIA</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="valor" class="col-sm-3 control-label">Valor</label>
				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" class="form-control" name="valor" onkeyup="formatearValor(this)"/>
					</div>
				</div>
				<label for="consecutivo" class="col-sm-2 control-label">Consecutivo</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="consecutivo"/>
				</div>
			</div>
			
			<div class="form-group">
				<label for="observacion" class="col-sm-3 control-label">Observaciones</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="observacion"/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3">
					<input type="button" class="btn btn-success" value="Registrar Pago"/>
					<input type="button" class="btn btn-primary" value="Reversar Pago"/>
					<input type="button" class="btn btn-primary" value="Reimprimir"/>
					<input type="button" class="btn btn-primary" value="Limpiar"/>
				</div>
			</div>
		</form>
	</div>
</section>

<?php require_once("footer.php");?>