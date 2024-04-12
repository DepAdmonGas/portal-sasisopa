<?php
require('../../app/help.php');
include_once "../../app/modelo/RequisitoLegal.php";

$class_requisito_legal = new RequisitoLegal();

switch($_POST['accion']){
    
    case 'agregar-requisito-legal-configuracion':
        echo $class_requisito_legal->agregarRequisitoLegalConfiguracion($Session_IDEstacion,$_POST['NG'],$_POST['MA'],$_POST['Dependencia'],$_POST['Permiso'],$_POST['Fundamento']);
    break;
    case 'eliminar-requisito-legal-configuracion':
        echo $class_requisito_legal->eliminarRequisitoLegalConfiguracion($_POST['id']);
    break;
    case 'agregar-detalle-requisito-legal':

        if(empty($_FILES['acusePDF_file']['name'])) {
            $acuse_name = "";
        }else{
            $acuse_name = $_FILES['acusePDF_file']['name'];
        }

        if(empty($_FILES['requisitoPDF_file']['name'])) {
            $requisito_name = "";
        }else{
            $requisito_name = $_FILES['requisitoPDF_file']['name'];
        }

        if(empty($_FILES['acusePDF_file']['tmp_name'])) {
            $acuse_tmp = "";
        }else{
            $acuse_tmp = $_FILES['acusePDF_file']['tmp_name'];
        }

        if(empty($_FILES['requisitoPDF_file']['tmp_name'])) {
            $requisito_tmp = "";
        }else{
            $requisito_tmp = $_FILES['requisitoPDF_file']['tmp_name'];
        }

        $array = array(
        "requisitolegal" => $_POST['requisitolegal'],
        "vigencia" => $_POST['vigencia'],
        "fechaemision" => $_POST['fechaemision'],
        "vencimiento" => $_POST['vencimiento'],
        "acuse_name" => $acuse_name,
        "requisito_name" => $requisito_name,
        "acuse_tmp" => $acuse_tmp,
        "requisito_tmp" => $requisito_tmp,
        "hoy" => $hoy,
        "ene" => $_POST['ene'],
        "feb" => $_POST['feb'],
        "mar" => $_POST['mar'],
        "abr" => $_POST['abr'],
        "may" => $_POST['may'],
        "jun" => $_POST['jun'],
        "jul" => $_POST['jul'],
        "ago" => $_POST['ago'],
        "sep" => $_POST['sep'],
        "oct" => $_POST['oct'],
        "nov" => $_POST['nov'],
        "dic" => $_POST['dic']);

        echo $class_requisito_legal->agregarDetalleRequisitoLegal($Session_IDEstacion,$array);
    break;
    case 'editar-detalle-requisito-legal':

       $array = array("id" => $_POST['id'],
        "requisitolegal" => $_POST['requisitolegal'],
        "vigencia" => $_POST['vigencia'],
        "ene" => $_POST['ene'],
        "feb" => $_POST['feb'],
        "mar" => $_POST['mar'],
        "abr" => $_POST['abr'],
        "may" => $_POST['may'],
        "jun" => $_POST['jun'],
        "jul" => $_POST['jul'],
        "ago" => $_POST['ago'],
        "sep" => $_POST['sep'],
        "oct" => $_POST['oct'],
        "nov" => $_POST['nov'],
        "dic" => $_POST['dic']);

        echo $class_requisito_legal->editarDetalleRequisitoLegal($array);
    break;
    case 'agregar-requisito-legal-historial':

        if(empty($_FILES['acusepdf']['name'])) {
            $acuse_name = "";
        }else{
            $acuse_name = $_FILES['acusepdf']['name'];
        }

        if(empty($_FILES['requisitopdf']['name'])) {
            $requisito_name = "";
        }else{
            $requisito_name = $_FILES['requisitopdf']['name'];
        }

        if(empty($_FILES['acusepdf']['tmp_name'])) {
            $acuse_tmp = "";
        }else{
            $acuse_tmp = $_FILES['acusepdf']['tmp_name'];
        }

        if(empty($_FILES['requisitopdf']['tmp_name'])) {
            $requisito_tmp = "";
        }else{
            $requisito_tmp = $_FILES['requisitopdf']['tmp_name'];
        }

        $array = array(
        "idre" => $_POST['idre'],
        "fecha_emision" => $_POST['FechaEmision'],
        "acuse_name" => $acuse_name,
        "requisito_name" => $requisito_name,
        "acuse_tmp" => $acuse_tmp,
        "requisito_tmp" => $requisito_tmp,
        "vencimiento" => $_POST['vencimiento'],
        "hoy" => $hoy,
        );

        echo $class_requisito_legal->agregarRequisitoLegalHistorial($Session_IDEstacion,$array);
    break;
    case 'editar-requisito-legal-historial':

        if(empty($_FILES['acusepdf']['name'])) {
            $acuse_name = "";
        }else{
            $acuse_name = $_FILES['acusepdf']['name'];
        }

        if(empty($_FILES['requisitopdf']['name'])) {
            $requisito_name = "";
        }else{
            $requisito_name = $_FILES['requisitopdf']['name'];
        }

        if(empty($_FILES['acusepdf']['tmp_name'])) {
            $acuse_tmp = "";
        }else{
            $acuse_tmp = $_FILES['acusepdf']['tmp_name'];
        }

        if(empty($_FILES['requisitopdf']['tmp_name'])) {
            $requisito_tmp = "";
        }else{
            $requisito_tmp = $_FILES['requisitopdf']['tmp_name'];
        }

         $array = array(
            "idmatriz" => $_POST['idmatriz'],
            "fecha_emision" => $_POST['fechaemision'],
            "fechavencimiento" => $_POST['fechavencimiento'],
            "acuse_name" => $acuse_name,
            "requisito_name" => $requisito_name,
            "acuse_tmp" => $acuse_tmp,
            "requisito_tmp" => $requisito_tmp,            
            "hoy" => $hoy
            );

        echo $class_requisito_legal->editarRequisitoLegalHistorial($Session_IDEstacion,$array);
    break;
    case 'eliminar-detalle-requisito-legal':
        echo $class_requisito_legal->eliminarDetalleRequisitoLegal($_POST['idmatriz']);
    break;
    case 'eliminar-requisito-legal':
        echo $class_requisito_legal->eliminarRequisitoLegal($_POST['idre']);
    break;
}