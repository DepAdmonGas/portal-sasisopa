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
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>themes/default.rtl.css">
  <link href="<?=RUTA_CSS?>bootstrap.min.css" rel="stylesheet" />
  <link href="<?=RUTA_CSS?>navbar-general.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>alertify.css">
  <script type="text/javascript" src="<?php echo RUTA_JS ?>alertify.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  </head>

  <script type="text/javascript">
  $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");
  
 
  });

  function Regresar(){
 window.location.href = "../cursos";
  }

  function GuardarRespuesta(idCalendario,idTema,NumPregunta,Valor){

   var parametros = {
        "idCalendario" : idCalendario,
        "idTema" : idTema,
        "NumPregunta" : NumPregunta,
        "Valor" : Valor
      };

     $.ajax({
   data:  parametros,
   url:   '../public/cursos/modelo/editar-cursos-evaluacion.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

   }
   });

  }

  function Finalizar(idCalendario){

     var parametros = {
        "idCalendario" : idCalendario
      };

     alertify.confirm('',
    function(){

     $.ajax({
   data:  parametros,
   url:   '../public/cursos/modelo/finalizar-cursos-evaluacion.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response != 0){
    $('#ContenidoDiv').html(response);
    }else{
    $('#Mensaje').html('Falta completar la evaluación')
    }

    

   }
   });

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea finalizar la evaluación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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

   
    <div class="row">
    <div class="col-12">
     <h5>Evaluación, <?=$numtema.'. '.$titulo;?></h5>
    </div>

    </div>

    </div>
    </div>

  <hr>

<div id="ContenidoDiv">
<?php 

echo '<div class="row">';

$sqlPregunta = "SELECT * FROM tb_cursos_temas_preguntas WHERE id_tema = '".$idTema."' "; 
$resultPregunta = mysqli_query($con, $sqlPregunta);
$numeroPregunta  = mysqli_num_rows($resultPregunta);
while($rowPregunta = mysqli_fetch_array($resultPregunta, MYSQLI_ASSOC)){
echo '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12"><b>'.$rowPregunta['num_pregunta'].'.- '.$rowPregunta['titulo'].'</b>';
echo '<div class="p-3"><ol style="list-style-type:lower-alpha">';
$sqlRespuesta = "SELECT * FROM tb_cursos_temas_preguntas_respuestas WHERE id_pregunta = '".$rowPregunta['id']."' "; 
$resultRespuesta = mysqli_query($con, $sqlRespuesta);
$numeroRespuesta  = mysqli_num_rows($resultRespuesta);
while($rowRespuesta = mysqli_fetch_array($resultRespuesta, MYSQLI_ASSOC)){
echo '<li> <input type="radio" name="preg'.$rowPregunta['num_pregunta'].'" onclick="GuardarRespuesta('.$GET_idCalendario.','.$idTema.','.$rowPregunta['num_pregunta'].','.$rowRespuesta['valor'].')" > '.$rowRespuesta['titulo'].'</li>';

}
echo '</ol></div>';
echo '</div>';
}

echo '</div>';

?>

<div id="Mensaje" class="text-center text-danger"></div>
 <div class="text-end mt-2"><button class="btn btn-primary" type="button" onclick="Finalizar(<?=$GET_idCalendario;?>)">Finalizar evaluación</button></div>



  </div>
  </div> 
  </div> 

  </div>
  </div>

  </div> 


  <!---------- FUNCIONES - NAVBAR ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  

  <script src="<?=RUTA_JS ?>bootstrap.min.js"></script>

 
  </body>
  </html>