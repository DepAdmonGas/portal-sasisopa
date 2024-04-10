<?php
require('../../../../app/help.php');

$id = $_GET['id'];

$sql = "SELECT * FROM tb_analisis_riesgo WHERE id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$fecha = FormatoFecha($row['fecha']);
$descripcion = $row['descripcion'];

$sql_anexo = "SELECT * FROM tb_analisis_riesgo_anexos WHERE id_analisis = '".$id."' ";
$result_anexo = mysqli_query($con, $sql_anexo);
$numero_anexo = mysqli_num_rows($result_anexo);
?>

        <div class="modal-header">
          <h4 class="modal-title">Análisis de riesgo Anexos</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        <div class="border-bottom pb-2">
        <div class="font-weight-light" style="font-size: 1.2em;"><b>Fecha:</b> <?=$fecha;?></div>
        <div class="font-weight-light" style="font-size: 1.2em;"><b>Descripción:</b> <?=$descripcion;?></div>
        </div>

<table class="table table-bordered table-striped table-hover table-sm ">
<thead>
<tr>
  <th class="">Descripción</th>  
  <th width="32"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></th>
</tr>
</thead>
<tbody>
<?php 
if ($numero_anexo > 0) {
while($row_anexo = mysqli_fetch_array($result_anexo, MYSQLI_ASSOC)){

$idanexo = $row_anexo['id'];

echo '<tr>';
echo '<td>'.$row_anexo['descripcion'].'</td>';
echo '<td class="text-center"><a style="cursor: pointer;" href="'.RUTA_ARCHIVOS.'/analisis-riesgo/'.$row_anexo['documento'].'" download ><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a></td>';
echo '</tr>';

}
}else{
  echo "<tr><td colspan='4' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";    
}
?>
</tbody> 
</table>

</div>
