<?php
require('../../../app/help.php');

$sql_reportecre = "SELECT * FROM re_reporte_cre_mes WHERE id_estacion = '".$_GET['idEstacion']."' and mes = '".$_GET['idMes']."' and year = '".$_GET['idYear']."' ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
$numero_reportecre = mysqli_num_rows($result_reportecre);
$row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC);

$idReporteCre = $row_reportecre['id'];
$Ffactura_uno = $row_reportecre['f_producto_uno'];
$Ffactura_dos = $row_reportecre['f_producto_dos'];
$Ffactura_tres = $row_reportecre['f_producto_tres'];
$FIfactura_uno = $row_reportecre['fi_producto_uno'];
$FIfactura_dos = $row_reportecre['fi_producto_dos'];
$FIfactura_tres = $row_reportecre['fi_producto_tres'];
$FFfactura_uno = $row_reportecre['ff_producto_uno'];
$FFfactura_dos = $row_reportecre['ff_producto_dos'];
$FFfactura_tres = $row_reportecre['ff_producto_tres'];

$TotalCompra1 = 0;
$TotalVenta1 = 0;
$TotalImportePesos1 = 0;
$TotalCompra2 = 0;
$TotalVenta2 = 0;
$TotalImportePesos2 = 0;
$TotalCompra3 = 0;
$TotalVenta3 = 0;
$TotalImportePesos3 = 0;
?>
<script type="text/javascript">
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});
	function mensaje(idFecha,idrep,nummensajes){

$('#idMensajes').val(idFecha);
$('#nummensajes').val(nummensajes);
$('#myModalMensajes').modal('show');
$('#mensajes').load('../public/gerente/vistas/lista-mensajes-cre.php?idFecha=' + idFecha + "&idReporte=<?=$idReporteCre;?>");
}

function btnEnviar(){

var idMensajes = $('#idMensajes').val();
var nummensajes = $('#nummensajes').val();
var NewMensaje = $('#NewMensaje').val();
var section = document.getElementById('mensajes').innerHTML;
var contenido = "";
var totalMensaje = parseInt(nummensajes) + parseInt(1);

 
if (NewMensaje != "") {
$('#NewMensaje').css('border','');

var parametros = {
    "idUsuario" : <?=$Session_IDUsuarioBD;?>,
		"idReporte" : <?=$idReporteCre;?>,
     "idMensajes" : idMensajes,
     "NewMensaje" : NewMensaje
    };

    $.ajax({
     data:  parametros,
     url:   '../public/gerente/agregar/agregar-mensaje-cre.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

     if (nummensajes == 0) {
     contenido = response;
     }else{
     contenido = response += section;
     }

     $('#mensajes').html(contenido);
     $('#totalMensajes').text(totalMensaje);
     $('#nummensajes').val(totalMensaje);

     $('#NewMensaje').css('border','');
     $('#NewMensaje').val('');

     }
     });

}else{$('#NewMensaje').css('border','2px solid #A52525');}

} 
</script>
<?php
$sql_estaciones = "SELECT nombre, producto_uno, producto_dos, producto_tres FROM tb_estaciones WHERE id = '".$_GET['idEstacion']."' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){
$estacion = $row_estaciones['nombre'];
$ProductoUno  = $row_estaciones['producto_uno'];
$ProductoDos  = $row_estaciones['producto_dos'];
$ProductoTres = $row_estaciones['producto_tres'];
}
?>

<div class="p-3 mb-2 bg-info text-white font-weight-bold">
<?=nombremes($_GET['idMes'])." del ".$_GET['idYear'];?>
</div>
<?php
$sql_reportenum = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporteCre."' ";
$result_reportenum = mysqli_query($con, $sql_reportenum);
$numero_reportenum = mysqli_num_rows($result_reportenum);

