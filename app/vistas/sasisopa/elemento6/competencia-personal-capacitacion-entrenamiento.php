<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'competencia-personal-capacitacion-entrenamiento');
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
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">
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
    window.history.back();
  }

  function btnAyuda(){
  $('#myModalPolitica').modal('show');
  }

  function btnEditar(){
   $('#myModalEditarPolitica').modal('show');
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

function btnPerfilesPuesto(){
window.location.href = "perfiles-puestos-trabajo";
}
function btnPerfilesPersonal(){
window.location.href = "perfiles-personal";
}
function btnCInterna(){
window.location.href = "capacitacion-interna";  
}
function btnCExterna(){
window.location.href = "capacitacion-externa";  
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
      <li aria-current="page" class="breadcrumb-item active">6. COMPETENCIA DEL PERSONAL, CAPACITACIÓN Y ENTRENAMIENTO</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>6. COMPETENCIA DEL PERSONAL, CAPACITACIÓN Y ENTRENAMIENTO</h3>

    <div class="row mt-3">
    <!-- CARD - PERFILES DE PUESTO -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-2 mb-2 ">
    
    <div class="card border-0 rounded-0">
      
      <div class="card-body" style="font-size: 1.3em;">
      <div class="text-secondary">
      Perfiles de puesto de trabajo.
      </div>
        
        <div class="text-right" style="margin-top: 10px;">
          <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnPerfilesPuesto()" >Ver detalle</button></div>
          </div>
      </div>
    
    </div>
    </div>
    
      
    <!-- CARD - PERFILE DEL PERSONAL -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-2 mb-2 "> 
        <div class="card border-0 rounded-0">
      <div class="card-body" style="font-size: 1.3em;">
        <div class="text-secondary">Perfil del personal.</div>
        <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnPerfilesPersonal()" >Ver detalle</button></div>
      </div>
      
    </div>
    </div>
    
    
    <!-- CARD - CAPACITACION INTERNA -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-2 mb-2 "> 
      <div class="card border-0 rounded-0">
      <div class="card-body" style="font-size: 1.3em;">
      <div class="text-secondary">
      Programa de capacitación interna
      </div>
        <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnCInterna()" >Ver detalle</button></div>
      </div>
      
    </div>
    </div>
      
    
    <!-- CARD - CAPACITACION EXTERNA -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-2 mb-2 "> 
      <div class="card border-0 rounded-0">
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


<div class="modal fade bd-example-modal-lg" id="myModalPolitica" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Bienvenido al elemento 6. COMPETENCIA DEL PERSONAL, CAPACITACIÓN Y ENTRENAMIENTO, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            En este apartado podrás realizar tu programa anual de capacitación, consultar los perfiles de los empleados, así como los perfiles de cada puesto de trabajo. Podrás programar los cursos internos a través de la plataforma y los cursos externos deberán ser programados con anticipación registrando la fecha programada, la fecha real del curso el nombre de la persona o empresa que imparte el curso y el tiempo de duración..
          </p>
          
          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en perfil de personal para consultar a detalle cada uno de los empleados dados de alta </li>
            <li>Da clic en perfiles de puesto para identificar cuales son las tareas y requerimientos mínimo de cada puesto de trabajo </li>
            <li>• Programa las capacitaciones internas y externas dando clic en el cuadro que corresponda. Recuerda que las internas serán las que se tomen a través del portal AdmonGas o en su caso aquellas que imparta el Gerente, Personal de Mantenimiento o cualquier persona afín a la empresa.</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> el crear el programa anual de capacitaciones y darlo a conocer a todo el personal, guiarlos con respecto al uso de herramientas para la toma de cursos. Así como de hacer los registros correspondientes a la capacitación externa.</p>



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
