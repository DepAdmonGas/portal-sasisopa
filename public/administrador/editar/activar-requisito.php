<?php
require('../../../app/help.php');


$sql2 = "UPDATE rl_requisitos_legales_calendario SET
estado = 2
 WHERE id = '".$_POST['idCalendario']."' ";
mysqli_query($con, $sql2);

?>