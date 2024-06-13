<?php
require('../../../app/help.php');

$idestacion = $_GET['idestacion'];
$ID = $_GET['id'];

$sql_estacion = "SELECT di_estado, di_municipio FROM tb_estaciones WHERE id = '".$idestacion."' ";
$result_estacion = mysqli_query($con, $sql_estacion);
$numero_estacion = mysqli_num_rows($result_estacion);
while($row_estaciones = mysqli_fetch_array($result_estacion, MYSQLI_ASSOC)){
$diestado = $row_estaciones['di_estado'];
$dimunicipio = $row_estaciones['di_municipio'];
}

if($_GET['NG'] == "municipal"){
$NG = ' AND mun_alc_est = "'.$dimunicipio.'" ';
}else if($_GET['NG'] == "estatal"){
$NG = ' AND mun_alc_est = "'.$diestado.'" ';
}else if($_GET['NG'] == "federal"){
$NG = '';
}else if($_GET['NG'] == "varios"){
$NG = '';
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

$result = array(
'nivelgobierno' => $nivelgobierno,
'munalcest' => $munalcest,
'dependencia' => $dependencia,
'permiso' => $permiso,);

return $result;
}

$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE nivel_gobierno = '".$_GET['NG']."' $NG AND (id_estacion = '".$idestacion."' OR id_estacion = 0) AND estado = 1 ORDER BY permiso ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

$sql_programa_m = "SELECT * FROM rl_requisitos_legales_calendario WHERE id = '".$ID."' ";
$result_programa_m = mysqli_query($con, $sql_programa_m);
$numero_programa_m = mysqli_num_rows($result_programa_m);

while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){

$idrequisitolegal = $row_programa_m['id_requisito_legal'];

$requisoLegal = $row_programa_m['requisito_legal'];
$vigencia = $row_programa_m['vigencia'];

$enero = $row_programa_m['enero'];
$febrero = $row_programa_m['febrero'];
$marzo = $row_programa_m['marzo'];
$abril = $row_programa_m['abril'];
$mayo = $row_programa_m['mayo'];
$junio = $row_programa_m['junio'];
$julio = $row_programa_m['julio'];
$agosto = $row_programa_m['agosto'];
$septiembre = $row_programa_m['septiembre'];
$octubre = $row_programa_m['octubre'];
$noviembre = $row_programa_m['noviembre'];
$diciembre = $row_programa_m['diciembre'];

if($idrequisitolegal == 0){
$nivelGobierno = $row_programa_m['nivel_gobierno'];
$detalle_rl = "Requisito legal";
}else{
$DetalleRL = DetalleRL($idrequisitolegal,$con); 
$nivelGobierno = $DetalleRL['nivelgobierno'];

if($DetalleRL['nivelgobierno'] == ""){$d_ng = "";}else{$d_ng = $DetalleRL['nivelgobierno'];}
if($DetalleRL['munalcest'] == ""){$d_mae = "";}else{$d_mae = ", ".$DetalleRL['munalcest'];}
if($DetalleRL['dependencia'] == ""){$d_de = "";}else{$d_de = ", ".$DetalleRL['dependencia'];}
if($DetalleRL['permiso'] == ""){$d_per = "";}else{$d_per = ", ".$DetalleRL['permiso'];}

$detalle_rl = $d_ng.$d_mae.$d_de.$d_per;

}


if ($enero == 0) {
$Cenero = "";
}else{
$Cenero = "checked";
}

if ($febrero == 0) {
$Cfebrero = "";
}else{
$Cfebrero = "checked";
}

if ($marzo == 0) {
$Cmarzo = "";
}else{
$Cmarzo = "checked";
}

if ($abril == 0) {
$Cabril = "";
}else{
$Cabril = "checked";
}

if ($mayo == 0) {
$Cmayo = "";
}else{
$Cmayo = "checked";
}

if ($junio == 0) {
$Cjunio = "";
}else{
$Cjunio = "checked";
}

if ($julio == 0) {
$Cjulio = "";
}else{
$Cjulio = "checked";
}

if ($agosto == 0) {
$Cagosto = "";
}else{
$Cagosto = "checked";
}

if ($septiembre == 0) {
$Cseptiembre = "";
}else{
$Cseptiembre = "checked";
}

if ($octubre == 0) {
$Coctubre = "";
}else{
$Coctubre = "checked";
}

if ($noviembre == 0) {
$Cnoviembre = "";
}else{
$Cnoviembre = "checked";
}

if ($diciembre == 0) {
$Cdiciembre = "";
}else{
$Cdiciembre = "checked";
}


}
?>
<script type="text/javascript">
    $('.selectize').selectize({
          sortField: 'text'
      });
