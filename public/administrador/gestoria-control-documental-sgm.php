<?php
require('app/help.php');

$sql = "SELECT * FROM tb_estaciones WHERE id = '".$GET_idEstacion."'";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$RazonSocial = $row['razonsocial'];
$ApoderadoLegal = $row['apoderado_legal'];
 
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
  background: white;
  background: url('../imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }

  .hovercolor:hover{
  background: rgba(0, 120, 238, .8) !important;
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaDocumentos(<?=$GET_idEstacion;?>);
  
  });
  function regresarP(){
  window.history.back();
  }

  function ListaDocumentos(idEstacion){
    $('#ListaDocumentos').load('../public/administrador/vistas/lista-control-documentos.php?idEstacion=' + idEstacion);
  }

  function modalDocumento(idEstacion,id){
    $('#modalDocumento').modal('show'); 
    $('#DivDocumento').load('../public/administrador/vistas/modal-guardar-documento-sgm.php?idEstacion=' + idEstacion + '&id=' + id);
  }

  function GuardarDocumento(idEstacion,id){

    var data = new FormData();
    var url = '../public/administrador/agregar/agregar-documento-sgm.php';

    documento = document.getElementById("documento");
    documento_file = documento.files[0];
    documento_filePath = documento.value;

  if(documento_filePath != ""){
  $('#documento').css('border','');

    data.append('idEstacion', idEstacion);
    data.append('id', id);
    data.append('documento_file', documento_file);

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
    $('#DivDocumento').load('../public/administrador/vistas/modal-guardar-documento-sgm.php?idEstacion=' + idEstacion + '&id=' + id);
    ListaDocumentos(idEstacion);
     }else{
      $(".LoaderPage").hide();
      alertify.error('Error al agregar'); 
     }
     

    }); 

  }else{
  $('#documento').css('border','2px solid #A52525'); 
  }

  }

  function Eliminar(id,idEstacion,idDocumento){

  var parametros = {
  "idDocumento" : idDocumento
  };

 alertify.confirm('',
 function(){

  $.ajax({
  data:  parametros,
  url:   '../public/administrador/eliminar/eliminar-documento-sgm.php',
  type:  'post',
  beforeSend: function() {
  $(".LoaderPage").show();
  },
  complete: function(){
  },
  success:  function (response) {

  if (response == 1){
  $(".LoaderPage").hide();
  $('#DivDocumento').load('../public/administrador/vistas/modal-guardar-documento-sgm.php?idEstacion=' + idEstacion + '&id=' + id);
  ListaDocumentos(idEstacion)
  }else{
  $(".LoaderPage").hide();
  alertify.error('Error al eliminar');  
  }
  
  }
  });

  },
 function(){

 }).setHeader('Eliminar documento').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    <div class="float-left"><h4>Control documental del SGM</h4></div>
    </div>
    <div class="card-body">
    <h5><?=$RazonSocial?></h5>
    <div id="ListaDocumentos"></div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalDocumento" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0">
      <div class="modal-header">
      <h4 class="modal-title">Control documental del SGM</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
        <div class="modal-body">
        <div id="DivDocumento"></div>
        </div>
      </div>
    </div>
  </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
