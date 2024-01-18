<?php 
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];

?>
	
    <div class="modal-body">

	<label class="text-secondary">Dispensario:</label>
	<select class="form-control mb-3" id="Dispensario">
		<option></option>
		<?php 
		$sql = "SELECT id, no_dispensario FROM tb_dispensarios WHERE id_estacion = '".$idEstacion."' ";
		$result = mysqli_query($con, $sql);
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		echo '<option value="'.$row['id'].'">Dispensario '.$row['no_dispensario'].'</option>';
		}
		?>
	</select>


	<label class="text-secondary">Archivo:</label>
	<br>
    <input type="file" name="file" id="file">

    </div>



      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cancelar</button>

        <button type="submit" class="btn btn-primary rounded-0" onclick="Enviar(<?=$idEstacion;?>)">Enviar</button>
      </div>

