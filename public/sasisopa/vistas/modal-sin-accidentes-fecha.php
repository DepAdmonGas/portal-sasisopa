<?php
require('../../../app/help.php');


function Puesto($idpuesto,$con){

$sqlID = "SELECT tipo_puesto FROM tb_puestos WHERE id = '".$idpuesto."' ";
$resultID = mysqli_query($con, $sqlID);
while($rowID = mysqli_fetch_array($resultID, MYSQLI_ASSOC)){
$Puesto = $rowID['tipo_puesto'];
}
return $Puesto;
}

function Estacion($idestacion,$con){
$sql = "SELECT * FROM tb_estaciones WHERE id = '".$idestacion."' ";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Razonsocial = $row['razonsocial'];
$Estado = $row['di_estado'];
$Municipio = $row['di_municipio'];
$Direccion = $row['direccioncompleta'];
}

$array = array('Razonsocial' => $Razonsocial, 'Estado' => $Estado, 'Municipio' => $Municipio, 'Direccion' => $Direccion);

return $array;
}

if($_GET['Id'] == 0){

   $sqlID = "SELECT id FROM tb_investigacion_incidente_accidente_no ORDER BY id desc LIMIT 1";
   $resultID = mysqli_query($con, $sqlID);
   $numeroID = mysqli_num_rows($resultID);

   if ($numeroID == 0) {
   $ID = 1;
   }else{
   while($rowID = mysqli_fetch_array($resultID, MYSQLI_ASSOC)){
   $ID = $rowID['id'] + 1;
   }
   }

$sql_insert = "INSERT INTO tb_investigacion_incidente_accidente_no (
id,
id_estacion,
fecha,
id_usuario,
estatus

  )
  VALUES (
  '".$ID."',
  '".$Session_IDEstacion."',
  '',
  '".$Session_IDUsuarioBD."',
  0
  )";
  mysqli_query($con, $sql_insert);


}else{
$ID = $_GET['Id']; 
}

$sqlCR = "SELECT * FROM tb_investigacion_incidente_accidente_no WHERE id = '".$ID."' ";
$resultCR = mysqli_query($con, $sqlCR);
while($rowCR = mysqli_fetch_array($resultCR, MYSQLI_ASSOC)){

$Estacion = Estacion($rowCR['id_estacion'],$con);

$sql_usuario = "SELECT nombre, id_puesto FROM tb_usuarios WHERE id = '".$rowCR['id_usuario']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre'];
$Puesto = Puesto($row_usuario['id_puesto'],$con);
}





$razonsocial = $Estacion['Razonsocial'];
$estado = $Estacion['Estado'];
$municipio = $Estacion['Municipio'];
$domicilio = $Estacion['Direccion'];
$fecha = $rowCR['fecha'];

}
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


