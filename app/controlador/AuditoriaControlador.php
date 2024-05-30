<?php
require('../../app/help.php');
include_once "../../app/modelo/Auditoria.php";

$class_auditoria = new Auditoria();

switch($_POST['accion']){
    
    case 'agregar-auditoria-interna':
        echo $class_auditoria->agregarAuditoriaInterna($Session_IDEstacion,$Session_IDUsuarioBD,$_POST['PrestadorS']);    
    break;
    case 'agregar-archivo-interna-formato24':
        echo $class_auditoria->agregarArchivoInternaFormato24($_POST['idDocumento'],$_FILES['ArchivoPdf_file']['name'],$_FILES['ArchivoPdf_file']['tmp_name'],$hoy);    
    break;
    case 'agregar-archivo-interna-formato25':
        echo $class_auditoria->agregarArchivoInternaFormato25($_POST['idDocumento'],$_FILES['ArchivoPdf_file']['name'],$_FILES['ArchivoPdf_file']['tmp_name'],$hoy);    
    break;
    case 'agregar-anexo-auditoria-interna':
        echo $class_auditoria->agregarAnexoAuditoriaInterna($_POST['id'],$_POST['formato'],$_POST['Documento'],$_FILES['ArchivoPdf_file']['name'],$_FILES['ArchivoPdf_file']['tmp_name'],$hoy);    
    break;
    //--------------------------------------------------------------------------------------------------------
    case 'agregar-auditoria-externa':
        echo $class_auditoria->agregarAuditoriaExterna($Session_IDEstacion,$Session_IDUsuarioBD,$_POST['PrestadorS']);    
    break;
    case 'agregar-archivo-formato24':
        echo $class_auditoria->agregarArchivoFormato24($_POST['idDocumento'],$_FILES['ArchivoPdf_file']['name'],$_FILES['ArchivoPdf_file']['tmp_name'],$hoy);    
    break;
    case 'agregar-archivo-formato25':
        echo $class_auditoria->agregarArchivoFormato25($_POST['idDocumento'],$_FILES['ArchivoPdf_file']['name'],$_FILES['ArchivoPdf_file']['tmp_name'],$hoy);    
    break;
    case 'agregar-archivo-asea':
        echo $class_auditoria->agregarArchivoAsea($_POST['idDocumento'],$_POST['Comentario'],$_FILES['ArchivoPdf_file']['name'],$_FILES['ArchivoPdf_file']['tmp_name'],$hoy);    
    break;

}
