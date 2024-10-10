<?php
require('app/help.php');

$sql = "SELECT * FROM sgm_seguimiento_objetivo_indicador WHERE id = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$fecha = $row['fecha'];
$hora = $row['hora'];
$lugar = $row['lugar'];
}else{
$fecha = '';
$hora = '';
$lugar = '';
}

$sql_sgm = "SELECT * FROM sgm_seguimiento_implementacion_sgm WHERE id_seguimiento = '".$GET_idRegistro."' ";
$result_sgm = mysqli_query($con, $sql_sgm);
$numero_sgm = mysqli_num_rows($result_sgm);
if ($numero_sgm > 0) {
$row_sgm = mysqli_fetch_array($result_sgm, MYSQLI_ASSOC);
$S11 = $row_sgm['respuesta_uno'];
$S12 = $row_sgm['respuesta_dos'];
$S13 = $row_sgm['respuesta_tres'];
$S14 = $row_sgm['respuesta_cuatro'];
}else{
$S11 = "";
$S12 = "";
$S13 = "";
$S14 = "";
}

$sql_ce = "SELECT * FROM sgm_seguimiento_calibracion_equipo WHERE id_seguimiento = '".$GET_idRegistro."' ";
$result_ce = mysqli_query($con, $sql_ce);
$numero_ce = mysqli_num_rows($result_ce);
if ($numero_ce > 0) {
$row_ce = mysqli_fetch_array($result_ce, MYSQLI_ASSOC);
$S21 = $row_ce['respuesta_uno'];
$S22 = $row_ce['respuesta_dos'];
$S23 = $row_ce['respuesta_tres'];
}else{
$S21 = "";
$S22 = "";
$S23 = "";
}

