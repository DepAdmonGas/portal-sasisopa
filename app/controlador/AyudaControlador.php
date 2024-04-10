<?php
require('../../app/help.php');
include_once "../../app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();

switch($_POST['accion']){
    
    case 'actualizar-ayuda':
        echo $class_ayuda->actualizarAyuda($_POST['idayuda']);    
    break;

}