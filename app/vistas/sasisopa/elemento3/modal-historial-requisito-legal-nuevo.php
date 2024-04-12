<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/RequisitoLegal.php";
$class_requisito_legal = new RequisitoLegal();
$idre = $_GET['id'];

$sql_programa_m = "SELECT * FROM rl_requisitos_legales_calendario WHERE id = '".$idre."' ";
$result_programa_m = mysqli_query($con, $sql_programa_m);
$numero_programa_m = mysqli_num_rows($result_programa_m);

while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
$idrequisitolegal = $row_programa_m['id_requisito_legal'];
$vigencia = $row_programa_m['vigencia'];

if($idrequisitolegal == 0){
$requisoLegal = $row_programa_m['requisito_legal']; 
}else{
    $array = $class_requisito_legal->DetalleRL($idrequisitolegal);
    $requisoLegal = $array['permiso'];
}

}
 
?>

  <div class="modal-header">
  <h4 class="modal-title"><?=$requisoLegal;?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

<input type="hidden" id="vigencia" value="<?=$vigencia;?>">

<div class="row">
  
  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 "> 
  <h5>Fecha de emisión</h5>
  <input type="date" class="form-control" id="fechaemision" style="border-radius: 0px;" onchange="Vencimiento()">
  </div>

  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 "> 
   <h5>Fecha de vencimiento</h5>
  <div id="fechavencimiento" style="font-size: 1.05em">S/I</div>
  </div>

</div>

<hr>

<div class="row">
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
  <h5>Acuse PDF</h5>
 <input type="file" id="acusePDFN" style="font-size: .8em;">  </div>
  
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
  <h5>Requisito Legal PDF</h5>
    <input type="file" id="requisitoPDFN" style="font-size: .8em;">  </div>
</div>

<hr>
<div class="text-right">
<button type="button" class="btn btn-secondary btn-sm rounded-0" onclick="CancelarAgregar(<?=$idre;?>)">Cancelar</button>
<button type="button" class="btn btn-primary btn-sm rounded-0" onclick="AgregarRequisito(<?=$idre;?>)">Agregar</button>
</div>

</div>