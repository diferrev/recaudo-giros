<?php require_once("header.php");?>

<section class="content">
	<div class="container">
		<form class="form-horizontal" action="" id="formRecaudo" name="formRecaudo">
			<!--CAMPO DE PUNTO DE VENTA-->
			<div class="form-group">
				<label for="puntodeventa" class="col-sm-3 control-label">Punto de Venta</label>
				<div class="col-sm-9">
					<select class="form-control" name="puntodeventa" id="puntodeventa" onChange="consultarCcosto()">
						<option value="2651">MEGALOCAL 1 C.NORTE</option>
						<option value="2652">MEGALOCAL 2 C.NORTE</option>
						<option value="1116">RESTAURANTE LA CASONA</option>
					</select>
				</div>
			</div>
			<!--CAMPO DE CENTRO DE COSTO, SE AUTORELLENA SEGUN EL PUNTO DE VENTA-->
			<div class="form-group">
				<label for="centrodecosto" class="col-sm-3 control-label">Centro de Costo</label>
				<div class="col-sm-9">
					<input type="text" readonly="readonly" class="form-control" name="centrodecosto" id="centrodecosto">
				</div>
			</div>
			<!--CAMPO CEDULA DEL COLOCADOR-->
			<div class="form-group">
				<label for="cedulaasesor" class="col-sm-3 control-label">Colocador</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="cedulaasesor" id="cedulaasesor">
				</div>
				<!--CAMBO DEL NOMBRE Y APELLIDOS DEL COLOCADOR SE AUTORELLENA SEGUN LA CEDULA-->
				<div class="col-sm-6">
					<input type="text" readonly="readonly" class="form-control" name="nombreasesor" id="nombreasesor" value="LUIS ALVARO RINCON ECHAVARRIA">
				</div>
			</div>
			<!--LISTA DE TIPO DE TRANSACCION-->
			<div class="form-group">
				<label for="transaccion" class="col-sm-3 control-label">Transacción</label>
				<div class="col-sm-9">
					<select class="form-control" name="transaccion" id="transaccion">
						<option value="1">1 - PUNTOS - RECAUDO DEL DIA</option>
					</select>
				</div>
			</div>
			<!--CAMPO DE VALOR DE LA TRANSACCION-->
			<div class="form-group">
				<label for="valor" class="col-sm-3 control-label">Valor</label>
				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" class="form-control" name="valor" onkeyup="formatearValor(this)"/>
					</div>
				</div>
				<!--CAMPO DE CONSECUTIVO QUE SE AUTORELLENA EN EL EVENTO ONCHANGE DE TRANSACCION-->
				<label for="consecutivo" class="col-sm-2 control-label">Consecutivo</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="consecutivo"/>
				</div>
			</div>
			<!--CAMPO DE OBSERVACIONES PARA LA TRANSACCION-->
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