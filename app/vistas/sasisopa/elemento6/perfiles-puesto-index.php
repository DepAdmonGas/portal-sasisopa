<?php
require('app/help.php');

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
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
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
    window.history.back();
  }

  
  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
    <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
    </div>    
    <div class="float-left">
    <h4>PERFILES DE PUESTO</h4>
    </div>

    <div class="bg-white mt-5 p-3">
    <div style="overflow-y: hidden;">
    <table class="table table-sm table-bordered mb-0 pb-0">
    <tr><td class="text-center table-success font-weight-bold" colspan="4">Gerente</td></tr>
    <tr class="table-warning text-center font-weight-bold"><td>Resumen</td><td>Tareas</td><td>Requerimientos</td><td>Otros aspectos</td></tr>
    <tr>
    <td>Responsable por la
    dirección,
    estableciendo las
    políticas generales
    que regirán a la
    empresa. Entiende y
    aplica al logro de los
    objetivos
    organizacionales.
    Planifica el
    crecimiento de la
    empresa a corto y a
    largo plazo. Además
    presenta al Directorio
    los estados
    financieros, el
    presupuesto,
    programas de trabajo
    y demás obligaciones
    que requiera</td>
    <td>Generar cortes por turno.
    Generar el corte general.
    Revisar inventarios.
    Solicitar combustible.
    Enviar ventas
    Corroborar que el sistema de
    control volumétrico esté
    funcionando correctamente
    Verificar los precios(sistema,
    anuncio, página CRE)
    Programar la solicitud de
    pedidos de combustible.
    Supervisar el buen estado de
    la ES
    Supervisar los procedimientos
    de operación, mantenimiento
    y seguridad.
    Detección de personal
    faltante y selección de
    personal.
    Coordinar cursos de
    capacitación
    Seguimiento al programa
    anual de mantenimiento, revalidación de permisos, al
    programa de capacitación.
    Participar en Capacitaciones.
    Promover el trabajo en
    equipo.
    Atención personalizada a
    clientes difíciles.</td>
    <td>Licenciatura en
    administración,
    contabilidad, o
    carrera afín. </td>
    <td>Disponibilidad
    para trasladarse
    Disponibilidad de
    horario.
    Licencia de
    conducir.
    Conocimiento
    medio de la
    paquetería de
    Office. </td>
        </tr>
      </table>
    </div>

    <div class="mt-4" style="overflow-y: hidden;">
  <table class="table table-sm table-bordered mb-0 pb-0">
    <tr><td class="text-center table-success font-weight-bold" colspan="4">Auxiliar Administrativo</td></tr>
    <tr class="table-warning text-center font-weight-bold"><td>Resumen</td><td>Tareas</td><td>Requerimientos</td><td>Otros aspectos</td></tr>
    <tr>
    <td>Ayuda al gerente al
      cumplimiento de
      objetivos, metas y
      políticas
      organizacionales. </td>
      <td>Llevar relación de la cartera
      de los clientes Admongas.
      Firma de contratos con
      clientes.
      Deposito a tarjetas de los
      clientes.
      Brindar información de las
      cuentas débito y crédito
      (promociones que maneja la
      empresa)
      Revisar el correo de la
      estación, dar atención y
      transmitir información que es
      enviada el correo.
      Atención a llamadas.
      Solicitud de papelería.
      Recabar información
      documental del personal
      nuevo
      Solicitud de cheques para
      reembolsos de caja chica.
      Pagos a proveedores.
      Apoyo a facturista
      Manejo de personal
      </td>
      <td>Licenciatura en
      administración,
      contabilidad o
      carrera afín.
      Prepa concluida o
      trunca. </td>
      <td>Manejo al 60% de
      la paquetería de
      Office.
      Facilidad de
      expresión.</td>
          </tr>
        </table>
      </div>

      <div class="mt-4" style="overflow-y: hidden;">
  <table class="table table-sm table-bordered mb-0 pb-0">
    <tr><td class="text-center table-success font-weight-bold" colspan="4">Jefe de piso</td></tr>
    <tr class="table-warning text-center font-weight-bold"><td>Resumen</td><td>Tareas</td><td>Requerimientos</td><td>Otros aspectos</td></tr>
    <tr>
    <td>Encargado de
    supervisar y coordinar
    las actividades de
    operación y
    mantenimiento.  </td>
    <td>Despacho de combustible
    Recepción de autotanque y
    descarga a tanques de
    almacenamiento.
    Supervisión de los
    despachadores.
    Apoyo a solución de
    problemas en área de
    despacho
    Transmitir información de
    gerencia al área de despacho Apoyo en el seguimiento al
    calendario anual de
    mantenimiento
    Aditivacion de producto.
    Supervisión de
    mantenimiento. 
    </td>
    <td>Educación básica.
    Experiencia
    mínima de un
    año. </td>
    <td>Liderazgo
    Facilidad de
    expresión
    Buena
    presentación </td>
        </tr>
      </table>
    </div>

    <div class="mt-4" style="overflow-y: hidden;">
  <table class="table table-sm table-bordered mb-0 pb-0">
    <tr><td class="text-center table-success font-weight-bold" colspan="4">Facturista</td></tr>
    <tr class="table-warning text-center font-weight-bold"><td>Resumen</td><td>Tareas</td><td>Requerimientos</td><td>Otros aspectos</td></tr>
    <tr>
    <td>Encargado de realizar
    las facturas de los
    clientes y contribuir a
    los objetivos de la
    empresa.  </td>
    <td>Facturar
    Auxiliar del Jefe de piso
    </td>
    <td>Prepa terminada
    Licenciatura
    terminada o
    trunca </td>
    <td>Manejo de la
    computadora.
    Manejo básico de
    Excel
    Facilidad de
    palabra
    Buena
    presentación  </td>
        </tr>
      </table>
    </div>

    <div class="mt-4" style="overflow-y: hidden;">
  <table class="table table-sm table-bordered mb-0 pb-0">
    <tr><td class="text-center table-success font-weight-bold" colspan="4">Despachador</td></tr>
    <tr class="table-warning text-center font-weight-bold"><td>Resumen</td><td>Tareas</td><td>Requerimientos</td><td>Otros aspectos</td></tr>
    <tr>
    <td>Técnico especializado
    en el despacho de
    combustible y la
    atención al cliente.  </td>
    <td>Despacho de combustible
    Atención al cliente
    Recepción de pipas y descarga
    de auto-tanque a tanques de
    almacenamiento
    Limpieza del área de trabajo
    Apoyo en mantenimiento de
    las instalaciones. 
    </td>
    <td>Nivel básico
    trunco o
    terminado</td>
    <td>Facilidad de
    palabra
    Amabilidad
    Buena
    presentación
    Disponibilidad de
    horario   </td>
        </tr>
      </table>
    </div>

    <div class="mt-4" style="overflow-y: hidden;">
  <table class="table table-sm table-bordered mb-0 pb-0">
    <tr><td class="text-center table-success font-weight-bold" colspan="4">Personal de mantenimiento </td></tr>
    <tr class="table-warning text-center font-weight-bold"><td>Resumen</td><td>Tareas</td><td>Requerimientos</td><td>Otros aspectos</td></tr>
    <tr>
    <td>Tecnico encargado de
    realizar el
    mantenimiento
    correctivo y
    preventivo dentro de
    la estación.  </td>
    <td>Trabajos de limpieza
    Trabajos en alturas
    Compras espontaneas
    Correcciones al inmueble
    Revisión constante a la
    estación en general
    
    </td>
    <td>Nivel básico
    trunco o
    terminado</td>
    <td>Disposición de
    tiempo
    Capacidad para
    realizar trabajos
    físicos
    Fácil acatamiento
    de indicaciones.
    Disponibilidad
    para viajar. </td>
        </tr>
      </table>
    </div>

    </div>


    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
