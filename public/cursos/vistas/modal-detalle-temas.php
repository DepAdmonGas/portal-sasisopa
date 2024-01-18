<?php 
require('../../../app/help.php');

$idTema = $_GET['id'];

$Detalle = Detalle($idTema, $con);

$TituloModulo = $Detalle['Modulo'];
$TituloTema = $Detalle['Tema'];

function Detalle($idTema, $con){
$sql = "SELECT 
tb_cursos_modulos.id,
tb_cursos_modulos.num_modulo,
tb_cursos_modulos.titulo AS tituloModulo,
tb_cursos_temas.num_tema,
tb_cursos_temas.titulo AS tituloTema
FROM tb_cursos_modulos 
INNER JOIN tb_cursos_temas
ON tb_cursos_modulos.id = tb_cursos_temas.id_modulo
WHERE tb_cursos_temas.id = '".$idTema."'
";
$result = mysqli_query($con, $sql);
$numero  = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$Modulo = $row['num_modulo'].'. '.$row['tituloModulo'];
$Tema = $row['num_tema'].'. '.$row['tituloTema'];
}

$arrayName = array('Modulo' => $Modulo, 'Tema' => $Tema);
return $arrayName;
}

$sql = "SELECT 
tb_cursos_calendario.id, 
tb_cursos_calendario.fecha_programada, 
tb_cursos_calendario.id_estacion, 
tb_cursos_calendario.id_personal, 
tb_cursos_calendario.id_tema,
tb_cursos_calendario.resultado, 
tb_cursos_calendario.estado, 
tb_cursos_temas.num_tema,
tb_cursos_temas.titulo,
tb_cursos_modulos.num_modulo,
tb_cursos_modulos.titulo AS nomModulo
FROM tb_cursos_calendario 
INNER JOIN tb_cursos_temas 
ON tb_cursos_calendario.id_tema = tb_cursos_temas.id 
INNER JOIN tb_cursos_modulos
ON tb_cursos_temas.id_modulo = tb_cursos_modulos.id
WHERE tb_cursos_calendario.id_personal = '".$Session_IDUsuarioBD."' AND tb_cursos_calendario.id_tema = '".$idTema."' ORDER BY tb_cursos_calendario.fecha_programada DESC "; 
$result = mysqli_query($con, $sql);
$numero  = mysqli_num_rows($result);

/*while($row1 = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$NumMOdulo = $row1['num_modulo'];
$Modulo = $row1['nomModulo'];
$NumTema = $row1['num_tema'];
$titulo = $row1['titulo'];
}*/
?>
<div class="modal-header">
<h5 class="modal-title">Modulo <?=$TituloModulo;?></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body"> 
<h5>Tema <?=$TituloTema;?></h5>

<table class="table table-sm table-striped">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Resultado</th>
			<th class="text-center">Reconocimiento</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

		if($row['resultado'] == 0){

		$Color = 'text-danger';	
		$Titulo = 'Pendiente';
		$PDF = '<img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'img-no-24.png">';

		}else{
		if($row['resultado'] >= 90 && $row['resultado'] <= 100){
		$Color = 'text-success';
		$Titulo = $row['resultado'].' <small>(Excelente)</small>';
		$PDF = '<a target="_BLANK" href="../descargar-reconocimiento/'.$row['id'].'"><img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
		}else if($row['resultado'] >= 80 && $row['resultado'] <= 89){
		$Color = 'text-primary';
		$Titulo = $row['resultado'].' <small>(Bueno)</small>';
		$PDF = '<a target="_BLANK" href="../descargar-reconocimiento/'.$row['id'].'"><img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
		}else if($row['resultado'] >= 60 && $row['resultado'] <= 79){
		$Color = 'text-warning';
		$Titulo = $row['resultado'].' <small>(Regular)</small>';
		$PDF = '<a target="_BLANK" href="../descargar-reconocimiento/'.$row['id'].'"><img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
		}else{
		$Color = 'text-danger';	
		$Titulo = $row['resultado'].' <small>(Malo)</small>';
		$PDF = '<img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'img-no-24.png">';
		}
		}

	echo '<tr>
	<td class="align-middle">'.FormatoFecha($row['fecha_programada']).'</td>
	<td class="'.$Color.' align-middle"><b>'.$Titulo.'</b></td>
	<td class="text-center">'.$PDF.'</td>
	</tr>';
	}
	?>
	</tbody>
</table>

</div>