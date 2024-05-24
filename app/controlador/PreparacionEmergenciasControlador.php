<?php
require('../../app/help.php');
include_once "../../app/modelo/PreparacionEmergencias.php";

$class_preparacion_emergencias = new PreparacionEmergencias();

switch($_POST['accion']){
    case 'agregar-protocolo-emergencias':
        echo $class_preparacion_emergencias->agregarProtocoloEmergencias($Session_IDEstacion,$_POST['FechaProtocolo'],$_FILES['FileProtocolo']['name'],$_FILES['FileProtocolo']['tmp_name'],$hoy); 
    break;
    case 'editar-protocolo-emergencias':
        echo $class_preparacion_emergencias->editarProtocoloEmergencias($Session_IDEstacion,$_POST['id'],$_POST['EditFechaProtocolo'],$_FILES['EditFileProtocolo']['name'],$_FILES['EditFileProtocolo']['tmp_name'],$hoy); 
    break;
    case 'agregar-anexo':
        echo $class_preparacion_emergencias->agregarAnexo($_POST['idProtocolo'],$_POST['NombreAnexo'],$_FILES['FileAnexo']['name'],$_FILES['FileAnexo']['tmp_name'],$hoy); 
    break;
    case 'eliminar-anexo':
        echo $class_preparacion_emergencias->eliminarAnexo($_POST['id']); 
    break;
    case 'eliminar-protocolo-respuesta-emergencias':
        echo $class_preparacion_emergencias->eliminarProtocoloEmergencias($_POST['id']); 
    break;
    //-------------------------------------------------------------------------------------
    case 'agregar-telefono-emergencias':
        echo $class_preparacion_emergencias->agregarTelefono($Session_IDEstacion,$_POST['Titulo'],$_POST['Telefono'],0); 
    break;
    case 'editar-telefono-emergencias':
        echo $class_preparacion_emergencias->editarTelefono($_POST['EditTitulo'],$_POST['EditTelefono'],$_POST['idTelefono']); 
    break;
    case 'eliminar-telefono-emergencias':
        echo $class_preparacion_emergencias->eliminarTelefono($_POST['idTelefono']); 
    break;
    case 'agregar-programa-anual-simulacro':
        echo $class_preparacion_emergencias->agregarProgramaAnualSimulacro($Session_IDEstacion,$_POST['id'],$_POST['NombreSimulacro'],$_POST['Periodicidad'],$_POST['Fecha']); 
    break;
    case 'agregar-personal-simulacro':
        echo $class_preparacion_emergencias->agregarPersonalSimulacro($_POST['NombrePersonal'],$_POST['id_programa']); 
    break;
    case 'eliminar-personal-simulacro':
        echo $class_preparacion_emergencias->eliminarPersonalSimulacro($_POST['idPersonal']); 
    break;
    case 'agregar-resumen-simulacro':
        echo $class_preparacion_emergencias->agregarResumenSimulacro($_POST['Resumen'],$_POST['idPrograma']); 
    break;
    case 'agregar-evaluacion-simulacro':
        echo $class_preparacion_emergencias->agregarEvaluacionSimulacro($_POST['idPrograma'],$_FILES['FileEvaluacion']['name'],$_FILES['FileEvaluacion']['tmp_name'],$hoy); 
    break;
    case 'eliminar-programa-anual-simulacros':
        echo $class_preparacion_emergencias->eliminarProgramaAnualSimulacro($_POST['id']); 
    break;
}
















