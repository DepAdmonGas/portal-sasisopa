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
  <div class="row"> 
  <div class="col-12">
  <a class="float-end" onclick="modalBuscar()" style="cursor: pointer;">  
  <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png"; ?>">
  </a>
  <h5 class="mb-2">Elementos SASISOPA</h5>
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
  <div class="col-xl- col-lg-4 col-md-6 col-sm-12 mt-1">
  <div class="card cursor <?=$cardcurso_disables;?> rounded shadow-sm p-3 mb-2" style='cursor: pointer;' onclick="BtnSasisopa('<?=$row_sasisopa['numero_sasisopa']; ?>','<?=$row_sasisopa['nombre']; ?>')">
                
    <div class="d-flex justify-content-between">
      <div class="d-flex flex-row align-items-center mb-3">
      <div class="icon <?=$icon;?>"> 
      <a class="<?=$colorC;?>" style="font-weight: bold;"><?=$row_sasisopa['numero_sasisopa']; ?></a> 
      </div>      
      </div>
    </div>

    <div class="text-center">
    <p style="font-size: 1.2em;"><?=$row_sasisopa['nombre']; ?></p>
    </div>

  </div>
  </div>
 <?php
 }
 ?>
</div>
