<?php
require('app/help.php');


$sql_resultado = "SELECT * FROM tb_implementacion_sasisopa_procedimientos WHERE id_reporte = '".$idReporte."' ";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);

$sql_reporte = "SELECT fecha_hora FROM tb_implementacion_sasisopa WHERE id = '".$idReporte."' ";
$result_reporte = mysqli_query($con, $sql_reporte);
$numero_reporte = mysqli_num_rows($result_reporte);
$row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC);
$explode = explode(" ", $row_reporte['fecha_hora']);
$fechahora = $explode[0];

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
  background: url('../imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
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

function EditFecha(id,idReporte){

var Fecha = $('#Fecha' + id).val();
var Titulo = $('#Titulo' + id).text();

 var parametros = {
     "accion" : "actualizar-fecha-procedimiento",
      "id" : id,
      "Fecha" : Fecha
    };

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/InformeDesempenoControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
    $('#borderF' + id).css('border','');  
     }
     });

}

function EditDescripcion(id,idReporte){

var Descripcion = $('#Descripcion' + id).val();
var Titulo = $('#Titulo' + id).text();

var parametros = {
   "accion" : "actualizar-descripcion-procedimiento",
    "id" : id,
    "Descripcion" : Descripcion
  };

      $.ajax({
   data:  parametros,
   url:   '../app/controlador/InformeDesempenoControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
      $('#bordedesc' + id).css('border','');
   }
   });
}

    function EditObservacion(id,idReporte){

    var Observaciones = $('#Observaciones' + id).val();
    var Titulo = $('#Titulo' + id).text();

    var parametros = {
        "accion" : "actualizar-observaciones-procedimiento",
        "id" : id,
        "Observaciones" : Observaciones
        };

        $.ajax({
        data:  parametros,
        url:   '../app/controlador/InformeDesempenoControlador.php',
        type:  'post',
        beforeSend: function() {
        },
        complete: function(){
        },
        success:  function (response) { 
        }
        });
    }

  function Csi(id,idReporte){

    var Titulo = $('#Titulo' + id).text();

    var parametros = {
      "accion" : "actualizar-conocer-procedimiento",
      "id" : id,
      "estado": 1
    };

        $.ajax({
     data:  parametros,
     url:   '../app/controlador/InformeDesempenoControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {    
     }
     });

  }
  function Cno(id,idReporte){

  var Titulo = $('#Titulo' + id).text();

 var parametros = {
    "accion" : "actualizar-conocer-procedimiento",
      "id" : id,
      "estado": 2
    };

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/InformeDesempenoControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {   
     }
     });

  }

  //---------------------------------------------------

  function Puestos(id,idPuesto){

  var Puesto = $('#CHT' + idPuesto + id).text();
  var Titulo = $('#Titulo' + id).text();
  var estado = 0;

    if( $('#CH' + idPuesto + id).is(':checked') ) {
    estado = 1;
    } else {
    estado = 0;
    }

    var parametros = {
      "accion" : "actualizar-puesto-procedimiento",
      "id" : id,
      "idPuesto" : idPuesto,
      "Puesto" : Puesto,
      "estado" : estado
    };

      $.ajax({
     data:  parametros,
     url:   '../app/controlador/InformeDesempenoControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {    
     }
     });
  }

  function EditFechaPro(idReporte){

    var Fecha = $('#Fecha').val();

     var parametros = {
      "accion" : "actualizar-conocer-procedimiento",
      "id" : idReporte,
      "Fecha": Fecha,
      "estado": 3
    };

        $.ajax({
     data:  parametros,
     url:   '../app/controlador/InformeDesempenoControlador.php',
     type:  'post',
     beforeSend: function() {

     },
     complete: function(){


     },
     success:  function (response) {
     
     
     }
     });

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
    <div class="float-left"><h4>Control de la implementación de los procedimientos del SASISOPA</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
      </div>
    <div class="card-body">

       <div class="row"> 
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
    Fecha:
    <input type="date" class="form-control " id="Fecha" value="<?=$fechahora;?>" onchange="EditFechaPro(<?=$idReporte;?>)">
</div>
</div> 

<div class="mb-2 mt-3" style="overflow-y: hidden;">
 <table class="table table-bordered table-sm">
  <thead>
   <tr>
     <th class="text-center align-middle">Fecha de implementación</th>
     <th class="text-center align-middle">Nombre del procedimiento</th>
     <th class="text-center align-middle" width="300px">Breve descripción de la implementación </th>
     <th class="text-center align-middle">
      <div class="border-bottom pb-1">Se dio a conocer la implementación</div>
      <div><label class="border-right pr-3 pl-2">Si</label> <label class="pl-2 pr-2">No</label></div>
    </th>
    <th class="text-center align-middle">Puestos de personal enterados de la implementación</th>
    <th class="text-center align-middle" width="300px">Observaciones</th>
   </tr>
   </thead>
   <tbody>    
   
    <?php
    while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){

      $id = $row_resultado['id'];

      if ($row_resultado['fecha_implementacion'] == "0000-00-00") {
      $bordefecha = "border: 2px solid #A52525";
      $fechaimplementacion = "";      
      }else{
      $bordefecha = "";
      $fechaimplementacion = $row_resultado['fecha_implementacion'];
      }

      if ($row_resultado['informacion'] == "Si") {
      $ChSi = "checked";
      }else{
      $ChSi = ""; 
      }

      if ($row_resultado['informacion'] == "No") {
      $ChNo = "checked";
      }else{
      $ChNo = ""; 
      }

      if ($row_resultado['descripcion'] == "") {
      $bordedesc = "border: 2px solid #A52525";
      }else{
      $bordedesc = "";  
      }

      echo "<tr>";
      echo "<td class='p-1 align-middle' id='borderF$id' style='$bordefecha'><input id='Fecha$id' height='100%' width='100%' type='date' class='form-control rounded-0 border border-white' value='".$fechaimplementacion."' onchange='EditFecha($id,$idReporte)'></td>";
      echo "<td class='align-middle' id='Titulo$id'><b>".$row_resultado['procedimiento']."</b></td>";
      echo "<td class='p-1' id='bordedesc$id' style='$bordedesc'>      
      <textarea class='form-control rounded-0 border-0' id='Descripcion$id' onchange='EditDescripcion($id,$idReporte)' rows='3'>".$row_resultado['descripcion']."</textarea>
      </td>";
      echo "<td class='align-middle'>

      <div class='row'>

      <div class='col-6 text-center'>
          <input class='' type='radio' name='Conocer$id' id='si$id' value='Si' onchange='Csi($id,$idReporte);' $ChSi>
          <label class='form-check-label' for='si$id'>
            <b>Si</b>
          </label>
      </div>

      <div class='col-6 text-center'>
          <input class='' type='radio' name='Conocer$id' id='no$id' value='No' onchange='Cno($id,$idReporte);' $ChNo>
          <label class='form-check-label' for='no$id'>
            <b>No</b>
          </label>
      </div>
      </div>

</td>";

$sql_ch1 = "SELECT * FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."' AND id_lista = 1 ";
$result_ch1 = mysqli_query($con, $sql_ch1);
$numero_ch1 = mysqli_num_rows($result_ch1);

$sql_ch2 = "SELECT * FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."' AND id_lista = 2 ";
$result_ch2 = mysqli_query($con, $sql_ch2);
$numero_ch2 = mysqli_num_rows($result_ch2);

$sql_ch3 = "SELECT * FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."' AND id_lista = 3 ";
$result_ch3 = mysqli_query($con, $sql_ch3);
$numero_ch3 = mysqli_num_rows($result_ch3);

$sql_ch4 = "SELECT * FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."' AND id_lista = 4 ";
$result_ch4 = mysqli_query($con, $sql_ch4);
$numero_ch4 = mysqli_num_rows($result_ch4);

$sql_ch5 = "SELECT * FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."' AND id_lista = 5 ";
$result_ch5 = mysqli_query($con, $sql_ch5);
$numero_ch5 = mysqli_num_rows($result_ch5);

$sql_ch6 = "SELECT * FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."' AND id_lista = 6 ";
$result_ch6 = mysqli_query($con, $sql_ch6);
$numero_ch6 = mysqli_num_rows($result_ch6);

$sql_ch7 = "SELECT * FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."' AND id_lista = 7 ";
$result_ch7 = mysqli_query($con, $sql_ch7);
$numero_ch7 = mysqli_num_rows($result_ch7);

echo "<td>";
echo "<div class=''>";

if ($numero_ch1 > 0) {
echo "<div class='text-center mb-2'>";
echo "<input type='checkbox' value='' id='CH1$id' onchange='Puestos($id,1);' checked>
      <label for='CH1$id' id='CHT1$id'>Representante Técnico</label>";
echo "</div>";     


}else{

echo "<div class='text-center mb-2'>";
echo "<input type='checkbox' value='' id='CH1$id' onchange='Puestos($id,1);'>
      <label for='CH1$id' id='CHT1$id'>Representante Técnico</label>";
echo "</div>";     
}

if ($numero_ch2 > 0) {
echo "<div class='text-center mb-2'>";
echo " <input type='checkbox' value='' id='CH2$id' onchange='Puestos($id,2)' checked>
      <label for='CH2$id' id='CHT2$id'>Gerente</label>";
echo "</div>";      

}else{
echo "<div class='text-center mb-2'>";
echo " <input type='checkbox' value='' id='CH2$id' onchange='Puestos($id,2)'>
      <label for='CH2$id' id='CHT2$id'>Gerente</label>";
echo "</div>";    
}

if ($numero_ch3 > 0) {
echo "<div class='text-center mb-2'>";
echo "<input type='checkbox' value='' id='CH3$id' onchange='Puestos($id,3)' checked>
      <label for='CH3$id' id='CHT3$id'>Jefe de Piso</label>";
echo "</div>";   

}else{
echo "<div class='text-center mb-2'>";
echo "<input type='checkbox' value='' id='CH3$id' onchange='Puestos($id,3)'>
      <label for='CH3$id' id='CHT3$id'>Jefe de Piso</label>";
echo "</div>";    
}

if ($numero_ch4 > 0) {
echo "<div class='text-center mb-2'>";
echo "<input type='checkbox' value='' id='CH4$id' onchange='Puestos($id,4)' checked>
      <label for='CH4$id' id='CHT4$id'>Facturista</label>";
echo "</div>";     

}else{
echo "<div class='text-center mb-2'>";
echo " <input type='checkbox' value='' id='CH4$id' onchange='Puestos($id,4)'>
      <label for='CH4$id' id='CHT4$id'>Facturista</label>";
echo "</div>";     

}

if ($numero_ch5 > 0) {
echo "<div class='text-center mb-2'>";
echo "<input type='checkbox' value='' id='CH5$id' onchange='Puestos($id,5)' checked>
      <label for='CH5$id' id='CHT5$id'>Despachador</label>";
echo "</div>";      

}else{
echo "<div class='text-center mb-2'>";
echo "<input type='checkbox' value='' id='CH5$id' onchange='Puestos($id,5)'>
      <label for='CH5$id' id='CHT5$id'>Despachador</label>";
echo "</div>";      

}

if ($numero_ch6 > 0) {
echo "<div class='text-center mb-2'>";
echo "<input type='checkbox' value='' id='CH6$id' onchange='Puestos($id,6)' checked>
      <label for='CH6$id' id='CHT6$id'>Auxiliar administrativo</label>";
echo "</div>";    

}else{
echo "<div class='text-center mb-2'>";
echo "<input type='checkbox' value='' id='CH6$id' onchange='Puestos($id,6)'>
      <label for='CH6$id' id='CHT6$id'>Auxiliar administrativo</label>";
echo "</div>";   

}

if ($numero_ch7 > 0) {
echo "<div class='text-center mb-2'>";
echo "<input type='checkbox' value='' id='CH7$id' onchange='Puestos($id,7)' checked>
      <label for='CH7$id' id='CHT7$id'>Mantenimiento</label>";
echo "</div>";   

}else{
echo "<div class='text-center mb-2'>";
echo "<input type='checkbox' value='' id='CH7$id' onchange='Puestos($id,7)'>
    <label for='CH7$id' id='CHT7$id'>Mantenimiento</label>";
echo "</div>";    

}
  
echo "</td>";


      echo "<td class='p-1'><textarea class='form-control rounded-0 border-0' rows='11' id='Observaciones$id' onchange='EditObservacion($id,$idReporte)' rows='3'>".$row_resultado['observaciones']."</textarea></td>";
      echo "</tr>";

    }
    ?>
    </tbody>
 </table>
</div>


    </div>
    </div>
    </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>


