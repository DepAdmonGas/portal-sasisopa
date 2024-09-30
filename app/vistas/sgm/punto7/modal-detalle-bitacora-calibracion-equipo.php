<?php
require('../../../../app/help.php');
 
$id = $_GET['id'];

function programaAnual($id_registro,$con){

$sql = "SELECT 
sgm_programa_anual_calibracion_verificacion.id,
sgm_programa_anual_calibracion_verificacion.id_estacion,
sgm_programa_anual_calibracion_verificacion.fecha,
sgm_programa_anual_calibracion_verificacion.estado,
sgm_patrones_instrumentos.nombre,
sgm_patrones_instrumentos.periodicidad,
sgm_patrones_instrumentos.categoria
FROM sgm_programa_anual_calibracion_verificacion
INNER JOIN sgm_patrones_instrumentos 
ON sgm_programa_anual_calibracion_verificacion.id_equipo = sgm_patrones_instrumentos.id 
WHERE sgm_programa_anual_calibracion_verificacion.id = '".$id_registro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$idestacion = $row['id_estacion'];
$nombre = $row['nombre'];
$estado = $row['estado'];

$array = array('idestacion' => $idestacion, 'nombre' => $nombre, 'estado' => $estado);
return $array;
}
$programaAnual = programaAnual($id,$con);

function equipoBitacora($id_programa,$id_estacion,$nombre,$con){

$sql = "SELECT * FROM sgm_bitacora_calibracion_equipo_detalle WHERE id_programa = '".$id_programa."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

$sql_equipo = "SELECT * FROM sgm_inventario_equipo WHERE id_estacion = '".$id_estacion."' AND nombre = '".$nombre."' ";
$result_equipo = mysqli_query($con, $sql_equipo);
$numero_equipo = mysqli_num_rows($result_equipo);
while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){

$sql_insert = "INSERT INTO sgm_bitacora_calibracion_equipo_detalle (
id_programa,
id_equipo,
resultado
  )
  VALUES (
  '".$id_programa."',
  '".$row_equipo['id']."',
  ''
  )";
  if(mysqli_query($con, $sql_insert)){
  return true;
  }else{
  return false;
  }

}
}else{
return false;
}

}

$sql = "SELECT * FROM sgm_bitacora_calibracion_equipo WHERE id_programa = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id_bitacora = $row['id'];
$fecha = $row['fecha'];
$hora = $row['hora'];
$nombreequipo = $row['nombre_equipo'];
$marca = $row['marca'];
$capacidad = $row['capacidad'];
$almacena = $row['almacena'];
$nombre_laboratorio = $row['nombre_laboratorio'];
$no_acreditacion = $row['no_acreditacion'];
$metodo_calibracion = $row['metodo_calibracion'];
$nombre_patron = $row['nombre_patron'];
$marca_modelo_serie = $row['marca_modelo_serie'];
$resolucion = $row['resolucion'];
$incertidumbre = $row['incertidumbre'];
$vigencia_certificado = $row['vigencia_certificado'];

equipoBitacora($id,$programaAnual['idestacion'],$programaAnual['nombre'],$con);
?>
     <div class="modal-header">
       <h4 class="modal-title">Bitácora la para la calibración de equipos</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">


        <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td class="align-middle"><b>Fecha:</b></td>
            <td class=""><?=FormatoFecha($fecha);?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Hora:</b></td>
            <td class=""><?=$hora;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Nombre del equipo a calibrar:</b></td>
            <td class="align-middle"><?=$nombreequipo;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Marca:</b></td>
            <td class=""><?=$marca;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Capacidad:</b></td>
            <td class=""><?=$capacidad;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Producto que almacena:</b></td>
            <td class="align-middle"><?=$almacena;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Nombre del laboratorio o unidad de verificación encargada de la calibración:</b></td>
            <td class=""><?=$nombre_laboratorio;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>No de acreditación o aprobación:</b></td>
            <td class=""><?=$no_acreditacion;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Método utilizado para la calibración:</b></td>
            <td class=""><?=$metodo_calibracion;?></td>
          </tr>
        </tbody>
      </table>

      <h5>Descripción de patrones utilizados</h5>

      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td class="align-middle"><b>Nombre del patrón</b></td>
            <td class=""><?=$nombre_patron;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Marca y modelo y serie</b></td>
            <td class=""><?=$marca_modelo_serie;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Resolución</b></td>
            <td class=""><?=$resolucion;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Incertidumbre</b></td>
            <td class=""><?=$incertidumbre;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Vigencia de su certificado de calibración</b></td>
            <td class=""><?=$vigencia_certificado;?></td>
          </tr>
        </tbody>
      </table>

      <table class="table table-bordered table-sm">
        <thead>
          <th>Equipo o Instrumento</th>
          <th>Identificacion</th>
          <th>Resultado</th>
        </thead>
        <tbody>
          <?php 

          $sql_equipo = "SELECT
          sgm_bitacora_calibracion_equipo_detalle.id,
          sgm_bitacora_calibracion_equipo_detalle.id_equipo,
          sgm_bitacora_calibracion_equipo_detalle.resultado,
          sgm_inventario_equipo.nombre,
          sgm_inventario_equipo.identificacion
          FROM sgm_bitacora_calibracion_equipo_detalle 
          INNER JOIN sgm_inventario_equipo 
          ON sgm_bitacora_calibracion_equipo_detalle.id_equipo = sgm_inventario_equipo.id
           WHERE sgm_bitacora_calibracion_equipo_detalle.id_programa = '".$id."' ";
          $result_equipo = mysqli_query($con, $sql_equipo);
          $numero_equipo = mysqli_num_rows($result_equipo);
          while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){

          echo '<tr>
          <td>'.$row_equipo['nombre'].'</td>
          <td>'.$row_equipo['identificacion'].'</td>
          <td class="">'.$row_equipo['resultado'].'</td>
          </tr>';

          }


          ?>

        </tbody>
      </table>

    </div>
