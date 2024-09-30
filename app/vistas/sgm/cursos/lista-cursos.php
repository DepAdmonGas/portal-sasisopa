<?php
require('../../../../app/help.php');

$sql_modulos_cursos = "SELECT * FROM tb_cursos_modulos WHERE id = 4 ORDER BY num_modulo ASC"; 
$result_modulos_cursos = mysqli_query($con, $sql_modulos_cursos);
$numero_modulos_cursos  = mysqli_num_rows($result_modulos_cursos);

function numTemasModulo($idModulo,$con){
$sql_temas_modulos = "SELECT num_tema FROM tb_cursos_temas WHERE id_modulo = '".$idModulo."' "; 
$result_temas_modulos = mysqli_query($con, $sql_temas_modulos);
return $numero_temas_modulos  = mysqli_num_rows($result_temas_modulos);
}

?>
<h5>Modulo</h5>
<div class="row">

<?php
while($row_modulos_cursos = mysqli_fetch_array($result_modulos_cursos, MYSQLI_ASSOC)){
$GET_idModulo = $row_modulos_cursos['id'];
$num_modulo = $row_modulos_cursos['num_modulo'];
$titulo = $row_modulos_cursos['titulo'];

$totalTemas = numTemasModulo($GET_idModulo,$con);

?>
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-1 mb-2">
  <div class="shadow-sm card rounded p-3 mb-2 border">
                
    <div class="d-flex justify-content-between">
      
      <div class="d-flex flex-row align-items-center mb-3">
      
      <div class="icon bg-icon"> 
      <div class="color-disabled" style="font-weight: bold;"><?=$num_modulo;?></div> 
      </div>

      </div>

      <div> <span class="badge badge-info float-end mb-sm-0 mt-3">
      <?="No. de Temas: ".$totalTemas?>
      </span> </div>

    </div>

    <div class="col-12 text-center mb-3">
      <h5><?=$titulo?></h5>
      <img class="img-logo mt-2" src="<?php echo RUTA_IMG_ICONOS?>curso.png" style="width: 25%;">
    </div>

    <div>
    <button class="btn btn-sm btn-primary float-right" type="button" onclick="detalleModulo(<?=$GET_idModulo?>)">Ver Temas</button>
    </div>

  </div>
 </div>

<?php
}
?>
</div>


