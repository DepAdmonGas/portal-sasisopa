<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/ControlActividadProceso.php";

$class_control_actividad_proceso = new ControlActividadProceso();

$idMantenimiento = $_GET['idMantenimiento'];
$ruta = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenFirma/";

$sql_mantenimiento = "SELECT * FROM po_mantenimiento_correctivo WHERE id = '".$idMantenimiento."'";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);

        $row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC);
        $folio = $class_control_actividad_proceso->FormatFolio($row_mantenimiento['folio']);
        $fecha_row = $row_mantenimiento['fechacreacion'];
        $fecha = FormatoFecha($fecha_row);

        $hora = date("g:i a",strtotime($row_mantenimiento['horacreacion']));
        $equipo = $row_mantenimiento['nombre_equipo'];
        $dhallazgo = $row_mantenimiento['descripcion_hallazgo'];
        $dactividad = $row_mantenimiento['descripcion_actividad'];
        $herramienta = $row_mantenimiento['herramienta'];

        $firma_fpr = $class_control_actividad_proceso->firmaMantenimientoCorrectivo($idMantenimiento,'FPR');
        $NombreRecibe = $firma_fpr['nombre'];
        $FPR = $firma_fpr['firma'];

        $firma_fps = $class_control_actividad_proceso->firmaMantenimientoCorrectivo($idMantenimiento,'FPS');
        $NombreResponsable = $firma_fps['nombre'];
        $FPS = $firma_fps['firma'];

        ?>
  <div class="modal-header">
  <h4 class="modal-title">Folio: <?=$folio;?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>

    <div class="modal-body">
 
  <div class="text-right mb-3">

    <button type="button" class="btn btn-light rounded-0" onclick="EditarMantenimiento(<?=$idMantenimiento;?>)">
        <img src="<?php echo RUTA_IMG_ICONOS."edit-black-16.png"; ?>">
    </button>

        <button type="button" class="btn btn-info rounded-0 btn-sm" onclick="Evidencias(<?=$idMantenimiento;?>)">Evidencias</button>
  </div>
  <hr>

    <div class="col-12 border p-2">
        <div class="font-weight-bold text-secondary border-bottom mb-2">
            Nombre del equipo o área donde se detecta la no conformidad:
        </div>
        <div><?=$equipo;?></div>
    </div>

    <div class="col-12 border p-2 mt-3">
        <div class="font-weight-bold text-secondary border-bottom mb-2">
            Descripción breve del hallazgo detectado que requiere mantenimiento:
        </div>
        <div><?=$dhallazgo;?></div>
    </div>

    <div class="col-12 border p-2 mt-3">
        <div class="font-weight-bold text-secondary border-bottom mb-2">
        Descripción de las actividades de mantenimiento:
        </div>
        <div><?=$dactividad;?></div>
    </div>


    <div class="col-12 border p-2 mt-3">
        <div class="font-weight-bold text-secondary border-bottom mb-2">
        Herramienta utilizada para el mantenimiento:
    </div>
        <div><?=$herramienta;?></div>
    </div>

    <div class="col-12 mt-3">
        <div class="text-right text-secondary">
        <small><?=$fecha;?>, <?=$hora;?></small>
        </div>        
    </div>

            <hr>

        <div class="row mt-2">
	    
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2 "> 
	       
           <div class="border p-2" align="center">
			<div class="border-bottom mb-2 font-weight-bold text-center">Firma de persona que realizo</div>
			<img width="80%" src="<?=$ruta.$FPR;?>">
            <div class="border-top text-center"><small><?=$NombreRecibe;?></small></div>
		  </div>
	   </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2 "> 
		
        <div class="border p-2" align="center">
			<div class="border-bottom mb-2 font-weight-bold text-center">Firma de persona que superviso</div>
			<img width="80%" src="<?=$ruta.$FPS;?>">
            <div class="border-top text-center"><small><?=$NombreResponsable;?></small></div>
		</div>

	</div>

    </div>

</div>
