<?php
require('../../../app/help.php');


$_POST['EditidUsuario'];
$_POST['EditNombres'];
$_POST['EditApellidoP'];
$_POST['EditApellidoM'];
$_POST['EditEmail'];
$_POST['EditPuesto'];
$_POST['EditTelefono'];
$_POST['EditNomUsuario'];
$_POST['EditPasswordOriginal'];

$sql = "UPDATE tb_usuarios SET
nombre = '".$_POST['EditNombres']."',
telefono = '".$_POST['EditTelefono']."',
email = '".$_POST['EditEmail']."',
id_puesto = '".$_POST['EditPuesto']."',
usuario = '".$_POST['EditNomUsuario']."',
password = '".$_POST['EditPasswordOriginal']."'
 WHERE id= '".$_POST['EditidUsuario']."' ";
mysqli_query($con, $sql);
mysqli_close($con);
?>
