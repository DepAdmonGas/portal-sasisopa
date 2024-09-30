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
$sql_lista = "SELECT * FROM sgm_hallazgo_auditoria_responsable WHERE id_hallazgo  = '".$idReporte."' AND id_responsable = '".$personal."' ";
$result_lista = mysqli_query($con, $sql_lista);
return $numero_lista = mysqli_num_rows($result_lista);
}
?>

              <select class="form-control rounded-0 rounded-0" onchange="AgregarPersonalResponsable(this,<?=$_GET['id'];?>,12)">
               <option value="">Selecione</option>
                <?php
                $sql_res_acciones = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND estatus = 0 ";
                $result_res_acciones = mysqli_query($con, $sql_res_acciones);
                $numero_res_acciones = mysqli_num_rows($result_res_acciones);
                while($row_res_acciones = mysqli_fetch_array($result_res_acciones, MYSQLI_ASSOC)){

                $nombre_acciones = $row_res_acciones['nombre'];
                $Valida = ValidaUsuario($_GET['id'],$row_res_acciones['id'],$con);
                if($Valida == 0){
                echo "<option value='".$row_res_acciones['id']."'>".$nombre_acciones."</option>";
                }

                }
                ?> 
              </select>

<?php
$sql = "SELECT * FROM sgm_hallazgo_auditoria_responsable WHERE id_hallazgo = '".$_GET['id']."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

echo '<ul class="list-group list-group-flush">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$nombre = usuario($row['id_responsable'],$con);

echo '<li class="list-group-item d-flex justify-content-between align-items-center p-2">
<small>'.$nombre['nombre'].'</small>
<img src="'.RUTA_IMG_ICONOS.'eliminar.png" style="cursor: pointer;" onclick="Eliminar(0,'.$_GET['id'].','.$row['id'].',13)">
</li>';
}
echo '</ul>';
?>