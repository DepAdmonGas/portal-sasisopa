<?php
require('../../../app/help.php');

$return_arr = array();
$idmatriz = $_POST['idmatriz'];

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

if(move_uploaded_file($_FILES['acusepdf']['tmp_name'], $ruta_a_file)) {}
if(move_uploaded_file($_FILES['requisitopdf']['tmp_name'], $ruta_rl_file)) {}

if ($acuse != "" || $requisito != "") {

if ($acuse != "") {
$sql1 = "UPDATE rl_requisitos_legales_matriz SET
acusepdf = '".$ruta_a."'
WHERE id = '".$idmatriz."' ";
mysqli_query($con, $sql1);
}

if ($requisito != "") {
$sql1 = "UPDATE rl_requisitos_legales_matriz SET
requisitolegalpdf = '".$ruta_rl."'
WHERE id = '".$idmatriz."' ";
mysqli_query($con, $sql1);
}

if ($ruta_a != "") {
$acuseR = "<a target='_blank' href='../".$ruta_a."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
}else{
$acuseR = "";	
}

if ($ruta_rl != "") {
$requisitoR = "<a target='_blank' href='../".$ruta_rl."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
}else{
$requisitoR = "";	
}


$return_arr[] = array(
				  "resultado" => 1,
                  "acusepdf" => $acuseR,
                  "requisitolegalpdf" => $requisitoR);


echo json_encode($return_arr);


}else{
$return_arr[] = array(
				  "resultado" => 0,
                  "acusepdf" => '',
                  "requisitolegalpdf" => '');


echo json_encode($return_arr);
}

