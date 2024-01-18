<?php
require ('../../../app/help.php');

header('Content-Encoding: UTF-8');
header('Content-Type:text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="Bitácora dispensarios.csv"');

$salida = fopen('php://output', 'w');

$sql_lista = "SELECT 
tb_dispensarios_apertura_bitacora.id,
tb_dispensarios.id_estacion, 
tb_dispensarios.no_dispensario,
tb_dispensarios.marca,
tb_dispensarios.modelo,
tb_dispensarios.serie,
tb_dispensarios_apertura_bitacora.fecha,
tb_dispensarios_apertura_bitacora.hora_inicio,
tb_dispensarios_apertura_bitacora.hora_termino,
tb_dispensarios_apertura_bitacora.lado,
tb_dispensarios_apertura_bitacora.producto,
tb_dispensarios_apertura_bitacora.clave,
tb_dispensarios_apertura_bitacora.motivo,
tb_usuarios.nombre,
tb_dispensarios_apertura_bitacora.detalle
FROM tb_dispensarios_apertura_bitacora 
INNER JOIN tb_dispensarios 
ON tb_dispensarios_apertura_bitacora.id_dispensario = tb_dispensarios.id 
INNER JOIN tb_usuarios
ON tb_dispensarios_apertura_bitacora.responsable = tb_usuarios.id
WHERE  tb_dispensarios.id_estacion = '".$Session_IDEstacion."' ORDER BY tb_dispensarios_apertura_bitacora.fecha desc , tb_dispensarios_apertura_bitacora.hora_inicio desc ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);

$HeadEstacion1 = array(
'Razón social:',
$Session_Razonsocial);

$HeadEstacion2 = array(
'Permiso CRE:',
$Session_Permisocre);

$HeadEstacion3 = array(
'Dirección:',
$Session_Direccion);

$arrayE1 = array_map("utf8_decode", $HeadEstacion1);
fputcsv($salida, $arrayE1);

$arrayE2 = array_map("utf8_decode", $HeadEstacion2);
fputcsv($salida, $arrayE2);

$arrayE3 = array_map("utf8_decode", $HeadEstacion3);
fputcsv($salida, $arrayE3);

$Head = array(
'Fecha',
'Hora inicio', 
'Hora termino',
'Dispensario',
'Marca',
'Modelo',
'Serie',
'Lado',
'Producto',
'Motivo',
'Responsable',
'Detalle');

$array1 = array_map("utf8_decode", $Head);
fputcsv($salida, $array1);

while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$id = $row_lista['id'];

if($row_lista['hora_termino'] == '00:00:00'){
$HoraTermino = 'S/I';
}else{
$HoraTermino = date('h:i a', strtotime($row_lista['hora_termino']));
}

$body = array(
FormatoFecha($row_lista['fecha']),
date('h:i a', strtotime($row_lista['hora_inicio'])),
$HoraTermino,
$row_lista['no_dispensario'],
$row_lista['marca'],
$row_lista['modelo'],
$row_lista['serie'],
$row_lista['lado'],
$row_lista['producto'],
$row_lista['clave'].' ('.$row_lista['motivo'].')',
$row_lista['nombre'],
$row_lista['detalle']
);

$contenido = array_map("utf8_decode", $body);
fputcsv($salida, $contenido);

}