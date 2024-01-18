<?php
require('../../../app/help.php');

$idPrograma = $_POST['idPrograma'];

$sql_resumen = "SELECT * FROM tb_programa_anual_simulacros_resumen WHERE id_programa = '".$idPrograma."' ";
$result_resumen = mysqli_query($con, $sql_resumen);
$numero_resumen = mysqli_num_rows($result_resumen);
while($row_resumen = mysqli_fetch_array($result_resumen, MYSQLI_ASSOC)){
$id = $row_resumen['id'];
}

if ($numero_resumen == 0) {

$sql_insert = "INSERT INTO tb_programa_anual_simulacros_resumen (
id_programa,
resumen
)
VALUES (
'".$idPrograma."',
'".$_POST['Resumen']."'
)";
mysqli_query($con, $sql_insert);

}else{

$sql = "UPDATE tb_programa_anual_simulacros_resumen SET
resumen = '".$_POST['Resumen']."'
 WHERE id = '".$id."' ";
mysqli_query($con, $sql);

}

//------------------
mysqli_close($con);
//------------------
