<?php
require('app/help.php');
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
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>bootstrap-select.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <script type="text/javascript" src="<?php echo RUTA_JS ?>signature_pad.js"></script>
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

  DatosPersonales(<?=$GET_idUsuario;?>);
  DatosFamiliares(<?=$GET_idUsuario;?>);
  FormacionAcademica(<?=$GET_idUsuario;?>);
  ExperienciaLaboral(<?=$GET_idUsuario;?>);
  EsperienciaEmpresa(<?=$GET_idUsuario;?>);
  FirmaUsuario(<?=$GET_idUsuario;?>);

  });
  function regresarP(){
   window.history.back();
  }
  
  function DatosPersonales(id_usuario){
  $('#DivDatosPersonales').load('../app/vistas/sasisopa/elemento6/datos-personales.php?idUsuario=' + id_usuario);
  }

  function nombres(idUsuario){
  $('#Nombres').css('border','0px');
  var Nombres = $('#Nombres').val();

  var parametros = {
    "accion" : "editar-nombre",
    "idUsuario" : idUsuario,
     "Nombres" : Nombres
    };

  if (Nombres != "") {

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {

     }
     });
  }else{$('#Nombres').css('border','2px solid #A52525'); }
    
}

function domicilio(idUsuario){
  $('#DireccionCompleta').css('border','0px');
  var DireccionCompleta = $('#DireccionCompleta').val();

  var parametros = {
    "accion" : "editar-domicilio",
    "idUsuario" : idUsuario,
     "DireccionCompleta" : DireccionCompleta
    };

  if (DireccionCompleta != "") {

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {
     }
     });
  }else{$('#DireccionCompleta').css('border','2px solid #A52525'); }
}

function fechan(idUsuario){
  $('#FechaNac').css('border','0px');
  var FechaNac = $('#FechaNac').val();

  var parametros = {
    "accion" : "editar-fecha-nacimiento",
    "idUsuario" : idUsuario,
     "FechaNac" : FechaNac
    };

  if (FechaNac != "") {

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {
     }
     });
  }else{$('#FechaNac').css('border','2px solid #A52525'); }
}

function estadocivil(idUsuario){
  $('#EstadoCivil').css('border','0px');
  var EstadoCivil = $('#EstadoCivil').val();

  var parametros = {
    "accion" : "editar-estado-civil",
    "idUsuario" : idUsuario,
     "EstadoCivil" : EstadoCivil
    };

  if (EstadoCivil != "") {

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {
     }
     });
  }else{$('#EstadoCivil').css('border','2px solid #A52525'); }
}

function segurosocial(idUsuario){
  $('#NumeroSSocial').css('border','0px');
  var NumeroSSocial = $('#NumeroSSocial').val();

  var parametros = {
    "accion" : "editar-seguro-social",
    "idUsuario" : idUsuario,
     "NumeroSSocial" : NumeroSSocial
    };

  if (NumeroSSocial != "") {

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {
     }
     });
  }else{$('#NumeroSSocial').css('border','2px solid #A52525'); }
}

function telefono(idUsuario){
  $('#PerfilTelefono').css('border','0px');
  var Telefono = $('#PerfilTelefono').val();

  var parametros = {
    "accion" : "editar-telefono",
    "idUsuario" : idUsuario,
     "Telefono" : Telefono
    };

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {
     }
     });

}

function email(idUsuario){
  $('#Email').css('border','0px');
  var Email = $('#Email').val();

  var parametros = {
    "accion" : "editar-email",
    "idUsuario" : idUsuario,
     "Email" : Email
    };


    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {

     }
     });
}

 function DatosFamiliares(id_usuario){
  $('#DivDatosFamiliares').load('../app/vistas/sasisopa/elemento6/datos-familiares.php?idUsuario=' + id_usuario);
  }
  function AgregarDatos(){
  $('#ModalAgregarDatosF').modal('show');
  }

  function BtnADF(id_usuario){
$('#NomFamiliar').css('border','');
var NomFamiliar = $('#NomFamiliar').val();

$('#Parentesco').css('border','');
var Parentesco = $('#Parentesco').val();

$('#Direccion').css('border','');
var Direccion = $('#Direccion').val();

$('#Telefono').css('border','');
var Telefono = $('#Telefono').val();

if (NomFamiliar != "") {
if (Parentesco != "") {
if (Direccion != "") {
if (Telefono != "") {

  var parametros = {
    "accion" : "agregar-datos-familiares",
    "idUsuario" : id_usuario,
     "NomFamiliar" : NomFamiliar,
     "Parentesco" : Parentesco,
     "Direccion" : Direccion,
     "Telefono" : Telefono
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
    $('#Result').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
     },
     complete: function(){
    $('#Result').html("");
     },
     success:  function (response) {
      $('#ModalAgregarDatosF').modal('hide');
     DatosFamiliares(id_usuario)
     alertify.message('Se almaceno correctamente la información');
     }
     });

  },
  function(){
  }).setHeader('Agregar Datos Familiares').set({transition:'zoom',message: '¿Desea agregar la nueva información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{ $('#Telefono').css('border','2px solid #A52525'); }
}else{ $('#Direccion').css('border','2px solid #A52525'); }
}else{ $('#Parentesco').css('border','2px solid #A52525'); }
}else{ $('#NomFamiliar').css('border','2px solid #A52525'); }

}

