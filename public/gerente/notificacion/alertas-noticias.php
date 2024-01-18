<?php
require('../../../app/help.php');

$return_arr = array();

$sql_noticias = "SELECT * FROM no_noticias WHERE id_usuario = '".$Session_IDUsuarioBD."' AND date(fecha_hora) = '$fecha_del_dia' AND alerta = 0 LIMIT 1" ;
$result_noticias = mysqli_query($con, $sql_noticias);
$numero_noticias = mysqli_num_rows($result_noticias);

if ($numero_noticias != "") {
while($row_noticias = mysqli_fetch_array($result_noticias, MYSQLI_ASSOC)){

$id = $row_noticias['id'];

$return_arr[] = array(
"titulo" => $row_noticias['titulo'],
"detalle" => $row_noticias['detalle'],
"url" => $row_noticias['url']);

}
}else{
$return_arr[] = array(
"titulo" => "",
"detalle" => "",
"url" => "");	
}


$sql = "UPDATE no_noticias SET
  alerta = 1
   WHERE id = '".$id."' ";
  mysqli_query($con, $sql);

  echo json_encode($return_arr);

