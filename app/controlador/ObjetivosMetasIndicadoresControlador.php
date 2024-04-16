<?php
require('../../app/help.php');
include_once "../../app/modelo/ObjetivosMetasIndicadores.php";

$class_objetivos_metas_indicadores = new ObjetivosMetasIndicadores();

switch($_POST['accion']){

        case 'agregar-seguimiento-objetivos-metas':

            $array = array(
            "Dato1" => $_POST['Dato1'],
            "Dato2" => $_POST['Dato2'],
            "Dato3" => $_POST['Dato3'],
            "Dato4" => $_POST['Dato4'],
            "Dato5" => $_POST['Dato5'],
            "Dato6" => $_POST['Dato6'],
            "Dato7" => $_POST['Dato7'],
            "Dato8" => $_POST['Dato8'],
            "Dato9" => $_POST['Dato9'],
            "Dato10" => $_POST['Dato10'],
            "Dato11" => $_POST['Dato11'],
            "Dato12" => $_POST['Dato12'],
            "Dato13" => $_POST['Dato13'],
            "Dato14" => $_POST['Dato14'],
            "Dato15" => $_POST['Dato15'],
            "Dato16" => $_POST['Dato16'],
            "Dato17" => $_POST['Dato17'],
            "Dato18" => $_POST['Dato18'],
            "Dato19" => $_POST['Dato19'],
            "Dato20" => $_POST['Dato20']
            );

            echo $class_objetivos_metas_indicadores->agregarSeguimientoObjetivosMetas($Session_IDEstacion,$Session_IDUsuarioBD,$array);
        break;
        case 'editar-seguimiento-objetivo-metas':
            echo $class_objetivos_metas_indicadores->editarSeguimientoObjetivoMetas($_POST['idSeguimiento'],$_POST['opcion'],$_POST['detalle']);  
        break;
        case 'eliminar-objetivos-metas-indicadores':
            echo $class_objetivos_metas_indicadores->eliminarObjetivoMetasIndicadores($_POST['seccion'],$_POST['id']);
        break;
        case 'agregar-seguimiento-reporte-indicador':
            echo $class_objetivos_metas_indicadores->agregarSeguimientoReporteIndicador($Session_IDEstacion,$Session_IDUsuarioBD,$_POST['Fecha'],$_POST['Capacitacion'],$_POST['ExperienciaC'],$_POST['Ventas'],$_POST['MedidasC'],$_POST['FechaAplicacion']);
        break;
        case 'editar-seguimiento-reporte-indicador':
            echo $class_objetivos_metas_indicadores->editarSeguimientoReporteIndicador($_POST['idSeguimiento'],$_POST['EditFecha'],$_POST['EditCapacitacion'],$_POST['EditExperienciaC'],$_POST['EditVentas'],$_POST['EditMedidasC'],$_POST['EditFechaAplicacion']);
        break;
        case 'eliminar-encuesta-estacion':
            echo $class_objetivos_metas_indicadores->eliminarEncuestaEstacion($_POST['IdReporte']);
        break;
        case 'agregar-usuario-encuestas':
            echo $class_objetivos_metas_indicadores->agregarUsuarioEncuestas($_POST['IdReporte'],$_POST['Nombre'],$hoy);
        break;
        case 'agregar-usuario-encuestas-resultados':
            echo $class_objetivos_metas_indicadores->agregarUsuarioEncuestasResultado($_POST['idusuario'],$_POST['idpregunta'],$_POST['respuesta']);
        break;
        case 'agregar-usuario-encuestas-comentario':
            echo $class_objetivos_metas_indicadores->agregarUsuarioEncuestasComentario($_POST['idusuario'],$_POST['comentario']);
        break;
        case 'actualizar-encuesta-estacion':
            echo $class_objetivos_metas_indicadores->actualizarEncuestasEstacion($_POST['IdReporte'],$_POST['Fecha'],$hora_del_dia);
        break;

        
        
}
