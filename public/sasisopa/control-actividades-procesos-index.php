<?php
require('app/help.php');

$sql_sasisopa_ayuda = "SELECT * FROM pu_sasisopa_ayuda WHERE id_usuario = '".$Session_IDUsuarioBD."' and detalle = '10-control-actividades-procesos' and estado = 0 LIMIT 1";
$result_sasisopa_ayuda = mysqli_query($con, $sql_sasisopa_ayuda);
$numero_sasisopa_ayuda = mysqli_num_rows($result_sasisopa_ayuda);

if ($numero_sasisopa_ayuda == 1) {
while($row_ayuda = mysqli_fetch_array($result_sasisopa_ayuda, MYSQLI_ASSOC)){
$idAyuda = $row_ayuda['id'];
}
}else{
$idAyuda = 0; 
}

/*date_default_timezone_set('America/Mexico_City');
$fecha_del_dia = date("Y-m-d");
    $hora_del_dia = date("h:i:s");

$ClassMantenimiento->MantenimientoDia(2, $fecha_del_dia, $hora_del_dia, $con);
$ClassMantenimiento->MantenimientoCalendario(2, $fecha_del_dia, $hora_del_dia, $con);*/

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
<?php if ($numero_sasisopa_ayuda == 1) {echo "btnAyuda();";} ?>
  });

  function regresarP(){
   window.history.back();   
  }
  function btnAyuda(){
  $('#myModalControlActividades').modal('show');
  }

