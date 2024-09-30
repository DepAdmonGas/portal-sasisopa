<?php
require('../../../../app/help.php');

$sql = "SELECT * FROM sgm_politica WHERE id = '".$_GET['id']."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$politica = $row['contenido'];
$fecha = $row['fecha'];


echo '<div>Fecha: '.FormatoFecha($fecha).'</div>
       <div class="mt-2">'.$politica.'</div>';
?>