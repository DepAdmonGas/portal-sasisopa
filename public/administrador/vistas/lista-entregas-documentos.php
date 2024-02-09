<?php
require('../../../app/help.php');

$sqlEntregas = "SELECT * FROM tb_entregas WHERE id = '".$_GET['id']."' ";
$resultEntregas = mysqli_query($con, $sqlEntregas);
$numeroEntregas = mysqli_num_rows($resultEntregas);
while($rowEntregas = mysqli_fetch_array($resultEntregas, MYSQLI_ASSOC)){
$estatus = $rowEntregas['estatus'];
}

$sql = "SELECT * FROM tb_entregas_documentos WHERE id_entrega = '".$_GET['id']."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

function Estacion($idEstacion, $con){
    $sql = "SELECT permisocre,razonsocial,direccioncompleta FROM tb_estaciones WHERE id = '".$idEstacion."'";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $razonsocial = $row['razonsocial'];
    $direccion = $row['direccioncompleta'];
    }
    $return = array('razonsocial' => $razonsocial, 'direccion' => $direccion);
    return $return;
    }

    function Documentos($idEntrega, $con){
        $sql = "SELECT id_entrega, id_estacion FROM a_entregas_documentos WHERE id_entrega = '".$idEntrega."' GROUP BY id_estacion";
        $result = mysqli_query($con, $sql);
        $numero = mysqli_num_rows($result);
        return $numero;
        }

    $Documento = Documentos($_GET['id'], $con);

?>
<table class="table table-bordered table-striped table-hover table-sm mt-2">
<thead>
<tr>
  <th class="text-center align-middle">No.</th>
  <?php if($Documento > 1){ ?>
  <th class="text-center align-middle">Razón Social</th>
  <?php } ?>
  <th class="text-center align-middle">Nombre del documento</th>  
  <th class="text-center align-middle">Fecha del oficio</th>
  <th class="text-center align-middle">Original y/o copia</th>
  <th class="text-center align-middle" width="32"><img src="<?=RUTA_IMG_ICONOS;?>documento.png"></th>
  <th class="text-center align-middle" width="32"><img src="<?=RUTA_IMG_ICONOS;?>eliminar.png"></th>
</tr>
</thead>
<tbody>
<?php 
if ($numero > 0) {
$num = 1;
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$id = $row['id'];

if($row['id_estacion'] != 0){
$Estacion = Estacion($row['id_estacion'], $con);
$RazonSocial = $Estacion['razonsocial'];
}

if($row['archivo'] == ""){
$Archivo = '<a onclick="Acuse('.$_GET['id'].','.$id.')" style="cursor: pointer;" ><img src="'.RUTA_IMG_ICONOS.'subir.png"></a>';
}else{
$Archivo = '<a onclick="Acuse('.$_GET['id'].','.$id.')" style="cursor: pointer;" ><img src="'.RUTA_IMG_ICONOS.'c-pago.png"></a>';
}

if($estatus == 0){
  $Eliminar = '<a onclick="Eliminar('.$_GET['id'].','.$id.')" style="cursor: pointer;" ><img src="'.RUTA_IMG_ICONOS.'eliminar.png"></a>';
}else{
  $Eliminar = '<a style="cursor: pointer;" ><img src="'.RUTA_IMG_ICONOS.'eliminar.png"></a>';
}

echo '<tr>';
echo '<td class="text-center align-middle"><b>'.$num.'</b></td>';
if($Documento > 1){
echo '<td class="text-center align-middle">'.$RazonSocial.'</td>';
}
echo '<td class="text-center align-middle">'.$row['documento'].'</td>';
echo '<td class="text-center align-middle">'.FormatoFecha($row['fecha']).'</td>';
echo '<td class="text-center align-middle">'.$row['detalle'].'</td>';
echo '<td class="text-center align-middle">'.$Archivo.'</td>';
echo '<td class="text-center align-middle">'.$Eliminar.'</td>';
echo '</tr>';

$num++;
}
}else{
echo "<tr><td colspan='6' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";		
}
?>
</tbody> 
</table>