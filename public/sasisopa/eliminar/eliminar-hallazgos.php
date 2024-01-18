<?php
require('../../../app/help.php');

$sql1 = "DELETE FROM tb_atencion_hallazgos_detalle WHERE id = '".$_POST['idHallazgo']."' ";
mysqli_query($con, $sql1);

echo 1;