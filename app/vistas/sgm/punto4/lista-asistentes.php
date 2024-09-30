<?php
require('../../../../app/help.php');

$idRegistro = $_GET['idRegistro'];

$sql_capacitacion = "SELECT
sgm_seguimiento_asistentes.id,
sgm_seguimiento_asistentes.id_seguimiento,
sgm_seguimiento_asistentes.id_usuario,
tb_usuarios.nombre,
tb_usuarios.firma
FROM sgm_seguimiento_asistentes
INNER JOIN tb_usuarios 
ON sgm_seguimiento_asistentes.id_usuario = tb_usuarios.id
WHERE sgm_seguimiento_asistentes.id_seguimiento  = '".$idRegistro."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

function ValidaUsuario($idRegistro,$idpersonal,$con){
$sql_lista = "SELECT id FROM sgm_seguimiento_asistentes WHERE id_seguimiento = '".$idRegistro."' AND id_usuario = '".$idpersonal."' ";
$result_lista = mysqli_query($con, $sql_lista);
return $numero_lista = mysqli_num_rows($result_lista);
}
?>
 <script type="text/javascript">
$('.selectpicker').selectpicker();
</script>

            <div id="borderdirigidoa" style="border: 1px solid #DFDFDF;">
            <select class="selectpicker" id="PersonalFirma" multiple title="Selecciona" data-width="100%" >
              <?php
              $sql_lista = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND estatus = 0 ";
              $result_lista = mysqli_query($con, $sql_lista);
              $numero_lista = mysqli_num_rows($result_lista);
              while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

              $nombre = $row_lista['nombre'];
              
              $Valida = ValidaUsuario($idRegistro,$row_lista['id'],$con);
              if($Valida == 0){
              echo "<option value='".$row_lista['id']."'>".$nombre."</option>";
               }
              }
              ?> 
            </select>
            </div>

      <div class="text-right mb-2">
      <button type="button" class="btn btn-sm btn-Primary rounded-0 mt-3" onclick="btnGuardarFirma(<?=$idRegistro;?>)">Agregar asistente</button>
      </div>

      <table class="table table-bordered table-sm">
      <thead> 
      <tr>
      <th class="text-center align-middle">#</th>
      <th class="text-center align-middle">Nombre</th>
      <th class="text-center align-middle">Firma</th>
      <th class="text-center align-middle"></th>
      </tr>
      </thead>
      <tbody>
      <?php
      $num = 1;
      if ($numero_capacitacion > 0) {
      while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
      $id = $row_capacitacion['id'];
      $nombre = $row_capacitacion['nombre'];

      if($row_capacitacion['firma'] != ""){
        $firma = "<td class='text-center align-middle'><img  width='60' src='".RUTA_IMG_FIRMA_PERSONAL.$row_capacitacion['firma']."'></td>";
      }else{
        $firma = "<td class='text-center align-middle'></td>";
      }

      echo "<tr>";
      echo "<td class=' align-middle'>".$num."</td>";
      echo "<td class=' align-middle'>".$nombre."</td>";
      echo $firma;

      echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' onclick='EliminarAsistente(".$idRegistro.",".$id.")'></td>";

      echo "</tr>";

      $num = $num + 1;
      }
      }else{
      echo "<td colspan='5' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

      }
      ?>  
      </tbody>
      </table>