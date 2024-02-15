<?php
require('../../../app/help.php');

function idReporte($con){
  $sql = "SELECT id FROM tb_entregas ORDER BY id desc LIMIT 1";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  if ($numero == 0) {
  $numid = 1;
  }else{
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  $numid = $row['id'] + 1;
  }
  }
  return $numid;
  }

  $ID = idReporte($con);

  $sql_insert = "INSERT INTO tb_entregas (
  id, estacion,fecha,destinatario,estatus)
  VALUES (
  '".$ID."',
  '".$_POST['idEstacion']."',
  '".$fecha_del_dia."',
  '".$_POST['Destinatario']."',
  0
  )";
  
  if(mysqli_query($con, $sql_insert)){
  echo $ID;
  }else{
  echo 0;
  }
  
  //Cerrar conexion BD
  mysqli_close($con);