<?php
require('app/help.php');

$sql = "SELECT * FROM cu_temas ";
$query = mysqli_query($con, $sql);

$sql_modulos_cursos = "SELECT * FROM tb_cursos_modulos ORDER BY num_modulo ASC"; 
$result_modulos_cursos = mysqli_query($con, $sql_modulos_cursos);
$numero_modulos_cursos  = mysqli_num_rows($result_modulos_cursos);

function numTemasModulo($idModulo,$con){
$sql_temas_modulos = "SELECT num_tema FROM tb_cursos_temas WHERE id_modulo = '".$idModulo."' "; 
$result_temas_modulos = mysqli_query($con, $sql_temas_modulos);
return $numero_temas_modulos  = mysqli_num_rows($result_temas_modulos);
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

#Trabajadores{
  display: none;
}
 
.card-cursos-home{
border: 0px;
border-radius: 0;
box-shadow: 1px 1px 5px #EDEDED;
margin: 0px;
border-bottom: 4px solid #2975C1;
}
.card-cursos-disabled{

border: 0px;
border-radius: 0;
box-shadow: 1px 1px 5px #EDEDED;
margin: 0px;
border-bottom: 4px solid #979797;
background: rgba(204, 204, 204, 0.35);

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

  function BTNverModulos(idModulo){
  window.location.href = "capacitacion-interna-modulos/" + idModulo;
  }

  function ModalBuscar(){
  $('#ModalBuscar').modal('show');
  }

  function btnBuscar(){

  let BuscarYear = $('#BuscarYear').val();

  if (BuscarYear != "") {
  $('#BuscarYear').css('border','');

  $('#DivContenido').load('public/sasisopa/vistas/lista-capacitacion-interna-reporte.php?Year=' + BuscarYear);  
  $('#ModalBuscar').modal('hide');

  }else{
  $('#BuscarYear').css('border','2px solid #A52525');
  }

  }

  function Reconocimiento(id){
  window.open('descargar-reconocimiento/' + id, '_blank');
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
      <h4>CAPACITACIÓN INTERNA</h4>
    </div>

    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="ModalBuscar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Buscar" >
    <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png"; ?>">
    </a>
    </div>

    </div>
    <div class="card-body">

    <div id="DivContenido">

    <h5>Modulos</h5>
    <div class="row no-gutters">

<?php
while($row = mysqli_fetch_array($result_modulos_cursos, MYSQLI_ASSOC)){

$GET_idModulo = $row['id'];
$num_modulo = $row['num_modulo'];
$titulo = $row['titulo'];

$totalTemas = numTemasModulo($GET_idModulo,$con);

?>

<!-- CARD - PROCEDIMIENTOS -->
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2 "> 

<div class="" style="padding: 10px;" >
  <div class="card-cursos-float">
  <div class="card card-cursos-home" >
  <div class="card-body text-center">

  <h5 data-toggle="tooltip" data-placement="top" title="<?php echo $row['tema']; ?>"><?php echo $titulo; ?></h5>
  <div><a><a style="color: #1BB05F;font-size: 3.5em;font-weight: bold"><?php echo $totalTemas; ?></a> <a class="text-muted" style="font-size: .9em;">Temas</a></a></div>
  <div align="right"><button type="button" class="btn btn-outline-success btn-sm" onclick="BTNverModulos(<?php echo $GET_idModulo; ?>)" >Ver Temas</button></div>
  </div>
  </div>
  </div>
</div>

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
    </div>

           <div class="modal fade bd-example-modal-lg" id="ModalBuscar" data-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h5 class="modal-title">Buscar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">


        <div class="form-group">
         <label class="text-secondary" >Agregar Año: </label>
         <input type="text" class="form-control" name="" id="BuscarYear" style="border-radius: 0px;">
         </div>


        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnBuscar()">Buscar</button>
        </div>
      </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
