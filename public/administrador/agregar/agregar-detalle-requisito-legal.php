<?php
require('../../../app/help.php');

$idEstacion = $_POST['idEstacion'];
$fechaemision = $_POST['fechaemision'];

$ext_acuse = pathinfo($_FILES['acusePDF_file']['name'], PATHINFO_EXTENSION);
$ext_requisito = pathinfo($_FILES['requisitoPDF_file']['name'], PATHINFO_EXTENSION);

if($_POST['vigencia'] == "Anual"){
$Resultado = $_POST['vencimiento'];
}else if($_POST['vigencia'] == "Bianual"){
$Resultado = $_POST['vencimiento'];
}else if($_POST['vigencia'] == "Permanente"){
$Resultado = "0000-00-00";	
}else if($_POST['vigencia'] == "Trimestral"){
$Resultado = $_POST['vencimiento'];	
}else if($_POST['vigencia'] == "Diario"){
$Resultado = $_POST['vencimiento'];
}else if($_POST['vigencia'] == "Cuando se realice cambio"){
$Resultado = "0000-00-00";	
}else if($_POST['vigencia'] == "Semestral"){
$Resultado = $_POST['vencimiento'];	
}else if($_POST['vigencia'] == "Mejora continua"){
$Resultado = "0000-00-00";	
}else if($_POST['vigencia'] == "3 años"){
$Resultado = $_POST['vencimiento'];
}else if($_POST['vigencia'] == "5 años"){
$Resultado = $_POST['vencimiento'];
}

$sql_val = "SELECT id_requisito_legal FROM rl_requisitos_legales_calendario WHERE id_estacion = '".$idEstacion."' AND id_requisito_legal = '".$_POST['requisitolegal']."' ";
$result_val = mysqli_query($con, $sql_val);
$numero_val = mysqli_num_rows($result_val);

if($numero_val == 0){

$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE id = '".$_POST['requisitolegal']."' LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$NG = $row['nivel_gobierno'];	
}

if(empty($_FILES['acusePDF_file']['name'])) {
$ruta_a = "";
}else{
$ruta_a = "archivos/reuisitos-legales/"."PDF-ACUSE-".$idEstacion."-".strtotime($hoy).".".$ext_acuse;
move_uploaded_file($_FILES['acusePDF_file']['tmp_name'], '../../../'.$ruta_a);
}

if(empty($_FILES['requisitoPDF_file']['name'])) {
$ruta_rl = "";
}else{
$ruta_rl = "archivos/reuisitos-legales"."PDF-REQUISITOL-".$idEstacion."-".strtotime($hoy).".".$ext_requisito;
move_uploaded_file($_FILES['requisitoPDF_file']['tmp_name'], '../../../'.$ruta_rl);
}

$sql_registro = "SELECT MAX(id) AS idReporte FROM rl_requisitos_legales_calendario";
$result_registro = mysqli_query($con, $sql_registro);
$numero_registro = mysqli_num_rows($result_registro);
while($row_registro = mysqli_fetch_array($result_registro, MYSQLI_ASSOC)){
$idReporteRL =  $row_registro['idReporte'] + 1;
}

$sql_insert1 = "INSERT INTO rl_requisitos_legales_calendario (
id,
id_estacion,
id_requisito_legal,
nivel_gobierno,
requisito_legal,
vigencia,
enero,
febrero,
marzo,
abril,
mayo,
junio,
julio,
agosto,
septiembre, 
octubre,
noviembre,
diciembre,
estado
)
VALUES (
'".$idReporteRL."', 
'".$idEstacion."',
'".$_POST['requisitolegal']."',
'".$NG."',
'',
'".$_POST['vigencia']."',
'".$_POST['ene']."',
'".$_POST['feb']."',
'".$_POST['mar']."',
'".$_POST['abr']."',
'".$_POST['may']."',
'".$_POST['jun']."',
'".$_POST['jul']."',
'".$_POST['ago']."',
'".$_POST['sep']."',
'".$_POST['oct']."',
'".$_POST['nov']."',
'".$_POST['dic']."',
1
)";
mysqli_query($con, $sql_insert1);

$sql_insert2 = "INSERT INTO rl_requisitos_legales_matriz (
idcalendario,
fecha_emision,  
fecha_vencimiento,
acusepdf,  
requisitolegalpdf, 
estado
)
VALUES 
(
'".$idReporteRL."', 
'".$_POST['fechaemision']."',
'".$Resultado."',
'".$ruta_a."',
'".$ruta_rl."',
1
)";
mysqli_query($con, $sql_insert2);
echo 1;

}else{

echo 0;

}