<?php
require('../../../app/help.php');

$idReporte = $_GET['idReporte'];

$sql_resultado = "SELECT * FROM tb_implementacion_sasisopa_procedimientos WHERE id_reporte = '".$idReporte."' ";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);


?>
 <div class="modal-header">
   <h4 class="modal-title">Detalle de la implementación de los procedimientos del SASISOPA</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 
<div class="modal-body">

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-sm">
<tr>
<td class="text-center align-middle"><img class="text-center" src="<?php echo RUTA_IMG_LOGOS."Logo.png";?>" style="width: 200px;"></td>
<td colspan="2" class="text-center align-middle"><b>Control de la implementación de los procedimientos del SASISOPA</b></td>
<td class="text-center align-middle">Fo.ADMONGAS.029</td>
</tr>
<tr>
<td class="text-center align-middle">Realizado por: Nelly Estrada Garcia </td>
<td class="text-center align-middle">Revisado por: Eduardo Galicia Flores </td>
<td class="text-center align-middle">Autorizado por: Tomas Tarno Quinzaños </td>
<td class="text-center align-middle">Fecha de autorizacion 01/10/2018</td>
</tr>
</table>
</div>

<div class="mb-2" style="overflow-y: hidden;">
 <table class="table table-bordered table-sm">
  <thead>
   <tr>
     <th class="text-center align-middle">Fecha de implementación</th>
     <th class="text-center align-middle">Nombre del procedimiento</th>
     <th class="text-center align-middle" width="300px">Breve descripción de la implementación </th>
     <th class="text-center align-middle">
      <div class="border-bottom pb-1">Se dio a conocer la implementación</div>
      <div><label class="border-right pr-3 pl-2">Si</label> <label class="pl-2 pr-2">No</label></div>
    </th>
    <th class="text-center align-middle">Puestos de personal enterados de la implementación</th>
    <th class="text-center align-middle" width="300px">Observaciones</th>
   </tr>
   </thead>
   <tbody style="font-size: .9em">
   	<?php
    while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){

    	$id = $row_resultado['id'];

		$sql_ch = "SELECT * FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."'";
		$result_ch = mysqli_query($con, $sql_ch);
		$numero_ch = mysqli_num_rows($result_ch);

    	echo "<tr>";
    	echo "<td class='text-center align-middle'>".FormatoFecha($row_resultado['fecha_implementacion'])."</td>";
    	echo "<td class='align-middle'><b>".$row_resultado['procedimiento']."</b></td>";
    	echo "<td class='align-middle'>".$row_resultado['descripcion']."</td>";  
    	echo "<td class='text-center align-middle'>".$row_resultado['informacion']."</td>";
    	echo "<td class='align-middle'>";
    	while($row_ch = mysqli_fetch_array($result_ch, MYSQLI_ASSOC)){
    	echo "<span class='badge badge-info font-weight-light ml-1 mb-1' style='font-size: .7em'>".$row_ch['puesto']."</span>";
    	}
    	echo "</td>";
    	echo "<td class='align-middle'>".$row_resultado['observaciones']."</td>";
    	echo "</tr>";


    }
    ?>

   </tbody>
</table>
</div>

 </div>