function btnFinAyuda(){

var puntosSasisopa = <?=$numero_sasisopa_ayuda;?>;
  
 var parametros = {
        "idAyuda" : <?=$idAyuda; ?>
      }; 

  if (puntosSasisopa != 0) {

   $.ajax({
   data:  parametros,
   url:   'public/sasisopa/actualizar/actualizar-ayuda.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   $('#myModalControlActividades').modal('hide');  
   }
   });  

  }else{
  $('#myModalControlActividades').modal('hide'); 
  }
  }
 
  function btnProgramaAnual(){
  window.location.href = "programa-anual-mantenimiento";  
  }

  function BitacoraConfiguracion(){
  window.location.href = "configuracion-bitacora";   
  }

  function BtnRecepcionDescarga(){
  window.location.href = "recepcion-descargar-producto";
  }

  function BtnMantenimiento(){
  window.location.href = "mantenimiento-preventivo-correctivo";
  }

  function BitacoraRecepcionDescarga(){
  window.location.href = "bitacora-recepcion-descargar-producto";
  }

  function BitacoraMantenimiento(){
  window.location.href = "bitacora-mantenimiento";  
  }

  function BitacoraProfeco(){
  window.location.href = "bitacora-profeco";
  }

  function BtnCalibracionEquipos(){
  window.location.href = "calibracion-equipos";  
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
      <h4>10. CONTROL DE ACTIVIDADES Y PROCESOS</h4>
    </div>


    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
    </div>
    <div class="card-body">

 <div class="row">
   
  <!-- CARD - PROC. DE OPERACION -->
  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-2 mb-2 "> 
  <div class="card" style="border-radius: 0px;">
  <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Procedimientos de Operación, Seguridad y Mantenimiento
</div>
    <div class="text-right" style="margin-top: 10px;">
      <a target="_blabk" href="archivos/procedimientos/DLES.ADMONGAS.001.pdf" class="btn btn-primary btn-sm" style="border-radius: 0px;">Ver procedimientos</a></div>
  </div>
  </div>
  </div>


  <!-- CARD - PROG. ANUAL MTTO -->
  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-2 mb-2 "> 
   <div class="card" style="border-radius: 0px;">
    <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Programa anual de mantenimiento</div>
    <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnProgramaAnual()" >Ver programa</button></div>
  </div>
  </div>
  </div>

<?php
 
$fecha_actual = strtotime($fecha_del_dia);
$fecha_entrada = strtotime("2020-06-15");
if ($fecha_actual >= $fecha_entrada) {

$detalle = '<div class="alert alert-primary mt-2" style="font-size: .8em;">
  Da clic en el botón <b>Configuración Bitácora</b> para darle seguimiento a la descarga e instalación de la aplicación.
</div>
';
$disabled = "";

}else{

  $detalle = '<div class="alert alert-warning mt-2" style="font-size: .8em;">
  El lunes 15 de junio podrás realizar:
  (<b>Recepción y Descarga del Producto</b>) y (<b>Mantenimiento Preventivo y Correctivo</b>) desde la aplicación móvil <b>AdmonGas Bitacora</b>.
</div>
';
$disabled = "disabled";

}

?>
   
   <!-- CARD - BITACORAS -->
  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-2 mb-2 "> 

   <div class="card" style="border-radius: 0px;">
   <div class="card-body" style="font-size: 1.3em;">
   <div class="text-secondary mb-3">Bitacoras</div>
   
   <button type="button" class="btn btn-primary btn-sm btn-block" onclick="BitacoraConfiguracion()" style="border-radius: 0px;font-size: .8em">Configuración Bitácora</button>

   <button type="button" class="btn btn-primary btn-sm btn-block" onclick="BtnRecepcionDescarga()" style="border-radius: 0px;font-size: .8em">Recepción y Descarga del Producto</button>

   <button type="button" class="btn btn-primary btn-sm btn-block" onclick="BtnMantenimiento()" style="border-radius: 0px;font-size: .8em">Mantenimiento</button>

   <button type="button" class="btn btn-primary btn-sm btn-block" onclick="BtnCalibracionEquipos()" style="border-radius: 0px;font-size: .8em">Calibración de equipos</button>

   <button type="button" class="btn btn-primary btn-sm btn-block" onclick="BitacoraProfeco()" style="border-radius: 0px;font-size: .8em">Bitácora PROFECO</button>
  </div>
  
</div>


<?php if ($Session_IDEstacion == 1 || $Session_IDEstacion == 2 || $Session_IDEstacion == 4 || $Session_IDEstacion == 5) { ?>

  <hr>
   <div class="card" style="border-radius: 0px;">
   <div class="card-body" style="font-size: 1.3em;">
   <div class="text-secondary mb-3">Bitacoras <small class="text-danger">(Nueva versión)</small></div>
   <button type="button" class="btn btn-info btn-sm btn-block " onclick="BitacoraConfiguracion()" style="border-radius: 0px;font-size: .8em">Configuración Bitácora</button>

   <button type="button" class="btn btn-info btn-sm btn-block" onclick="BitacoraRecepcionDescarga()" style="border-radius: 0px;font-size: .8em">Recepción y Descarga del Producto</button>

   <button type="button" class="btn btn-info btn-sm btn-block" onclick="BitacoraMantenimiento()" style="border-radius: 0px;font-size: .8em">Mantenimiento</button>
  </div>
  
</div>
<?php } ?>

</div>


 </div>

    </div>
    </div>
    </div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="myModalControlActividades" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 10. CONTROL DE ACTIVIDADES Y PROCESOS, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            Aquí vas a encontrar tu programa anual de mantenimiento y tus procedimientos de Operación, Seguridad y Mantenimiento.
          </p>
          <p class="text-justify" style="font-size: 1.1em">
           Recuerda que el programa anual de mantenimiento debe de empatar con los registros de la bitácora de mantenimiento preventivo y correctivo. 
          </p>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en el botón de ver procedimientos para visualizar y descargar los procedimientos de Operación, Seguridad y Mantenimiento.</li>
            <li>Mediante el tablón de noticias de la estación invita a todos los involucrados a consultar los procedimientos.</li>    
            <li>Da clic en el botón de programa para poder visualizar tu Programa de Mantenimiento.</li>   
            <li>Las fechas de las actividades del programa deben de empatar con las fechas de las bitácoras de mantenimiento preventivo y correctivo.</li>   
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">
          Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> y <label class="text-danger font-weight-bold">Jefes de Piso</label>, <label class="text-danger font-weight-bold">Departamento de Mantenimiento</label> o en su caso prestadores de servicio llenar y firmar los checklist de las verificaciones de las bitácoras.</p>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
