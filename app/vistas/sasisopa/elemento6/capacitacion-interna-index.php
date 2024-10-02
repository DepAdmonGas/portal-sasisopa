<?php
require('app/help.php');
include_once "app/modelo/Cursos.php";
$class_cursos = new Cursos();
$result_modulos_cursos = $class_cursos->cursosModulos();

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

#Trabajadores{
  display: none;
}
 
.card-cursos-home{
border: 0px;
border-radius: 0;
box-shadow: 1px 1px 5px #EDEDED;
margin: 0px;
border-bottom: 4px solid #2975C1;
}
.card-cursos-disabled{

border: 0px;
border-radius: 0;
box-shadow: 1px 1px 5px #EDEDED;
margin: 0px;
border-bottom: 4px solid #979797;
background: rgba(204, 204, 204, 0.35);

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

  function BTNverModulos(idModulo){
  window.location.href = "capacitacion-interna-modulos/" + idModulo;
  }

  function ModalBuscar(){
  $('#ModalBuscar').modal('show');
  }

  function btnBuscar(){

  let BuscarYear = $('#BuscarYear').val();

  if (BuscarYear != "") {
  $('#BuscarYear').css('border','');

  $('#DivContenido').load('app/vistas/sasisopa/elemento6/lista-capacitacion-interna-reporte.php?Year=' + BuscarYear);  
  $('#ModalBuscar').modal('hide');

  }else{
  $('#BuscarYear').css('border','2px solid #A52525');
  }

  }

  function Reconocimiento(id){
  window.open('descargar-reconocimiento/' + id, '_blank');
  }

  function ReconocimientosPersonal(year,modulo){
  window.open('descargar-reconocimiento-modulo/' + year + '/' + modulo, '_blank');
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
      <li onclick="ModalBuscar()"><a class="dropdown-item c-pointer"> <i class="fa-solid fa-magnifying-glass"></i> Buscar</a></li>
      </ul>
      </div>
      </div>
      <!-- Fin -->

      <!-- Inicio -->
      <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
      <ol class="breadcrumb breadcrumb-caret">
      <li class="breadcrumb-item text-primary c-pointer" onclick="window.history.go(-2);"><i class="fa-solid fa-house"></i> SASISOPA</li>
      <li aria-current="page" class="breadcrumb-item c-pointer" onclick="regresarP()">6. COMPETENCIA DEL PERSONAL, CAPACITACIÓN Y ENTRENAMIENTO</li>
      <li aria-current="page" class="breadcrumb-item active">CAPACITACIÓN INTERN</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>CAPACITACIÓN INTERNA</h3>

    <div class="mt-3">

    <div id="DivContenido">

    <h5>Modulos</h5>
    <div class="row no-gutters">

    <?php
    while($row = mysqli_fetch_array($result_modulos_cursos, MYSQLI_ASSOC)){

    $GET_idModulo = $row['id'];
    $num_modulo = $row['num_modulo'];
    $titulo = $row['titulo'];

    $totalTemas = $class_cursos->numTemasModulo($GET_idModulo);

    ?>

    <!-- CARD - PROCEDIMIENTOS -->
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2 "> 

    <div class="" style="padding: 10px;" >
    <div class="card-cursos-float">
    <div class="card card-cursos-home" >
    <div class="card-body text-center">

    <h5 data-toggle="tooltip" data-placement="top" title="<?=$row['titulo']; ?>"><?=$titulo; ?></h5>
    <div><a style="color: #1BB05F;font-size: 3.5em;font-weight: bold"><?=$totalTemas; ?></a> <a class="text-muted text-decoration-none" style="font-size: .9em;">Temas</a></div>
    <div class="text-end"><button type="button" class="btn btn-outline-success btn-sm" onclick="BTNverModulos(<?=$GET_idModulo; ?>)" >Ver Temas</button></div>
    </div>
    </div>
    </div>
    </div>

    </div>
    <?php
    }
    ?>
    </div>


    </div>

    </div>

    </div>

           <div class="modal fade bd-example-modal-lg" id="ModalBuscar" data-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h5 class="modal-title text-white">Buscar</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


        <div class="form-group">
         <label class="text-secondary" >Agregar Año: </label>
         <input type="text" class="form-control" name="" id="BuscarYear" style="border-radius: 0px;">
         </div>


        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnBuscar()">Buscar</button>
        </div>
      </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
