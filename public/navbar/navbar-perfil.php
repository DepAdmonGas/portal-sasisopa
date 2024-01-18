<?php

if($session_nomestacion == "Comodines"){
$nombreBar = "AdmonGas";

}else{ 
$nombreBar = $session_nomestacion;
}
   

?> 

<style type="text/css">
   
.user-box {
  display: flex;
  padding: 2px 10px;
}

.user-box .u-text {
  padding: 3px 5px;
}

.user-box .u-text h4 {
  font-size: 16px;
}

.user-box .u-text .text-muted {
  font-size: 13px;
  margin-bottom: 1.5px;
}

.user-box .u-text .btn {
  font-size: 12px;
}


 </style>


<!---------- NAV BAR (TOP) ---------->  
 <nav class="navbar navbar-expand navbar-light navbar-bg">

<div class="pointer">
<a class="text-white" onclick="history.back()"><?=$nombreBar;?></a>
</div>

<div class="navbar-collapse collapse">

  <ul class="navbar-nav navbar-align">

  <li class="nav-item dropdown">
  <a class=" dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
  <i class="align-middle" data-feather="settings"></i>
  </a>


  <a class="nav-link dropdown-toggle d-none d-sm-inline-block pointer text-white" data-bs-toggle="dropdown">
  
  <img src="<?=RUTA_IMG_ICONOS."usuarioBar.png";?>" class="avatar img-fluid rounded-circle"/>

  <span class="text-white" style="padding-left: 10px;">
  <?=$session_nompuesto;?>  
  </span>
  </a> 
  
  <div class="dropdown-menu dropdown-menu-end">
  
  <div class="user-box">

  <div class="u-text">
  <p class="text-muted">Nombre de usuario:</p>
  <h4><?=$session_nomusuario;?></h4>
  </div>

  </div>


  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="perfil">
  <i class="fa-solid fa-user" style="padding-right: 5px;"></i>Perfil
  </a>
 
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="<?=RUTA_SALIR2?>salir">
  <i class="fa-solid fa-power-off" style="padding-right: 5px;"></i> Cerrar Sesión
  </a>

  </div>
  </li>
  
  </ul>
  </div>

  </nav>