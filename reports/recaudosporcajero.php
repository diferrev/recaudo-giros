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
		$this->Cell(0,5,"APUESTAS AZAR S.A.",0,0,"C");
		$this->Ln();
		$this->Cell(0,5,utf8_decode("REPORTE 4 - RECAUDO DE EFECTIVO POR CAJERO"),0,0,"C");
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
$cedulafiltro = $_POST["cedulafiltro"];
$centrodecosto = $_SESSION["centrodecosto"];
$movimiento = $_POST["transaccion"];

//Selecciona los cajeros con registros para la fecha, centro de costo y filtrado por una o todas las cedulas
$qcajeros = "SELECT DISTINCT r.cod_cajero, c.nombres, c.apellido1, c.apellido2 FROM cajeros c, registros r, sucursal s
WHERE r.cod_cajero = c.documento
AND r.cod_punto = s.codigo
AND s.cod_ccosto = ".$centrodecosto."
AND r.fecha = '".$fecha."' 
AND r.cod_cajero LIKE '".$cedulafiltro."'";
$cajeros = mysql_query($qcajeros);
$totalcajeros = 0;
//Ciclo que pasa por cada cajero encontrado
while($cajero = mysql_fetch_array($cajeros)){
//Escribe en el archivo la cedula, nombres y apellidos del cajero
$pdf->Cell(0,5,$cajero[0]." ".$cajero[1]." ".$cajero[2]." ".$cajero[3],0,0,"C");
$pdf->Ln();
//Selecciona los transacciones del cajero, centro de costo y fecha
$qtransacciones = "SELECT DISTINCT r.cod_trans, t.nombre FROM transacciones t, registros r, sucursal s
WHERE r.cod_trans = t.codigo
AND r.cod_punto = s.codigo
AND s.cod_ccosto = ".$centrodecosto."
AND r.fecha = '".$fecha."'
AND r.cod_cajero = ".$cajero[0]."
AND r.cod_trans LIKE '".$movimiento."'";
$transacciones = mysql_query($qtransacciones);
$totalcajero = 0;
	//Ciclo que pasa por cada transaccion encontrada
	while($transaccion = mysql_fetch_array($transacciones)){
	//escribe en el archivo codigo y nombre de la transaccion
	$pdf->Cell(25,5," ",0,0,"L");
	$pdf->Cell(0,5,$transaccion[0]." ".$transaccion[1],0,0,"L");
	$pdf->Ln();
	//Selecciona los registros para la transaccion, fecha, cajero y centro de costo
	$qregistros = "SELECT s.nombre, r.cod_asesor, a.nombres, a.apellido1, a.apellido2, CASE WHEN r.cod_trans IN (3,5,6,8,9) THEN r.valor*-1 ELSE r.valor END 'valor', r.num_mvto, date_format(r.fechayhora,'%H:%i:%S') 'hora',r.observaciones
	FROM registros r, asesores a, sucursal s
	WHERE r.cod_asesor = a.documento
	AND r.cod_punto = s.codigo
	AND s.cod_ccosto = ".$centrodecosto."
	AND r.cod_punto = s.codigo
	AND r.fecha = '".$fecha."'
	AND r.cod_cajero = ".$cajero[0]."
	AND r.cod_trans = ".$transaccion[0]."
	ORDER BY s.nombre";
	$registros = mysql_query($qregistros);
	$totaltransaccion = 0;
		//Ciclo que pasa por cada registro encontrado
		while($registro = mysql_fetch_array($registros)){
		//Escribe en el archivo la informacion de cada registro
		$pdf->Cell(45,5,$registro[0],0,0,"L");
		$pdf->Cell(20,5,$registro[1],0,0,"R");
		$pdf->Cell(58,5,utf8_decode($registro[2]." ".$registro[3]." ".$registro[4]),0,0,"L");
		$pdf->Cell(20,5,"$ ".number_format($registro[5],0,",","."),0,0,"R");
		$pdf->Cell(5,5,$registro[6],0,0,"C");
		$pdf->Cell(12,5,$registro[7],0,0,"C");
		$pdf->Cell(30,5,$registro[8],0,0,"L");
		$pdf->Ln();
		//Suma cada valor del registro a un total de cajero
		$totaltransaccion = $totaltransaccion + $registro[5];
		//Suma cada valor del registro a un total de cajero
		$totalcajero = $totalcajero + $registro[5];
		}
		//Escribe en el archivo el valor total de cajero
		$pdf->SetFont("Arial","B",7);
		$pdf->Cell(123,5,"TOTAL TRANSACCION: ",0,0,"R");
		$pdf->Cell(20,5,"$ ".number_format($totaltransaccion,0,",","."),0,0,"R");
		$pdf->Ln(7);
		$pdf->SetFont("Arial","",7);
	}
	//Escribe en el archivo el valor total de cajero
	$pdf->SetFont("Arial","B",7);
	$pdf->Cell(123,5,"TOTAL CAJERO: ",0,0,"R");
	$pdf->Cell(20,5,"$ ".number_format($totalcajero,0,",","."),0,0,"R");
	$pdf->Ln(7);
	$pdf->SetFont("Arial","",7);
	//Suma cada valor total de cajero a un valor total de todos los cajero
	$totalcajeros = $totalcajeros + $totalcajero;
}
//Escribe en el archivo en valor total de todos los cajero
$pdf->SetFont("Arial","B",9);
$pdf->Cell(0,5,"TOTAL CAJEROS: $ ".number_format($totalcajeros,0,",","."),0,0,"C");
$pdf->Ln();
desconectar();
$pdf->Output("REPORTE 4 - RECAUDOS DE EFECTIVO POR CAJERO","I");
?>