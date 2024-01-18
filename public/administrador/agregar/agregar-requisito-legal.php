<?php
require('../../../app/help.php');

$return_arr = array();
$idEstacion = $_POST['idEstacion'];

$acuse = $_FILES['acusepdf']['name'];
$requisito = $_FILES['requisitopdf']['name'];

$ext_acuse = pathinfo($_FILES['acusepdf']['name'], PATHINFO_EXTENSION);
$ext_requisito = pathinfo($_FILES['requisitopdf']['name'], PATHINFO_EXTENSION);

$ruta_a_file = "../../../archivos/reuisitos-legales/"."PDF-ACUSE-".$idEstacion."-".strtotime($hoy).".".$ext_acuse;
$ruta_rl_file = "../../../archivos/reuisitos-legales/"."PDF-REQUISITOL-".$idEstacion."-".strtotime($hoy).".".$ext_requisito;

if($acuse != "") {
$ruta_a = "archivos/reuisitos-legales/"."PDF-ACUSE-".$idEstacion."-".strtotime($hoy).".pdf";
}else{
$ruta_a = "";
}

if($requisito != "") {
$ruta_rl = "archivos/reuisitos-legales/"."PDF-REQUISITOL-".$idEstacion."-".strtotime($hoy).".pdf";
}else{
$ruta_rl = "";
}

if(move_uploaded_file($_FILES['acusepdf']['tmp_name'], $ruta_a_file)) {}
if(move_uploaded_file($_FILES['requisitopdf']['tmp_name'], $ruta_rl_file)) {}

$sql_insert1 = "INSERT INTO rl_requisitos_legales_matriz (
idcalendario,
ultima_actualizacion,  
acusepdf,  
requisitolegalpdf, 
estado
)
VALUES 
(
'".$_POST['idre']."', 
'".$_POST['ultimaactE']."',
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


$return_arr[] = array(
                  "ultimaactE" => FormatoFecha($_POST['ultimaactE']),
                  "acusepdf" => $acuse,
                  "requisitolegalpdf" => $requisito);


echo json_encode($return_arr);

