<?php
require('../../../../app/help.php');
 
$idEquipo = $_GET['idEquipo'];

$sql = "SELECT * FROM sgm_inventario_equipo WHERE id = '".$idEquipo."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$nombre = $row['nombre'];
$identificacion = $row['identificacion'];
$funcion = $row['funcion'];
$fecha = $row['fecha_instalacion'];

if($nombre == 'Tanques de almacenamiento' || $nombre == 'Sondas de nivel y temperatura' || $nombre == 'Dispensarios'){
$disabled = 'disabled';
}else{
$disabled = '';
}
?>
     <div class="modal-header">
       <h4 class="modal-title">Inventario de equipo</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">

    <b>Nombre del equipo de medición:</b>
    <select class="form-control" onchange="EditarEquipo(this,<?=$idEquipo;?>,1)">
    	<option value="<?=$nombre;?>"><?=$nombre;?></option>
    	<option value="Tanques de almacenamiento">Tanques de almacenamiento</option>
    	<option>Sondas de nivel y temperatura</option>
    	<option>Dispensarios</option>
    	<option>Jarras patrón</option>
    	<option>Sistema de control de inventarios</option>
    	<option>Cinta petrolera</option>
    	<option>Termómetro</option>
    	<option>Cronómetros</option>
    </select>

    <b>Identificación:</b>
    <textarea class="form-control" onkeyup="EditarEquipo(this,<?=$idEquipo;?>,2)" <?=$disabled;?> ><?=$identificacion;?></textarea>

    <b>Función que desempeña dentro de la ES:</b>
    <textarea class="form-control rounded-0 mt-2 mb-2" onkeyup="EditarEquipo(this,<?=$idEquipo;?>,3)"><?=$funcion;?></textarea>

    <b>Fecha de instalación:</b>
    <input type="date" class="form-control rounded-0 mt-2 mb-2" onchange="EditarEquipo(this,<?=$idEquipo;?>,4)" value="<?=$fecha;?>">

    <b>Manuales, garantías  o información documental del equipo:</b>

    <div class="mt-2">
    	<div class="row">
    		<div class="col-9"><input type="file" id="Manual"></div>
    		<div class="col-3 text-right"><button type="button" class="btn btn-info btn-sm rounded-0" onclick="AgregarManual(<?=$idEquipo;?>)">Agregar manual</button></div>
    	</div>
    	
    </div>

    <table class="table table-sm table-bordered mt-2" style="font-size: .8em;">
    	<thead>
    		<tr>
    			<th>#</th>
    			<th>Fecha</th>
    			<th>Archivo</th>
    		</tr>
    	</thead>
    	<tbody>
 		<?php 

 		$sql_manual = "SELECT * FROM sgm_inventario_equipo_manual WHERE id_equipo = '".$idEquipo."' ";
		$result_manual = mysqli_query($con, $sql_manual);
		$numero_manual = mysqli_num_rows($result_manual);
		$num = 1;
		if ($numero_manual > 0) {
		while($row_manual = mysqli_fetch_array($result_manual, MYSQLI_ASSOC)){

		echo '<tr>
		<td>'.$num.'</td>
		<td>'.$row_manual['fecha_hora'].'</td>
		<td><a target="_blank" href="'.RUTA_ARCHIVOS.'manuales/'.$row_manual['archivo'].'">'.$row_manual['archivo'].'</a></td>
		</tr>';
		$num++;
		}
		}else{
		echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
		}

 		?>
    	</tbody>
    </table>
    



    </div>
    <div class="modal-footer">
	<button type="button" class="btn btn-primary rounded-0" onclick="Finalizar(<?=$idEquipo;?>)">Finalizar</button>
	</div>

     	 	 	 	 
