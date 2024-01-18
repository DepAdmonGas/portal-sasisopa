<?php
require('../../../app/help.php');

$idReporte = $_GET['idReporte'];
$array = array();

$sql_comunicado = "SELECT * FROM se_comunicacion_i_e WHERE id = '".$idReporte."' ";
$result_comunicado = mysqli_query($con, $sql_comunicado);
$numero_comunicado = mysqli_num_rows($result_comunicado);

while($row_comunicado = mysqli_fetch_array($result_comunicado, MYSQLI_ASSOC)){

$sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$row_comunicado['encargado_comunicacion']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre'];
}

$Fecha = $row_comunicado['fecha'];
$Tema = $row_comunicado['tema'];
$Detalle = $row_comunicado['detalle'];
$TipoComunicacion = $row_comunicado['tipo_comunicacion']; 
$Material = $row_comunicado['material'];
$Seguimiento = $row_comunicado['seguimiento'];
$dirigidoa = $row_comunicado['dirigidoa'];
 
$Explode = explode(',', $row_comunicado['dirigidoa']);

for ($i=0; $i < count($Explode); $i++) {
array_push($array, $Explode[$i]);
}

}

?>
<script type="text/javascript">
  $('#Editdirigidoa').selectpicker('refresh');
</script>
<div class="modal-header">
<h4 class="modal-title">Editar registro de la atención y el seguimiento a la comunicación interna y externa.
</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

 <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Fecha:</label>
         <input type="date" class="form-control" id="Editfecha" value="<?=$Fecha;?>" style="border-radius: 0px;" placeholder="Agregar fecha">
         </div>

 <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Tema a comunicar:</label>
         <input type="text" class="form-control" value="<?=$Tema;?>" id="Edittemacomunicar" style="border-radius: 0px;" placeholder="Agregar tema a comunicar">
         </div>

         <div class="form-group">
         <label for="detalle" class="text-secondary">Detalle:</label>
         <textarea class="form-control" id="Editdetalle" placeholder="Agregar Detalle" rows="6" style="border-radius: 0px;"><?=$Detalle;?></textarea>
         </div>

          <div class="form-group">
          <label for="tipocomunicacion" class="text-secondary">Tipo de comunicación: </label>
          <select class="form-control" id="Edittipocomunicacion" onchange="tipoCom(this)" style="border-radius: 0px;">
            <option value="<?=$TipoComunicacion;?>"><?=$TipoComunicacion;?></option>
            <option value="Interna">Interna</option>
            <option value="Externa">Externa</option>
          </select>
        </div>

          <div class="form-group">
          <label for="materialcomunicar" class="text-secondary">Material utilizado para la comunicación: </label>
          <select class="form-control" id="Editmaterialcomunicar" style="border-radius: 0px;">
            <option value="<?=$Material;?>"><?=$Material;?></option>
            <option value="Correo electrónico">Correo electrónico</option>
            <option value="Vía telefónica">Vía telefónica</option>
            <option value="Minutas y actas de reuniones">Minutas y actas de reuniones</option>
            <option value="Tableros, carteles, trípticos">Tableros, carteles, trípticos</option>
            <option value="Portal AdmonGas">Portal AdmonGas</option>
          </select>
        </div>

         <div class="row">
      
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-2"> 
      <label for="dirigidoa" class="text-secondary">Dirigido a: </label>
      <div id="borderdirigidoa" style="border: 1px solid #DFDFDF;">
      <select class="selectpicker" id="Editdirigidoa" multiple title="Selecciona" data-width="100%">
      <?php
          $sql_puesto = "SELECT * FROM tb_puestos WHERE estatus = 0";
          $result_puesto = mysqli_query($con, $sql_puesto);
          $numero_puesto = mysqli_num_rows($result_puesto);
          while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){

            if(in_array($row_puesto['id'], $array)){
            $selected = 'selected';
            }else{
            $selected = '';
            }

          echo "<option value='".$row_puesto['id']."' $selected>".$row_puesto['tipo_puesto']."</option>";
          }
        ?>
      </select>
      </div>
      </div>
      
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-2"> 
           <label for="seguimientocomunicacion" class="text-secondary" >Seguimiento de la comunicación:</label>
            <select class="form-control" id="Editseguimientocomunicacion" style="border-radius: 0px;border: 1px solid #DFDFDF;background: #FAFAFA;font-size: 1em;color: #C7C7C7;">
            <option value="<?=$Seguimiento;?>"><?=$Seguimiento;?></option>
            <option value="Correo electrónico">Correo electrónico</option>
            <option value="Vía telefónica">Vía telefónica</option>
          </select>
          </div>
         </div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnEditar(<?=$idReporte;?>)">Editar</button>
</div>