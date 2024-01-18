<?php 
require('app/help.php');

$sql = "SELECT id_tema, estado FROM tb_cursos_calendario WHERE id = '".$GET_idCalendario."' "; 
$result = mysqli_query($con, $sql);
$numero  = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$idTema = $row['id_tema'];
$estado = $row['estado'];
}

if($estado == 1){
header('Location: '.SERVIDOR.'cursos');
}

$sqlTema = "SELECT * FROM tb_cursos_temas WHERE id = '".$idTema."' "; 
$resultTema = mysqli_query($con, $sqlTema);
$numeroTema  = mysqli_num_rows($resultTema);
while($rowTema = mysqli_fetch_array($resultTema, MYSQLI_ASSOC)){
$numtema = $rowTema['num_tema'];
$titulo = $rowTema['titulo'];
$archivo = $rowTema['archivo'];
}

?>
<!DOCTYPE html>
<html lang="es">
  
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Portal AdmonGas</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS ?>/icono-web.png">
  <link href="<?=RUTA_CSS2;?>bootstrap.min.css" rel="stylesheet" />
  <link href="<?=RUTA_CSS2;?>navbar-general.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  </head>

  <script type="text/javascript">
  $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");

  });
 
  function Regresar(){
  window.history.back();
  }

  function IniciarEvaluacion(idCalendario){

  window.location.href = "../cursos-temas-evaluacion/" + idCalendario; 

  }

  </script>

  <body>
  <div class="LoaderPage"></div>

  <!---------- CONTENIDO DE PAGINA WEB ----------> 
  <div id="content">

  <!---------- NAV BAR (TOP) ---------->  
  <?php require('public/navbar/navbar-perfil.php');?>

  <div class="contendAG">    
  <div class="row"> 

  <div class="col-12 mb-2">
  <div class="cardAG border-0 p-3"> 

    <div class="row">
    <div class="col-12">

    <img class="float-start pointer" src="<?=RUTA_IMG_ICONOS;?>regresar.png" onclick="Regresar()">
    
    <div class="row">
    <div class="col-12">
     <h4><?=$numtema?>. <?=$titulo?></h4>
    </div>

    </div>

    </div>
    </div>


  <embed src="../archivos/cursos/<?=$archivo;?>#toolbar=0&navpanes=0&scrollbar=0&zoom=75" type="application/pdf" width="100%" height="750px" />

    <div class="text-end mt-2"><button class="btn btn-primary" type="button" onclick="IniciarEvaluacion(<?=$GET_idCalendario;?>)">Inciar evaluación</button></div>

  </div> 
  </div> 

  </div>
  </div>

  </div> 


  <!---------- FUNCIONES - NAVBAR ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  

  <script src="<?=RUTA_JS2 ?>bootstrap.min.js"></script>

 
  </body>
  </html>