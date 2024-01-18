<?php
require('../../../app/help.php');

function IDContenido($con){
$sql_folio = "SELECT id FROM tb_atencion_hallazgos ORDER BY id desc LIMIT 1 ";
$result_folio = mysqli_query($con, $sql_folio);
$numero_folio = mysqli_num_rows($result_folio);
if ($numero_folio == 0) {
$NumFolio = 1;
}else{
while($row_folio = mysqli_fetch_array($result_folio, MYSQLI_ASSOC)){
$folio = $row_folio['id'] + 1;
$NumFolio = $folio;
}
}
return $NumFolio;
}

function Folio($IDEstacion,$con){
$sql_folio = "SELECT folio FROM tb_atencion_hallazgos WHERE id_estacion = '".$IDEstacion."' ORDER BY folio desc LIMIT 1 ";
$result_folio = mysqli_query($con, $sql_folio);
$numero_folio = mysqli_num_rows($result_folio);
if ($numero_folio == 0) {
$NumFolio = 1;
}else{
while($row_folio = mysqli_fetch_array($result_folio, MYSQLI_ASSOC)){
$folio = $row_folio['folio'] + 1;
$NumFolio = $folio;
}
}
return $NumFolio;
}

$ID = IDContenido($con);
$Folio = Folio($Session_IDEstacion,$con);

$sql_insert = "INSERT INTO tb_atencion_hallazgos (
id,
id_estacion,
folio,
fecha_auditoria,
no_control,
tipo_auditoria
)
VALUES (
'".$ID."',
'".$Session_IDEstacion."',
'".$Folio."',
'',
'',
''
)";

if(mysqli_query($con, $sql_insert)){
echo $ID;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------