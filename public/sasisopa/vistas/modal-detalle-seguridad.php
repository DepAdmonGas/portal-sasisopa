<?php
require('../../../app/help.php');

function NomUsuario($id, $con){

$sql_lista = "SELECT * FROM tb_usuarios WHERE id = '".$id."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$nombre = $row_lista['nombre'];	
}
return $nombre;
}
 
$sql_lista = "SELECT * FROM tb_requisicion_obra WHERE id = '".$_GET['id']."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$NumFolio = "0".$row_lista['no_folio'];
$fechahora = explode(" ", $row_lista['fecha']);
$fecha = FormatoFecha($fechahora[0]);
$NombreUsuario = NomUsuario($row_lista['id_usuario'], $con);

$descripcion = $row_lista['descripcion'];
$justificacion = $row_lista['justificacion'];
}


$sql_formato12 = "SELECT * FROM tb_requisicion_obra_formato_12 WHERE id_requisicion = '".$_GET['id']."' ";
$result_formato12 = mysqli_query($con, $sql_formato12);
$numero_formato12 = mysqli_num_rows($result_formato12);

if ($numero_formato12 == 0) {
$imgArchivo = "<img src='".RUTA_IMG_ICONOS."documento.png'>";
}else{
while($row_formato12 = mysqli_fetch_array($result_formato12, MYSQLI_ASSOC)){
$urlArchivo = $row_formato12['archivo'];
}
$imgArchivo ="<a target='BLANK' href='".SERVIDOR.$urlArchivo."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}

$sql_carta_r = "SELECT * FROM tb_requisicion_obra_carta_responsiva WHERE id_requisicion = '".$_GET['id']."' ";
$result_carta_r = mysqli_query($con, $sql_carta_r);
$numero_carta_r = mysqli_num_rows($result_carta_r);

if ($numero_carta_r == 0) {
$imgArchivoCR = "<img src='".RUTA_IMG_ICONOS."documento.png'>";
}else{
while($row_carta_r = mysqli_fetch_array($result_carta_r, MYSQLI_ASSOC)){
$urlArchivoCR = $row_carta_r['archivo'];
}
$imgArchivoCR ="<a target='BLANK' href='".SERVIDOR.$urlArchivoCR."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}
//---------------------------------------------------------------------------------
$sql_formato14 = "SELECT * FROM tb_requisicion_obra_formato_14 WHERE id_requisicion = '".$_GET['id']."' ";
$result_formato14 = mysqli_query($con, $sql_formato14);
$numero_formato14 = mysqli_num_rows($result_formato14);

if ($numero_formato14 == 0) {
$imgArchivo14 = "<img src='".RUTA_IMG_ICONOS."documento.png'>";
}else{
while($row_formato14 = mysqli_fetch_array($result_formato14, MYSQLI_ASSOC)){
$urlArchivo14 = $row_formato14['archivo'];
}
$imgArchivo14 ="<a target='BLANK' href='".SERVIDOR.$urlArchivo14."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}
//---------------------------------------------------------------------------------
$sql_formato15 = "SELECT * FROM tb_requisicion_obra_formato_15 WHERE id_requisicion = '".$_GET['id']."' ";
$result_formato15 = mysqli_query($con, $sql_formato15);
$numero_formato15 = mysqli_num_rows($result_formato15);

if ($numero_formato15 == 0) {
$imgArchivo15 = "<img src='".RUTA_IMG_ICONOS."documento.png'>";
}else{
while($row_formato15 = mysqli_fetch_array($result_formato15, MYSQLI_ASSOC)){
$urlArchivo15 = $row_formato15['archivo'];
}
$imgArchivo15 ="<a target='BLANK' href='".SERVIDOR.$urlArchivo15."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}
?>
<div class="modal-header">
<h4 class="modal-title">Detalle requisición de obra o servicio
</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<div class="font-weight-bold border-bottom pb-2">1.- Requisición de obra o servicio Fo. ADMONGAS.013</div>

  <div class="row mt-2">
  
  <div class="col-12 col-md-4">
  <div class="mb-2">
    <small class="text-secondary">No. De folio:</small>
  </div>
  
  <input class="form-control input-style rounded-0 border-0" value="<?=$NumFolio;?>" type="text" id="folio" disabled>  </div>

  <div class="col-12 col-md-8">
  <div class="mb-2"><small class="text-secondary">Fecha:</small></div>
  <input class="form-control input-style rounded-0 border-0" value="<?=$fecha;?>" type="text" disabled>  
  </div>

  </div>

  <div class="row mt-2">
  <div class="col-12 col-md-4">
  <div class="mb-2"><small class="text-secondary">Nombre del solicitante:</small></div>
  <input class="form-control input-style rounded-0 border-0" value="<?=$NombreUsuario;?>" type="text" disabled>        
  </div>
  <div class="col-12 col-md-8">
  <div class="mb-2"><small class="text-secondary">Empresa solicitante:</small></div>
  <input class="form-control input-style rounded-0 border-0" value="<?=$Session_Razonsocial;?>" type="text" disabled>        
  </div>
  </div>

    <div class="row mt-2">
  <div class="col-12 col-md-12">
  <div class="mb-2"><small class="text-secondary">Descripcion detallada del servicio que requiere:</small></div>
  <div class="border p-2"><?=$descripcion;?></div>     
  </div>
  </div>

    <div class="row mt-2">
  <div class="col-12 col-md-12">
  <div class="mb-2"><small class="text-secondary">Justificacion del servicio solicitado:</small></div>
  <div class="border p-2"><?=$justificacion;?></div>   
  </div>
  </div>

  <div class="font-weight-bold border-bottom pb-2 mt-2">2.- Autorización para realizar trabajos peligrosos Fo. ADMONGAS.012</div>

  <div class="pt-1 pb-1"><small> Descarga el archivo, vacia la informacion que te solicita y adjunta el archivo en formato PDF.</small></div>

<div class="mt-2" style="overflow-y: hidden;">
  <table class="table table-bordered table-striped table-sm">
  <tr>
  
  <td  class="align-middle text-center"width="24"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.012.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></a>
  </td> 

  <td  class="align-middle text-center"class="align-middle text-center">

    <div class="row">
  
  <div class="col-12 mb-3">
  <input class="mt-2" type="file" style="font-size: .8em;" id="Archivoformato12">
  </div>

  <div class="col-12 ">
  <button type="button" class="rounded-0 btn btn-success mb-2" style="font-size: .8em;" onclick="Formato12(<?=$_GET['id'];?>)">Guardar archivo</button>
  </div>

  </div>

  </td>

  <td width="24" class="align-middle text-center"><?=$imgArchivo;?></td>
  </tr>
  </table>
</div>


  <div class="font-weight-bold border-bottom pb-2 mt-2">3.- Carta responsiva</div>

<div class="pt-1 pb-1"><small> Descarga el archivo, vacia la informacion que te solicita y adjunta el archivo en formato PDF.</small></div>

  <div class="mt-2" style="overflow-y: hidden;">
  <table class="table table-bordered table-striped table-sm">
  <tr>

  <td class="align-middle text-center" width="24">
    <a href="<?=RUTA_ARCHIVOS_ADMONGAS."Carta-responsiva.docx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>"></a>
  </td> 

  <td class="align-middle text-center" class="align-middle text-center">

      <div class="row">

 <div class="col-12 mb-3">
  <input class="mt-2" type="file" style="font-size: .8em;" id="ArchivoformatoCR">
</div>

  <div class="col-12 ">
  <button type="button" class="rounded-0 btn btn-info mb-2" style="font-size: .8em;" onclick="FormatoCR(<?=$_GET['id'];?>)">Guardar archivo</button>
</div>

</div>
  </td>

  <td width="24" class="align-middle text-center"><?=$imgArchivoCR;?></td>
  </tr>


  </table>

  
  <div class="font-weight-bold border-bottom pb-2 mt-2">4.- Entrega de información al contratista Fo. ADMONGAS.014</div>
<div class="pt-1 pb-1"><small> Descarga el archivo, vacia la informacion que te solicita y adjunta el archivo en formato PDF.</small></div>
  
<div class="mt-2" style="overflow-y: hidden;">
  <table class="table table-bordered table-striped table-sm">
  <tr>

  <td class="align-middle text-center" width="24">
    <a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.014.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></a>
  </td> 

  <td class="align-middle text-center">
 
  <div class="row">

 <div class="col-12 mb-3">
  <input class="mt-2" type="file" style="font-size: .8em;" id="Archivoformato14">
</div>

 <div class="col-12">
  <button type="button" class="rounded-0 btn btn-success mb-2" style="font-size: .8em;" onclick="Formato14(<?=$_GET['id'];?>)">Guardar archivo</button>
</div>
</div>

  </td>
  <td width="24" class="align-middle text-center"><?=$imgArchivo14;?></td>
  </tr>
  </table>
</div>



  <div class="font-weight-bold border-bottom pb-2 mt-2">5.- Listas de verificación Fo. ADMONGAS.015</div>

<div class="pt-1 pb-1">
  <small> Descarga el archivo, vacia la informacion que te solicita y adjunta el archivo en formato PDF.</small>
</div>

<div class="mb-2" style="overflow-y: hidden;">
   <table class="table table-bordered table-striped table-sm">
  
  <tr>

  <td class="align-middle text-center" width="24"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.015.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></a>
  </td> 

  <td class="align-middle text-center">

 <div class="col-12 mb-3">
  <input class="mt-2" type="file" style="font-size: .8em;" id="Archivoformato15">
</div>

 <div class="col-12">
  <button type="button" class="rounded-0 btn btn-success mb-2" style="font-size: .8em;" onclick="Formato15(<?=$_GET['id'];?>)">Guardar archivo</button>
</div>
  </td>

  <td width="24" class="align-middle text-center"><?=$imgArchivo15;?></td>
  </tr>
  </table>
</div>


  <div id="result"></div>

</div>