<?php
require('app/help.php');

$sql = "SELECT * FROM sgm_revision_procedimiento_registro WHERE id  = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$estado = $row['estado'];

function revision($idRegistro,$con){
$contenido = '';
$sql = "SELECT * FROM sgm_revision_procedimiento_registro WHERE id  = '".$idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'];
$fecha = $row['fecha'];
$hora = $row['hora'];
$lugar = $row['lugar'];

$contenido .= '<table class="table table-bordered table-sm">
<tr>
<td><b>Fecha:</b></td>
<td><b>Hora:</b></td>
<td><b>Lugar:</b></td>
</tr>

<tr>
<td class="p-0 m-0"><input class="form-control rounded-0 border-0" type="date" value="'.$fecha.'" onchange="editar(this,'.$id.',1)"></td>
<td class="p-0 m-0"><input class="form-control rounded-0 border-0" type="time" value="'.$hora.'" onchange="editar(this,'.$id.',2)"></td>
<td class="p-0 m-0"><input class="form-control rounded-0 border-0" type="text" value="'.$lugar.'" onkeyup="editar(this,'.$id.',3)"></td>
</tr>

</table>';

return $contenido; 
}

function detalleRevision($idRegistro,$categoria,$con){
$contenido = '';
$sql = "SELECT * FROM sgm_revision_procedimiento_registro_detalle WHERE id_revision  = '".$idRegistro."' AND categoria = '".$categoria."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$id = $row['id'];
$contenido .= '<div><h5>'.$row['pregunta'].'</h5></div>';
$contenido .= '<div><textarea class="form-control rounded-0 mb-3" onkeyup="editar(this,'.$id.',4)">'.$row['respuesta'].'</textarea></div>';
}
return $contenido;
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
  background: url('../imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
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

  function editar(e,id,seccion){

   var parametros = {
    "id" : id,
    "value" : e.value,
    "seccion" : seccion
    };

    $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/revision-sgm-procedimientos-registros/editar-revision-sgm.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

     }
     });
  }

  function finalizar(id){

   var parametros = {
     "id" : id,
    "value" : '',
    "seccion" : 5
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/revision-sgm-procedimientos-registros/editar-revision-sgm.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

      regresarP()

     }
     });
    
  },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea finalizar la resisión del SGM de la estación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
      <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SGM</li>
      <li aria-current="page" class="breadcrumb-item active">Revisión del SGM, procedimientos y registros</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>Revisión del SGM, procedimientos y registros</h3>

      <div class="bg-white p-3 mt-3">

        <?php  
        echo revision($GET_idRegistro,$con);
        ?>
        <h4 class="text-info">SGM</h4>
        <?php  
        echo detalleRevision($GET_idRegistro,'SGM',$con);
        ?>
        <hr>
        <h4 class="mt-2 text-info">Procedimientos</h4>
        <?php  
        echo detalleRevision($GET_idRegistro,'Procedimientos',$con);
        ?>
        <hr>
        <h4 class="mt-2 text-info">Registros</h4>
        <?php  
        echo detalleRevision($GET_idRegistro,'Registros',$con);

        if($estado == 0){
        echo '<div class="text-end"><button type="button" class="btn btn-primary rounded-0" onclick="finalizar('.$GET_idRegistro.')" >Finalizar Revisión del SGM</button></div>';
        }
        ?>

      </div>

     </div>
       
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
