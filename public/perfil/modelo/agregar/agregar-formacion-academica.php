 <?php
require('../../../../app/help.php');

$sql_insert = "INSERT INTO tb_usuarios_formacion_academica (
id_usuario,
nivel,
detalle)
VALUES (
  '".$_POST['idUsuario']."',
  '".$_POST['NivelAcademico']."',
  '".$_POST['Institucion']."')";

mysqli_query($con, $sql_insert);
?>