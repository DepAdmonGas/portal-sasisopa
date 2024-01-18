<?php
require('../../../app/help.php');

$sql1 = "UPDATE rl_requisitos_legales_lista SET
nivel_gobierno = '".$_POST['NivelG']."',
mun_alc_est = '".$_POST['MuAlEs']."',
dependencia = '".$_POST['Dependencia']."',
permiso = '".$_POST['Permiso']."',
id_usuario = '".$_POST['IdPersonal']."'
WHERE id = '".$_POST['idRequisito']."' ";

if(mysqli_query($con, $sql1)){
echo 1;
}else{
echo 0;
}