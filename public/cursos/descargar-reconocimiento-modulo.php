<?php
require('fpdf/fpdf.php');
include_once "app/help.php";

$pdf = new FPDF('L','mm','A4');

$sql_temas = "SELECT 
tb_cursos_calendario.id, 
tb_cursos_calendario.fecha_programada, 
tb_cursos_calendario.id_estacion, 
tb_cursos_calendario.id_personal, 
tb_cursos_calendario.id_tema,
tb_cursos_calendario.resultado, 
tb_cursos_calendario.estado, 
tb_cursos_temas.num_tema,
tb_cursos_temas.titulo,
tb_cursos_modulos.num_modulo,
tb_cursos_modulos.titulo AS nomModulo
FROM tb_cursos_calendario 
INNER JOIN tb_cursos_temas 
ON tb_cursos_calendario.id_tema = tb_cursos_temas.id 
INNER JOIN tb_cursos_modulos
ON tb_cursos_temas.id_modulo = tb_cursos_modulos.id
WHERE YEAR(tb_cursos_calendario.fecha_programada) = '".$GET_idYear."' AND tb_cursos_modulos.num_modulo = '".$GET_idModulo."' AND tb_cursos_calendario.id_estacion = '".$Session_IDEstacion."' ";
  $result_temas = mysqli_query($con, $sql_temas);
  $count_temas = mysqli_num_rows($result_temas);
  while($row_temas = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {
  $fecha = $row_temas['fecha_programada'];
  $titulo = $row_temas['titulo'];
  $idpersonal = $row_temas['id_personal'];
  $nomModulo = $row_temas['nomModulo'];


$sqlPersonal = "SELECT nombre FROM tb_usuarios WHERE id = '".$idpersonal."' "; 
$resultPersonal = mysqli_query($con, $sqlPersonal);
$numeroPersonal  = mysqli_num_rows($resultPersonal);
while($rowPersonal = mysqli_fetch_array($resultPersonal, MYSQLI_ASSOC)){
$NomUsuario = $rowPersonal['nombre'];
}

$pdf->title = utf8_decode($nomModulo);
$pdf->AddPage();
$pdf->Image('public/cursos/fondo-2024.jpg','0','0','300','210','JPG');

$pdf->SetY(104);
$pdf->SetFont('Arial','',30);
$pdf->CELL(0,0,utf8_decode($NomUsuario),0,0,'C');
$pdf->Ln(1);

$pdf->Ln(27);
$pdf->SetMargins(20, 0);
$pdf->SetFont('Arial','',17);
$pdf->MULTICELL(0,6,utf8_decode($titulo),0,'C');
$pdf->Ln(1);

$pdf->Ln(20);
$pdf->SetX(76);
$pdf->SetFont('Arial','',12);
$pdf->CELL(0,10,FormatoFecha($fecha),0,0);

}

$pdf->Output();
?>