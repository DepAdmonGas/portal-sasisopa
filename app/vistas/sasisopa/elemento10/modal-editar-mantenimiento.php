<?php
require('../../../../app/help.php');

$idReporte = $_GET['idReporte'];

$sql_mantenimiento_lista = "SELECT po_mantenimiento_lista.id, po_mantenimiento_lista.detalle, 
po_programa_anual_mantenimiento_detalle.id AS idreporte, po_programa_anual_mantenimiento_detalle.id_programa_fecha, po_programa_anual_mantenimiento_detalle.enero,po_programa_anual_mantenimiento_detalle.febrero,po_programa_anual_mantenimiento_detalle.marzo,po_programa_anual_mantenimiento_detalle.abril,po_programa_anual_mantenimiento_detalle.mayo,po_programa_anual_mantenimiento_detalle.junio,po_programa_anual_mantenimiento_detalle.julio,po_programa_anual_mantenimiento_detalle.agosto,po_programa_anual_mantenimiento_detalle.septiembre,po_programa_anual_mantenimiento_detalle.octubre,po_programa_anual_mantenimiento_detalle.noviembre,po_programa_anual_mantenimiento_detalle.diciembre
FROM po_mantenimiento_lista
INNER JOIN po_programa_anual_mantenimiento_detalle
ON po_mantenimiento_lista.id = po_programa_anual_mantenimiento_detalle.id_mantenimiento WHERE po_programa_anual_mantenimiento_detalle.id = '".$idReporte."' ";
        $result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
        $numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);
        $row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC);

        $detalle = $row_mantenimiento_lista['detalle'];        
        $enero = $row_mantenimiento_lista['enero'];
        $eneromax = date("Y-m-d",strtotime($enero."+ 30 days")); 
        $eneromin = date("Y-m-d",strtotime($enero."- 30 days")); 

		$febrero = $row_mantenimiento_lista['febrero'];
		$febreromax = date("Y-m-d",strtotime($febrero."+ 30 days")); 
        $febreromin = date("Y-m-d",strtotime($febrero."- 30 days")); 

		$marzo = $row_mantenimiento_lista['marzo'];
		$marzomax = date("Y-m-d",strtotime($marzo."+ 30 days")); 
        $marzomin = date("Y-m-d",strtotime($marzo."- 30 days")); 

		$abril = $row_mantenimiento_lista['abril'];
		$abrilmax = date("Y-m-d",strtotime($abril."+ 30 days")); 
        $abrilmin = date("Y-m-d",strtotime($abril."- 30 days")); 

		$mayo = $row_mantenimiento_lista['mayo'];
		$mayomax = date("Y-m-d",strtotime($mayo."+ 30 days")); 
        $mayomin = date("Y-m-d",strtotime($mayo."- 30 days")); 

		$junio = $row_mantenimiento_lista['junio'];
		$juniomax = date("Y-m-d",strtotime($junio."+ 30 days")); 
        $juniomin = date("Y-m-d",strtotime($junio."- 30 days")); 

		$julio = $row_mantenimiento_lista['julio'];
		$juliomax = date("Y-m-d",strtotime($julio."+ 30 days")); 
        $juliomin = date("Y-m-d",strtotime($julio."- 30 days")); 

		$agosto = $row_mantenimiento_lista['agosto'];
		$agostomax = date("Y-m-d",strtotime($agosto."+ 30 days")); 
        $agostomin = date("Y-m-d",strtotime($agosto."- 30 days")); 

		$septiembre = $row_mantenimiento_lista['septiembre'];
		$septiembremax = date("Y-m-d",strtotime($septiembre."+ 30 days")); 
        $septiembremin = date("Y-m-d",strtotime($septiembre."- 30 days")); 

		$octubre = $row_mantenimiento_lista['octubre'];
		$octubremax = date("Y-m-d",strtotime($octubre."+ 30 days")); 
        $octubremin = date("Y-m-d",strtotime($octubre."- 30 days")); 

		$noviembre = $row_mantenimiento_lista['noviembre'];
		$noviembremax = date("Y-m-d",strtotime($noviembre."+ 30 days")); 
        $noviembremin = date("Y-m-d",strtotime($noviembre."- 30 days")); 

		$diciembre = $row_mantenimiento_lista['diciembre'];
		$diciembremax = date("Y-m-d",strtotime($diciembre."+ 30 days")); 
        $diciembremin = date("Y-m-d",strtotime($diciembre."- 30 days")); 

?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white"><?=$detalle;?></h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">

<div class="row">

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center ">

<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Enero</div>
</div>
      
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Enero" value="<?=$enero;?>" min="<?=$eneromin;?>" max="<?=$eneromax;?>" class="form-control rounded-0">
</div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center">
<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Febrero</div>
</div>
      
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Febrero" value="<?=$febrero;?>" min="<?=$febreromin;?>" max="<?=$febreromax;?>" class="form-control rounded-0">
</div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center">
<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Marzo</div>
</div>
   
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Marzo" value="<?=$marzo;?>" min="<?=$marzomin;?>" max="<?=$marzomax;?>" class="form-control rounded-0">
</div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center">
<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Abril</div>
</div>
      
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Abril" value="<?=$abril;?>" min="<?=$abrilmin;?>" max="<?=$abrilmax;?>" class="form-control rounded-0">
</div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center">
<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Mayo</div>
</div>
      
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Mayo" value="<?=$mayo;?>" min="<?=$mayomin;?>" max="<?=$mayomax;?>" class="form-control rounded-0">
</div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center">
<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Junio</div>
</div>
      
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Junio" value="<?=$junio;?>" min="<?=$juniomin;?>" max="<?=$juniomax;?>" class="form-control rounded-0">
</div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center">
<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Julio</div>
</div>
      
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Julio" value="<?=$julio;?>" min="<?=$juliomin;?>" max="<?=$juliomax;?>" class="form-control rounded-0">
</div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center">
<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Agosto</div>
</div>
      
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Agosto" value="<?=$agosto;?>" min="<?=$agostomin;?>" max="<?=$agostomax;?>" class="form-control rounded-0">
</div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center">
<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Septiembre</div>
</div>
      
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Septiembre" value="<?=$septiembre;?>" min="<?=$septiembremin;?>" max="<?=$septiembremax;?>" class="form-control rounded-0">
</div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center">
<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Octubre</div>
</div>
      
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Octubre" value="<?=$octubre;?>" min="<?=$octubremin;?>" max="<?=$octubremax;?>" class="form-control rounded-0">
</div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center">
<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Noviembre</div>
</div>
      
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Noviembre" value="<?=$noviembre;?>" min="<?=$noviembremin;?>" max="<?=$noviembremax;?>" class="form-control rounded-0">
</div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-3 font-weight-bold text-center">
<div class="card" style="border-radius: 0px;">
<div class="card-title  border-bottom bg-light" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-bottom: 0px;">
<div class="text-center fw-bold">Diciembre</div>
</div>
      
<div class="card-body" style="padding-left: 10px;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;">
<input type="date" id="Diciembre" value="<?=$diciembre;?>" min="<?=$diciembremin;?>" max="<?=$diciembremax;?>" class="form-control rounded-0">
</div>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-primary" style="-radius: 0px;" onclick="BtnEditarPrograma(<?=$idReporte;?>)">Aceptar</button>
</div>