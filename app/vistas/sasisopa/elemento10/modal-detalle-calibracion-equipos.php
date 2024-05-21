<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/ControlActividadProceso.php";
$class_control_actividad_proceso = new ControlActividadProceso();

$sqlCE = "SELECT * FROM tb_calibracion_equipos WHERE id = '".$_GET['ID']."' ";
$resultCE = mysqli_query($con, $sqlCE);
$numeroCE = mysqli_num_rows($resultCE);
$rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC);
$IdUsuario = $rowCE['id_usuario'];
$Folio = $rowCE['folio'];
$Fecha = $rowCE['fecha'];
$Hora = $rowCE['hora'];
$Equipo = $rowCE['equipo'];
$Observaciones = $rowCE['observaciones'];
$Responsableveri = $rowCE['responsable_verificacion'];
$Estado = $rowCE['estado'];

if($rowCE['categoria'] == 1){
  $Categoria = 'Ordinaria'; 
  }else{
  $Categoria = 'Extraordinaria';  
  }



function Personal($IdUsuario,$con){
$sql = "SELECT nombre, firma FROM tb_usuarios WHERE id = '".$IdUsuario."'";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$nombre = $row['nombre'];
$firma = $row['firma'];
$array = array('nombre' => $nombre, 'firma' => $firma);
return $array;
}

function Dispensario($iddispensario, $con){
$sql = "SELECT * FROM tb_dispensarios WHERE id = '".$iddispensario."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$nodispensario = $row['no_dispensario'];
$marca = $row['marca'];
$modelo = $row['modelo'];
$serie = $row['serie'];
$array = array('nodispensario' => $nodispensario, 'marca' => $marca, 'modelo' => $modelo, 'serie' => $serie);
return $array;
}

function Jarra($idjarra, $con){
$sql = "SELECT * FROM tb_jarra_patron WHERE id = '".$idjarra."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$marca = $row['marca'];
$serie = $row['no_serie'];
$capacidad = $row['capacidad'];
$array = array('marca' => $marca, 'serie' => $serie, 'capacidad' => $capacidad);
return $array;
}


?>

  <div class="modal-header">
  <h4 class="modal-title">Detalle calibración de equipos</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">
  <?php if($Equipo == 'Dispensario'){ 

  $UV = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Unidad de verificacion',$con);
  $NA = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'No. de acreditacion',$con);

  $Personal = Personal($IdUsuario,$con);

  ?>
  <h6>Equipo: <?=$Equipo;?></h6>
  <div class="row">
    <div class="col-3">
      <h6>Folio:</h6>
      <div>00<?=$Folio;?></div>
    </div>
    <div class="col-3">
      <h6>Fecha:</h6>
      <div><?=FormatoFecha($Fecha);?></div>
    </div>
    <div class="col-3">
      <h6>Hora:</h6>
      <div><?=date("g:i a",strtotime($Hora));?></div>
    </div>
    <div class="col-3">
      <h6>Unidad de verificación:</h6>
      <div><?=$UV;?></div>
    </div>
    <div class="col-3 mt-2">
      <h6>No. de acreditación:</h6>
      <div><?=$NA;?></div>
    </div>

    <div class="col-3 mt-2">
      <h6>Tipo calibración:</h6>
      <div><?=$Categoria;?></div>
    </div>

    
  </div>


<table class="table table-sm table-bordered mt-4" style="font-size: .9em;">
<thead>
  <tr>
    <th class="text-center align-middle">No Dispensario</th>
    <th class="text-center align-middle">Marca</th>
    <th class="text-center align-middle">Modelo</th>
    <th class="text-center align-middle">Serie</th>
    <th class="text-center align-middle">¿Cumple con el error maximo tolerado?</th>
    <th class="text-center align-middle">¿Cumple con la repetibilidad?</th>
    <th class="text-center align-middle">Folio del holograma</th>
    <th class="text-center align-middle">Distintivo empresarial</th>
  </tr>
</thead>
<tbody>
<?php
$sql_lista = "SELECT * FROM tb_calibracion_equipos_dispensario WHERE id_calibracion = '".$_GET['ID']."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$Dispensario = Dispensario($row_lista['id_dispensario'], $con);

