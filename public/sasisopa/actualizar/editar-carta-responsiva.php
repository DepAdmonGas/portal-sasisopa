<?php
require('../../../app/help.php');

$sql = "UPDATE tb_requisicion_obra_carta_responsiva SET
dia = '".$_POST['Dia']."',
mes = '".$_POST['Mes']."',
year = '".$_POST['Year']."',
municipio = '".$_POST['Municipio']."',
estado = '".$_POST['Estado']."',
representante_legal = '".$_POST['RepresentanteL']."',
razon_social = '".$_POST['RazonSocial']."',
domicilio = '".$_POST['Domicilio']."',
apoderado_legal = '".$_POST['ApoderadoL']."'
WHERE id = '".$_POST['id']."' ";


mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------