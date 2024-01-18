<?php
require('../../../app/help.php');

  $sql_sasisopa = "
  SELECT
  sa_sasisopa_estaciones.id,
  sa_sasisopa_estaciones.id_sasisopa,
  sa_sasisopa.numero_sasisopa,
  sa_sasisopa.nombre,
  sa_sasisopa_estaciones.estado
  FROM sa_sasisopa_estaciones
  INNER JOIN sa_sasisopa ON sa_sasisopa_estaciones.id_sasisopa = sa_sasisopa.id WHERE sa_sasisopa_estaciones.id_estacion = '".$Session_IDEstacion."' ";
  $result_sasisopa = mysqli_query($con, $sql_sasisopa);
  $numero_sasisopa = mysqli_num_rows($result_sasisopa);

?>
<script type="text/javascript">
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})

function BtnSasisopa(id,nombre){

if (id == 1) {
  window.location.href = "1-politica";
}else if (id == 2) {
  window.location.href = "2-analisis-riesgo-evaluacion-impactos-ambientales";
}else if (id == 3) {
  window.location.href = "3-requisitos-legales";
}else if (id == 4) {
  window.location.href = "4-objetivos-metas-indicadores";
}else if (id == 5) {
  window.location.href = "5-funciones-responsabilidades-autoridad";
}else if (id == 6) {
  window.location.href = "6-competencia-personal-capacitacion-entrenamiento";
}else if (id == 7) {
  window.location.href = "7-comunicacion-participacion-consulta";
}else if (id == 8) {
  window.location.href = "8-control-documentos-registros";
}else if (id == 9) {
  window.location.href = "9-mejores-practicas-estandares";
}else if (id == 10) {
  window.location.href = "10-control-actividades-procesos";
}else if (id == 11) {
  window.location.href = "11-integridad-mecanica-aseguramiento";
}else if (id == 12) {
  window.location.href = "12-seguridad-contratistas";
}else if (id == 13) {
  window.location.href = "13-preparacion-emergencias";
}else if (id == 14) {
  window.location.href = "14-monitoreo-verificacion-evaluacion";
}else if (id == 15) {
  window.location.href = "15-auditorias";
}else if (id == 16) {
  window.location.href = "16-investigacion-incidentes-accidentes";
}else if (id == 17) {
  window.location.href = "17-revision-resultados";
}else if (id == 18) {
  window.location.href = "18-informes-desempeno";
}

}
</script>


<div class="border-0 p-3"> 
  
  <div class="row"> 
  <div class="col-12">

  <a class="float-end" onclick="modalBuscar()" style="cursor: pointer;">  
  <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png"; ?>">
  </a>

  <h5 class="mb-2">Elementos SASISOPA</h5>

  <hr>
  </div>
  </div> 


<div class="row">
<?php
while($row_sasisopa = mysqli_fetch_array($result_sasisopa, MYSQLI_ASSOC)){
$row_sasisopa['id'];
$row_sasisopa['numero_sasisopa'];
$row_sasisopa['nombre'];
$row_sasisopa['estado'];

if ($row_sasisopa['estado'] == 0) {

$icon = "bg-icon-disabled";
$backgroundC = "bg-disabled";
$colorC = "color-disabled";
$disabled = "disabled";
$cardcurso_disables = "card-cursos-disabled";
$buttonC = "btn-outline-primary";


}else{
$icon = "bg-icon";
$backgroundC = "bg-success";
$colorC = "color-disabled";
$disabled = "";
$cardcurso_disables = "card-menuB";
$buttonC = "btn-outline-primary";
}



?>


  <div class="col-xl- col-lg-4 col-md-6 col-sm-12 mt-3">
  <div class="card <?=$cardcurso_disables;?> rounded shadow-sm p-3 mb-2">
                
    <div class="d-flex justify-content-between">
      
      <div class="d-flex flex-row align-items-center mb-3">
      
      <div class="icon <?=$icon;?>"> 
      <a class="<?=$colorC;?>" style="font-weight: bold;"><?=$row_sasisopa['numero_sasisopa']; ?></a> 
      </div>

      <div class=" m-details ms-2"></div>
      </div>


    </div>

    <div class="col-12 text-center">
    <p style="font-size: 1.1em;"><?=$row_sasisopa['nombre']; ?></p>

    </div>

    <div>
    <button class="btn btn-md <?=$buttonC?> float-end" type="button" onclick="BtnSasisopa('<?=$row_sasisopa['numero_sasisopa']; ?>','<?=$row_sasisopa['nombre']; ?>')" <?=$disabled?>> Entrar </button>
    </div>

  </div>
  </div>

 <?php
 }
 ?>
</div>

</div>