echo '<tr>';
echo '<td class="text-center align-middle">'.$Dispensario['nodispensario'].'</td>';
echo '<td class="text-center align-middle">'.$Dispensario['marca'].'</td>';
echo '<td class="text-center align-middle">'.$Dispensario['modelo'].'</td>';
echo '<td class="text-center align-middle">'.$Dispensario['serie'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['resultado1'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['resultado2'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['resultado3'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['resultado4'].'</td>';
echo '</tr>';
}
?>
</tbody>
</table>


  <h6 class="mt-3">Observaciones:</h6>
  <div class="border p-2"><?=$Observaciones;?></div>

  <div class="row mt-3">
    <div class="col-4 text-center">
      <div class="mb-1" style="margin-top: 35px;"><?=$Responsableveri;?></div>
      <h6 class="border-top pt-1">Responsable de la verificación</h6>
    </div>
    <div class="col-5 text-center">
      <div class="text-center"><img width="80px" src="<?=RUTA_IMG_FIRMA_PERSONAL.$Personal['firma']?>"></div>
      <div class="mb-1"><?=$Personal['nombre'];?></div>
      <h6 class="border-top pt-1">Firma de quien supervisa la actividad</h6>
    </div>
  </div>


  <?php }else if($Equipo == 'Jarra patron'){ 

  $TA = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Temperatura ambiente');
  $PA = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Presión atmosférica');
  $H = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Humedad');
  $LUC = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Liquido usado en la calibración');
  $TL = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Temperatura del líquido');
  $LC = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Laboratorio de calibración');
  $NA = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'No. de acreditación');
  $MC = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Método de calibración');

  $Personal = Personal($IdUsuario,$con);
  ?>

  <h6>Equipo: <?=$Equipo;?></h6>

  <div class="row">
  <div class="col-3 ">
    <h6>Folio:</h6>
    <div>00<?=$Folio;?></div>
  </div>
  <div class="col-3">
    <div class=""><h6>Fecha:</h6></div>
    <div><?=FormatoFecha($Fecha);?></div>
  </div>
  <div class="col-3">
      <h6>Hora:</h6>
      <div><?=date("g:i a",strtotime($Hora));?></div>
    </div>

    <div class="col-3">
    <div class=""><h6>Temperatura ambiente:</h6></div>
    <div><?=$TA;?></div>
  </div>

  <div class="col-3 mt-2">
    <div class=""><h6>Presión atmosférica:</h6></div>
    <div><?=$PA;?></div>
  </div>

  <div class="col-3 mt-2">
    <div class=""><h6>Humedad:</h6></div>
    <div><?=$H;?></div>
  </div>

    <div class="col-3 mt-2">
    <div class=""><h6>Liquido usado en la calibración:</h6></div>
    <div><?=$LUC;?></div>
  </div>
      <div class="col-3 mt-2">
    <div class=""><h6>Temperatura del líquido:</h6></div>
    <div><?=$TL;?></div>
  </div>

  <div class="col-3 mt-2">
    <div class=""><h6>Laboratorio de calibración:</h6></div>
    <div><?=$LC;?></div>
  </div>

    <div class="col-3 mt-2">
    <div class=""><h6>No. de acreditación:</h6></div>
    <div><?=$NA;?></div>
  </div>

      <div class="col-3 mt-2">
    <div class=""><h6>Método de calibración:</h6></div>
    <div><?=$MC;?></div>
  </div>
</div>


<table class="table table-sm table-bordered mt-4">
<thead>
  <tr>
    <th>Marca</th>
    <th>No. Serie</th>
    <th>Capacidad</th>
    <th>Incertidumbre de calibración</th>
  </tr>
</thead>
<tbody>
<?php
$sql_lista = "SELECT * FROM tb_calibracion_equipos_jarra WHERE id_calibracion = '".$_GET['ID']."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$Jarra = Jarra($row_lista['id_jarra'], $con);

echo '<tr>';
echo '<td>'.$Jarra['marca'].'</td>';
echo '<td>'.$Jarra['serie'].'</td>';
echo '<td>'.$Jarra['capacidad'].'</td>';
echo '<td>'.$row_lista['resultado1'].'</td>';
echo '</tr>';
}
?>
</tbody>
</table>

  <h6 class="mt-3">Observaciones:</h6>
  <div class="border p-2"><?=$Observaciones;?></div>

  <div class="row mt-3">
    <div class="col-4 text-center">
      <div class="mb-1" style="margin-top: 35px;"><?=$Responsableveri;?></div>
      <h6 class="border-top pt-1">Responsable de la verificación</h6>
    </div>
    <div class="col-5 text-center">
      <div class="text-center"><img width="80px" src="<?=RUTA_IMG_FIRMA_PERSONAL.$Personal['firma']?>"></div>
      <div class="mb-1"><?=$Personal['nombre'];?></div>
      <h6 class="border-top pt-1">Firma de quien supervisa la actividad</h6>
    </div>
  </div>


  <?php }else if($Equipo == 'Sondas de medición'){  
  
  $UV = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Unidad de verificación', $con);
  $NA = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'No. de acreditación', $con);
  $MUC = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Método usado para la calibración', $con);
  $Personal = Personal($IdUsuario,$con);
  ?>

  <h6>Equipo: <?=$Equipo;?></h6>

  <div class="row">
  <div class="col-3 ">
    <h6>Folio:</h6>
    <div><h6>00<?=$Folio;?></h6></div>
  </div>
  <div class="col-3">
    <div class=""><h6>Fecha:</h6></div>
    <?=FormatoFecha($Fecha);?>
  </div>
    <div class="col-3">
      <h6>Hora:</h6>
      <div><?=date("g:i a",strtotime($Hora));?></div>
    </div>

    <div class="col-3">
    <div class=""><h6>Unidad de verificación:</h6></div>
    <?=$UV;?>
  </div>

  <div class="col-3 mt-2">
    <div class=""><h6>No. de acreditación:</h6></div>
    <?=$NA;?>
  </div>

  <div class="col-5 mt-2">
    <div class=""><h6>Método usado para la calibración:</h6></div>
    <?=$MUC;?>
  </div>

