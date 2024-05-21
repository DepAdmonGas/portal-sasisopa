<?php
require('../../app/help.php');
include_once "../../app/modelo/IntegridadMecanicaAseguramiento.php";

$class_integridad_mecanica_aseguramiento = new IntegridadMecanicaAseguramiento();

switch($_POST['accion']){
    case 'agregar-equipo-critico':
    $array = array(
        'id_estacion' => $Session_IDEstacion,
        'nombre_equipo' => $_POST['NombreEquipo'],
        'marca_modelo' => $_POST['MarcaModelo'],
        'funcion' => $_POST['Funcion'],
        'fecha_instalacion' => $_POST['FechaInstalacion'],
        'tiempo_vida' => $_POST['TiempoVida'],
        'file_name' => $_FILES['ManualPDF_file']['name'],
        'file_tmp_name' => $_FILES['ManualPDF_file']['tmp_name']
    );
    echo $class_integridad_mecanica_aseguramiento->agregarEquipoCritico($array,$hoy);
    break;
    case 'actualizar-baja':
    echo $class_integridad_mecanica_aseguramiento->actualizarBaja($_POST['IdEquipo']);
    break;
    case 'eliminar-equipo-critico':
    echo $class_integridad_mecanica_aseguramiento->eliminarEquipoCritico($_POST['IdEquipo']);
    break;
    
}