function EliminarDP(id,id_usuario){
  var parametros = {
    "accion" : "eliminar-datos-familiares",
    "id" : id
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
      DatosFamiliares(id_usuario)
     alertify.message('Se elimino correctamente la información');
     }
     });

  },
  function(){
  }).setHeader('Eliminar').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function FormacionAcademica(id_usuario){
  $('#DivFormacionAcademica').load('../app/vistas/sasisopa/elemento6/formacion-academica.php?idUsuario=' + id_usuario);
  }
  
  function ModalFA(){
  $('#ModalFA').modal('show');
  }

  function BtnAFA(id_usuario){
$('#NivelAcademico').css('border','');
$('#Institucion').css('border','');
var NivelAcademico = $('#NivelAcademico').val();
var Institucion = $('#Institucion').val();

if (NivelAcademico != "") {
if (Institucion != "") {

  var parametros = {
    "accion" : "agregar-formacion-academica",
    "idUsuario" : id_usuario,
     "NivelAcademico" : NivelAcademico,
     "Institucion" : Institucion
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    $('#Result').html("");
     },
     success:  function (response) {
     $('#ModalFA').modal('hide');
     FormacionAcademica(id_usuario)
     alertify.message('Se almaceno correctamente la información');
     }
     });

  },
  function(){
  }).setHeader('Agregar Formación académica').set({transition:'zoom',message: '¿Desea agregar la nueva información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{ $('#Institucion').css('border','2px solid #A52525'); }
}else{ $('#NivelAcademico').css('border','2px solid #A52525'); }

}

function EliminarFA(id,id_usuario){

var parametros = {
  "accion" : "eliminar-formacion-academica",
  "id" : id
  };

alertify.confirm('',
function(){

  $.ajax({
   data:  parametros,
   url:   '../app/controlador/PersonalControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
    FormacionAcademica(id_usuario)
   alertify.message('Se elimino correctamente la información');
   }
   });

},
function(){
}).setHeader('Eliminar Formación académica').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function ExperienciaLaboral(id_usuario){
$('#DivEsperenciaLaboral').load('../app/vistas/sasisopa/elemento6/experiencia-laboral.php?idUsuario=' + id_usuario);
}

function ModalEL(){
$('#ModalEL').modal('show');
}

