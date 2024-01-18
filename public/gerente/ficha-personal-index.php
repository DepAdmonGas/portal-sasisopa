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
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
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

  DatosPersonales();
  DatosFamiliares();
  FormacionAcademica();
  EsperienciaLaboral();
  EsperienciaEmpresa();

  FirmaUsuario();
  });

  
  function DatosPersonales(){
  $('#DivDatosPersonales').load('../public/gerente/vistas/datos-personales.php?idUsuario=<?=$GET_idUsuario;?>');
  }
  function DatosFamiliares(){
  $('#DivDatosFamiliares').load('../public/gerente/vistas/datos-familiares.php?idUsuario=<?=$GET_idUsuario;?>');
  }
  function FormacionAcademica(){
  $('#DivFormacionAcademica').load('../public/gerente/vistas/formacion-academica.php?idUsuario=<?=$GET_idUsuario;?>');
  }
  
  function EsperienciaLaboral(){
  $('#DivEsperenciaLaboral').load('../public/gerente/vistas/esperiencia-laboral.php?idUsuario=<?=$GET_idUsuario;?>');
  }
  function EsperienciaEmpresa(){
  $('#DivEsperenciaEmpresa').load('../public/gerente/vistas/esperiencia-empresa.php?idUsuario=<?=$GET_idUsuario;?>');
  }

  function FirmaUsuario(){
   $('#FirmaUsuario').load('../public/gerente/vistas/firma-personal.php?idUsuario=<?=$GET_idUsuario;?>'); 
  }

  function regresarP(){
   window.history.back();
  }

  function FichaPersonal(idUsuario){
  window.location = "../descargar-ficha-personal/" + idUsuario;  
  }

  function Guardar(idUsuario){

  var ctx = document.getElementById("canvas");
  var image = ctx.toDataURL();
  document.getElementById('base64').value = image;

  var base64 = $('#base64').val();

  var data = new FormData();
  var url = '../public/gerente/editar/editar-firma-personal.php';

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

    if(data == 1){
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
    
    <div class="float-left">
      <h4>FICHA DEL PERSONAL</h4>
    </div>

    <div class="float-right">
    <div style="margin-top: 10px;"><a onclick="FichaPersonal(<?=$GET_idUsuario;?>)"><img src="<?=RUTA_IMG_ICONOS;?>archivo.png"></a></div>
    </div>

    </div>
    <div class="card-body">
 
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
