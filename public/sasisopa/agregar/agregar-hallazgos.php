<?php
require('../../../app/help.php');


if($_POST['idHallazgo'] == 0){

$sqlAH = "SELECT * FROM tb_atencion_hallazgos_detalle WHERE id_atencion = '".$_POST['id']."' AND id_sasisopa = '".$_POST['IdSasisopa']."' ";
$resultAH = mysqli_query($con, $sqlAH);
$numeroAH = mysqli_num_rows($resultAH);

if($numeroAH == 0){

$sql_insert = "INSERT INTO tb_atencion_hallazgos_detalle (
id_atencion,
id_sasisopa,
hallazgos,
accion,
fecha_implementacion
)
VALUES (
'".$_POST['id']."',
'".$_POST['IdSasisopa']."',
'".$_POST['Hallazgos']."',
'".$_POST['Accion']."',
'".$_POST['FechaI']."'
)";

if(mysqli_query($con, $sql_insert)){
echo 1;
}else{
echo 0;
}

}else{
echo 2;
}


}else{

$sql = "UPDATE tb_atencion_hallazgos_detalle SET
id_sasisopa = '".$_POST['IdSasisopa']."',
hallazgos = '".$_POST['Hallazgos']."',
accion = '".$_POST['Accion']."',
fecha_implementacion = '".$_POST['FechaI']."'
 WHERE id = '".$_POST['idHallazgo']."' ";


if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

}


//------------------
mysqli_close($con);
//------------------