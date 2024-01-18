<?php
require('app/help.php');
$idReporteCre = $idReporte;

$sql_mesyear = "SELECT * FROM re_reporte_cre_mes WHERE id = '".$idReporteCre."' ";
$result_mesyear = mysqli_query($con, $sql_mesyear);
$numero_mesyear = mysqli_num_rows($result_mesyear);
while($row_mesyear = mysqli_fetch_array($result_mesyear, MYSQLI_ASSOC)){
$Datames = $row_mesyear['mes'];
$Datayear = $row_mesyear['year'];
 }

$dia = date("d", mktime(0,0,0, $Datames+1, 0, $Datayear));

if (strlen($Datames) == 1) {
$dia_mes = "0".$Datames;
}else{
$dia_mes = $Datames;
}

$dia_min = $Datayear."-".$dia_mes."-01";
$dia_max = $Datayear."-".$dia_mes."-".$dia;

$fechaFormato = date("Y-m-d",$idFecha);

 
if (isset($_POST['BtnGuardar'])) {
$ppl = $_POST['imto'] / $_POST['voco'];

  $sql_reportepipas = "SELECT * FROM re_reporte_cre_pipas WHERE id_re_producto = '".$_POST['idresult']."' ";
  $result_reportepipas = mysqli_query($con, $sql_reportepipas);
  $numero_reportepipas = mysqli_num_rows($result_reportepipas);

  $numpipa = $numero_reportepipas + 1;



  $sql_insert = "INSERT INTO re_reporte_cre_pipas (id_re_producto,pipa_numero, volumen, precio_litro, costo_flete, no_factura,nombre_razonsocial,importe_total)
  VALUES ('".$_POST['idresult']."',$numpipa,'".$_POST['voco']."','".$ppl."','".$_POST['cofl']."','".$_POST['numfac']."',
  '".$_POST['razontransportista']."','".$_POST['imto']."')";
  mysqli_query($con, $sql_insert);

  echo "<script type='text/javascript'>
    alertify.message('Se agregó correctamente la información');
  </script>";
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

  });
  function regresarP(){
   window.location.href = '<?=RUTA_REPORTE_DIARIO."/".$Datames."/".$Datayear;?>';
  }

  function ListaReporteEstadistico(){
    $('#DivReporteEstadistico').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
    $('#DivReporteEstadistico').load('public/gerente/vistas/lista-reporte-estadistico.php');
  }

function bntvli(idp){

var inputvi = $('#inputvi' + idp).val();
var parametros = {
  "idReporte" : <?=$idReporteCre;?>,
  "idMensajes" : <?=$idFecha;?>,
  "id": idp,
  "inputvi": inputvi
};
$.ajax({
 data:  parametros,
 url:   '../../public/gerente/editar/volumen-inicial.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {
 alertify.message('Se actualizo correctamente');
 }
 });
}

function bntvv(idp){
var inputvv = $('#inputvv' + idp).val();
var parametros = {
  "idReporte" : <?=$idReporteCre;?>,
  "idMensajes" : <?=$idFecha;?>,
  "id": idp,
  "inputvv": inputvv
};
$.ajax({
 data:  parametros,
 url:   '../../public/gerente/editar/volumen-venta.php',
 type:  'post',
 beforeSend: function() {

 },
 complete: function(){
 },
 success:  function (response) {
 alertify.message('Se actualizo correctamente');
 }
 });
}

function bntvf(idp){
var inputvf = $('#inputvf' + idp).val();
var parametros = {
  "idReporte" : <?=$idReporteCre;?>,
  "idMensajes" : <?=$idFecha;?>,
  "id": idp,
  "inputvf": inputvf
};
$.ajax({
 data:  parametros,
 url:   '../../public/gerente/editar/volumen-final.php',
 type:  'post',
 beforeSend: function() {

 },
 complete: function(){
 },
 success:  function (response) {
 alertify.message('Se actualizo correctamente');
 }
 });
}

