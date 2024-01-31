<?php
require('app/help.php');

$sql_sasisopa_ayuda = "SELECT * FROM pu_sasisopa_ayuda WHERE id_usuario = '".$Session_IDUsuarioBD."' and detalle = '18-informes-desempeno' and estado = 0 LIMIT 1";
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

    .modal-xg {
    max-width: 90% !important;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
 <?php if ($numero_sasisopa_ayuda == 1) {echo "btnAyuda();";} ?>

 InformeEvaluacion();
 ImplementacionSasisopa();
  });
  function regresarP(){
   window.history.back();
  }

  function InformeEvaluacion(){
  $('#InformeEvaluacion').load('public/sasisopa/vistas/lista-informe-evaluacion.php');  
  }

  function ImplementacionSasisopa(){
  $('#ImplementacionSasisopa').load('public/sasisopa/vistas/lista-implementacion-sasisopa.php');  
  }


  function btnAyuda(){
  $('#myModalPolitica').modal('show');
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
   $('#myModalPolitica').modal('hide');
   }
   });

  }else{
  $('#myModalPolitica').modal('hide');
  }

}

function ModalArchivo(){
$('#ModalArchivo').modal('show'); 
}

function BTNAgregar(idUsuario, idEstacion){

  var data = new FormData();
  var url = "public/sasisopa/agregar/agregar-evaluacion-desempeno.php";

  var ArchivoPDF = document.getElementById("ArchivoPDF");
  var file = ArchivoPDF.files[0];
  var filePath = ArchivoPDF.value;
  var valpdf = filePath.split('.').pop();

  if (filePath != "") {
  $('#ArchivoPDF').css('border','');
  if (valpdf == "pdf") {
  $('#ArchivoPDF').css('border','');
  $('#DivResultadoPDF').html('');

  data.append('idUsuario', idUsuario);
  data.append('idEstacion', idEstacion);
  data.append('file', file);

  

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

  InformeEvaluacion();
  ArchivoPDF.value = '';
  $('#ModalArchivo').modal('hide'); 

  });

  }else{
  $('#ArchivoPDF').css('border','2px solid #A52525');
  $('#DivResultadoPDF').html('<label class="text-danger">Solo acepta formato PDF</label>');
  }
  }else{
  $('#ArchivoPDF').css('border','2px solid #A52525');
  }


}

