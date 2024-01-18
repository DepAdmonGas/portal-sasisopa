<?php
require('../../../app/help.php');

$rep_mes = date("m");
$rep_year = date("Y");

for ($i = 1; $i <= 12; $i++) {
$sql_reportecre = "SELECT * FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' and mes = '".$i."' and year = '".$rep_year."' ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
$numero_reportecre = mysqli_num_rows($result_reportecre);
if ($numero_reportecre == "") {
$sql_insert = "INSERT INTO re_reporte_cre_mes (
id_estacion,mes,year,f_producto_uno,f_producto_dos,f_producto_tres,fi_producto_uno,fi_producto_dos,fi_producto_tres,ff_producto_uno,ff_producto_dos,ff_producto_tres)
VALUES ('".$Session_IDEstacion."','".$i."','".$rep_year."','','','','','','','','','')";
mysqli_query($con, $sql_insert);
}
}

?>

  <div class="row">
    <?php
    $sql_years = "SELECT year FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' GROUP BY year ORDER BY year desc";
$result_years = mysqli_query($con, $sql_years);
$numero_years = mysqli_num_rows($result_years);

while($row_years = mysqli_fetch_array($result_years, MYSQLI_ASSOC)){
$year = $row_years['year'];
echo "


<div class='col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 mb-2'>
<div class='border p-2 text-center c-pointer bg-info' onclick='ListaAnual(".$year.")'>
<div class='text-white'><h5>".$year."</h5></div>
<div><small class='text-white'>Reporte estadístico de la CRE</small></div>
</div>
</div>";
}
    ?>

</div>