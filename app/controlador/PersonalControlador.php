<?php
require('../../app/help.php');
include_once "../../app/modelo/Personal.php";

$class_personal = new Personal();

switch($_POST['accion']){
    case 'editar-nombre':
        echo $class_personal->editarNombre($_POST['idUsuario'],$_POST['Nombres']);
    break;
    case 'editar-domicilio':
        echo $class_personal->editarDomicilio($_POST['idUsuario'],$_POST['DireccionCompleta']);
    break;
    case 'editar-fecha-nacimiento':
        echo $class_personal->editarFechaNacimiento($_POST['idUsuario'],$_POST['FechaNac']);
    break;
    case 'editar-estado-civil':
        echo $class_personal->editarEstadoCivil($_POST['idUsuario'],$_POST['EstadoCivil']);
    break;
    case 'editar-seguro-social':
        echo $class_personal->editarSeguroSocial($_POST['idUsuario'],$_POST['NumeroSSocial']);
    break;
    case 'editar-telefono':
        echo $class_personal->editarTelefono($_POST['idUsuario'],$_POST['Telefono']);
    break;
    case 'editar-email':
        echo $class_personal->editarEmail($_POST['idUsuario'],$_POST['Email']);
    break;
    case 'agregar-datos-familiares':
        echo $class_personal->agregarDatosFamiliares($_POST['idUsuario'],$_POST['NomFamiliar'],$_POST['Parentesco'],$_POST['Direccion'],$_POST['Telefono']);
    break;
    case 'eliminar-datos-familiares':
        echo $class_personal->eliminarDatosFamiliares($_POST['id']);
    break;
    case 'agregar-formacion-academica':
        echo $class_personal->agregarFormacionAcademica($_POST['idUsuario'],$_POST['NivelAcademico'],$_POST['Institucion']);
    break;
    case 'eliminar-formacion-academica':
        echo $class_personal->eliminarFormacionAcademica($_POST['id']);
    break;
    case 'agregar-experiencia-laboral':
        echo $class_personal->agregarExperienciaLaboral($_POST['idUsuario'],$_POST['Empresadetalle']);
    break;
    case 'eliminar-experiencia-laboral':
        echo $class_personal->eliminarExperienciaLaboral($_POST['id']);
    break;
    case 'agregar-experiencia-empresa':
        echo $class_personal->agregarExperienciaEmpresa($_POST['idUsuario'],$_POST['RazonSocial'],$_POST['Puesto'],$_POST['FechaInicio'],$_POST['FechaFin']);
    break;
    case 'eliminar-experiencia-empresa':
        echo $class_personal->eliminarExperienciaEmpresa($_POST['id']);
    break;
    case 'editar-experiencia-empresa':
        echo $class_personal->editarExperienciaEmpresa($_POST['id'],$_POST['RazonSocial'],$_POST['Puesto'],$_POST['FechaInicio'],$_POST['FechaFin']);
    break;
    case 'editar-firma-personal':
        echo $class_personal->editarFirmaPersonal($_POST['idUsuario'],$_POST['base64']);
    break;
}
