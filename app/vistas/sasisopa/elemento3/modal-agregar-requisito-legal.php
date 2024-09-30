<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/RequisitoLegal.php";
$class_requisito_legal = new RequisitoLegal();
$NG = "";

if($_GET['NG'] == "Municipal"){
$NG = ' AND mun_alc_est = "'.$Session_DiMunicipio.'" ';
}else if($_GET['NG'] == "Estatal"){
$NG = ' AND mun_alc_est = "'.$Session_DiEstado.'" ';
}else if($_GET['NG'] == "Federal"){
$NG = '';
}else if($_GET['NG'] == "Varios"){
$NG = '';
}

$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE nivel_gobierno = '".$_GET['NG']."' $NG AND (id_estacion = '".$Session_IDEstacion."' OR id_estacion = 0) AND estado = 1 ORDER BY permiso ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

?>
<script type="text/javascript">
$('.selectize').selectize({
sortField: 'text'
});
</script>
  <div class="modal-header rounded-0 head-modal">
  <h4 class="modal-title text-white">Agregar requisito legal</h4>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">

<h5 class="">Permiso</h5>
<select class="selectize" placeholder="Requisito legal" id="requisitolegal">
<option value="">Permiso</option>
  <?php
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

if($row['nivel_gobierno'] == ""){$ng = "";}else{$ng = $row['nivel_gobierno'];}
if($row['mun_alc_est'] == ""){$mae = "";}else{$mae = ", ".$row['mun_alc_est'];}
if($row['dependencia'] == ""){$de = "";}else{$de = ", ".$row['dependencia'];}
if($row['permiso'] == ""){$per = "";}else{$per = ", ".$row['permiso'];}

  $valRequisito = $class_requisito_legal->valRequisito($Session_IDEstacion,$row['id']);
  if($valRequisito == 0){
  $requisito = $ng;
  echo '<option value="'.$row['id'].'">'.$requisito.$mae.$de.$per.'</option>';
  }

  }

  ?>
</select>

<hr>

<div class="row">

  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
  <h5>Vigencia</h5>
    <select class="form-control rounded-0" id="vigencia">
    <option value="">Seleccione</option>
    <option value="Anual">Anual</option>
    <option value="Bianual">Bianual</option>
    <option value="Permanente">Permanente</option>
    <option value="Trimestral">Trimestral</option>
    <option value="Diario">Diario</option>
    <option value="Cuando se realice cambio">Cuando se realice cambio</option>
    <option value="Semestral">Semestral</option>
    <option value="Mejora continua">Mejora continua</option>
    <option value="3 años">3 años</option>
    <option value="5 años">5 años</option>
    <option value="10 años">10 años</option>
    <option value="30 años">30 años</option>
    </select>
  </div>
</div>

<div class="row">
   
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-3">
  <h5>Fecha de emisión</h5>
   <input type="date" class="form-control rounded-0" id="fechaemision" onchange="Vencimiento()">
  </div>

  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-3">
  <h5>Fecha de vencimiento</h5>
  <div id="fechavencimiento" style="font-size: 1.05em" class="ml-2">S/I</div>
  </div>

</div>

<div class="row">
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-3">
  <h5>Acuse PDF</h5>
  <input type="file" id="acusePDF">
  </div>
  
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-3">
  <h5>Requisito Legal PDF</h5>
  <input type="file" id="requisitoPDF">
  </div>
</div>

<hr>

<h5 class="mt-3">Renovación</h5>

<div style="overflow-y: hidden;">
<table class="table table-sm table-bordered">
  <tbody>
    <tr class="font-weight-bold">
    <td class="text-center align-middle bg-light text-black">Ene</td>
    <td class="text-center align-middle bg-light text-black">Feb</td>
    <td class="text-center align-middle bg-light text-black">Mar</td>
    <td class="text-center align-middle bg-light text-black">Abr</td>
    <td class="text-center align-middle bg-light text-black">May</td>
    <td class="text-center align-middle bg-light text-black">Jun</td>
    <td class="text-center align-middle bg-light text-black">Jul</td>
    <td class="text-center align-middle bg-light text-black">Ago</td>
    <td class="text-center align-middle bg-light text-black">Sep</td>
    <td class="text-center align-middle bg-light text-black">Oct</td>
    <td class="text-center align-middle bg-light text-black">Nov</td>
    <td class="text-center align-middle bg-light text-black">Dic</td>   
  </tr> 
  <tr>
    <td class="text-center align-middle"><input type="checkbox" id="ene" style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="feb" style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="mar" style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="abr" style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="may" style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="jun" style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="jul" style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="ago" style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="sep" style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="oct" style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="nov" style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="dic" style="zoom: 150%;"></td>
  </tr>
  </tbody>
</table>
</div>


<hr>

  <div class="text-right mt-3">
  <button type="button" class="btn btn-primary rounded-0" onclick="AgregarRL('<?=$_GET['NG'];?>')">Agregar</button>
  </div>

  </div>