<?php
require('../../../../app/help.php');

function usuario($usuario,$con){
  $sql = "SELECT tb_usuarios.nombre, 
  tb_usuarios.firma, 
  tb_puestos.tipo_puesto
  FROM tb_usuarios
  INNER JOIN tb_puestos
  ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$usuario."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $Nombre = $row['nombre'];
  $puesto = $row['tipo_puesto'];
  $firma = $row['firma'];

  $array = array('nombre' => $Nombre, 'puesto' => $puesto, 'firma' => $firma);
  return $array;
  }

$sql = "SELECT 
tb_cursos_calendario.id, 
tb_cursos_calendario.fecha_programada, 
tb_cursos_calendario.fecha_real, 
tb_cursos_calendario.id_estacion, 
tb_cursos_calendario.id_personal, 
tb_cursos_calendario.id_tema,
tb_cursos_calendario.resultado, 
tb_cursos_calendario.estado, 
tb_cursos_temas.num_tema,
tb_cursos_temas.titulo,
tb_cursos_temas.categoria 
FROM tb_cursos_calendario 
INNER JOIN tb_cursos_temas 
ON tb_cursos_calendario.id_tema = tb_cursos_temas.id WHERE 
tb_cursos_calendario.id_estacion = '".$Session_IDEstacion."' AND tb_cursos_temas.categoria = 'SGM' ORDER BY tb_cursos_calendario.fecha_programada ASC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
?>

<table class="table table-bordered table-striped table-hover table-sm mb-0 pb-0">
<thead>
<tr>
  <th class="text-center align-middle">No</th>
  <th class="text-center align-middle">Nombre del curso</th>
  <th class="text-center align-middle">Tipo de capacitacion</th>
  <th class="text-center align-middle">Fecha programada</th>
  <th class="text-center align-middle">Duracion</th>
  <th class="text-center align-middle">Instructor</th>
  <th class="text-center align-middle">Fecha real de la toma del curso</th>
  <th class="text-center align-middle">Nombre de las personas que asistieron al curso</th>
  <th class="text-center align-middle">Evidencia</th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	if($row['fecha_real'] != '0000-00-00'){
	$fecha_real = FormatoFecha($row['fecha_real']);
	}else{
	$fecha_real = 'S/I';
	}

  $usuario = usuario($row['id_personal'],$con);

  if($row['resultado'] == 0){

    $Color = 'text-danger'; 
    $Titulo = 'Pendiente';
    $PDF = '<img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'img-no-24.png">';

    }else{
    if($row['resultado'] >= 90 && $row['resultado'] <= 100){
    $Color = 'text-success';
    $Titulo = $row['resultado'].' <small>(Excelente)</small>';
    $PDF = '<a target="_BLANK" href="descargar-reconocimiento-sgm/'.$row['id'].'"><img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
    }else if($row['resultado'] >= 80 && $row['resultado'] <= 89){
    $Color = 'text-primary';
    $Titulo = $row['resultado'].' <small>(Bueno)</small>';
    $PDF = '<a target="_BLANK" href="descargar-reconocimiento-sgm/'.$row['id'].'"><img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
    }else if($row['resultado'] >= 60 && $row['resultado'] <= 79){
    $Color = 'text-warning';
    $Titulo = $row['resultado'].' <small>(Regular)</small>';
    $PDF = '<a target="_BLANK" href="descargar-reconocimiento-sgm/'.$row['id'].'"><img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
    }else{
    $Color = 'text-danger'; 
    $Titulo = $row['resultado'].' <small>(Malo)</small>';
    $PDF = '<img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'img-no-24.png">';
    }
    }

echo "<tr>";
echo "<td class='text-center align-middle'>".$num."</td>";

echo "<td class='align-middle'>".$row['titulo']."</td>";
echo "<td class='text-center align-middle'>Interna</td>";
echo "<td class='text-center align-middle'>".FormatoFecha($row['fecha_programada'])."</td>";
echo "<td class='text-center align-middle'>30 minutos</td>";
echo "<td class='text-center align-middle'>GestoGas</td>";
echo "<td class='text-center align-middle'>".$fecha_real."</td>";
echo "<td class='text-center align-middle'>".$usuario['nombre']."</td>";
echo "<td class='text-center align-middle'>".$PDF."</td>";

echo "</tr>";
$num++;
}
}else{
echo "<td colspan='12' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>