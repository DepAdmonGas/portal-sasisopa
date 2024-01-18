 <?php
require('../../../../app/help.php');

$sql_insert = "INSERT INTO tb_usuarios_experiencia_laboral (
id_usuario,
detalle)
VALUES (
  '".$_POST['idUsuario']."',
  '".$_POST['Empresadetalle']."')";

mysqli_query($con, $sql_insert);
?>
