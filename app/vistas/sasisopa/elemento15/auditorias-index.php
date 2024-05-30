<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'15-auditorias');
$id_ayuda = $array_ayuda['id'];
$estado = $array_ayuda['estado'];


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
  $('#ModalAuditoria').modal('show');
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
   $('#ModalAuditoria').modal('hide');
   }
   });

  }else{
  $('#ModalAuditoria').modal('hide');
  }

}
//--------------------------------------------------------------

function BTNPrograma(){
window.location.href = 'programa-auditorias-internas-externas'; 
}

//--------------------------------------------------------------

function BTNAuditoriaI(){
window.location.href = 'auditoria-interna'; 
}

//---------------------------------------------------------------

function BTNAuditoriaE(){
window.location.href = 'auditoria-externa';   
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
      <h4>15. AUDITORÍAS</h4>
    </div>


    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
      </div>
    <div class="card-body">

  <div class="row">

  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2 "> 

  <div class="card" style="border-radius: 0px;">
  <div class="card-body" style="font-size: 1.3em;">
  <div class="text-secondary">Formato Programa de auditorias (Internas y externas) 
  </div>
  <div class="text-right" style="margin-top: 10px;">
  <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="BTNPrograma()" >Ver programa de auditorias</button></div>
  </div>
  </div>
  </div>
  </div>

  
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2 "> 
  <div class="card" style="border-radius: 0px;">
  <div class="card-body" style="font-size: 1.3em;">
  <div class="text-secondary">Auditoria interna 
  </div>
  <div class="text-right" style="margin-top: 10px;">
  <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="BTNAuditoriaI()" >Ver auditoria interna </button></div>
  </div>
  </div>
  </div>
  </div>
  
  
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2 "> 
  <div class="card" style="border-radius: 0px;">
  <div class="card-body" style="font-size: 1.3em;">
  <div class="text-secondary">Auditoria externa</div>
  <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="BTNAuditoriaE()" >Ver auditoria externa</button></div>
  </div>  
  </div>
  </div>

 </div>

    </div>
    </div>
    </div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="ModalAuditoria" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 15. AUDITORÍAS, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            En este apartado podrás consultar el programa de auditorias internas y externas así como también las competencias que deben de tener los auditores.</b>.
          </p>

          <hr>
 
          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en recuadro programa anual de auditorias <small>(Aquí podrás verificar y planear las auditorias internas y externas para el seguimiento del Sistema de Administración)</small></li>
            <li>Da clic en el recuadro Auditoria interna para hacer el registro de las auditorias realizadas por internos de la empresa.</li>
            <li>Da clic en el recuadro Auditoria externa para realizar el registro de las auditorias realizadas por el tercer autorizado ante la ASEA <small>(Recuerda que esta auditoria debe ser de manera bianual)</small>.</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> y en su caso departamento de <label class="text-danger font-weight-bold">Gestión</label>, coordinar las auditorias externas con un tercer acreditado ante la <b>ASEA</b>, es responsabilidad del Gerente Técnico del envió del Informe de auditoria y plan de atención de hallazgos a la ASEA.</p>

          <small>
          Nota: 
          El auditor interno deberá ser designado por la alta dirección o por quien corresponda, mismo que deberá conocer a profundidad la operación de la estación, así como también el Sistema de Administración que se esta implementando.
          </small>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
