<?php
require('app/help.php');

$sql_sasisopa_ayuda = "SELECT * FROM pu_sasisopa_ayuda WHERE id_usuario = '".$Session_IDUsuarioBD."' and detalle = '17-revision-resultados' and estado = 0 LIMIT 1";
$result_sasisopa_ayuda = mysqli_query($con, $sql_sasisopa_ayuda);
$numero_sasisopa_ayuda = mysqli_num_rows($result_sasisopa_ayuda);

if ($numero_sasisopa_ayuda == 1) {
while($row_ayuda = mysqli_fetch_array($result_sasisopa_ayuda, MYSQLI_ASSOC)){
$idAyuda = $row_ayuda['id'];
}
}else{
$idAyuda = 0;
}

function Meta($idEstacion,$idObjeto,$con){

$sql_medicion = "SELECT * FROM tb_medicion_indicadores WHERE id_estacion = '".$idEstacion."' AND objeto = '".$idObjeto."' ORDER BY id DESC LIMIT 1 ";
$result_medicion = mysqli_query($con, $sql_medicion);
$numero_medicion = mysqli_num_rows($result_medicion);
while($row_medicion = mysqli_fetch_array($result_medicion, MYSQLI_ASSOC)){
$meta = $row_medicion['meta'];
}
return $meta;
}

function ResultadoImplementacion($Session_IDEstacion,$Year,$con){
$sql_implementacion = "SELECT * FROM tb_implementacionsa WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fecha) = '".$Year."' ";
$result_implementacion = mysqli_query($con, $sql_implementacion);
$numero_implementacion = mysqli_num_rows($result_implementacion);

if ($numero_implementacion > 0) {
while($row_implementacion = mysqli_fetch_array($result_implementacion, MYSQLI_ASSOC)){
$calificacion = $calificacion + $row_implementacion['puntos'];
}
$Resultado = $calificacion / $numero_implementacion;
if($Resultado >= 60  && $Resultado <= 100){
$title = "<b class='text-success'>".$Resultado."% Excelente</b>";                
}else if($Resultado >= 0 && $Resultado <= 59){
$title = "<b class='text-warning'>".$Resultado."% Regular</b>";               
}
}else{
$title = "<b>S/I</b>"; 
}
return $title;
}


function Ventas($Session_IDEstacion,$mes,$year,$con){

$sql_reporte = "SELECT id FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' AND mes = '".$mes."' AND year = '".$year."' ";
$result_reporte = mysqli_query($con, $sql_reporte);
$numero_reporte = mysqli_num_rows($result_reporte);
while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
$idReporte = $row_reporte['id'];
}
$ventas = 0;
$sql_reporte_mes = "SELECT volumen_venta FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."'  ";
$result_reporte_mes = mysqli_query($con, $sql_reporte_mes);
$numero_reporte_mes = mysqli_num_rows($result_reporte_mes);
while($row_reporte_mes = mysqli_fetch_array($result_reporte_mes, MYSQLI_ASSOC)){

$ventas = $ventas + $row_reporte_mes['volumen_venta'];
}

return $ventas;
}

function ResultadoCapacitacion($Session_IDEstacion,$Year,$Semestre,$con){


if($Semestre == 1){
$Rango = 'AND (MONTH(fecha_programada) >= 1 AND MONTH(fecha_programada) <= 6)';
}else if($Semestre == 2){
$Rango = 'AND (MONTH(fecha_programada) >= 7 AND MONTH(fecha_programada) <= 12)';  
}

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."'  ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$idUsuario = $row_usuarios['id'];


$sql_detalle = "SELECT * FROM tb_cursos_calendario WHERE id_personal = '".$idUsuario."' AND YEAR(fecha_programada) = '".$Year."' $Rango  GROUP BY fecha_programada   ";
$result_detalle = mysqli_query($con, $sql_detalle);
$numero_detalle = mysqli_num_rows($result_detalle);

$SumD = $SumD + $numero_detalle;
while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
$Total = $Total + $row_detalle['resultado'];

}

}

