<?php 
require('../../../../app/help.php');

$IdReporte = $_POST['IdReporte'];
$i = 1;

$sql_encuesta = "SELECT id, nombre FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$IdReporte."'";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);

if ($numero_encuesta > 0) {
echo "<div class='m-2'>";
echo "<table class='table table-sm table-hover table-striped table-bordered' style='font-size: .9em;'>";
echo "<thead><tr><th>ID</th><th>Cliente</th></tr><thead>";
echo "<tbody>";
while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){
echo "<tr class='cursor-pointer' style='cursor: pointer;' onclick='Detalle(".$row_encuesta['id'].")'>";
echo "<td>".$i."</td>";
echo "<td>".$row_encuesta['nombre']."</td>";
echo "</tr>";

$i ++;
}
echo "<tr>";
echo "<td colspan='2'>Total: <b>".$numero_encuesta."</b> clientes encuestados</td>";
echo "<tr>";
echo "</tbody>";
echo "</table>";
echo "</div>";
}else{
echo "<div class='text-center p-4'><small class='text-secondary'>No se encontraro información</small></div>";
}
?>
<div class="modal fade bd-example-modal-lg" id="ModalDetalle" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
      	<div id="DivContenidoModal"></div>        
      </div>
    </div>
    </div>