<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/MonitoreoVerificacionEvaluacion.php";
$class_monitoreo_evaluacion = new MonitoreoVerificacionEvaluacion();

$Year = $_GET['Year'];


	  function TC($a,$b){

	  if($b == 0){
	  $Return = "<b class='text-warning'>S/I</b>";
	  }else{
	  $Resul = ($a - $b) / $b * 100;
      $TC = 100 + ($Resul);
      $Porcentaje = number_format($TC,2);

      if( $Porcentaje >= 80  ){
      $Return = "<b class='text-success'>".$Porcentaje."% Excelente</b>";                 
      }else if($Porcentaje >= 0 && $Porcentaje <= 79){
      $Return = "<b class='text-warning'>".$Porcentaje."% Regular</b>";
      }
	  }
      return $Return;
      }

      $YearAnt = $Year - 1;

      $DicAnt = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,12,$YearAnt);
      $Ene = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,1,$Year);
      $Feb = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,2,$Year);
      $Mar = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,3,$Year);
      $Abr = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,4,$Year);
      $May = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,5,$Year);
      $Jun = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,6,$Year);
      $Jul = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,7,$Year);
      $Ago = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,8,$Year);
      $Sep = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,9,$Year);
      $Oct = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,10,$Year);
      $Nov = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,11,$Year);
      $Dic = $class_monitoreo_evaluacion->ventas($Session_IDEstacion,12,$Year);

      $TC1 = TC($Ene,$DicAnt);
      $TC2 = TC($Feb,$Ene);
      $TC3 = TC($Mar,$Feb);
      $TC4 = TC($Abr,$Mar);
      $TC5 = TC($May,$Abr);
      $TC6 = TC($Jun,$May);
      $TC7 = TC($Jul,$Jun);
      $TC8 = TC($Ago,$Jul);
      $TC9 = TC($Sep,$Ago);
      $TC10 = TC($Oct,$Sep);
      $TC11 = TC($Nov,$Oct);
      $TC12 = TC($Dic,$Nov);