function BtnPipas(dato,idPipa,num){

 var Dato6 = $('#6' + idPipa + '' + num).val();
 var Dato1 = $('#1' + idPipa + '' + num).val();
 var DatoR = Dato6 / Dato1;
    
 
var input = $('#' + dato + '' + idPipa + '' + num).val();
 var Resultado = financial(DatoR)

var parametros = {
  "idReporte" : <?=$idReporteCre;?>,
  "idMensajes" : <?=$idFecha;?>,
  "dato": dato,
  "id": idPipa,
  "input": input,
  "dator" : Resultado
};
$.ajax({
 data:  parametros,
 url:   '../../public/gerente/editar/editar-pipas.php',
 type:  'post',
 beforeSend: function() {

 },
 complete: function(){
 },
 success:  function (response) {
 alertify.message('Se actualizo correctamente');

 $('#2' + idPipa + '' + num).val(Resultado);

 }
 });
}

function AgregarPipa(id){
  $('#ModalAgregar').modal('show');

  $('#Idresult').val(id);
}

function deletPipa(idPipa){

  var parametros = {
    "id": idPipa
  };
  $.ajax({
   data:  parametros,
   url:   '../../public/gerente/eliminar/eliminar-pipas.php',
   type:  'post',
   beforeSend: function() {

   },
   complete: function(){
   },
   success:  function (response) {

   alertify.message('Se elimino correctamente');
   window.setTimeout("recargarP()",1000);
   }
   });

}
function recargarP(){
window.location.href = '';
}

function editarfecha(){
$('#ModalEditarFecha').modal('show');
$('#fechaanterior').val('<?=$fechaFormato;?>');
}

