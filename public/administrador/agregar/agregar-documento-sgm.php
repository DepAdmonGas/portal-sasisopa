<?php
require('../../../app/help.php');

$idEstacion = $_POST['idEstacion'];
$id = $_POST['id'];
$aleatorio = mt_rand(1,99999999);
$File  =   $_FILES['documento_file']['name'];
$extension = pathinfo($File, PATHINFO_EXTENSION);


$upload_folder = "../../../archivos/FormatosSGM/".$aleatorio."-".strtotime($hoy).".".$extension;

if ($File != "") {
$nombreDocumento = $aleatorio."-".strtotime($hoy).".".$extension;
}else{
$nombreDocumento = ""; 
}

if(move_uploaded_file($_FILES['documento_file']['tmp_name'], $upload_folder)) {


$sql_insert = "INSERT INTO sgm_control_documental (
id_documento,id_estacion,fecha,archivo
)
VALUES (
'".$id."',
'".$idEstacion."',
'".$fecha_del_dia."',
'".$nombreDocumento."'
)";

if(mysqli_query($con, $sql_insert)){
echo 1;
}else{
echo 0;
}

}

//------------------
mysqli_close($con);
//------------------