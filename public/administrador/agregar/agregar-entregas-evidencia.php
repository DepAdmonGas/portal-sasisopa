<?php
require('../../../app/help.php');

$aleatorio = uniqid();
$File  =   $_FILES['Imagen_file']['name'];
$upload_folder = "../../../archivos/entregas/".$aleatorio."-".$File;
$Documento = $aleatorio."-".$File;

if(move_uploaded_file($_FILES['Imagen_file']['tmp_name'], $upload_folder)) {

    $sql2 = "UPDATE tb_entregas_documentos SET
    archivo = '".$Documento."'
     WHERE id = '".$_POST['id']."' ";
    mysqli_query($con, $sql2);

}else{
echo 0;
}
