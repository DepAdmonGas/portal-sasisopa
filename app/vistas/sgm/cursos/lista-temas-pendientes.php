<?php
require('../../../../app/help.php');

$sql_modulos_cursos = "SELECT 
tb_cursos_calendario.id, 
tb_cursos_calendario.fecha_programada, 
tb_cursos_calendario.id_estacion, 
tb_cursos_calendario.id_personal, 
tb_cursos_calendario.id_tema,
tb_cursos_calendario.estado, 
tb_cursos_temas.num_tema,
tb_cursos_temas.titulo,
tb_cursos_temas.categoria 
FROM tb_cursos_calendario 
INNER JOIN tb_cursos_temas 
ON tb_cursos_calendario.id_tema = tb_cursos_temas.id WHERE tb_cursos_calendario.id_personal = '".$Session_IDUsuarioBD."' AND tb_cursos_calendario.estado = 0 AND tb_cursos_calendario.fecha_programada <= '".$fecha_del_dia."' AND tb_cursos_temas.categoria = 'SGM' ORDER BY tb_cursos_calendario.fecha_programada ASC "; 
$result_modulos_cursos = mysqli_query($con, $sql_modulos_cursos);
$numero_modulos_cursos  = mysqli_num_rows($result_modulos_cursos);

echo '<hr>';
echo '<h5>Cursos Pendientes</h5>';

echo '<span class="badge bg-primary text-white">Total pendientes: <b>'.$numero_modulos_cursos.'</b></span>';

echo '<div class="row mt-2">';
while($row_modulos_cursos = mysqli_fetch_array($result_modulos_cursos, MYSQLI_ASSOC)){
echo '<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
<div class="border p-2 bg-light mb-2">
<div class="text-right text-secondary"><small>'.FormatoFecha($row_modulos_cursos['fecha_programada']).'</small></div>
<div class="text-center mt-1"><b>'.$row_modulos_cursos['num_tema'].". ".$row_modulos_cursos['titulo'].'</b></div>
<div class="text-right mt-2"><button class="btn btn-sm btn-success" type="button" onclick="IniciarTema('.$row_modulos_cursos['id'].')">Inciar tema</button></div>
</div>
</div>';
}
echo '</div>';
?>


