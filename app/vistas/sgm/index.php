<?php
require('app/help.php');
$Diastrto = strtotime($fecha_del_dia);
function validaDocumento($nombre,$idEstacion,$con){

      $sql_lista = "SELECT 
      sgm_control_documental.id,
      sgm_control_documental.id_documento,
      sgm_control_documental.id_estacion,
      sgm_control_documental.fecha,
      sgm_control_documental.archivo,
      sgm_documentos.nombre
      FROM sgm_control_documental 
      INNER JOIN sgm_documentos 
      ON sgm_control_documental.id_documento = sgm_documentos.id WHERE 
      sgm_documentos.nombre = '".$nombre."' AND id_estacion = '".$idEstacion."'  ORDER BY sgm_control_documental.fecha DESC LIMIT 1";
        $result_lista = mysqli_query($con, $sql_lista);
        $numero_lista = mysqli_num_rows($result_lista);
        if($numero_lista > 0){
          $row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC);
          $array = array('archivo' => $row_lista['archivo']);
        }else{
          $array = array('archivo' => 0);
        }        
        return $array;
      }

      $SGM = validaDocumento('Sistema de Gestion de Medicion',$Session_IDEstacion,$con);
      $MPSGM = validaDocumento('Manual de procedimientos del Sistema de Gestión de Medición',$Session_IDEstacion,$con);

      if($SGM['archivo'] == 0){
        $url_sgm = '';
      }else{
        $url_sgm = RUTA_ARCHIVOS_SGM.$SGM['archivo'];
      }

      if($MPSGM['archivo'] == 0){
        $url_mpsgm = '';
      }else{
        $url_mpsgm = RUTA_ARCHIVOS_SGM.$MPSGM['archivo'];
      }


?>

<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SGM</title>
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
  <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-messaging.js"></script>

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


  <style type="text/css">
body {
    background: #F3F6FA;
}

a,
a:hover,
a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.pointer:hover{
cursor: pointer;
}

.navbar {
    padding: 15px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

.wrapper {
    display: flex;
    width: 100%;
}

#sidebar {
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 999;
    background: #215d98;
    color: #fff;
    transition: all 0.3s;
    font-size: 0.80em;
}

#sidebar.active {
    margin-left: -250px;
}

#sidebar .sidebar-header {
    padding: 11px 20px 10px 20px;
    background: white;
}

#sidebar ul.components {
    border-bottom: 1px solid #5d84c3;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}

#sidebar ul li a:hover {
    color: white;
    background:#5d84c3;
}

#sidebar ul li.active>a,
a[aria-expanded="true"] {
    color: #fff;
    background: #5d84c3;
}

a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #215d98;
}

.menu-text {
   color: black;
   font-size: 24px;
   font-weight: bold;
   position: relative;
   top: 11px;
   left:5px;
}
.menu-btn {
    background: #5d84c3;
    margin-top: 10px;
    margin-left: 10px;
    color: white;
    padding: 6px;
    border: 0px;
}
.menu-header {
    height:70px;
}
/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */
#content {
    width: calc(100% - 250px);
    min-height: 100vh;
    transition: all 0.3s;
    position: absolute;
    top: -64px;
    right: 0;
}

.divPrincipal{
width: calc(100% - 220px);
padding-left: 15px;
}

#content.active {
    width: 100%;
}

/* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */

@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
    #content {
        width: 100%;
    }
    #content.active {
        width: calc(100% - 250px);
    }

    .divPrincipal{
        width: 86%;
    }
 
}



.cursor{
    cursor: pointer;
}
/*---- CALENDARIO ----*/
 .calendar-day, .calendar-day-head{
    border: 1px solid #ddd;
    }

  .calendar-day-head{
    background: #ddd;
    font-size: .9em
  }

.calendar-day-np{
    background: #F5F5F5;
    border: 1px solid #ddd;
}

.yes-day{
  background: #5B9FFC;
  color: white;  
}

.style-day{
padding: 6px;
}

.td-efect:hover{
    background: #5B9FFC;
    color: white;
}

.contendAG {
        margin-top: 40px;
        padding: 18px;
}
  </style>

