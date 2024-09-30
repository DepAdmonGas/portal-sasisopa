<?php
require('../../../../app/help.php');

$idRegistro = $_GET['idRegistro'];

function validaEvaluacion($idRegistro,$id_usuario,$con){

$sql = "SELECT id FROM sgm_evaluacion_proveedores WHERE id_orden_servicio = '".$idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

$sql = "INSERT INTO sgm_evaluacion_proveedores (
id_orden_servicio,fecha,hora_inicio,hora_termino,nombre_proveedor,no_acreditacion,observaciones,id_personal_evaluacion,
respuesta_1,respuesta_2,respuesta_3,respuesta_4,respuesta_5,estado
)
VALUES (
'".$idRegistro."',
'',
'',
'',
'',
'',
'',
'".$id_usuario."',
2,
2,
2,
2,
2,
0
)";

if(mysqli_query($con, $sql)){}

}

}

validaEvaluacion($idRegistro,$Session_IDUsuarioBD,$con);


$sql = "SELECT * FROM sgm_orden_servicio WHERE id = '".$idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$descripcion = $row['descripcion'];

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

        <h5><?=$descripcion;?></h5>


    <div class="mt-2">
        <b>Fecha de ejecución del servicio:</b>
        <input type="date" class="form-control mt-2" onchange="EditarEvaluacion(this,<?=$id;?>,1)" value="<?=$fecha;?>">
    </div>

    <div class="row">
        <div class="col-6">
            <div class="mt-2">
            <b>Hora de inicio del servicio:</b>
            <input type="time" class="form-control mt-2" onchange="EditarEvaluacion(this,<?=$id;?>,2)" value="<?=$hora_inicio;?>">
            </div> 
        </div>
        <div class="col-6">
            <div class="mt-2">
            <b>Hora de culminación del servicio:</b>
            <input type="time" class="form-control mt-2" onchange="EditarEvaluacion(this,<?=$id;?>,3)" value="<?=$hora_termino;?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="mt-2">
            <b>Nombre del proveedor o prestador de servicio:</b>
            <input type="text" class="form-control mt-2" value="<?=$nombre_proveedor;?>" onkeyup="EditarEvaluacion(this,<?=$id;?>,4)">
            </div>
        </div>
        <div class="col-6">
            <div class="mt-2">
            <b>No de acreditación o aprobación:</b>
            <input type="text" class="form-control mt-2" value="<?=$no_acreditacion;?>" onkeyup="EditarEvaluacion(this,<?=$id;?>,5)">
            </div>
        </div>
    </div>


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
                <td class="text-center align-middle p-0 m-0">
                    <select class="form-control border-0" onchange="EditarEvaluacion(this,<?=$id;?>,8)">
                        <?php 
                        if($respuesta_1 == 2){
                        echo '<option value="2"></option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>';
                        }else if($respuesta_1 == 1){
                        echo '<option value="1">SI</option>
                        <option value="0">NO</option>';
                        }else if($respuesta_1 == 0){
                        echo '<option value="0">NO</option>
                        <option value="1">SI</option>';
                        }
                        ?>                        
                    </select>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Se verifico que el proveedor contara con procedimientos para ejecutar los trabajos </td>
                <td class="text-center align-middle p-0 m-0">
                    <select class="form-control border-0" onchange="EditarEvaluacion(this,<?=$id;?>,9)">
                        <?php 
                        if($respuesta_2 == 2){
                        echo '<option value="2"></option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>';
                        }else if($respuesta_2 == 1){
                        echo '<option value="1">SI</option>
                        <option value="0">NO</option>';
                        }else if($respuesta_2 == 0){
                        echo '<option value="0">NO</option>
                        <option value="1">SI</option>';
                        }
                        ?>   
                    </select>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Mientras el personal se mantuvo en las instalaciones ocupo EPP </td>
                <td class="text-center align-middle p-0 m-0">
                    <select class="form-control border-0" onchange="EditarEvaluacion(this,<?=$id;?>,10)">
                        <?php 
                        if($respuesta_3 == 2){
                        echo '<option value="2"></option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>';
                        }else if($respuesta_3 == 1){
                        echo '<option value="1">SI</option>
                        <option value="0">NO</option>';
                        }else if($respuesta_3 == 0){
                        echo '<option value="0">NO</option>
                        <option value="1">SI</option>';
                        }
                        ?>   
                    </select>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Los trabajos ejecutados tomaron en cuenta los procedimientos de seguridad </td>
                <td class="text-center align-middle p-0 m-0">
                    <select class="form-control border-0" onchange="EditarEvaluacion(this,<?=$id;?>,11)">
                        <?php 
                        if($respuesta_4 == 2){
                        echo '<option value="2"></option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>';
                        }else if($respuesta_4 == 1){
                        echo '<option value="1">SI</option>
                        <option value="0">NO</option>';
                        }else if($respuesta_4 == 0){
                        echo '<option value="0">NO</option>
                        <option value="1">SI</option>';
                        }
                        ?>   
                    </select>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>Al culminar el trabajo se encuentra a entera satisfacción</td>
                <td class="text-center align-middle p-0 m-0">
                    <select class="form-control border-0" onchange="EditarEvaluacion(this,<?=$id;?>,12)">
                        <?php 
                        if($respuesta_5 == 2){
                        echo '<option value="2"></option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>';
                        }else if($respuesta_5 == 1){
                        echo '<option value="1">SI</option>
                        <option value="0">NO</option>';
                        }else if($respuesta_5 == 0){
                        echo '<option value="0">NO</option>
                        <option value="1">SI</option>';
                        }
                        ?>   
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    
    <div class="mt-2">
        <b>Observaciones:</b>
        <textarea class="form-control mt-2" rows="1" onkeyup="EditarEvaluacion(this,<?=$id;?>,6)"><?=$observaciones;?></textarea>
    </div> 
    <div class="mt-2">
        <b>Nombre de quien realiza la evaluación:</b>
        <select class="form-control mt-2" onchange="EditarEvaluacion(this,<?=$id;?>,7)">
            <option value="<?=$id_personal_evaluacion;?>"><?=$usuario['nombre'];?></option>
            <?php 

            $sql1 = "SELECT tb_usuarios.id, tb_usuarios.nombre,
            tb_puestos.tipo_puesto
            FROM tb_usuarios
            INNER JOIN tb_puestos
            ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id_gas = '".$Session_IDEstacion."' AND tb_usuarios.estatus = 0 ";
              $result1 = mysqli_query($con, $sql1);
              $numero1 = mysqli_num_rows($result1);
              while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
                $Nombre = $row1['nombre'];
                echo '<option value="'.$row1['id'].'">'.$Nombre.'</option>';
              }
              

            ?>
        </select>
    </div>

    </div>
    <div class="modal-footer">
	<button type="button" class="btn btn-primary rounded-0" onclick="GuardarEvaluacion(1,<?=$id;?>,13)">Guardar</button>
	</div>