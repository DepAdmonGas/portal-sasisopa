<?php
require('../../../../app/help.php');

$id = $_GET['id'];
$R1 = '';
$R2 = '';
$R3 = '';
$R4 = '';
$R5 = '';
$R6 = '';
$R7 = '';
$R8 = '';
$R9 = '';
$R10 = '';
$Nombre = "";

$sql = "SELECT * FROM tb_requisicion_obra_formato_15 WHERE id_requisicion = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$Fecha = $row['fecha_lv'];
$Hora = $row['hora_lv'];
$NomUsuario = NomUsuario($row['id_usuario'],$con);
$idUsuario = $NomUsuario['id'];
$Nombre = $NomUsuario['nombre'];

if($row['pregunta1'] == 1){
$R1 = 'checked';
}else{
$R1 = '';  
}

if($row['pregunta1'] == 0){
$R2 = 'checked';
}else{
$R2 = '';  
}

if($row['pregunta2'] == 1){
$R3 = 'checked';
}else{
$R3 = '';  
}

if($row['pregunta2'] == 0){
$R4 = 'checked';
}else{
$R4 = '';  
}

if($row['pregunta3'] == 1){
$R5 = 'checked';
}else{
$R5 = '';  
}

if($row['pregunta3'] == 0){
$R6 = 'checked';
}else{
$R6 = '';  
}

if($row['pregunta4'] == 1){
$R7 = 'checked';
}else{
$R7 = '';  
}

if($row['pregunta4'] == 0){
$R8 = 'checked';
}else{
$R8 = '';  
}

if($row['pregunta5'] == 1){
$R9 = 'checked';
}else{
$R9 = '';  
}

if($row['pregunta5'] == 0){
$R10 = 'checked';
}else{
$R10 = '';  
}

}

function NomUsuario($id, $con){
$sql_lista = "SELECT id,nombre FROM tb_usuarios WHERE id = '".$id."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
$row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC);
$id = $row_lista['id'];
$nombre = $row_lista['nombre']; 
$arrayName = array('id' => $id, 'nombre'=> $nombre);
return $arrayName;
}

?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Listas de verificación
</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<table class="table table-bordered table-sm">
<tbody>
  <tr>
    <td class="text-center align-middle"><img width="120px" src="<?=RUTA_IMG_LOGOS;?>logo.png"></td>
    <td class="text-center align-middle" colspan="2"><b>Listas de verificación</b></td>
    <td class="text-center align-middle"><b>Fo.ADMONGAS.015</b></td>
  </tr>
  <tr>
    <td class="text-center align-middle">Elaborado por: Nelly Estrada Garcia</td>
    <td class="text-center align-middle">Revisado por: Eduardo Galicia Flores</td>
    <td class="text-center align-middle">Autorizado por: Tomas Tarno Quinzaños</td>
    <td class="text-center align-middle">Fecha de aprobación 01-oct-18</td>
  </tr>
</tbody>
</table>

<b>Fecha:</b>
<input type="date" class="form-control input-style rounded-0" id="Fecha" value="<?=$Fecha;?>">
<b>Hora:</b>
<input type="time" class="form-control input-style rounded-0" id="Hora" value="<?=$Hora?>">

<table class="table table-sm table-bordered mt-3">
    <thead>
    <tr>
      <th></th>
      <th>SI</th>
      <th>NO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1. El trabajo fue completado conforme a lo solicitado</td>
      <td class="text-center align-middle"><input type="radio" name="uno" id="Si1" <?=$R1?> ></td>
      <td class="text-center align-middle"><input type="radio" name="uno" id="No1" <?=$R2?> ></td>
    </tr>
     <tr>
      <td>2. El trabajo se realizo conforme al procedimiento </td>
      <td class="text-center align-middle"><input type="radio" name="dos" id="Si2" <?=$R3?> ></td>
      <td class="text-center align-middle"><input type="radio" name="dos" id="No2" <?=$R4?> ></td>
    </tr>
     <tr>
      <td>3. En todo momento se utilizo el EPP </td>
      <td class="text-center align-middle"><input type="radio" name="tres" id="Si3" <?=$R5?> ></td>
      <td class="text-center align-middle"><input type="radio" name="tres" id="No3" <?=$R6?> ></td>
    </tr>
     <tr>
      <td>4. Los trabajadores tomaron en cuenta los procedimiento de seguridad</td>
      <td class="text-center align-middle"><input type="radio" name="cuatro" id="Si4" <?=$R7?> ></td>
      <td class="text-center align-middle"><input type="radio" name="cuatro" id="No4" <?=$R8?> ></td>
    </tr>
     <tr>
      <td>5. Ocurrió algún accidente durante el servicio realizado </td>
      <td class="text-center align-middle"><input type="radio" name="cinco" id="Si5" <?=$R9?> ></td>
      <td class="text-center align-middle"><input type="radio" name="cinco" id="No5" <?=$R10?> ></td>
    </tr>
  </tbody>
</table>

<b>SUPERVISO:</b>

<select class="form-control rounded-0" id="idSuperviso">
  <option value="<?=$idUsuario;?>"><?=$Nombre;?></option>
  <?php  

$sql = "SELECT id, nombre FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND id_puesto = '6' AND  estatus = 0";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
}
  ?>
</select>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnGuardarLV(<?=$id;?>)">Guardar</button>
</div>


