<?php
require('../../../app/help.php');
$idre = $_GET['id'];
$idmatriz = $_GET['idmatriz'];

$sql_programa_m = "SELECT * FROM rl_requisitos_legales_calendario WHERE id = '".$idre."' ";
$result_programa_m = mysqli_query($con, $sql_programa_m);
$numero_programa_m = mysqli_num_rows($result_programa_m);

while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
$requisoLegal = $row_programa_m['requisito_legal'];

}

$sql_matriz = "SELECT * FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' ORDER BY id desc LIMIT 1";
$result_matriz = mysqli_query($con, $sql_matriz);
$numero_matriz = mysqli_num_rows($result_matriz);
while($row_matriz = mysqli_fetch_array($result_matriz, MYSQLI_ASSOC)){
$fecha = FormatoFecha($row_matriz['ultima_actualizacion']);
$acusepdf = $row_matriz['acusepdf'];
$requisitolegalpdf = $row_matriz['requisitolegalpdf'];
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
<div class="modal-body"> 

<div style="font-size: 1.1em"><?=$requisoLegal;?></div>
<hr>

<table class="table table-bordered table-sm">
  <tr style="font-weight: bold; ">
  	<td></td>
    <td class="text-center align-middle table-secondary">Acuse PDF</td> 
    <td></td>  
    <td class="text-center align-middle table-secondary">Requisito Legal PDF</td>   
  </tr>
  <tr>
  <td class="text-center align-middle"><?=$imgPDFA;?></td>
  <td colspan="1"><input type="file" id="acusePDFED" style="font-size: .8em;"></td>
  <td class="text-center align-middle"><?=$imgPDFRL;?></td>
  <td colspan="1"><input type="file" id="requisitoPDFED" style="font-size: .8em;"></td>
  </tr>
 </table>

 <div id="respuesta"></div>

<div class="text-right">
<button type="button" class="btn btn-secondary btn-sm rounded-0" onclick="CancelarAgregar(<?=$idre;?>)">Cancelar</button>
<button type="button" class="btn btn-primary btn-sm rounded-0" onclick="EditarRequisito(<?=$idre;?>,<?=$idmatriz;?>)">Editar</button>
</div>

</div>