</script>

  <div class="modal-header">
  <h4 class="modal-title">Editar requisito legal</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

<h5 class="">Permiso</h5>
<select class="selectize" id="requisitolegal">
<option value="<?=$idrequisitolegal;?>"><?=$detalle_rl;?></option>
  <?php
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

if($row['nivel_gobierno'] == ""){$ng = "";}else{$ng = $row['nivel_gobierno'];}
if($row['mun_alc_est'] == ""){$mae = "";}else{$mae = ", ".$row['mun_alc_est'];}
if($row['dependencia'] == ""){$de = "";}else{$de = ", ".$row['dependencia'];}
if($row['permiso'] == ""){$per = "";}else{$per = ", ".$row['permiso'];}

    $requisito = $ng;
    echo '<option value="'.$row['id'].'">'.$requisito.$mae.$de.$per.'</option>';
  }

  ?>
</select>


<div class="row" style="margin-top: 10px;">

<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mt-2 mb-2 "> 
  <h5 class="">Vigencia</h5>
    <select class="form-control" id="vigencia" required="" style="border-radius: 0px;">
    <option value="<?=$vigencia;?>"><?=$vigencia;?></option>
    <?php if ($vigencia != "Anual") {echo "<option value='Anual'>Anual</option>";} ?>
    <?php if ($vigencia != "Bianual") {echo "<option value='Bianual'>Bianual</option>";} ?>
    <?php if ($vigencia != "Permanente") {echo "<option value='Permanente'>Permanente</option>";} ?>
    <?php if ($vigencia != "Trimestral") {echo "<option value='Trimestral'>Trimestral</option>";} ?>
    <?php if ($vigencia != "Diario") {echo "<option value='Diario'>Diario</option>";} ?>
    <?php if ($vigencia != "Cuando se realice cambio") {echo "<option value='Cuando se realice cambio'>Cuando se realice cambio</option>";} ?>
    <?php if ($vigencia != "Semestral") {echo "<option value='Semestral'>Semestral</option>";} ?>
    <?php if ($vigencia != "Mejora continua") {echo "<option value='Mejora continua'>Mejora continua</option>";} ?>
    <?php if ($vigencia != "3 años") {echo "<option value='3 años'>3 años</option>";} ?>
    <?php if ($vigencia != "5 años") {echo "<option value='5 años'>5 años</option>";} ?>    
    </select> 
</div>

</div>

<hr>

<h5>Renovación</h5>

<div class="mb-2" style="overflow-y: hidden;">
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
    <td class="text-center align-middle"><input type="checkbox" id="ene" <?=$Cenero;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="feb" <?=$Cfebrero;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="mar" <?=$Cmarzo;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="abr" <?=$Cabril;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="may" <?=$Cmayo;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="jun" <?=$Cjunio;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="jul" <?=$Cjulio;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="ago" <?=$Cagosto;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="sep" <?=$Cseptiembre;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="oct" <?=$Coctubre;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="nov" <?=$Cnoviembre;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" id="dic" <?=$Cdiciembre;?> style="zoom: 150%;"></td>
  </tr>
  </tbody>
</table>
</div>

<hr>

<h5>Unificar requisito legal</h5>

<select class="selectize" id="UnificarRL">
<option value="">Selecciona</option>
  <?php
$sql_RL = "SELECT * FROM rl_requisitos_legales_calendario WHERE id_estacion = '".$idestacion."' AND nivel_gobierno = '".$_GET['NG']."' ";
$result_RL = mysqli_query($con, $sql_RL);
$numero_RL = mysqli_num_rows($result_RL);
while($row_RL = mysqli_fetch_array($result_RL, MYSQLI_ASSOC)){

$DetalleRL = DetalleRL($row_RL['id_requisito_legal'],$con);

if($row_RL['id_requisito_legal'] == 0){
$nomRL = $row_RL['requisito_legal'];
}else{
$nomRL = $DetalleRL['nivelgobierno'].", ".$DetalleRL['munalcest'].", ".$DetalleRL['dependencia'].", ".$DetalleRL['permiso'];
}
echo '<option value="'.$row_RL['id'].'">'.$nomRL.'</option>';

}
?>
</select>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="EditarRL(<?=$ID;?>)">Editar</button>
</div>

  </div>