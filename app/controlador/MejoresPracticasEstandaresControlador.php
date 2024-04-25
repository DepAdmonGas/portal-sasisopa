<?php
require('../../app/help.php');
include_once "../../app/modelo/MejoresPracticasEstandares.php";

$class_practicas_estandares = new MejoresPracticasEstandares();

switch($_POST['accion']){
    case 'agregar-diseno-construccion':
        echo $class_practicas_estandares->agregarDisenoConstruccion($Session_IDEstacion,$_POST['Codigo'],$_POST['Area']);
    break;
    case 'eliminar-diseno-construccion':
        echo $class_practicas_estandares->eliminarDisenoConstruccion($Session_IDEstacion,$_POST['id']);
    break;
    case 'agregar-operacion-mantenimiento':
        echo $class_practicas_estandares->agregarOperacionMantenimiento($Session_IDEstacion,$_POST['Fecha'],$_POST['Norma'],$_POST['Nombre'],$_POST['Link']);
    break;
    case 'eliminar-operacion-mantenimiento':
        echo $class_practicas_estandares->eliminarOperacionMantenimiento($Session_IDEstacion,$_POST['id']);
    break;
}