<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO se_quejas_sugerencias (
id_estacion,
fecha,
nombre,
motivos_causas,
nombre_dirigido,
contacto,
nombre_puesto,
consecuencias,
solucion,
plazo,
confirmacion
)
VALUES 
(
'".$Session_IDEstacion."', 
'".$_POST['QSFecha']."',
'".$_POST['QSNombre']."',
'".$_POST['QSMotivosCausas']."',
'".$_POST['QSNombreDirigido']."',
'".$_POST['QSContacto']."',
'".$_POST['QSNombrePuesto']."',
'".$_POST['QSEfectosConsecuencias']."',
'".$_POST['QSSolucion']."',
'".$_POST['QSPlazo']."',
'".$_POST['QSConfirmacion']."'
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------