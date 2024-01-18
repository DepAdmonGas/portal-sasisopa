<?php
require('../../../app/help.php');


function ID($con){
$sql = "SELECT id FROM tb_calibracion_tanques ORDER BY id desc LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {
$NumID = 1;
}else{
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$NumID = $row['id'] + 1;
}
}
return $NumID;
}

$ID = ID($con);

$sql_insert1 = "INSERT INTO tb_calibracion_tanques (
id,
id_estacion,
fecha
)
VALUES 
(
'".$ID."',
'".$_POST['idEstacion']."',
'".$fecha_del_dia."'
)";
mysqli_query($con, $sql_insert1);

echo $ID;

?>