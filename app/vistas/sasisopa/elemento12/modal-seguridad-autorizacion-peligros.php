<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/SeguridadContratistas.php";

$id = $_GET['id'];
$cprtp1 = "";
$cprtp2 = "";
$cteppc1 = "";
$cteppc2 = "";
$class_seguridad_contratistas = new SeguridadContratistas();
$class_seguridad_contratistas->validarRequisicionObra($id,$Session_DiMunicipio,$Session_DiEstado);

$sqlCR = "SELECT * FROM tb_requisicion_obra_formato_12 WHERE id_requisicion = '".$id."' ";
$resultCR = mysqli_query($con, $sqlCR);
$rowCR = mysqli_fetch_array($resultCR, MYSQLI_ASSOC);
$idFormato = $rowCR['id'];
$dia = $rowCR['dia'];
$mes = $rowCR['mes'];
$year = $rowCR['year'];
$municipio = $rowCR['municipio'];
$estado = $rowCR['estado'];

$trabajorealizar = $rowCR['trabajo_realizar'];
$descripcion = $rowCR['descripcion'];
$area = $rowCR['area'];

$fechainicio = $rowCR['fecha_inicio'];
$fechatermino = $rowCR['fecha_termino'];
$horainicio = $rowCR['hora_inicio'];
$horatermino = $rowCR['hora_termino'];
$prestadorservicio = $rowCR['prestador_servicio'];

if($rowCR['cprtp'] == 1){
$cprtp1 = 'checked';
}else if($rowCR['cprtp'] == 0){
$cprtp2 = 'checked';
}

if($rowCR['cteppc'] == 1){
$cteppc1 = 'checked';
}else if($rowCR['cteppc'] == 0){
$cteppc2 = 'checked';
}

$mombreEmpresa = $rowCR['nombre_empresa'];
$nombreResponsable = $rowCR['nombre_responsable'];


function Personal($idpersonal,$con){

$sql = "SELECT * FROM tb_usuarios WHERE id = '".$idpersonal."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($numero >= 1){
  $nombre = $row['nombre'];
  $puesto = Puesto($row['id_puesto'],$con);
  $segurosocial = $row['seguro_social'];
}else{
  $nombre = '';
  $puesto = '';
  $segurosocial = '';
}

$array = array('nombre' => $nombre, 'puesto' => $puesto, 'segurosocial' => $segurosocial);
return $array;
}

function Puesto($idpuesto,$con){
$sql = "SELECT tipo_puesto FROM tb_puestos WHERE id = '".$idpuesto."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$tipoPuesto = $row['tipo_puesto'];
return $tipoPuesto;
}
?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white"> Autorizacion para realizar trabajos peligrosos</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<table style="width: 100%">
  <tr>
    <td><input type="text" class="form-control rounded-0" value="<?=$municipio;?>" placeholder="Municipio" id="Municipio" onkeyup="EditARTP(this,1,<?=$idFormato;?>)"></td>
    <td><input type="text" class="form-control rounded-0" value="<?=$estado;?>" placeholder="Estado" id="Estado" onkeyup="EditARTP(this,2,<?=$idFormato;?>)"></td>
    <td>, a </td>
    <td width="80px"><input type="text" class="form-control rounded-0" value="<?=$dia;?>" placeholder="Día" id="Dia" onkeyup="EditARTP(this,3,<?=$idFormato;?>)"></td>
    <td> de </td>
    <td width="80px"><input type="text" class="form-control rounded-0" value="<?=nombremes($mes);?>" placeholder="Mes" id="Mes" onkeyup="EditARTP(this,4,<?=$idFormato;?>)"></td>
    <td> del </td>
    <td width="100px"><input type="text" class="form-control rounded-0" value="<?=$year;?>" placeholder="Año" id="Year" onkeyup="EditARTP(this,5,<?=$idFormato;?>)"></td>
  </tr>
</table>

<div class="mt-1"><b>Trabajo a realizar:</b></div>
<textarea class="form-control rounded-0" rows="1" onkeyup="EditARTP(this,6,<?=$idFormato;?>)" id="TAR"><?=$trabajorealizar;?></textarea>

