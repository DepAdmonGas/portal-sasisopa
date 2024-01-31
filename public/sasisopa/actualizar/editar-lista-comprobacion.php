<?php
require('../../../app/help.php');

$id = $_POST['id'];

$sql_insert1 = "UPDATE tb_politica_lista_comprobacion_detalle SET
resultado = '".$_POST['ER1']."'
WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política es adecuada a la naturaleza magnitud y actividades del proyecto' ";
mysqli_query($con, $sql_insert1);

$sql_insert2 = "UPDATE tb_politica_lista_comprobacion_detalle SET
resultado = '".$_POST['ER2']."'
WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política incluye la seguridad operativa' ";
mysqli_query($con, $sql_insert2);

$sql_insert3 = "UPDATE tb_politica_lista_comprobacion_detalle SET
resultado = '".$_POST['ER3']."'
WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política incluye la protección al medio ambiente' ";
mysqli_query($con, $sql_insert3);

$sql_insert4 = "UPDATE tb_politica_lista_comprobacion_detalle SET
resultado = '".$_POST['ER4']."'
WHERE id_lista_comprobacion = '".$id."' AND criterio = 'Los trabajadores, la alta dirección, los clientes y los subcontratistas tienen conocimiento de la política' ";
mysqli_query($con, $sql_insert4);

$sql_insert5 = "UPDATE tb_politica_lista_comprobacion_detalle SET
resultado = '".$_POST['ER5']."'
WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política se revisa periódicamente' ";
mysqli_query($con, $sql_insert5);

$sql_insert6 = "UPDATE tb_politica_lista_comprobacion_detalle SET
resultado = '".$_POST['ER6']."'
WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política se compromete al control de los peligros e impactos ambientales' ";
mysqli_query($con, $sql_insert6);

$sql_insert7 = "UPDATE tb_politica_lista_comprobacion_detalle SET
resultado = '".$_POST['ER7']."'
WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política considera la participación del personal' ";
mysqli_query($con, $sql_insert7);

$sql_insert8 = "UPDATE tb_politica_lista_comprobacion SET
fecha = '".$_POST['EditFecha']."',
asistentes = '".$_POST['EditAsistentes']."',
comentarios = '".$_POST['EditComentarios']."'
WHERE id = '".$id."' ";
mysqli_query($con, $sql_insert8);

echo 1;
//------------------
mysqli_close($con);
//------------------