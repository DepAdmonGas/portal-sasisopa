<?php
require('../../../app/help.php');
$idre = $_GET['id'];

$sql_programa_m = "SELECT * FROM rl_requisitos_legales_calendario WHERE id = '".$idre."' ";
$result_programa_m = mysqli_query($con, $sql_programa_m);
$numero_programa_m = mysqli_num_rows($result_programa_m);

while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
$requisoLegal = $row_programa_m['requisito_legal'];

}
?>
<div class="modal-body"> 

<div style="font-size: 1.1em"><?=$requisoLegal;?></div>
<hr>

<div class="pb-2">
<label style="font-size: .8em;">Ultima actualizacion</label>
<input type="date" class="form-control" id="ultimaactE" value="<?=$ultimaActualizacion;?>" style="border-radius: 0px;font-size: .9em;">
</div>

<table class="table table-bordered table-sm">
  <tr style="font-weight: bold; ">
    <td class="text-center align-middle table-secondary">Acuse PDF</td>    
    <td class="text-center align-middle table-secondary">Requisito Legal PDF</td>   
  </tr>
  <tr>
  <td colspan="1"><input type="file" id="acusePDFN" style="font-size: .8em;"></td>
   <td colspan="1"><input type="file" id="requisitoPDFN" style="font-size: .8em;"></td>
  </tr>
 </table>

<div class="text-right">
<button type="button" class="btn btn-secondary btn-sm rounded-0" onclick="CancelarAgregar(<?=$idre;?>)">Cancelar</button>
<button type="button" class="btn btn-primary btn-sm rounded-0" onclick="AgregarRequisito(<?=$idre;?>)">Agregar</button>
</div>

</div>