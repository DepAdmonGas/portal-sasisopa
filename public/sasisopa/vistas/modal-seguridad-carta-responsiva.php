<?php
require('../../../app/help.php');

$id = $_GET['id'];

$sql = "SELECT * FROM tb_requisicion_obra_carta_responsiva WHERE id_requisicion = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if($numero == 0){

$sql_insert = "INSERT INTO tb_requisicion_obra_carta_responsiva (
id_requisicion,
archivo,
dia,
mes,
year,
municipio,
estado,
representante_legal,
razon_social,
domicilio,
apoderado_legal,
firma
  )
  VALUES (
  '".$id."',
  '',
  '".date("d")."',
  '".nombremes(date("m"))."',
  '".date("Y")."',
  '".$Session_DiMunicipio."',
  '".$Session_DiEstado."',
  '".$Session_ApoderadoLegal."',
  '".$Session_Razonsocial."',
  '".$Session_Direccion."',
  '".$Session_ApoderadoLegal."',
  '".$Session_ApoderadoLegalFirma."'
  )";
  mysqli_query($con, $sql_insert);
}

$sqlCR = "SELECT * FROM tb_requisicion_obra_carta_responsiva WHERE id_requisicion = '".$id."' ";
$resultCR = mysqli_query($con, $sqlCR);
while($rowCR = mysqli_fetch_array($resultCR, MYSQLI_ASSOC)){
$idCarta = $rowCR['id'];
$dia = $rowCR['dia'];
$mes = $rowCR['mes'];
$year = $rowCR['year'];
$municipio = $rowCR['municipio'];
$estado = $rowCR['estado'];
$representante = $rowCR['representante_legal'];
$razonsocial = $rowCR['razon_social'];
$domicilio = $rowCR['domicilio'];
$apoderado = $rowCR['apoderado_legal'];
$firma = $rowCR['firma'];

}
?>
<div class="modal-header">
<h4 class="modal-title">Carta responsiva
</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<table style="width: 100%">
  <tr>
    <td><input type="text" class="form-control rounded-0" value="<?=$municipio;?>" placeholder="Municipio" id="Municipio"></td>
    <td><input type="text" class="form-control rounded-0" value="<?=$estado;?>" placeholder="Estado" id="Estado"></td>
    <td>, a </td>
    <td width="80px"><input type="text" class="form-control rounded-0" value="<?=$dia;?>" placeholder="Día" id="Dia"></td>
    <td> de </td>
    <td width="80px"><input type="text" class="form-control rounded-0" value="<?=nombremes($mes);?>" placeholder="Mes" id="Mes"></td>
    <td> del </td>
    <td width="100px"><input type="text" class="form-control rounded-0" value="<?=$year;?>" placeholder="Año" id="Year"></td>
  </tr>
</table>
<br><br>

<div style="font-size: 1.2em;"><b>A QUIEN CORRESPONDA.</b></div>

<div style="font-size: 1.2em;">Por este conducto le mando un cordial saludo, a su vez,</div>
<input type="text" class="form-control rounded-0" value="<?=$representante;?>" placeholder="Nombre del representante legal" id="RepresentanteL">
<div style="font-size: 1.2em;">,representante legal de</div>
<input type="text" class="form-control rounded-0" value="<?=$razonsocial;?>" placeholder="Razón social" id="RazonSocial">

<div style="font-size: 1.2em;">Con domicilio en, </div>
<input type="text" class="form-control rounded-0" value="<?=$domicilio;?>" placeholder="Colocar el domicilio completo de la estación" id="Domicilio">

<div style="font-size: 1.2em;">Doy mi responsivo total de los daños o perjuicios de riegos y aspectos ambientales presentados durante las actividades u operaciones derivadas de los contratistas, subcontratistas, prestadores de servicio y personal interno que labore dentro de la estación de servicio antes mencionada.<br><br>
Por último, ratifico mi voluntad a efecto de cubrir con todas las obligaciones a cubrir.<br><br>
Sirva la presente para todos los fines legales a que haya lugar.
</div>

<hr>
<div style="font-size: 1.2em;"><input type="text" class="form-control rounded-0" value="<?=$apoderado;?>" placeholder="Nombre del apoderado legal" id="ApoderadoL"></div>
<div class="text-center" style="font-size: 1.2em;">Nombre del apoderado legal</div>



</div>
 <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnEditarCR(<?=$idCarta;?>,<?=$id;?>)">Guardar</button>
        </div>