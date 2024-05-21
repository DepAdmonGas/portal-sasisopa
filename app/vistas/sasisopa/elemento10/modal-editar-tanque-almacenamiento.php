<?php
require('../../../../app/help.php');

$idTanque = $_GET['idTanque'];

$sql_extintores = "SELECT * FROM tb_tanque_almacenamiento WHERE id = '".$idTanque."' ";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);

$row_extintores = mysqli_fetch_array($result_extintores, MYSQLI_ASSOC);
$notanque = $row_extintores['no_tanque'];
$capacidad = $row_extintores['capacidad'];
$producto = $row_extintores['producto'];
?>

  <div class="modal-header">
  <h4 class="modal-title">Editar Tanque</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">

    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* No. Tanque</small>
      <input type="number" class="form-control rounded-0 mt-2" id="EditNoTanque" min="1" value="<?=$notanque;?>">
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Capacidad</small>
      <input type="text" class="form-control rounded-0 mt-2" id="EditCapacidad" value="<?=$capacidad;?>">
    </div>

     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Producto</small>
      <select class="form-control rounded-0 mt-2" id="EditProducto">
        <option><?=$producto;?></option>
        <option>G SUPER</option>
        <option>G PREMIUM</option>
        <option>G DIESEL</option>
      </select>
    </div>
  </div>

  </div>


  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnEditar(<?=$idTanque;?>)">Editar</button>
  </div>