$sql_sc = "SELECT * FROM sgm_seguimiento_satisfaccion_cliente WHERE id_seguimiento = '".$GET_idRegistro."' ";
$result_sc = mysqli_query($con, $sql_sc);
$numero_sc = mysqli_num_rows($result_sc);
if ($numero_sc > 0) {
$row_sc = mysqli_fetch_array($result_sc, MYSQLI_ASSOC);
$S31 = $row_sc['respuesta_uno'];
$S32 = $row_sc['respuesta_dos'];
$S33 = $row_sc['respuesta_tres'];
$S34 = $row_sc['respuesta_cuatro'];
$S35 = $row_sc['respuesta_cinco'];
}else{
$S31 = "";
$S32 = "";
$S33 = "";
$S34 = "";
$S35 = "";
}


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
  <link rel="stylesheet" href="<?=RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">

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
  background: white;
  background: url('../imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  $('.selectpicker').selectpicker();

  ListaAsistentes(<?=$GET_idRegistro;?>)

  });


  function regresarP(){
  window.history.back();
  }

  function ListaAsistentes(idRegistro){ 
  $('#ListaAsistentes').load('../app/vistas/sgm/punto4/lista-asistentes.php?idRegistro=' + idRegistro);
  }

  function btnGuardarFirma(idRegistro){

    let PersonalFirma = $('#PersonalFirma').val();

      var parametros = {
    "idRegistro" : idRegistro,
    "PersonalFirma" : PersonalFirma
    };

    if(PersonalFirma != ""){
    $('#borderdirigidoa').css('border',''); 

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto4/agregar-asistente-seguimiento-indicadores.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaAsistentes(idRegistro)
    }else{
    alertify.error('Error al agregar')
    }

     }
     });

    }else{
   $('#borderdirigidoa').css('border','2px solid #A52525');
  }

  }

  function EliminarAsistente(idRegistro,id){

  var parametros = {
    "id" : id
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto4/eliminar-asistente-objetivos-indicadores.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaAsistentes(idRegistro)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar el asistente?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }

  function btnFinalizar(idRegistro){

  let fecha = $('#fecha').val();
  let hora = $('#hora').val();
  let lugar = $('#lugar').val();

  if(fecha != ""){
  $('#fecha').css('border','');
  if(hora != ""){
  $('#hora').css('border',''); 
  if(lugar != ""){
  $('#lugar').css('border',''); 

  var parametros = {
  "idRegistro" : idRegistro,
  "fecha" : fecha,
  "hora" : hora,
  "lugar" : lugar
  };


   alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto4/finalizar-asistente-objetivos-indicadores.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    regresarP()
    }else{
    alertify.error('Error al finalizar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea finalizar el seguimiento de objetivos e indicadores?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  
  }else{
  $('#lugar').css('border','2px solid #A52525'); 
  }
  }else{
  $('#hora').css('border','2px solid #A52525'); 
  }
  }else{
  $('#fecha').css('border','2px solid #A52525'); 
  }

  }

  function editar(e,idRegistro,seccion,campo){

  var parametros = {
  "value" : e.value,
  "idRegistro" : idRegistro,
  "seccion" : seccion,
  "campo" : campo
  };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto4/editar-seguimiento-objetivo-indicadores.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

     }
     });

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
      <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
      <ol class="breadcrumb breadcrumb-caret">
      <li class="breadcrumb-item text-primary c-pointer" onclick="window.history.go(-2);"><i class="fa-solid fa-house"></i> SGM</li>
      <li aria-current="page" class="breadcrumb-item c-pointer" onclick="regresarP()">4. Establecimiento de objetivos enfocados al cliente</li>
      <li aria-current="page" class="breadcrumb-item active">Fo.SGM.004 Seguimiento de objetivos e indicadores</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>Fo.SGM.004 Seguimiento de objetivos e indicadores</h3>

      <div class="bg-white mt-3 p-3">
      <div class="row">
         <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2 mb-2">
           <div>Fecha:</div>
           <input class="form-control rounded-0" type="date" id="fecha" value="<?=$fecha;?>">
         </div>
         <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2 mb-2">
           <div>Hora:</div>
           <input class="form-control rounded-0" type="time" id="hora" value="<?=$hora;?>">
         </div>
         <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2 mb-2">
           <div>Lugar:</div>
           <input class="form-control rounded-0" type="text" id="lugar" value="<?=$lugar;?>">
         </div> 
      </div>

      <table class="table table-sm table-bordered">
        <tr>
          <td class="bg-light" colspan="2"><h5>Indicador: Implementacion del SGM</h5></td>
        </tr>
        <tr>
          <td>Porcentaje de procedimientos implementados durante el año inmediato anterior</td>
          <td class="p-0"><input type="number" class="form-control rounded-0 border-0" value="<?=$S11;?>" onchange="editar(this,<?=$GET_idRegistro;?>,1,1)"></td>
        </tr>
        <tr>
          <td>Porcentaje de procedimientos documentados durante el año inmediato anterior</td>
          <td class="p-0"><input type="number" class="form-control rounded-0 border-0" value="<?=$S12;?>" onchange="editar(this,<?=$GET_idRegistro;?>,1,2)"></td>
        </tr>
        <tr>
          <td colspan="2">Comentarios y observacines:</td>
        </tr>
        <tr>
          <td class="p-0" colspan="2"><textarea class="form-control border-0 rounded-0" onkeyup="editar(this,<?=$GET_idRegistro;?>,1,3)"><?=$S13;?></textarea></td>
        </tr>
        <tr>
          <td colspan="2">En caso de no obtener resultados favorables, describa las acciones a tomar junto con los recursos que necesita con la finalidad de cambiar los resultados obtenidos para la siguiente evaluacion</td>
        </tr>
        <tr>
          <td class="p-0" colspan="2"><textarea class="form-control border-0 rounded-0" onkeyup="editar(this,<?=$GET_idRegistro;?>,1,4)"><?=$S14;?></textarea></td>
        </tr>
      </table>

      <table class="table table-sm table-bordered">
        <tr>
          <td class="bg-light" colspan="2"><h5>Indicador: Calibracion de equipos</h5></td>
        </tr>
        <tr>
          <td>Porcentaje de quipos calibrados durante el año <?=$fecha_year;?></td>
          <td class="p-0"><input type="number" class="form-control rounded-0 border-0" value="<?=$S21;?>" onchange="editar(this,<?=$GET_idRegistro;?>,2,1)"></td>
        </tr>
        <tr>
          <td colspan="2">Comentarios y observacines:</td>
        </tr>
        <tr>
          <td class="p-0" colspan="2"><textarea class="form-control border-0 rounded-0" onkeyup="editar(this,<?=$GET_idRegistro;?>,2,2)"><?=$S22;?></textarea></td>
        </tr>
        <tr>
          <td colspan="2">En caso de no obtener resultados favorables, describa las acciones a tomar junto con los recursos que necesita con la finalidad de cambiar los resultados obtenidos para la siguiente evaluacion</td>
        </tr>
        <tr>
          <td class="p-0" colspan="2"><textarea class="form-control border-0 rounded-0" onkeyup="editar(this,<?=$GET_idRegistro;?>,2,3)"><?=$S23;?></textarea></td>
        </tr>
      </table>

      <table class="table table-sm table-bordered">
        <tr>
          <td class="bg-light" colspan="2"><h5>Indicador: Satisfaccion del cliente</h5></td>
        </tr>
        <tr>
          <td>Numero de quejas por parte de los clientes</td>
          <td class="p-0"><input type="number" class="form-control rounded-0 border-0" value="<?=$S31;?>" onchange="editar(this,<?=$GET_idRegistro;?>,3,1)"></td>
        </tr>
        <tr>
          <td>Numero de quejas atendidas de manera satisfactoria </td>
          <td class="p-0"><input type="number" class="form-control rounded-0 border-0" value="<?=$S32;?>" onchange="editar(this,<?=$GET_idRegistro;?>,3,2)"></td>
        </tr>
        <tr>
          <td>Si ya se cuenta con resultados del año inmediato anterior determinar el procentaje que representan las quejas del año inmediato anterior contra los resultados con los que cuenta la estacion de servicio </td>
           <td class="p-0"><input type="number" class="form-control rounded-0 border-0" value="<?=$S33;?>" onchange="editar(this,<?=$GET_idRegistro;?>,3,3)"></td>
        </tr>
        <tr>
          <td colspan="2">Comentarios y observacines:</td>
        </tr>
        <tr>
          <td class="p-0" colspan="2"><textarea class="form-control border-0 rounded-0" onkeyup="editar(this,<?=$GET_idRegistro;?>,3,4)"><?=$S34;?></textarea></td>
        </tr>
        <tr>
          <td colspan="2">En caso de no obtener resultados favorables, describa las acciones a tomar junto con los recursos que necesita con la finalidad de cambiar los resultados obtenidos para la siguiente evaluacion </td>
        </tr>
        <tr>
          <td class="p-0" colspan="2"><textarea class="form-control border-0 rounded-0" onkeyup="editar(this,<?=$GET_idRegistro;?>,3,5)"><?=$S35;?></textarea></td>
        </tr>
      </table>

      <div class="row">
         <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2 mb-2">
          <div class="border p-3">
            <h5 class="text-secondary">Asistentes</h5>

            <div id="ListaAsistentes"></div>
          </div>           
         </div>
      </div>

      <div class="text-end mb-2">
      <button type="button" class="btn btn-success rounded-0 mt-3" onclick="btnFinalizar(<?=$GET_idRegistro;?>)">Finalizar registro</button>
      </div>
      </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  <script src="<?=RUTA_JS?>bootstrap-select.min.js"></script>
  </body>
  </html>
