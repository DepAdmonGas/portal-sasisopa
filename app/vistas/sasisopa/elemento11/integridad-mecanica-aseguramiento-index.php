<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'11-integridad-mecanica-aseguramiento');
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
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  <?php if ($id_ayuda != 0) {echo "btnAyuda();";} ?>

  CargarListaEquipo();
  });
  function regresarP(){
    window.history.back();
  }

  function btnAyuda(){
  $('#ModalAyuda').modal('show');
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
    $('#ModalAyuda').modal('hide');
    }
    });

    }else{
    $('#ModalAyuda').modal('hide');
    }
    }

    function btnProgramaAnual(){
    window.location.href = "programa-anual-mantenimiento";  
    }

    function btnBitacora(){
    window.location.href = "bitacoras-caracteristicas";
    }

    function CargarListaEquipo(){

      let targets = [6];
    $('#ConteListaEquipo').load('app/vistas/sasisopa/elemento11/lista-equipo-critico.php', function() {
      $('#table-equipo-critico').DataTable({
        "language": {
        "url": "<?=RUTA_JS?>es-ES.json"
      },
      "stateSave": true,
        "lengthMenu": [15,35,45],
        "columnDefs": [
        { "orderable": false, "targets": targets },
        { "searchable": false, "targets": targets }
        ]
      });
      });  
    
    }

    function BtnEquipoCritico(){
    $('#ModalEquipoCritico').modal('show');
    }

    function btnGuardar(){

    var NombreEquipo = $('#NombreEquipo').val();
    var MarcaModelo = $('#MarcaModelo').val();
    var Funcion = $('#Funcion').val();
    var FechaInstalacion = $('#FechaInstalacion').val();
    var TiempoVida = $('#TiempoVida').val();

    var ManualPDF = document.getElementById("ManualPDF");
    var ManualPDF_file = ManualPDF.files[0];
    var ManualPDF_filePath = ManualPDF.value;

    var data = new FormData();
    var url = 'app/controlador/IntegridadMecanicaAseguramientoControlador.php';
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
    
    data.append('accion', 'agregar-equipo-critico');
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

        console.log(data)

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

    function ModalEliminar(id){
    $('#ModalEliminarBaja').modal('show');
    $('#IdEquipoCritico').val(id);
    }

    function BTNBaja(){
    var IdEquipo = $('#IdEquipoCritico').val();

    var parametros = {
    "accion" : "actualizar-baja",
    "IdEquipo" : IdEquipo
    };

    $.ajax({
    data:  parametros,
    url:   'app/controlador/IntegridadMecanicaAseguramientoControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {
    CargarListaEquipo();
    alertify.success('Se dio de baja correctamente la información');
    $('#ModalEliminarBaja').modal('hide');

    }
    });

    }

    function BTNEliminar(){
    var IdEquipo = $('#IdEquipoCritico').val();

    var parametros = {
    "accion" : "eliminar-equipo-critico",
    "IdEquipo" : IdEquipo
    };

    $.ajax({
    data:  parametros,
    url:   'app/controlador/IntegridadMecanicaAseguramientoControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {
    CargarListaEquipo();
    alertify.success('Se elimino correctamente la información');
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
      <li aria-current="page" class="breadcrumb-item active">11. INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>11. INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD</h3>

    <div class="mt-3">
    <div class="row">

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12"> 
    <div class="card border-0 bordered-0">
    <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Programa anual de mantenimiento
    </div>
    <div class="text-end mt-3"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnProgramaAnual()" >Ver programa</button></div>
    </div>
    </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12"> 
    <div class="card border-0 bordered-0">
    <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Procedimientos de Operación, Seguridad y Mantenimiento</div>
    <div class="text-end mt-3">
    <a target="_blabk" href="archivos/procedimientos/DLES.ADMONGAS.001.pdf" class="btn btn-primary btn-sm" style="border-radius: 0px;">Ver procedimientos</a></div>
    </div>  
    </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
    <div class="card border-0 bordered-0">
    <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Bitácoras</div>
    <div class="text-end mt-3"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnBitacora()" >Ver detalle</button></div>
    </div>
    </div>
    </div>

    </div>
    </div>

    <div class="bg-white mt-3 p-3">
    <div class="row">
    <div class="text-primary col-10" style="font-size: 1.3em;">
    Lista de equipos críticos
    </div>
    <div class="col-2 mt-2">
     <a class="float-end" onclick="BtnEquipoCritico()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar equipo critico" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    <a class="float-end me-2" onclick="BtnDescargar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar equipo critico" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>
    </div>
    </div>
    <div id="ConteListaEquipo"></div>
    </div>

    </div>


    <div class="modal fade bd-example-modal-lg" id="ModalAyuda" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Bienvenido al elemento 11. INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD, del Sistema de Administración</h4>
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
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>


  <div class="modal fade bd-example-modal-lg" id="ModalEquipoCritico" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Agregar equipo critico</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Eliminar o Baja</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
        <input type="hidden" name="" id="IdEquipoCritico">

        <button type="button btn-block" class="btn btn-primary mt-2 rounded-0" style="width: 100%;" onclick="BTNBaja()">Dar de baja equipo critico</button>
        <button type="button btn-block" class="btn btn-warning mt-2 rounded-0" style="width: 100%;" onclick="BTNEliminar()">Eliminar equipo critico</button>
        
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
