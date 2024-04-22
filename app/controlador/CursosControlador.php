<?php 
require('../../app/help.php');
include_once "../../app/modelo/Cursos.php";

$class_cursos = new Cursos();

switch($_POST['accion']){
    case 'agregar-capacitacion-interna':
        echo $class_cursos->agregarCapacitacionInterna($Session_IDEstacion,$_POST['idTema'],$_POST['idUsuario'],$_POST['FechaCurso']);
    break;
    case 'eliminar-capacitacion-interna':
        echo $class_cursos->eliminarCapacitacionInterna($_POST['id']);
    break;
}