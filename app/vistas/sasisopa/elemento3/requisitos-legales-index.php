<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";
include_once "app/modelo/RequisitoLegal.php";

$class_ayuda = new Ayuda();
$class_requisito_legal = new RequisitoLegal();

$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'3-requisitos-legales');
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
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
  .car-admin{
    border: 1px solid #eeeeee;box-shadow: 1px 1px 5px #EDEDED;border-bottom: 3px solid #3399cc;border-radius: 0;
  }
  .card-hover:hover{
    background: rgba(239, 239, 239, .3);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  <?php if ($id_ayuda != 0) {echo "btnAyuda();";} ?>
  ListaAsistencia(3);
  });

  function regresarP(){
   window.history.back();
  }

  //-------------------------------------
  function btnAyuda(){
  $('#myModalRequisitos').modal('show');
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
        $('#myModalRequisitos').modal('hide');
        }
        });

    }else{
    $('#myModalRequisitos').modal('hide');
    }

    }
  //------------------------------------

  function RequisitosL(){
  window.location = "3-requisitos-legales-configuracion";    
  }

  function BTNRequisito(NGobierno){
  window.location.href = '3-requisitos-legales/' + NGobierno; 
  }

 function DescargarRequisitos(){
 window.location = "descargar-requisitos-legales";   
 }

//----------------------- LISTA ASISTENCIA------------------------------------
//----------------------------------------------------------------------------
function ListaAsistencia(idSasisopa){
  let targets = [1,2,3];
$('#DivListaAsistencia').load('app/vistas/sasisopa/asistencia/lista-asistencia.php?idSasisopa=' + idSasisopa, function() {
  $('#lista-asistencia').DataTable({
    "language": {
    "url": "<?=RUTA_JS?>es-ES.json"
  },
    "lengthMenu": [15,35,45],
    "columnDefs": [
    { "orderable": false, "targets": targets },
    { "searchable": false, "targets": targets }
    ]
  });
  });
}

function btnAsistencia(){

  var parametros = {
  "accion" : "agregar-lista-asistencia",
 "PuntoSasisopa" : 3
 };

 $.ajax({
 data:  parametros,
 url:   'app/controlador/AsistenciaControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

  if(response != 0){
    window.location = "lista-asistencia/" + response; 
  }else{
   alertify.error('Error al crear registro'); 
  }


 }
 });

 }

 function EditarAsistencia(id){
window.location = "lista-asistencia/" + id; 
}

function EliminarAsistencia(id){

var parametros = {
  "accion" : "eliminar-lista-asistencia",
  "id" : id
  };

alertify.confirm('',
function(){

$.ajax({
   data:  parametros,
   url:   'app/controlador/AsistenciaControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
  
   },
   success:  function (response) {

  if (response == 1) {
  ListaAsistencia(3)
  }else{
  alertify.error('Error al eliminar')
  }

   }
   });

},
function(){
}).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la comunicación interna de la estación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}

