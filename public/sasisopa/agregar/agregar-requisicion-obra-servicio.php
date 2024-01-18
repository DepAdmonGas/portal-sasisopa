<?php
require('../../../app/help.php');

$sql_folio = "SELECT no_folio FROM tb_requisicion_obra WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY no_folio desc LIMIT 1 ";
$result_folio = mysqli_query($con, $sql_folio);
$numero_folio = mysqli_num_rows($result_folio);

if ($numero_folio == 0) {
$NumFolio = 1;
}else{
while($row_folio = mysqli_fetch_array($result_folio, MYSQLI_ASSOC)){
$folio = $row_folio['no_folio'] + 1;
$NumFolio = $folio;
}
}


$sql_insert1 = "INSERT INTO tb_requisicion_obra (id_estacion,id_usuario,no_folio,fecha,descripcion,justificacion,estado)
VALUES (
'".$Session_IDEstacion."',
'".$Session_IDUsuarioBD."',
'".$NumFolio."',
'".$_POST['Fecha']." ".$hora_del_dia."',
'".$_POST['Descripcion']."',
'".$_POST['Justificacion']."',
1)";
mysqli_query($con, $sql_insert1);

//------------------
mysqli_close($con);
//------------------