if($SumD == 0){
$title = "<b class='text-warning'>S/I</b>";
}else{
$Porcentaje = $Total / $SumD;
$calificacion = number_format($Porcentaje,2);

if( $calificacion >= 60  && $calificacion <= 100){
$title = "<b class='text-success'>".$calificacion."% Excelente</b>";
                    
}else if($calificacion >= 0 && $calificacion <= 59){
$title = "<b class='text-warning'>".$calificacion."% Regular</b>";
                    
}

}
  return $title;
}
function ResultadoSatisfaccion($Session_IDEstacion,$Year,$Semestre,$con){

if($Semestre == 1){
$Rango = 'AND (MONTH(fechacreacion) >= 1 AND MONTH(fechacreacion) <= 6)';
}else if($Semestre == 2){
$Rango = 'AND (MONTH(fechacreacion) >= 7 AND MONTH(fechacreacion) <= 12)';  
}

$sql_encuesta = "SELECT * FROM tb_encuentas_estacion WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fechacreacion) = '".$Year."' $Rango ORDER BY fechacreacion DESC LIMIT 1 ";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);
while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){

$IdReporte = $row_encuesta['id'];

$sql_encuesta = "SELECT id FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$IdReporte."' ";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);
while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){

$IdCliente = $row_encuesta['id'];

$sql_encuestaP = "SELECT resultado FROM tb_encuentas_estacion_cliente_preguntas WHERE id_cliente = '".$IdCliente."' ORDER BY resultado desc";
$result_encuestaP = mysqli_query($con, $sql_encuestaP);
$numero_encuestaP = mysqli_num_rows($result_encuestaP);
while($row_encuestaP = mysqli_fetch_array($result_encuestaP, MYSQLI_ASSOC)){


if($row_encuestaP['resultado'] == 4){
$resultado4 = $resultado4 + 1;
}else if($row_encuestaP['resultado'] == 3){
$resultado3 = $resultado3 + 1;
}else if($row_encuestaP['resultado'] == 2){
$resultado2 = $resultado2 + 1;
}else if($row_encuestaP['resultado'] == 1){
$resultado1 = $resultado1 + 1;
}

} 
}

} 

if ($resultado1 == 0) {
$resultado1 = 0;
}else{
$resultado1 = $resultado1;
}

if ($resultado2 == 0) {
$resultado2 = 0;
}else{
$resultado2 = $resultado2;
}

if ($resultado3 == 0) {
$resultado3 = 0;
}else{
$resultado3 = $resultado3;
}

if ($resultado4 == 0) {
$resultado4 = 0;
}else{
$resultado4 = $resultado4;
}

$resultado = "
<div class='text-danger'>Mala: <b>".$resultado1."</b></div>
<div class='text-warning'>Regular: <b>".$resultado2."</b></div>
<div class='text-info'>Buena: <b>".$resultado3."</b></div>
<div class='text-success'>Excelente: <b>".$resultado4."</b></div>
";

return $resultado;

}

function ResultadoIncidentes($Session_IDEstacion,$Year,$Semestre,$con){

if($Semestre == 1){
$Rango = 'AND (MONTH(fecha) >= 1 AND MONTH(fecha) <= 6)';
}else if($Semestre == 2){
$Rango = 'AND (MONTH(fecha) >= 7 AND MONTH(fecha) <= 12)';  
}

  $sql_inv = "SELECT * FROM tb_investigacion_incidente_accidente WHERE id_estacion= '".$Session_IDEstacion."' AND YEAR(fechacreacion) = '".$Year."' $Rango ORDER BY id desc ";
$result_inv = mysqli_query($con, $sql_inv);
$numero_inv = mysqli_num_rows($result_inv);

if ($numero_inv == 0) {
$title = "<b class='text-success'>100% Excelente</b>";
}else{
$totalRe = 0;
while($row_inv = mysqli_fetch_array($result_inv, MYSQLI_ASSOC)){
$id = $row_inv['id'];
$formato026 = formatos($id, $con);
$Grupo = Grupo($id, $con);

$Total = $formato026 + $Grupo;

if ($Total >= 2) {
$suma = 1;
}else{
$suma = 0;
}

$totalRe = $totalRe + $suma;

}

if ($totalRe == 0) {
$title = "<b class='text-warning'>50% Regular</b>";
}else{

$calificacion = $totalRe / $numero_inv  * 100;

if( $calificacion >= 60  && $calificacion <= 100){
$title = "<b class='text-success'>".$calificacion."% Excelente</b>";
                    
}else if($calificacion >= 0 && $calificacion <= 59){
$title = "<b class='text-warning'>".$calificacion."% Regular</b>";
                    
}

}

}

return $title;
}

