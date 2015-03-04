<?php session_start();?>

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
				<input type="hidden" name="cedulacajero" id="cedulacajero" value="<?php echo $_SESSION["documento"];?>"/>
				<input type="hidden" name="nombrescajero" id="nombrescajero" value="<?php echo $_SESSION["nombres"];?> <?php echo $_SESSION["apellidos"];?>"/>
				<input type="hidden" name="centrodecosto" id="centrodecosto" value="<?php echo $_SESSION["centrodecosto"];?>"/>
				<input type="button" name="generar" value="GENERAR" class="btn btn-sm btn-primary" onclick="genReport3.submit()"/>		
			</form>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<p>REPORTE 4 - RECAUDO DE EFECTIVO POR CAJERO</p>
			<form class="form-horizontal" action="reports/recaudosporcajero.php" method="post" name="genReport4" target="_blank">
				<div class="row">
				<div class="col-xs-10">
					<input type="text" name="cedulafiltro" id="cedulafiltro" value="%" class="form-control"/>
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
