<?php
require('../../../../app/help.php');
 
$id = $_GET['id'];

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

function validaRegistro($id,$con){

$sql = "SELECT * FROM sgm_cumplimiento_objetivos_revision_detalle WHERE id_cumplimiento = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

  $sql_insert = "INSERT INTO sgm_cumplimiento_objetivos_revision_detalle (
  id_cumplimiento,
  categoria,
  resultado1,
  resultado2,
  resultado3,
  resultado4,
  resultado5
  )
  VALUES ('".$id."','Indicador: Implementación del SGM','','','','',''),
  ('".$id."','Indicador: Calibración de equipos','','','','',''),
  ('".$id."','Indicador: Satisfacción del cliente','','','','','')
  ";
  mysqli_query($con, $sql_insert);

}
}

function ValidaUsuario($idReporte,$personal,$con){
$sql_lista = "SELECT * FROM sgm_cumplimiento_objetivos_revision_asistentes WHERE id_cumplimiento = '".$idReporte."' AND id_usuario = '".$personal."' ";
$result_lista = mysqli_query($con, $sql_lista);
return $numero_lista = mysqli_num_rows($result_lista);
}

validaRegistro($id,$con);

$sql = "SELECT * FROM sgm_cumplimiento_objetivos_revision WHERE id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$fecha = $row['fecha'];
$hora = $row['hora'];
$lugar = $row['lugar'];
$responsable = $row['responsable'];

?>
     <div class="modal-header rounded-0 head-modal">
       <h4 class="modal-title text-white">Editar Cumplimiento de objetivos y revisión por la dirección</h4>
       <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">

    <table class="table table-sm table-bordered">
    <tr>
    <td><b>Fecha:</b></td>
    <td class="p-0 m-0"><input type="date" class="form-control border-0" value="<?=$fecha;?>" onchange="Editar(this,<?=$id;?>,1)"></td>
    </tr>
    <tr>
    <td><b>Hora:</b></td>
    <td class="p-0 m-0"><input type="time" class="form-control border-0" value="<?=$hora;?>" onchange="Editar(this,<?=$id;?>,2)"></td>
    </tr>
    <tr>
    <td><b>Lugar:</b></td>
    <td class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$lugar;?>" onkeyup="Editar(this,<?=$id;?>,3)"></td>
    </tr>
    <tr>
    <td><b>Responsable de la medición:</b></td>
    <td class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$responsable;?>" onkeyup="Editar(this,<?=$id;?>,4)"></td>
    </tr>
    </table>

        <?php 

        $sql = "SELECT * FROM sgm_cumplimiento_objetivos_revision_detalle WHERE id_cumplimiento = '".$id."' ";
        $result = mysqli_query($con, $sql);
        $numero = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            if($row['categoria'] == 'Indicador: Satisfacción del cliente'){
            $meta = 'Meta: disminuir 30% de reclamaciones contra el año inmediato anterior ';
            }else{
            $meta = 'Meta: 100%';
            }

        echo '<table class="table table-sm table-bordered">
            <tbody>
            <tr class="bg-secondary text-white">
            <td colspan="3"><b>'.$row['categoria'].'</b></td>
            </tr>
            <tr>
            <td class="align-middle"><b>'.$meta.'</b></td>
            <td class="align-middle"><b>Resultado</b></td>
            <td class="p-0 b-0 align-middle"><input type="text" class="form-control border-0" value="'.$row['resultado1'].'" onkeyup="Editar(this,'.$row['id'].',6)"></td>
            </tr>
            <tr>
            <td class="align-middle"><b>Comentarios y observaciones:</b></td>
            <td colspan="2" class="p-0 m-0 align-middle">
            <textarea class="form-control border-0" onkeyup="Editar(this,'.$row['id'].',7)">'.$row['resultado2'].'</textarea>
            </td>
            </tr>

            <tr>
            <td colspan="3"><b>Acciones a tomar para mejorar o mantener el resultado:</b></td>
            </tr>
            <tr>
            <td colspan="3" class="p-0 m-0">
            <textarea class="form-control border-0" onkeyup="Editar(this,'.$row['id'].',8)">'.$row['resultado3'].'</textarea>
            </td>
            </tr>

            <tr>
            <td colspan="3"><b>Responsable de realizar las acciones a tomar para mejorar o mantener los resultados:</b></td>
            </tr>
            <tr>
            <td colspan="3" class="p-0 m-0">
            <textarea class="form-control border-0" onkeyup="Editar(this,'.$row['id'].',9)">'.$row['resultado4'].'</textarea>
            </td>
            </tr>

            <tr>
            <td colspan="3"><b>Recursos necesarios para ejecutar las acciones a tomar para mejorar o mantener los resultados:</b></td>
            </tr>
            <tr>
            <td colspan="3" class="p-0 m-0">
            <textarea class="form-control border-0" onkeyup="Editar(this,'.$row['id'].',10)">'.$row['resultado5'].'</textarea>
            </td>
            </tr>

            </tbody>
            </table>';
        }

        ?>

       <select class="form-control rounded-0" onchange="agregarAsistente(this,<?=$id;?>,11)">
       <option value="">Selecciona el personal</option>
        <?php
        $sql_lista = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND estatus = 0 ";
        $result_lista = mysqli_query($con, $sql_lista);
        $numero_lista = mysqli_num_rows($result_lista);
        while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

        $nombre = $row_lista['nombre'];
        
        $Valida = ValidaUsuario($id,$row_lista['id'],$con);
        if($Valida == 0){
        echo "<option value='".$row_lista['id']."'>".$row_lista['nombre']."</option>";
      }
        }
        ?> 
      </select>

        <table class="table table-sm table-bordered mt-1">
          <tbody>
            <tr class="bg-secondary text-white">
              <td colspan="3">Asistentes</td>
            </tr>
            <?php

            $sql_as = "SELECT * FROM sgm_cumplimiento_objetivos_revision_asistentes WHERE id_cumplimiento = '".$id."' ";
            $result_as = mysqli_query($con, $sql_as);
            $numero_as = mysqli_num_rows($result_as);
            while($row_as = mysqli_fetch_array($result_as, MYSQLI_ASSOC)){

              $asistente = usuario($row_as['id_usuario'],$con);

              echo '<tr>
              <td class="align-middle">'.$asistente['nombre'].'</td>
              <td class="align-middle text-center"><img width="100px" src="'.RUTA_IMG_FIRMA_PERSONAL.$asistente['firma'].'"></td>
              <td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'eliminar.png" style="cursor: pointer;" onclick="EliminarAsistente('.$id.','.$row_as['id'].',12)"></td>
              </tr>';
            }

            ?>
          </tbody>
        </table>

    

    </div>
    <div class="modal-footer">
	<button type="button" class="btn btn-primary rounded-0" onclick="Finalizar(1,<?=$id;?>,13)">Finalizar</button>
	</div>

     	 	 	 	 
