<?php
require('../../app/help.php');
include_once "../../app/modelo/Asistencia.php";

$class_asistencia = new Asistencia();

switch($_POST['accion']){
    
    case 'agregar-lista-asistencia':

        if(isset($_POST['herramienta']) && !empty($_POST['herramienta'])){
            $herramienta = $_POST['herramienta'];
        }else{
            $herramienta = 1;
        }

        echo $class_asistencia->agregarAsistencia($Session_IDEstacion,$Session_IDUsuarioBD,$_POST['PuntoSasisopa'],$herramienta); 
    break;
    case 'eliminar-lista-asistencia':
        echo $class_asistencia->eliminarAsistencia($_POST['id']);
    break;
    case 'actualizar-lista-asistencia':
        echo $class_asistencia->actualizarListaAsistencia($Session_IDEstacion,$_POST['idRegistro'],$_POST['Fecha'],$_POST['Hora'],$_POST['Lugar'],$_POST['NomEncargado'],$_POST['Tema'],$_POST['Finalidad'],$_POST['Estado']);    
    break;
    case 'agregar-lista-asistencia-firma':
        echo $class_asistencia->agregarAsistenciaFirma($_POST['idRegistro'],$_POST['PersonalFirma']);
    break;
    case 'eliminar-lista-asistencia-firma':
        echo $class_asistencia->eliminarAsistenciaFirma($_POST['id']);
    break;

}