<?php
require('../../../app/help.php');

   $sql_reporte = "SELECT id_comunicado FROM co_comunicados WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY id_comunicado desc LIMIT 1";
   $result_reporte = mysqli_query($con, $sql_reporte);
   $numero_reporte = mysqli_num_rows($result_reporte);

   if ($numero_reporte == 0) {
   $noComunicado = 1;
   }else{
   while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
   $noComunicado = $row_reporte['id_comunicado'] + 1;
   }
   }

    $sql_reporte_Co = "SELECT no_comunicacion FROM se_comunicacion_i_e WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY no_comunicacion desc LIMIT 1";
   $result_reporte_Co = mysqli_query($con, $sql_reporte_Co);
   $numero_reporte_Co = mysqli_num_rows($result_reporte_Co);

   if ($numero_reporte_Co == 0) {
   $noComunicacion = 1;
   }else{
   while($row_reporte_Co = mysqli_fetch_array($result_reporte_Co, MYSQLI_ASSOC)){
   $noComunicacion = $row_reporte_Co['no_comunicacion'] + 1;
   }
   }

$nombre_archivo = $_FILES['customFile']['name'];
$tipo_archivo = $_FILES['customFile']['type'];
$tamano_archivo = $_FILES['customFile']['size'];
$tmp_archivo = $_FILES['customFile']['tmp_name'];

$upload_folder ="../../../archivos/comunicados/".strtotime($hoy)."-".$nombre_archivo;
if ($nombre_archivo != "") {
$archivobd = "archivos/comunicados/".strtotime($hoy)."-".$nombre_archivo;
}else{
$archivobd = "";
}


if(move_uploaded_file($_FILES['customFile']['tmp_name'], $upload_folder)) {

}else{

}
$urlnoticia = "comunicados/comunicado-".$Session_IDEstacion."-".$noComunicado;
$seppuestos = explode(",", $_POST['dirigidoa']);

$sql_insert1 = "INSERT INTO co_comunicados (id_estacion,id_comunicado,id_usuario,fecha,tema,detalle,dirigidoa,archivo)
VALUES ('".$Session_IDEstacion."','".$noComunicado."','".$Session_IDUsuarioBD."','".$fecha_del_dia."','".$_POST['temacomunicar']."','".$_POST['detalle']."','".$_POST['dirigidoa']."','".$archivobd."')";
mysqli_query($con, $sql_insert1);


for ($i=0; $i < count($seppuestos) ; $i++) { 

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_puesto = '".$seppuestos[$i]."' and id <> '".$Session_IDUsuarioBD."' ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){

$sql_insert2 = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','".$_POST['temacomunicar']."','Tienes un nuevo comunicado',
  '".$hoy."','".$urlnoticia."',0)";
mysqli_query($con, $sql_insert2);
}
}

$sql_insert3 = "INSERT INTO se_comunicacion_i_e (id_estacion,no_comunicacion,fecha,tema,detalle,encargado_comunicacion,tipo_comunicacion,material,seguimiento,dirigidoa,url)
VALUES (
'".$Session_IDEstacion."',
'".$noComunicacion."',
'".$fecha_del_dia."',
'".$_POST['temacomunicar']."',
'".$_POST['detalle']."',
'".$Session_IDUsuarioBD."',
'INTERNA',
'Portal GestoLine',
'',
'".$_POST['dirigidoa']."',
'".$urlnoticia."')";
mysqli_query($con, $sql_insert3);

?>