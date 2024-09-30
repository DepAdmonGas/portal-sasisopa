<?php
require('app/help.php');

function programaAnual($id_registro,$con){

$sql = "SELECT 
sgm_programa_anual_calibracion_verificacion.id,
sgm_programa_anual_calibracion_verificacion.id_estacion,
sgm_programa_anual_calibracion_verificacion.fecha,
sgm_programa_anual_calibracion_verificacion.estado,
sgm_patrones_instrumentos.nombre,
sgm_patrones_instrumentos.periodicidad,
sgm_patrones_instrumentos.categoria
FROM sgm_programa_anual_calibracion_verificacion
INNER JOIN sgm_patrones_instrumentos 
ON sgm_programa_anual_calibracion_verificacion.id_equipo = sgm_patrones_instrumentos.id 
WHERE sgm_programa_anual_calibracion_verificacion.id = '".$id_registro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$idestacion = $row['id_estacion'];
$nombre = $row['nombre'];
$estado = $row['estado'];

$array = array('idestacion' => $idestacion, 'nombre' => $nombre, 'estado' => $estado);
return $array;
}
$programaAnual = programaAnual($GET_idRegistro,$con);


function responsableSGM($id_estacion, $con){
$sql = "SELECT
sgm_autorizado.id_usuario,
sgm_autorizado.estado,
tb_usuarios.id_gas
FROM sgm_autorizado 
INNER JOIN tb_usuarios 
ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE tb_usuarios.id_gas = '".$id_estacion."' AND sgm_autorizado.estado = 1 LIMIT 1";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$realizadopor = $row['id_usuario'];
}else{
$realizadopor = 0;
}
return $realizadopor;
}

function tanqueInformacion($id_programa,$id_estacion,$con){

$sql = "SELECT id_verificar FROM sgm_programa_anual_calibracion_verificacion WHERE id = '".$id_programa."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id_verificar = $row['id_verificar'];

$sql_ie = "SELECT identificacion FROM sgm_inventario_equipo WHERE id = '".$id_verificar."' ";
$result_ie = mysqli_query($con, $sql_ie);
$numero_ie = mysqli_num_rows($result_ie);
$row_ie = mysqli_fetch_array($result_ie, MYSQLI_ASSOC);
$no_tanque = $row_ie['identificacion'];

$sql_ta = "SELECT capacidad, producto FROM tb_tanque_almacenamiento WHERE id_estacion = '".$id_estacion."' AND no_tanque = '".$no_tanque."' ";
$result_ta = mysqli_query($con, $sql_ta);
$numero_ta = mysqli_num_rows($result_ta);
$row_ta = mysqli_fetch_array($result_ta, MYSQLI_ASSOC);
$capacidad = $row_ta['capacidad'];
$producto = $row_ta['producto'];

return $array = array('no_tanque' => $no_tanque, 'capacidad' => $capacidad, 'producto' => $producto);
}

function bitacoraVerificacion($id_programa,$no_tanque,$capacidad,$producto,$responsableSGM,$con){

$sql = "SELECT * FROM sgm_bitacora_verificacion_sensores WHERE id_programa = '".$id_programa."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

  $sql_insert = "INSERT INTO sgm_bitacora_verificacion_sensores (
  id_programa,
  fecha,
  hora,
  no_tanque,
  marca,
  capacidad,
  producto,
  interno_externo,
  verificacion_movimiento,
  metodo_nivel,
  realizadopor
  )
  VALUES (
  '".$id_programa."',
  '',
  '',
  '".$no_tanque."',
  '',
  '".$capacidad."',
  '".$producto."',
  '',
  '',
  '',
  '".$responsableSGM."'
  )";
  if(mysqli_query($con, $sql_insert)){
  return true;
  }else{
  return false;
  }

}

}

