<?php
require('../../../app/help.php');

$idDocumento = $_GET['id'];
$idReporte = $_GET['idReporte'];

$sql = "SELECT nombre FROM tb_calibracion_tanques_documentos WHERE id = '".$idDocumento."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$nombre = $row['nombre'];
}

?>

  <div class="modal-header">
  <h4 class="modal-title"><?=$nombre;?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

 <div><small>* Documento:</small></div>
 <input type="file" class="mt-2" id="Documento">

  <div class="text-right">
  <button type="button" class="btn btn-primary rounded-0" onclick="Guardar(<?=$idDocumento;?>,<?=$idReporte;?>)">Guardar</button>
  </div>


  <table class="table table-sm table-bordered mt-3">
  <thead>
    <tr>
      <th class="text-center align-middle" width="24"><img src="<?=RUTA_IMG_ICONOS;?>descargar.png"></th>
      <th class="text-center align-middle" width="24"><img src="<?=RUTA_IMG_ICONOS;?>eliminar.png"></th>
    </tr>
  </thead> 
  <tbody>

<?php
$sql_lista = "SELECT * FROM tb_calibracion_tanques_detalle WHERE id_calibracion = '".$idReporte."' AND id_documento = '".$idDocumento."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
if ($numero_lista > 0) {
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$id = $row_lista['id'];

if($Session_IDUsuarioBD == 26){
$Eliminar = '<img src="'.RUTA_IMG_ICONOS.'eliminar.png">';
}else{
$Eliminar = '<img src="'.RUTA_IMG_ICONOS.'eliminar.png" onclick="Eliminar('.$id.','.$idDocumento.','.$idReporte.')">'; 
}

echo '<tr>';
echo '<td class="text-center align-middle p-2"><a href="../../archivos/calibracion/'.$row_lista['archivo'].'" download><img src="'.RUTA_IMG_ICONOS.'descargar.png"></a></td>';
echo '<td class="text-center align-middle p-2">'.$Eliminar.'</td>';
echo '</tr>';

}
}else{
echo "<tr><td colspan='3' class='text-center text-secondary'><small>No se encontró información para mostrar </small></td></tr>";
}
?>
  
</tbody>
</table>

  </div>