 <?php
require('../../../../app/help.php');

$sql_insert = "INSERT INTO tb_usuarios_experiencia_empresa_grupo (
id_usuario,
razon_social,
puesto,
periodo_inicio,
periodo_fin)
VALUES (
  '".$_POST['idUsuario']."',
  '".$_POST['RazonSocial']."',
  '".$_POST['Puesto']."',
'".$_POST['FechaInicio']."',
'".$_POST['FechaFin']."')";

mysqli_query($con, $sql_insert);
?>
