<?php
require('../../../app/help.php');

$img = $_POST['base64'];
$img = str_replace('data:image/png;base64,', '', $img);
$fileData = base64_decode($img);
$fileName = uniqid().'.png';

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id = '".$_POST['PersonalFirma']."' ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$nombre = $row_usuarios['nombre'];
$puesto = $row_usuarios['id_puesto'];
}

$sql_puesto = "SELECT * FROM tb_puestos WHERE id = '".$puesto."' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$nombrePuesto = $row_puesto['tipo_puesto'];
}

if(file_put_contents('../../../imgs/firma/'.$fileName, $fileData)){

$sql_insert = "INSERT INTO tb_lista_asistencia_detalle (
    id_lista_asistencia,
    usuario,
    puesto,
    firma
    )
    VALUES 
    (
    '".$_POST['idRegistro']."',
    '".$nombre."',
    '".$nombrePuesto."',
    '".$fileName."'
    )";
    
	if(mysqli_query($con, $sql_insert)){
	echo 1;	
	}else{
		echo 0;
	}


}else{

echo 0;
}

//------------------
mysqli_close($con);
//------------------