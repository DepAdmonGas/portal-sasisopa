<?php
require('../../../app/help.php');


$sql_insert = "INSERT INTO tb_encuentas_estacion_cliente_preguntas (
id_cliente,id_pregunta,resultado)
VALUES (
  '".$_POST['idusuario']."',
  '".$_POST['idpregunta']."',
  '".$_POST['respuesta']."'
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------