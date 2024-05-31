<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/InvestigacionIncidentesAccidentes.php";

$class_incidentes_accidentes = new InvestigacionIncidentesAccidentes();

if($_GET['Id'] == 0){
$ID = $class_incidentes_accidentes->agregarSinAccidentes($Session_IDEstacion,$Session_IDUsuarioBD);
}else{
$ID = $_GET['Id']; 
}

$sqlCR = "SELECT * FROM tb_investigacion_incidente_accidente_no WHERE id = '".$ID."' ";
$resultCR = mysqli_query($con, $sqlCR);
$rowCR = mysqli_fetch_array($resultCR, MYSQLI_ASSOC);
$Estacion = $class_incidentes_accidentes->estacion($rowCR['id_estacion']);

$sql_usuario = "SELECT nombre, id_puesto FROM tb_usuarios WHERE id = '".$rowCR['id_usuario']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
$row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC);
$nomencargado = $row_usuario['nombre'];
$Puesto = $class_incidentes_accidentes->puesto($row_usuario['id_puesto']);

$razonsocial = $Estacion['Razonsocial'];
$estado = $Estacion['Estado'];
$municipio = $Estacion['Municipio'];
$domicilio = $Estacion['Direccion'];
$fecha = $rowCR['fecha'];

?>
<div class="modal-header">
<h4 class="modal-title">Sin accidentes a la fecha</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<table style="width: 100%">
  <tr>
    <td class="text-right"><?=$municipio;?> <?=$estado;?>, a  </td>
    <td><input type="date" class="form-control rounded-0" value="<?=$fecha;?>" placeholder="Fecha" id="Fecha"></td>
  </tr>
</table>

<p class="mt-3"><b><?=$nomencargado;?></b>, en carácter de Representante técnico del regulado <b><?=$razonsocial;?></b>, con ubicación en <b><?=$domicilio;?></b> manifiesto bajo protesta de decir verdad y sabedor de la pena que conlleva a quienes actúan de mala fe o declaran con falsedad, manifiesto que en las instalaciones antes mencionadas a la fecha del presente no han ocurrido ningún tipo de incidentes o accidentes. </p>

<p>Lo anterior en cumplimiento a las DISPOSICIONES administrativas de carácter general que establecen los Lineamientos para Informar la ocurrencia de incidentes y accidentes a la Agencia Nacional de Seguridad Industrial y de Protección al Medio Ambiente del Sector Hidrocarburos.</p>

<p><b>Atentamente</b></p>
<div><?=$nomencargado;?></div>
<div><?=$Puesto;?></div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnGuardarSAF(<?=$ID;?>)">Guardar</button>
</div>


