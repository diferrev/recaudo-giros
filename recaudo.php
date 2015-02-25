<?php require_once("header.php");?>

<section class="content">
	<div class="container">
		<div id="activarImpresora" class="alert alert-warning text-center" role="alert">
			Recuerde activar la impresora antes de empezar a recaudar  <button class="btn btn-sm btn-primary" onclick="useDefaultPrinter()">Activar Impresora</button>
		</div>
		<div id="alert" class="alert " role="alert"></div>
		<form class="form-horizontal" action="" id="formRecaudo" name="formRecaudo">
			<!--CAMPO DE PUNTO DE VENTA-->
			<div class="form-group">
				<label for="puntodeventa" class="col-sm-3 control-label">Punto de Venta</label>
				<div class="col-sm-9">
					<?php $query = "SELECT s.codigo, s.nombre FROM sucursal s ORDER BY s.nombre"; ?>
					<?php $puntosdeventa = ejecutarQuery($query);?>
					
					<select class="form-control" name="puntodeventa" id="puntodeventa" onChange="consultarCcosto()">
						<option value="NULL">- SELECCIONE EL PUNTO DE VENTA -</option>
					<?php while($puntodeventa = mysql_fetch_array($puntosdeventa)){?>
						<option value="<?php echo $puntodeventa[0];?>"><?php echo $puntodeventa[1];?></option>
					<?php }?>
					</select>
				</div>
			</div>
			<!--CAMPO DE CENTRO DE COSTO, SE AUTORELLENA SEGUN EL PUNTO DE VENTA-->
			<div class="form-group">
				<label for="centrodecosto" class="col-sm-3 control-label">Centro de Costo</label>
				<div class="col-sm-9">
					<input type="text" readonly="readonly" class="form-control" name="centrodecosto" id="centrodecosto" placeholder="Código y nombre del centro de costo">
				</div>
			</div>
			<!--CAMPO CEDULA DEL COLOCADOR-->
			<div class="form-group">
				<label for="cedulacolocador" class="col-sm-3 control-label">Colocador</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="cedulacolocador" id="cedulacolocador" placeholder="N. de Documento" onkeyup="validaNumero(this)" onChange="consultarColocador()">
				</div>
				<!--CAMBO DEL NOMBRE Y APELLIDOS DEL COLOCADOR SE AUTORELLENA SEGUN LA CEDULA-->
				<div class="col-sm-6">
					<input type="text" readonly="readonly" class="form-control" name="nombrescolocador" id="nombrescolocador" placeholder="Nombres y apellidos del colocador">
				</div>
			</div>
			<!--LISTA DE TIPO DE TRANSACCION-->
			<div class="form-group">
				<label for="transaccion" class="col-sm-3 control-label">Transacción</label>
				<div class="col-sm-9">
				
					<?php $query = "SELECT t.codigo, t.nombre FROM transacciones t"; ?>
					<?php $transacciones = ejecutarQuery($query);?>
					
					<select class="form-control" name="transaccion" id="transaccion" onChange="numConsecutivo()">
						<option value="0">- SELECCIONE EL TIPO DE TRANSACCION -</option>
						<?php while($transaccion = mysql_fetch_array($transacciones)){?>
						<option value="<?php echo $transaccion[0];?>"><?php echo $transaccion[0];?> - <?php echo $transaccion[1];?></option>
						<?php }?>
					</select>
				</div>
			</div>
			<!--CAMPO DE VALOR DE LA TRANSACCION-->
			<div class="form-group">
				<label for="valor" class="col-sm-3 control-label">Valor</label>
				<div class="col-sm-4">
					<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" class="form-control" name="valor" id="valor" placeholder="0" onkeyup="formatearValor(this)" onfocus="validaTransaccion()"/>
					</div>
				</div>
				<!--CAMPO DE CONSECUTIVO QUE SE AUTORELLENA EN EL EVENTO ONCHANGE DEL CAMPO TRANSACCION-->
				<label for="consecutivo" class="col-sm-2 control-label">Consecutivo</label>
				<div class="col-sm-3">
					<input type="text" readonly="readonly" class="form-control" name="consecutivo" id="consecutivo"/>
				</div>
			</div>
			<!--CAMPO DE OBSERVACIONES PARA LA TRANSACCION-->
			<div class="form-group">
				<label for="observaciones" class="col-sm-3 control-label">Observaciones</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="observaciones" id="observaciones"/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3">
					<input type="button" class="btn btn-sm btn-success disabled" value="Registrar Pago" id="registrar" onclick="registrarRecaudo()"/>
					<input type="button" class="btn btn-sm btn-warning disabled" value="Reversar Pago" id="reversar" onclick="reversarRecaudo()"/>
					<input type="button" class="btn btn-sm btn-primary disabled" value="Reversar Últ. Pago" id="reversarultimo" onclick="reversarUltimoRecaudo()"/>
					<input type="button" class="btn btn-sm btn-primary disabled" value="Reimprimir" id="reimprimir" onclick="reimprimirRecibo()"/>
					<input type="button" class="btn btn-sm btn-primary" value="Limpiar" id="limpiar" onclick="limpiaFormulario('#formRecaudo')"/>
				</div>
			</div>
		</form>
	</div>
</section>
<script type="text/javascript" src="js/deployJava.js"></script>
<script type="text/javascript" src="js/javaprinter.js"></script>
<?php require_once("footer.php");?>