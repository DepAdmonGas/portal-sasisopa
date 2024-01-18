<?php
require('../../../app/help.php');

$sql = "DELETE FROM po_programa_anual_mantenimiento_detalle WHERE id_programa_fecha = '".$_POST['idreporte']."' AND id_mantenimiento = '".$_POST['id']."' ";

mysqli_query($con, $sql);