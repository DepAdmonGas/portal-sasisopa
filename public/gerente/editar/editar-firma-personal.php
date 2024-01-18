<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include_once "../../../app/bd/inc.conexion.php";

$aleatorio = uniqid();

$img = $_POST['base64'];
$img = str_replace('data:image/png;base64,', '', $img);
$fileData = base64_decode($img);
$fileName = $aleatorio.'.png';

if(file_put_contents('../../../imgs/firma-personal/'.$fileName, $fileData)){

$sql = "UPDATE tb_usuarios SET
firma = '".$fileName."'
 WHERE id= '".$_POST['idUsuario']."' ";
mysqli_query($con, $sql);

echo 1;
}else{
echo 0;
}


mysqli_close($con);