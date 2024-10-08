<?php
require('../../../../app/help.php');
$fin = date("Y");
?>
  <div class="modal-header">
  <h4 class="modal-title">Buscar</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

	<div class="border p-3">
	<div class="pt-1 pb-1 text-secondary">Equipo o instalación: </div>
	<select class="form-control rounded-0" id="Selectequipo" onchange="BuscarEquipo()">
	<option value="">Selecciona</option>   
	<?php 
	$sql_mantenimiento_lista = "SELECT id, detalle FROM po_mantenimiento_lista ORDER BY num_lista asc";
	$result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
	$numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);
	while($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)){
	$id = $row_mantenimiento_lista['id'];
	?>
	<option value="<?=$id;?>"><?=$row_mantenimiento_lista['detalle'];?></option>
	<?php
	}
	?>
	</select>
	</div>

  	<div class="border p-3 mt-2">

          <div class="mb-1"><small class="text-secondary">Año:</small></div>
          <select class="form-control rounded-0 mb-1" id="selyear" onchange="BuscarYear()">
            <option value="">Selecciona</option>  
            <?php
            $inicio = 2020;
            for ($i=$inicio; $i <= $fin; $i++) {               
              echo "<option value='".$i."'>".$i."</option>";
            }
            ?>
          </select>           

          <div class="mb-1"><small class="text-secondary">Mes:</small></div>
          <div id="SelMes">
          <select class="form-control rounded-0 mb-1" id="selmes" disabled>
            <option value="">Selecciona</option>
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select>
          </div>

          </div>
  </div>

  <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnBuscar()">Buscar</button>
        </div>
