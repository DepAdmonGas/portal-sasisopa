<?php
require('../../app/help.php');
include_once "../../app/modelo/Politica.php";

$class_politica = new Politica();

switch($_POST['accion']){
    
    case 'actualizar-politica':
        echo $class_politica->actualizarPolitica($Session_IDEstacion,$_POST['politica'],$_POST['mision'],$_POST['vision']); 
    break;
    case 'agregar-lista-comprobacion':
        echo $class_politica->agregarListaComprobacion($Session_IDEstacion,$Session_IDUsuarioBD,$_POST['Fecha'],$_POST['R1'],$_POST['R2'],$_POST['R3'],$_POST['R4'],$_POST['R5'],$_POST['R6'],$_POST['R7'],$_POST['Asistentes'],$_POST['Comentarios']);
    break;
    case 'editar-lista-comprobacion':
        echo $class_politica->editarListaComprobacion($_POST['id'],$_POST['EditFecha'],$_POST['ER1'],$_POST['ER2'],$_POST['ER3'],$_POST['ER4'],$_POST['ER5'],$_POST['ER6'],$_POST['ER7'],$_POST['EditAsistentes'],$_POST['EditComentarios']);
    break;
    case 'eliminar-lista-comprobacion':
    echo $class_politica->eliminarListaComprobacion($_POST['id']);
    break;

}