function formatos($id, $con){
$sql_archivo = "SELECT * FROM tb_investigacion_incidente_accidente_formato WHERE id_investigacion = '".$id."' ORDER BY id asc ";
$result_archivo = mysqli_query($con, $sql_archivo);
$numero_archivo = mysqli_num_rows($result_archivo);
return $numero_archivo;
}

function Grupo($id, $con){
$sql_inv = "SELECT * FROM tb_investigacion_incidente_accidente_grupo WHERE id_investigacion= '".$id."' ORDER BY id desc ";
$result_inv = mysqli_query($con, $sql_inv);
$numero_inv = mysqli_num_rows($result_inv);
return $numero_inv;
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
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
 <?php if ($numero_sasisopa_ayuda == 1) {echo "btnAyuda();";} ?>
  ListaResultados();
  });

  function regresarP(){
   window.history.back();
  }

  function ListaResultados(){    
  $('#ContenidoDiv').load('public/sasisopa/vistas/lista-revision-resultados.php');
  }

  function btnAyuda(){
  $('#myModalPolitica').modal('show');
  }
 
function btnFinAyuda(){

var puntosSasisopa = <?=$numero_sasisopa_ayuda;?>;

 var parametros = {
        "idAyuda" : <?=$idAyuda; ?>
      };

  if (puntosSasisopa != 0) {

   $.ajax({
   data:  parametros,
   url:   'public/sasisopa/actualizar/actualizar-ayuda.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   $('#myModalPolitica').modal('hide');
   $('#CicloMejoraContinua').modal('show');
   }
   });

  }else{
  $('#myModalPolitica').modal('hide');
  $('#CicloMejoraContinua').modal('show');
  }



}

function ModalArchivo(){
$('#ModalArchivo').modal('show'); 
}

function BTNAgregar(idUsuario, idEstacion){

  var data = new FormData();
  var url = "public/sasisopa/agregar/agregar-revision-resultados.php";

  var ArchivoPDF = document.getElementById("ArchivoPDF");
  var file = ArchivoPDF.files[0];
  var filePath = ArchivoPDF.value;
  var valpdf = filePath.split('.').pop();

  if (filePath != "") {
  $('#ArchivoPDF').css('border','');
  if (valpdf == "pdf") {
  $('#ArchivoPDF').css('border','');
  $('#DivResultadoPDF').html('');

  data.append('idUsuario', idUsuario);
  data.append('idEstacion', idEstacion);
  data.append('file', file);

  

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

  ListaResultados();
  ArchivoPDF.value = '';
  $('#ModalArchivo').modal('hide'); 

  });

  }else{
  $('#ArchivoPDF').css('border','2px solid #A52525');
  $('#DivResultadoPDF').html('<label class="text-danger">Solo acepta formato PDF</label>');
  }
  }else{
  $('#ArchivoPDF').css('border','2px solid #A52525');
  }


}

