<?php
require('../../../app/help.php');

$sqlCE = "SELECT * FROM tb_calibracion_equipos_tanques WHERE id = '".$_GET['ID']."' ";
$resultCE = mysqli_query($con, $sqlCE);
$numeroCE = mysqli_num_rows($resultCE);
while($rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC)){
$resultados = $rowCE['resultados'];
}

?>

  <div class="modal-header">
  <h4 class="modal-title">Adjuntar resultados</h4>
  <button type="button" class="close" onclick="location.reload()">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">
  

  <div>* Resultados:</div>
  <input type="file" name="" id="Archivo">
  
  <div class="text-right">
    <button type="button" class="btn btn-primary rounded-0" onclick="AgregarR(<?=$_GET['ID'];?>)">Guardar</button>
  </div>

  <hr>
  <?php if($resultados != ""){ ?>
  <h6>Resultados de la calibración</h6>
  <a href="../archivos/calibracion/<?=$resultados;?>" download style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
  <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
  </a>
  <?php } ?>

  </div>
