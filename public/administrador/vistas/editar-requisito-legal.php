<?php
require('../../../app/help.php');
$idestacion = $_GET['idestacion'];
$ID = $_GET['id'];

$sql_programa_m = "SELECT * FROM rl_requisitos_legales_calendario WHERE id = '".$ID."' ";
$result_programa_m = mysqli_query($con, $sql_programa_m);
$numero_programa_m = mysqli_num_rows($result_programa_m);

while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){


$nivelGobierno = $row_programa_m['nivel_gobierno'];
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
$Cjunio = 0;
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
<form action="" method="post">
<div class="modal-body">   

<input type="text" name="id" value="<?=$ID;?>" style="display: none;"> 
<input type="text" name="idestacion" value="<?=$idestacion;?>" style="display: none;">     
<input type="text" name="idcalendario" value="<?=$IDCalendario;?>" style="display: none;"> 

<div class="row">
<div class="col-3">
<label style="font-size: .8em;">Nivel de gobierno</label>
<select class="form-control" name="nivelgobiernoE" required="" style="border-radius: 0px;font-size: .9em;">
<option value="<?=$nivelGobierno;?>"><?=$nivelGobierno;?></option>
<?php if ($nivelGobierno != "Municipal") {echo "<option value='Municipal'>Municipal</option>";} ?>
<?php if ($nivelGobierno != "Estatal") {echo "<option value='Estatal'>Estatal</option>";} ?>
<?php if ($nivelGobierno != "Federal") {echo "<option value='Federal'>Federal</option>";} ?>
<?php if ($nivelGobierno != "Varios") {echo "<option value='Varios'>Varios</option>";} ?>
</select>
</div>
<div class="col-9">
<label style="font-size: .8em;">Nombre del requisito legal</label>
<input type="text" class="form-control" name="nombreRLE" style="border-radius: 0px;" value="<?=$requisoLegal;?>">
</div>
</div>

<div class="row" style="margin-top: 10px;">
<div class="col-3">
	<label style="font-size: .8em;">Vigencia</label>
    <select class="form-control" name="vigenciaE" required="" style="border-radius: 0px;font-size: .9em;">
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

<table class="table table-bordered table-sm" style="margin-top: 10px;">
  <tr style="font-weight: bold; ">
  <td colspan="12" class="align-middle text-center table-secondary">Renovación</td>
  </tr>
  <tr style="font-weight: bold; ">
    <td class="text-center align-middle table-secondary">Ene</td>
    <td class="text-center align-middle table-secondary">Feb</td>
    <td class="text-center align-middle table-secondary">Mar</td>
    <td class="text-center align-middle table-secondary">Abr</td>
    <td class="text-center align-middle table-secondary">May</td>
    <td class="text-center align-middle table-secondary">Jun</td>
    <td class="text-center align-middle table-secondary">Jul</td>
    <td class="text-center align-middle table-secondary">Ago</td>
    <td class="text-center align-middle table-secondary">Sep</td>
    <td class="text-center align-middle table-secondary">Oct</td>
    <td class="text-center align-middle table-secondary">Nov</td>
    <td class="text-center align-middle table-secondary">Dic</td>   
  </tr>
  <tr>
    <td class="text-center align-middle"><input type="checkbox" name="eneE" <?=$Cenero;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" name="febE" <?=$Cfebrero;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" name="marE" <?=$Cmarzo;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" name="abrE" <?=$Cabril;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" name="mayE" <?=$Cmayo;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" name="junE" <?=$Cjunio;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" name="julE" <?=$Cjulio;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" name="agoE" <?=$Cagosto;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" name="sepE" <?=$Cseptiembre;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" name="octE" <?=$Coctubre;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" name="novE" <?=$Cnoviembre;?> style="zoom: 150%;"></td>
    <td class="text-center align-middle"><input type="checkbox" name="dicE" <?=$Cdiciembre;?> style="zoom: 150%;"></td>
  </tr>

</table>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
<input type="submit" class="btn btn-primary" name="BtnAceptar" style="border-radius: 0px;" value="Aceptar" >
</div>
</form>

