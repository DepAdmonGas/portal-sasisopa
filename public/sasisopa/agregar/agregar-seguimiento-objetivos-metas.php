<?php
require('../../../app/help.php');

$sql_folio = "SELECT id FROM tb_seguimiento_objetivos_metas ORDER BY id desc LIMIT 1 ";
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

function Agregar($NumFolio,$Objetivo,$Dato1,$Dato2,$Dato3,$Dato4,$con){

$sql_insert = "INSERT INTO tb_seguimiento_objetivos_metas_detalle (
id_seguimiento,
fecha,
objetivo_meta,
nivel_cumplimiento,
medidas,
fecha_aplicacion
)
VALUES 
(
'".$NumFolio."', 
'".$Dato1."',
'".$Objetivo."',
'".$Dato2."',
'".$Dato3."',
'".$Dato4."'

)";

mysqli_query($con, $sql_insert);
}

$sql_insert = "INSERT INTO tb_seguimiento_objetivos_metas (
id,
id_estacion,
id_usuario
)
VALUES 
(
'".$NumFolio."',
'".$Session_IDEstacion."', 
'".$Session_IDUsuarioBD."'
)";

if(mysqli_query($con, $sql_insert)){

Agregar($NumFolio,'Satisfacción del cliente',$_POST['Dato1'],$_POST['Dato2'],$_POST['Dato3'],$_POST['Dato4'],$con);
Agregar($NumFolio,'Mantenimiento',$_POST['Dato5'],$_POST['Dato6'],$_POST['Dato7'],$_POST['Dato8'],$con);
Agregar($NumFolio,'Capacitación',$_POST['Dato9'],$_POST['Dato10'],$_POST['Dato11'],$_POST['Dato12'],$con);
Agregar($NumFolio,'Quejas y sugerencias',$_POST['Dato13'],$_POST['Dato14'],$_POST['Dato15'],$_POST['Dato16'],$con);
Agregar($NumFolio,'Cumplimiento de legislación',$_POST['Dato17'],$_POST['Dato18'],$_POST['Dato19'],$_POST['Dato20'],$con);

echo 1;
}else{
echo 0;
}





//------------------
mysqli_close($con);
//------------------