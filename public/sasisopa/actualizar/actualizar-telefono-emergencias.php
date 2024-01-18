<?php
require('../../../app/help.php');

$sql = "UPDATE tb_telefonos_emergencias SET
titulo = '".$_POST['EditTitulo']."',
telefono = '".$_POST['EditTelefono']."'
 WHERE id = '".$_POST['idTelefono']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------