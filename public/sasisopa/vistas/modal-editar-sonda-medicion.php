<?php
require('../../../app/help.php');

$idSonda = $_GET['idSonda'];

$sql_extintores = "SELECT * FROM tb_sondas_medicion WHERE id = '".$idSonda."' ";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);

while($row_extintores = mysqli_fetch_array($result_extintores, MYSQLI_ASSOC)){
$nosonda = $row_extintores['no_sonda'];
$marca = $row_extintores['marca'];
$modelo = $row_extintores['modelo'];
$ubicacion = $row_extintores['ubicacion'];
}
?>

  <div class="modal-header">
  <h4 class="modal-title">Editar Sondas de medición</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">

  <div class="row">

    
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* No. Sonda</small>
      <input type="number" class="form-control rounded-0 mt-2" value="<?=$nosonda;?>" id="EditNoSonda" min="1">
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Marca</small>
      <input type="text" class="form-control rounded-0 mt-2" value="<?=$marca;?>" id="EditMarca">
    </div>

     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Modelo</small>
      <input type="text" class="form-control rounded-0 mt-2" value="<?=$modelo;?>" id="EditModelo">
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Ubicación</small>
      <input type="text" class="form-control rounded-0 mt-2" value="<?=$ubicacion;?>" id="EditUbicacion">
    </div>

  </div>

  </div>


  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnEditar(<?=$idSonda;?>)">Editar</button>
  </div>