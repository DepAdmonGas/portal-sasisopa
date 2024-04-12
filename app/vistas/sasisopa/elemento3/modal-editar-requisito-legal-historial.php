<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/RequisitoLegal.php";
$class_requisito_legal = new RequisitoLegal();
$idre = $_GET['id'];
$idmatriz = $_GET['idmatriz'];

$sql_programa_m = "SELECT * FROM rl_requisitos_legales_calendario WHERE id = '".$idre."' ";
$result_programa_m = mysqli_query($con, $sql_programa_m);
$numero_programa_m = mysqli_num_rows($result_programa_m);

while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
$idrequisitolegal = $row_programa_m['id_requisito_legal'];


if($idrequisitolegal == 0){
$requisoLegal = $row_programa_m['requisito_legal']; 
}else{
    $array = $class_requisito_legal->DetalleRL($idrequisitolegal);
    $requisoLegal = $array['permiso'];
}

}

$sql_matriz = "SELECT acusepdf, requisitolegalpdf, fecha_emision, fecha_vencimiento FROM rl_requisitos_legales_matriz WHERE id = '".$idmatriz."' ORDER BY id desc LIMIT 1";
$result_matriz = mysqli_query($con, $sql_matriz);
$numero_matriz = mysqli_num_rows($result_matriz);
while($row_matriz = mysqli_fetch_array($result_matriz, MYSQLI_ASSOC)){
$acusepdf = $row_matriz['acusepdf'];
$requisitolegalpdf = $row_matriz['requisitolegalpdf'];
$fechaemision = $row_matriz['fecha_emision'];
$fechavencimiento = $row_matriz['fecha_vencimiento'];
}

if ($acusepdf == "") {
  $imgPDFA = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
  }else{
  $imgPDFA = "<a target='_blank' href='../".$acusepdf."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
  }

  if ($requisitolegalpdf == "") {
  $imgPDFRL = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
  }else{
  $imgPDFRL = "<a target='_blank' href='../".$requisitolegalpdf."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
  }
?>

  <div class="modal-header">
  <h4 class="modal-title"><?=$requisoLegal;?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">


<div class="row">
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
  <h5>Acuse PDF</h5>
  <input type="file" id="acusePDFED" style="font-size: .8em;">
  </div>
  
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
  <h5>Requisito Legal PDF</h5>
  <input type="file" id="requisitoPDFED" style="font-size: .8em;">
  </div>
</div>


 <div></div>

  <hr>

<div  id="respuesta"><b>Fecha emisión:</b></div>
 <input type="date" class="form-control rounded-0 mt-2" value="<?=$fechaemision;?>" id="fechaemision">

 <div  id="respuesta"><b>Fecha vencimiento:</b></div>
 <input type="date" class="form-control rounded-0 mt-2" value="<?=$fechavencimiento;?>" id="fechavencimiento">

<div class="text-right mt-3">
<button type="button" class="btn btn-secondary btn-sm rounded-0" onclick="CancelarAgregar(<?=$idre;?>)">Cancelar</button>
<button type="button" class="btn btn-primary btn-sm rounded-0" onclick="EditarRequisito(<?=$idre;?>,<?=$idmatriz;?>)">Editar</button>
</div>

</div>