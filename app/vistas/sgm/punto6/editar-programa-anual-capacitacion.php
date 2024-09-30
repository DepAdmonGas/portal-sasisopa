<?php
require('../../../../app/help.php');

if($_POST['cate'] == 1){

$sql = "INSERT INTO sgm_programa_anual_capacitacion_externa_personal (
id_capacitacion, id_usuario
)
VALUES (
'".$_POST['id']."',
'".$_POST['valor']."'
)";

}else if($_POST['cate'] == 2){

$sql = "DELETE FROM sgm_programa_anual_capacitacion_externa_personal WHERE id = '".$_POST['id']."'  ";

}else if($_POST['cate'] == 3){

$File  =   $_FILES['valor']['name'];
$ext = pathinfo($_FILES['valor']['name'], PATHINFO_EXTENSION);
$upload_folder = "../../../../archivos/sgm/EVIDENCIA-".$_POST['id'].'-'.strtotime($hoy).".".$ext;

if ($File != "") {
$PDFNombre = "EVIDENCIA-".$_POST['id'].'-'.strtotime($hoy).".".$ext;
}else{
$PDFNombre = ""; 
}

if(move_uploaded_file($_FILES['valor']['tmp_name'], $upload_folder)) {}

$sql = "INSERT INTO sgm_programa_anual_capacitacion_externa_evidencia (
id_capacitacion, archivo
)
VALUES (
'".$_POST['id']."',
'".$PDFNombre."'
)";

}else if($_POST['cate'] == 4){

$sql = "DELETE FROM sgm_programa_anual_capacitacion_externa_evidencia WHERE id = '".$_POST['id']."'  ";

}else if($_POST['cate'] == 5){

$sql = "DELETE FROM sgm_programa_anual_capacitacion_externa WHERE id = '".$_POST['id']."'  ";

}

mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------