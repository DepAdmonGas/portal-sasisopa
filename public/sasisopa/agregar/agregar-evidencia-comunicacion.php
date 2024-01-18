<?php
require('../../../app/help.php');

$id = $_POST['id'];
$FileEvidencia = $_FILES['FileEvidencia']['name'];

$extension = pathinfo($FileEvidencia, PATHINFO_EXTENSION);
$ruta_file = "../../../archivos/evidencias/"."EVIDENCIA-".$id."-".strtotime($hoy).".".$extension;

$ruta_protocolo = "EVIDENCIA-".$id."-".strtotime($hoy).".".$extension;

$allowTypes = array('jpg','png','jpeg','gif'); 

if(in_array($extension, $allowTypes)){ 

$imageTemp = $_FILES["FileEvidencia"]["tmp_name"]; 
$compressedImage = compressImage($imageTemp, $ruta_file, 50); 

if($compressedImage){ 
                
$sql_insert = "INSERT INTO se_comunicacion_evidencia (

id_comunicacion,
archivo
)
VALUES 
(
'".$id."', 
'".$ruta_protocolo."'
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


//------------------
mysqli_close($con);
//------------------