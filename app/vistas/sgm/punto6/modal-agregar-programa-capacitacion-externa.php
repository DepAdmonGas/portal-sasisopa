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
  
function ValidaUsuario($idReporte,$personal,$con){
$sql_lista = "SELECT * FROM sgm_programa_anual_capacitacion_externa_personal WHERE id_capacitacion = '".$idReporte."' AND id_usuario = '".$personal."' ";
$result_lista = mysqli_query($con, $sql_lista);
return $numero_lista = mysqli_num_rows($result_lista);
}

$id = $_GET['id'];
if($id == 0){
$titulo = 'Agregar programa anual de capacitacion externa';
$btnFinalizar = 'Agregar';
$nombre_curso = "";
$tipo_capacitacion = "";
$fecha_programada = "";
$duracion = "";
$instructor = "";
$fecha_real = "";
$estado = "";
}else{
$titulo = 'Editar programa anual de capacitacion externa';  
$btnFinalizar = 'Editar';

$sql = "SELECT * FROM sgm_programa_anual_capacitacion_externa WHERE id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$nombre_curso = $row['nombre_curso'];
$tipo_capacitacion = $row['tipo_capacitacion'];
$fecha_programada = $row['fecha_programada'];
$duracion = $row['duracion'];
$instructor = $row['instructor'];
$fecha_real = $row['fecha_real'];
$estado = $row['estado'];

}


?>

        <div class="modal-header">
          <h4 class="modal-title"><?=$titulo;?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        	<b>Nombrel curso:</b>
        	<input class="form-control" type="text" id="Nombrecurso" value="<?=$nombre_curso;?>">

          <div class="row">
            <div class="col-6">
              <div class="mt-2"><b>Fecha programada:</b></div>
              <input class="form-control" type="date" id="Fechaprogramada" value="<?=$fecha_programada;?>">
            </div>
            <div class="col-6">
              <div class="mt-2"><b>Duracion:</b></div>
              <input class="form-control" type="text" id="Duracion" value="<?=$duracion;?>">
            </div>
          </div>
       
          <div class="mt-2"><b>Instructor:</b></div>
          <input class="form-control" type="text" id="Instructor" value="<?=$instructor;?>">    	

          <?php 
          if($id != 0){
          ?>


            <div class="mt-2"><b>Fecha real de la toma del curso:</b></div>
            <input class="form-control" type="date" id="Fecharealprogramada" value="<?=$fecha_real;?>">

            <div class="border p-2 mt-2">
            <div class="mt-2"><b>Nombre de las personas que asistieron al curso</b></div>

              <select class="form-control rounded-0 rounded-0" onchange="AgregarPersonal(this,<?=$id;?>,1)">
               <option value="">Selecione</option>
                <?php
                $sql_res_acciones = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND estatus = 0 ";
                $result_res_acciones = mysqli_query($con, $sql_res_acciones);
                $numero_res_acciones = mysqli_num_rows($result_res_acciones);
                while($row_res_acciones = mysqli_fetch_array($result_res_acciones, MYSQLI_ASSOC)){

                $nombre_acciones = $row_res_acciones['nombre'];
                $Valida = ValidaUsuario($id,$row_res_acciones['id'],$con);
                if($Valida == 0){
                echo "<option value='".$row_res_acciones['id']."'>".$nombre_acciones."</option>";
                }

                }
                ?> 
              </select>

              <?php
              $sql = "SELECT * FROM sgm_programa_anual_capacitacion_externa_personal WHERE id_capacitacion = '".$id."' ";
              $result = mysqli_query($con, $sql);
              $numero = mysqli_num_rows($result);

              echo '<ul class="list-group list-group-flush">';
              while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

              $nombre = usuario($row['id_usuario'],$con);

              echo '<li class="list-group-item d-flex justify-content-between align-items-center p-2">
              <small>'.$nombre['nombre'].'</small>
              <img src="'.RUTA_IMG_ICONOS.'eliminar.png" style="cursor: pointer;" onclick="EliminarPersonal(0,'.$id.','.$row['id'].',2)">
              </li>';
              }
              echo '</ul>';
              ?>

            </div>

            <div class="border p-2 mt-2">
            <div class="mt-2"><b>Evidencia</b></div>

            <div class="row">
              <div class="col-9">
                <input type="file" name="" id="FileEvidencia">
              </div>
              <div class="col-3 text-right">
                <button class="btn btn-success btn-sm rounded-0" onclick="GuardarEvidencia(<?=$id;?>)">Guardar</button>
              </div>
            </div>

              <?php
              $sql_evidencia = "SELECT * FROM sgm_programa_anual_capacitacion_externa_evidencia WHERE id_capacitacion = '".$id."' ";
              $result_evidencia = mysqli_query($con, $sql_evidencia);
              $numero_evidencia = mysqli_num_rows($result_evidencia);

              echo '<ul class="list-group list-group-flush mt-2">';
              while($row_evidencia = mysqli_fetch_array($result_evidencia, MYSQLI_ASSOC)){

              echo '<li class="list-group-item d-flex justify-content-between align-items-center p-2">
              <a target="BLANK" href="archivos/sgm/'.$row_evidencia['archivo'].'"><small>'.$row_evidencia['archivo'].'</small></a>
              <img src="'.RUTA_IMG_ICONOS.'eliminar.png" style="cursor: pointer;" onclick="EliminarEvidencia(0,'.$id.','.$row_evidencia['id'].',4)">
              </li>';
              }
              echo '</ul>';
              ?>

            </div>

          <?php
          }
          ?>

        </div>
        <div class="modal-footer">
		<button type="button" class="btn btn-primary rounded-0" onclick="GuardarPrograma(<?=$id;?>)"><?=$btnFinalizar;?></button>
		</div>