<script type="text/javascript">

  $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");
  elementos();
  });

  function elementos(){
  $('#DivElementosSGM').load('app/vistas/sgm/elementos-sgm.php');
  document.getElementById("DivCalendario").style.display = "none";
  document.getElementById("DivElementosSGM").style.display = "block";
  }

  function homeCalendario(Fecha,mes,year){
 document.getElementById("DivElementosSGM").style.display = "none";
 document.getElementById("DivCalendario").style.display = "block";
 Actividades(Fecha,0);
 Calendario(Fecha,mes,year); 
}

function Actividades(Fecha,opcion){
$('#Actividades').load('app/vistas/sgm/calendario/contenido-actividades.php?fecha=' + Fecha + '&opcion=' + opcion);
} 

function Calendario(Fecha,mes,year){
 $('#Calendario').load('app/vistas/sgm/calendario/contenido-calendario.php?fecha=' + Fecha + '&Mes=' + mes + '&Year=' + year); 
}

function punto1(){window.location.href = 'estructura-sistema-medicion';}
function punto2(){window.location.href = 'control-documental-sistema-gestion-medicion';}
function punto3(){window.location.href = 'responsabilidades-direccion';}
function punto4(){window.location.href = 'establecimiento-objetivos-enfocados-cliente';}
function punto5(){window.location.href = 'normatividad-aplicable-mediciones';}
function punto6(){window.location.href = 'gestion-recursos';}
function punto7(){window.location.href = 'procesos-medicion';}
function punto8(){window.location.href = 'gestion-riesgos-impactan-medicion';}
function punto9(){window.location.href = 'establecimiento-seguimiento-confirmacion-metrologica';}
function punto10(){window.location.href = 'auditorias-internas-externas-atencion-hallazgos';}
function punto11(){window.location.href = 'evaluacion-cumplimiento-objetivos-revision-direccion';}
function sasisopa(){window.history.back();}
function Personal(){window.location.href = "lista-personal-sgm";}

  </script>
  </head>
  <body>

  <div class="LoaderPage"></div>
  <div class="wrapper">
<!---------- BARRA DE NAVEGACION ---------->
<nav id="sidebar">

    <div class="sidebar-header text-center">
    <img class="" src="<?=RUTA_IMG_LOGOS."Logo.png";?>" style="width: 100%;">
    </div>

    <ul class="list-unstyled components">
    <li>
    <a class="pointer" onclick="homeCalendario(<?=$Diastrto;?>,<?=$fecha_mes;?>,<?=$fecha_year;?>)">Calendario de actividades </a>
    </li>     
    <li>
    <a class="pointer" onclick="elementos()">Elementos SGM </a>
    </li> 
    <li>
    <a class="pointer" href="<?=$url_sgm;?>">Sistema de Gestión de Medición</a>
    </li>
    <li>
    <a class="pointer" href="<?=$url_mpsgm;?>">Manual de procedimientos del SGM</a>
    </li> 
    <li>
    <a class="pointer" href="<?php echo RUTA_PERFIL; ?>">Usuario</a>
    </li>  
    <li>
    <a class="pointer" onclick="Personal()">Lista personal</a>
    </li> 
    <li>
    <a class="pointer" onclick="sasisopa()">SASISOPA</a>
    </li>    
    </ul>
   </nav>  
 
  <div id="content">
  
<div class="sticky-top menu-header">                
<button type="button" id="sidebarCollapse" class="btn menu-btn">
<img src="<?php echo RUTA_IMG_ICONOS; ?>icon-menu.png" alt="Menu">
</button>
<a class="menu-text pt-2">SGM (<?=$Session_Razonsocial;?>)</a>
</div>

<div class="contendAG">

<div class="row"> 

<div class="col-12">
<div id="DivElementosSGM" class="cardAG"></div> 
</div>

<div class="col-12">
       
<div id="DivCalendario">        
<div class="row">

<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
<div id="Actividades"></div>
</div>

<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
<div class="cardAG" id="Calendario"></div>
</div>

</div>
</div>


</div>
</div>

</div>

</div>    
</div>

 <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
 <!---------- FUNCIONES BARRA DE NAVEGACION ---------->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function () {
  $("#sidebar").mCustomScrollbar({
  theme: "minimal"
  });
  
  $('#sidebarCollapse').on('click', function () {
  $('#sidebar, #content').toggleClass('active');
  $('.collapse.in').toggleClass('in');
  $('a[aria-expanded=true]').attr('aria-expanded', 'false');
  });
  });
  </script>

  </body>
  </html>
