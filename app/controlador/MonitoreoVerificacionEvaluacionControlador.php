<?php
require('../../app/help.php');
include_once "../../app/modelo/MonitoreoVerificacionEvaluacion.php";

$class_monitoreo_evaluacion = new MonitoreoVerificacionEvaluacion();

switch($_POST['accion']){
    case 'agregar-cuestionario-sasisopa':
        $array = array(
            'id_estacion' => $Session_IDEstacion,
            'id_usuario' => $Session_IDUsuarioBD,

            'Titulo1' => $_POST['Titulo1'],
            'Titulo2' => $_POST['Titulo2'],
            'Titulo3' => $_POST['Titulo3'],
            'Titulo4' => $_POST['Titulo4'],
            'Titulo5' => $_POST['Titulo5'],
            'Titulo6' => $_POST['Titulo6'],
            'Titulo7' => $_POST['Titulo7'],
            'Titulo8' => $_POST['Titulo8'],
            'Titulo9' => $_POST['Titulo9'],
            'Titulo10' => $_POST['Titulo10'],
            'Titulo11' => $_POST['Titulo11'],
            'Titulo12' => $_POST['Titulo12'],
            'Titulo13' => $_POST['Titulo13'],
            'Titulo14' => $_POST['Titulo14'],
            'Titulo15' => $_POST['Titulo15'],
            'Titulo16' => $_POST['Titulo16'],
            'Titulo17' => $_POST['Titulo17'],
            'Titulo18' => $_POST['Titulo18'],
            'Titulo19' => $_POST['Titulo19'],
            'Titulo20' => $_POST['Titulo20'],
            'Titulo21' => $_POST['Titulo21'],
            'Titulo22' => $_POST['Titulo22'],
            'Titulo23' => $_POST['Titulo23'],
            'Titulo24' => $_POST['Titulo24'],
            'Titulo25' => $_POST['Titulo25'],
            'Titulo26' => $_POST['Titulo26'],
            'Titulo27' => $_POST['Titulo27'],
            'Titulo28' => $_POST['Titulo28'],
            'Titulo29' => $_POST['Titulo29'],
            'Titulo30' => $_POST['Titulo30'],
            'Titulo31' => $_POST['Titulo31'],
            'Titulo32' => $_POST['Titulo32'],
            'Titulo33' => $_POST['Titulo33'],
            'Titulo34' => $_POST['Titulo34'],
            'Titulo35' => $_POST['Titulo35'],
            'Titulo36' => $_POST['Titulo36'],

            'respuesta1' => $_POST['respuesta1'],
            'respuesta2' => $_POST['respuesta2'],
            'respuesta3' => $_POST['respuesta3'],
            'respuesta4' => $_POST['respuesta4'],
            'respuesta5' => $_POST['respuesta5'],
            'respuesta6' => $_POST['respuesta6'],
            'respuesta7' => $_POST['respuesta7'],
            'respuesta8' => $_POST['respuesta8'],
            'respuesta9' => $_POST['respuesta9'],
            'respuesta10' => $_POST['respuesta10'],
            'respuesta11' => $_POST['respuesta11'],
            'respuesta12' => $_POST['respuesta12'],
            'respuesta13' => $_POST['respuesta13'],
            'respuesta14' => $_POST['respuesta14'],
            'respuesta15' => $_POST['respuesta15'],
            'respuesta16' => $_POST['respuesta16'],
            'respuesta17' => $_POST['respuesta17'],
            'respuesta18' => $_POST['respuesta18'],
            'respuesta19' => $_POST['respuesta19'],
            'respuesta20' => $_POST['respuesta20'],
            'respuesta21' => $_POST['respuesta21'],
            'respuesta22' => $_POST['respuesta22'],
            'respuesta23' => $_POST['respuesta23'],
            'respuesta24' => $_POST['respuesta24'],
            'respuesta25' => $_POST['respuesta25'],
            'respuesta26' => $_POST['respuesta26'],
            'respuesta27' => $_POST['respuesta27'],
            'respuesta28' => $_POST['respuesta28'],
            'respuesta29' => $_POST['respuesta29'],
            'respuesta30' => $_POST['respuesta30'],
            'respuesta31' => $_POST['respuesta31'],
            'respuesta32' => $_POST['respuesta32'],
            'respuesta33' => $_POST['respuesta33'],
            'respuesta34' => $_POST['respuesta34'],
            'respuesta35' => $_POST['respuesta35'],
            'respuesta36' => $_POST['respuesta36']
        );
        echo $class_monitoreo_evaluacion->agregarCuestionarioSasisopa($array);
    break;
    case 'editar-implementacion-sa':
        echo $class_monitoreo_evaluacion->editarCuestionarioSasisopa($_POST['idDetalle'],$_POST['Fecha'],$hora_del_dia);
    break;
    case 'agregar-informe-revision-resultados':
        echo $class_monitoreo_evaluacion->agregarInformeRevisionResultado($Session_IDEstacion,$_POST['Fecha'],$_FILES['File']['name'],$_FILES['File']['tmp_name'],$hoy);
    break;
    case 'eliminar-informe-revision-resultados':
        echo $class_monitoreo_evaluacion->eliminarInformeRevisionResultado($_POST['id']);
    break;
    //----------------------------------------------------------------------------------------------
    //------------------------------- Atención de Hallazgos ----------------------------------------
    case 'agregar-atencion-hallazgos':
        echo $class_monitoreo_evaluacion->agregarAtencionHallazgos($Session_IDEstacion);
    break;
    case 'eliminar-atencion-hallazgos':
        echo $class_monitoreo_evaluacion->eliminarAtencionHallazgos($_POST['id'],$_POST['categoria']);
    break;
    case 'agregar-hallazgos':
        echo $class_monitoreo_evaluacion->agregarHallazgos($_POST['id'],$_POST['idHallazgo'],$_POST['IdSasisopa'],$_POST['Hallazgos'],$_POST['Accion'],$_POST['FechaI']);
    break;
    case 'actualizar-atencion-hallazgos':
        echo $class_monitoreo_evaluacion->actualizarAtencionHallazgos($_POST['id'],$_POST['valor'],$_POST['dato']);
    break;
    case 'eliminar-hallazgos':
        echo $class_monitoreo_evaluacion->eliminarHallazgos($_POST['idHallazgo']);
    break;
    case 'agregar-evidencia-atencion-hallazgos':
        echo $class_monitoreo_evaluacion->agregarEvidenciaHallazgos($_POST['idHallazgo'],$_FILES['File']['name'],$_FILES['File']['tmp_name'],$hoy);
    break;
}









