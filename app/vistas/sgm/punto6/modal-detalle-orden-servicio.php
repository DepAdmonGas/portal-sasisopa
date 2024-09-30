<?php
require('../../../../app/help.php');

$idRegistro = $_GET['idRegistro'];

$sql = "SELECT * FROM sgm_orden_servicio WHERE id = '".$idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$fecha = $row['fecha'];
$hora = $row['hora'];

$descripcion = $row['descripcion'];
$justificacion = $row['justificacion'];
$id_estacion = $row['id_estacion'];
$id_solicitante = $row['id_solicitante'];

$solicitante = usuario($id_solicitante,$con);

function usuario($usuario,$con){
  $sql = "SELECT tb_usuarios.nombre,
tb_puestos.tipo_puesto
FROM tb_usuarios
INNER JOIN tb_puestos
ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$usuario."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $Nombre = $row['nombre'];
  $puesto = $row['tipo_puesto'];

  $array = array('nombre' => $Nombre, 'puesto' => $puesto);
  return $array;
  }
 
?>
     <div class="modal-header">
       <h4 class="modal-title">Orden de servicio</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">


    <table class="table mt-3" style="width: 100%;">
         <tr>
            <td><b>Fecha:</b> </td>
            <td><?=FormatoFecha($fecha);?></td>
        </tr>

        <tr>
            <td><b>Hora: </b> </td>
            <td><?=$hora;?></td>
        </tr>
        <tr>
            <td><b>Nombre del solicitante:</b> </td>
            <td><?=$solicitante['nombre'];?></td>
        </tr>

        <tr>
            <td><b>Puesto:</b> </td>
            <td><?=$solicitante['puesto'];?></td>
        </tr>

        <tr>
            <td><b>Razón Social:</b> </td>
            <td><?=$Session_Razonsocial;?></td>
        </tr>

        <tr>
            <td><b>RFC:</b> </td>
            <td><?=$Session_RFC;?></td>
        </tr>

        <tr>
            <td class="align-middle"><b>Dirección:</b> </td>
            <td><?=$Session_Direccion;?></td>
        </tr>
    </table>

    <div class="mt-3 mb-2"><b>Descripción detallada del servicio equipo que requiere:</b></div>
    <div class="border p-3"><?=$descripcion;?></div>
    
    <div class="mt-2 mb-2"><b>Justificación del servicio que requiere:</b></div>
    <div class="border p-3"><?=$justificacion;?></div>

    </div>
