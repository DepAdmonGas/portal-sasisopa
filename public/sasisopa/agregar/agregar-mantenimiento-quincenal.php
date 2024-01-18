<?php
require('../../../app/help.php');

   function Folio($idEstacion,$fecha_del_dia, $con){
   $sql_reporte = "SELECT folio, fechacreacion FROM bi_mantenimiento_quincenal WHERE id_estacion = '".$idEstacion."' ORDER BY folio DESC LIMIT 1";
   $result_reporte = mysqli_query($con, $sql_reporte);
   $numero_reporte = mysqli_num_rows($result_reporte);

   if($numero_reporte != 0){
   while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
   $NoFolio = $row_reporte['folio'];
   $FechaConsulta = $row_reporte['fechacreacion'];
   }

   $ExplodeFA = explode("-", $fecha_del_dia);
   $ExplodeFC = explode("-", $FechaConsulta);

   $YearFA = $ExplodeFA[0];
   $YearFC = $ExplodeFC[0];

   if($YearFA == $YearFC){
   $Folio = $NoFolio + 1;
   }else{
   $Folio = 1;
   }

   }else{
    $Folio = 1;
   }

   
   return $Folio;
   }

$Folio = Folio($Session_IDEstacion,$fecha_del_dia, $con);

//-------------------------------------------------------------------------------------------------------------------

$File1  =   $_FILES['Formato1_file']['name'];
$File2  =   $_FILES['Formato2_file']['name'];
$File3  =   $_FILES['Formato3_file']['name'];
$File4  =   $_FILES['Formato4_file']['name'];
$File5  =   $_FILES['Formato5_file']['name'];
$File6  =   $_FILES['Formato6_file']['name'];
$File7  =   $_FILES['Formato7_file']['name'];

$upload_folder1 = "../../../archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F1-".strtotime($hoy).".pdf";
$upload_folder2 = "../../../archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F2-".strtotime($hoy).".pdf";
$upload_folder3 = "../../../archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F3-".strtotime($hoy).".pdf";
$upload_folder4 = "../../../archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F4-".strtotime($hoy).".pdf";
$upload_folder5 = "../../../archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F5-".strtotime($hoy).".pdf";
$upload_folder6 = "../../../archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F6-".strtotime($hoy).".pdf";
$upload_folder7 = "../../../archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F7-".strtotime($hoy).".pdf";

if ($File1 != "") {
$PDFNombre1 = "archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F1-".strtotime($hoy).".pdf";
}else{
$PDFNombre1 = "";
}

if ($File2 != "") {
$PDFNombre2 = "archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F2-".strtotime($hoy).".pdf";
}else{
$PDFNombre2 = "";
}

if ($File3 != "") {
$PDFNombre3 = "archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F3-".strtotime($hoy).".pdf";
}else{
$PDFNombre3 = "";
}

if ($File4 != "") {
$PDFNombre4 = "archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F4-".strtotime($hoy).".pdf";
}else{
$PDFNombre4 = "";
}

if ($File5 != "") {
$PDFNombre5 = "archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F5-".strtotime($hoy).".pdf";
}else{
$PDFNombre5 = "";
}

if ($File6 != "") {
$PDFNombre6 = "archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F6-".strtotime($hoy).".pdf";
}else{
$PDFNombre6 = "";
}

if ($File7 != "") {
$PDFNombre7 = "archivos/mantenimiento-quincenal/MQ".$Session_IDEstacion."-F7-".strtotime($hoy).".pdf";
}else{
$PDFNombre7 = "";
}

if(move_uploaded_file($_FILES['Formato1_file']['tmp_name'], $upload_folder1)) {}
if(move_uploaded_file($_FILES['Formato2_file']['tmp_name'], $upload_folder2)) {}
if(move_uploaded_file($_FILES['Formato3_file']['tmp_name'], $upload_folder3)) {}
if(move_uploaded_file($_FILES['Formato4_file']['tmp_name'], $upload_folder4)) {}
if(move_uploaded_file($_FILES['Formato5_file']['tmp_name'], $upload_folder5)) {}
if(move_uploaded_file($_FILES['Formato6_file']['tmp_name'], $upload_folder6)) {}
if(move_uploaded_file($_FILES['Formato7_file']['tmp_name'], $upload_folder7)) {}


$sql_insert = "INSERT INTO bi_mantenimiento_quincenal (
id_estacion,
id_empleado,
fechacreacion,	
folio,	
formato1,	
formato2,	
formato3,	
formato4,	
formato5,
formato6,
formato7
)
VALUES (
'".$Session_IDEstacion."',
'".$Session_IDUsuarioBD."',
'".$_POST['Fecha']."',
'".$Folio."',
'".$PDFNombre1."',
'".$PDFNombre2."',
'".$PDFNombre3."',
'".$PDFNombre4."',
'".$PDFNombre5."',
'".$PDFNombre6."',
'".$PDFNombre7."'
)";
mysqli_query($con, $sql_insert);


echo $Folio;

//------------------
mysqli_close($con);
//------------------