function BtnAEL(id_usuario){
$('#Empresadetalle').css('border','');
var Empresadetalle = $('#Empresadetalle').val();

if (Empresadetalle != "") {
 
  var parametros = {
    "accion" : "agregar-experiencia-laboral",
    "idUsuario" : id_usuario,
     "Empresadetalle" : Empresadetalle
    };
 
    alertify.confirm('',
    function(){

      $.ajax({
       data:  parametros,
       url:   '../app/controlador/PersonalControlador.php',
       type:  'post',
       beforeSend: function() {
      $('#Result').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
       },
       complete: function(){
      $('#Result').html("");
       },
       success:  function (response) {
       $('#ModalEL').modal('hide');
       ExperienciaLaboral(id_usuario)
       $('#Empresadetalle').val("");
       alertify.message('Se almaceno correctamente la información');

       }
       });

    },
    function(){
    }).setHeader('Agregar Experiencia Laboral').set({transition:'zoom',message: '¿Desea agregar la nueva información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{ $('#Empresadetalle').css('border','2px solid #A52525'); }

}

function EliminarEL(id,id_usuario){

var parametros = {
  "accion" : "eliminar-experiencia-laboral",
  "id" : id
  };

alertify.confirm('',
function(){

  $.ajax({
   data:  parametros,
   url:   '../app/controlador/PersonalControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
    ExperienciaLaboral(id_usuario)
   alertify.message('Se elimino correctamente la información');
   }
   });

},
function(){
}).setHeader('Eliminar Experiencia Laboral').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function EsperienciaEmpresa(id_usuario){
  $('#DivEsperenciaEmpresa').load('../app/vistas/sasisopa/elemento6/experiencia-empresa.php?idUsuario=' + id_usuario);
  }

  function mayus(e) {
 e.value = e.value.toUpperCase();
 }
function ModalEE(){
$('#ModalEE').modal('show');
}

function BtnEE(id_usuario){

$('#RazonSocial').css('border','');
var RazonSocial = $('#RazonSocial').val();

$('#Puesto').css('border','');
var Puesto = $('#Puesto').val();

$('#FechaInicio').css('border','');
var FechaInicio = $('#FechaInicio').val();

$('#FechaFin').css('border','');
var FechaFin = $('#FechaFin').val();

if (RazonSocial != "") {
if (Puesto != "") {
if (FechaInicio != "") {

var parametros = {
  "accion" : "agregar-experiencia-empresa",
  "idUsuario" : id_usuario,
   "RazonSocial" : RazonSocial,
   "Puesto" : Puesto,
   "FechaInicio" : FechaInicio,
   "FechaFin" : FechaFin
  };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
    $('#Result').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
     },
     complete: function(){
    $('#Result').html("");
     },
     success:  function (response) {
     $('#ModalEE').modal('hide');
     EsperienciaEmpresa(id_usuario)
     alertify.message('Se almaceno correctamente la información');
     }
     });

  },
  function(){
  }).setHeader('Agregar Experiencia laboral en la empresa').set({transition:'zoom',message: '¿Desea agregar la nueva información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{$('#FechaInicio').css('border','2px solid #A52525'); }
}else{$('#Puesto').css('border','2px solid #A52525'); }
}else{$('#RazonSocial').css('border','2px solid #A52525'); }

}

function EliminarEE(id,id_usuario){
  var parametros = {
    "accion" : "eliminar-experiencia-empresa",
    "id" : id
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/PersonalControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
      EsperienciaEmpresa(id_usuario)
     alertify.message('Se elimino correctamente la información');
     }
     });

  },
  function(){
  }).setHeader('Eliminar').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function ModalEditarEE(idUsuario,id){
$('#ModalEditarEE').modal('show');
$('#ContenidoModal').load('../app/vistas/sasisopa/elemento6/modal-experiencia-empresa-editar.php?id=' + id + '&idUsuario=' + idUsuario);
}

