<?php
require('../../../app/help.php');

$idEstacion = $_POST['idEstacion'];
$NombreEquipo = $_POST['NombreEquipo'];
$MarcaModelo = $_POST['MarcaModelo'];
$Funcion = $_POST['Funcion'];
$FechaInstalacion = $_POST['FechaInstalacion'];
$TiempoVida = $_POST['TiempoVida'];


 $sql_equipo = "SELECT id_equipo FROM tb_equipo_critico WHERE id_estacion = '".$idEstacion."' ORDER BY id_equipo desc LIMIT 1";
 $result_equipo = mysqli_query($con, $sql_equipo);
 $numero_equipo = mysqli_num_rows($result_equipo);

   if ($numero_equipo == 0) {
   $numEquipo = 1;
   }else{
   while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){
   $numEquipo = $row_equipo['id_equipo'] + 1;
   }
   }

   $File  =   $_FILES['ManualPDF_file']['name'];
$upload_folder = "../../../archivos/manuales/MANUAL-EQUIPO-".$idEstacion.strtotime($hoy).".pdf";

if ($File != "") {
$ManualPDF = "archivos/manuales/MANUAL-EQUIPO-".$idEstacion.strtotime($hoy).".pdf";
}else{
$ManualPDF = ""; 
}

if(move_uploaded_file($_FILES['ManualPDF_file']['tmp_name'], $upload_folder)) {}

if ($File != "") {

$sql_insert = "INSERT INTO tb_equipo_critico (
id_estacion,
id_equipo,
nombre_equipo,
marca_modelo,
funciones,
fecha_instalacion,
tiempo_vida,
manual,
estado
)
VALUES (
'".$idEstacion."',
'".$numEquipo."',
'".$NombreEquipo."',
'".$MarcaModelo."',
'".$Funcion."',
'".$FechaInstalacion."',
'".$TiempoVida."',
'".$ManualPDF."',
1
)";
mysqli_query($con, $sql_insert);


}

//------------------
mysqli_close($con);
//------------------