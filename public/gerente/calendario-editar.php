<?php
require('app/help.php');
$Diastrto = strtotime($fecha_del_dia);
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
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
  <style media="screen">
  .LoaderPage {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('../imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}

/*---- CALENDARIO ----*/

 .calendar-day, .calendar-day-head{
    border: 1px solid #ddd;
    }

  .calendar-day-head{
    background: #ddd;
    font-size: .9em
  }

.calendar-day-np{
    background: #F5F5F5;
    border: 1px solid #ddd;
}

.yes-day{
  background: #5B9FFC;
  color: white;  
}

.style-day{
padding: 6px;
}
.td-efect:hover{
    background: #5B9FFC;
    color: white;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

Calendario(<?=$idEstacion;?>,<?=$fecha_mes;?>,<?=$fecha_year;?>);
SelDay(<?=$idEstacion;?>,<?=$Diastrto;?>);

 });

  function regresarP(){
   window.history.back();
  }

  function Calendario(idEstacion,mes,year){
$('#DivCalendario').load('../public/gerente/vistas/contenido-calendario.php?Mes=' + mes + '&Year=' + year + '&idEstacion=' + idEstacion);     
}

function SelDay(idEstacion, fecha){
$('#DivActividades').load('../public/gerente/vistas/contenido-actividades.php?&idEstacion=' + idEstacion + '&fecha=' + fecha);
}


function Modal(idEstacion){
$('#Modal').modal('show');
$('#DivModal').load('../public/gerente/vistas/modal-crear-actividad.php?idEstacion=' + idEstacion);
}

function AgregarActividad(idEstacion){


var Actividad = $('#Actividad').val();
var Fecha = $('#Fecha').val();

if (Actividad != "") {
$('#Actividad').css('border','');
if (Fecha != "") {
$('#Fecha').css('border','');

     var parametros = {
     "idEstacion" : idEstacion,
     "Actividad" : Actividad,
     "Fecha" : Fecha
      };

      $.ajax({
      data:  parametros,
      url:   '../public/gerente/agregar/agregar-actividad.php',
      type:  'post',
      beforeSend: function() {
    $(".LoaderPage").show();
      },
      complete: function(){    
      $(".LoaderPage").hide();        
            
      },
      success:  function (response) {

        if(response == 1){
        $('#Modal').modal('hide');
        Calendario(<?=$idEstacion;?>,<?=$fecha_mes;?>,<?=$fecha_year;?>);
        }
            
      }
      });  


}else{
$('#Fecha').css('border','2px solid #A52525');    
}
}else{
$('#Actividad').css('border','2px solid #A52525');    
}

}

function DetalleActividad(idActividad){

$('#ModalActividad').modal('show');
$('#DivModalActividad').load('../public/gerente/vistas/modal-detalle-actividad.php?idActividad=' + idActividad);

}
  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
    </div>

    <div class="magir-top-principal p-3">


    <div class="float-end">
  <div class="dropdown dropdown-sm d-inline ms-2">
  </div>
  </div>
  <!-- Fin -->

  <!-- Inicio -->
  <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
  <ol class="breadcrumb breadcrumb-caret">
  <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SASISOPA</li>
  <li aria-current="page" class="breadcrumb-item active">EDITAR CALENDARIO</li>
  </ol>
  </div>
  <!-- Fin -->

  <h3>EDITAR CALENDARIO</h3>

    </div>

    <div class="p-4 pt-0">
  
      <div class="row">
        <div class="col-12 col-sm-6">
            <div id="DivCalendario"></div>
        </div>
        <div class="col-12 col-sm-6">
            <div id="DivActividades"></div>
        </div>
    </div>

    </div>

  <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
  <div id="DivModal"></div>
  </div>
  </div>
  </div>

  <div class="modal fade" id="ModalActividad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
  <div id="DivModalActividad"></div>
  </div>
  </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
