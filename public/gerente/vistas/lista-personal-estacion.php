<?php
require('../../../app/help.php');

if ($Session_EstadoUsuario == 0) {
 echo
 "
 <script type='text/javascript'>
 $('#ConfigAgregarUsuario').modal('show');
 </script>
 ";
}

if($_GET['categoria'] == 1){
$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' and id_puesto <> 1 ";
}else if($_GET['categoria'] == 2){
$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' and id_puesto <> 1 and estatus = 0 ";
}if($_GET['categoria'] == 3){
$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' and id_puesto <> 1 and estatus = 1 ";
}

$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);
?>
<script type="text/javascript">
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});

function EditarUsuario(idusuario){
$('#myModalEditar').modal('show');
$('#DivModal').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 0px;' />");
$('#DivModal').load('public/gerente/vistas/editar-usuario.php?idusuario=' + idusuario);
}

function EliminarUsuario(idusuario){

  var parametros = {
    "IdUsuario" : idusuario
  }
alertify.confirm('',
  function(){

  $.ajax({
   data:  parametros,
   url:   'public/gerente/eliminar/eliminar-usuario.php',
   type:  'post',
   beforeSend: function() {

   },
   complete: function(){
   },
   success:  function (response) {
   ListaPersonal();
   alertify.message('El usuario fue eliminado');
   }
   });


  },
  function(){
  }).setHeader('Eliminar Usuario').set({transition:'zoom',message: 'Desea eliminar el siguiente usuario',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function VerFicha(idUsuario){
window.location.href = "ficha-personal/"+idUsuario;
}

</script>
<?php if ($numero_usuarios > 0) {
?>

<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm" style="font-size: .9em;">
<thead>
<tr>
  <th class="text-center">#</th>
  <th class="text-center">Nombre Usuario</th>
  <th class="text-center">Puesto</th>
  <th class="text-center">Telefono</th>
  <th class="text-center">Email</th>
  <th class="text-center">Usuario</th>
  <th class="text-center">Contraseña</th>
</tr>
</thead>
<tbody>
<?php
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$idusuario = $row_usuarios['id'];
$nombreusuario = $row_usuarios['nombre'];
$telefono = $row_usuarios['telefono'];
$email = $row_usuarios['email'];
$usuario = $row_usuarios['usuario'];
$idpuesto = $row_usuarios['id_puesto'];

if ($row_usuarios['estatus'] == 0) {
$estadoimg = "<img src='".RUTA_IMG_ICONOS."activo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Usuario activo'>";
}else if ($row_usuarios['estatus'] == 1) {
$estadoimg = "<img src='".RUTA_IMG_ICONOS."noactivo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Usuario cancelado'>";
}

$sql_puesto = "SELECT * FROM tb_puestos WHERE id = '$idpuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['tipo_puesto'];
}

echo "<tr>";
echo "<td class='text-center'>".$idusuario."</td>";
echo "<td>".$estadoimg." ".$nombreusuario."</td>";
echo "<td class='text-center'>".$puesto."</td>";
echo "<td class='text-center'>".$telefono."</td>";
echo "<td class='text-center'>".$email."</td>";
echo "<td class='text-center'>".$usuario."</td>";
echo "<td class='text-center'><b>*****</b></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."ojo-black-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Ver ficha del usuario' onclick='VerFicha(".$idusuario.")'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Editar usuario' onclick='EditarUsuario(".$idusuario.")'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Eliminar usuario' onclick='EliminarUsuario(".$idusuario.")'></td>";
echo "</tr>";
}
?>
</tbody>
</table>
</div>
  
<?php }else{
  echo "<div class='text-secondary text-center' >No se encontraron usuarios almacenados en la estación de servicio.</div>";
} ?>

<div class="modal fade bd-example-modal-lg" id="myModalEditar" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div class="modal-header">
      <h5 class="modal-title">Editar Usuario</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div id="DivModal"></div>
  </div>
</div>
</div>
