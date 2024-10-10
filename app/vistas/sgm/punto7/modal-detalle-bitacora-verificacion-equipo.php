<?php
require('../../../../app/help.php');
 
$GET_idRegistro = $_GET['id'];

function contenidoTabla($id_programa,$cate,$con){
$contenido = '';
$sql = "SELECT
sgm_bitacora_verificacion_resultado.id,
sgm_bitacora_verificacion_resultado.id_lista,
sgm_bitacora_verificacion_resultado.resultado,
sgm_bitacora_verificacion_lista.pregunta
FROM sgm_bitacora_verificacion_resultado 
INNER JOIN sgm_bitacora_verificacion_lista 
ON sgm_bitacora_verificacion_resultado.id_lista = sgm_bitacora_verificacion_lista.id WHERE sgm_bitacora_verificacion_resultado.id_programa = '".$id_programa."' AND sgm_bitacora_verificacion_lista.categoria = '".$cate."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);


$contenido .= '<tbody>';
$contenido .= '<tr class="bg-secondary text-white">
<td class="align-middle"><b>'.$cate.'</b></td> 
<td class="align-middle text-center"><b>Resultado</b></td></tr>';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$contenido .= '<tr>
<td class="align-middle">'.$row['pregunta'].'</td>
<td class="align-middle" >'.$row['resultado'].'</td>
</tr>';
}
$contenido .= '</tbody>';

return $contenido;
}

$sql_bitacora = "SELECT * FROM sgm_bitacora_verificacion_sensores WHERE id_programa = '".$GET_idRegistro."' ";
$result_bitacora = mysqli_query($con, $sql_bitacora);
$numero_bitacora = mysqli_num_rows($result_bitacora);
$row_bitacora = mysqli_fetch_array($result_bitacora, MYSQLI_ASSOC);
  
  $id = $row_bitacora['id'];
  $fecha = $row_bitacora['fecha'];

  $fecha = ($row_bitacora['fecha'] == '0000-00-00') ? FormatoFecha($fecha) : 'S/I';

  $hora = $row_bitacora['hora'];
  $no_tanque = $row_bitacora['no_tanque'];
  $marca = $row_bitacora['marca'];
  $capacidad = $row_bitacora['capacidad'];
  $producto = $row_bitacora['producto'];
  $interno_externo = $row_bitacora['interno_externo'];
  $verificacion_movimiento = $row_bitacora['verificacion_movimiento'];
  $metodo_nivel = $row_bitacora['metodo_nivel'];
  $realizadopor = $row_bitacora['realizadopor'];
?>
     <div class="modal-header rounded-0 head-modal">
       <h4 class="modal-title text-white">Bitácora para la verificación de equipos de medicion</h4>
       <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">


      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td class="align-middle"><b>Fecha:</b></td>
            <td class="align-middle"><?=$fecha;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Hora:</b></td>
            <td class="align-middle"><?=$hora;?></td>
          </tr>
          <tr class="bg-secondary text-white">
            <td><b>Verificacion de sensores de nivel y temperatura</b></td>
            <td><b>Resultado</b></td>
          </tr>
          <tr>
            <td class="align-middle"><b>No de tanque:</b></td>
            <td class="align-middle"><?=$no_tanque;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Marca:</b></td>
            <td class="align-middle"><?=$marca;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Capacidad:</b></td>
            <td class="align-middle"><?=$capacidad;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Producto que almacena:</b></td>
            <td class="align-middle"><?=$producto;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>La verificación es realizada por personal Interno o Externo, ( en caso de ser externo colocar nombre de la empresa y datos relevantes):</b></td>
          <td class="align-middle">
              <?=$interno_externo;?>
          </tr>
          <tr>
            <td class="align-middle"><b>Al momento de iniciar la calibración se asegura que el producto se encuentre sin movimiento:</b></td>
            <td class="align-middle"><?=$verificacion_movimiento;?></td>
          </tr>
          <tr>
            <td class="align-middle"><b>Método para determinar el nivel liquido dentro del tanque (Inmersión o medida seca):</b></td>
            <td class="align-middle"><?=$metodo_nivel;?></td>
          </tr>
        </tbody>
      </table>


    <table class="table table-bordered table-sm">
      <?php 

      echo contenidoTabla($GET_idRegistro,'1. Aspecto a verificar en los patrones de referencia',$con);
      echo contenidoTabla($GET_idRegistro,'2. Sistema de nivel automático (tirilla del Sistema de Control de Inventarios)',$con);
      echo contenidoTabla($GET_idRegistro,'3. Medición de la cinta petrolera (en mm) y termómetro (en °C)',$con);
      echo contenidoTabla($GET_idRegistro,'4. Resultado: Diferencia entre ambas mediciones',$con);

      ?>
    </table>

    <div class="bg-light p-3">
      "<b>Nota 1:</b> Referente al nivel puede existir una variación de +/- 3 mm, sin embargo, para aplicaciones fiscales o de transferencia de custodia, los equipos deben cumplir con un EMP de Â± 4 mm, en todo el intervalo de medición.<br>
    <b>Nota 2:</b> referente a la temperatura puede existir una variación igual o menor de 0.5 °C"   

    </div>
            

    </div>
