<?php
require('../../../app/help.php');

$idCalendario = $_POST['idCalendario'];
$idTema = $_POST['idTema'];
$NumPregunta = $_POST['NumPregunta'];
$Valor = $_POST['Valor'];


$sql = "SELECT id FROM tb_cursos_evaluacion WHERE id_calendario = '".$idCalendario."' AND no_pregunta = '".$NumPregunta."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

if($numero == 0){

$sql_insert = "INSERT INTO tb_cursos_evaluacion (
id_calendario,
no_pregunta,
resultado
)
VALUES 
(
'".$idCalendario."', 
'".$NumPregunta."',
'".$Valor."'
)";
mysqli_query($con, $sql_insert);

}else{

$sql = "UPDATE tb_cursos_evaluacion SET
resultado = '".$Valor."'
WHERE id_calendario = '".$idCalendario."' AND no_pregunta = '".$NumPregunta."' ";
mysqli_query($con, $sql);

}


//------------------
mysqli_close($con);
//------------------

?>