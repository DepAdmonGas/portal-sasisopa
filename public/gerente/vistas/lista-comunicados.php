<?php
require('../../../app/help.php');

$sql_comunicado = "SELECT * FROM co_comunicados WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY id_comunicado desc";
$result_comunicado = mysqli_query($con, $sql_comunicado);
$numero_comunicado = mysqli_num_rows($result_comunicado);

?>
<script type="text/javascript">
function BtnDetalle(id){
$('#myModalDetalle').modal('show');
$('#DivDetalle').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;' />");
$('#DivDetalle').load('public/gerente/vistas/detalle-comunicado.php?idcomunicado='+id);  
}
</script>
<table class="table table-bordered table-striped table-sm table-hover pb-0 mb-0">
<thead>	
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Tema</th>
<th class="text-center align-middle">Detalle</th>
<th class="text-center align-middle">Dirigido a</th>
</tr>
</thead>
<tbody style="font-size: .9em;">
<?php
if ($numero_comunicado > 0) {
while($row_comunicado = mysqli_fetch_array($result_comunicado, MYSQLI_ASSOC)){
$separacadena = explode(",", $row_comunicado['dirigidoa']);
echo "<tr style='cursor: pointer' onclick='BtnDetalle(".$row_comunicado['id'].")'>";
echo "<td class='text-center fw-bold'>".$row_comunicado['id_comunicado']."</td>";
echo "<td class='text-center'>".FormatoFecha($row_comunicado['fecha'])."</td>";
echo "<td class='text-center'>".$row_comunicado['tema']."</td>";
echo "<td class='text-center'>".substr($row_comunicado['detalle'],0,50)."</td>";
echo "<td class='text-center'>";
for ($i=0; $i < count($separacadena) ; $i++) { 
$sql_puestos = "SELECT tipo_puesto FROM tb_puestos WHERE id = '".$separacadena[$i]."' ";
$result_puestos = mysqli_query($con, $sql_puestos);
while($row_puestos = mysqli_fetch_array($result_puestos, MYSQLI_ASSOC)){
$puesto = $row_puestos['tipo_puesto'];
?>
<span style="font-size: .8em;"><?=$puesto;?></span>
<?php
}
}
echo "</td>";
echo "</tr>";
}
?>
<?php	
}else{
echo "<td colspan='5' class='text-center text-secondary' style='font-size: .8em;'>No se encontraron comunicados</td>";
}
?>
</tbody>
</table>

 <div class="modal fade bd-example-modal-lg" id="myModalDetalle" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">

      
      <div id="DivDetalle"></div>  

      </div>
    </div>
    </div> 