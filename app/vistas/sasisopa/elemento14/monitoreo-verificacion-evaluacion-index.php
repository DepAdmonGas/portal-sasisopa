<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";
include_once "app/modelo/MonitoreoVerificacionEvaluacion.php";

$class_ayuda = new Ayuda();
$class_monitoreo_evaluacion = new MonitoreoVerificacionEvaluacion();

$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'14-monitoreo-verificacion-evaluacion');
$id_ayuda = $array_ayuda['id'];
$estado = $array_ayuda['estado'];

$class_monitoreo_evaluacion->agregarIndicadores($Session_IDEstacion);

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
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  <?php if ($id_ayuda != 0) {echo "btnAyuda();";} ?>
  });
  function regresarP(){
   window.history.back();
  }

  function btnAyuda(){
  $('#myModalPolitica').modal('show');
  }

  function btnFinAyuda(idayuda, estado){

    var parametros = {
      "accion" : "actualizar-ayuda",
      "idayuda" : idayuda
    };

    if (idayuda != 0 && estado == 0) {
   $.ajax({
   data:  parametros,
   url:   'app/controlador/AyudaControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   $('#myModalPolitica').modal('hide');
   }
   });

  }else{
  $('#myModalPolitica').modal('hide');
  }

}

function Implementacion(){
window.location.href = '14-monitoreo-verificacion-evaluacion/implementacion-sa'; 
}

function Ventas(){
window.location.href = '14-monitoreo-verificacion-evaluacion/ventas-mes';
}

function Capacitacion(){
$('#myModalCapacitacion').modal('show');
}

function SatisfaccionClientes(){
window.location.href = '4-objetivos-metas-indicadores/experiencia-cliente';
}

function btnMonitoreo(){
window.location.href = '2-analisis-riesgo-evaluacion-impactos-ambientales';
}

function btnCInterna(){
window.location.href = 'capacitacion-interna';
}
function btnCExterna(){
window.location.href = 'capacitacion-externa';
}

function IncidentesAccidentes(){
window.location.href = '16-investigacion-incidentes-accidentes';
}

function btnAtencionHallazgos(){
window.location.href = 'atencion-hallazgos'; 
}

function EvaluacionCRL(){
window.location.href = 'evaluacion-cumplimiento-requisitos-legales'; 
}

function ModalBuscar(){
$('#ModalBuscar').modal('show');
}

function Buscar(){

let YearBuscar = $('#YearBuscar').val();
if (YearBuscar != "") {
$('#YearBuscar').css('border','');

 $('#Contenido').load('app/vistas/sasisopa/elemento14/lista-monitoreo-verificacion-evaluacion.php?Year=' + YearBuscar);
 $('#ModalBuscar').modal('hide');

}else{
$('#YearBuscar').css('border','2px solid #A52525');  
}

}

function CalibracionEquipos(){
window.location.href = 'calibracion-verificacion-mantenimiento-equipos';   
}

function Descargar(Year){
window.location = "descargar-revision-resultados-detalle/" + Year;   
}