function bitacoraDetalleResultado($id_programa,$con){

$sql = "SELECT id FROM sgm_bitacora_verificacion_resultado WHERE id_programa = '".$id_programa."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

$sql_ta = "SELECT id FROM sgm_bitacora_verificacion_lista ";
$result_ta = mysqli_query($con, $sql_ta);
$numero_ta = mysqli_num_rows($result_ta);
while($row_ta = mysqli_fetch_array($result_ta, MYSQLI_ASSOC)){

  $sql_insert = "INSERT INTO sgm_bitacora_verificacion_resultado (
  id_programa,id_lista,resultado 
  )
  VALUES (
  '".$id_programa."',
  '".$row_ta['id']."',
  ''
  )";
  mysqli_query($con, $sql_insert);

}
}
}

function contenidoTabla($id_programa,$cate,$con){
$contenido = '';
$sql = "SELECT
sgm_bitacora_verificacion_resultado.id,
sgm_bitacora_verificacion_resultado.id_lista,
sgm_bitacora_verificacion_resultado.resultado,
sgm_bitacora_verificacion_lista.pregunta
FROM sgm_bitacora_verificacion_resultado 
INNER JOIN sgm_bitacora_verificacion_lista 
ON sgm_bitacora_verificacion_resultado.id_lista = sgm_bitacora_verificacion_lista.id WHERE sgm_bitacora_verificacion_resultado.id_programa = '".$id_programa."' AND sgm_bitacora_verificacion_lista.categoria = '".$cate."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);


$contenido .= '<tbody>';
$contenido .= '<tr class="bg-secondary text-white">
<td class="align-middle"><b>'.$cate.'</b></td> 
<td class="align-middle text-center"><b>Resultado</b></td></tr>';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$contenido .= '<tr>
<td class="align-middle">'.$row['pregunta'].'</td>
<td class="p-0 m-0" width="400px"><input type="text" class="form-control border-0" value="'.$row['resultado'].'" onchange="Editar(this,'.$row['id'].',10)"></td>
</tr>';
}
$contenido .= '</tbody>';

return $contenido;
}

$tanque = tanqueInformacion($GET_idRegistro,$Session_IDEstacion,$con);
$responsableSGM = responsableSGM($Session_IDEstacion, $con);
bitacoraVerificacion($GET_idRegistro,$tanque['no_tanque'],$tanque['capacidad'],$tanque['producto'],$responsableSGM,$con);
bitacoraDetalleResultado($GET_idRegistro,$con);
//--------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------

