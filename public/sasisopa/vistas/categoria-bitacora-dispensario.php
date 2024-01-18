<?php
require('../../../app/help.php');

$Categoria = $_GET['Categoria'];

?>
<?php if($Categoria == 1 || $Categoria == 3 || $Categoria == 4 || $Categoria == 5 || $Categoria == 6 || $Categoria == 7 ){ ?>
 <div class="row">

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 "> 
      <small>* Fecha</small>
      <input type="date" class="form-control rounded-0 mt-2" id="Fecha">
    </div>


    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 "> 
      <small>* Hora inicio</small>
      <input type="time" class="form-control rounded-0 mt-2" id="HoraInicio">
    </div>


    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 "> 
      <small>* Hora termino</small>
      <input type="time" class="form-control rounded-0 mt-2" id="HoraTermino">
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 "> 
       <small>* Dispensario</small>
      <select class="form-control rounded-0 mt-2" id="Dispensario">
        <option value="">Selecciona</option>
      <?php
      $sql_lista = "SELECT * FROM tb_dispensarios WHERE id_estacion = '".$Session_IDEstacion."' ";
      $result_lista = mysqli_query($con, $sql_lista);
      $numero_lista = mysqli_num_rows($result_lista);
      while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
      echo '<option value="'.$row_lista['id'].'">'.$row_lista['no_dispensario'].'</option>';
      }

      ?>  
      </select>
    </div>

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 "> 
      <small>* Lado</small>
      <select class="form-control rounded-0 mt-2" id="Lado">
      <option value="0">Selecciona</option>
      <option value="1">1</option>
      <option value="2">2</option>
      </select>
    </div>


    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2"> 
    <small>Producto</small>

    <select class="form-control rounded-0 mt-2" id="Producto">
    	<option></option>
    	<option value="<?=$Session_ProductoUno;?>"><?=$Session_ProductoUno;?></option>
    	<option value="<?=$Session_ProductoDos;?>"><?=$Session_ProductoDos;?></option>
    	<?php if($Session_ProductoTres != ""){ ?>
    	<option value="<?=$Session_ProductoTres;?>"><?=$Session_ProductoTres;?></option>
		<?php } ?>
    </select>     
    </div>


    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 mb-2 "> 
      <small>* Detalle</small>
     <textarea class="form-control rounded-0 mt-2" id="Detalle"></textarea>
    </div>

  </div>

<div class="text-right">
<button type="button" class="btn btn-primary rounded-0" onclick="btnGuardar(<?=$Categoria;?>)">Guardar</button>
</div>

<?php }else if($Categoria == 2){ ?>

	 <div class="row">

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 "> 
      <small>* Fecha</small>
      <input type="date" class="form-control rounded-0 mt-2" id="Fecha">
    </div>


    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 "> 
      <small>* Hora inicio</small>
      <input type="time" class="form-control rounded-0 mt-2" id="HoraInicio">
    </div>


    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 "> 
      <small>* Hora termino</small>
      <input type="time" class="form-control rounded-0 mt-2" id="HoraTermino">
    </div>


    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2"> 
    <small>Producto</small>

    <select class="form-control rounded-0 mt-2" id="Producto">
    	<option></option>
    	<option value="<?=$Session_ProductoUno;?>"><?=$Session_ProductoUno;?></option>
    	<option value="<?=$Session_ProductoDos;?>"><?=$Session_ProductoDos;?></option>
    	<?php if($Session_ProductoTres != ""){ ?>
    	<option value="<?=$Session_ProductoTres;?>"><?=$Session_ProductoTres;?></option>
		<?php } ?>
    </select>     
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 mb-2 "> 
      <small>* Precio</small>
     <textarea class="form-control rounded-0 mt-2" id="Detalle"></textarea>
    </div>
    </div>

<div class="text-right">
<button type="button" class="btn btn-primary rounded-0" onclick="btnGuardarCP(<?=$Categoria;?>)">Guardar</button>
</div>

<?php } ?>