<?php
require('../../app/help.php');
include_once "../../app/modelo/ComunicacionParticipacionConsulta.php";

$class_comunicacion = new ComunicacionParticipacionConsulta();

switch($_POST['accion']){
    case 'agregar-comunicacion':

        if(isset($_POST['dirigidoa'])){
            $dirigido_a = $_POST['dirigidoa'];
        }else{
            $dirigido_a = "";
        }
        
        $array = array(
        "id_estacion" => $Session_IDEstacion,
        "id_usuario" => $Session_IDUsuarioBD,
        "tema_comunicar" => $_POST['temacomunicar'],
        "detalle" => $_POST['detalle'],
        "tipo_comunicacion" => $_POST['tipocomunicacion'],
        "material_comunicar" => $_POST['materialcomunicar'],
        "dirigido_a" => $dirigido_a,
        "seguimiento_comunicacion" => $_POST['seguimientocomunicacion'],
        "fecha_del_dia" => $fecha_del_dia
        );

        echo $class_comunicacion->agregarComunicacion($array);
    break;
    case 'agregar-evidencia-comunicacion':

        $file_name = $_FILES['FileEvidencia']['name'];
        $file_tmp_name = $_FILES["FileEvidencia"]["tmp_name"]; 

        echo $class_comunicacion->agregarEvidenciaComunicacion($_POST['id'],$file_name,$file_tmp_name,$hoy);
    break;
    case 'eliminar-evidencia-comunicacion':
        echo $class_comunicacion->eliminarEvidenciaComunicacion($_POST['id']);
    break;
    case 'editar-comunicacion':

        if(isset($_POST['Editdirigidoa'])){
            $dirigido_a = $_POST['edit_dirigido_a'];
        }else{
            $dirigido_a = "";
        }

        $array = array(
           "id" =>  $_POST['id'],
           "edit_fecha" => $_POST['Editfecha'],
           "edit_tema_comunicar" => $_POST['Edittemacomunicar'],
           "edit_detalle" => $_POST['Editdetalle'],
           "edit_tipo_comunicacion" => $_POST['Edittipocomunicacion'],
           "edit_material_comunicar" => $_POST['Editmaterialcomunicar'],
           "edit_dirigido_a" => $dirigido_a,
           "edit_seguimiento_comunicacion" => $_POST['Editseguimientocomunicacion']
        );

        echo $class_comunicacion->editarComunicacion($array);
    break;
    case 'eliminar-comunicacion':
        echo $class_comunicacion->eliminarComunicacion($_POST['id']);
    break;
    case 'agregar-queja-sugerencia':

        $array = array(
        "id_estacion" => $Session_IDEstacion,
        "qs_fecha" => $_POST['QSFecha'],
        "qs_nombre" => $_POST['QSNombre'],
        "qs_motivo_causa" => $_POST['QSMotivosCausas'],
        "qs_nombre_dirigido" => $_POST['QSNombreDirigido'],
        "qs_contacto" => $_POST['QSContacto'],
        "qs_nombre_puesto" => $_POST['QSNombrePuesto'],
        "qs_efectos_consecuencias" => $_POST['QSEfectosConsecuencias'],
        "qs_solucion" => $_POST['QSSolucion'],
        "qs_plazo" => $_POST['QSPlazo'],
        "qs_confirmacion" => $_POST['QSConfirmacion']);

        echo $class_comunicacion->agregarQuejaSugerencia($array);
    break;
    case 'eliminar-quejas-sugerencias':
        echo $class_comunicacion->eliminarQuejaSugerencia($_POST['id']);
    break;
}