function Eliminar(id){

    var parametros = {
      "id" : id
    };

  alertify.confirm('',
    function(){

    $.ajax({
     data:  parametros,
     url:   'public/sasisopa/eliminar/eliminar-evaluacion-desempeno.php',
     type:  'post',
     beforeSend: function() {

     },
     complete: function(){


     },
     success:  function (response) {

      alertify.message('Se eliminó correctamente el Informe de Evaluación de Desempeño');
      InformeEvaluacion();

     }
     });

    },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el Informe de Evaluación de Desempeño seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function ModalImplementacion(idUsuario, idEstacion){

  var parametros = {
      "idUsuario" : idUsuario,
      "idEstacion" : idEstacion
    };

        $.ajax({
     data:  parametros,
     url:   'public/sasisopa/agregar/agregar-control-implementacion-sasisopa.php',
     type:  'post',
     beforeSend: function() {

     },
     complete: function(){


     },
     success:  function (response) {
      
      window.location.href = "implementacion-sasisopa/" + response;  
     
     }
     });
 
} 

function EliminarImplementacion(id){


    var parametros = {
      "id" : id
    };

  alertify.confirm('',
    function(){

    $.ajax({
     data:  parametros,
     url:   'public/sasisopa/eliminar/eliminar-implementacion-sasisopa.php',
     type:  'post',
     beforeSend: function() {

     },
     complete: function(){


     },
     success:  function (response) {

      alertify.message('Se eliminó correctamente el Control de la implementación de los procedimientos del SASISOPA');
      ImplementacionSasisopa();

     }
     });
 
    },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el Control de la implementación de los procedimientos del SASISOPA seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}

function EditarImplementacion (id){

  window.location.href = "implementacion-sasisopa/" + id;  

  }
  function VerImplementacion (id){
$('#ModalDetalle').modal('show');
$('#DetalleImplementacion').load('public/sasisopa/vistas/detalle-implementacion-sasisopa.php?idReporte=' + id);  
    
  }

  function DescargarIS(id){

  window.location = "descargar-registro-atencio-seguimiento-comunicacion-interna-externa/" + id;  

  }

  function Editar(id){
    $('#ModalDetalle').modal('show');
  $('#DetalleImplementacion').load('public/sasisopa/vistas/editar-informe-evaluacion-desempeno.php?id=' + id); 
  }

  function BtnEditar(id){

    let EditFecha = $('#EditFecha').val();

var data = new FormData();
var url = "public/sasisopa/actualizar/editar-informe-evaluacion-desempeno.php";

  var ArchivoPDF = document.getElementById("EditArchivoPDF");
  var file = ArchivoPDF.files[0];
  var filePath = ArchivoPDF.value;
  var valpdf = filePath.split('.').pop();

if (EditFecha != "") {
$('#EditFecha').css('border','');

  alertify.confirm('',
    function(){

  data.append('id', id);
  data.append('EditFecha', EditFecha);
  data.append('file', file);

    $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

    alertify.message('Se edito correctamente la evaluación de desempeño');
    InformeEvaluacion();
    $('#ModalDetalle').modal('hide');

  });

    },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea editar la revisión de resultados seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#EditFecha').css('border','2px solid #A52525');  
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
      <h4>18. INFORMES DE DESEMPEÑO</h4>
      </div>
    
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
      </div>
   

 
    <div class="card-body">
         
    <div class="row">

      <!-- TABLA - INFORME DE DESEMPEÑO -->

  <div class="col-12 mt-2 mb-2"> 
        
    <div class="border">
    <div class="p-3"> 
     <div class="row">
       

       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1"> 
          <h5>Informe de Evaluación de Desempeño (IED)</h5>
        </div>
        
       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1"> 
        <a class="float-right" onclick="ModalArchivo()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
        <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
        </a>


        <a class="float-right mr-2" style="text-decoration: none;" href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.028.docx";?>" download>
        <b>Fo.ADMONGAS.028</b>
        <img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>">
        </a>
        </div>
       </div>

      <hr>
  
      <div id="InformeEvaluacion"></div>
        </div>
        </div>

  </div>

  <hr>
      
      <!-- TABLA - CONTROL IMPLRMRNTACION SASISOPA -->

    <div class="col-12 mt-2 mb-2 "> 

   <div class="border">
   <div class="p-3">
   <div class="row">   
     
      <div class="col-10 mt-1">
        <h5>Control de la implementación de los procedimientos del SASISOPA (Fo.ADMONGAS.029)</h5>
      </div>
 

      <div class="col-2 mt-1">
        <a class="float-right" onclick="ModalImplementacion(<?=$Session_IDUsuarioBD;?>,<?=$Session_IDEstacion;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
        <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
        </a>
      </div>

    </div>
    <hr>

    <div id="ImplementacionSasisopa"></div>
      
      </div>
      </div>
    
    </div>
    </div>

    </div>


    </div>
    </div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="myModalPolitica" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 18. INFORMES DE DESEMPEÑO, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            En este apartado se debe realizar el registro de la implementación real de los procedimientos técnicos y administrativos del sistema de administración, así como también generar el informe de evaluación del  desempeño que se ingresara a la Agencia de Seguridad, Energía y Ambiente en los primeros tres meses de cada año, siempre y cuando el sistema de administración haya sido aprobado por dicha agencia.
          </p>
         
          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en el icono descargar formato <b>Fo.ADMONGAS.028</b> para llenar el Informe de <b>Evaluación de Desempeño (IED)</b>.</li>
            <li>Lee detenidamente cada uno de los puntos y realiza lo que se te indica.</li>
            <li>Podrán ser utilizadas imágenes para detallar de manera mas precisa cada uno de los puntos.</li>
            <li>Dicho informe debe ser firmado por el representante legal y deberá ser enviado en original a la agencia (<b>Periferico Sur 4209, Jardines en la Montaña, Tlalpan, 14210 Ciudad de México, CDMX</b>) en los primeros tres meses de cada año.</li>
            <li>Escanea y sube tu acuse de ingreso en formato PDF (Subir documento completo).</li>
            <li>En el formato <b>Fo.ADMONGAS.029</b> da clic en agregar para realizar el registro de la implementación real de los procedimientos del sistema de administración.</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label>, generar el informe de evaluación de desempeño de manera anual así como los registros del presente procedimiento.</p>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

<div class="modal fade bd-example-modal-lg" id="ModalArchivo" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
 <div class="modal-header">
   <h4 class="modal-title">Agregar archivo Fo.ADMONGAS.028</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

  <div class="mb-2">
  <label for="tipocomunicacion" class="text-secondary">Informe de Evaluación de Desempeño (IED) en formato PDF: </label>
  </div>

 <input type="file" name="" id="ArchivoPDF">
 <div id="DivResultadoPDF"></div>

 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BTNAgregar(<?=$Session_IDUsuarioBD;?>,
<?=$Session_IDEstacion;?>)">Agregar</button>
 </div>
</div>
</div>
</div>


<div class="modal fade bd-example-modal-xl" id="ModalDetalle">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
<div id="DetalleImplementacion"></div>
</div>
</div>
</div>




  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>


