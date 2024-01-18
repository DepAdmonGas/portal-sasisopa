<?php
require('app/help.php');

$sql_sasisopa_ayuda = "SELECT * FROM pu_sasisopa_ayuda WHERE id_usuario = '".$Session_IDUsuarioBD."' and detalle = '8-control-documentos-registros' and estado = 0 LIMIT 1";
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
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  <?php if ($numero_sasisopa_ayuda == 1) {echo "btnAyuda();";} ?>
  });
  function regresarP(){
   window.location.href = "<?=SERVIDOR;?>";
  }
  function btnControlDocumentos(){
    window.location.href = "control-documentos-sa";
  } 

  function btnControlDocumentosRL(){
    window.location.href = "control-documentos-rl";  
  }

  function btnAyuda(){
  $('#ModalControlDocumentos').modal('show');
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
   $('#ModalControlDocumentos').modal('hide');
   }
   });

  }else{
  $('#ModalControlDocumentos').modal('hide');
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
    

    <!-- TITULO / ENCABEZADO -->
    <div class="float-left">
      <h4>8. CONTROL DE DOCUMENTOS Y REGISTROS</h4>
    </div>



    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>


    </div>
    <div class="card-body">


<div class="row justify-content-md-center row-cols-xl-4 row-cols-lg-4 row-cols-md-4">
      
  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-2 mb-2"> 
    
    <div class="card" style="border-radius: 0px;">
    <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Control y documentos de Requisitos Legales
    </div>
    <div class="text-right" style="margin-top: 10px;">
    <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnControlDocumentosRL()" >Ver requisitos legales</button></div>
    </div>
    </div>
    </div>
    </div>



    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2 "> 
   <div class="card" style="border-radius: 0px;">
  <div class="card-body" style="font-size: 1.3em;">
    <div class="text-secondary">Control y documentos del Sistema de Administración</div>
    <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="btnControlDocumentos()" >Ver control y documentos</button></div>
  </div>
  
</div>
</div>




    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalControlDocumentos" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 8. CONTROL DE DOCUMENTOS Y REGISTROS, del Sistema de Administración</h4>
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
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
