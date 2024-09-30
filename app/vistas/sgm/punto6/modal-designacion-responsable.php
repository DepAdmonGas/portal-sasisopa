<?php
require('../../../../app/help.php');



      function usuarios($id_estacion,$con){
      $contenido = '';
      $sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$id_estacion."' and estatus = 0 ";
      $result_usuarios = mysqli_query($con, $sql_usuarios);
      $numero_usuarios = mysqli_num_rows($result_usuarios);
      while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
      $idusuario = $row_usuarios['id'];
      $nombreusuario = $row_usuarios['nombre'];

      $contenido .= '<option value="'.$idusuario.'">'.$nombreusuario.'</option>';

  	  }

  	  return $contenido;
      }
?>
        <div class="modal-header">
          <h4 class="modal-title">Fo.SGM.007 Designación de responsable SGM</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        	<h5>Fecha:</h5>
        	<input class="form-control" type="date" id="Fecha">

        	<h5 class="mt-3">Nombre y firma de conformidad del responsable de implementacion del Sistema de Gestión de Medición</h5>
        	<select class="form-control" id="UsuarioRISGM">
        		<option value=""></option>
        		<?php         		
        		echo usuarios($Session_IDEstacion,$con);
        		?>
        	</select>

        	<h5 class="mt-3">Personal especializado que auxiliará en las tareas de implementacion del Sistema de Gestión de Medición</h5>
        	<select class="form-control" id="UsuarioAISGM">
        		<option value=""></option>
        		<?php 
        		echo usuarios($Session_IDEstacion,$con);
        		?>
        	</select>

        </div>
        <div class="modal-footer">
		<button type="button" class="btn btn-primary rounded-0" onclick="GuardarResponsable()">Guardar</button>
		</div>