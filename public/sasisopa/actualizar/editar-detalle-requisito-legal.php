<?php
require('../../../app/help.php');

$sql = "UPDATE rl_requisitos_legales_calendario SET
id_requisito_legal = '".$_POST['requisitolegal']."',
vigencia = '".$_POST['vigencia']."',
enero = '".$_POST['ene']."',
febrero = '".$_POST['feb']."',
marzo = '".$_POST['mar']."',
abril = '".$_POST['abr']."',
mayo = '".$_POST['may']."',
junio = '".$_POST['jun']."',
julio = '".$_POST['jul']."',
agosto = '".$_POST['ago']."',
septiembre = '".$_POST['sep']."',
octubre = '".$_POST['oct']."',
noviembre = '".$_POST['nov']."',
diciembre = '".$_POST['dic']."'
WHERE id = '".$_POST['id']."' ";

if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------