<?php
require('app/help.php');

$sql_sasisopa_ayuda = "SELECT * FROM pu_sasisopa_ayuda WHERE id_usuario = '".$Session_IDUsuarioBD."' and detalle = '11-integridad-mecanica-aseguramiento' and estado = 0 LIMIT 1";
$result_sasisopa_ayuda = mysqli_query($con, $sql_sasisopa_ayuda);
$numero_sasisopa_ayuda = mysqli_num_rows($result_sasisopa_ayuda);

if ($numero_sasisopa_ayuda == 1) {
while($row_ayuda = mysqli_fetch_array($result_sasisopa_ayuda, MYSQLI_ASSOC)){
$idAyuda = $row_ayuda['id'];
}
}else{
$idAyuda = 0;
}
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

  CargarListaEquipo();
  });
  function regresarP(){
   window.location.href = "<?=SERVIDOR;?>";
  }
  function btnBitacora(){
    window.location.href = "bitacoras-caracteristicas";
  }

 function btnProgramaAnual(){
  window.location.href = "programa-anual-mantenimiento";  
  }

  function btnAyuda(){
  $('#ModalAyuda').modal('show');
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
   $('#ModalAyuda').modal('hide');
   }
   });

  }else{
  $('#ModalAyuda').modal('hide');
  }
}

function CargarListaEquipo(){

  var idEstacion = <?=$Session_IDEstacion;?>;

  var parametros = {
  "idEstacion" : idEstacion
  };

  $.ajax({
  data:  parametros,
  url:   'public/sasisopa/vistas/lista-equipo-critico.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {
   $('#ConteListaEquipo').html(response);

  }
  });
}

function BtnEquipoCritico(){
$('#ModalEquipoCritico').modal('show');
}

function btnGuardar(){
var idEstacion = <?=$Session_IDEstacion;?>;
var NombreEquipo = $('#NombreEquipo').val();
var MarcaModelo = $('#MarcaModelo').val();
var Funcion = $('#Funcion').val();
var FechaInstalacion = $('#FechaInstalacion').val();
var TiempoVida = $('#TiempoVida').val();

var ManualPDF = document.getElementById("ManualPDF");
var ManualPDF_file = ManualPDF.files[0];
var ManualPDF_filePath = ManualPDF.value;

var data = new FormData();
var url = 'public/sasisopa/agregar/agregar-equipo-critico.php';
var ext = $("#ManualPDF").val().split('.').pop();

if (NombreEquipo != "") {
$('#NombreEquipo').css('border',''); 
if (MarcaModelo != "") {
$('#MarcaModelo').css('border',''); 
if (Funcion != "") {
$('#Funcion').css('border',''); 
if (FechaInstalacion != "") {
$('#FechaInstalacion').css('border',''); 
if (TiempoVida != "") {
$('#TiempoVida').css('border',''); 
if (ext == "PDF" || ext == "pdf") {
$('#Resultado').html('');
$('#ManualPDF').css('border','');  

  data.append('idEstacion', idEstacion);
  data.append('NombreEquipo', NombreEquipo);
  data.append('MarcaModelo', MarcaModelo);
  data.append('Funcion', Funcion);
  data.append('FechaInstalacion', FechaInstalacion);
  data.append('TiempoVida', TiempoVida);
  data.append('ManualPDF_file', ManualPDF_file);

$.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

  CargarListaEquipo();
  alertify.success('Se agregó correctamente la información');
  $('#ModalEquipoCritico').modal('hide');

  });

}else{
$('#Resultado').html('<small class="text-danger">Solo se aceptan formato PDF</small>');
$('#ManualPDF').css('border','2px solid #A52525');    
}
}else{
$('#TiempoVida').css('border','2px solid #A52525');  
}
}else{
$('#FechaInstalacion').css('border','2px solid #A52525');  
}
}else{
$('#Funcion').css('border','2px solid #A52525');  
}
}else{
$('#MarcaModelo').css('border','2px solid #A52525');  
}
}else{
$('#NombreEquipo').css('border','2px solid #A52525');  
}

}

function BTNEliminar(id){
$('#ModalEliminarBaja').modal('show');

$('#IdEquipoCritico').val(id);
}

function BTNBaja(){
var IdEquipo = $('#IdEquipoCritico').val();

 var parametros = {
  "IdEquipo" : IdEquipo
  };

  $.ajax({
  data:  parametros,
  url:   'public/sasisopa/actualizar/actualizar-baja.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {
  CargarListaEquipo();
  alertify.success('Se agregó correctamente la información');
  $('#ModalEliminarBaja').modal('hide');

  }
  });

}
function BTNEliminir(){
var IdEquipo = $('#IdEquipoCritico').val();

 var parametros = {
  "IdEquipo" : IdEquipo
  };

  $.ajax({
  data:  parametros,
  url:   'public/sasisopa/actualizar/actualizar-eliminar.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {
  CargarListaEquipo();
  alertify.success('Se agregó correctamente la información');
  $('#ModalEliminarBaja').modal('hide');

  }
  });

}

