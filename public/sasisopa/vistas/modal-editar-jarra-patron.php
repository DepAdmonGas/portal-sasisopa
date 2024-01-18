<?php
require('../../../app/help.php');

$idJarra = $_GET['idJarra'];

$sql_extintores = "SELECT * FROM tb_jarra_patron WHERE id = '".$idJarra."' ";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);

while($row_extintores = mysqli_fetch_array($result_extintores, MYSQLI_ASSOC)){
$marca = $row_extintores['marca'];
$noserie = $row_extintores['no_serie'];
$capacidad = $row_extintores['capacidad'];
$material = $row_extintores['material'];
}
?>

  <div class="modal-header">
  <h4 class="modal-title">Editar Jarra patron</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">

   <div class="row">

    
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Marca:</small>
      <input type="text" class="form-control rounded-0 mt-2" value="<?=$marca;?>" id="EditMarca">
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* No. Serie:</small>
      <input type="text" class="form-control rounded-0 mt-2" value="<?=$noserie;?>" id="EditNoSerie">
    </div>

     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Capacidad:</small>
      <input type="text" class="form-control rounded-0 mt-2" value="<?=$capacidad;?>" id="EditCapacidad">
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Material de fabricación:</small>
      <input type="text" class="form-control rounded-0 mt-2" value="<?=$material;?>" id="EditMaterial">
    </div>

  </div>
  </div>


  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnEditar(<?=$idJarra;?>)">Editar</button>
  </div>