function EditFecha(){

 var FechaAnte = $('#fechaanterior').val();
 var FechaNew = $('#fechanueva').val();

if (FechaNew != "") {
$('#fechanueva').css('border','');

    alertify.confirm('',
    function(){

  var parametros = {
      "idreporteCre" : <?=$idReporteCre;?>,
      "FechaAnte": FechaAnte,
      "FechaNew": FechaNew
    };

    $.ajax({
     data:  parametros,
     url:   '../../public/gerente/editar/editar-fecha-reporte-cre.php',
     type:  'post',
     beforeSend: function() {

     },
     complete: function(){


     },
     success:  function (response) {

      if (response != 0) {

    alertify.message('El reporte estadístico fue editado correctamente');

    setTimeout(function() {
    editfecharesult(response)
    }, 1000);

      }else{

      $('#resultFecha').html('<div class="text-danger text-center" style="font-size: .8em;margin-top: 20px;">Seleccione otra fecha</div>');
      }

     }
     });

    },
    function(){
    }).setHeader('Editar fecha').set({transition:'zoom',message: 'Desea editar la fecha del reporte',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}else{
$('#fechanueva').css('border','2px solid #A52525');
  }

}

function editfecharesult(id){
window.location.href = id;
}

function Importe(valor){    

  var Compra = $('#voco').val();
  var Litros = valor.value / Compra;
    
  $('#ppl').val(financial(Litros));

  }

  function VolumenCompra(valor){

  var Importe = $('#imto').val();
  var Litros = Importe / valor.value;
    
  $('#ppl').val(financial(Litros));

  }

function financial(x) {
  return Number.parseFloat(x).toFixed(2);
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
   
    <div class="float-left">
      <h4><?=FormatoFecha($fechaFormato);?></h4>
    </div>


    <div class="float-left" style="padding-left: 10px;margin-top: 8px;">
      <a onclick="editarfecha()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Editar"><img src="<?php echo RUTA_IMG_ICONOS."edit-black-16.png"; ?>"></a>
      </div>
    </div>

    <div class="card-body">

    <?php
    if ($Session_ProductoUno != "") {

    ?>
    
    <!-- PRODUCTO G-SUPER -->
    <div class="border mb-3">
    <div class="p-3">
    
    <div class="" style="font-size: 1.2em;">
    <label style="border-bottom: 2px solid #59c784;">Producto: <b><?=$Session_ProductoUno;?></b></label>
    </div>
    
      <div class="row">
    
    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

    <div class="mb-2" style="overflow-y: hidden;"> 
    <table class="table table-bordered table-sm">
      <thead>
      <tr>
      <th class="text-center text-secondary">Volumen (Lt) Inicial</th>
      <th class="text-center text-secondary">Volumen (Lt) de venta</th>
      <th colspan="2" class="text-center text-secondary">Volumen (Lt) Final</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <?php
        $sql_reportepro1 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporteCre."' and fecha = '".$fechaFormato."' and producto = '".$Session_ProductoUno."' ";
        $result_reportepro1 = mysqli_query($con, $sql_reportepro1);
        $numero_reportepro1 = mysqli_num_rows($result_reportepro1);
        while($row_reportepro1 = mysqli_fetch_array($result_reportepro1, MYSQLI_ASSOC)){
        $idProducto = $row_reportepro1['id'];
        $volInicial1 = $row_reportepro1['volumen_inicial'];
        $volVenta1 = $row_reportepro1['volumen_venta'];
        $volFinal1 = $row_reportepro1['volumen_final'];
        echo "<td class='text-center' style='padding: 0;'><input type='number' id='inputvi$idProducto' onchange='bntvli($idProducto)' min='0' step='any' class='form-control' placeholder='Volumen (Lt) Inicial' value='".$row_reportepro1['volumen_inicial']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
        echo "<td class='text-center' style='padding: 0;'><input type='number' id='inputvv$idProducto' onchange='bntvv($idProducto)' id='' min='0' step='any' class='form-control' placeholder='Volumen (Lt) de venta' value='".$row_reportepro1['volumen_venta']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
        echo "<td class='text-center' style='padding: 0;'><input type='number' id='inputvf$idProducto' onchange='bntvf($idProducto)' min='0' step='any' class='form-control' placeholder='Volumen (Lt) Final' value='".$row_reportepro1['volumen_final']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
        }
        ?>
      </tr>
      </tbody>
    </table>
  </div>
    </div>


    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
      
      <div class="mb-2" style="overflow-y: hidden;"> 
      <table class="table table-bordered table-sm">
        <thead>
        <tr>
          <th class="text-center text-secondary font-weight-bold align-middle" width="60px"><a onclick="AgregarPipa(<?=$idProducto;?>)" style="cursor:pointer"><img src="<?php echo RUTA_IMG_ICONOS."mas-black-16.png"; ?>"></a> Pipa</th>
          <th class="text-center text-secondary font-weight-bold align-middle" >Volumen (Lt) de Compra</th>
          <th class="text-center text-secondary font-weight-bold align-middle" >Precio ($) por litro de producto</th>
          <th class="text-center text-secondary font-weight-bold align-middle" >Costo ($) del flete mas IVA</th>
          <th class="text-center text-secondary font-weight-bold align-middle" >No. De factura</th>
          <th class="text-center text-secondary font-weight-bold align-middle">Nombre o Razón Social del Transportista</th>
          <th class="text-center text-secondary font-weight-bold align-middle" >Importe</th>
          <td class="align-middle"><a onclick="" style="cursor:pointer"><img src="<?php echo RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>"></a></td>
          </tr>
        <tbody>
          <?php
          $sql_reportepipas1 = "SELECT * FROM re_reporte_cre_pipas WHERE id_re_producto = '".$idProducto."' ";
          $result_reportepipas1 = mysqli_query($con, $sql_reportepipas1);
          $numero_reportepipas1 = mysqli_num_rows($result_reportepipas1);
          if ($numero_reportepipas1 > 0) {
            while($row_reportepipas1 = mysqli_fetch_array($result_reportepipas1, MYSQLI_ASSOC)){
            $idPipa  = $row_reportepipas1['id'];
            $num = $row_reportepipas1['pipa_numero'];
            echo "<tr style='padding: 0;'>";
            echo "<td class='text-center align-middle'>".$row_reportepipas1['pipa_numero']."</td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='number' id='1$idPipa$num' onchange='BtnPipas(1,$idPipa,$num)' min='0' step='any' class='form-control' value='".$row_reportepipas1['volumen']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='number' id='2$idPipa$num' onchange='BtnPipas(2,$idPipa,$num)' min='0' step='any' class='form-control' value='".$row_reportepipas1['precio_litro']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;' disabled></td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='number' id='3$idPipa$num' onchange='BtnPipas(3,$idPipa,$num)' min='0' step='any' class='form-control' value='".$row_reportepipas1['costo_flete']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='text' id='4$idPipa$num' onchange='BtnPipas(4,$idPipa,$num)' class='form-control' value='".$row_reportepipas1['no_factura']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";

            echo "<td class='align-middle' style='padding: 0;'><input type='text' id='5$idPipa$num' onchange='BtnPipas(5,$idPipa,$num)' class='form-control' value='".$row_reportepipas1['nombre_razonsocial']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";

            echo "<td class='text-right align-middle' style='padding: 0;'><input type='number' id='6$idPipa$num' onchange='BtnPipas(6,$idPipa,$num)' min='0' step='any' class='form-control text-right' value='".$row_reportepipas1['importe_total']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
            ?>
            <td class="align-middle"><a onclick="deletPipa(<?=$idPipa;?>)" style="cursor:pointer"><img src="<?php echo RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>"></a></td>
            <?php
            echo "</tr>";

            $tovolcompra1 = $tovolcompra1 + $row_reportepipas1['volumen'];
            }
          }else{
            echo "<tr><td colspan='5' class='text-center text-secondary' style='font-size: .9em;'>No se encontró información</td></tr>";
          }
          ?>
        </tbody>
      </thead>
      </table>
    </div>
  </div>
    <?php
    $mermapr1 = $volInicial1 + $tovolcompra1 - $volVenta1 - $volFinal1;
    echo "<div class='col-12'>
      <hr>
    <label class='font-weight-bold' style='font-size: 1.2em;'>Total Merma:</label> <label class='font-weight-bold text-danger' style='font-size: 1.2em;'>".$mermapr1."</label> </div>";

    ?>
    </div>
    </div>
    </div>

    <?php } ?>

    <?php
    if ($Session_ProductoDos != "") {
    ?>
    
    <div class="border mb-3">
    <div class="p-3">
    <div class="" style="font-size: 1.2em;">
    <label style="border-bottom: 2px solid #c75959;">Producto: <b><?=$Session_ProductoDos;?></b></label>
    </div>
    <div class="row" style="margin-top: 10px;">
    

    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
    <div class="mb-2" style="overflow-y: hidden;"> 
    <table class="table table-bordered table-sm">
      <thead>
      <tr>
      <th class="text-center text-secondary">Volumen (Lt) Inicial</th>
      <th class="text-center text-secondary">Volumen (Lt) de venta</th>
      <th colspan="2" class="text-center text-secondary">Volumen (Lt) Final</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <?php
        $sql_reportepro1 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporteCre."' and fecha = '".$fechaFormato."' and producto = '".$Session_ProductoDos."' ";
        $result_reportepro1 = mysqli_query($con, $sql_reportepro1);
        $numero_reportepro1 = mysqli_num_rows($result_reportepro1);
        while($row_reportepro1 = mysqli_fetch_array($result_reportepro1, MYSQLI_ASSOC)){
        $idProducto = $row_reportepro1['id'];
        $volInicial2 = $row_reportepro1['volumen_inicial'];
        $volVenta2 = $row_reportepro1['volumen_venta'];
        $volFinal2 = $row_reportepro1['volumen_final'];
        echo "<td class='text-center' style='padding: 0;'><input type='number' id='inputvi$idProducto' onchange='bntvli($idProducto)' min='0' step='any' class='form-control' value='".$row_reportepro1['volumen_inicial']."' placeholder='Volumen (Lt) Inicial' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
        echo "<td class='text-center' style='padding: 0;'><input type='number' id='inputvv$idProducto' onchange='bntvv($idProducto)' min='0' step='any' class='form-control' value='".$row_reportepro1['volumen_venta']."' placeholder='Volumen (Lt) de venta' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
        echo "<td class='text-center' style='padding: 0;'><input type='number' id='inputvf$idProducto' onchange='bntvf($idProducto)' min='0' step='any' class='form-control' value='".$row_reportepro1['volumen_final']."' placeholder='Volumen (Lt) Final' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
        }
        ?>
      </tr>
      </tbody>
    </table>
    </div>
  </div>
    
    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
    <div class="mb-2" style="overflow-y: hidden;"> 
      <table class="table table-bordered table-sm">
        <thead>
        <tr>
          <th class="text-center text-secondary font-weight-bold align-middle" width="60px"><a onclick="AgregarPipa(<?=$idProducto;?>)" style="cursor:pointer"><img src="<?php echo RUTA_IMG_ICONOS."mas-black-16.png"; ?>"></a> Pipa</th>
          <th class="text-center text-secondary font-weight-bold align-middle">Volumen (Lt) de Compra</th>
          <th class="text-center text-secondary font-weight-bold align-middle">Precio ($) por litro de producto</th>
          <th class="text-center text-secondary font-weight-bold align-middle">Costo ($) del flete mas IVA</th>
          <th class="text-center text-secondary font-weight-bold align-middle">No. De factura</th>
           <th class="text-center text-secondary font-weight-bold align-middle">Nombre o Razón Social del Transportista</th>
          <th class="text-center text-secondary font-weight-bold align-middle" >Importe</th>
          <td class="align-middle"><a onclick="" style="cursor:pointer"><img src="<?php echo RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>"></a></td>
          </tr>
        <tbody>
          <?php
          $sql_reportepipas2 = "SELECT * FROM re_reporte_cre_pipas WHERE id_re_producto = '".$idProducto."' ";
          $result_reportepipas2 = mysqli_query($con, $sql_reportepipas2);
          $numero_reportepipas2 = mysqli_num_rows($result_reportepipas2);
          if ($numero_reportepipas2 > 0) {
          while($row_reportepipas2 = mysqli_fetch_array($result_reportepipas2, MYSQLI_ASSOC)){
            $idPipa  = $row_reportepipas2['id'];
            $num = $row_reportepipas2['pipa_numero'];
            echo "<tr>";
            echo "<td class='text-center align-middle'>".$row_reportepipas2['pipa_numero']."</td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='number' id='1$idPipa$num' onchange='BtnPipas(1,$idPipa,$num)' min='0' step='any' class='form-control' value='".$row_reportepipas2['volumen']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='number' id='2$idPipa$num' onchange='BtnPipas(2,$idPipa,$num)' min='0' step='any' class='form-control' value='".$row_reportepipas2['precio_litro']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;' disabled></td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='number' id='3$idPipa$num' onchange='BtnPipas(3,$idPipa,$num)' min='0' step='any' class='form-control' value='".$row_reportepipas2['costo_flete']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='text' id='4$idPipa$num' onchange='BtnPipas(4,$idPipa,$num)' class='form-control' value='".$row_reportepipas2['no_factura']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";

           echo "<td class='align-middle' style='padding: 0;'><input type='text' id='5$idPipa$num' onchange='BtnPipas(5,$idPipa,$num)' class='form-control' value='".$row_reportepipas2['nombre_razonsocial']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";

            echo "<td class='text-right align-middle' style='padding: 0;'><input type='number' id='6$idPipa$num' onchange='BtnPipas(6,$idPipa,$num)' min='0' step='any' class='form-control text-right' value='".$row_reportepipas2['importe_total']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
            ?>
            <td class="align-middle"><a onclick="deletPipa(<?=$idPipa;?>)" style="cursor:pointer"><img src="<?php echo RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>"></a></td>
            <?php
            echo "</tr>";
            $tovolcompra2 = $tovolcompra2 + $row_reportepipas2['volumen'];
          }
        }else{
          echo "<tr><td colspan='5' class='text-center text-secondary' style='font-size: .9em;'>No se encontró información</td></tr>";
        }
          ?>
        </tbody>
      </thead>
      </table>
    </div>
    </div>
    <?php
    $mermapr2 = $volInicial2 + $tovolcompra2 - $volVenta2 - $volFinal2;
    echo "<div class='col-12'>
      <hr>
    <label class='font-weight-bold' style='font-size: 1.2em;'>Total Merma:</label> <label class='font-weight-bold text-danger' style='font-size: 1.2em;'>".$mermapr2."</label> </div>";
    ?>
    </div>
    </div>
    </div>

    <?php } ?>

    <?php
    if ($Session_ProductoTres != "") {
    ?>
    
    <div class="border mb-3">
    <div class="p-3">
    <div class="" style="font-size: 1.2em;">
    <label style="border-bottom: 2px solid #4f4f4f;">Producto: <b><?=$Session_ProductoTres;?></b></label>
    </div>
    <div class="row" style="margin-top: 10px;">
    
    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
    <div class="mb-2" style="overflow-y: hidden;"> 
    <table class="table table-bordered table-sm">
      <thead>
      <tr>
      <th class="text-center text-secondary">Volumen (Lt) Inicial</th>
      <th class="text-center text-secondary">Volumen (Lt) de venta</th>
      <th colspan="2" class="text-center text-secondary">Volumen (Lt) Final</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <?php
        $sql_reportepro1 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporteCre."' and fecha = '".$fechaFormato."' and producto = '".$Session_ProductoTres."' ";
        $result_reportepro1 = mysqli_query($con, $sql_reportepro1);
        $numero_reportepro1 = mysqli_num_rows($result_reportepro1);
        while($row_reportepro1 = mysqli_fetch_array($result_reportepro1, MYSQLI_ASSOC)){
        $idProducto = $row_reportepro1['id'];
        $volInicial3 = $row_reportepro1['volumen_inicial'];
        $volVenta3 = $row_reportepro1['volumen_venta'];
        $volFinal3 = $row_reportepro1['volumen_final'];
        echo "<td class='text-center' style='padding: 0;'><input type='number' id='inputvi$idProducto' onchange='bntvli($idProducto)' min='0' step='any' class='form-control' value='".$row_reportepro1['volumen_inicial']."' placeholder='Volumen (Lt) Inicial' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
        echo "<td class='text-center' style='padding: 0;'><input type='number' id='inputvv$idProducto' onchange='bntvv($idProducto)' min='0' step='any' class='form-control' value='".$row_reportepro1['volumen_venta']."' placeholder='Volumen (Lt) de venta' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
        echo "<td class='text-center' style='padding: 0;'><input type='number' id='inputvf$idProducto' onchange='bntvf($idProducto)' min='0' step='any' class='form-control' value='".$row_reportepro1['volumen_final']."' placeholder='Volumen (Lt) Final' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";

        }
        ?>
      </tr>
      </tbody>
    </table>
  </div>
    </div>
    

    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
      <div class="mb-2" style="overflow-y: hidden;"> 
      <table class="table table-bordered table-sm">
        <thead>
        <tr>
          <th class="text-center text-secondary font-weight-bold align-middle" width="60px"><a onclick="AgregarPipa(<?=$idProducto;?>)" style="cursor:pointer"><img src="<?php echo RUTA_IMG_ICONOS."mas-black-16.png"; ?>"></a> Pipa</th>
          <th class="text-center text-secondary font-weight-bold align-middle">Volumen (Lt) de Compra</th>
          <th class="text-center text-secondary font-weight-bold align-middle">Precio ($) por litro de producto</th>
          <th class="text-center text-secondary font-weight-bold align-middle">Costo ($) del flete mas IVA</th>
          <th class="text-center text-secondary font-weight-bold align-middle">No. De factura</th>
           <th class="text-center text-secondary font-weight-bold align-middle">Nombre o Razón Social del Transportista</th>
          <th class="text-center text-secondary font-weight-bold align-middle" >Importe</th>
          <td class="align-middle"><a onclick="" style="cursor:pointer"><img src="<?php echo RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>"></a></td>
          </tr>
        <tbody>
          <?php
          $sql_reportepipas3 = "SELECT * FROM re_reporte_cre_pipas WHERE id_re_producto = '".$idProducto."' ";
          $result_reportepipas3 = mysqli_query($con, $sql_reportepipas3);
          $numero_reportepipas3 = mysqli_num_rows($result_reportepipas3);
          if($numero_reportepipas3 > 0){
          while($row_reportepipas3 = mysqli_fetch_array($result_reportepipas3, MYSQLI_ASSOC)){
            $idPipa  = $row_reportepipas3['id'];
            $num = $row_reportepipas3['pipa_numero'];

            echo "<tr>";
            echo "<td class='text-center align-middle'>".$row_reportepipas3['pipa_numero']."</td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='number' id='1$idPipa$num' onchange='BtnPipas(1,$idPipa,$num)' min='0' step='any' class='form-control' value='".$row_reportepipas3['volumen']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='number' id='2$idPipa$num' onchange='BtnPipas(2,$idPipa,$num)' min='0' step='any' class='form-control' value='".$row_reportepipas3['precio_litro']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;' disabled></td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='number' id='3$idPipa$num' onchange='BtnPipas(3,$idPipa,$num)' min='0' step='any' class='form-control' value='".$row_reportepipas3['costo_flete']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
            echo "<td class='text-center align-middle' style='padding: 0;'><input type='text' id='4$idPipa$num' onchange='BtnPipas(4,$idPipa,$num)' class='form-control' value='".$row_reportepipas3['no_factura']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";

            echo "<td class='align-middle' style='padding: 0;'><input type='text' id='5$idPipa$num' onchange='BtnPipas(5,$idPipa,$num)' class='form-control' value='".$row_reportepipas3['nombre_razonsocial']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";

            echo "<td class='text-right align-middle' style='padding: 0;'><input type='number' id='6$idPipa$num' onchange='BtnPipas(6,$idPipa,$num)' min='0' step='any' class='form-control text-right' value='".$row_reportepipas3['importe_total']."' style='border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;'></td>";
            ?>
            <td class="align-middle"><a onclick="deletPipa(<?=$idPipa;?>)" style="cursor:pointer"><img src="<?php echo RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>"></a></td>
            <?php
            echo "</tr>";
            $tovolcompra3 = $tovolcompra3 + $row_reportepipas1['volumen'];
          }
        }else{
          echo "<tr><td colspan='5' class='text-center text-secondary' style='font-size: .9em;'>No se encontró información</td></tr>";
        }
          ?>
        </tbody>
      </thead>
      </table>
    </div>
    </div>
    <?php
    $mermapr3 = $volInicial3 + $tovolcompra3 - $volVenta3 - $volFinal3;
    echo "<div class='col-12'>
      <hr>
      <label class='font-weight-bold' style='font-size: 1.2em;'>Total Merma:</label> <label class='font-weight-bold text-danger' style='font-size: 1.2em;'>".$mermapr3."</label> </div>";
    ?>
    </div>
    </div>
    </div>

    <?php } ?>


    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade" id="ModalAgregar" >
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 0px;border: 0px;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar Pipa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="" action="" method="post">

          <div class="modal-body">
          <input type="hidden" id="Idresult" name="idresult">

          <div class="form-group">
           <label class="text-secondary" style="font-size: .9em;">Volumen (Lt) de Compra</label>
           <input type="number" min="0" step="any" class="form-control" id="voco" name="voco" style="border-radius: 0px;" onkeyup="VolumenCompra(this)" required>
           </div>
           <div class="form-group">
            <label class="text-secondary" style="font-size: .9em;">Precio ($) por litro de producto</label>
            <input type="number" class="form-control" id="ppl" name="ppl" style="border-radius: 0px;" disabled>
            </div>
            <div class="form-group">
             <label class="text-secondary" style="font-size: .9em;">Costo ($) del flete mas IVA</label>
             <input type="number" min="0" step="any" class="form-control" name="cofl" style="border-radius: 0px;" required>
             </div>
             <div class="form-group">
              <label class="text-secondary" style="font-size: .9em;">No. De factura</label>
              <input type="text" class="form-control" name="numfac" style="border-radius: 0px;" required>
              </div>

             <div class="form-group">
             <label class="text-secondary" style="font-size: .9em;">Nombre o Razón Social del Transportista</label>
             <input type="text" class="form-control" name="razontransportista" style="border-radius: 0px;" required>
             </div>

              <div class="form-group">
             <label class="text-secondary" style="font-size: .9em;">Importe</label>
             <input type="number" min="0" step="any" class="form-control" id="imto" name="imto" style="border-radius: 0px;" required onkeyup="Importe(this)">
             </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="BtnGuardar" style="border-radius: 0px;border: 0px;">Guardar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ModalEditarFecha" >
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 0px;border: 0px;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar fecha actual</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
          <input type="date" id="fechaanterior" style="display: none;">

          <input type="date" id="fechanueva" min="<?=$dia_min;?>" max="<?=$dia_max;?>" class="form-control form-control-lg" style="border-radius: 0px;">
          <div id="resultFecha"></div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="EditFecha()" style="border-radius: 0px;border: 0px;">Guardar</button>
          </div>
        </div>
      </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