function BtnDescargar(){
window.location = "equipos-criticos";  
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
      <h4>11. INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD</h4>
    </div>

    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
    </div>
  

<div class="card-body">

  <div class="row">
  
   <!-- CARD - PROG. ANUAL MTTO -->
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2"> 
    <div class="card" style="border-radius: 0px;">
  <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Programa anual de mantenimiento
    </div>
    <div class="text-right" style="margin-top: 10px;">
      <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnProgramaAnual()" >Ver programa</button></div>
      </div>
  </div>
</div>
   </div>
   

   <!-- CARD - PROC. OPERACION, SEGURIDAD Y MTTO -->
   <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2"> 
   <div class="card" style="border-radius: 0px;">
  <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Procedimientos de Operación, Seguridad y Mantenimiento</div>
   <div class="text-right" style="margin-top: 10px;">
      <a target="_blabk" href="archivos/procedimientos/DLES.ADMONGAS.001.pdf" class="btn btn-primary btn-sm" style="border-radius: 0px;">Ver procedimientos</a></div>
  </div>
  
</div>
</div>


   <!-- CARD - BITACORAS -->
   <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2">
   <div class="card" style="border-radius: 0px;">
  <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Bitácoras</div>
    <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnBitacora()" >Ver detalle</button></div>
  </div>
  
</div>
</div>



<!-- CARD - EQUIPOS CRITICOS -->
  
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-10 mt-2 mb-2">
  <div class="card" style="border-radius: 0px;">
  <div class="card-body">
    
    <div class="row">
    
    <div class="text-info col-10" style="font-size: 1.3em;">
    Lista de equipos críticos
    </div>

    <div class="col-2 mt-2">
     <a class="float-right" onclick="BtnEquipoCritico()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar equipo critico" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
      </a>

      <a class="float-right mr-2" onclick="BtnDescargar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar equipo critico" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
      </a>

    </div>

    </div>
    <hr>

  <div id="ConteListaEquipo"></div>
  </div>
  
</div>


</div>

</div>

<div id="ConteListaEquipo"></div>

</div>

    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalAyuda" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 11. INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
          En este apartado podrás consultar el programa anual de mantenimiento, los procedimientos de operación, seguridad y mantenimiento y las características de las bitácoras conforme a la NOM-005-ASEA-2016 así como también deveras de hacer el registro de los equipos críticos con los que cuentes en la estación de servicio.
          </p>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en recuadro Programa anual de mantenimiento para visualizar</li>
            <li>Da clic en el recuadro Procedimientos de operación, seguridad y mantenimiento para visualizar </li>
            <li>Da clic en el recuadro de bitácoras para consultar las características </li>
            <li>Da clic en el botón agregar para crear el listado de equipos críticos  </li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> y <label class="text-danger font-weight-bold">Departamento de mantenimiento </label> (En caso de contar con el), el mantenimiento adecuado y el registro de los equipos críticos con los que cuenta la estación de servicio </p>

          <small>Nota:<br>
          Recuerda que un equipo critico hace referencia a aquellos que son capaces de generar una explosión o daño al personal por el mal funcionamiento, pero también se pueden definir como aquellos que son indispensables para el correcto funcionamiento de la estación de servicio y si fallan representan perdidas notables en las ventas
          </small>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>


  <div class="modal fade bd-example-modal-lg" id="ModalEquipoCritico" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Agregar equipo critico</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

         <div class="row">
          <div class="col-12 col-md-6">
          <div class="mb-2"><small class="text-secondary">* NOMBRE:</small></div>
          <input class="form-control input-style rounded-0" type="text" id="NombreEquipo">        
          </div>
          <div class="col-12 col-md-6">
          <div class="mb-2"><small class="text-secondary">* MARCA Y MODELO:</small></div>
          <input class="form-control input-style rounded-0" type="text" id="MarcaModelo">        
          </div>
         </div>

         <div class="mb-2 mt-2"><small class="text-secondary">* FUNCION:</small></div>
         <textarea class="form-control rounded-0" id="Funcion"></textarea>

          <div class="row mt-2">
          <div class="col-12 col-md-6">
          <div class="mb-2"><small class="text-secondary">* FECHA INSTALACION <small>(Aproximado)</small>:</small></div>
          <input class="form-control input-style rounded-0" type="date" id="FechaInstalacion">        
          </div>
          <div class="col-12 col-md-6">
          <div class="mb-2"><small class="text-secondary">* TIEMPO DE VIDA <small>(Años)</small>:</small></div>
          <input class="form-control input-style rounded-0" type="number" min="1" id="TiempoVida">        
          </div>
         </div>

         <div class="mb-2 mt-2"><small class="text-secondary">* MANUAL PDF:</small></div>
         <input type="file" id="ManualPDF">
         <div id="Resultado"></div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnGuardar()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade" id="ModalEliminarBaja" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Eliminar o Baja</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        
        <input type="hidden" name="" id="IdEquipoCritico">

        <button type="button btn-block" class="btn btn-primary mt-2 rounded-0" style="width: 100%;" onclick="BTNBaja()">Dar de baja equipo critico</button>
        <button type="button btn-block" class="btn btn-warning mt-2 rounded-0" style="width: 100%;" onclick="BTNEliminir()">Eliminar equipo critico</button>
        
        </div>
      </div>
    </div>
    </div>

    
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
