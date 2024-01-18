<?php
require('../../../app/help.php');

$idAtencion = $_GET['idAtencion'];
$idHallazgo = $_GET['idHallazgo'];


?>
<div class="modal-header">
<h4 class="modal-title">Agregar evidencia</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<div><h6>Evidencia:</h6></div>

<div class="input-group mb-3">
  <input type="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" id="Evidencia">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="Evidencia(<?=$idAtencion;?>,<?=$idHallazgo;?>)">Agregar evidencia</button>
  </div>

</div>

<?php  

$sqlAH = "SELECT * FROM tb_atencion_hallazgos_evidencia WHERE id_hallazgo = '".$idHallazgo."'";
$resultAH = mysqli_query($con, $sqlAH);
$numeroAH = mysqli_num_rows($resultAH);

?>

<table class="table table-bordered table-striped table-sm table-hover ">
<thead>
<tr>
</tr>
</thead>
<tbody>
    <?php 
  if ($numeroAH > 0) {
    while($rowAH = mysqli_fetch_array($resultAH, MYSQLI_ASSOC)){

    $idEvidencia = $rowAH['id'];

      echo "<tr>";
      echo "<td class='align-middle'><a href='".RUTA_ARCHIVOS."atencion-hallazgos/".$rowAH['archivo']."' download>".$rowAH['archivo']."</a></td>";
      echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' onclick='EliminarEvidencia(".$idAtencion.",".$idHallazgo.",".$idEvidencia.")'></td>";
      echo "</tr>";

    }
  }else{
   echo "<tr><td colspan='7' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
  }
    ?>
</tbody>
</table>

</div>
