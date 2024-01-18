<?php
require('../../../app/help.php');
$idre = $_GET['id'];
$idUsuario = $_GET['idUsuario'];
$Estacion = $_GET['Estacion'];

$sql_programa_m = "SELECT * FROM rl_requisitos_legales_calendario WHERE id = '".$idre."' ";
$result_programa_m = mysqli_query($con, $sql_programa_m);
$numero_programa_m = mysqli_num_rows($result_programa_m);

while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
$idrequisitolegal = $row_programa_m['id_requisito_legal'];
$vigencia = $row_programa_m['vigencia'];

if($idrequisitolegal == 0){
$requisoLegal = $row_programa_m['requisito_legal']; 
}else{
$requisoLegal = DetalleRL($idrequisitolegal,$con);
}

}

function DetalleRL($idrequisitol,$con){

$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE id = '".$idrequisitol."' LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$nivelgobierno = $row['nivel_gobierno'];
$munalcest = $row['mun_alc_est'];
$dependencia = $row['dependencia']; 
$permiso = $row['permiso']; 
}

return $permiso;
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
  <div class="col-6">
  <h5>Fecha de emisión</h5>
  <input type="date" class="form-control" id="fechaemision" style="border-radius: 0px;" onchange="Vencimiento()">
  </div>
  <div class="col-6">
   <h5>Fecha de vencimiento</h5>
  <div id="fechavencimiento" style="font-size: 1.05em">S/I</div>
  </div>
</div>


<table class="table table-bordered table-sm mt-3">
  <tr style="font-weight: bold; ">
    <td class="text-center align-middle table-secondary">Acuse PDF</td>    
    <td class="text-center align-middle table-secondary">Requisito Legal PDF</td>   
  </tr>
  <tr>
  <td colspan="1"><input type="file" id="acusePDFN" style="font-size: .8em;"></td>
   <td colspan="1"><input type="file" id="requisitoPDFN" style="font-size: .8em;"></td>
  </tr>
 </table>

<div class="text-right">
<button type="button" class="btn btn-secondary btn-sm rounded-0" onclick="CancelarAgregar(<?=$idre;?>, <?=$idUsuario;?>,<?=$Estacion;?>)">Cancelar</button>
<button type="button" class="btn btn-primary btn-sm rounded-0" onclick="AgregarRequisito(<?=$idre;?>, <?=$idUsuario;?>,<?=$Estacion;?>)">Agregar</button>
</div>

</div>