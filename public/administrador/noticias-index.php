<?php
require('app/help.php');

/*
   for ($i = 1; $i <= 31; $i++) {

        $fecha_del_dia = '2023-01-'.$i;
        $hora_del_dia = '08:00:00';
     
        //$ClassMantenimiento->MantenimientoDia(6, $fecha_del_dia, $hora_del_dia, $con);
        $ClassMantenimiento->MantenimientoCalendario(6, $fecha_del_dia, $hora_del_dia, $con);

      }

    for ($i = 1; $i <= 28; $i++) {

        $fecha_del_dia = '2023-02-'.$i;
        $hora_del_dia = '08:00:00';
     
        //$ClassMantenimiento->MantenimientoDia(6, $fecha_del_dia, $hora_del_dia, $con);
        $ClassMantenimiento->MantenimientoCalendario(6, $fecha_del_dia, $hora_del_dia, $con);

      }

      for ($i = 1; $i <= 27; $i++) {

        $fecha_del_dia = '2023-03-'.$i;
        $hora_del_dia = '08:00:00';
     
        //$ClassMantenimiento->MantenimientoDia(6, $fecha_del_dia, $hora_del_dia, $con);
        $ClassMantenimiento->MantenimientoCalendario(6, $fecha_del_dia, $hora_del_dia, $con);

      }

*/
/*
$folio = 1;
$sql = "SELECT * FROM po_mantenimiento_verificar WHERE id_estacion = 6 AND YEAR(fechacreacion) = 2022 ORDER BY fechacreacion ASC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$id = $row['id'];

Editar($id,$folio,$con);

$folio++;
}

function Editar($id,$folio,$con){
$sql2 = "UPDATE po_mantenimiento_verificar SET
folio = '".$folio."'
 WHERE id = '".$id."' ";
mysqli_query($con, $sql2); 
}

*/
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
  background: white;
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  });
  function regresarP(){
   window.location.href = 'administrador-sasisopa';
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

    <div class="float-left"><h4>NOTICIAS</h4></div>
   

  <!-- BOTON DE AGREGAR (SIN FUNCIONALIDAD)
    <div class="float-right">
      <a onclick="AgregarUsuario()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar grupo" >
      <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
      </a>
    </div>

  -->

    </div>
    <div class="card-body">
    

    <form action="" method="post">

    <div class="row no-gutters">
      
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 mb-2">

        <select class="form-control" style="border-radius: 0px;" name="selnoticia">
        <option value="0">Selecciona la noticia</option>
        <option value="1">CONSULTA TU SASISOPA</option>
        <option value="2">PROGRAMA DE IMPLEMENTACION</option>
        <option value="3">1. POLÍTICA</option>        
        <option value="4">7. COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA</option>
        <option value="5">COMUNICADOS</option>
        <option value="6">10. CONTROL DE ACTIVIDADES Y PROCESOS</option>
        <option value="7">3. REQUISITOS LEGALES</option>
        <option value="8">4. OBJETIVOS, METAS E INDICADORES</option>
        <option value="9">9. MEJORES PRÁCTICAS Y ESTÁNDARES</option>
        <option value="10">8. CONTROL DE DOCUMENTOS Y REGISTROS</option>
        <option value="11">2. IDENTIFICACIÓN DE PELIGROS Y ASPECTOS AMBIENTALES, ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES</option>
        <option value="12">11. INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD</option>
        <option value="13">16. INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES</option>
        <option value="14">5. FUNCIONES, RESPONSABILIDADES Y AUTORIDAD</option>
      </select>
      </div>
     
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 mb-2 ">
        <button class="btn btn-primary float-right" style="border-radius: 0px;" name="BTNEnviar">Enviar Noticia</button>
      </div>

    </div>

    </form>

    <?php

  /*$sql_acreditado = "SELECT * FROM cu_evaluacion_modulos_detalle WHERE puntos > 70 ";
  $result_acreditado = mysqli_query($con, $sql_acreditado);
  $count_acreditado = mysqli_num_rows($result_acreditado);
  while($row_acreditado = mysqli_fetch_array($result_acreditado, MYSQLI_ASSOC)) {
  $evaluacionmodulo = $row_acreditado['id_evaluacion_modulo'];

  
  $sql_modulos = "SELECT * FROM cu_evaluacion_modulos WHERE id = '".$evaluacionmodulo."' ";
  $result_modulos = mysqli_query($con, $sql_modulos);
  $count_modulos = mysqli_num_rows($result_modulos);
  while($row_modulos = mysqli_fetch_array($result_modulos, MYSQLI_ASSOC)) {
  $num_modulo = $row_modulos['num_modulo'];
  $idTema = $row_modulos['id_evaluacion_tema'];
  }

  $modulosig = $num_modulo + 1;

  $sql_modulos = "SELECT * FROM cu_evaluacion_modulos WHERE id_evaluacion_tema = '".$idTema."' and num_modulo = '".$modulosig."' ";
  $result_modulos = mysqli_query($con, $sql_modulos);
  $count_modulos = mysqli_num_rows($result_modulos);

  if ($count_modulos == 1) {

$sql_update = "UPDATE cu_evaluacion_modulos SET estado = 1 WHERE id_evaluacion_tema = '".$idTema."' and num_modulo = '".$modulosig."' ";
  if (mysqli_query($con, $sql_update)) {}else{}

}else{

  $sql_temas = "SELECT * FROM cu_evaluacion_tema WHERE id_usuario = '".$Session_IDUsuarioBD."' and estado <> 1 ORDER BY id_tema asc LIMIT 1 ";
  $result_temas = mysqli_query($con, $sql_temas);
  $count_temas = mysqli_num_rows($result_temas);

 while($row_temas = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {
  $temas_id = $row_temas['id'];
  }

  $sql_update = "UPDATE cu_evaluacion_tema SET estado = 1 WHERE id = '".$temas_id."' ";
  if (mysqli_query($con, $sql_update)) {}else{}

}

$sql_update_em = "UPDATE cu_evaluacion_modulos SET estado = 3 WHERE id = '".$evaluacionmodulo."' ";
  if (mysqli_query($con, $sql_update_em)) {}else{}

  }
  */

    ?>


    <?php
if (isset($_POST['BTNEnviar'])) {

if ($_POST['selnoticia'] != 0) {

if ($_POST['selnoticia'] == 1) {


$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_gas = 9 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','CONSULTA TU SASISOPA','Ya está disponible tu SASISOPA da clic para poder visualizar el archivo en formato PDF.','".$hoy."','consulta-sasisopa',0)";
mysqli_query($con, $sql_insert);

}

}else if ($_POST['selnoticia'] == 2) {


$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_gas = 9 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','PROGRAMA DE IMPLEMENTACION','Ya está disponible el Programa de implementación del Sistema de Administración','".$hoy."','programa-implementacion',0)";
mysqli_query($con, $sql_insert);

}

}else if ($_POST['selnoticia'] == 3) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_puesto = 6 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','1. POLITICA','Ya esta disponible la nueva versión de Política.',
  '".$hoy."','1-politica',0)";
