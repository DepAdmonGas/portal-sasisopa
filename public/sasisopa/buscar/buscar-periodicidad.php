<?php 
require('../../../app/help.php');

$idselect = $_POST['idselect'];

$sql_mantenimiento_lista = "SELECT * FROM po_mantenimiento_lista WHERE id = '".$idselect."' ";
$result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
$numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);
while($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)){
$periodicidad = $row_mantenimiento_lista['periodicidad'];


}

echo $periodicidad;