<?php
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];
$id = $_GET['id'];

$sql = "SELECT * FROM tb_analisis_riesgo WHERE id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$fecha = $row['fecha'];
$descripcion = $row['descripcion'];
}
?>

        <div class="modal-header">
          <h4 class="modal-title">Editar análisis de riesgo</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        
        <div class="modal-body">
<div class="row">


<div class="col-12 mb-2">
          <div class="text-secondary">Fecha:</div>
          <input type="date" class="form-control rounded-0 mt-1" id="Fecha" value="<?=$fecha;?>">
</div>

<div class="col-12 mb-2">
          <div class="text-secondary mt-2">Descripción:</div>
          <textarea class="form-control rounded-0 mt-1" id="Descripcion"><?=$descripcion;?></textarea>
</div>

<div class="col-12 mb-2">
          <div class="text-secondary mt-2">Documento:</div>
          <input type="file" class="mt-1" id="Documento">
</div>

<div class="col-12 mb-2">
<div id="DivResultadoPDF" class="mt-2"></div>
</div>        
        
</div>
          
        </div>

        
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary rounded-0" onclick="BtnEditar(<?=$idEstacion;?>,<?=$id;?>)">Editar</button>
      </div> 