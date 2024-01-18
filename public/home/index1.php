<?php
require('app/help.php');

if ($Session_IDUsuarioBD == "") {
header("Location:".PORTAL."");
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
  <script type="text/javascript" src="<?php echo RUTA_JS ?>push.min.js" ></script>
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

    $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");
  Gerente();

  });

  function Gerente(){
  $('#DivContenido').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
  $('#DivContenido').load('public/gerente/gerente-index.php');
  }

  /*
  document.addEventListener('DOMContentLoaded', function () {
  if (!Notification)
  {
  alert('Desktop notifications not available in your browser. Try Chromium.');
  return;
  }
  if (Notification.permission !== "granted")
  Notification.requestPermission();
  });

  $(document).ready(function() {
var refreshId =  setInterval( function(){
$.ajax({
   url:   'public/gerente/notificacion/notificaciones.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

   }
   });

},1000);

var BuscarNoticias =  setInterval( function(){
$.ajax({
   url:   'public/gerente/notificacion/alertas-noticias.php',
   type:  'post',
   dataType: 'JSON',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

 var titulo = response[0].titulo;
 var detalle = response[0].detalle;
 var url = response[0].url;

 if(titulo != ""){
 notificacion(titulo,detalle,url);
 }

   }
   });

},1000);

});

function notificacion(titulo,detalle,url){

Push.create(titulo, {
      body: detalle,
      icon: '<?php echo RUTA_IMG_ICONOS."icono-web.png";?>',
      timeout: 6000,
      onClick: function () {
        window.location.href = url;
        this.close();
      }
    });


}
*/

function ConsultaSasisopa(){
  $('#ModalSasisopa').modal('show'); 
}

  </script>
  </head>
  <body>

  <div class="LoaderPage"></div>
  <div class="fixed-top navbar-admin">
  <?php require('public/componentes/header.menu.php'); ?>
  </div>
  <div id="DivPrincipal">
  <div class="divcontenedor">
  <div class="divbody">
  <div class="magir-top-principal">
  <div id="DivContenido"></div>
  </div>
  </div>
  </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="ModalSasisopa" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div class="modal-header">
  <h4 class="modal-title">CONSULTA TU SASISOPA</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

  <?php 
  $sql_lista = "SELECT * FROM tb_sasisopa WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY id DESC ";
  $result_lista = mysqli_query($con, $sql_lista);
  $numero_lista = mysqli_num_rows($result_lista);
  ?>

  <table class="table table-bordered table-striped table-sm">
  <thead> 
  <tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Versión</th>
  <th class="text-center align-middle" width="16px"><img src="<?=RUTA_IMG_ICONOS."pdf.png"; ?>"></th>
  </tr>
  </thead>
  <tbody>
  <?php

  if ($numero_lista > 0) {
  while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
  $id = $row_lista['id'];
  echo '<tr>';
  echo '<td class="text-center">'.$row_lista['id'].'</td>';
  echo '<td class="text-center">'.$row_lista['version'].'</td>';
  echo '<td class="text-center align-middle"><a href="'.$row_lista['documento'].'" download><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a></td>';
  echo '</tr>';


  }
  }else{
  echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
  }
  ?>
  </tbody>
  </table>

  </div>
  </div>
  </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