mysqli_query($con, $sql_insert);

$sql_insert1 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','1-politica',0)";
mysqli_query($con, $sql_insert1);

}

}else if ($_POST['selnoticia'] == 4) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_gas = 9 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','7. COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA','Ya está habilitado el elemento 7. COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA.',
  '".$hoy."','7-comunicacion-participacion-consulta',0)";
mysqli_query($con, $sql_insert);

$sql_insert1 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','7-comunicacion-participacion-consulta',0)";
mysqli_query($con, $sql_insert1);

}

}else if ($_POST['selnoticia'] == 5) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_gas = 9 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','COMUNICADOS','Ya puedes realizar comunicados a través del portal GestoLine.',
  '".$hoy."','comunicados',0)";
mysqli_query($con, $sql_insert);

}

}else if ($_POST['selnoticia'] == 6) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_gas = 9 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){

$sql_insert0 = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado,alerta)
VALUES ('".$row_usuarios['id']."','10. CONTROL DE ACTIVIDADES Y PROCESOS','Estimado usuario con la finalidad de mejorar el registro del programa anual de mantenimiento, trabajamos en una actualización que te permitirá modificar tu programa en caso de cometer algún error en cuanto a las fechas y actividades a desarrollar.

Da clic para actualizar tu programa.
',
  '".$hoy."','programa-anual-mantenimiento',0,0)";
mysqli_query($con, $sql_insert0);

$sql_insert2 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','programa-anual-mantenimiento',0)";
mysqli_query($con, $sql_insert2);


}
}else if ($_POST['selnoticia'] == 7) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_puesto = 6 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','3. REQUISITOS LEGALES','Ya está disponible tus Requisitos Legales.',
  '".$hoy."','3-requisitos-legales',0)";
