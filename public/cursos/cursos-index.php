<?php 
require('app/help.php');
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
  
  listaCursos();
  listaPendientes();
  
  });

  function listaCursos(){
  $('#DivListaCursos').load('public/cursos/vistas/lista-cursos.php');    
  }

  function listaPendientes(){
  $('#DivListaCursosPersonal').load('public/cursos/vistas/lista-temas-pendientes.php');    
  }

  function detalleModulo(idModulo){
  window.location.href = "cursos-temas/" + idModulo;  
  }

  function IniciarTema(id){

  window.location.href = "cursos-temas-iniciar/" + id; 

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

    <?php if($session_idpuesto == 9){

    }else{
     echo '<a href="'.SERVIDOR.'"><img class="float-start pointer" src="'.RUTA_IMG_ICONOS.'regresar.png"></a>'; 
    } ?>
        
    <div class="row">
    <div class="col-12">
     <h5>Cursos</h5>
    </div>

    </div>

    </div>
    </div>

  <hr>

  <!---------- VISUALIZACION DE CURSOS (VISTA) ---------->  
  <div id="DivListaCursos" class="cardAG"></div>

  <div id="DivListaCursosPersonal" class="cardAG"></div>

  <?php 
date_default_timezone_set('America/Mexico_City');
$YearNuevo = date("Y");

$sql = "SELECT id, fecha_autorizacion FROM tb_estaciones WHERE numlista <= 8 ORDER BY numlista ASC"; 
  $result = mysqli_query($con, $sql);
  $numero  = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  $idEstacion = $row['id'];
  $fechaAutorizacion = $row['fecha_autorizacion'];
  $explode = explode("-", $row['fecha_autorizacion']);

  //PersonalEstacion($idEstacion,$YearNuevo,$con);

  }

  function PersonalEstacion($idEstacion,$fechaAutorizacion,$con){

  $sql = "SELECT id FROM tb_usuarios WHERE id_gas = '".$idEstacion."' AND estatus = 0"; 
  $result = mysqli_query($con, $sql);
  $numero  = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  $idPersonal = $row['id'];

  CursosTemas($idEstacion,$idPersonal,$fechaAutorizacion,$con); 

  }
  }

  function CursosTemas($idEstacion,$idPersonal,$fechaAutorizacion,$con){


  $sql = "SELECT id, confi_mes, confi_lista FROM tb_cursos_temas ORDER BY id ASC "; 
  $result = mysqli_query($con, $sql);
  $numero  = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

  $idTema = $row['id'];
  $confiMes = $row['confi_mes'];
  $confiLista = $row['confi_lista']; 

  $SumMes = SumMes($fechaAutorizacion, $confiMes);

  $Year = $SumMes['YearOption'];
  $Mes = $SumMes['MesOption'];

  ValidaFecha($idEstacion,$idPersonal,$idTema,$Year,$Mes,$confiLista,$con);

  }
  }

  function SumMes($fechaAutorizacion, $confiMes){

  $Fechainicio = $fechaAutorizacion."-01-01";

  $Fecha = date("Y-m-d",strtotime($Fechainicio."+ $confiMes month"));
  $Explode = explode("-", $Fecha);

  $YearOption = $Explode[0];
  $MesOption = $Explode[1];

  $result = array('YearOption' => $YearOption, 'MesOption' => $MesOption);

  return $result;
  }

  function ValidaFecha($idEstacion,$idPersonal,$idTema,$Year,$Mes,$confiLista,$con){

    $Date = new DateTime($Year.'-'.$Mes.'-01');
    $Date->modify('t');
    

    if($confiLista == 0){
    $DiaInicio = 1;
    $DiaTermino = $Date->format('t');
    }else if($confiLista == 1){
    $DiaInicio = 1;
    $DiaTermino = 15;
    }else if($confiLista == 2){
    $DiaInicio = 16;
    $DiaTermino = $Date->format('t');
    }

    Guarda($idEstacion,$idPersonal,$idTema,$DiaInicio,$DiaTermino,$Year,$Mes,$con);

  }

  function Guarda($idEstacion,$idPersonal,$idTema,$DiaInicio, $DiaTermino,$Year,$Mes,$con){

    $porcentaje = array(
    80,
    100
    );

    $num = rand(0,1);

   $Fecha = FechaAleatorio($DiaInicio,$DiaTermino,$Year,$Mes);

   $sql_insert = "INSERT INTO tb_cursos_calendario (
    fecha_programada,
    fecha_real,
    id_estacion,
    id_personal,
    id_tema,
    resultado,
    observaciones,
    estado
    )
    VALUES 
    (
    '".$Fecha."',
    '', 
    '".$idEstacion."',
    '".$idPersonal."',
    '".$idTema."',
    0,
    '',
    0
    )";
    mysqli_query($con, $sql_insert);
  }

  function FechaAleatorio($DiaInicio,$DiaTermino,$Year,$Mes){
  $Aleatorio = rand($DiaInicio, $DiaTermino);
  return $Fecha = $Year.'-'.$Mes.'-'.$Aleatorio;
  }

?>

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