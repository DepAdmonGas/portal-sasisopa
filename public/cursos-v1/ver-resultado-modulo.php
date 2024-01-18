<?php
require('../../app/help.php');
?>
<style type="text/css">
  #DivPrincipal{
    background: #0a5da4;
    
  }
</style>
<?php
$promedio = round($_GET['promedio']);
$totalpreguntas = $_GET['preguntas'];
$respuestascorrectas = $_GET['totrespuesta'];
$idTema = $_GET['idTema'];
$idModulo = $_GET['idmodulo'];

$result_modulo = $ClassCursos->NombreModuloEvaluacion($idModulo, $con);
$modulodescripcion = $result_modulo['descripcion'];

$sql_temas = "SELECT * FROM cu_evaluacion_tema WHERE id_usuario = '".$Session_IDUsuarioBD."' and estado <> 1 ORDER BY id_tema asc LIMIT 1 ";
  $result_temas = mysqli_query($con, $sql_temas);
  $count_temas = mysqli_num_rows($result_temas);

    $sql_modulos = "SELECT * FROM cu_evaluacion_modulos WHERE id = '".$idModulo."' ";
  $result_modulos = mysqli_query($con, $sql_modulos);
  $count_modulos = mysqli_num_rows($result_modulos);
  while($row_modulos = mysqli_fetch_array($result_modulos, MYSQLI_ASSOC)) {
  $num_modulo = $row_modulos['num_modulo'];
  }

  $modulosig = $num_modulo + 1;

  $sql_modulos = "SELECT * FROM cu_evaluacion_modulos WHERE id_evaluacion_tema = '".$idTema."' and num_modulo = '".$modulosig."' ";
  $result_modulos = mysqli_query($con, $sql_modulos);
  $count_modulos = mysqli_num_rows($result_modulos);


if( $promedio >= 80  && $promedio <= 100){
$titleMensaje = "<div class='text-center' style='font-size: 4em;color: #3186C1'>Felicidades</div>";
$titleModulo = "<div class='text-center font-weight-light' style='font-size: 1.3em;color: #949494'>Acreditaste el modulo <b>".$modulodescripcion."</b></div>";
$colorC = "text-success";
$title = "<label class='text-secondary font-weight-light' style='font-size: 1.5em'> Excelente </label>";

$sql_update_fin = "UPDATE cu_evaluacion_modulos SET estado = 3 WHERE id = '".$_GET['valEvaluacion']."' ";
  if (mysqli_query($con, $sql_update_fin)) {}else{}

if ($count_modulos == 1) {

$sql_update = "UPDATE cu_evaluacion_modulos SET estado = 1 WHERE id_evaluacion_tema = '".$idTema."' and num_modulo = '".$modulosig."' ";
  if (mysqli_query($con, $sql_update)) {}else{}

}else{

 while($row_temas = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {
  $temas_id = $row_temas['id'];
  }

  $sql_update = "UPDATE cu_evaluacion_tema SET estado = 1 WHERE id = '".$temas_id."' ";
  if (mysqli_query($con, $sql_update)) {}else{}

}

}else if($promedio >= 70 && $promedio <= 79){
$titleMensaje = "<div class='text-center' style='font-size: 4em;color: #C13131'>Felicidades</div>";
$titleModulo = "<div class='text-center font-weight-light' style='font-size: 1.3em;color: #949494'>Acreditaste el modulo <b>".$modulodescripcion."</b></div>";
$colorC = "text-warning";
$title = "<label class='text-secondary font-weight-light' style='font-size: 1.5em'> Bueno </label>";

$sql_update_fin = "UPDATE cu_evaluacion_modulos SET estado = 3 WHERE id = '".$_GET['valEvaluacion']."' ";
  if (mysqli_query($con, $sql_update_fin)) {}else{}
    
if ($count_modulos == 1) {

$sql_update = "UPDATE cu_evaluacion_modulos SET estado = 1 WHERE id_evaluacion_tema = '".$idTema."' and num_modulo = '".$modulosig."' ";
  if (mysqli_query($con, $sql_update)) {}else{}

}else{

while($row_temas = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {
  $temas_id = $row_temas['id'];
  }

  $sql_update = "UPDATE cu_evaluacion_tema SET estado = 1 WHERE id = '".$temas_id."' ";
  if (mysqli_query($con, $sql_update)) {}else{}
    

}


}else if($promedio >= 0 && $promedio <= 69){
$titleMensaje = "<div class='text-center' style='font-size: 4em;color: #C13131'>No acreditaste</div>";
$titleModulo = "<div class='text-center font-weight-light' style='font-size: 1.3em;color: #949494'>Muy cerca pero no acreditaste el modulo <b>".$modulodescripcion."</b></div>";
$colorC = "text-danger";
$title = "<label class='text-secondary font-weight-light' style='font-size: 1.5em'> Malo </label>";
}
?>

<div style="padding-top: 40px;">
<div class="container animated fadeIn" >
<div class="row" style="background: white;padding: 20px;">
<div class="col-4"> <img src="<?php echo RUTA_IMG."iconos/globos.png" ?>" style="width: 90%;"> </div>
<div class="col-8">
<?php echo $titleMensaje; ?>  
<?php echo $titleModulo; ?>
<div class="text-center" style="padding-top: 30px;padding-bottom: 30px;"><label class="<?php echo $colorC; ?>" style="font-size: 3.5em;"><?php echo $promedio."% "; ?></label> <?php echo $title; ?></div>
<div class="text-center font-weight-light text-secondary" style=""><?php echo $respuestascorrectas." respuestas correctas de ".$totalpreguntas." preguntas"; ?></div>
<div class="text-center" style="padding-top: 40px;"><button type="button" class="btn btn-outline-primary" onclick="regresarP()">REGRESAR AL MENU PRINCIPAL</button></div>
</div>
</div>
</div>
</div>