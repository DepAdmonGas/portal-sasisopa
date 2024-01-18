<script type="text/javascript">
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});
</script>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #395173;border-bottom: 5px solid #5d84c3;">
	<a class="navbar-brand" href="<?php echo SERVIDOR; ?>">SASISOPA</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		<li class="nav-item">
		<a class="nav-link" href="<?php echo PORTAL; ?>">PORTAL</a>
		</li>
		<li class="nav-item">
		</li>
		</ul>
	<div class="navbar-nav" style="padding-left: 15px;">
	<a href="<?php echo RUTA_PERFIL; ?>" data-toggle="tooltip" data-placement="left" title="Usuario"><img src="<?php echo RUTA_IMG_ICONOS."usuario.png" ?>"></a>
	</div>
	</div>
</nav>
 