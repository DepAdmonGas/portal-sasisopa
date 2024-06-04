<?php
require('../../app/help.php');
include_once "../../app/modelo/InformeDesempeno.php";

$class_informe_desempeno = new InformeDesempeno();

switch($_POST['accion']){
    case 'agregar-evaluacion-desempeno':
    echo $class_informe_desempeno->agregarEvaluacionDesempeno($Session_IDEstacion,$Session_IDUsuarioBD,$_FILES['file']['name'],$_FILES['file']['tmp_name'],$hoy);
    break;
    case 'eliminar-evaluacion-desempeno':
    echo $class_informe_desempeno->eliminarEvaluacionDesempeno($_POST['id']);
    break;
    case 'editar-evaluacion-desempeno':
    echo $class_informe_desempeno->editarEvaluacionDesempeno($_POST['id'],$_POST['EditFecha'],$_FILES['file']['name'],$_FILES['file']['tmp_name'],$hora_del_dia,$hoy);
    break;
    //------------------------------------------------------------------------
    case 'agregar-control-implementacion-sasisopa':
    echo $class_informe_desempeno->agregarControlImplementacionSasisopa($_POST['idEstacion'],$_POST['idUsuario']);
    break;
    case 'eliminar-implementacion-sasisopa':
        echo $class_informe_desempeno->eliminarImplementacionSasisopa($_POST['id']);
    break;
    //------------------------------------------------------------------------------------
    case 'actualizar-fecha-procedimiento':
        echo $class_informe_desempeno->actualizarFechaProcedimiento($_POST['id'],$_POST['Fecha']);
    break;
    case 'actualizar-descripcion-procedimiento':
        echo $class_informe_desempeno->actualizarDescripcionProcedimiento($_POST['id'],$_POST['Descripcion']);
    break;
    case 'actualizar-observaciones-procedimiento':
        echo $class_informe_desempeno->actualizarObservacionProcedimiento($_POST['id'],$_POST['Observaciones']);
    break;
    case 'actualizar-conocer-procedimiento':

        if(empty($_POST['Fecha'])) {
            $fecha = "";
        }else{
            $fecha = $_POST['Fecha'];
        }

        echo $class_informe_desempeno->actualizarConocerProcedimiento($_POST['id'],$_POST['estado'],$fecha);
    break;
    case 'actualizar-puesto-procedimiento':
        echo $class_informe_desempeno->actualizarPuestoProcedimiento($_POST['id'],$_POST['idPuesto'],$_POST['Puesto'],$_POST['estado']);
    break;
    
}