function DescargarAsistencia(id){
window.location = "descargar-lista-asistencia/" + id;   
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

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
    <li onclick="RequisitosL()"><a class="dropdown-item c-pointer"> <i class="fa-solid fa-list-ul"></i> Requisitos</a></li>
    </ul>
    </div>
    </div>
    <!-- Fin -->

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
    <ol class="breadcrumb breadcrumb-caret">
    <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SASISOPA</li>
    <li aria-current="page" class="breadcrumb-item active">3. REQUISITOS LEGALES</li>
    </ol>
    </div>
    <!-- Fin -->

    <h3>3. REQUISITOS LEGALES</h3>


    <div class="row mt-3">
    <!-- CARD MUNICIPAL -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-1 mb-3 "> 
    <div class="" >
    <div class="card car-admin card-hover" style="cursor: pointer" onclick="BTNRequisito('municipal')">
    <div class="card-body" style="margin-top: 20px;">
    <div class="text-center text-secondary" style="font-size: 1.3em;">Municipal</div>
    <?php
    $ToPorMunicipal = $class_requisito_legal->ToPorcentaje($Session_IDEstacion,'Municipal');
    $ToReqMunicipal = $class_requisito_legal->ToRequisitos($Session_IDEstacion,'Municipal');


    echo "<div class='text-center text-primary font-weight-bold' style='font-size: 1.4em;margin-top: 20px;'>".round($ToPorMunicipal)." % </div>";

    echo "<div class='text-right text-secondary' style='font-size: .8em;'>".$ToReqMunicipal['ToReFin']." de ".$ToReqMunicipal['ToRe']." Requisitos</div>";
    ?>
    </div>
    </div>
    </div>
    </div>


    <!-- CARD ESTATAL -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-1 mb-3 "> 
    <div class="" >
    <div class="card car-admin card-hover" style="cursor: pointer" onclick="BTNRequisito('estatal')">
    <div class="card-body" style="margin-top: 20px;">
    <div class="text-center text-secondary" style="font-size: 1.3em;">Estatal</div>
    <?php
    $ToPorEstatal = $class_requisito_legal->ToPorcentaje($Session_IDEstacion,'Estatal');
    $ToReqEstatal = $class_requisito_legal->ToRequisitos($Session_IDEstacion,'Estatal');
    echo "<div class='text-center text-primary font-weight-bold' style='font-size: 1.4em;margin-top: 20px;'>".round($ToPorEstatal)." % </div>";

    echo "<div class='text-right text-secondary' style='font-size: .8em;'>".$ToReqEstatal['ToReFin']." de ".$ToReqEstatal['ToRe']." Requisitos</div>";
    ?>
    </div>
    </div>
    </div>
    </div>


    <!-- CARD FEDERAL -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-1 mb-3 ">  
    <div class="" >
    <div class="card car-admin card-hover" style="cursor: pointer" onclick="BTNRequisito('federal')">
    <div class="card-body" style="margin-top: 20px;">
    <div class="text-center text-secondary" style="font-size: 1.3em;">Federal</div>
    <?php
    $ToPorFederal = $class_requisito_legal->ToPorcentaje($Session_IDEstacion,'Federal');
    $ToReqFederal = $class_requisito_legal->ToRequisitos($Session_IDEstacion,'Federal');
    echo "<div class='text-center text-primary font-weight-bold' style='font-size: 1.4em;margin-top: 20px;'>".round($ToPorFederal)." % </div>";

    echo "<div class='text-right text-secondary' style='font-size: .8em;'>".$ToReqFederal['ToReFin']." de ".$ToReqFederal['ToRe']." Requisitos</div>";
    ?>
    </div>
    </div>
    </div>
    </div>


    <!-- CARD VARIOS -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-1 mb-3 ">  
    <div class="" >
    <div class="card car-admin card-hover" style="cursor: pointer" onclick="BTNRequisito('varios')">
    <div class="card-body" style="margin-top: 20px;">
    <div class="text-center text-secondary" style="font-size: 1.3em;">Varios</div>
    <?php
    $ToPorVarios = $class_requisito_legal->ToPorcentaje($Session_IDEstacion,'Varios');
    $ToReqVarios = $class_requisito_legal->ToRequisitos($Session_IDEstacion,'Varios');
    echo "<div class='text-center text-primary font-weight-bold' style='font-size: 1.4em;margin-top: 20px;'>".round($ToPorVarios)." % </div>";

    echo "<div class='text-right text-secondary' style='font-size: .8em;'>".$ToReqVarios['ToReFin']." de ".$ToReqVarios['ToRe']." Requisitos</div>";
    ?>
    </div>
    </div>
    </div>
    </div>

    </div>

    <?php
    if($ToReqMunicipal['ToRe'] > 0){
    $TM = 1; 
    }else{
    $TM = 0; 
    }

    if($ToReqEstatal['ToRe'] > 0){
    $TE = 1; 
    }else{
    $TE = 0; 
    }

    if($ToReqFederal['ToRe'] > 0){
    $TF = 1; 
    }else{
    $TF = 0; 
    }

    if($ToReqVarios['ToRe'] > 0){
    $TV = 1; 
    }else{
    $TV = 0; 
    }

    $divP = $TM + $TE + $TF + $TV;

    $ToPorcentaje = $ToPorMunicipal + $ToPorEstatal + $ToPorFederal + $ToPorVarios;

    if($ToPorcentaje == 0 AND $divP == 0){
    $Sicumple = 0;
    $NoCumple = 100; 
    }else{
    $Sicumple = $ToPorcentaje / $divP;
    $NoCumple = 100 - $Sicumple; 
    }

    ?>
    <!-- PORCENTAJE DE CUMPLIMIENTO-->
    <div class="bg-white p-3">
    <label class="text-secondary" style="font-size: .8em">Porcentaje de cumplimiento general</label>
    <div class="progress" style='font-size: .9em;height: 20px;'>
    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?=$Sicumple;?>%" aria-valuenow="<?=$Sicumple;?>" aria-valuemin="0" aria-valuemax="100">Cumple <?=round($Sicumple);?> %</div>
    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?=$NoCumple;?>%" aria-valuenow="<?=$NoCumple;?>" aria-valuemin="0" aria-valuemax="100">No cumple <?=round($NoCumple);?> %</div>
    </div>
    </div>

    <div class="bg-white p-3 mt-3">
    <div class="text-secondary">Calendario anual de renovacion de Requisitos Legales <a onclick="DescargarRequisitos()"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></div>
    
    <div class="row">
   <!-- Lista de Asistencia-->
    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mt-2 mb-2">  
      <div class="row">

      <div class="col-11">
        <h5 class="text-primary">Fo.ADMONGAS.010 (Registro de la atención y el seguimiento a la comunicación interna y externa.)</h5>
      </div>
            
      <div class="col-1 text-end">
      <a onclick="btnAsistencia()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
      <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
      </a>
      </div>
      </div>        
      <div id="DivListaAsistencia"></div>
    </div>
     </div>  
  </div>

    </div>

    <div class="modal fade bd-example-modal-lg" id="myModalRequisitos" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Bienvenido al elemento 3 REQUISITOS LEGALES, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            Aquí vas a poder consultar, descargar e imprimir los requisitos legales aplicables a tu estación de servicio, así como también identificar el porcentaje de cumplimiento en los diferentes niveles de gobierno regulatorio.
          </p>
     
          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en el botón de Requisitos Legales</li>
            <li>Selecciona el nivel de gobierno para visualizar los requisitos aplicables</li>
            <li>Da clic en el icono PDF para visualizar o descargar</li>
          </ul>

          <p class="text-danger" style="font-size: .8em;">* La barra indica el porcentaje de cumplimiento general de tus requisitos legales</p>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> y <label class="text-danger font-weight-bold">Departamento de Gestión</label> el actualizar aquellos requisitos legales que cuentes con vigencia.</p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  <!---------- LIBRERIAS DEL DATATABLE ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>

  </body>
  </html>