?>
<a onclick="Descargar(<?=$Year;?>)" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a>
<h5>Resumen del Año: <?=$Year;?></h5>
      <div class="border p-2">

      <table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Implementación del SA</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">No. Total de elementos implementados VS No. de elementos del SA</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=$class_monitoreo_evaluacion->meta($Session_IDEstacion,1);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">ANUAL</td>
        </tr>
        <tr>
          <td colspan="4">
          <div class="mt-1"><b>Resultado:</b> <?=$class_monitoreo_evaluacion->resultadoImplementacion($Session_IDEstacion,$Year);?></div>
          </td>
        </tr>
        </tbody>
        </table> 

        <div class="text-right mt-2"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="Implementacion()" >Ver detalle</button></div>
        </div>

    <hr>

      <div class="border p-2">

      <table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Ventas</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">Venta del mes inmediato anterior VS venta del mes actual</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=$class_monitoreo_evaluacion->meta($Session_IDEstacion,2);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Mensual</td>
        </tr>
        </tbody>
        </table> 

     <div class="mt-1"><b>Resultado:</b></div>

      <div class="row">
        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Dic <?=$YearAnt;?></th>
                <th class="text-center bg-light">Ene <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($DicAnt,2);?></td>
                <td class="text-center bg-light"><?=number_format($Ene,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC1;?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Ene <?=$Year;?></th>
                <th class="text-center">Feb <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Ene,2);?></td>
                <td class="text-center"><?=number_format($Feb,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC2;?></td>
              </tr>
            </tbody>
          </table>
        </div>

          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Feb <?=$Year;?></th>
                <th class="text-center bg-light">Mar <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Feb,2);?></td>
                <td class="text-center bg-light"><?=number_format($Mar,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC3;?></td>
              </tr>
            </tbody>
          </table>
        </div>

          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Mar <?=$Year;?></th>
                <th class="text-center">Abr <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Mar,2);?></td>
                <td class="text-center"><?=number_format($Abr,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC4;?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Abr <?=$Year;?></th>
                <th class="text-center bg-light">May <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Abr,2);?></td>
                <td class="text-center bg-light"><?=number_format($May,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC5;?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">May <?=$Year;?></th>
                <th class="text-center">Jun <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($May,2);?></td>
                <td class="text-center"><?=number_format($Jun,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC6;?></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>

        <div class="row">

        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Jun <?=$Year;?></th>
                <th class="text-center bg-light">Jul <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Jun,2);?></td>
                <td class="text-center bg-light"><?=number_format($Jul,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC7;?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Jul <?=$Year;?></th>
                <th class="text-center">Ago <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Jul,2);?></td>
                <td class="text-center"><?=number_format($Ago,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC8;?></td>
              </tr>
            </tbody>
          </table>
        </div>

          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Ago <?=$Year;?></th>
                <th class="text-center bg-light">Sep <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Ago,2);?></td>
                <td class="text-center bg-light"><?=number_format($Sep,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC9;?></td>
              </tr>
            </tbody>
          </table>
        </div>

          <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Sep <?=$Year;?></th>
                <th class="text-center">Oct <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Sep,2);?></td>
                <td class="text-center"><?=number_format($Oct,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC10;?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center bg-light">Oct <?=$Year;?></th>
                <th class="text-center bg-light">Nov <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center bg-light"><?=number_format($Oct,2);?></td>
                <td class="text-center bg-light"><?=number_format($Nov,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center bg-light"><?=$TC11;?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-2">
          <table class="table table-sm table-bordered" style="font-size: .9em;">
            <thead>
              <tr>
                <th class="text-center">Nov <?=$Year;?></th>
                <th class="text-center">Dic <?=$Year;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?=number_format($Nov,2);?></td>
                <td class="text-center"><?=number_format($Dic,2);?></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><?=$TC12;?></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
      <div class="text-right"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="Ventas()" >Ver detalle</button></div>
      </div>

      <hr>

    <div class="border p-2">

      <table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Capacitación</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">No. de personal capacitado vs No. de personal de la estación</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=$class_monitoreo_evaluacion->meta($Session_IDEstacion,3);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Semestral</td>
        </tr>
        <tr>
          <td colspan="4">
            
        <div class="mt-1"><b>Resultado:</b></div>

        <div class="row">
          <div class="col-6">
          <div class="text-secondary">Primer semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoCapacitacion($Session_IDEstacion,$Year,1);?>
          </div>
          <div class="col-6">
          <div class="text-secondary">Segundo semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoCapacitacion($Session_IDEstacion,$Year,2);?>
          </div>
        </div>

          </td>
        </tr>
        </tbody>
        </table> 

        <div class="text-right mt-2"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="Capacitacion()" >Ver detalle</button></div>
        </div>

        <hr>

        <div class="border p-2">

      <table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Satisfacción del cliente</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">Media del total de clientes con experiencia: Mala, Buena y Excelente</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=$class_monitoreo_evaluacion->meta($Session_IDEstacion,4);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Semestral</td>
        </tr>
        <tr>
          <td colspan="4">
          <div class="mt-1"><b>Resultado:</b></div>

        <div class="row">
          <div class="col-6">
          <div class="text-secondary">Primer semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoSatisfaccion($Session_IDEstacion,$Year,1);?>
          </div>
          <div class="col-6">
          <div class="text-secondary">Segundo semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoSatisfaccion($Session_IDEstacion,$Year,2);?>
          </div>
        </div>
          </td>
        </tr>
        </tbody>
        </table>

        <div class="text-right mt-2"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="SatisfaccionClientes()" >Ver detalle</button></div>
      

      </div>

      <hr>

      <div class="border p-2">

      <table class="table table-bordered table-sm c-pointer pb-0 mb-0">
      <tbody>
       <tr>
          <td class="align-middle text-center"><b>Objeto</b></td>
          <td class="align-middle">Incidentes y accidentes</td>
          <td class="align-middle text-center"><b>Indicador</b></td>
          <td class="align-middle">No total de accidentes e incidentes ocurridos VS número total de accidentes e incidentes atendidos</td>
        </tr>
        <tr>
          <td class="align-middle text-center"><b>Meta</b></td>
          <td class="align-middle"><?=$class_monitoreo_evaluacion->meta($Session_IDEstacion,5);?></td>
          <td class="align-middle text-center"><b>Frecuencia de medición</b></td>
          <td class="align-middle">Semestral</td>
        </tr>
        <tr>
          <td colspan="4">
           <div class="mt-1"><b>Resultado:</b></div>

        <div class="row">
          <div class="col-6">
          <div class="text-secondary">Primer semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoIncidentes($Session_IDEstacion,$Year,1);?>
          </div>
          <div class="col-6">
          <div class="text-secondary">Segundo semestre:</div>
          <?=$class_monitoreo_evaluacion->resultadoIncidentes($Session_IDEstacion,$Year,2);?>
          </div>
        </div>
          </td>
        </tr>
        </tbody>
        </table>

        <div class="text-right mt-2"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="IncidentesAccidentes()" >Ver detalle</button></div>

      </div>

    <hr>