$sql_bitacora = "SELECT * FROM sgm_bitacora_verificacion_sensores WHERE id_programa = '".$GET_idRegistro."' ";
$result_bitacora = mysqli_query($con, $sql_bitacora);
$numero_bitacora = mysqli_num_rows($result_bitacora);
$row_bitacora = mysqli_fetch_array($result_bitacora, MYSQLI_ASSOC);
  
  $id = $row_bitacora['id'];
  $fecha = $row_bitacora['fecha'];
  $hora = $row_bitacora['hora'];
  $no_tanque = $row_bitacora['no_tanque'];
  $marca = $row_bitacora['marca'];
  $capacidad = $row_bitacora['capacidad'];
  $producto = $row_bitacora['producto'];
  $interno_externo = $row_bitacora['interno_externo'];
  $verificacion_movimiento = $row_bitacora['verificacion_movimiento'];
  $metodo_nivel = $row_bitacora['metodo_nivel'];
  $realizadopor = $row_bitacora['realizadopor'];

  ?> 
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SGM</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link href="<?=RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
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
  background: white;
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }
    .grayscale {
    filter: opacity(50%); 
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

  function Editar(e,id,cate){

    var parametros = {
    "id" : id,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto7/editar-bitacora-verificacion-equipo-medicion.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {


     }
     });
  }

    function Finalizar(e,id_bitacora,cate){

   alertify.confirm('',
  function(){

    var parametros = {
    "idbitacora" : id_bitacora,
    "valor" : e,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto7/editar-bitacora-verificacion-equipo-medicion.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

      regresarP();

     }
     });

  },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Finalizar Bitácora para la verificación de equipos de medicion?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    <div class="float-left"><h4>Bitácora para la verificación de equipos de medicion</h4></div>

    </div>
   
    <div class="card-body">

    <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td class="align-middle" width="1000"><b>Fecha:</b></td>
            <td class="p-0 m-0"><input type="date" class="form-control border-0" value="<?=$fecha;?>" onchange="Editar(this,<?=$id;?>,1)"></td>
          </tr>
          <tr>
            <td class="align-middle" width="1000"><b>Hora:</b></td>
            <td class="p-0 m-0"><input type="time" class="form-control border-0" value="<?=$hora;?>" onchange="Editar(this,<?=$id;?>,2)"></td>
          </tr>
          <tr class="bg-secondary text-white">
            <td><b>Verificacion de sensores de nivel y temperatura</b></td>
            <td><b>Resultado</b></td>
          </tr>
          <tr>
            <td class="align-middle" width="1000"><b>No de tanque:</b></td>
            <td class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$no_tanque;?>" onkeyup="Editar(this,<?=$id;?>,3)"></td>
          </tr>
          <tr>
            <td class="align-middle" width="1000"><b>Marca:</b></td>
            <td class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$marca;?>" onkeyup="Editar(this,<?=$id;?>,4)"></td>
          </tr>
          <tr>
            <td class="align-middle" width="1000"><b>Capacidad:</b></td>
            <td class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$capacidad;?>" onkeyup="Editar(this,<?=$id;?>,5)"></td>
          </tr>
          <tr>
            <td class="align-middle" width="1000"><b>Producto que almacena:</b></td>
            <td class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$producto;?>" onkeyup="Editar(this,<?=$id;?>,6)"></td>
          </tr>
          <tr>
            <td class="align-middle" width="1000"><b>La verificación es realizada por personal Interno o Externo, ( en caso de ser externo colocar nombre de la empresa y datos relevantes):</b></td>
          <td class="p-0 m-0">
              <textarea class="form-control border-0" onkeyup="Editar(this,<?=$id;?>,7)"><?=$interno_externo;?></textarea>
          </tr>
          <tr>
            <td class="align-middle" width="1000"><b>Al momento de iniciar la calibración se asegura que el producto se encuentre sin movimiento:</b></td>
            <td class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$verificacion_movimiento;?>" onkeyup="Editar(this,<?=$id;?>,8)"></td>
          </tr>
          <tr>
            <td class="align-middle" width="1000"><b>Método para determinar el nivel liquido dentro del tanque (Inmersión o medida seca):</b></td>
            <td class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$metodo_nivel;?>" onkeyup="Editar(this,<?=$id;?>,9)"></td>
          </tr>
        </tbody>
      </table>


<table class="table table-bordered table-sm">
  <?php 

  echo contenidoTabla($GET_idRegistro,'1. Aspecto a verificar en los patrones de referencia',$con);
  echo contenidoTabla($GET_idRegistro,'2. Sistema de nivel automático (tirilla del Sistema de Control de Inventarios)',$con);
  echo contenidoTabla($GET_idRegistro,'3. Medición de la cinta petrolera (en mm) y termómetro (en °C)',$con);
  echo contenidoTabla($GET_idRegistro,'4. Resultado: Diferencia entre ambas mediciones',$con);

  ?>
</table>

<div class="bg-light p-3">
  "<b>Nota 1:</b> Referente al nivel puede existir una variación de +/- 3 mm, sin embargo, para aplicaciones fiscales o de transferencia de custodia, los equipos deben cumplir con un EMP de Â± 4 mm, en todo el intervalo de medición.<br>
<b>Nota 2:</b> referente a la temperatura puede existir una variación igual o menor de 0.5 °C"   

</div>

  <div class="text-right mt-3">
  <button type="button" class="btn btn-primary rounded-0" onclick="Finalizar(1,<?=$GET_idRegistro;?>,11)">Finalizar bitacora de verificación</button>
  </div>


    </div>
    
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalAgregarEquipo" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div id="modalContenido"></div>
    </div>
    </div>
    </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

