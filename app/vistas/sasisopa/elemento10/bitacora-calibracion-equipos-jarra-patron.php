<?php
require('app/help.php');
include_once "app/modelo/ControlActividadProceso.php";
$class_control_actividad_proceso = new ControlActividadProceso();

$sqlCE = "SELECT * FROM tb_calibracion_equipos WHERE id = '".$GET_ID."' ";
$resultCE = mysqli_query($con, $sqlCE);
$numeroCE = mysqli_num_rows($resultCE);
$rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC);
$Folio = $rowCE['folio'];
$Fecha = $rowCE['fecha'];
$Hora = $rowCE['hora'];
$Observaciones = $rowCE['observaciones'];
$Responsableveri = $rowCE['responsable_verificacion'];
$Estado = $rowCE['estado'];

$TA = $class_control_actividad_proceso->detalleCalibracion($GET_ID,'Temperatura ambiente');
$PA = $class_control_actividad_proceso->detalleCalibracion($GET_ID,'Presión atmosférica');
$H = $class_control_actividad_proceso->detalleCalibracion($GET_ID,'Humedad');
$LUC = $class_control_actividad_proceso->detalleCalibracion($GET_ID,'Liquido usado en la calibración');
$TL = $class_control_actividad_proceso->detalleCalibracion($GET_ID,'Temperatura del líquido');
$LC = $class_control_actividad_proceso->detalleCalibracion($GET_ID,'Laboratorio de calibración');
$NA = $class_control_actividad_proceso->detalleCalibracion($GET_ID,'No. de acreditación');
$MC = $class_control_actividad_proceso->detalleCalibracion($GET_ID,'Método de calibración');

?>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>alertify.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>themes/default.rtl.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>bootstrap-select.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <style media="screen">
  .LoaderPage {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
  }
  .hovercolor:hover{
  background: rgba(0, 120, 238, .8) !important;
  }

  .cont-puntos{
    border-bottom: 3px solid #3399cc;
    box-shadow: 1px 1px 5px #EDEDED;
  }

  .titulo-punto{
    font-size: 1.25em;
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  });

  function regresarP(){
  window.history.back();
  }

  function EditarOtros(e,id,input){

var parametros = {
    "accion" : "editar-calibracion-equipos-jarra-patron",
  "contenido" : e.value,
  "id" : id,
  "input" : input
};

$.ajax({
data:  parametros,
url:   '../app/controlador/ControlActividadProcesoControlador.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {

}
});

}

  function Finalizar(Id){

let Fecha = $('#Fecha').val();

if (Fecha != "") {
$('#Fecha').css('border','');

alertify.confirm('',
function(){

var parametros = {
"accion" : "finalizar-calibracion-equipos",
"Id" : Id,
"Equipo" : 'Jarra patron'
};

 $.ajax({
 data:  parametros,
 url:   '../app/controlador/ControlActividadProcesoControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {
    window.history.back();
 }
 });

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea finalizar la calibración de equipos',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
  $('#Fecha').css('border','2px solid #A52525');
  }    
  }

  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal">

    <div class="row no-gutters">
    <div class="col-12">
    <div class="card adm-card" style="border: 0;">
    <div class="adm-car-title">
      <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
      <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
      </div>
    
    <!-- TITULO / ENCABEZADO -->
    <div class="float-left">
      <h4>Bitácora calibración de equipos (Jarra patron)</h4>
    </div>

    </div>
    <div class="card-body">

<div class="row">
  <div class="col-3 text-secondary">
    <h6>Folio:</h6>
    <div><h6>00<?=$Folio;?></h6></div>
  </div>
  <div class="col-3">
    <div class="text-secondary"><h6>Fecha:</h6></div>
    <input type="date" class="form-control rounded-0" value="<?=$Fecha;?>" onchange="EditarOtros(this,<?=$GET_ID;?>,1)" id="Fecha">
  </div>

    <div class="col-3">
    <div class="text-secondary"><h6>Hora:</h6></div>
    <input type="time" class="form-control rounded-0" value="<?=$Hora;?>" onchange="EditarOtros(this,<?=$GET_ID;?>,2)" id="Fecha">
  </div>

    <div class="col-3">
    <div class="text-secondary"><h6>Temperatura ambiente:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$TA;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,3)">
  </div>

  <div class="col-3">
    <div class="text-secondary"><h6>Presión atmosférica:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$PA;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,4)">
  </div>

  <div class="col-3 mt-2">
    <div class="text-secondary"><h6>Humedad:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$H;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,5)">
  </div>

    <div class="col-3 mt-2">
    <div class="text-secondary"><h6>Liquido usado en la calibración:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$LUC;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,6)">
  </div>
      <div class="col-3 mt-2">
    <div class="text-secondary"><h6>Temperatura del líquido:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$TL;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,7)">
  </div>

  <div class="col-3 mt-2">
    <div class="text-secondary"><h6>Laboratorio de calibración:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$LC;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,8)">
  </div>

    <div class="col-3 mt-2">
    <div class="text-secondary"><h6>No. de acreditación:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$NA;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,9)">
  </div>

      <div class="col-3 mt-2">
    <div class="text-secondary"><h6>Método de calibración:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$MC;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,10)">
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
$sql_lista = "SELECT * FROM tb_calibracion_equipos_jarra WHERE id_calibracion = '".$GET_ID."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$Jarra = $class_control_actividad_proceso->jarraPatron($row_lista['id_jarra']);

echo '<tr>';
echo '<td>'.$Jarra['marca'].'</td>';
echo '<td>'.$Jarra['serie'].'</td>';
echo '<td>'.$Jarra['capacidad'].'</td>';
echo '<td class="p-0 m-0"><input type="text" class="form-control border-0 rounded-0" value="'.$row_lista['resultado1'].'" onkeyup="EditarOtros(this,'.$row_lista['id'].',13)"></td>';
echo '</tr>';
}
?>
</tbody>
</table>

 
<div class="row">
  <div class="col-6">
    <div class="text-secondary mt-2"><h6>Observaciones:</h6></div>
    <textarea class="form-control rounded-0" onkeyup="EditarOtros(this,<?=$GET_ID;?>,11)"><?=$Observaciones;?></textarea>
  </div>
  <div class="col-6">
    <div class="text-secondary mt-2"><h6>Responsable de la verificación:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$Responsableveri;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,12)">
  </div>
</div>

<?php  
if($Estado == 0){

echo '<div class="text-right">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="Finalizar('.$GET_ID.')">Finalizar</button>
  </div>';

}else{
echo '<div class="text-right">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="regresarP()">Finalizar</button>
  </div>';  
}
?>
    </div>
    </div>
    </div>
    </div>
    </div>



  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
