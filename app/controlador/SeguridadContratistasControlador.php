<?php 
require('../../app/help.php');
include_once "../../app/modelo/SeguridadContratistas.php";

$class_seguridad_contratistas = new SeguridadContratistas();

switch($_POST['accion']){
    case 'agregar-requisicion-obra-servicio':
        echo $class_seguridad_contratistas->agregarRequisicionObraServicio($Session_IDEstacion,$Session_IDUsuarioBD,$_POST['Descripcion'],$_POST['Justificacion'],$_POST['Fecha'],$hora_del_dia);
    break;
    case 'editar-requisicion-obra-servicio':
        echo $class_seguridad_contratistas->editarRequisicionObraServicio($_POST['id'],$_POST['EditFecha'],$_POST['EditDescripcion'],$_POST['EditJustificacion']);
    break;
    case 'eliminar-seguridad-contratistas':
        echo $class_seguridad_contratistas->eliminarSeguridadContratistas($_POST['id']);
    break;
    case 'agregar-formato-14':
        echo $class_seguridad_contratistas->agregarFormato14($_POST['id'],$_FILES['File']['name'],$_FILES['File']['tmp_name'],$hoy);
    break;
    case 'editar-carta-responsiva':
        $array = array(
            'id' => $_POST['id'],
            'municipio' => $_POST['Municipio'],
            'estado' => $_POST['Estado'],
            'dia' => $_POST['Dia'],
            'mes' => $_POST['Mes'],
            'year' => $_POST['Year'],
            'representante_legal' => $_POST['RepresentanteL'],
            'razon_social' => $_POST['RazonSocial'],
            'domicilio' => $_POST['Domicilio'],
            'apoderado_legal' => $_POST['ApoderadoL'],
    );
       echo $class_seguridad_contratistas->editarCartaResponsiva($array);
    break;
    case 'agregar-lista-verificacion':
        $array = array(
            'id' => $_POST['id'],
            'fecha' => $_POST['Fecha'],
            'hora' => $_POST['Hora'],
            'id_supervisor' => $_POST['idSuperviso'],
            'r1' => $_POST['R1'],
            'r2' => $_POST['R2'],
            'r3' => $_POST['R3'],
            'r4' => $_POST['R4'],
            'r5' => $_POST['R5']
        );
        echo $class_seguridad_contratistas->agregarListaVerificacion($array);
    break;
    case 'editar-formato-12':


        echo $class_seguridad_contratistas->editarFormato12($_POST['id'],$_POST['valor'],$_POST['dato'],$_POST['NombreT'],$_POST['PuestoT'],$_POST['categoria'],$_POST['NoSeguroT']);
    break;

}








