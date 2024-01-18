<?php
require('../../../app/help.php');

$return_arr = array();
$idEstacion = $_POST['idEstacion'];
$fechaemision = $_POST['FechaEmision'];
$acuse = $_FILES['acusepdf']['name'];
$requisito = $_FILES['requisitopdf']['name'];

$ext_acuse = pathinfo($_FILES['acusepdf']['name'], PATHINFO_EXTENSION);
$ext_requisito = pathinfo($_FILES['requisitopdf']['name'], PATHINFO_EXTENSION);

$ruta_a_file = "../../../archivos/reuisitos-legales/"."PDF-ACUSE-".$idEstacion."-".strtotime($hoy).".".$ext_acuse;
$ruta_rl_file = "../../../archivos/reuisitos-legales/"."PDF-REQUISITOL-".$idEstacion."-".strtotime($hoy).".".$ext_requisito;

if($acuse != "") {
$ruta_a = "archivos/reuisitos-legales/"."PDF-ACUSE-".$idEstacion."-".strtotime($hoy).".".$ext_acuse;
}else{
$ruta_a = "";
}

if($requisito != "") {
$ruta_rl = "archivos/reuisitos-legales/"."PDF-REQUISITOL-".$idEstacion."-".strtotime($hoy).".".$ext_requisito;
}else{
$ruta_rl = "";
}

$sql_programa_m = "SELECT vigencia FROM rl_requisitos_legales_calendario WHERE id = '".$_POST['idre']."' ";
$result_programa_m = mysqli_query($con, $sql_programa_m);
$numero_programa_m = mysqli_num_rows($result_programa_m);
while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
$vigencia = $row_programa_m['vigencia'];
}

if($vigencia == "Anual"){
$Resultado = $_POST['vencimiento'];	
}else if($vigencia == "Bianual"){
$Resultado = $_POST['vencimiento'];	
}else if($vigencia == "Permanente"){
$Resultado = "0000-00-00";	
}else if($vigencia == "Trimestral"){
$Resultado = $_POST['vencimiento'];		
}else if($vigencia == "Diario"){
$Resultado = $_POST['vencimiento'];	
}else if($vigencia == "Cuando se realice cambio"){
$Resultado = "0000-00-00";	
}else if($vigencia == "Semestral"){
$Resultado = $_POST['vencimiento'];	
}else if($vigencia == "Mejora continua"){
$Resultado = "0000-00-00";	
}else if($vigencia == "3 años"){
$Resultado = $_POST['vencimiento'];	
}else if($vigencia == "5 años"){
$Resultado = $_POST['vencimiento'];	
}

if(move_uploaded_file($_FILES['acusepdf']['tmp_name'], $ruta_a_file)) {}
if(move_uploaded_file($_FILES['requisitopdf']['tmp_name'], $ruta_rl_file)) {}

$sql_insert1 = "INSERT INTO rl_requisitos_legales_matriz (
idcalendario,
fecha_emision,  
fecha_vencimiento,
acusepdf,  
requisitolegalpdf, 
estado
)
VALUES 
(
'".$_POST['idre']."', 
'".$fechaemision."',
'".$Resultado."',
'".$ruta_a."',
'".$ruta_rl."',
1
)";
mysqli_query($con, $sql_insert1);

if ($ruta_a != "") {
$acuse = "<a target='_blank' href='../".$ruta_a."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
}else{
$acuse = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";	
}

if ($ruta_rl != "") {
$requisito = "<a target='_blank' href='../".$ruta_rl."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
}else{
$requisito = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";	
}

if($Resultado == "0000-00-00"){
$FechaVencimiento = "S/I";	
}else{
$FechaVencimiento = $Resultado;	
}

$return_arr[] = array(
                  "FechaEmision" => FormatoFecha($_POST['FechaEmision']),
                  "FechaVencimiento" => FormatoFecha($FechaVencimiento),
                  "acusepdf" => $acuse,
                  "requisitolegalpdf" => $requisito);


echo json_encode($return_arr);

