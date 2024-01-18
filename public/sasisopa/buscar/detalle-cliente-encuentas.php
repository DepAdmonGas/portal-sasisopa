<?php
require('../../../app/help.php');

$IdCliente = $_POST['IdCliente'];

$sql_cliente = "SELECT * FROM tb_encuentas_estacion_cliente WHERE id = '".$IdCliente."'";
$result_cliente = mysqli_query($con, $sql_cliente);
$numero_cliente = mysqli_num_rows($result_cliente);
while($row_cliente = mysqli_fetch_array($result_cliente, MYSQLI_ASSOC)){
$nombre = $row_cliente['nombre'];
}

$sql_comentario = "SELECT * FROM tb_encuentas_estacion_cliente_comentarios WHERE id_cliente = '".$IdCliente."'";
$result_comentario = mysqli_query($con, $sql_comentario);
$numero_comentario = mysqli_num_rows($result_comentario);
while($row_comentario = mysqli_fetch_array($result_comentario, MYSQLI_ASSOC)){
$comentario = $row_comentario['comentario'];
}


$sql_encuesta = "SELECT tb_encuentas_estacion_cliente_preguntas.id_cliente, tb_encuentas_estacion_cliente_preguntas.id_pregunta, tb_encuentas_estacion_cliente_preguntas.resultado,
tb_encuentas_cuestionario.num_pregunta, tb_encuentas_cuestionario.pregunta
FROM tb_encuentas_estacion_cliente_preguntas
INNER JOIN tb_encuentas_cuestionario ON tb_encuentas_estacion_cliente_preguntas.id_pregunta = tb_encuentas_cuestionario.id WHERE id_cliente = '".$IdCliente."' ORDER BY num_pregunta ASC";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);


?>
<div class="modal-header">
          <h5 class="modal-title"><?=$nombre;?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <?php
        while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){
        $numpregunta = $row_encuesta['num_pregunta'];
        $pregunta = $row_encuesta['pregunta'];
        if ($row_encuesta['resultado'] == 4) {
        $Respuesta = "Excelente";
        $Color = "#0099F0";
        }else if ($row_encuesta['resultado'] == 3) {
        $Respuesta = "Bueno";
        $Color = "#1EAD4E";
        }else if ($row_encuesta['resultado'] == 2) {
        $Respuesta = "Regular";
        $Color = "#F3C000";
        }else if ($row_encuesta['resultado'] == 1) {
        $Respuesta = "Malo";
        $Color = "#E70606";
        }
        ?>
        <div class="p-1">
        <div class="card p-3">
		<div class="font-weight-bold" style="font-size: 1.2em"><?=$numpregunta;?>.- <?=$pregunta;?></div>
		<div class="font-weight-bold" style="margin-top: 5px;font-size: 1.1em;color: <?=$Color;?>">R: <?=$Respuesta;?></div>
		</div>
		</div>
        <?php
        }
        ?>
        <hr>
        <div style="margin-top: 5px;">
        <small class="text-secondary">Comentario:</small>
        <p style="font-size: 1.1em"><?=$comentario;?></p>
        </div>
        </div>
