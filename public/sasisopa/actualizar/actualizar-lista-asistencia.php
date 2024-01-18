<?php
require('../../../app/help.php');

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE nombre = '".$_POST['NomEncargado']."' ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$id = $row_usuarios['id'];
}

$sql = "UPDATE tb_lista_asistencia SET
fecha = '".$_POST['Fecha']."', 
hora  = '".$_POST['Hora']."', 
lugar  = '".$_POST['Lugar']."', 
tema  = '".$_POST['Tema']."', 
finalidad  = '".$_POST['Finalidad']."', 
encargado  = '".$_POST['NomEncargado']."',
estado = 1
 WHERE id = '".$_POST['idRegistro']."' ";

 if($_POST['Estado'] == 0){

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

$sql_insert1 = "INSERT INTO se_comunicacion_i_e (id_estacion,no_comunicacion,fecha,tema,detalle,encargado_comunicacion,tipo_comunicacion,material,seguimiento,dirigidoa,url,asistencia)
VALUES (
'".$Session_IDEstacion."',
'".$noComunicacion."',
'".$_POST['Fecha']."',
'".$_POST['Tema']."',
'".$_POST['Finalidad']."',
'".$id."',
'Interna',
'Minutas y actas de reuniones',
'',
'6,7,9,10,11',
'',
'".$_POST['idRegistro']."')";
mysqli_query($con, $sql_insert1);

 }

if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}


//------------------
mysqli_close($con);
//------------------