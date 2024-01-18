<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO po_extintores_estacion (
id_estacion,
no_extintor,
ubicacion,
ultima_recarga,
tipo_extintor,
peso_kg,
estado
)
VALUES 
(
'".$Session_IDEstacion."',
'".$_POST['NoExtintor']."',
'".$_POST['Ubicacion']."',
'".$_POST['FechaRecarga']."',
'".$_POST['TipoExtintor']."',
'".$_POST['Peso']."',
1
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------