<?php
require('app/help.php');

$result_modulo = $ClassCursos->NombreModuloEvaluacion($idModulo, $con);
$modulodescripcion = $result_modulo['descripcion'];

$result_modulo = $ClassCursos->NumeroDiapositivasModulo($idModulo, $con);
$Val_moduloID = $result_modulo['idmodulo'];
$Val_Diapositivas = $result_modulo['diapositivas'];

$sql = "SELECT cu_evaluacion_modulos.id,cu_evaluacion_modulos.id_evaluacion_tema,cu_evaluacion_modulos.id_modulo,cu_evaluacion_modulos.num_modulo,cu_evaluacion_modulos.estado, cu_modulos.id_tema, cu_modulos.descripcion
          FROM cu_evaluacion_modulos
          INNER JOIN cu_modulos ON cu_evaluacion_modulos.id_modulo = cu_modulos.id where cu_evaluacion_modulos.id_evaluacion_tema = '".$idTema."' ";
$query = mysqli_query($con, $sql);
while($row_tema = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
$row_tema = $row_tema['id_tema'];
}

$Val_idEvaluacion = $idModulo;
$Val_idTema = $idTema;

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <style type="text/css">
.adm-card{
 border: 0;
 box-shadow: 1px 1px 5px #EDEDED;
 margin: 20px;
}
.adm-car-title{
 width: 100%;
 border-bottom: 2px solid #5d84c3;
 padding-left: 20px;
 padding-right: 20px;
 padding-top: 10px;
 padding-bottom: 10px;
}
 </style>
  <script type="text/javascript">

 function mayus(e) {
     e.value = e.value.toUpperCase();
     }


   $(document).ready(function($){

   var ventana_ancho = $(window).width();
   var ventana_alto = $(window).height();

   $('#DivPrincipal').css('width',ventana_ancho);
   $('#DivPrincipal').css('height',ventana_alto);

   });

   function regresarP(){
    window.history.back();
   }
  
function VerDiapositiva(idModulo, num_diapositiva){

 if (num_diapositiva > <?php echo $Val_Diapositivas; ?>) {

 $('#DivPrincipal').load('../../public/cursos/ver-evaluacion-modulo.php?idModulo=' + idModulo + '&idTema=<?=$Val_idTema;?>&valEvaluacion=<?=$Val_idEvaluacion;?>');
 }else{
 
 $('#DivPrincipal').load('../../public/cursos/ver-diapositiva-modulo.php?numDiapositiva=' + num_diapositiva + '&idModulo=' + idModulo + '&idTema=<?=$Val_idTema;?>');
 }
 }
  </script>
  </head>
  <body>

  <div id="DivPrincipal">
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
  <div class="float-left"><h4><?php echo $modulodescripcion;?></h4></div>
  </div>
  <div class="card-body">

     <?php if ($Val_Diapositivas != 0) {

     ?>
  <div class="text-center" style="padding-top: 40px;">
   <img src="<?php echo RUTA_IMG_ICONOS."iniciar.png"; ?>" style="cursor: pointer;" onclick="VerDiapositiva(<?php echo $Val_moduloID; ?> , 1)">
   <p class="font-weight-bold" style="padding-top: 20px;">Iniciar el Módulo</p>
   </div>
     <?php
     }else{
     ?>
     <div class="text-center" style="padding-top: 40px;">
     <p class="text-secondary" style="padding-top: 20px;">Por el momento el modulo no está disponible intente más tarde</p>
     </div>
     <?php
     }
     ?>


  </div>
  </div>
  </div>
  </div>

  </div>
</div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
