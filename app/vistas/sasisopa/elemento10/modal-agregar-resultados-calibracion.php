<?php
require('../../../../app/help.php');

$sqlCE = "SELECT * FROM tb_calibracion_equipos WHERE id = '".$_GET['ID']."' ";
$resultCE = mysqli_query($con, $sqlCE);
$numeroCE = mysqli_num_rows($resultCE);
$rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC);
$Folio = $rowCE['folio'];
$Fecha = $rowCE['fecha'];
$Equipo = $rowCE['equipo'];
$Observaciones = $rowCE['observaciones'];
$Responsableveri = $rowCE['responsable_verificacion'];
$Estado = $rowCE['estado'];
$resultados = $rowCE['resultados'];
?>

  <div class="modal-header">
  <h4 class="modal-title">Adjuntar resultados</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">
  
  <div class="row">
    <div class="col-6">
    <h6>Equipo: <?=$Equipo;?></h6>
    </div>
    <div class="col-6">
      <h6>Fecha: <?=FormatoFecha($Fecha);?></h6>
    </div>
  </div>

  <div>* Resultados:</div>
  <input type="file" name="" id="Archivo">
  
  <div class="text-right">
    <button type="button" class="btn btn-primary rounded-0" onclick="AgregarR(<?=$_GET['ID'];?>)">Guardar</button>
  </div>

  <div id="DivResultadoPDF" class="text-center"></div>

  <hr>
  <?php if($resultados != ""){ ?>
  <h6>Resultados de la calibración</h6>
  <a href="archivos/calibracion/<?=$resultados;?>" download style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
  <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
  </a>
  <?php } ?>

  </div>
