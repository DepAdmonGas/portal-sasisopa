<?php
require('../../../app/help.php');

$idCalendario = $_POST['idCalendario'];
$Contador = 0;

$sql = "SELECT id, resultado FROM tb_cursos_evaluacion WHERE id_calendario = '".$idCalendario."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Contador = $Contador + $row['resultado'];
}

if($numero == 0){
echo 0;
}else{
$Resultado = number_format(($Contador / $numero) * 100, 0);

$sql = "UPDATE tb_cursos_calendario SET
fecha_real = '".$fecha_del_dia."',
resultado = '".$Resultado."',
estado = 1
WHERE id = '".$idCalendario."' ";
mysqli_query($con, $sql);

		if($Resultado >= 90 && $Resultado <= 100){

	$titleMensaje = "<div class='text-center' style='font-size: 4em;color: #3186C1'>Felicidades</div>";
	$titleModulo = "<div class='text-center font-weight-light' style='font-size: 1.3em;color: #949494'>Acreditaste la evaluación</div>";
	$colorC = "text-success";
	$title = "<label class='text-secondary font-weight-light' style='font-size: 1.5em'> Excelente </label>";
	$Icono = '<img src="'.RUTA_IMG.'iconos/globos.png" style="width: 90%;">';
		
		}else if($Resultado >= 80 && $Resultado <= 89){

		$titleMensaje = "<div class='text-center' style='font-size: 4em;color: #3186C1'>Felicidades</div>";
	$titleModulo = "<div class='text-center font-weight-light' style='font-size: 1.3em;color: #949494'>Acreditaste la evaluación</div>";
	$colorC = "text-primary";
	$title = "<label class='text-secondary font-weight-light' style='font-size: 1.5em'> Bueno </label>";
	$Icono = '<img src="'.RUTA_IMG.'iconos/globos.png" style="width: 90%;">';
		
		}else if($Resultado >= 60 && $Resultado <= 79){

		$titleMensaje = "<div class='text-center' style='font-size: 4em;color: #3186C1'>Felicidades</div>";
	$titleModulo = "<div class='text-center font-weight-light' style='font-size: 1.3em;color: #949494'>Acreditaste la evaluación</div>";
	$colorC = "text-primary";
	$title = "<label class='text-secondary font-weight-light' style='font-size: 1.5em'> Regular </label>";
	$Icono = '<img src="'.RUTA_IMG.'iconos/globos.png" style="width: 90%;">';
		
		}else{

		$titleMensaje = "<div class='text-center' style='font-size: 4em;color: #C13131'>No acreditaste</div>";
		$titleModulo = "<div class='text-center font-weight-light' style='font-size: 1.3em;color: #949494'>Muy cerca pero no acreditaste la evaluación</div>";
		$colorC = "text-danger";
		$title = "<label class='text-secondary font-weight-light' style='font-size: 1.5em'> Malo </label>";
		$Icono = '<img src="'.RUTA_IMG.'iconos/calificacion-mala.png" style="width: 100%;">';
		
		}

$Contenido = '<div style="padding-top: 40px;">
<div class="container animated fadeIn" >
<div class="row" style="background: white;padding: 20px;">
<div class="col-4"> '.$Icono.' </div>
<div class="col-8">
'.$titleMensaje.'  
'.$titleModulo.'
<div class="text-center" style="padding-top: 30px;padding-bottom: 30px;"><label class="'.$colorC.'" style="font-size: 3.5em;">'.$Resultado.' %</label> '.$title.'</div>
<div class="text-center" style="padding-top: 40px;"><button type="button" class="btn btn-outline-primary" onclick="Regresar()">REGRESAR AL MENU PRINCIPAL</button></div>
</div>
</div>
</div>
</div>';

echo $Contenido;
}
//------------------
mysqli_close($con);
//------------------

?>