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

function ValidaCalibracionEquipo($id_registro,$nom_equipo,$realizadopor,$con){

$sql = "SELECT * FROM sgm_bitacora_calibracion_equipo WHERE id_programa = '".$id_registro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

$sql_insert = "INSERT INTO sgm_bitacora_calibracion_equipo (
id_programa,
fecha,
hora,
nombre_equipo,
marca,
capacidad,
almacena,
nombre_laboratorio,
no_acreditacion,
metodo_calibracion,
nombre_patron,
marca_modelo_serie,
resolucion,
incertidumbre,
vigencia_certificado,
realizadopor
  )
  VALUES (
  '".$id_registro."',
  '','','".$nom_equipo."','','',
  '','','','','',
  '','','','','".$realizadopor."'
  )";
  if(mysqli_query($con, $sql_insert)){
  return true;
  }else{
  return false;
  }

}else{
return false;
}

}

function equipoBitacora($id_programa,$id_estacion,$nombre,$con){

$sql = "SELECT * FROM sgm_bitacora_calibracion_equipo_detalle WHERE id_programa = '".$id_programa."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

$sql_equipo = "SELECT * FROM sgm_inventario_equipo WHERE id_estacion = '".$id_estacion."' AND nombre = '".$nombre."' ";
$result_equipo = mysqli_query($con, $sql_equipo);
$numero_equipo = mysqli_num_rows($result_equipo);
while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){

$sql_insert = "INSERT INTO sgm_bitacora_calibracion_equipo_detalle (
id_programa,
id_equipo,
resultado
  )
  VALUES (
  '".$id_programa."',
  '".$row_equipo['id']."',
  ''
  )";
  mysqli_query($con, $sql_insert);

}
}

}

$sql_rp = "SELECT
sgm_autorizado.id_usuario,
sgm_autorizado.estado,
tb_usuarios.id_gas
FROM sgm_autorizado 
INNER JOIN tb_usuarios 
ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE tb_usuarios.id_gas = '".$Session_IDEstacion."' AND sgm_autorizado.estado = 1 LIMIT 1";
$result_rp = mysqli_query($con, $sql_rp);
$numero_rp = mysqli_num_rows($result_rp);
if ($numero_rp > 0) {
$row_rp = mysqli_fetch_array($result_rp, MYSQLI_ASSOC);
$realizadopor = $row_rp['id_usuario'];
}else{
$realizadopor = 0;
}

 
ValidaCalibracionEquipo($GET_idRegistro,$programaAnual['nombre'],$realizadopor,$con);

$sql = "SELECT * FROM sgm_bitacora_calibracion_equipo WHERE id_programa = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id_bitacora = $row['id'];
$fecha = $row['fecha'];
$hora = $row['hora'];
$nombreequipo = $row['nombre_equipo'];
$marca = $row['marca'];
$capacidad = $row['capacidad'];
$almacena = $row['almacena'];
$nombre_laboratorio = $row['nombre_laboratorio'];
$no_acreditacion = $row['no_acreditacion'];
$metodo_calibracion = $row['metodo_calibracion'];
$nombre_patron = $row['nombre_patron'];
$marca_modelo_serie = $row['marca_modelo_serie'];
$resolucion = $row['resolucion'];
$incertidumbre = $row['incertidumbre'];
$vigencia_certificado = $row['vigencia_certificado'];