function BtnEditarEE(idUsuario,id){

var RazonSocial = $('#EditRazonSocial').val();
var Puesto = $('#EditPuesto').val();
var FechaInicio = $('#EditFechaInicio').val();
var FechaFin = $('#EditFechaFin').val();

var parametros = {
    "accion" : "editar-experiencia-empresa",
    "idUsuario" : idUsuario,
    "id" : id,
     "RazonSocial" : RazonSocial,
     "Puesto" : Puesto,
     "FechaInicio" : FechaInicio,
     "FechaFin" : FechaFin
    };

    alertify.confirm('',
    function(){

      $.ajax({
       data:  parametros,
       url:   '../app/controlador/PersonalControlador.php',
       type:  'post',
       beforeSend: function() {
       },
       complete: function(){
      $('#Result').html("");
       },
       success:  function (response) {
       $('#ModalEditarEE').modal('hide');
       EsperienciaEmpresa(idUsuario)
       alertify.message('Se almaceno correctamente la información');
       }
       });

    },
    function(){
    }).setHeader('Editar Experiencia laboral en la empresa').set({transition:'zoom',message: '¿Desea editar la información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function FirmaUsuario(){
   $('#FirmaUsuario').load('../app/vistas/sasisopa/elemento6/firma-personal.php?idUsuario=<?=$GET_idUsuario;?>'); 
  }

  function Guardar(idUsuario){

var ctx = document.getElementById("canvas");
var image = ctx.toDataURL();
document.getElementById('base64').value = image;

var base64 = $('#base64').val();

var data = new FormData();
var url = '../app/controlador/PersonalControlador.php';

data.append('accion','editar-firma-personal');
data.append('idUsuario', idUsuario);
data.append('base64', base64);

if(signaturePad.isEmpty()){
$('#canvas').css('border','2px solid #A52525'); 
}else{
$('#canvas').css('border','1px solid #000000'); 

$(".LoaderPage").show();

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

  if(data){
  $(".LoaderPage").hide();
  resizeCanvas()
  FirmaUsuario()

  }else{
  $(".LoaderPage").hide();
  alertify.error('Error al editar la firma'); 
  }
   

  }); 

}

}

  function FichaPersonal(idUsuario){
    window.location = "../descargar-ficha-personal/" + idUsuario;  
  }
  </script>
  </head>
  <body>
    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
    <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
    </div>    
    <div class="float-left">
    <h4>FICHA DEL PERSONAL</h4>
    </div>
    <div class="float-right">
    <div style="margin-top: 10px;"><a onclick="FichaPersonal(<?=$GET_idUsuario;?>)"><img src="<?=RUTA_IMG_ICONOS;?>archivo.png"></a></div>
    </div>

    <div class="bg-white mt-5 p-3">

    <div id="DivDatosPersonales"></div>
    <div id="DivDatosFamiliares"></div>
    <div id="DivFormacionAcademica"></div>
    <div id="DivEsperenciaLaboral"></div>
    <div id="DivEsperenciaEmpresa"></div>

    <div class="row mt-3">
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">  
        <div class="border p-3">
          <div class="mb-2 text-secondary text-center">Agregar firma</div>
          <div id="signature-pad" class="signature-pad mt-2" >
          <div class="signature-pad--body text-center">
          <canvas style="width: 300px; height: 130px; border: 1px black solid;" id="canvas"></canvas>
          </div>
          <input type="hidden" name="base64" value="" id="base64">
          </div> 
          <div class="text-center mt-2">
          <button type="button" class="btn btn-danger btn-sm" onclick="resizeCanvas()">Limpiar</button>
          <button type="button" class="btn btn-primary btn-sm" onclick="Guardar(<?=$GET_idUsuario;?>)">Guardar</button>
          </div>
          <hr>
          <div id="FirmaUsuario"></div>
          </div>        
        </div>
      </div>

    </div>

    </div>

    <div class="modal fade" id="ModalAgregarDatosF" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div class="modal-header">
        <h5 class="modal-title">Datos de familiares</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Nombre de mi familiar:</label>
      <input id="NomFamiliar" type="text" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar nombre">
      </div>
      <div class="form-group">
       <label class="text-secondary" style="font-size: .9em;">Parentesco:</label>
       <select id="Parentesco" class="form-control" style="border-radius: 0px;font-size: 1em;">
         <option value="">Seleccionar parentesco</option>
         <option value="Padre">Padre</option>
         <option value="Madre">Madre</option>
         <option value="Conyugue">Conyugue</option>
         <option value="Hijo">Hijo</option>
         <option value="Otro">Otro</option>
       </select>
     </div>
      <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Dirección completa:</label>
      <input id="Direccion" type="text" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar dirección">
      </div>
      <div class="form-group">
        <label class="text-secondary" style="font-size: .9em;">Teléfono:</label>
      <input id="Telefono" type="text" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar teléfono">
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;border: 0px;" onclick="BtnADF(<?=$GET_idUsuario;?>)">Agregar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalFA" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div class="modal-header">
        <h5 class="modal-title">Formación académica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Nivel:</label>
      <select id="NivelAcademico" class="form-control" style="border-radius: 0px;font-size: 1.2em;">
        <option value="">Nivel</option>
        <option value="Primaria">Primaria</option>
        <option value="Secundaria">Secundaria</option>
        <option value="Bachillerato">Bachillerato</option>
        <option value="Licenciatura">Licenciatura</option>
      </select>
      </div>
      <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Institución:</label>
      <textarea id="Institucion" class="form-control" style="border-radius: 0px;font-size: 1.2em;" placeholder="Nombre de la institución"></textarea>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;border: 0px;" onclick="BtnAFA(<?=$GET_idUsuario;?>)">Agregar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalEL" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div class="modal-header">
        <h5 class="modal-title">Experiencia laboral</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Empresa:</label>
      <textarea id="Empresadetalle" class="form-control" style="border-radius: 0px;font-size: 1.2em;" placeholder="Nombre de la empresa"></textarea>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;border: 0px;" onclick="BtnAEL(<?=$GET_idUsuario;?>)">Agregar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalEE" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div class="modal-header">
        <h5 class="modal-title">Experiencia laboral</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
        <label class="text-secondary" style="font-size: .9em;">Razón social:</label>
        <input id="RazonSocial" type="text" class="form-control" name="" onkeyup="mayus(this)" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar Razón social">
        </div>

        <div class="form-group">
        <label class="text-secondary" style="font-size: .9em;">Puesto:</label>
        <input id="Puesto" type="text" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar Puesto">
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group">
            <label class="text-secondary" style="font-size: .9em;">Fecha de inicio</label>
            <input id="FechaInicio" type="date" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" >
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
            <label class="text-secondary" style="font-size: .9em;">Fecha de fin:</label>
            <input id="FechaFin" type="date" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" >
            </div>
          </div>
        </div>
        <div id="Result"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;border: 0px;" onclick="BtnEE(<?=$GET_idUsuario;?>)">Agregar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalEditarEE" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div id="ContenidoModal"></div>
    </div>
  </div>
</div>

<script type="text/javascript">

var wrapper = document.getElementById("signature-pad");

var canvas = wrapper.querySelector("canvas");
var signaturePad = new SignaturePad(canvas, {
  backgroundColor: 'rgb(255, 255, 255)'
});

function resizeCanvas() {

  var ratio =  Math.max(window.devicePixelRatio || 1, 1);

  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);

  signaturePad.clear();
}

window.onresize = resizeCanvas;
resizeCanvas();



 
</script>
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