mysqli_query($con, $sql_insert);

$sql_insert1 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','3-requisitos-legales',0)";
mysqli_query($con, $sql_insert1);

}

}else if ($_POST['selnoticia'] == 8) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_gas = 9 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','4. OBJETIVOS, METAS E INDICADORES','Ya está disponible Objetivos, Metas e Indicadores.',
  '".$hoy."','4-objetivos-metas-indicadores',0)";
mysqli_query($con, $sql_insert);

$sql_insert1 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','4-objetivos-metas-indicadores',0)";
mysqli_query($con, $sql_insert1);

$sql_insert2 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','indicadores-ventas',0)";
mysqli_query($con, $sql_insert2);

$sql_insert3 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','experiencia-del-cliente',0)";
mysqli_query($con, $sql_insert3);

$sql_insert4 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','agregar-experiencia-cliente',0)";
mysqli_query($con, $sql_insert4);

}

}else if ($_POST['selnoticia'] == 9) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_puesto = 6 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','9. MEJORES PRÁCTICAS Y ESTÁNDARES','Ya está disponible mejores prácticas y estándares, puedes descargar la NOM-005- ASEA 2016.',
  '".$hoy."','9-mejores-practicas-estandares',0)";
mysqli_query($con, $sql_insert);

$sql_insert1 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','9-mejores-practicas-estandares',0)";
mysqli_query($con, $sql_insert1);

}

}else if ($_POST['selnoticia'] == 10) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_gas = 9 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','8. CONTROL DE DOCUMENTOS Y REGISTROS','Ya está disponible control de documentos y registros, aquí vas a poder visualizar los documentos y registros del Sistema de Administración.',
  '".$hoy."','8-control-documentos-registros',0)";
mysqli_query($con, $sql_insert);

$sql_insert1 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','8-control-documentos-registros',0)";
mysqli_query($con, $sql_insert1);

}

}else if ($_POST['selnoticia'] == 11) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_puesto = 6 AND id_gas <> 9 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','2. IDENTIFICACIÓN DE PELIGROS Y ASPECTOS AMBIENTALES, ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES','Ya está disponible la nueva versión de identificación de peligros y aspectos ambientales.',
  '".$hoy."','2-analisis-riesgo-evaluacion-impactos-ambientales',0)";
mysqli_query($con, $sql_insert);

$sql_insert1 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','2-analisis-riesgo-evaluacion-impactos-ambientales',0)";
mysqli_query($con, $sql_insert1);

}

}else if ($_POST['selnoticia'] == 12) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_puesto = 6 AND id_gas <> 9 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','11. INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD','Ya está disponible integridad mecánica y aseguramiento de la calidad.',
  '".$hoy."','11-integridad-mecanica-aseguramiento',0)";
mysqli_query($con, $sql_insert);

$sql_insert1 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','11-integridad-mecanica-aseguramiento',0)";
mysqli_query($con, $sql_insert1);

}

}else if ($_POST['selnoticia'] == 13) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_puesto = 6 AND id_gas <> 9 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','16. INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES','Ya está disponible investigación de incidentes y accidentes.',
  '".$hoy."','16-investigacion-incidentes-accidentes',0)";
mysqli_query($con, $sql_insert);

$sql_insert1 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','16-investigacion-incidentes-accidentes',0)";
mysqli_query($con, $sql_insert1);

}

}else if ($_POST['selnoticia'] == 14) {

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_puesto = 6 AND id_gas <> 9 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){


$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado)
VALUES ('".$row_usuarios['id']."','5. FUNCIONES, RESPONSABILIDADES Y AUTORIDAD','Ya está disponible funciones, responsabilidades y auditoria.',
  '".$hoy."','5-funciones-responsabilidades-autoridad',0)";
mysqli_query($con, $sql_insert);

$sql_insert1 = "INSERT INTO pu_sasisopa_ayuda (id_usuario,detalle,estado)
VALUES ('".$row_usuarios['id']."','5-funciones-responsabilidades-autoridad',0)";
mysqli_query($con, $sql_insert1);

}

}


}else{

echo "<div class='text-danger col-xl-10 col-lg-10 col-md-10 col-sm-12 mb-2'>Selecciona Noticia</div>";
}


}
?>



    </div>
    </div>
    </div>
    </div>
    </div>




  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
