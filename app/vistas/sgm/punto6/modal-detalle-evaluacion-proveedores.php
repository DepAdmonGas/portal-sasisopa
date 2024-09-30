<?php
require('../../../../app/help.php');

$idRegistro = $_GET['idRegistro'];


$sql = "SELECT * FROM sgm_orden_servicio WHERE id = '".$idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$descripcion = $row['descripcion'];
$realizadopor = $row['realizadopor'];

$sql_eva = "SELECT * FROM sgm_evaluacion_proveedores WHERE id_orden_servicio = '".$idRegistro."' ";
$result_eva = mysqli_query($con, $sql_eva);
$numero_eva = mysqli_num_rows($result_eva);
$row_eva = mysqli_fetch_array($result_eva, MYSQLI_ASSOC);
$id = $row_eva['id'];
$fecha = $row_eva['fecha'];
$hora_inicio = $row_eva['hora_inicio'];
$hora_termino = $row_eva['hora_termino'];
$nombre_proveedor = $row_eva['nombre_proveedor'];
$no_acreditacion = $row_eva['no_acreditacion'];
$observaciones = $row_eva['observaciones'];
$id_personal_evaluacion = $row_eva['id_personal_evaluacion'];

$respuesta_1 = $row_eva['respuesta_1'];
$respuesta_2 = $row_eva['respuesta_2'];
$respuesta_3 = $row_eva['respuesta_3'];
$respuesta_4 = $row_eva['respuesta_4'];
$respuesta_5 = $row_eva['respuesta_5'];
 
$usuario = usuario($id_personal_evaluacion,$con);
function usuario($usuario,$con){
    $sql = "SELECT tb_usuarios.nombre,
    tb_puestos.tipo_puesto
    FROM tb_usuarios
    INNER JOIN tb_puestos
    ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$usuario."' ";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $Nombre = $row['nombre'];
      $puesto = $row['tipo_puesto'];
    
      $array = array('nombre' => $Nombre, 'puesto' => $puesto);
      return $array;
      }
?>
     <div class="modal-header">
       <h4 class="modal-title">Evaluación de proveedores</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">

        <table class="table">
            <tbody>
                <tr>
                    <td><b>Trabajo realizado o producto adquirido:</b></td>
                    <td><?=$descripcion;?></td>
                </tr>
                <tr>
                    <td><b>Fecha de ejecución del servicio:</b></td>
                    <td><?=FormatoFecha($fecha);?></td>
                </tr>
                <tr>
                    <td><b>Hora de inicio del servicio:</b></td>
                    <td><?=$hora_inicio;?></td>
                </tr>
                <tr>
                    <td><b>Hora de culminación del servicio:</b></td>
                    <td><?=$hora_termino;?></td>
                </tr>
                <tr>
                    <td><b>Nombre del proveedor o prestador de servicio:</b></td>
                    <td><?=$nombre_proveedor;?></td>
                </tr>
                <tr>
                    <td><b>No de acreditación o aprobación:</b></td>
                    <td><?=$no_acreditacion;?></td>
                </tr>
            </tbody>
        </table>





    <table class="table table-bordered table-sm mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Aspecto a evaluar </th>
                <th>Respuesta</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>El trabajo fue ejecutado conforme a lo solicitado</td>
                <td class="text-center align-middle"><?php echo ($respuesta_1 == 1)? 'SI' : 'NO'; ?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Se verifico que el proveedor contara con procedimientos para ejecutar los trabajos </td>
                <td class="text-center align-middle"><?php echo ($respuesta_2 == 1)? 'SI' : 'NO'; ?></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Mientras el personal se mantuvo en las instalaciones ocupo EPP </td>
                <td class="text-center align-middle"><?php echo ($respuesta_3 == 1)? 'SI' : 'NO'; ?></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Los trabajos ejecutados tomaron en cuenta los procedimientos de seguridad </td>
                <td class="text-center align-middle"><?php echo ($respuesta_4 == 1)? 'SI' : 'NO'; ?></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Al culminar el trabajo se encuentra a entera satisfacción</td>
                <td class="text-center align-middle"><?php echo ($respuesta_5 == 1)? 'SI' : 'NO'; ?></td>
            </tr>
        </tbody>
    </table>
    
    <div class="mt-2">
        <b>Observaciones:</b>        
        <div class="mt-2 p-2 border"><?=$observaciones;?></div>
    </div> 
    <div class="mt-2">
        
        <table class="table mt-3">
            <tr>
                <td><b>Nombre de quien realiza la evaluación:</b></td>
                <td><?=$usuario['nombre'];?></td>
            </tr>
            <tr>
                <td><b>Puesto:</b></td>
                <td><?=$usuario['puesto'];?></td>
            </tr>
        </table>

    </div>

    </div>
