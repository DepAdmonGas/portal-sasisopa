<?php
require('../../app/help.php');
include_once "../../app/modelo/InvestigacionIncidentesAccidentes.php";

$class_incidentes_accidentes = new InvestigacionIncidentesAccidentes();

switch($_POST['accion']){
    case 'agregar-incedentes-accidentes':

        if(isset($_POST['Fecha']) && $_POST['Fecha']){
            $Fecha = $_POST['Fecha'];
        }else{
            $Fecha = "";
        }

        if(isset($_POST['Descripcion']) && $_POST['Descripcion']){
            $Descripcion = $_POST['Descripcion'];
        }else{
            $Descripcion = "";
        }

        if(isset($_POST['TipoEvento']) && $_POST['TipoEvento']){
            $TipoEvento = $_POST['TipoEvento'];
        }else{
            $TipoEvento = "";
        }

        if(isset($_POST['NombreTA']) && $_POST['NombreTA']){
            $NombreTA = $_POST['NombreTA'];
        }else{
            $NombreTA = "";
        }

        if(isset($_POST['NumeroA']) && $_POST['NumeroA']){
            $NumeroA = $_POST['NumeroA'];
        }else{
            $NumeroA = "";
        }

        if(isset($_POST['NombreLI']) && $_POST['NombreLI']){
            $NombreLI = $_POST['NombreLI'];
        }else{
            $NombreLI = "";
        }

        if(isset($_POST['TercerA']) && $_POST['TercerA']){
            $TercerA = $_POST['TercerA'];
        }else{
            $TercerA = "";
        }

        if(isset($_POST['TipoAdd']) && $_POST['TipoAdd']){
            $TipoAdd = $_POST['TipoAdd'];
        }else{
            $TipoAdd = "";
        }

        if(isset($_POST['Muertes']) && $_POST['Muertes']){
            $Muertes = $_POST['Muertes'];
        }else{
            $Muertes = "";
        }

        $array = array(
            "id_estacion" => $Session_IDEstacion,
            "id_usuario" => $Session_IDUsuarioBD,
            "hora_dia" => $hora_del_dia,
            "Fecha" => $Fecha,
            "Descripcion" => $Descripcion,
            "TipoEvento" => $TipoEvento,
            "NombreTA" => $NombreTA,
            "NumeroA" => $NumeroA,
            "NombreLI" => $NombreLI,
            "TercerA" => $TercerA,
            "TipoAdd" => $TipoAdd,
            "Muertes" => $Muertes
        );
        echo $class_incidentes_accidentes->agregarIncidentesAccidentes($array);
    break;
    case 'agregar-grupo-interdiciplinario':
        echo $class_incidentes_accidentes->agregarGrupoInterdiciplinario($_POST['id'],$_POST['NombreG'],$_POST['PuestoG'],$_POST['EspecialidadG']);
    break;
    case 'agregar-archivo-formato26':
        echo $class_incidentes_accidentes->agregarArchivoFormato26($_POST['idDocumento'],$_FILES['ArchivoPdf_file']['name'],$_FILES['ArchivoPdf_file']['tmp_name'],$hoy);
    break;
    case 'agregar-archivo-tercer-autorizado':
        echo $class_incidentes_accidentes->agregarArchivoTercerAutorizado($_POST['idDocumento'],$_POST['idta'],$_FILES['ArchivoPdf_file']['name'],$_FILES['ArchivoPdf_file']['tmp_name'],$fecha_del_dia,$hoy);
    break;
    case 'eliminar-investigacion-incidentes-accidentes':
        echo $class_incidentes_accidentes->eliminarIncidentesAccidentes($_POST['id']);
    break;
    case 'actualizar-sin-accidentes':
        echo $class_incidentes_accidentes->actualizarSinAccidentes($_POST['id'],$_POST['Fecha']);
    break;
    case 'eliminar-sin-accidentes':
        echo $class_incidentes_accidentes->eliminarSinAccidentes($_POST['id']);
    break;
}