if ($numero_reportenum > 0) {
?>
<div class="row no-gutters">


<!---------- PRODUCTO UNO ---------->
<?php if ($ProductoUno != "") { ?>
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2 p-1 text-center bg-success text-white font-weight-bold">
<?=$ProductoUno;?>
<?php if ($Ffactura_uno != "") {
echo "<div class='float-right'><a target='_blank' href='../".$Ffactura_uno."'><img style='padding-top:3px;' src='".RUTA_IMG_ICONOS."archivo-si.png'></a></div>";
}
if ($FIfactura_uno != "") {
echo "<div class='float-right pr-1'><a target='_blank' href='../".$FIfactura_uno."'><img style='padding-top:3px;' src='".RUTA_IMG_ICONOS."archivo-si.png'></a></div>";
}
if ($FFfactura_uno != "") {
echo "<div class='float-right pr-1'><a target='_blank' href='../".$FFfactura_uno."'><img style='padding-top:3px;' src='".RUTA_IMG_ICONOS."archivo-si.png'></a></div>";
} ?>
</div>


<?php } ?>

<!---------- PRODUCTO DOS ---------->
<?php if ($ProductoDos != "") { ?>
<div class="col-xl-4 col-lg-4 col-md-4 mb-2 col-sm-12 p-1 text-center bg-danger text-white font-weight-bold">
<?=$ProductoDos;?>
<?php if ($Ffactura_dos != "") {
echo "<div class='float-right'><a target='_blank' href='../".$Ffactura_dos."'><img style='padding-top:3px;' src='".RUTA_IMG_ICONOS."archivo-si.png'></a></div>";
}
if ($FIfactura_dos != "") {
echo "<div class='float-right pr-1'><a target='_blank' href='../".$FIfactura_dos."'><img style='padding-top:3px;' src='".RUTA_IMG_ICONOS."archivo-si.png'></a></div>";
}
if ($FFfactura_dos != "") {
echo "<div class='float-right pr-1'><a target='_blank' href='../".$FFfactura_dos."'><img style='padding-top:3px;' src='".RUTA_IMG_ICONOS."archivo-si.png'></a></div>";
} ?>
</div>

<?php } ?>


<!---------- PRODUCTO TRES ---------->
<?php if ($ProductoTres != "") { ?>
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2 p-1 text-center bg-dark text-white font-weight-bold">
<?=$ProductoTres;?>
<?php if ($Ffactura_tres != "") {
echo "<div class='float-right'><a target='_blank' href='../".$Ffactura_tres."'><img style='padding-top:3px;' src='".RUTA_IMG_ICONOS."archivo-si.png'></a></div>";
}
if ($FIfactura_tres != "") {
echo "<div class='float-right pr-1'><a target='_blank' href='../".$FIfactura_tres."'><img style='padding-top:3px;' src='".RUTA_IMG_ICONOS."archivo-si.png'></a></div>";
}
if ($FFfactura_tres != "") {
echo "<div class='float-right pr-1'><a target='_blank' href='../".$FFfactura_tres."'><img style='padding-top:3px;' src='".RUTA_IMG_ICONOS."archivo-si.png'></a></div>";
} ?>
</div>


<?php } ?>
</div>

<div class="col-12 mt-1 mb-3" style="overflow-y: hidden;"><div class="col-12 mt-1 mb-3" style="overflow-y: hidden;">



<?php
$sql_reportedia = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporteCre."' GROUP BY fecha ORDER BY fecha desc";
$result_reportedia = mysqli_query($con, $sql_reportedia);
$numero_reportedia = mysqli_num_rows($result_reportedia);
while($row_reportedia = mysqli_fetch_array($result_reportedia, MYSQLI_ASSOC)){
$IDfecha = strtotime($row_reportedia['fecha']);
$fechaFormato = $row_reportedia['fecha'];
$formato_fecha = explode("-",$fechaFormato);



$sql_mensaje = "SELECT * FROM re_reporte_cre_mensajes WHERE id_reporte = '".$idReporteCre."' AND id_fecha = '".$IDfecha."' ";
$result_mensaje = mysqli_query($con, $sql_mensaje);
$numero_mensaje = mysqli_num_rows($result_mensaje);

if ($numero_mensaje == 0) {
$toMensajes = "";
}else{
$toMensajes = $numero_mensaje;
}

?>

<div class="row">

<div class="col-12 mt-1 mb-3" style="overflow-y: hidden;">
<table>
	<tr>
		<td class="align-middle">
			<a onclick="mensaje(<?=$IDfecha;?>,<?=$idReporteCre; ?>,<?=$numero_mensaje;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Mensaje" >
			<div>
			<span class="badge badge-pill badge-primary" id="totalMensajes" style="font-size: .5em;margin-right: -5px;"><?=$toMensajes;?></span>
			<img src="<?php echo RUTA_IMG_ICONOS."mensaje-black-16.png"; ?>">
			</div>
			</a>
		</td>
		<td style="padding-left: 10px;">
		<?php echo "<label class='font-weight-bold text-secondary' style='margin-top: 5px;font-size: 1.1em;'>Día ".$formato_fecha[2]."</label>"; ?>
  </td>
  </tr>
</table>

</div>
</div>



<div class="row no-gutters">


<!---------- PRODUCTO UNO (CARD) ---------->
<?php if ($ProductoUno != "") { ?>

<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-3" style="border: 1px solid #E0E0E0;border-bottom: 2px solid #0FC332;">
<div class="p-2">

<div style="overflow-y: hidden;">
  <table class="table table-bordered table-striped table-sm" style="font-size: .9em;">
  <thead>
    <tr>
      <th class="text-center align-middle">Vo. (Lt) inicial</th>
      <th class="text-center align-middle">Vo. (Lt) venta</th>
      <th class="text-center align-middle">Vo. (Lt) final</th>
      <th class="text-center align-middle">Merma</th>
    </tr>
  </thead>

  <tbody>
<?php
$sql_reportepro1 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporteCre."' and fecha = '".$fechaFormato."' and producto = '".$ProductoUno."' ";
$result_reportepro1 = mysqli_query($con, $sql_reportepro1);
$numero_reportepro1 = mysqli_num_rows($result_reportepro1);
while($row_reportepro1 = mysqli_fetch_array($result_reportepro1, MYSQLI_ASSOC)){
$idPro1 = $row_reportepro1['id'];
$volumen_venta1 = $row_reportepro1['volumen_venta'];
echo "<td class='text-center align-middle'>".$row_reportepro1['volumen_inicial']."</td>";
echo "<td class='text-center align-middle'>".$row_reportepro1['volumen_venta']."</td>";
echo "<td class='text-center align-middle'>".$row_reportepro1['volumen_final']."</td>";

$sql_pipas1 = "SELECT sum(volumen) AS sumVolumen FROM re_reporte_cre_pipas WHERE id_re_producto = '".$idPro1."'  ";
$result_pipas1 = mysqli_query($con, $sql_pipas1);
$numero_pipas1 = mysqli_num_rows($result_pipas1);

while($row_pipas1 = mysqli_fetch_array($result_pipas1, MYSQLI_ASSOC)){
$tovolpro1 = $row_pipas1['sumVolumen'];
}

$mermapr1 = ($row_reportepro1['volumen_final'] + $row_reportepro1['volumen_venta']) - ($row_reportepro1['volumen_inicial'] + $tovolpro1);

echo "<td class='text-center text-danger align-middle'><b>".round($mermapr1)."</b></td>";
}

?>
  </tbody>
</table>
</div>



<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="font-size: .9em;">
	<thead>
		<th class="text-center align-middle">Pipa</th>
		<th class="text-center align-middle">Volumen</th>
		<th class="text-center align-middle">Precio Litro</th>
		<th class="text-center align-middle">Costo flete</th>
		<th class="text-center align-middle"><small>Nombre o Razón Social</small></th>
	</thead>
	<tbody>
		<?php
		$TotalVolumen1 = 0;
		$TotalPesos1 = 0;

		$sql_pipas1 = "SELECT * FROM re_reporte_cre_pipas WHERE id_re_producto = '".$idPro1."'  ";
		$result_pipas1 = mysqli_query($con, $sql_pipas1);
		$numero_pipas1 = mysqli_num_rows($result_pipas1);
		while($row_pipas1 = mysqli_fetch_array($result_pipas1, MYSQLI_ASSOC)){
		
		echo "<tr>";
		echo "<td class='text-center align-middle'>".$row_pipas1['pipa_numero']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas1['volumen']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas1['precio_litro']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas1['costo_flete']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas1['nombre_razonsocial']."</td>";
		echo "</tr>";

		$VolumenXPrecioLitro1 = $row_pipas1['volumen'] * $row_pipas1['precio_litro'];


	    $TotalVolumen1 = $TotalVolumen1 + $row_pipas1['volumen'];
	    $TotalPesos1 = $TotalPesos1 + $VolumenXPrecioLitro1;


		}
		?>
	</tbody>

<tr>
<td class="text-center align-middle font-weight-bold">Total</td>
<td class="text-center align-middle font-weight-bold"><?=$TotalVolumen1;?></td>
<td class="text-center align-middle font-weight-bold"><?=number_format($TotalPesos1,2);?></td>
<td colspan="2"></td>
</tr>
</table>
</div>

</div>
</div>
<?php  
$TotalCompra1 = $TotalCompra1 + $TotalVolumen1; 
$TotalVenta1 = $TotalVenta1 + $volumen_venta1; 
$TotalImportePesos1 = $TotalImportePesos1 + $TotalPesos1;
} ?>


<!---------- PRODUCTO DOS (CARD) ---------->
<?php if ($ProductoDos != "") { ?>
<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-3" style="border: 1px solid #E0E0E0;border-bottom: 2px solid #C30F0F;">
<div class="p-2">

<div class="mb-2" style="overflow-y: hidden;">
  <table class="table table-bordered table-striped table-sm" style="font-size: .9em;">
  <thead>
    <tr>
      <th class="text-center align-middle">Vo. (Lt) inicial</th>
      <th class="text-center align-middle">Vo. (Lt) venta</th>
      <th class="text-center align-middle">Vo. (Lt) final</th>
      <th class="text-center align-middle">Merma</th>
    </tr>
  </thead>
  <tbody>
<?php
$sql_reportepro2 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporteCre."' and fecha = '".$fechaFormato."' and producto = '".$ProductoDos."' ";
$result_reportepro2 = mysqli_query($con, $sql_reportepro2);
$numero_reportepro2 = mysqli_num_rows($result_reportepro2);
while($row_reportepro2 = mysqli_fetch_array($result_reportepro2, MYSQLI_ASSOC)){
$idPro2 = $row_reportepro2['id'];
$volumen_venta2 = $row_reportepro2['volumen_venta'];
echo "<td class='text-center align-middle'>".$row_reportepro2['volumen_inicial']."</td>";
echo "<td class='text-center align-middle'>".$row_reportepro2['volumen_venta']."</td>";
echo "<td class='text-center align-middle'>".$row_reportepro2['volumen_final']."</td>";

$sql_pipas2 = "SELECT sum(volumen) AS sumVolumen FROM re_reporte_cre_pipas WHERE id_re_producto = '".$idPro2."'  ";
$result_pipas2 = mysqli_query($con, $sql_pipas2);
$numero_pipas2 = mysqli_num_rows($result_pipas2);

while($row_pipas2 = mysqli_fetch_array($result_pipas2, MYSQLI_ASSOC)){
$tovolpro2 = $row_pipas2['sumVolumen'];
}
$mermapr2 = ($row_reportepro2['volumen_final'] + $row_reportepro2['volumen_venta']) - ($row_reportepro2['volumen_inicial'] + $tovolpro2);
echo "<td class='text-center text-danger align-middle'><b>".round($mermapr2)."</b></td>";
}

?>
	</tbody>
</table>
</div>


<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="font-size: .9em;">
	<thead>
		<th class="text-center align-middle">Pipa</th>
		<th class="text-center align-middle">Volumen</th>
		<th class="text-center align-middle">Precio Litro</th>
		<th class="text-center align-middle">Costo flete</th>
		<th class="text-center align-middle"><small>Nombre o Razón Social</small></th>
	</thead>
	<tbody>
		<?php
		$TotalVolumen2 = 0;
		$TotalPesos2 = 0;
		$sql_pipas2 = "SELECT * FROM re_reporte_cre_pipas WHERE id_re_producto = '".$idPro2."'  ";
		$result_pipas2 = mysqli_query($con, $sql_pipas2);
		$numero_pipas2 = mysqli_num_rows($result_pipas2);
		while($row_pipas2 = mysqli_fetch_array($result_pipas2, MYSQLI_ASSOC)){
		echo "<tr>";
		echo "<td class='text-center align-middle'>".$row_pipas2['pipa_numero']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas2['volumen']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas2['precio_litro']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas2['costo_flete']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas2['nombre_razonsocial']."</td>";
		echo "</tr>";

			$TotalVolumen2 = $TotalVolumen2 + $row_pipas2['volumen'];

			$VolumenXPrecioLitro2 = $row_pipas2['volumen'] * $row_pipas2['precio_litro'];
 			$TotalPesos2 = $TotalPesos2 + $VolumenXPrecioLitro2;

		}
		?>
	</tbody>

<tr>
		<td class="text-center align-middle font-weight-bold">Total</td>
		<td class="text-center align-middle font-weight-bold"><?=$TotalVolumen2;?></td>
		<td class="text-center align-middle font-weight-bold"><?=number_format($TotalPesos2,2);?></td>
		<td colspan="2"></td>
	</tr>
</table>
</div>

</div>
</div>
<?php 
$TotalCompra2 = $TotalCompra2 + $TotalVolumen2; 
$TotalVenta2 = $TotalVenta2 + $volumen_venta2; 
$TotalImportePesos2 = $TotalImportePesos2 + $TotalPesos2;
} ?>
<?php if ($ProductoTres != "") { ?>
<div class="col-4" style="border: 1px solid #E0E0E0;border-bottom: 2px solid #1F1F1F;">
<div class="p-2">

<div class="mb-2" style="overflow-y: hidden;">
	<table class="table table-bordered table-striped table-sm" style="font-size: .9em;">
	<thead>
		<tr>
			<th class="text-center align-middle">Vo. (Lt) inicial</th>
			<th class="text-center align-middle">Vo. (Lt) venta</th>
			<th class="text-center align-middle">Vo. (Lt) final</th>
			<th class="text-center align-middle">Merma</th>
		</tr>
	</thead>
	<tbody>
<?php
$sql_reportepro3 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporteCre."' and fecha = '".$fechaFormato."' and producto = '".$ProductoTres."' ";
$result_reportepro3 = mysqli_query($con, $sql_reportepro3);
$numero_reportepro3 = mysqli_num_rows($result_reportepro3);
while($row_reportepro3 = mysqli_fetch_array($result_reportepro3, MYSQLI_ASSOC)){
$idPro3 = $row_reportepro3['id'];
$volumen_venta3 = $row_reportepro3['volumen_venta'];
echo "<td class='text-center align-middle'>".$row_reportepro3['volumen_inicial']."</td>";
echo "<td class='text-center align-middle'>".$row_reportepro3['volumen_venta']."</td>";
echo "<td class='text-center align-middle'>".$row_reportepro3['volumen_final']."</td>";

$sql_pipas3 = "SELECT sum(volumen) AS sumVolumen FROM re_reporte_cre_pipas WHERE id_re_producto = '".$idPro3."'  ";
$result_pipas3 = mysqli_query($con, $sql_pipas3);
$numero_pipas3 = mysqli_num_rows($result_pipas3);

while($row_pipas3 = mysqli_fetch_array($result_pipas3, MYSQLI_ASSOC)){
$tovolpro3 = $row_pipas3['sumVolumen'];
}
$mermapr3 = ($row_reportepro3['volumen_final'] + $row_reportepro3['volumen_venta']) - ($row_reportepro3['volumen_inicial'] + $tovolpro3);
echo "<td class='text-center text-danger align-middle'><b>".round($mermapr3)."</b></td>";
}

?>
	</tbody>
</table>
</div>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="font-size: .9em;">
	<thead>
		<th class="text-center align-middle">Pipa</th>
		<th class="text-center align-middle">Volumen</th>
		<th class="text-center align-middle">Precio Litro</th>
		<th class="text-center align-middle">Costo flete</th>
		<th class="text-center align-middle"><small>Nombre o Razón Social</small></th>
	</thead>
	<tbody>
		<?php
		$TotalVolumen3 = 0;
		$TotalPesos3 = 0;
		$sql_pipas3 = "SELECT * FROM re_reporte_cre_pipas WHERE id_re_producto = '".$idPro3."'  ";
		$result_pipas3 = mysqli_query($con, $sql_pipas3);
		$numero_pipas3 = mysqli_num_rows($result_pipas3);
		while($row_pipas3 = mysqli_fetch_array($result_pipas3, MYSQLI_ASSOC)){
		echo "<tr>";
		echo "<td class='text-center align-middle'>".$row_pipas3['pipa_numero']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas3['volumen']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas3['precio_litro']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas3['costo_flete']."</td>";
		echo "<td class='text-center align-middle'>".$row_pipas3['nombre_razonsocial']."</td>";
		echo "</tr>";

		$TotalVolumen3 = $TotalVolumen3 + $row_pipas3['volumen'];
		
		$VolumenXPrecioLitro3 = $row_pipas3['volumen'] * $row_pipas3['precio_litro'];
 		$TotalPesos3 = $TotalPesos3 + $VolumenXPrecioLitro3;


		}
		?>
		<tr>
			<td class="text-center align-middle font-weight-bold">Total</td>
			<td class="text-center align-middle font-weight-bold"><?=$TotalVolumen3;?></td>
			<td class="text-center font-weight-bold"><?=number_format($TotalPesos3,2);?></td>
			<td colspan="2"></td>
		</tr>
	</tbody>
</table>
</div>

</div>
</div>

<?php  
$TotalCompra3 = $TotalCompra3 + $TotalVolumen3; 
$TotalVenta3 = $TotalVenta3 + $volumen_venta3; 
$TotalImportePesos3 = $TotalImportePesos3 + $TotalPesos3;
} ?>
</div>

<hr>
<?php } 

echo "<div class='row p-3'>";

if ($ProductoUno != "") {

echo "<div class='col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-3' style='border: 1px solid #E0E0E0;border-bottom: 2px solid #0FC332;'>";
echo "<div class='p-2'><b>Total venta: ".number_format($TotalVenta1,2)."</b></div>";
echo "<div class='p-2'><b>Total compra: ".number_format($TotalCompra1)."</b></div>";
echo "<div class='p-2'><b>Total importe: $".number_format($TotalImportePesos1,2)."</b></div>";
echo "</div>";
}

if ($ProductoDos != "") {

echo "<div class='col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-3' style='border: 1px solid #E0E0E0;border-bottom: 2px solid #C30F0F;'>";
echo "<div class='p-2'><b>Total venta: ".number_format($TotalVenta2,2)."</b></div>";
echo "<div class='p-2'><b>Total compra: ".number_format($TotalCompra2)."</b></div>";
echo "<div class='p-2'><b>Total importe: $".number_format($TotalImportePesos2,2)."</b></div>";
echo "</div>";
}

if ($ProductoTres != "") {

echo "<div class='col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-3' style='border: 1px solid #E0E0E0;border-bottom: 2px solid #1F1F1F;'>";
echo "<div class='p-2'><b>Total venta: ".number_format($TotalVenta3,2)."</b></div>";
echo "<div class='p-2'><b>Total compra: ".number_format($TotalCompra3)."</b></div>";
echo "<div class='p-2'><b>Total importe: $".number_format($TotalImportePesos3,2)."</b></div>";
echo "</div>";
}

echo "</div>";

}else{
  echo "<div class='text-secondary text-center'style='font-size: .9em'>No se encontraron reportes</div>";
}
?>

<div class="modal fade" id="myModalMensajes" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <div class="modal-body">

        	<div id="mensajes" style="height: 300px;overflow: auto;border: 1px solid #EBEBEB;padding: 5px;">
        	</div>

          <div>
       	  <input type="hidden" id="idMensajes" >
       	  <input type="hidden" id="nummensajes">
       	  <textarea class="form-control" id="NewMensaje" style="border-radius: 0px;width: 100%;margin-bottom: 2px;" rows="3" placeholder="Mensaje..."></textarea>
          <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;width: 100%;" onclick="btnEnviar()">Enviar</button>
        </div>

        </div>

      </div>
    </div>
    </div>
