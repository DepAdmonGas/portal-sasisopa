<?php
require('../../../app/help.php');

$sql = "DELETE FROM po_programa_anual_mantenimiento_detalle WHERE id = '".$_POST['id']."' ";

mysqli_query($con, $sql);