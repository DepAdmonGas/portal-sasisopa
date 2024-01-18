<?php
require('../../../app/help.php');

$sql = "UPDATE po_programa_anual_mantenimiento_detalle SET
enero = '".$_POST['Enero']."',
febrero = '".$_POST['Febrero']."',
marzo = '".$_POST['Marzo']."',
abril = '".$_POST['Abril']."',
mayo = '".$_POST['Mayo']."',
junio = '".$_POST['Junio']."',
julio = '".$_POST['Julio']."',
agosto = '".$_POST['Agosto']."',
septiembre = '".$_POST['Septiembre']."',
octubre = '".$_POST['Octubre']."',
noviembre = '".$_POST['Noviembre']."',
diciembre = '".$_POST['Diciembre']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------