<div class="mt-1"><b>Descripcion:</b></div>
<textarea class="form-control rounded-0" rows="1" onkeyup="EditARTP(this,7,<?=$idFormato;?>)" id="DESC"><?=$descripcion;?></textarea>

<div class="mt-1"><b>Área:</b></div>
<textarea class="form-control rounded-0" rows="1" onkeyup="EditARTP(this,8,<?=$idFormato;?>)" id="Area"><?=$area;?></textarea>

<table class="mt-2" style="width: 100%">
  <tr>
    <td><b>Fecha de inicio:</b></td>
    <td><input type="date" class="form-control rounded-0" onchange="EditARTP(this,9,<?=$idFormato;?>)" value="<?=$fechainicio;?>" id="FDI"></td>
    <td><b>Fecha de término:</b></td>
    <td><input type="date" class="form-control rounded-0" onchange="EditARTP(this,10,<?=$idFormato;?>)" value="<?=$fechatermino;?>"  id="FDT"></td>
  </tr>
    <tr>
    <td><b>Hora de Inicio:</b></td>
    <td><input type="time" class="form-control rounded-0" onchange="EditARTP(this,11,<?=$idFormato;?>)" value="<?=$horainicio;?>" id="HDI"></td>
    <td><b>Hora de Termino:</b></td>
    <td><input type="time" class="form-control rounded-0" onchange="EditARTP(this,12,<?=$idFormato;?>)" value="<?=$horatermino;?>" id="HDT"></td>
  </tr>
</table>

<br>
<b>El trabajo a realizar contempla alguno de los siguientes procedimientos:</b>
<table class="table table-bordered table-sm mt-2">
<tbody>
<?php
$sqlR = "SELECT * FROM tb_requisicion_obra_formato_12_procedimiento WHERE id_requisicion = '".$idFormato."'";
$resultR = mysqli_query($con, $sqlR);
$numeroR = mysqli_num_rows($resultR);
while($rowR = mysqli_fetch_array($resultR, MYSQLI_ASSOC)){
$idProcedimientos = $rowR['id'];

if($rowR['valor'] == 1){
$Check = 'checked';
}else{
$Check = '';  
}
echo '<tr>
<td>'.$rowR['detalle'].'</td>
<td class="text-center"><input type="checkbox" id="TRCDLSP'.$idProcedimientos.'" onclick="TrabjoP('.$idProcedimientos.')" '.$Check.'></td>
</tr>';
}
?>
</tbody>
</table>

<div class="mt-1"><b>Nombre del prestador de servicios:</b></div>
<textarea class="form-control rounded-0" rows="1" onkeyup="EditARTP(this,13,<?=$idFormato;?>)"><?=$prestadorservicio;?></textarea>

<table style="width: 100%" class="mt-2">
<tr>
<td>Cuenta con capacitación para realizar trabajos peligrosos:</td>
<td> Si <input type="radio" name="Pregunta1" value="1" onclick="EditARTP(this,15,<?=$idFormato;?>)" <?=$cprtp1;?>>  No <input type="radio" name="Pregunta1" value="0" onclick="EditARTP(this,15,<?=$idFormato;?>)" <?=$cprtp2;?>></td>
</tr>
<tr>
<td>Cuenta con todo el Equipo de Protección Personal correspondiente (EPP):</td>
<td> Si <input type="radio" name="Pregunta2" value="1" onclick="EditARTP(this,16,<?=$idFormato;?>)" <?=$cteppc1;?>>  No <input type="radio" name="Pregunta2" value="0" onclick="EditARTP(this,16,<?=$idFormato;?>)" <?=$cteppc2;?>></td>
</tr>
</table>

<div class="text-center"><small>*De no contar con capacitación, bajo ninguna circunstancia realizara los trabajos</small></div>

<br>
<div class="border p-2">
<b>Datos de los trabajadores que acuden al servicio:</b>

<div class="row">

<div class="col-4">
Nombre:
<input type="text" class="form-control rounded-0" id="NombreT">
</div>

