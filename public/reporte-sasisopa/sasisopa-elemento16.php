<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$sql_inv = "SELECT * FROM tb_investigacion_incidente_accidente WHERE id_estacion= '".$Session_IDEstacion."' AND fechacreacion BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY id desc ";
$result_inv = mysqli_query($con, $sql_inv);
$numero_inv = mysqli_num_rows($result_inv);

function Usuario($id, $con){

$sql_usuarios = "SELECT 
tb_usuarios.id,
tb_usuarios.nombre,
tb_puestos.tipo_puesto
FROM tb_usuarios
INNER JOIN tb_puestos ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$id."' ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$nombre = $row_usuarios['nombre'];
$puesto = $row_usuarios['tipo_puesto'];
}

$array = array("nombre" => $nombre, "puesto" => $puesto);

return $array;
}


function Grupo($id, $con){

$sql_inv = "SELECT * FROM tb_investigacion_incidente_accidente_grupo WHERE id_investigacion= '".$id."' ORDER BY id desc ";
$result_inv = mysqli_query($con, $sql_inv);
$numero_inv = mysqli_num_rows($result_inv);

return $numero_inv;
}

function formatos($id, $con){

$sql_archivo = "SELECT * FROM tb_investigacion_incidente_accidente_formato WHERE id_investigacion = '".$id."' ORDER BY id asc ";
$result_archivo = mysqli_query($con, $sql_archivo);
$numero_archivo = mysqli_num_rows($result_archivo);
while($row_archivo = mysqli_fetch_array($result_archivo, MYSQLI_ASSOC)){
$archivo = $row_archivo['archivo'];
}
return $archivo;
}

$sql_resultado = "SELECT * FROM tb_investigacion_incidente_accidente_no WHERE id_estacion = '".$Session_IDEstacion."' AND fecha BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY id desc";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);
?>
<h4>16. INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES</h4>

    <div class="text-right mb-2">
    <a class="ml-2" href="../../public/reporte-sasisopa/descargar-investigacion-incidentes-accidentes-pdf.php?FechaInicio=<?=$_GET['FechaInicio'];?>&FechaTermino=<?=$_GET['FechaTermino'];?>" style="cursor: pointer;">
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>
    </div>

<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<th class="text-center">#</th>
<th class="text-center">Fecha</th>
<th class="text-center">Nombre</th>
<th class="text-center">Puesto</th>
<th class="text-center">Descripción evento</th>
<th class="text-center">Tipo evento</th>
<th class="text-center">Muertes</th>
<th class="text-center"><span class="badge badge-pill badge-primary">1</span> Grupo interdiciplinario</th>
<th class="text-center"><span class="badge badge-pill badge-primary">2</span> Fo.ADMONGAS.026</th>
<th class="text-center"><span class="badge badge-pill badge-primary">3</span> Tercer Autorizado</th>
</thead>
<tbody>
<?php
$i = 1;
if ($numero_inv > 0) {
while($row_inv = mysqli_fetch_array($result_inv, MYSQLI_ASSOC)){
$id = $row_inv['id'];
$fechahora = explode(" ", $row_inv['fechacreacion']);
$Usuario = Usuario($row_inv['id_usuario'], $con);

$formato026 = formatos($id, $con);

if ($row_inv['muertes'] == 0) {
$muertes = "NO";
}else{
$muertes = "SI";
}

if ($row_inv['tercer_autorizado'] == 0) {

$ArcF026 = "<a href='".RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.026.docx' download><img src='".RUTA_IMG_ICONOS."descargar.png'></a>";
$AgrF026 = "<a class='c-pointer' onclick='Modal026(".$id.")'><img src='".RUTA_IMG_ICONOS."subir.png'></a>";

if ($formato026 != "") {
$F026 = "<a target='_BLANK' href='../../".$formato026."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}else{
$F026 = "<img src='".RUTA_IMG_ICONOS."sin-archivo.png'>";	
}

$Tercer = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
}else{

$ArcF026 = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
$AgrF026 = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
$F026 = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";	

$Tercer = "<a class='c-pointer' onclick='ModalTercerA(".$id.")'><img src='".RUTA_IMG_ICONOS."autorizado.png'></a>";	
}


$Grupo = Grupo($id, $con);

if ($Grupo > 0) {
$ImgGrupo = "<img src='".RUTA_IMG_ICONOS."correcto-16.png'>";
}else{
$ImgGrupo = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
}

 
echo "<tr>";
echo "<td class='text-center align-middle'>".$i."</td>";
echo "<td class='text-center align-middle'>".FormatoFecha($fechahora[0])."</td>";
echo "<td class='text-center align-middle'>".$Usuario['nombre']."</td>";
echo "<td class='text-center align-middle'>".$Usuario['puesto']."</td>";
echo "<td class='text-center align-middle'>".$row_inv['descripcion']."</td>";
echo "<td class='text-center align-middle font-weight-bold'>".$row_inv['tipo_evento']."</td>";
echo "<td class='text-center align-middle font-weight-bold'>".$muertes."</td>";

echo "<td class='text-center align-middle font-weight-bold'><a class='c-pointer' onclick='GrupoInterdiciplinario(".$id.")'><img src='".RUTA_IMG_ICONOS."grupo-interdiciplinario.png'></a></td>";

echo "<td class='text-center align-middle'>".$F026."</td>";
echo "<td class='text-center align-middle font-weight-bold'>".$Tercer."</td>";
echo "</tr>";

$i++;
}
}else{
echo "<tr><td colspan='10' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>
</tbody>
</table>
<h5>Sin accidentes a la fecha</h5>
<table class="table table-bordered table-striped table-sm table-hover mt-2">
	<thead>
		<tr>
			<th class="align-middle text-center">#</th>
			<th class="align-middle text-center">Fecha</th>
			<th class="align-middle text-center">Nombre completo</th>
			<th class="align-middle text-center" width="20px"></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	if ($numero_resultado > 0) {
		while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){
		
		$id = $row_resultado['id'];

		$sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$row_resultado['id_usuario']."' ";
		$result_usuario = mysqli_query($con, $sql_usuario);
		while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
		$nomencargado = $row_usuario['nombre'];
		}

		if($row_resultado['estatus'] == 0){
		$TRcolor = 'table-warning';
		}else{
		$TRcolor = '';
		}

$imgPDF = "<a onclick='DescargarIIAN(".$id.")'><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";

		echo "<tr class='".$TRcolor."'>";
		echo "<td class='text-center'>".$row_resultado['id']."</td>";
		echo "<td class='text-center'><b>".FormatoFecha($row_resultado['fecha'])."</b></td>";
		echo "<td class='text-center'>".$nomencargado."</td>";
		echo "<td class='text-center align-middle' width='20px'>".$imgPDF."</td>";
		echo "</tr>";
		
		}
	}else{
	echo "<tr><td colspan='6' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}
	?>
	</tbody>
</table>
<hr>