<?php
require('../../../app/help.php');

$sql = "UPDATE po_extintores_estacion SET
no_extintor = '".$_POST['NoExtintor']."',
ubicacion = '".$_POST['Ubicacion']."',
ultima_recarga = '".$_POST['FechaRecarga']."',
tipo_extintor = '".$_POST['TipoExtintor']."',
peso_kg = '".$_POST['Peso']."'
 WHERE id = '".$_POST['idExtintor']."' ";


mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------