<?php
require('app/help.php');

function tanqueAlmacenamiento($id_estacion,$con){

$sql_rp = "SELECT
sgm_autorizado.id_usuario,
sgm_autorizado.estado,
tb_usuarios.id_gas
FROM sgm_autorizado 
INNER JOIN tb_usuarios 
ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE tb_usuarios.id_gas = '".$id_estacion."' AND sgm_autorizado.estado = 1 LIMIT 1";
$result_rp = mysqli_query($con, $sql_rp);
$numero_rp = mysqli_num_rows($result_rp);
if ($numero_rp > 0) {
$row_rp = mysqli_fetch_array($result_rp, MYSQLI_ASSOC);
$realizadopor = $row_rp['id_usuario'];
}else{
$realizadopor = 0;
}

$sql_validar = "SELECT id FROM sgm_inventario_equipo WHERE id_estacion = '".$id_estacion."' AND nombre = 'Tanques de almacenamiento' ";
$result_validar = mysqli_query($con, $sql_validar);
$numero_validar = mysqli_num_rows($result_validar);
if ($numero_validar == 0) {

$sql = "SELECT no_tanque FROM tb_tanque_almacenamiento WHERE id_estacion = '".$id_estacion."' ORDER BY no_tanque ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$sql_insert = "INSERT INTO sgm_inventario_equipo (
id_estacion,nombre,identificacion,funcion,fecha_instalacion,realizadopor,estado
)
VALUES (
'".$id_estacion."',
'Tanques de almacenamiento',
'".$row['no_tanque']."',
'',
'',
'".$realizadopor."',
1
)";

mysqli_query($con, $sql_insert);

$sql_insert2 = "INSERT INTO sgm_inventario_equipo (
id_estacion,nombre,identificacion,funcion,fecha_instalacion,realizadopor,estado
)
VALUES (
'".$id_estacion."',
'Sondas de nivel y temperatura',
'".$row['no_tanque']."',
'',
'',
'".$realizadopor."',
1
)";

mysqli_query($con, $sql_insert2);


}
}

}

function dispensarios($id_estacion,$con){

$sql_rp = "SELECT
sgm_autorizado.id_usuario,
sgm_autorizado.estado,
tb_usuarios.id_gas
FROM sgm_autorizado 
INNER JOIN tb_usuarios 
ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE tb_usuarios.id_gas = '".$id_estacion."' AND sgm_autorizado.estado = 1 LIMIT 1";
$result_rp = mysqli_query($con, $sql_rp);
$numero_rp = mysqli_num_rows($result_rp);
if ($numero_rp > 0) {
$row_rp = mysqli_fetch_array($result_rp, MYSQLI_ASSOC);
$realizadopor = $row_rp['id_usuario'];
}else{
$realizadopor = 0;
}

$sql_validar = "SELECT id FROM sgm_inventario_equipo WHERE id_estacion = '".$id_estacion."' AND nombre = 'Dispensarios' ";
$result_validar = mysqli_query($con, $sql_validar);
$numero_validar = mysqli_num_rows($result_validar);
if ($numero_validar == 0) {

$sql = "SELECT no_dispensario FROM tb_dispensarios WHERE id_estacion = '".$id_estacion."' ORDER BY no_dispensario ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$sql_insert = "INSERT INTO sgm_inventario_equipo (
id_estacion,nombre,identificacion,funcion,fecha_instalacion,realizadopor,estado
)
VALUES (
'".$id_estacion."',
'Dispensarios',
'".$row['no_dispensario']."',
'',
'',
'".$realizadopor."',
1
)";

mysqli_query($con, $sql_insert);


}
}

}

tanqueAlmacenamiento($Session_IDEstacion,$con);
dispensarios($Session_IDEstacion,$con);

?> 
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SGM</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link href="<?=RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
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
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaInventarioEquipo();

  });


  function regresarP(){
  window.history.back();
  }

  function btnAyuda(){
  $('#myModal').modal('show');
  }

  function ListaInventarioEquipo(){
    $('#ListaInventarioEquipo').load('app/vistas/sgm/punto6/lista-inventario-equipo.php');
  }

  function btnAgregarInventarioEquipo(){


  $.ajax({
   url:   'app/vistas/sgm/punto6/agregar-inventario-equipo.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response != 0){
     modalEditarEquipo(response) 
    }else{
      alertify.error('Error al crear inventario')
    }
   
   
   }
   });

  }

  function modalEditarEquipo(idEquipo){
  $('#modalAgregarEquipo').modal('show');  
  $('#modalContenido').load('app/vistas/sgm/punto6/modal-editar-equipo.php?idEquipo=' + idEquipo);
  }

  function EliminarEquipo(id){
     var parametros = {
    "id" : id
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/eliminar-inventario-equipo.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaInventarioEquipo()
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar el equipo del SGM?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
  }

  function EditarEquipo(e,idEquipo,cate){

  var parametros = {
    "idEquipo" : idEquipo,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/editar-inventario-equipo.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {


     }
     });

  }

  function Finalizar(idEquipo){

    var parametros = {
    "idEquipo" : idEquipo,
    "valor" : 1,
    "cate" : 5
    };

   $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/editar-inventario-equipo.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    ListaInventarioEquipo();
    $('#modalAgregarEquipo').modal('hide'); 

     }
     });

    
  }

  function AgregarManual(idEquipo){

  let Manual = document.getElementById("Manual");
  let File = Manual.files[0];
  let FilePath = Manual.value;

  var data = new FormData();
  var url = 'app/vistas/sgm/punto6/agregar-manual-inventario-equipo.php';

  if (FilePath != "") {

  data.append('idEquipo', idEquipo);
  data.append('File', File);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

  $('#modalContenido').load('app/vistas/sgm/punto6/modal-editar-equipo.php?idEquipo=' + idEquipo);
  ListaInventarioEquipo();

  });

  }else{
  $('#Manual').css('border','2px solid #A52525'); 
  }

  }

  function ManualEquipo(idEquipo){
  $('#modalAgregarEquipo').modal('show');  
  $('#modalContenido').load('app/vistas/sgm/punto6/modal-manual-equipo.php?idEquipo=' + idEquipo);
  }

  function btnDescargar(){
    window.location = "descargar-inventario-equipo-sgm";
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
    <div class="float-left"><h4>Inventario de equipo</h4></div>

    <div class="float-right">

    <a class="mr-2" onclick="btnDescargar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a> 

    <a class="mr-2" onclick="btnAgregarInventarioEquipo()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a> 

    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a> 

    </div>
    </div>
   
    <div class="card-body">

    <div id="ListaInventarioEquipo"></div>

    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalAgregarEquipo" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div id="modalContenido"></div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="myModal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0">
      <div class="modal-header">
      <h4 class="modal-title">Ayuda</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
        <div class="modal-body">
        <p>Realiza y mantén actualizado el inventario de equipos de medición para cumplir los requisitos metrológicos, esta actividad la debes registrar en el formato 011 que a continuación se desplega. Entre los equipos que debes de registrar te dejo como dato los siguientes:</p>

      <ul>
        <li>Tanques de almacenamiento</li>
        <li>Sondas de nivel</li>
        <li>Sondas de temperatura</li>
        <li>Dispensarios</li>
        <li>Jarras patrón</li>
        <li>Sistema de control de inventarios</li>
        <li>Cinta petrolera</li>
        <li>Termómetro</li>
        <li>Cronómetros, entre otros</li>
      </ul>
        </div>
      </div>
    </div>
  </div>

 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

