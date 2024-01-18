<?php
require('../../../app/help.php');

$aleatorio = uniqid();
$NoDoc1  =   $_FILES['Documento_file']['name'];
$UpDoc1 = "../../../archivos/calibracion/".$aleatorio."-".$NoDoc1;
$NomDoc1 = '';

if(move_uploaded_file($_FILES['Documento_file']['tmp_name'], $UpDoc1)){
$NomDoc1 = $aleatorio."-".$NoDoc1;
}

$sql_insert = "INSERT INTO tb_calibracion_tanques_detalle (
id_calibracion,id_documento,archivo
    )
    VALUES 
    (
    '".$_POST['idReporte']."',
    '".$_POST['id']."',
    '".$NomDoc1."'
    )";

if(mysqli_query($con, $sql_insert)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------