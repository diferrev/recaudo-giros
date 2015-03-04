<?php
session_start();

require_once ("../procedures/conec.php");
require_once ("../lib/fpdf/fpdf.php");

class PDF extends FPDF
{
	function Header()
	{
		$fecha = date("Y-m-d");
		$fechageneracion = date("Y-m-d H:i:s");
		$cedulacajero = $_POST["cedulacajero"];
		$nombrescajero = $_POST["nombrescajero"];
		
		$this->SetFont("Arial","B",8);
		$this->Cell(0,5,"APUESTAS AZAR S.A.",0,0,"C");
		$this->Ln();
		$this->Cell(0,5,utf8_decode("REPORTE 1 - RECAUDOS POR PUNTO DE VENTA Y TRANSACCIÓN"),0,0,"C");
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
		$this->Cell(30,5,utf8_decode("Fecha de generación"),0,0,"L");
		$this->Cell(30,5,$fechageneracion,0,0,"L");
		$this->Ln(7);
		$this->SetFont("Arial","B",8);
		$this->Cell(25,5,"COD ASESOR",0,0,"C");
		$this->Cell(88,5,"NOMBRE ASESOR",0,0,"C");
		$this->Cell(25,5,"VALOR TRANS",0,0,"R");
		$this->Cell(25,5,"CONSECUTIVO",0,0,"C");
		$this->Cell(25,5,"HORA",0,0,"C");
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
$pdf->SetFont("Arial","",8);
$pdf->AddPage();

//CONECTAMOS A LA BASE DE DATOS
conectar();

//CAPTURA LA VARIABLES PASADAS
$fecha = date("Y-m-d");
$cedulacajero = $_POST["cedulacajero"];
$centrodecosto = $_POST["centrodecosto"];

//SELECCION DE PUNTOS DE VENTA CON TRANSACCION PARA LA FECHA Y CAJERO
$qpuntos = "SELECT DISTINCT r.cod_punto, s.nombre FROM sucursal s, registros r 
WHERE r.cod_punto = s.codigo
AND s.cod_ccosto = ".$centrodecosto."
AND r.fecha = '".$fecha."'
AND r.cod_cajero = ".$cedulacajero."
ORDER BY s.nombre";
$puntos = mysql_query($qpuntos);
$totalcajero = 0;

while($punto = mysql_fetch_array($puntos)){
$pdf->Cell(0,5,$punto[0]." ".$punto[1],0,0,"C");
$pdf->Ln();
$qtransacciones = "SELECT DISTINCT r.cod_trans, t.nombre FROM transacciones t, registros r
WHERE r.cod_trans = t.codigo
AND r.fecha = '".$fecha."'
AND r.cod_cajero = ".$cedulacajero."
AND r.cod_punto = ".$punto[0];
$transacciones = mysql_query($qtransacciones);
$totalpunto = 0;
	while($transaccion = mysql_fetch_array($transacciones)){
	$pdf->Cell(25,5," ",0,0,"L");
	$pdf->Cell(0,5,$transaccion[0]." ".$transaccion[1],0,0,"L");
	$pdf->Ln();
	$qregistros = "SELECT r.cod_asesor, a.nombres, a.apellido1, a.apellido2, CASE WHEN r.cod_trans IN (3,5,6,8,9) THEN r.valor*-1 ELSE r.valor END 'valor', r.num_mvto, date_format(r.fechayhora,'%H:%i:%S') 'hora'
	FROM registros r, asesores a
	WHERE r.cod_asesor = a.documento
	AND r.fecha = '".$fecha."'
	AND r.cod_cajero = ".$cedulacajero."
	AND r.cod_punto = ".$punto[0]."
	AND r.cod_trans = ".$transaccion[0];
	$registros = mysql_query($qregistros);
		while($registro = mysql_fetch_array($registros)){
		$pdf->Cell(25,5,$registro[0],0,0,"L");
		$pdf->Cell(88,5,utf8_decode($registro[1]." ".$registro[2]." ".$registro[3]),0,0,"L");
		$pdf->Cell(25,5,"$ ".number_format($registro[4],0,",","."),0,0,"R");
		$pdf->Cell(25,5,$registro[5],0,0,"C");
		$pdf->Cell(25,5,$registro[6],0,0,"C");
		$pdf->Ln();
		$totalpunto = $totalpunto + $registro[4];
		}
	}
	$pdf->SetFont("Arial","B",8);
	$pdf->Cell(113,5,"TOTAL PUNTO: ",0,0,"R");
	$pdf->Cell(25,5,"$ ".number_format($totalpunto,0,",","."),0,0,"R");
	$pdf->Ln(7);
	$pdf->SetFont("Arial","",8);
	$totalcajero = $totalcajero + $totalpunto;
}
$pdf->SetFont("Arial","B",9);
$pdf->Cell(0,5,"TOTAL CAJERO: $ ".number_format($totalcajero,0,",","."),0,0,"C");
$pdf->Ln();
$pdf->Output();
?>