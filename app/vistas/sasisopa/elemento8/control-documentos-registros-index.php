<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'8-control-documentos-registros');
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
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link rel="stylesheet" href="<?=RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
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
   window.location.href = "<?=SERVIDOR;?>";
  }

  function btnAyuda(){
  $('#ModalControlDocumentos').modal('show');
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
   $('#ModalControlDocumentos').modal('hide');
   }
   });

  }else{
  $('#ModalControlDocumentos').modal('hide');
  }
}

function btnControlDocumentosRL(){
    window.location.href = "control-documentos-rl";  
  }

  function btnControlDocumentos(){
    window.location.href = "control-documentos-sa";
  } 

   </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <!-- Inicio -->
  <div class="float-end">
  <div class="dropdown dropdown-sm d-inline ms-2">
  <button type="button" class="btn dropdown-toggle btn-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fa-solid fa-screwdriver-wrench"></i></span>
  </button>
  <ul class="dropdown-menu">
  <li onclick="btnAyuda()"><a class="dropdown-item c-pointer"> <i class="fa-regular fa-circle-question"></i> Ayuda</a></li>
  </ul>
  </div>
  </div>
  <!-- Fin -->

  <!-- Inicio -->
  <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
  <ol class="breadcrumb breadcrumb-caret">
  <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SASISOPA</li>
  <li aria-current="page" class="breadcrumb-item active">8. CONTROL DE DOCUMENTOS Y REGISTROS</li>
  </ol>
  </div>
  <!-- Fin -->

  <h3>8. CONTROL DE DOCUMENTOS Y REGISTROS</h3>

  <div class="row mt-3">      
  <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mb-3">     
    <div class="card border-0 rounded-0">
    <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Control y documentos de Requisitos Legales
    </div>
    <div class="text-right mt-4"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnControlDocumentosRL()" >Ver requisitos legales</button></div>
    </div>
    </div>
    </div>
    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mb-3"> 
    <div class="card border-0 rounded-0">
    <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Control y documentos del Sistema de Administración</div>
    <div class="text-right mt-4"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnControlDocumentos()" >Ver control y documentos</button></div>
  </div>  
  </div>
  </div>
  </div>    
  </div>

    <div class="modal fade bd-example-modal-lg" id="ModalControlDocumentos" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Bienvenido al elemento 8. CONTROL DE DOCUMENTOS Y REGISTROS, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            Aquí vas a poder visualizar los documentos y registros del Sistema de Administración.
          </p>
          <p class="text-justify" style="font-size: 1.1em">
            La política debe ser comunicada a todo el personal incluyendo clientes, prestadores de servicios y proveedores.
          </p>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en recuadro Control de requisitos legales para consultar los permisos de tu estación de servicio </li>
            <li>Da clic en el recuadro Control de documentos del Sistemas de Administración para consultar y descargar los formatos de registro del SA (Esto es únicamente de manera informativa ya que los registros se llenan con ayuda del sistema)</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> conocer y realizar los registros correspondientes de cada elemento del SA.</p>

          <small>Nota:<br>
          Portal AdmonGas es una herramienta que te ayuda a realizar los registros requeridos por el SA, es decir simplifica el llenado de los formatos.
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
