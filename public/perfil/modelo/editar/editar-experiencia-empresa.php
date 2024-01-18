<?php
require('../../../../app/help.php');

$sql = "UPDATE tb_usuarios_experiencia_empresa_grupo SET
razon_social = '".$_POST['RazonSocial']."',
puesto = '".$_POST['Puesto']."',
periodo_inicio = '".$_POST['FechaInicio']."',
periodo_fin = '".$_POST['FechaFin']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

mysqli_close($con);