<?php
require('../../../app/help.php');


$sql_insert = "INSERT INTO tb_encuentas_estacion_cliente_comentarios (
id_cliente,comentario)
VALUES (
  '".$_POST['idusuario']."',
  '".$_POST['comentario']."'
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------