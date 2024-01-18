<?php
require('../../../app/help.php');

$selyear = $_GET['selyear'];
$selmes = $_GET['selmes'];

if($selmes == 0){
$MesPDF = 'x';
$Mes = '';
}else{
$MesPDF = $selmes;
$Mes = 'AND MONTH(tb_dispensarios_apertura_bitacora.fecha) ='.$selmes;	
}

$sql_lista = "SELECT 
tb_dispensarios_apertura_bitacora.id,
tb_dispensarios.id_estacion, 
tb_dispensarios.no_dispensario,
tb_dispensarios.marca,
tb_dispensarios.modelo,
tb_dispensarios.serie,
tb_dispensarios_apertura_bitacora.fecha,
tb_dispensarios_apertura_bitacora.hora_inicio,
tb_dispensarios_apertura_bitacora.hora_termino,
tb_dispensarios_apertura_bitacora.lado,
tb_dispensarios_apertura_bitacora.producto,
tb_dispensarios_apertura_bitacora.clave,
tb_dispensarios_apertura_bitacora.motivo,
tb_usuarios.nombre,
tb_dispensarios_apertura_bitacora.detalle
FROM tb_dispensarios_apertura_bitacora 
INNER JOIN tb_dispensarios 
ON tb_dispensarios_apertura_bitacora.id_dispensario = tb_dispensarios.id 
INNER JOIN tb_usuarios
ON tb_dispensarios_apertura_bitacora.responsable = tb_usuarios.id
WHERE  tb_dispensarios.id_estacion = '".$Session_IDEstacion."' $Mes AND YEAR(tb_dispensarios_apertura_bitacora.fecha) = '".$selyear."' ORDER BY tb_dispensarios_apertura_bitacora.fecha desc , tb_dispensarios_apertura_bitacora.hora_inicio desc ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);

?>

<div class="text-right mb-2">

<!-- <a onclick="btnReporte(<?=$selyear;?>, '<?=$MesPDF;?>')" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a> -->

 <a download href="public/sasisopa/vistas/reporte-excel-bitacora-dispensario-buscar.php?Year=<?=$selyear;?>&Mes=<?=$MesPDF;?>" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Excel" >
    <img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>">
    </a>

 <a onclick="ListaDispensario()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Regresar" >
    <img src="<?php echo RUTA_IMG_ICONOS."eliminar.png"; ?>">
    </a>

</div>
   
<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm">
<thead>	
<tr>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Hora inicio</th>
<th class="text-center align-middle">Hora termino</th>
<th class="text-center align-middle">Dispensario</th>
<th class="text-center align-middle">Marca</th>
<th class="text-center align-middle">Modelo</th>
<th class="text-center align-middle">Serie</th>
<th class="text-center align-middle">Lado</th>
<th class="text-center align-middle">Producto</th>
<th class="text-center align-middle">Motivo</th>
<th class="text-center align-middle">Responsable</th>
<th class="text-center align-middle">Detalle</th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero_lista > 0) {
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$id = $row_lista['id'];

if($row_lista['hora_termino'] == '00:00:00'){
$HoraTermino = 'S/I';
}else{
$HoraTermino = date('h:i a', strtotime($row_lista['hora_termino']));
}

echo '<tr onclick="detalle('.$id.')">';
echo '<td class="text-center align-middle">'.FormatoFecha($row_lista['fecha']).'</td>';
echo '<td class="text-center align-middle">'.date('h:i a', strtotime($row_lista['hora_inicio'])).'</td>';
echo '<td class="text-center align-middle">'.$HoraTermino.'</td>';
echo '<td class="text-center align-middle">'.$row_lista['no_dispensario'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['marca'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['modelo'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['serie'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['lado'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['producto'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['clave'].' ('.$row_lista['motivo'].')</td>';
echo '<td class="text-center align-middle">'.$row_lista['nombre'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['detalle'].'</td>';
echo '</tr>';

}
}else{
echo "<tr><td colspan='14' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td></tr>";
}
?>
</tbody>
</table>
</div>