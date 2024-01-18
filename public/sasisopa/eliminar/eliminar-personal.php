<?php
require('../../../app/help.php');

$sql = "DELETE FROM tb_programa_anual_simulacros_personal WHERE id = '".$_POST['idPersonal']."'  ";
mysqli_query($con, $sql);