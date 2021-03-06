<?php
session_start();
require_once ("../procedures/conec.php");
require_once ("../lib/fpdf/fpdf.php");
class PDF extends FPDF
{
	function Header()
	{
		$fecha = $_POST["fecha"];
		$fechageneracion = date("Y-m-d H:i:s");
		$cedulacajero = $_POST["cedulacajero"];
		$nombrescajero = $_POST["nombrescajero"];
		
		$this->SetFont("Arial","B",8);
		$this->Cell(0,5,"SUPER SERVICIOS DEL VALLE S.A.",0,0,"C");
		$this->Ln();
		$this->Cell(0,5,utf8_decode("REPORTE 3 - RECAUDO DE EFECTIVO DE TESORERÍA "),0,0,"C");
		$this->Ln(7);
		$this->SetFont("Arial","",8);
		$this->Cell(30,5,"Fecha del reporte: ",0,0,"L");
		$this->Cell(30,5,$fecha,0,0,"L");
		$this->SetFont("Arial","B",8);
		$this->Cell(128,5,utf8_decode("Página ").$this->PageNo()." de {nb}",0,0,"R");
		$this->Ln(4);
		$this->SetFont("Arial","",8);
		$this->Cell(30,5,"Cajero ",0,0,"L");
		$this->Cell(30,5,$cedulacajero." ".$nombrescajero,0,0,"L");
		$this->Ln(4);
		$this->Cell(30,5,utf8_decode("Fecha de generación "),0,0,"L");
		$this->Cell(30,5,$fechageneracion,0,0,"L");
		$this->Ln(7);
		$this->SetFont("Arial","B",8);
		$this->Cell(45,5,"NOMBRE PUNTO",0,0,"C");
		$this->Cell(20,5,"COD ASESOR",0,0,"C");
		$this->Cell(58,5,"NOMBRE ASESOR",0,0,"C");
		$this->Cell(20,5,"VALOR TRANS",0,0,"C");
		$this->Cell(5,5,"#",0,0,"C");
		$this->Cell(12,5,"HORA",0,0,"C");
		$this->Cell(30,5,"OBSERVACIONES",0,0,"C");
		$this->Ln();
		$y = $this->GetY();
		$this->Line(10,$y,198,$y);
		$this->Ln(1);
	}
	
	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont("Arial","",8);
		$this->Cell(0,10,"RECAUDO DE EFECTIVO DE GIROS v. 2.0",0,0,"C");
	}
}

$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->SetFont("Arial","",7);
$pdf->AddPage();

//Conecta a la base de datos
conectar();

//Declaracion de variables
$fecha = $_POST["fecha"];
$cedulacajero = $_POST["cedulacajero"];
$centrodecosto = $_POST["centrodecosto"];

//Selecciona las transacciones 2 y 9 para la fecha, cajero y centro de costo
$qtransacciones = "SELECT DISTINCT r.cod_trans, t.nombre FROM transacciones t, registros r, sucursal s
WHERE r.cod_trans = t.codigo
AND r.cod_punto = s.codigo
AND s.cod_ccosto = ".$centrodecosto."
AND t.codigo in (2,9)
AND r.fecha = '".$fecha."'
AND r.cod_cajero = ".$cedulacajero."
ORDER BY r.fechayhora";
$transacciones = mysql_query($qtransacciones);
$totalcajero = 0;

//Ciclo que pasa por cada transaccion
while($transaccion = mysql_fetch_array($transacciones)){
//Escribe en el archivo el codigo y nombre de transaccion
$pdf->Cell(25,5," ",0,0,"L");
$pdf->Cell(0,5,$transaccion[0]." ".$transaccion[1],0,0,"L");
$pdf->Ln();
$totaltransaccion = 0;
//Selecciona los registros encontrado para la transaccion, fecha, cajero y centro de costo
$qregistros = "SELECT s.nombre,r.cod_asesor, a.nombres, a.apellido1, a.apellido2, CASE WHEN r.cod_trans IN (3,5,6,8,9) THEN r.valor*-1 ELSE r.valor END 'valor',r.num_mvto, date_format(r.fechayhora,'%H:%i:%S') 'hora',r.observaciones
FROM registros r, asesores a, sucursal s
WHERE r.cod_asesor = a.documento
AND r.cod_punto = s.codigo
AND s.cod_ccosto = ".$centrodecosto."
AND r.cod_punto = s.codigo
AND r.fecha = '".$fecha."'
AND r.cod_cajero = ".$cedulacajero."
AND r.cod_trans = ".$transaccion[0]."
ORDER BY s.nombre";
$registros = mysql_query($qregistros);
	//Ciclo que pasa por cada registro encontrado de la transaccion
	while($registro = mysql_fetch_array($registros)){
	//Escribe en el archivo la informacion del registro
	$pdf->Cell(45,5,$registro[0],0,0,"L");
	$pdf->Cell(20,5,$registro[1],0,0,"R");
	$pdf->Cell(58,5,utf8_decode($registro[2]." ".$registro[3]." ".$registro[4]),0,0,"L");
	$pdf->Cell(20,5,"$ ".number_format($registro[5],0,",","."),0,0,"R");
	$pdf->Cell(5,5,$registro[6],0,0,"C");
	$pdf->Cell(12,5,$registro[7],0,0,"C");
	$pdf->Cell(30,5,$registro[8],0,0,"L");
	$pdf->Ln();
	//Suma cada valor de un registro a un total por transaccion
	$totaltransaccion = $totaltransaccion + $registro[5];
	}
	//Escribe el valor total de transaccion
	$pdf->SetFont("Arial","B",7);
	$pdf->Cell(123,5,utf8_decode("TOTAL TRANSACCIÓN: "),0,0,"R");
	$pdf->Cell(20,5,"$ ".number_format($totaltransaccion,0,",","."),0,0,"R");
	$pdf->Ln(7);
	$pdf->SetFont("Arial","",7);
	//Suma cada valor total de transaccion a un valor total por cajero
	$totalcajero = $totalcajero + $totaltransaccion;
}
//Escribe el valor total del cajero
$pdf->SetFont("Arial","B",9);
$pdf->Cell(0,5,"TOTAL CAJERO: $ ".number_format($totalcajero,0,",","."),0,0,"C");
$pdf->Ln();
desconectar();
$pdf->Output("REPORTE 3 - RECAUDOS DE EFECTIVO DE TESORERIA","I");
?>