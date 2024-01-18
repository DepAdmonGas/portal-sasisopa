<?php
require('../../../app/help.php');

$sql_valida = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$_POST['idreporteCre']."' and fecha = '".$_POST['FechaNew']."' ";
$result_valida = mysqli_query($con, $sql_valida);
$numero_valida = mysqli_num_rows($result_valida);

if ($numero_valida >= 1) {
echo 0;
}else{

 $sql = "UPDATE re_reporte_cre_producto SET
  fecha = '".$_POST['FechaNew']."'
   WHERE id_re_mes = '".$_POST['idreporteCre']."' AND fecha = '".$_POST['FechaAnte']."' ";
  mysqli_query($con, $sql);

 echo strtotime($_POST['FechaNew']);

}

