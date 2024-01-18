<?php
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];
$id = $_GET['id'];

$sql = "SELECT * FROM tb_analisis_riesgo WHERE id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$fecha = FormatoFecha($row['fecha']);
$descripcion = $row['descripcion'];
}

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
        <div class="font-weight-light mb-1" style="font-size: 1.2em;"><b>Fecha:</b> <?=$fecha;?></div>
        <div class="font-weight-light mb-1" style="font-size: 1.2em;"><b>Descripción:</b> <?=$descripcion;?></div>
        </div>

        <div class="text-secondary mt-2">Descripción:</div>
        <textarea class="form-control rounded-0 mt-1" id="Descripcion"></textarea>
 
        <div class="row mt-3">

          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2">
            <input type="file" id="Anexo">
          </div>

          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2 text-right">
            <button type="button" class="btn btn-success btn-sm rounded-0" onclick="BtnAnexo(<?=$idEstacion;?>,<?=$id;?>)">Guardar documento</button>
          </div>

        </div>


        <div id="DivAnexoPDF"></div>
<hr>


<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm ">
<thead>
<tr>
  <th class="">Descripción</th>  
  <th width="32"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></th>
  <th width="32"><img src="<?=RUTA_IMG_ICONOS;?>eliminar.png"></th>
</tr>
</thead>
<tbody>
<?php 
if ($numero_anexo > 0) {
while($row_anexo = mysqli_fetch_array($result_anexo, MYSQLI_ASSOC)){

$idanexo = $row_anexo['id'];

echo '<tr>';
echo '<td>'.$row_anexo['descripcion'].'</td>';
echo '<td class="text-center"><a style="cursor: pointer;" href="../archivos/analisis-riesgo/'.$row_anexo['documento'].'" download ><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a></td>';


echo '<td class="text-center"><a onclick="EliminarAAR('.$idEstacion.','.$id.','.$idanexo.')" style="cursor: pointer;" ><img src="'.RUTA_IMG_ICONOS.'eliminar.png"></a></td>';
echo '</tr>';

}
}else{
  echo "<tr><td colspan='4' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";    
}
?>
</tbody> 
</table>
</div>

</div>