<div class="col-4">
Puesto:
<input type="text" class="form-control rounded-0" id="PuestoT">
</div>

<div class="col-4">
No. De Seguro:
<input type="text" class="form-control rounded-0" id="NoSeguroT">
</div>

</div>

<div class="text-end mt-2">
<button type="button" class="btn btn-info text-white" style="border-radius: 0px;" onclick="btnGPersonal(1,<?=$idFormato;?>,<?=$id;?>)">Agregar</button>
</div>

<table class="table table-bordered table-sm mt-2">
<thead>
  <tr>
    <th>Nombre</th>
    <th>Puesto</th>
    <th>No. De Seguro</th>
    <th></th>
  </tr>
</thead>
<tbody>
<?php  
$sqlDTAS = "SELECT * FROM tb_requisicion_obra_formato_12_trabajador_encargado WHERE id_requisicion = '".$idFormato."' AND categoria = 1 ";
$resultDTAS = mysqli_query($con, $sqlDTAS);
$numeroDTAS = mysqli_num_rows($resultDTAS);
while($rowDTAS = mysqli_fetch_array($resultDTAS, MYSQLI_ASSOC)){
echo '<tr>
<td>'.$rowDTAS['nombre'].'</td>
<td>'.$rowDTAS['puesto'].'</td>
<td>'.$rowDTAS['no_seguro'].'</td>
<td width="16" class="align-middle text-center"><a onclick="EliminarARTP(20,'.$rowDTAS['id'].','.$id.')"><img src="'.RUTA_IMG_ICONOS.'eliminar.png"></a></td>
</tr>';
}
?>
</tbody>
</table>

<hr>
<b>Encargado de la estación de servicio de darle seguimiento al servicio:</b>
<div class="row">
<div class="col-10">
<select class="form-control rounded-0" id="idPersonalEE">
<option></option>
<?php  

$sql = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND id_puesto = '6' AND  estatus = 0";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
}
?>
</select>
</div>
<div class="col-2 text-end">
<button type="button" class="btn btn-info text-white" style="border-radius: 0px;" onclick="btnGPersonal(2,<?=$idFormato;?>,<?=$id;?>)">Agregar</button>
</div>
</div>

<table class="table table-bordered table-sm mt-2">
<thead>
  <tr>
    <th>Nombre</th>
    <th>Puesto</th>
    <th>No. De Seguro</th>
    <th></th>
  </tr>
</thead>
<tbody>
<?php  
$sqlEESS = "SELECT * FROM tb_requisicion_obra_formato_12_trabajador_encargado WHERE id_requisicion = '".$idFormato."' AND categoria = 2 ";
$resultEESS = mysqli_query($con, $sqlEESS);
$numeroEESS = mysqli_num_rows($resultEESS);
while($rowEESS = mysqli_fetch_array($resultEESS, MYSQLI_ASSOC)){
$PersonalES = Personal($rowEESS['id_personal'],$con);
echo '<tr>
<td>'.$PersonalES['nombre'].'</td>
<td>'.$PersonalES['puesto'].'</td>
<td>'.$PersonalES['segurosocial'].'</td>
<td width="16" class="align-middle text-center"><a onclick="EliminarARTP(20,'.$rowEESS['id'].','.$id.')"><img src="'.RUTA_IMG_ICONOS.'eliminar.png"></a></td>
</tr>';
}
?>
</tbody>
</table>
</div>

<div class="border p-2 mt-2">
<small>Trabajo realizado por un externo</small>

<div class="mt-1"><b>Nombre empresa:</b></div>
<textarea class="form-control rounded-0" rows="1" onkeyup="EditARTP(this,18,<?=$idFormato;?>)"><?=$mombreEmpresa;?></textarea>

<div class="mt-1"><b>Nombre del responsable:</b></div>
<textarea class="form-control rounded-0" rows="1" onkeyup="EditARTP(this,19,<?=$idFormato;?>)"><?=$nombreResponsable;?></textarea>

<div class="text-center mt-2"><small>Nota: Si el personal es externo deberá presentar su procedimiento para realizar la actividad</small></div>

</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnEditarARTP()">Guardar</button></div>