equipoBitacora($GET_idRegistro,$programaAnual['idestacion'],$programaAnual['nombre'],$con);
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
  <link rel="stylesheet" href="<?=RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <style media="screen">
  .LoaderPage {
  position: fixed;
  left: 0px;
  top: 0px; 
  width: 100%;
  height: 100%; 
  z-index: 9999;
  background: white;
  background: url('../imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
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

  function EditarBitacora(e,id_bitacora,cate){

    var parametros = {
    "idbitacora" : id_bitacora,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto7/editar-bitacora-calibracion-equipo.php',
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
     url:   '../app/vistas/sgm/punto7/editar-bitacora-calibracion-equipo.php',
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
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Finalizar Bitácora la para la calibración de equipos?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }
  </script>
  </head>
  <body>
    <div class="LoaderPage"></div>

    <div class="fixed-top navbar-admin">
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
    <ol class="breadcrumb breadcrumb-caret">
    <li class="breadcrumb-item text-primary c-pointer" onclick="window.history.go(-3);"><i class="fa-solid fa-house"></i> SGM</li>
    <li aria-current="page" class="breadcrumb-item c-pointer" onclick="regresarP(-2)">7. Procesos de medición</li>
    <li aria-current="page" class="breadcrumb-item c-pointer" onclick="regresarP()">Bitácora la para la calibración de equipos</li>
    <li aria-current="page" class="breadcrumb-item active">Editar</li>
    </ol>
    </div>
    <!-- Fin -->

    <h3>Bitácora la para la calibración de equipos</h3>

    <div class="bg-white p-3 mt-3">

<table class="table table-bordered table-sm">
  <tbody>
    <tr>
      <td class="align-middle" width="700"><b>Fecha:</b></td>
      <td class="p-0 m-0"><input type="date" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,1)" value="<?=$fecha;?>"></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>Hora:</b></td>
      <td class="p-0 m-0"><input type="time" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,2)" value="<?=$hora;?>"></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>Nombre del equipo a calibrar:</b></td>
      <td class="align-middle p-2"><?=$nombreequipo;?></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>Marca:</b></td>
      <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,4)" value="<?=$marca;?>"></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>Capacidad:</b></td>
      <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,5)" value="<?=$capacidad;?>"></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>Producto que almacena:</b></td>
      <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,6)" value="<?=$almacena;?>"></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>Nombre del laboratorio o unidad de verificación encargada de la calibración:</b></td>
      <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,7)" value="<?=$nombre_laboratorio;?>"></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>No de acreditación o aprobación:</b></td>
      <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,8)" value="<?=$no_acreditacion;?>"></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>Método utilizado para la calibración:</b></td>
      <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,9)" value="<?=$metodo_calibracion;?>"></td>
    </tr>
  </tbody>
</table>

<h5>Descripción de patrones utilizados</h5>

<table class="table table-bordered table-sm">
  <tbody>
    <tr>
      <td class="align-middle" width="700"><b>Nombre del patrón</b></td>
      <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,10)" value="<?=$nombre_patron;?>"></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>Marca y modelo y serie</b></td>
      <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,11)" value="<?=$marca_modelo_serie;?>"></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>Resolución</b></td>
      <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,12)" value="<?=$resolucion;?>"></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>Incertidumbre</b></td>
      <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,13)" value="<?=$incertidumbre;?>"></td>
    </tr>
    <tr>
      <td class="align-middle" width="700"><b>Vigencia de su certificado de calibración</b></td>
      <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,<?=$id_bitacora;?>,14)" value="<?=$vigencia_certificado;?>"></td>
    </tr>
  </tbody>
</table>

<table class="table table-bordered table-sm">
  <thead>
    <th>Equipo o Instrumento</th>
    <th>Identificacion</th>
    <th>Resultado</th>
  </thead>
  <tbody>
    <?php 

    $sql_equipo = "SELECT
    sgm_bitacora_calibracion_equipo_detalle.id,
    sgm_bitacora_calibracion_equipo_detalle.id_equipo,
    sgm_bitacora_calibracion_equipo_detalle.resultado,
    sgm_inventario_equipo.nombre,
    sgm_inventario_equipo.identificacion
    FROM sgm_bitacora_calibracion_equipo_detalle 
    INNER JOIN sgm_inventario_equipo 
    ON sgm_bitacora_calibracion_equipo_detalle.id_equipo = sgm_inventario_equipo.id
     WHERE sgm_bitacora_calibracion_equipo_detalle.id_programa = '".$GET_idRegistro."' ";
    $result_equipo = mysqli_query($con, $sql_equipo);
    $numero_equipo = mysqli_num_rows($result_equipo);
    while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){

    echo '<tr>
    <td>'.$row_equipo['nombre'].'</td>
    <td>'.$row_equipo['identificacion'].'</td>
    <td class="p-0 m-0"><input type="text" class="form-control border-0" onchange="EditarBitacora(this,'.$row_equipo['id'].',15)" value="'.$row_equipo['resultado'].'"></td>
    </tr>';

    }
    ?>
  </tbody>
</table>

<div class="text-end">
<button type="button" class="btn btn-primary rounded-0" onclick="Finalizar(1,<?=$GET_idRegistro;?>,16)">Finalizar bitacora</button>
</div>

  </div>
  </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

