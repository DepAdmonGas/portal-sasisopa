<?php
require('../../../app/help.php');

$sql_estaciones = "SELECT * FROM tb_estaciones WHERE id <> 8";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estacion = mysqli_num_rows($result_estaciones);

function CambioPrecio($idEstacion,$con){

$sql_cp = "SELECT * FROM tb_cambio_precio WHERE id_estacion = '".$idEstacion."' AND estado = 0 ";
$result_cp = mysqli_query($con, $sql_cp);
$numero_cp = mysqli_num_rows($result_cp);

if ($numero_cp > 0) {
$result = $numero_cp;
}else{
$result = "";
}
return $result;
}
?>


<div class="border-0 p-3"> 

  <div class="row"> 
  <div class="col-10">
  <h5 class="mb-2">Administrador</h5>
  </div>

  <div class="col-2">
  <span class="badge bg-success float-end p-2"> No. de Estaciones: <?=$numero_estacion;?></span> 
  </div>

  </div> 
  <hr>


<div class="row">
<?php
while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){

$idEstacion = $row_estaciones['id'];
 
  if ($row_estaciones['estatus'] == 0) {
    $estadoimg = "<img src='".RUTA_IMG_ICONOS."activo.png' data-toggle='tooltip' data-placement='left' title='Estación pendiente'>";
  }else if ($row_estaciones['estatus'] == 1){
    $estadoimg = "<img src='".RUTA_IMG_ICONOS."pendiente.png' data-toggle='tooltip' data-placement='left' title='Estación activada'>";
  }else if ($row_estaciones['estatus'] == 2){
    $estadoimg = "<img src='".RUTA_IMG_ICONOS."noactivo.png' data-toggle='tooltip' data-placement='left' title='Estación cancelada'>";
  }
?>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-3">
  <div class="card card-cursos-home rounded shadow-sm p-2 mb-2">
                
    <div class="d-flex justify-content-between">
      
      <div class="d-flex flex-row align-items-center mb-3">
          <div class="icon bg-icon"> 
      <a class="text-success" style="font-weight: bold;"><i class="fa-solid fa-gas-pump"></i></a> 
      </div>
      <div class=" m-details ms-2"> <span>Permiso CRE:</span> 
      <br><h7 class="text-muted mb-0" style="font-size: .8em;"><?=$row_estaciones['permisocre']; ?></h7> </div>
      </div>

      <div> 
      <?=$estadoimg;?>
       </div>

    </div>

    <div class="col-12 text-center mt-2 ">

    <div class="text-center" style="font-size: 1.2em;">
    <?=$row_estaciones['nombre']; ?>
    </div>

    <div class="text-center text-muted mt-1" style="font-size: .7em;">
    <?=$row_estaciones['razonsocial']; ?>
    </div>

    <hr>
    </div>

     <div class="text-end" style="padding: 5px;" >

      <button type="button" class="btn btn-secondary btn-sm mb-1" style="border-radius: 0;font-size: .7em;" onclick="SASISOPA(<?=$idEstacion;?>)">SASISOPA</button>
      <button type="button" class="btn btn-info text-white btn-sm mb-1" style="border-radius: 0;font-size: .7em;" onclick="BTNReporteCre(<?=$idEstacion;?>)">Reporte Cre</button>
      <button type="button" class="btn btn-primary btn-sm mb-1" style="border-radius: 0;font-size: .7em;" onclick="BTNRequisitos(<?=$idEstacion;?>)">Requisitos legales</button>
      <button type="button" class="btn btn-secondary btn-sm mb-1" style="border-radius: 0;font-size: .7em;" onclick="BTNBitacoras(<?=$idEstacion;?>)">Bitacoras</button>
      <button type="button" class="btn btn-info text-white btn-sm mb-1" style="border-radius: 0;font-size: .7em;" onclick="BTNMantenimiento(<?=$idEstacion;?>)">Programa Mantenimiento</button>
      <button type="button" class="btn bg-warning btn-sm mb-1" style="border-radius: 0;font-size: .7em;" onclick="BTNnom(<?=$idEstacion;?>)">NOM-035</button>
      <button type="button" class="btn bg-secondary btn-sm mb-1 text-white" style="border-radius: 0;font-size: .7em;" onclick="BTNcambioprecio(<?=$idEstacion;?>)">Cambio precio <span class="badge badge-danger"><?=CambioPrecio($idEstacion,$con);?></span></button>
      <button type="button" class="btn bg-primary btn-sm mb-1 text-white" style="border-radius: 0;font-size: .7em;" onclick="BTNAnalisis(<?=$idEstacion;?>)">Análisis de riesgo</button>
      <button type="button" class="btn bg-info btn-sm mb-1 text-white" style="border-radius: 0;font-size: .7em;" onclick="BTNCalibracion(<?=$idEstacion;?>)">Calibración tanques</button>
      <button type="button" class="btn btn-secondary btn-sm mb-1" style="border-radius: 0;font-size: .7em;" onclick="BTNDocumentosSGM(<?=$idEstacion;?>)">SGM (Documentos)</button>
    </div>

  </div>
  </div>

<?php
}
?>
</div>
</div>