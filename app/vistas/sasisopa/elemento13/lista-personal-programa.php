<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/PreparacionEmergencias.php";

$class_preparacion_emergencias = new PreparacionEmergencias();

$idPrograma = $_GET['idPrograma'];

$sql_programa = "SELECT * FROM tb_programa_anual_simulacros_personal WHERE id_programa = '".$idPrograma."' ";
$result_programa = mysqli_query($con, $sql_programa);
$numero_programa = mysqli_num_rows($result_programa);

?>
<script type="text/javascript">
 $(document).ready(function(){
$('#NombrePersonal').selectpicker('refresh');

});
</script>
<div class="modal-header">
<h4 class="modal-title">Personal que asiste</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</div>
<div class="modal-body">

<div class="row"></div>
<div class="mb-2"><small class="text-secondary">* Nombre completo:</small></div>
<div class="input-group">

	<div id="borderNombrePersonal" style="border: 1px solid #DFDFDF;width: 85%;">
      <select class="selectpicker" id="NombrePersonal" multiple title="Selecciona" data-width="100%">
       <?php
		$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND estatus = 0 ";
		$result_usuarios = mysqli_query($con, $sql_usuarios);
		$numero_usuarios = mysqli_num_rows($result_usuarios);
		while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
		$Valida = $class_preparacion_emergencias->validaPersonalAsiste($idPrograma,$row_usuarios['nombre']);
		if($Valida == 0){
		echo '<option value="'.$row_usuarios['nombre'].'">'.$row_usuarios['nombre'].'</option>';
		}
		}
		?>
      </select>
  </div>


<button type="button" class="btn btn-primary rounded-0" onclick="BtnAgregarPersonal('<?=$idPrograma;?>')">Agregar</button>
</div>
<hr>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm mt-2">
<thead>
<th>Nombre completo</th>
<th></th>
</thead>
<tbody>
<?php
if ($numero_programa > 0) {
while($row_programa = mysqli_fetch_array($result_programa, MYSQLI_ASSOC)){
$idPersonal = $row_programa['id'];

echo "<tr>";
echo "<td>".$row_programa['nombre']."</td>";
echo "<td class='text-center align-middle'width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' onclick='eliminarpersonal(".$idPrograma.",".$idPersonal.")'></td>";
echo "</tr>";

}
}else{
echo "<tr><td colspan='2' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>
</tbody>
</table>
</div>
</div>
