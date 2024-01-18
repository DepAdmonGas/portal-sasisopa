<?php
require('fpdf/fpdf.php');
include_once "app/help.php";

$result_modulo = $ClassCursos->NombreModuloEvaluacion($idModulo, $con);
$modulodescripcion = $result_modulo['descripcion'];

$sql_temas = "SELECT * FROM cu_evaluacion_modulos_detalle WHERE id_evaluacion_modulo = '".$idModulo."' ";
  $result_temas = mysqli_query($con, $sql_temas);
  $count_temas = mysqli_num_rows($result_temas);
  while($row_temas = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {
  $fecha = $row_temas['fecha'];
  }

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->title = utf8_decode($modulodescripcion);

$pdf->Image('public/cursos/fondo.jpg','0','0','300','210','JPG');

$pdf->SetFont('Arial','',20);
$pdf->SetY(94);
$pdf->CELL(0,10,utf8_decode($session_nomusuario),0,0,'C');
$pdf->Ln(26);

$pdf->SetFont('Arial','',15);
$pdf->SetX(70);
$pdf->SetMargins(60, 0);
$pdf->MULTICELL(0,6,utf8_decode($modulodescripcion),0,'C');
$pdf->Ln(45);

$pdf->SetFont('Arial','',12);
$pdf->SetX(15);
$pdf->CELL(0,10,FormatoFecha($fecha),0,0);

$pdf->Output();
?>