function Eliminar(id){

    var parametros = {
      "id" : id
    };

  alertify.confirm('',
    function(){

    $.ajax({
     data:  parametros,
     url:   'public/sasisopa/eliminar/eliminar-revision-resultados.php',
     type:  'post',
     beforeSend: function() {

     },
     complete: function(){


     },
     success:  function (response) {

      alertify.message('Se eliminó correctamente la revisión de resultados');
      ListaResultados();

     }
     });

    },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la revisión de resultados seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function ModalBuscar(){
$('#ModalBuscar').modal('show');
}

function Buscar(){

let YearBuscar = $('#YearBuscar').val();
if (YearBuscar != "") {
$('#YearBuscar').css('border','');

 $('#Contenido').load('public/sasisopa/vistas/lista-revision-resultados-detalle.php?Year=' + YearBuscar);
 $('#ModalBuscar').modal('hide');

}else{
$('#YearBuscar').css('border','2px solid #A52525');  
}

}

function Descargar(Year){
window.location = "descargar-revision-resultados-detalle/" + Year;   
}

function ModalEditar(id){

$('#ModalEditar').modal('show'); 
$('#DivDetalle').load('public/sasisopa/vistas/modal-editar-informe-revision-resultados.php?id=' + id);
}


function BtnEditar(id){
let EditFecha = $('#EditFecha').val();

var data = new FormData();
var url = "public/sasisopa/actualizar/editar-revision-resultados.php";

  var ArchivoPDF = document.getElementById("EditArchivoPDF");
  var file = ArchivoPDF.files[0];
  var filePath = ArchivoPDF.value;
  var valpdf = filePath.split('.').pop();

if (EditFecha != "") {
$('#EditFecha').css('border','');

  alertify.confirm('',
    function(){

  data.append('id', id);
  data.append('EditFecha', EditFecha);
  data.append('file', file);

    $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

    alertify.message('Se edito correctamente la revisión de resultados');
      ListaResultados();
      $('#ModalEditar').modal('hide');

  });

    },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea editar la revisión de resultados seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#EditFecha').css('border','2px solid #A52525');  
}
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
    <div class="float-left"><h4>17. REVISIÓN DE RESULTADOS</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
        <a class="mr-1" onclick="ModalBuscar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Buscar" >
    <img src="<?php echo RUTA_IMG_ICONOS."lupa.png"; ?>">
    </a>
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
      </div>
    
<div class="card-body">


<div class="row"> 
  <!-- TABLA - Fo.ADMONGAS.027 -->
  <div class="col-12 mt-2 mb-2"> 


   <div class="border">
  <div class="p-3">

  <div class="text-right">
  <a onclick="Descargar(<?=$fecha_year;?>)" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a>
  </div>
   <div class="row">   
        
        <div class="col-12 mt-1">

       <div id="Contenido">
      <?php 

      function TC($a,$b){
      $Resul = ($a - $b) / $b * 100;
      $TC = 100 + ($Resul);
      $Porcentaje = number_format($TC,2);

      if( $Porcentaje >= 80  ){
      $Return = "<b class='text-success'>".$Porcentaje."% Excelente</b>";                 
      }else if($Porcentaje >= 0 && $Porcentaje <= 79){
      $Return = "<b class='text-warning'>".$Porcentaje."% Regular</b>";
      }

      return $Return;
      }

      $YearAnt = $fecha_year - 1;

      $DicAnt = Ventas($Session_IDEstacion,12,$YearAnt,$con);
      $Ene = Ventas($Session_IDEstacion,1,$fecha_year,$con);
      $Feb = Ventas($Session_IDEstacion,2,$fecha_year,$con);
      $Mar = Ventas($Session_IDEstacion,3,$fecha_year,$con);
      $Abr = Ventas($Session_IDEstacion,4,$fecha_year,$con);
      $May = Ventas($Session_IDEstacion,5,$fecha_year,$con);
      $Jun = Ventas($Session_IDEstacion,6,$fecha_year,$con);
      $Jul = Ventas($Session_IDEstacion,7,$fecha_year,$con);
      $Ago = Ventas($Session_IDEstacion,8,$fecha_year,$con);
      $Sep = Ventas($Session_IDEstacion,9,$fecha_year,$con);
      $Oct = Ventas($Session_IDEstacion,10,$fecha_year,$con);
      $Nov = Ventas($Session_IDEstacion,11,$fecha_year,$con);
      $Dic = Ventas($Session_IDEstacion,12,$fecha_year,$con);

      $TC1 = TC($Ene,$DicAnt);
      $TC2 = TC($Feb,$Ene);
      $TC3 = TC($Mar,$Feb);
      $TC4 = TC($Abr,$Mar);
      $TC5 = TC($May,$Abr);
      $TC6 = TC($Jun,$May);
      $TC7 = TC($Jul,$Jun);
      $TC8 = TC($Ago,$Jul);
      $TC9 = TC($Sep,$Ago);
      $TC10 = TC($Oct,$Sep);
      $TC11 = TC($Nov,$Oct);
      $TC12 = TC($Dic,$Nov);
      ?>

      <div class="border p-2">

      <table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Implementación del SA</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">No. Total de elementos implementados VS No. de elementos del SA</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=Meta($Session_IDEstacion,1,$con);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">ANUAL</td>
        </tr>
        <tr>
          <td colspan="4">
          <div class="mt-1"><b>Resultado:</b> <?=ResultadoImplementacion($Session_IDEstacion,$fecha_year,$con);?></div>
          </td>
        </tr>
        </tbody>
        </table> 

        </div>

    <hr>

      <div class="border p-2">

      <table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Ventas</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">Venta del mes inmediato anterior VS venta del mes actual</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=Meta($Session_IDEstacion,2,$con);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Mensual</td>
        </tr>
        </tbody>
        </table> 

     <div class="mt-1"><b>Resultado:</b></div>

      <div class="row">
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Dic <?=$YearAnt;?></th>
                <th class="text-center bg-light">Ene <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($DicAnt,2);?></td>
                <td class="text-center bg-light"><?=number_format($Ene,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC1;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php if(number_format(date("m")) >= 2){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Ene <?=$fecha_year;?></th>
                <th class="text-center">Feb <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Ene,2);?></td>
                <td class="text-center"><?=number_format($Feb,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC2;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 3){ ?>
          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Feb <?=$fecha_year;?></th>
                <th class="text-center bg-light">Mar <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Feb,2);?></td>
                <td class="text-center bg-light"><?=number_format($Mar,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC3;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 4){ ?>
          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Mar <?=$fecha_year;?></th>
                <th class="text-center">Abr <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Mar,2);?></td>
                <td class="text-center"><?=number_format($Abr,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC4;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 5){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Abr <?=$fecha_year;?></th>
                <th class="text-center bg-light">May <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Abr,2);?></td>
                <td class="text-center bg-light"><?=number_format($May,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC5;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 6){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">May <?=$fecha_year;?></th>
                <th class="text-center">Jun <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($May,2);?></td>
                <td class="text-center"><?=number_format($Jun,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC6;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>
      </div>

        <div class="row">
        <?php if(number_format(date("m")) >= 7){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Jun <?=$fecha_year;?></th>
                <th class="text-center bg-light">Jul <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Jun,2);?></td>
                <td class="text-center bg-light"><?=number_format($Jul,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC7;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 8){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Jul <?=$fecha_year;?></th>
                <th class="text-center">Ago <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Jul,2);?></td>
                <td class="text-center"><?=number_format($Ago,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC8;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 9){ ?>
          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Ago <?=$fecha_year;?></th>
                <th class="text-center bg-light">Sep <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Ago,2);?></td>
                <td class="text-center bg-light"><?=number_format($Sep,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC9;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 10){ ?>
          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Sep <?=$fecha_year;?></th>
                <th class="text-center">Oct <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Sep,2);?></td>
                <td class="text-center"><?=number_format($Oct,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC10;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 11){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Oct <?=$fecha_year;?></th>
                <th class="text-center bg-light">Nov <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Oct,2);?></td>
                <td class="text-center bg-light"><?=number_format($Nov,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC11;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>

        <?php if(number_format(date("m")) >= 12){ ?>
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Nov <?=$fecha_year;?></th>
                <th class="text-center">Dic <?=$fecha_year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Nov,2);?></td>
                <td class="text-center"><?=number_format($Dic,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC12;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } ?>
      </div>

      </div>

      <hr>

    <div class="border p-2">

      <table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Capacitación</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">No. de personal capacitado vs No. de personal de la estación</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=Meta($Session_IDEstacion,3,$con);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Semestral</td>
        </tr>
        <tr>
          <td colspan="4">
            
        <div class="mt-1"><b>Resultado:</b></div>

        <div class="row">
          <div class="col-6">
          <div class="text-secondary">Primer semestre:</div>
          <?=ResultadoCapacitacion($Session_IDEstacion,$fecha_year,1,$con);?>
          </div>
          <?php if(number_format(date("m")) >= 7){ ?>
          <div class="col-6">
          <div class="text-secondary">Segundo semestre:</div>
          <?=ResultadoCapacitacion($Session_IDEstacion,$fecha_year,2,$con);?>
          </div>
        <?php } ?>
        </div>

          </td>
        </tr>
        </tbody>
        </table> 

        </div>

        <hr>

        <div class="border p-2">

      <table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Satisfacción del cliente</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">Media del total de clientes con experiencia: Mala, Buena y Excelente</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=Meta($Session_IDEstacion,4,$con);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Semestral</td>
        </tr>
        <tr>
          <td colspan="4">
          <div class="mt-1"><b>Resultado:</b></div>

        <div class="row">
          <div class="col-6">
          <div class="text-secondary">Primer semestre:</div>
          <?=ResultadoSatisfaccion($Session_IDEstacion,$fecha_year,1,$con);?>
          </div>
          <?php if(number_format(date("m")) >= 7){ ?>
          <div class="col-6">
          <div class="text-secondary">Segundo semestre:</div>
          <?=ResultadoSatisfaccion($Session_IDEstacion,$fecha_year,2,$con);?>
          </div>
        <?php } ?>
        </div>
          </td>
        </tr>
        </tbody>
        </table>      

      </div>

      <hr>

      <div class="border p-2">

      <table class="table table-bordered table-sm c-pointer pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Incidentes y accidentes</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">No total de accidentes e incidentes ocurridos VS número total de accidentes e incidentes atendidos</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=Meta($Session_IDEstacion,5,$con);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Semestral</td>
        </tr>
        <tr>
          <td colspan="4">
           <div class="mt-1"><b>Resultado:</b></div>

        <div class="row">
          <div class="col-6">
          <div class="text-secondary">Primer semestre:</div>
          <?=ResultadoIncidentes($Session_IDEstacion,$fecha_year,1,$con);?>
          </div>
          <?php if(number_format(date("m")) >= 7){ ?>
          <div class="col-6">
          <div class="text-secondary">Segundo semestre:</div>
          <?=ResultadoIncidentes($Session_IDEstacion,$fecha_year,2,$con);?>
          </div>
        <?php } ?>
        </div>
          </td>
        </tr>
        </tbody>
        </table>

      </div>

    <hr>
  </div>

        <a class="float-right ml-3" onclick="ModalArchivo()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
        <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
        </a>
        <a class="float-right" style="text-decoration: none;" href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.027.docx";?>" download>
        <b>Fo.ADMONGAS.027</b>
        <img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>">
        </a>

      </div>

  </div>
  <hr>
      <div id="ContenidoDiv"></div>
  
  </div>
  </div>
    
    </div>
    </div>
    
    </div>
    </div>
    </div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="myModalPolitica" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 17. REVISIÓN DE RESULTADOS, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            En este apartado podrás verificar los resultados arrojados en el elemento <b>14. MONITOREO, VERIFICACIÓN Y EVALUACIÓN</b>, así como también proponer acciones de mejora para poder cumplir los objetivos y las metas.
          </p>
         

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en el icono de descargar para llenar el informe de revisión de resultados <b>(Fo.ADMONGAS.027)</b>.</li>
            <li>Lee detenidamente cada uno de los puntos del formato y realiza el llenado como se te indica.</li>
            <li>Dicha plantilla deberá ser retroalimentada en cuanto al contenido asegúrate de no dejar ningún punto en blanco.</li>
            <li>El informe deberá ser firmado por el Representante legal de la estación.</li>
            <li>Escanea y sube tu archivo en formato PDF, dando clic en el icono <img width="16px" src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"> agregar documento.</li>
            <li>Podrás verificar el estado de tu documento en el icono PDF.</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label>, el interpretar los resultados obtenidos durante el tiempo de implementación y el generar propuestas de mejora para obtener los resultados deseados.</p>

          <small>Nota: El informe de revisión de resultados deberá ser actualizado anualmente </small>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda()">Siguiente</button>
        </div>
      </div>
    </div>
    </div>

      <div class="modal fade bd-example-modal-lg" id="CicloMejoraContinua" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Ciclo de mejora continua </h4>
        </div>
        <div class="modal-body">

          <img width="100%" src="<?php echo RUTA_IMG_ICONOS."Ciclo mejora continua.PNG"; ?>">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;" >Salir</button>
        </div>
      </div>
    </div>
    </div>

<div class="modal fade bd-example-modal-lg" id="ModalArchivo" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
 <div class="modal-header">
   <h4 class="modal-title">Agregar archivo</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 
 <div class="modal-body">

  <div class="mb-2">
  <label for="tipocomunicacion" class="text-secondary">Revisión de resultados en formato PDF: </label>
  </div>

 <input type="file" name="" id="ArchivoPDF">
 <div id="DivResultadoPDF"></div>

 </div>
 <div class="modal-footer">
   <button  type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BTNAgregar(<?=$Session_IDUsuarioBD;?>,
<?=$Session_IDEstacion;?>)">Agregar</button>
 </div>
</div>
</div>
</div>

     <div class="modal fade bd-example-modal-lg" id="ModalBuscar">
    <div class="modal-dialog modal-m modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Buscar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">

          <label>Año:</label>
          <input type="number" class="form-control rounded-0" id="YearBuscar">

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="Buscar()">Aceptar</button>
        </div>
        </div>

    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalEditar" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div id="DivDetalle"></div>
      </div>
    </div>
    </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
