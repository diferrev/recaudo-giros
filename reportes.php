<?php 
ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
?>
<?php session_start();?>
<?php require("procedures/conec.php");?>
<?php require("functions.php");?>
	<div class="panel panel-default">
		<div class="panel-body">
			<p>REPORTE 1 - RECAUDO DE EFECTIVO POR PUNTO DE VENTA</p>
			<form class="form-horizontal" action="reports/recaudosporpuntos.php" method="post" name="genReport1" target="_blank">
				<input type="hidden" name="cedulacajero" id="cedulacajero" value="<?php echo $_SESSION["documento"];?>"/>
				<input type="hidden" name="nombrescajero" id="nombrescajero" value="<?php echo $_SESSION["nombres"];?> <?php echo $_SESSION["apellidos"];?>"/>
				<input type="hidden" name="centrodecosto" id="centrodecosto" value="<?php echo $_SESSION["centrodecosto"];?>"/>
				<input type="button" name="generar" value="GENERAR" class="btn btn-sm btn-primary" onclick="genReport1.submit()"/>		
			</form>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<p>REPORTE 2 - RECAUDO DE EFECTIVO POR TRANSACCIÓN</p>
			<form action="reports/recaudosportransaccion.php" method="post" name="genReport2" target="_blank">		
				<input type="hidden" name="cedulacajero" id="cedulacajero" value="<?php echo $_SESSION["documento"];?>"/>
				<input type="hidden" name="nombrescajero" id="nombrescajero" value="<?php echo $_SESSION["nombres"];?> <?php echo $_SESSION["apellidos"];?>"/>
				<input type="hidden" name="centrodecosto" id="centrodecosto" value="<?php echo $_SESSION["centrodecosto"];?>"/>
				<input type="button" name="generar" value="GENERAR" class="btn btn-sm btn-primary" onclick="genReport2.submit()"/>
			</form>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<p>REPORTE 3 - RECAUDO DE EFECTIVO DE TESORERÍA</p>
			<form action="reports/recaudosdetesoreria.php" method="post" name="genReport3" target="_blank">
				<div class="row">
				<div class="col-xs-10">
					<?php $fechaactual = date("Y-m-d");?>
					<input type="text" class="datepicker form-control" name="fecha"  value="<?php echo $fechaactual;?>"/>
				</div>
				<div class="col-xs-2">
				<input type="hidden" name="cedulacajero" id="cedulacajero" value="<?php echo $_SESSION["documento"];?>"/>
				<input type="hidden" name="nombrescajero" id="nombrescajero" value="<?php echo $_SESSION["nombres"];?> <?php echo $_SESSION["apellidos"];?>"/>
				<input type="hidden" name="centrodecosto" id="centrodecosto" value="<?php echo $_SESSION["centrodecosto"];?>"/>
				<input type="button" name="generar" value="GENERAR" class="btn btn-sm btn-primary" onclick="genReport3.submit()"/>
				</div>
				</div>
			</form>
		</div>
	</div>
	<?php
		$qtransacciones = "SELECT codigo,nombre FROM transacciones ORDER BY codigo";
		$transacciones = ejecutarQuery($qtransacciones);
	?>
	<div class="panel panel-default">
		<div class="panel-body">
			<p>REPORTE 4 - RECAUDO DE EFECTIVO POR CAJERO</p>
			<form class="form-horizontal" action="reports/recaudosporcajero.php" method="post" name="genReport4" target="_blank">
				<div class="row">
				<div class="col-xs-3">
					<input type="text" name="cedulafiltro" id="cedulafiltro" value="%" class="form-control"/>
				</div>
				<div class="col-xs-3">
					<input type="text" name="fecha" value="<?php echo $fechaactual;?>" class="datepicker form-control"/>
				</div>
				<div class="col-xs-4">
					<select class="form-control" name="transaccion" id="transaccion"> 
						<option value="%">- Tipo transacción</option>
					<?php while($transaccion = mysql_fetch_array($transacciones)){?>
						<option value="<?php echo $transaccion[0];?>"><?php echo $transaccion[0];?> - <?php echo $transaccion[1];?></option>
					<?php }?>
					</select>
				</div>
				<div class="col-xs-2">
					<input type="hidden" name="cedulacajero" id="cedulacajero" value="<?php echo $_SESSION["documento"];?>"/>
					<input type="hidden" name="nombrescajero" id="nombrescajero" value="<?php echo $_SESSION["nombres"];?> <?php echo $_SESSION["apellidos"];?>"/>
					<input type="hidden" name="centrodecosto" id="centrodecosto" value="<?php echo $_SESSION["centrodecosto"];?>"/>
					<input type="button" name="generar" value="GENERAR" class="btn btn-sm btn-primary" onclick="genReport4.submit()"/>
				</div>
				</div>
			</form>
		</div>
	</div>
<script type="text/javascript">
$(function() {
    $(".datepicker").datepicker({dateFormat: "yy-mm-dd"});
 });
</script>
