<?php
require('../../../app/help.php');

$sql = "UPDATE po_mantenimiento_correctivo SET
nombre_equipo = '".$_POST['EquipoArea']."',
descripcion_hallazgo = '".$_POST['DeHallazgo']."',
descripcion_actividad = '".$_POST['DeMantenimiento']."',
herramienta = '".$_POST['Herramienta']."'
WHERE id = '".$_POST['idmantenimiento']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------