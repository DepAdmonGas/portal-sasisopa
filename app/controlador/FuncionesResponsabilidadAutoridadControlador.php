<?php
require('../../app/help.php');
include_once "../../app/modelo/FuncionesResponsabilidadAutoridad.php";

$class_funciones_responsabilidad_autoridad = new FuncionesResponsabilidadAutoridad();

switch($_POST['accion']){

case 'agregar-representante-tecnico':

    $nombre_rt = $_POST['NombreRT'];
    $fecha_asignacion = $_POST['FechaAsignacion'];
    $pdf_name = $_FILES['PDF_file']['name'];
    $pdf_tmp_name = $_FILES['PDF_file']['tmp_name'];

    echo $class_funciones_responsabilidad_autoridad->agregarRepresentanteTecnico($Session_IDEstacion,$nombre_rt,$fecha_asignacion,$pdf_name,$pdf_tmp_name,$hoy);

break;
case 'eliminar-representante-tecnico':

    echo $class_funciones_responsabilidad_autoridad->eliminarRepresentanteTecnico($_POST['id']);
    
break;

}