</div>

  <table class="table table-sm table-bordered mt-4">
<thead>
  <tr>
    <th>No. Sonda</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Incertidumbre de calibracion</th>
  </tr>
</thead>
<tbody>
<?php
$sql_lista = "SELECT * FROM tb_calibracion_equipos_sonda WHERE id_calibracion = '".$_GET['ID']."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$Sonda = $class_control_actividad_proceso->Sondas($row_lista['id_sonda'], $con);

echo '<tr>';
echo '<td>'.$Sonda['nosonda'].'</td>';
echo '<td>'.$Sonda['marca'].'</td>';
echo '<td>'.$Sonda['modelo'].'</td>';
echo '<td class="">'.$row_lista['resultado1'].'</td>';
echo '</tr>';
}
?>
</tbody>
</table>

  <h6 class="mt-3">Observaciones:</h6>
  <div class="border p-2"><?=$Observaciones;?></div>

  <div class="row mt-3">
    <div class="col-4 text-center">
      <div class="mb-1" style="margin-top: 35px;"><?=$Responsableveri;?></div>
      <h6 class="border-top pt-1">Responsable de la verificación</h6>
    </div>
    <div class="col-5 text-center">
      <div class="text-center"><img width="80px" src="<?=RUTA_IMG_FIRMA_PERSONAL.$Personal['firma']?>"></div>
      <div class="mb-1"><?=$Personal['nombre'];?></div>
      <h6 class="border-top pt-1">Firma de quien supervisa la actividad</h6>
    </div>
  </div>

  <?php }else if($Equipo == 'Tanques de almacenamiento'){  

  $UV = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Unidad de verificación');
  $NA = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'No. de acreditación');
  $MUC = $class_control_actividad_proceso->detalleCalibracion($_GET['ID'],'Método usado para la calibración');
  $Personal = Personal($IdUsuario,$con);
  ?>

  <h6>Equipo: <?=$Equipo;?></h6>

  <div class="row">
  <div class="col-3 ">
    <h6>Folio:</h6>
    <div><h6>00<?=$Folio;?></h6></div>
  </div>
  <div class="col-3">
    <div class=""><h6>Fecha:</h6></div>
    <?=FormatoFecha($Fecha);?>
  </div>
      <div class="col-3">
      <h6>Hora:</h6>
      <div><?=date("g:i a",strtotime($Hora));?></div>
    </div>

    <div class="col-3">
    <div class=""><h6>Unidad de verificación:</h6></div>
    <?=$UV;?>
  </div>

  <div class="col-3 mt-2">
    <div class=""><h6>No. de acreditación:</h6></div>
    <?=$NA;?>
  </div>

  <div class="col-5 mt-2">
    <div class=""><h6>Método usado para la calibración:</h6></div>
    <?=$MUC;?>
  </div>

</div>

<table class="table table-sm table-bordered mt-4">
<thead>
  <tr>
    <th class="align-middle">No. Tanque</th>
    <th class="align-middle">Capacidad</th>
    <th class="align-middle" width="130">Producto</th>
    <th class="align-middle">Incertidumbre de calibración</th>
    <th class="align-middle">Cumple con los límites establecidos</th>
    <th></th>
  </tr>
</thead>
<tbody>
<?php
$sql_lista = "SELECT * FROM tb_calibracion_equipos_tanques WHERE id_calibracion = '".$_GET['ID']."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$Tanque = $class_control_actividad_proceso->Tanque($row_lista['id_tanque'], $con);

if($row_lista['resultados'] != ""){
$ResultadoPdf = '<a href="archivos/calibracion/'.$row_lista['resultados'].'" download style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
  <img src="'.RUTA_IMG_ICONOS.'pdf.png">
  </a>';
}else{
$ResultadoPdf = "";
}

echo '<tr>';
echo '<td>'.$Tanque['notanque'].'</td>';
echo '<td>'.$Tanque['capacidad'].'</td>';
echo '<td>'.$Tanque['producto'].'</td>';
echo '<td class="">'.$row_lista['resultado1'].'</td>';
echo '<td class="">'.$row_lista['resultado2'].'</td>';
echo '<td class="">'.$ResultadoPdf.'</td>';
echo '</tr>';
}
?>
</tbody>
</table>

  <h6 class="mt-3">Observaciones:</h6>
  <div class="border p-2"><?=$Observaciones;?></div>

  <div class="row mt-3">
    <div class="col-4 text-center">
      <div class="mb-1" style="margin-top: 35px;"><?=$Responsableveri;?></div>
      <h6 class="border-top pt-1">Responsable de la verificación</h6>
    </div>
    <div class="col-5 text-center">
      <div class="text-center"><img width="80px" src="<?=RUTA_IMG_FIRMA_PERSONAL.$Personal['firma']?>"></div>
      <div class="mb-1"><?=$Personal['nombre'];?></div>
      <h6 class="border-top pt-1">Firma de quien supervisa la actividad</h6>
    </div>
  </div>

  <?php } ?>
  </div>
