<?php
require('../../../../app/help.php');

$vigencia = $_POST['vigencia'];
$fechaemision = $_POST['fechaemision'];

if($vigencia == "Anual"){

$fecha = date("Y-m-d",strtotime($fechaemision."+ 1 year"));
$Resultado = '<input type="date" class="form-control rounded-0" id="vencimiento" value="'.$fecha.'" />';	

}else if($vigencia == "Bianual"){

$fecha = date("Y-m-d",strtotime($fechaemision."+ 2 year"));	
$Resultado = '<input type="date" class="form-control rounded-0" id="vencimiento" value="'.$fecha.'" />';

}else if($vigencia == "Permanente"){

$fecha = "Permanente";	
$Resultado = $fecha;

}else if($vigencia == "Trimestral"){

$fecha = date("Y-m-d",strtotime($fechaemision."+ 3 month"));	
$Resultado = '<input type="date" class="form-control rounded-0" id="vencimiento" value="'.$fecha.'" />';

}else if($vigencia == "Diario"){

$fecha = date("Y-m-d",strtotime($fechaemision."+ 1 days"));
$Resultado = '<input type="date" class="form-control rounded-0" id="vencimiento" value="'.$fecha.'" />';

}else if($vigencia == "Cuando se realice cambio"){

$fecha = "Cuando se realice cambio";
$Resultado = $fecha;

}else if($vigencia == "Semestral"){

$fecha = date("Y-m-d",strtotime($fechaemision."+ 6 month"));	
$Resultado = '<input type="date" class="form-control rounded-0" id="vencimiento" value="'.$fecha.'" />';

}else if($vigencia == "Mejora continua"){

$fecha = "Mejora continua";	
$Resultado = $fecha;

}else if($vigencia == "3 años"){

$fecha = date("Y-m-d",strtotime($fechaemision."+ 3 year"));	
$Resultado = '<input type="date" class="form-control rounded-0" id="vencimiento" value="'.$fecha.'" />';

}else if($vigencia == "5 años"){

$fecha = date("Y-m-d",strtotime($fechaemision."+ 5 year"));	
$Resultado = '<input type="date" class="form-control rounded-0" id="vencimiento" value="'.$fecha.'" />';

}else if($vigencia == "10 años"){

    $fecha = date("Y-m-d",strtotime($fechaemision."+ 10 year"));	
    $Resultado = '<input type="date" class="form-control rounded-0" id="vencimiento" value="'.$fecha.'" />';
    
}else if($vigencia == "30 años"){

    $fecha = date("Y-m-d",strtotime($fechaemision."+ 30 year"));	
    $Resultado = '<input type="date" class="form-control rounded-0" id="vencimiento" value="'.$fecha.'" />';
    
    }

echo $Resultado;