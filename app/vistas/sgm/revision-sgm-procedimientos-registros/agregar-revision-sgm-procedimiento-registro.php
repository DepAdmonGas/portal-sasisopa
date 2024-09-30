<?php
require('../../../../app/help.php');

function numId($con){
$sql = "SELECT id FROM sgm_revision_procedimiento_registro ORDER BY id desc LIMIT 1";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {
$id = 1;
}else{
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'] + 1;
}
return $id;
}

$sql = "SELECT
sgm_autorizado.id_usuario,
sgm_autorizado.estado,
tb_usuarios.id_gas
FROM sgm_autorizado 
INNER JOIN tb_usuarios 
ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE tb_usuarios.id_gas = '".$Session_IDEstacion."' AND sgm_autorizado.estado = 1 LIMIT 1";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$realizadopor = $row['id_usuario'];
}else{
$realizadopor = 0;
}

$numId = numId($con);

$sql_insert = "INSERT INTO sgm_revision_procedimiento_registro (
id, id_estacion, id_usuario, fecha, hora, lugar, elemento, realizadopor, estado
)
VALUES (
'".$numId."',
'".$Session_IDEstacion."',
'".$Session_IDUsuarioBD."',
'',
'',
'',
'".$_POST['PuntoSGM']."',
'".$realizadopor."',
0
)";

if(mysqli_query($con, $sql_insert)){

$sql = "INSERT INTO sgm_revision_procedimiento_registro_detalle (id_revision, categoria, pregunta, respuesta)
VALUES ('".$numId."','SGM','A la fecha del presente se han realizado cambios por nueva legislación:',''),
('".$numId."','SGM','Cuales:',''),
('".$numId."','SGM','Los cambios fueron registrados en el SGM en el apartado de control de revisiones:',''),
('".$numId."','SGM','El cuerpo del SGM, mantienen su estructura de elaboración',''),
('".$numId."','SGM','Se da a conocer a la alta dirección la revisión del SGM ',''),

('".$numId."','Procedimientos','A la fecha del presente se han realizado cambios por nueva legislación:',''),
('".$numId."','Procedimientos','Cuales:',''),
('".$numId."','Procedimientos','Los cambios fueron registrados en el manual de procedimientos en el apartado de control de revisiones:',''),
('".$numId."','Procedimientos','El cuerpo del SGM, mantienen su estructura de elaboración',''),
('".$numId."','Procedimientos','Se da a conocer a la alta dirección la revisión de los procedimientos del SGM',''),

('".$numId."','Registros','A la fecha del presente se han realizado cambios por nueva legislación:',''),
('".$numId."','Registros','Cuales:',''),
('".$numId."','Registros','Los cambios fueron registrados en el manual de procedimientos en el apartado de control de revisiones y codificados por el responsable del SGM:',''),
('".$numId."','Registros','El cuerpo del SGM, mantienen su estructura de elaboración',''),
('".$numId."','Registros','Se da a conocer a la alta y a los involucrados los cambios en los formatos del SGM ','')
";
mysqli_query($con, $sql);

echo $numId;
}else{
echo 0;
}
//-----------------
mysqli_close($con);
//-----------------