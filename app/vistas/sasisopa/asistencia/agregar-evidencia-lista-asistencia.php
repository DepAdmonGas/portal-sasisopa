<?php
require('../../../../app/help.php');

$idRegistro = $_POST['idRegistro'];
$Fileevidencia = $_FILES['Fileevidencia']['name'];
$extension = pathinfo($Fileevidencia, PATHINFO_EXTENSION);
$allowTypes = array('jpg','png','jpeg','gif', 'PNG', 'JPG', 'JPEG', 'GIF'); 

$ruta_file = "../../../../archivos/evidencias/"."EVIDENCIA-LA-".$Session_IDEstacion."-".strtotime($hoy).".".$extension;
$ruta_evidencia = "EVIDENCIA-LA-".$Session_IDEstacion."-".strtotime($hoy).".".$extension;

if(in_array($extension, $allowTypes)){ 

$imageTemp = $_FILES["Fileevidencia"]["tmp_name"]; 
$compressedImage = compressImage($imageTemp, $ruta_file, 60); 

if($compressedImage){ 
  
$sql_insert = "INSERT INTO tb_lista_asistencia_evidencia (

id_lista_asistencia,
evidencia
)
VALUES 
(
'".$idRegistro."', 
'".$ruta_evidencia."'
)";
mysqli_query($con, $sql_insert);

}else{              
} 
}else{            
}

    function compressImage($source, $destination, $quality) { 
    // Obtenemos la información de la imagen
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Creamos una imagen
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 

    //$rotate = imagerotate($image, 270, 0);
    $rotate = $image;
     
    // Guardamos la imagen
    imagejpeg($rotate, $destination, $quality); 
     
    // Devolvemos la imagen comprimida
    return $destination; 
}