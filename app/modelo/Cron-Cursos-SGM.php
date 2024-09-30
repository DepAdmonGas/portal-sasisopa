<?php 
set_time_limit(12000);
ini_set('max_execution_time', 12000);
require ('../bd/inc.conexion.php');

date_default_timezone_set('America/Mexico_City');
$fecha_del_dia = date("Y-m-d");

if(isset($_GET['ValorCalendario'])){
if($_GET['ValorCalendario'] == '0'){

  $sql = "SELECT id FROM tb_estaciones WHERE numlista < 8 "; 
  $result = mysqli_query($con, $sql);
  $numero  = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  $idEstacion = $row['id'];
  PersonalEstacion($idEstacion,$fecha_del_dia,$con);
  }

}else{
  PersonalEstacion($_GET['ValorCalendario'],$fecha_del_dia,$con);
} 

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

  $sql = "SELECT id, confi_mes, confi_lista FROM tb_cursos_temas WHERE categoria = 'SGM' ORDER BY id ASC "; 
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

  $Fechainicio = $fechaAutorizacion;

  $Fecha = date("Y-m-d",strtotime($Fechainicio."+ $confiMes month")).'</br>';
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