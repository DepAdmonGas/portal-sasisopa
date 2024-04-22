<?php
require('../../app/help.php');
include_once "../../app/modelo/Capacitacion.php";

$class_capacitacion = new Capacitacion();

switch($_POST['accion']){
    case 'agregar-capacitacion-externa':
        echo $class_capacitacion->agregarCapacitacionExterna($Session_IDEstacion,$Session_IDUsuarioBD,$_POST['Curso'],$_POST['FechaCurso'],$_POST['Duracion'],$_POST['DuracionDetalle'],$_POST['Instructor']);
    break;
    case 'editar-capacitacion-externa':
        echo $class_capacitacion->editarCapacitacionExterna($_POST['idCurso'],$_POST['Curso'],$_POST['FechaCurso'],$_POST['Duracion'],$_POST['DuracionDetalle'],$_POST['Instructor'],$_POST['FechaCursoReal']);
    break;
    case 'agregar-personal-capacitacion-externa':
        echo $class_capacitacion->agregarPersonalCapacitacion($_POST['idCapacitacion'],$_POST['IdPersonal']);
    break;
    case 'eliminar-personal-capacitacion-externa':
        echo $class_capacitacion->eliminarPersonalCapacitacionExterna($_POST['id']);
    break;
    case 'eliminar-capacitacion-externa':
        echo $class_capacitacion->eliminarCapacitacionExterna($_POST['id']);
    break;
}