function DescargarPI(){
window.location = "descargar-programa-implementacion-s-a";   
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
    <div class="float-left"><h4>14. MONITOREO, VERIFICACIÓN Y EVALUACIÓN</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">

    <a class="mr-1" onclick="ModalBuscar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Buscar" >
    <img src="<?php echo RUTA_IMG_ICONOS."lupa.png"; ?>">
    </a>
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
      </div>
    <div class="card-body">

    <div id="Contenido">
  
     <?php 

      function TC($a,$b){

        if($a == 0 || $b == 0){
          $Return = "<b class='text-warning'>S/I</b>";
        }else{

          $Resul = ($a - $b) / $b * 100;
          $tece = 100 + ($Resul);
          $Porcentaje = number_format($tece,2);

          if( $Porcentaje >= 80  ){
          $Return = "<b class='text-success'>".$Porcentaje."% Excelente</b>";                 
          }else if($Porcentaje >= 0 && $Porcentaje <= 79){
          $Return = "<b class='text-warning'>".$Porcentaje."% Regular</b>";
          }

        }

      return $Return;
      }

      $YearAnt = $fecha_year - 1;
    
      $DicAnt = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,12,$YearAnt);
      $Ene = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,1,$fecha_year);
      $Feb = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,2,$fecha_year);
      $Mar = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,3,$fecha_year);
      $Abr = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,4,$fecha_year);
      $May = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,5,$fecha_year);
      $Jun = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,6,$fecha_year);
      $Jul = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,7,$fecha_year);
      $Ago = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,8,$fecha_year);
      $Sep = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,9,$fecha_year);
      $Oct = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,10,$fecha_year);
      $Nov = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,11,$fecha_year);
      $Dic = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,12,$fecha_year);

      $TC1 = TC($Ene,$DicAnt);
      $TC2 = TC($Feb,$Ene);
      $TC3 = TC($Mar,$Feb);
      $TC4 = TC($Abr,$Mar);
      $TC5 = TC($May,$Abr);
      $TC6 = TC($Jun,$May);
      $TC7 = TC($Jul,$Jun);
      $TC8 = TC($Ago,$Jul);
      $TC9 = TC($Sep,$Ago);
      $TC10 = TC($Oct,$Sep);
      $TC11 = TC($Nov,$Oct);
      $TC12 = TC($Dic,$Nov);
      ?>

      <div class="border p-2">

  <div class="text-right">
  <a onclick="Descargar(<?=$fecha_year;?>)" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a>
  </div>

      <table class="table table-bordered table-sm pb-0 mb-0 mt-1">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Implementación del SA</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">No. Total de elementos implementados VS No. de elementos del SA</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=$class_monitoreo_evaluacion->meta($Session_IDEstacion,1);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">ANUAL</td>
        </tr>
        <tr>
          <td colspan="4">
          <div class="mt-1"><b>Resultado:</b> <?=$class_monitoreo_evaluacion->resultadoImplementacion($Session_IDEstacion,$fecha_year);?></div>
          </td>
        </tr>
        </tbody>
        </table> 

        <div class="text-right mt-2"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="Implementacion()" >Ver detalle</button></div>
        </div>

    <hr>

      <div class="border p-2">

      <table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Ventas</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">Venta del mes inmediato anterior VS venta del mes actual</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=$class_monitoreo_evaluacion->meta($Session_IDEstacion,2,$con);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Mensual</td>
        </tr>
        </tbody>
        </table> 

     <div class="mt-1"><b>Resultado:</b></div>

      <div class="row">
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Dic <?=$YearAnt;?></th>
                <th class="text-center bg-light">Ene <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($DicAnt,2);?></td>
                <td class="text-center bg-light"><?=number_format($Ene,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC1;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php if(number_format(date("m")) >= 2){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Ene <?=$fecha_year;?></th>
                <th class="text-center">Feb <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Ene,2);?></td>
                <td class="text-center"><?=number_format($Feb,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC2;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 3){ ?>
          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Feb <?=$fecha_year;?></th>
                <th class="text-center bg-light">Mar <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Feb,2);?></td>
                <td class="text-center bg-light"><?=number_format($Mar,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC3;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 4){ ?>
          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Mar <?=$fecha_year;?></th>
                <th class="text-center">Abr <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Mar,2);?></td>
                <td class="text-center"><?=number_format($Abr,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC4;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 5){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Abr <?=$fecha_year;?></th>
                <th class="text-center bg-light">May <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Abr,2);?></td>
                <td class="text-center bg-light"><?=number_format($May,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC5;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 6){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">May <?=$fecha_year;?></th>
                <th class="text-center">Jun <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($May,2);?></td>
                <td class="text-center"><?=number_format($Jun,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC6;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>
      </div>

        <div class="row">
        <?php if(number_format(date("m")) >= 7){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Jun <?=$fecha_year;?></th>
                <th class="text-center bg-light">Jul <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Jun,2);?></td>
                <td class="text-center bg-light"><?=number_format($Jul,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC7;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 8){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Jul <?=$fecha_year;?></th>
                <th class="text-center">Ago <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Jul,2);?></td>
                <td class="text-center"><?=number_format($Ago,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC8;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 9){ ?>
          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Ago <?=$fecha_year;?></th>
                <th class="text-center bg-light">Sep <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Ago,2);?></td>
                <td class="text-center bg-light"><?=number_format($Sep,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC9;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 10){ ?>
          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Sep <?=$fecha_year;?></th>
                <th class="text-center">Oct <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Sep,2);?></td>
                <td class="text-center"><?=number_format($Oct,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC10;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 11){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Oct <?=$fecha_year;?></th>
                <th class="text-center bg-light">Nov <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Oct,2);?></td>
                <td class="text-center bg-light"><?=number_format($Nov,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC11;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 12){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Nov <?=$fecha_year;?></th>
                <th class="text-center">Dic <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Nov,2);?></td>
                <td class="text-center"><?=number_format($Dic,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC12;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>
      </div>
      <div class="text-right"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="Ventas()" >Ver detalle</button></div>
      </div>

      <hr>

    <div class="border p-2">

      <table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Capacitación</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">No. de personal capacitado vs No. de personal de la estación</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=$class_monitoreo_evaluacion->meta($Session_IDEstacion,3,$con);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Semestral</td>
        </tr>
        <tr>
          <td colspan="4">
            
        <div class="mt-1"><b>Resultado:</b></div>

        <div class="row">
          <div class="col-6">
          <div class="text-secondary">Primer semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoCapacitacion($Session_IDEstacion,$fecha_year,1);?>
          </div>
          <?php if(number_format(date("m")) >= 7){ ?>
          <div class="col-6">
          <div class="text-secondary">Segundo semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoCapacitacion($Session_IDEstacion,$fecha_year,2);?>
          </div>
        <?php } ?>
        </div>

          </td>
        </tr>
        </tbody>
        </table> 

        <div class="text-right mt-2"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="Capacitacion()" >Ver detalle</button></div>
        </div>

        <hr>

        <div class="border p-2">

      <table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Satisfacción del cliente</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">Media del total de clientes con experiencia: Mala, Buena y Excelente</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=$class_monitoreo_evaluacion->meta($Session_IDEstacion,4,$con);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Semestral</td>
        </tr>
        <tr>
          <td colspan="4">
          <div class="mt-1"><b>Resultado:</b></div>

        <div class="row">
          <div class="col-6">
          <div class="text-secondary">Primer semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoSatisfaccion($Session_IDEstacion,$fecha_year,1);?>
          </div>
          <?php if(number_format(date("m")) >= 7){ ?>
          <div class="col-6">
          <div class="text-secondary">Segundo semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoSatisfaccion($Session_IDEstacion,$fecha_year,2);?>
          </div>
        <?php } ?>
        </div>
          </td>
        </tr>
        </tbody>
        </table>

        <div class="text-right mt-2"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="SatisfaccionClientes()" >Ver detalle</button></div>
      

      </div>

      <hr>

      <div class="border p-2">

      <table class="table table-bordered table-sm c-pointer pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Incidentes y accidentes</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">No total de accidentes e incidentes ocurridos VS número total de accidentes e incidentes atendidos</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=$class_monitoreo_evaluacion->meta($Session_IDEstacion,5,$con);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Semestral</td>
        </tr>
        <tr>
          <td colspan="4">
           <div class="mt-1"><b>Resultado:</b></div>

        <div class="row">
          <div class="col-6">
          <div class="text-secondary">Primer semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoIncidentes($Session_IDEstacion,$fecha_year,1);?>
          </div>
          <?php if(number_format(date("m")) >= 7){ ?>
          <div class="col-6">
          <div class="text-secondary">Segundo semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoIncidentes($Session_IDEstacion,$fecha_year,2);?>
          </div>
        <?php } ?>
        </div>
          </td>
        </tr>
        </tbody>
        </table>

        <div class="text-right mt-2"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="IncidentesAccidentes()" >Ver detalle</button></div>

      </div>

    <hr>
  </div>


  <table class="table table-sm table-bordered">
    <tbody>
      <tr>
      <td><b>Programa de implementación del Sistema de Administración</b></td>
      <td class="text-center align-middle" width="40px" onclick="DescargarPI()"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></td>

      </tr>
    </tbody>
  </table>

  <div class="row">

    <div class="col-3">
      <div class="border p-4">
      <h5>Monitoreo de aspectos ambientales y riesgos</h5>
      <div class="text-right mt-3">
        <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnMonitoreo()">Ver detalle</button>
      </div>
      </div>
    </div>
    
    <div class="col-3">
      <div class="border p-4">
      <h5>Calibración, Verificación y mantenimiento de equipos</h5>
      <div class="text-right mt-3">
      <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="CalibracionEquipos()">Ver detalle</button>
      </div>
      </div>
    </div>

    <div class="col-3">
      <div class="border p-4">
      <h5>Evaluación y cumplimiento de requisitos legales</h5>
      <div class="text-right mt-3">
      <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="EvaluacionCRL()">Ver detalle</button>
      </div>
      </div>
    </div>

    <div class="col-3">
      <div class="border p-4">
      <h5>Administración de hallazgos derivados del monitoreo del sistema de administración</h5>
      <div class="text-right mt-3">
      <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnAtencionHallazgos()">Ver detalle</button>
      </div>
      </div>
    </div>

  </div>


    </div>
    </div>
    </div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="myModalPolitica" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 14. MONITOREO, VERIFICACIÓN Y EVALUACIÓN, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            En este apartado podrás monitorear y evaluar el cumplimiento de los indicadores mas relevantes del sistema de administración..
          </p>
          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>En la tabla medición de indicadores y frecuencia da clic en objeto y llena los campos que se solicitan y da clic en aceptar</li>
            <li>En la columna acciones a implementar genera un resumen detallado de aquellas actividades a implementar para cumplir la meta (en caso de no haber llegado al objetivo)</li>
            <li>Da clic en objeto para entrar a detalle de cada uno de los indicadores</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> y quienes estén involucrados en la implementación del sistema de administración el monitoreo y comportamiento de los resultados así como de proponer las acciones a implementar para la obtención de las metas.</p>

          <small>Nota: Las acciones a implementar también podrán ser propuestas para el mejor desempeño del sistema de administración.</small>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

      <div class="modal fade bd-example-modal-lg" id="myModalCapacitacion">
    <div class="modal-dialog modal-m modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Capacitación</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">

        <div class="row">
         <!-- CARD - CAPACITACION INTERNA -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 mb-2 "> 
          <div class="card" style="border-radius: 0px;">
          <div class="card-body" style="font-size: 1.3em;">
          <div class="text-secondary">
          Programa de capacitación interna
          </div>
            <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnCInterna()" >Ver detalle</button></div>
          </div>
          
        </div>
        </div>
         

        <!-- CARD - CAPACITACION EXTERNA -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 mb-2 "> 
          <div class="card" style="border-radius: 0px;">
          <div class="card-body" style="font-size: 1.3em;">
          <div class="text-secondary">
          Programa de capacitación externa
        </div>
          <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnCExterna()" >Ver detalle</button></div>
          </div>
          
        </div>
        </div>
        </div>

        </div>
      </div>
    </div>
    </div>

     <div class="modal fade bd-example-modal-lg" id="ModalBuscar">
    <div class="modal-dialog modal-m modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Buscar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">

          <label>Año:</label>
          <input type="number" class="form-control rounded-0" id="YearBuscar">

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="Buscar()">Aceptar</button>
        </div>
        </div>

    </div>
    </div>





  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
<?php
//------------------
mysqli_close($con);
//------------------
?>