<?php 
require ('../../../../app/help.php');

  $sql_e_grupo = "SELECT razon_social,puesto,periodo_inicio,periodo_fin FROM tb_usuarios_experiencia_empresa_grupo WHERE id = '".$_GET['id']."' ";
  $result_e_grupo = mysqli_query($con, $sql_e_grupo);
  $numero_e_grupo = mysqli_num_rows($result_e_grupo);
  $row_grupo = mysqli_fetch_array($result_e_grupo, MYSQLI_ASSOC);
    $rs = $row_grupo['razon_social'];
    $pu = $row_grupo['puesto'];
    $pi = $row_grupo['periodo_inicio'];
    $pf = $row_grupo['periodo_fin'];


?>
      <div class="modal-header rounded-0 head-modal">
        <h5 class="modal-title text-white">Editar Experiencia laboral</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      	        <div class="form-group">
        <label class="text-secondary" style="font-size: .9em;">Razón social:</label>
        <input id="EditRazonSocial" type="text" class="form-control" onkeyup="mayus(this)" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar Razón social" value="<?=$rs;?>">
        </div>

        <div class="form-group">
        <label class="text-secondary" style="font-size: .9em;">Puesto:</label>
        <input id="EditPuesto" type="text" class="form-control" value="<?=$pu;?>" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar Puesto">
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group">
            <label class="text-secondary" style="font-size: .9em;">Fecha de inicio</label>
            <input id="EditFechaInicio" type="date" class="form-control" value="<?=$pi;?>" style="border-radius: 0px;font-size: 1em;" >
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
            <label class="text-secondary" style="font-size: .9em;">Fecha de fin:</label>
            <input id="EditFechaFin" type="date" class="form-control" value="<?=$pf;?>" style="border-radius: 0px;font-size: 1em;" >
            </div>
          </div>
        </div>
        <div id="Result"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;border: 0px;" onclick="BtnEditarEE(<?=$_GET['idUsuario'];?>,<?=$_GET['id'];?>)">Editar</button>
      </div>
      
