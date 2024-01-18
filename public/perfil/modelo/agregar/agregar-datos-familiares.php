 <?php
require('../../../../app/help.php');

$sql_insert = "INSERT INTO tb_usuarios_familiares (
id_usuario,
nombrecompleto,
parentesco,
domicilio,
telefono)
VALUES (
  '".$_POST['idUsuario']."',
  '".$_POST['NomFamiliar']."',
  '".$_POST['Parentesco']."',
  '".$_POST['Direccion']."',
  '".$_POST['Telefono']."')";

mysqli_query($con, $sql_insert);
?>