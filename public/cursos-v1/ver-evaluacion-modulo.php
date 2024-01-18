<?php
require('../../app/help.php');

$idModulo = $_GET['idModulo'];
$idTema = $_GET['idTema'];
$valEvaluacion = $_GET['valEvaluacion'];

$result_modulo = $ClassCursos->NombreModuloEvaluacion($idModulo, $con);
$modulodescripcion = $result_modulo['descripcion'];

  $sql_num_dia = "SELECT * FROM cu_evaluacion_modulos WHERE id = '".$idModulo."' ";
  $result_num_dia = mysqli_query($con, $sql_num_dia);
  while($row_num_dia = mysqli_fetch_array($result_num_dia, MYSQLI_ASSOC)) {
  $id_modulo = $row_num_dia['id_modulo'];
  }

  $sql_num_dia1 = "SELECT * FROM cu_modulos_evaluacion WHERE id_modulo = '".$id_modulo."' ";
  $result_num_dia1 = mysqli_query($con, $sql_num_dia1);
  while($row_num_dia1 = mysqli_fetch_array($result_num_dia1, MYSQLI_ASSOC)) {
 $url_evaluacion = $row_num_dia1['url_evaluacion']; 

  }

?>
<script type="text/javascript">

  $(document).ready(function($){

    VerEvaluacionModulo();

    });

  function VerEvaluacionModulo(){

    $('#DivContenido').load('../../public/cursos/<?php echo $url_evaluacion; ?>?idModulo=<?php echo $idModulo; ?>&idTema=<?=$idTema;?>&valEvaluacion=<?=$valEvaluacion;?>');
  }
</script>

<div class="row no-gutters">
<div class="col-12">

  <div class="card adm-card">
   <div class="adm-car-title">
   <div class="float-left"><h4><?php echo $modulodescripcion; ?></h4></div>         
   </div>
   <div class="card-body"> 

    <div id="DivContenido"></div>

  </div>   
  </div>    
  </div>    
  </div>
 