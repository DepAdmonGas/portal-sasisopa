<?php
require ('../../app/help.php');

$Dia = $_GET['fecha'];
$opcion = $_GET['opcion'];
$CalenDate = date("Y-m-d",$Dia);

if($opcion == 0){
$estadoActividad = "AND fecha_inicio <= '".$CalenDate."' AND estado = 0 ";
$estadoCurso = "tb_cursos_calendario.fecha_programada <= '".$CalenDate."' AND tb_cursos_calendario.estado = 0";
}else{
$estadoActividad = "AND fecha_inicio = '".$CalenDate."' ";
$estadoCurso = "tb_cursos_calendario.fecha_programada = '".$CalenDate."' ";	
}

$sql = "SELECT * FROM tb_calendario_actividades WHERE id_estacion  = '".$Session_IDEstacion."' $estadoActividad  ORDER BY fecha_inicio ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

$sqlCurso = "SELECT
tb_cursos_calendario.id, 
tb_cursos_calendario.fecha_programada, 
tb_cursos_calendario.id_estacion, 
tb_cursos_calendario.id_personal, 
tb_cursos_calendario.id_tema,
tb_cursos_calendario.resultado,
tb_cursos_calendario.observaciones,
tb_cursos_calendario.estado, 
tb_cursos_temas.num_tema,
tb_cursos_temas.titulo,
tb_usuarios.nombre
FROM tb_cursos_calendario 
INNER JOIN tb_cursos_temas 
ON tb_cursos_calendario.id_tema = tb_cursos_temas.id
INNER JOIN tb_usuarios 
ON tb_cursos_calendario.id_personal = tb_usuarios.id WHERE tb_cursos_calendario.id_estacion  = '".$Session_IDEstacion."' AND 
$estadoCurso  ORDER BY tb_cursos_calendario.fecha_programada ASC ";
$resultCurso = mysqli_query($con, $sqlCurso);
$numeroCurso = mysqli_num_rows($resultCurso);

function Actividad($idActividad,$con){
$sql = "SELECT formato, actividad FROM sa_sasisopa_actividades WHERE id = '".$idActividad."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$formato = $row['formato'];	
$actividad = $row['actividad'];	
}
$array = array('formato' => $formato, 'actividad' => $actividad);
return $array;
}

?>
<div class="bg-white p-2">
<h5><?=FormatoFecha($CalenDate);?></h5>
</div>

<div class="row mt-1">
	<div class="col-6">
	<div class="bg-white p-2">

	<h6 class="">Actividades</h6>

		<?php 

		if ($numero > 0) {
		echo '<ul class="list-group rounded-0 mt-3">';
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

        if($row['estado'] == 1){
        $color = 'list-group-item-success';
        }else{

        if($row['fecha_inicio'] == $fecha_del_dia){
        $color = 'list-group-item-warning';
        }else if($row['fecha_inicio'] <= $fecha_del_dia){
        $color = 'list-group-item-danger';  
        }else{
        $color = '';    
        }

        }

        $Actividad = Actividad($row['id_actividad'],$con);
		
		$id = $row['id'];
		echo ' <li class="list-group-item list-group-item-action fs-6 fw-light '.$color.'" onclick="DetalleActividad('.$id.')">
		<b>00'.$row['folio'].'</b> '.$Actividad['formato'].' '.$Actividad['actividad'].'</li>';
		}
		echo '</ul>';
		}else{
		echo '<div class="alert alert-secondary mt-4" role="alert">
		  No se encontraron actividades 
		</div>';	
		}
		?>

		</div>
	</div>
	<div class="col-6">
		<div class="bg-white p-2">
			<h6 class="">Cursos</h6>
			<?php 

		if ($numeroCurso > 0) {
		echo '<ul class="list-group rounded-0 mt-3">';
		while($rowCurso = mysqli_fetch_array($resultCurso, MYSQLI_ASSOC)){

        if($rowCurso['estado'] == 1){
        $colorCurso = '';
        }else{
        if($rowCurso['fecha_inicio'] == $fecha_del_dia){
        $colorCurso = 'list-group-item-warning';
        }else if($rowCurso['fecha_inicio'] <= $fecha_del_dia){
        $colorCurso = 'list-group-item-danger';  
        }else{
        $colorCurso = '';    
        }
        }

        if($rowCurso['resultado'] == 0){

		$Titulo = '<div class="text-danger text-end"><b>Pendiente</b></div>';

		}else{
		if($rowCurso['resultado'] >= 90 && $rowCurso['resultado'] <= 100){
		$Titulo = '<div class="text-success text-end"><b>'.$rowCurso['resultado'].' (Excelente)</b></div>';
		}else if($rowCurso['resultado'] >= 80 && $rowCurso['resultado'] <= 89){
		$Titulo = '<div class="text-primary text-end"><b>'.$rowCurso['resultado'].' (Bueno)</b></div>';
		}else if($rowCurso['resultado'] >= 60 && $rowCurso['resultado'] <= 79){
		$Titulo = '<div class="text-warning text-end"><b>'.$rowCurso['resultado'].' (Regular)</b></div>';
		}else{
		$Titulo = '<div class="text-danger text-end"><b>'.$rowCurso['resultado'].' (Malo)</b></div>';

		if($rowCurso['estado'] == 1){
		$Onclick = 'onclick="ModalCursos('.$rowCurso['id'].')"';
		}else{
		$Onclick = '';
		}

		}
		}

		if($rowCurso['observaciones'] == ""){
		$observaciones = '';
		}else{
		$observaciones = ' ('.$rowCurso['observaciones'].')';
		}



		$id = $rowCurso['id'];
		echo ' <li class="list-group-item list-group-item-action fs-6 fw-light '.$colorCurso.'" '.$Onclick.'>
		<div><b>'.$rowCurso['nombre'].'</b></div>
		<div>'.$rowCurso['num_tema'].'.  '.$rowCurso['titulo'].$observaciones.'</div>
		'.$Titulo.'
		</li>';
		}
		echo '</ul>';
		}else{
		echo '<div class="alert alert-secondary mt-4" role="alert">
		  No se encontraron cursos 
		</div>';	
		}
		?>
		</div>
	</div>
</div>

