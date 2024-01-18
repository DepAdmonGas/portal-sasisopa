<?php
require('../../app/help.php');

$idTema = $_GET['idTema'];
$idModulo = $_GET['idModulo'];
$numDiapositiva = $_GET['numDiapositiva'];

if ($numDiapositiva == 1) {
	$disabled = "disabled";
}else{
	$disabled = "";
}

  $sql_temas = "SELECT * FROM cu_modulos_diapositivas WHERE id_modulo = '".$idModulo."' and num_diapositiva = '".$numDiapositiva."' ";
  $result_temas = mysqli_query($con, $sql_temas);
  while($row_tema = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {
  $temadesc = $row_tema['descripcion'];
  }

$sigDiapositiva = $numDiapositiva + 1;
$antDiapositiva = $numDiapositiva - 1;

?>
<script type="text/javascript">
function BTNCancelar(){

 window.location.href = "";	
}

function BTNSiguiente(idmodulo, numdiapositiva){

	VerDiapositiva(idModulo, num_diapositiva);

}
</script>
<div class="position-fixed" style="background: #464646;z-index: 100;width: 100%;opacity: .6;padding-bottom: 10px;padding-top: 10px;padding-left: 20px;padding-right: 20px;">
<button type="button" class="btn btn-dark animated bounceIn slower" style="z-index: 100;border:2px solid white;" onclick="BTNCancelar()"> Cancelar </button>
<div class="float-right">
<button type="button" class="btn btn-dark animated bounceIn slower" style="z-index: 100;border:2px solid white;" onclick="VerDiapositiva(<?php echo $idModulo; ?>,<?php echo $antDiapositiva; ?>)" <?php echo $disabled; ?>><< Anterior </button>
<button type="button" class="btn btn-dark animated bounceIn slower" style="z-index: 100;border:2px solid white;" onclick="VerDiapositiva(<?php echo $idModulo; ?>,<?php echo $sigDiapositiva; ?>)" >Siguiente >></button>
</div>

</div>


<img class="animated fadeIn" id="imganim" style="width: 100%;height: 100%;" src="<?php echo RUTA_IMG_CURSOS.$temadesc; ?>">
