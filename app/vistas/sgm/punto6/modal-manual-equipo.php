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
?>
     <div class="modal-header">
       <h4 class="modal-title">Manuales, garantías  o información documental del equipo</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">

    <small>Nombre del equipo de medición: </small><b><?=$nombre;?></b>
    <div><small>Identificación: </small><b><?=$identificacion;?></b></div>

    <table class="table table-sm table-bordered mt-2">
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
  	 	 	 	 
