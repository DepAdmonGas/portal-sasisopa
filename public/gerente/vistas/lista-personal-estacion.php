<?php
require('../../../app/help.php');


if ($_GET['categoria'] == 1) {
  $sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '" . $Session_IDEstacion . "' and id_puesto <> 1 ";
} else if ($_GET['categoria'] == 2) {
  $sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '" . $Session_IDEstacion . "' and id_puesto <> 1 and estatus = 0 ";
}
if ($_GET['categoria'] == 3) {
  $sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '" . $Session_IDEstacion . "' and id_puesto <> 1 and estatus = 1 ";
}
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });

  function EditarUsuario(idusuario) {
    $('#myModalEditar').modal('show');
    $('#DivModal').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 0px;' />");
    $('#DivModal').load('public/gerente/vistas/editar-usuario.php?idusuario=' + idusuario);
  }

  function EliminarUsuario(idusuario) {

    var parametros = {
      "IdUsuario": idusuario
    }
    alertify.confirm('',
      function() {

        $.ajax({
          data: parametros,
          url: 'public/gerente/eliminar/eliminar-usuario.php',
          type: 'post',
          beforeSend: function() {

          },
          complete: function() {},
          success: function(response) {
            ListaPersonal(2);
            alertify.message('El usuario fue eliminado');
          }
        });

      },
      function() {}).setHeader('Eliminar Usuario').set({
      transition: 'zoom',
      message: 'Desea eliminar el siguiente usuario',
      labels: {
        ok: 'Aceptar',
        cancel: 'Cancelar'
      }
    }).show();

  }

  function VerFicha(idUsuario) {
    window.location.href = "ficha-personal/" + idUsuario;
  }
</script>
<?php if ($numero_usuarios > 0) {
?>

  <div style="overflow-y: hidden;">
    <table id="table_personal" class="table table-bordered table-striped table-hover table-sm" style="font-size: .9em;">
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Nombre Usuario</th>
          <th class="text-center">Puesto</th>
          <th class="text-center">Telefono</th>
          <th class="text-center">Email</th>
          <th class="text-center">Usuario</th>
          <th class="text-center">Contraseña</th>
          <th class="align-middle text-center" width="20"><i class="fas fa-ellipsis-v"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)) {
          $idusuario = $row_usuarios['id'];
          $nombreusuario = $row_usuarios['nombre'];
          $telefono = $row_usuarios['telefono'];
          $email = $row_usuarios['email'];
          $usuario = $row_usuarios['usuario'];
          $idpuesto = $row_usuarios['id_puesto'];

          if ($row_usuarios['estatus'] == 0) {
            $estadoimg = "<img src='" . RUTA_IMG_ICONOS . "activo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Usuario activo'>";
          } else if ($row_usuarios['estatus'] == 1) {
            $estadoimg = "<img src='" . RUTA_IMG_ICONOS . "noactivo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Usuario cancelado'>";
          }

          $sql_puesto = "SELECT * FROM tb_puestos WHERE id = '$idpuesto' ";
          $result_puesto = mysqli_query($con, $sql_puesto);
          $numero_puesto = mysqli_num_rows($result_puesto);
          while ($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)) {
            $puesto = $row_puesto['tipo_puesto'];
          }
          $Detalle = '<a class="dropdown-item" onclick="VerFicha(' . $idusuario . ')"><i class="fa-regular fa-eye"></i> Detalle</a>';
          $Editar = '<a class="dropdown-item" onclick="EditarUsuario(' . $idusuario . ')"><i class="fa-solid fa-pencil"></i> Editar</a>';
          $Eliminar = '<a class="dropdown-item" onclick="EliminarUsuario(' . $idusuario . ')"><i class="fa-regular fa-trash-can"></i> Eliminar</a>';
          echo "<tr>";
          echo "<td class='text-center'>" . $idusuario . "</td>";
          echo "<td>" . $estadoimg . " " . $nombreusuario . "</td>";
          echo "<td class='text-center'>" . $puesto . "</td>";
          echo "<td class='text-center'>" . $telefono . "</td>";
          echo "<td class='text-center'>" . $email . "</td>";
          echo "<td class='text-center'>" . $usuario . "</td>";
          echo "<td class='text-center'><b>*****</b></td>";
          echo '<td class="align-middle text-center"> 
          <div class="dropdown">
            <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
              ' . $Detalle . '
              ' . $Editar . '
              ' . $Eliminar . '
            </div>
          </div>
        </td>';
        echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

<?php } else {
  echo "<div class='text-secondary text-center' >No se encontraron usuarios almacenados en la estación de servicio.</div>";
} ?>

<div class="modal fade bd-example-modal-lg" id="myModalEditar">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div class="modal-header rounded-0 head-modal">
        <h4 class="modal-title text-white">Editar Usuario</h4>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="DivModal"></div>
    </div>
  </div>
</div>